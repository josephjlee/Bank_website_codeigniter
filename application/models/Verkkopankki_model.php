<?php

class Verkkopankki_model extends CI_Model {

	public function returnUserPass() { #Used to compare users post input
		$this->db->select('username, password');
		return $this->db->get('Permissions')->result_array();
	}

	public function returnAccountInformation($user, $pass) { #Returns necessary informaton about account
		$this->db->select('Account.account_id, Account.balance, firstname, lastname');
		$this->db->join('Client','Client.client_id = Permissions.client_id');
		$this->db->join('Account','Account.account_id = Permissions.account_id');
		$this->db->where('username', $user);
		$this->db->where('password', $pass);
		return $this->db->get('Permissions')->result_array();
	}

	public function returnClientInfo() {
		return $this->db->get('Client')->result_array();
	}

	public function login($username, $password) { #login script which sets sessiondata
		$login = array(
			'username' => $username,
			'password' => $password
		);
		$accounts = $this->Verkkopankki_model->returnUserPass();
		
		$loggedIn = false;

		foreach($accounts as $account) {
			if ($account['username'] === $login['username']) {
				if ($account['password'] === $login['password']) { #If post input is same as one of the databases
					$loggedIn = true;
					$session = array (
						'loggedIn' => true,
						'username' => $login['username'],
						'password' => $login['password']
					);
					$this->session->set_userdata($session);
					return true;
				}
			}
		}
		$this->session->set_userdata('loggedIn',false);
		$this->session->set_userdata('username',' ');
		$this->session->set_userdata('password',' ');
		return false;
	}

	public function lookForAccount($account_id) { #Return true if found account else false
		$this->db->where('account_id',$account_id);
		$query = $this->db->get('Account');
		if ($query->num_rows() > 0) { 
			return true;
		}
		else {
			return false;
		}
	}

	public function lookForBalance($account_id, $sum) { #If balance after transaction would be < 0 return false else true
		$this->db->where('account_id', $account_id);
		$query = $this->db->get('Account')->result_array();
		$newBalance;
		foreach ($query as $account) {
			$newBalance = $account['balance'] - $sum;
		}
		if ($newBalance < 0) {
			return false;
		}
		else {
			return true;
		}
	}

	public function accountById($id) {
		$this->db->where('account_id', $id);
		return $this->db->get('Account')->result_array();
	}

	public function transfer($sender, $receiver, $sum) { #Process transfer and error handle
		$this->db->trans_begin(); #Start transactions to ensure if errors happen during transaction
		$query = $this->accountById($sender);
		$newBalance;
		foreach ($query as $account) {	#Calculate new balance account after sending money
			$newBalance = $account['balance'] - $sum;
		}

		$this->db->set('balance', $newBalance);
		$this->db->where('account_id',$sender);
		$this->db->update('Account');

		$query = $this->accountById($receiver);
		foreach ($query as $account) {	#Calculate new balance on account after receiving money
			$newBalance = $account['balance'] + $sum;
		}

		$this->db->set('balance', $newBalance);
		$this->db->where('account_id', $receiver);
		$this->db->update('Account');
		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();	
			return false;
		}
		else {
			$this->db->trans_commit();
			return true;
		}
	}
}
