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

	public function returnAccountCards($user, $pass) {
		$this->db->select('card_id');
		$this->db->join('Account','Account.account_id = Permissions.account_id');
		$this->db->join('Card','Card.account_id = Account.account_id');
		$this->db->where('username', $user);
		$this->db->where('Permissions.password', $pass);
		$query = $this->db->get('Permissions')->result_array();
		if (!empty($query)) {
			return $query;
		}
		else {
			return $query = array(
				array (
					'card_id' => 'Ei ole'
				)
			);
		}
	}

	public function returnClientInfo() {
		return $this->db->get('Client')->result_array();
	}

	public function returnAccounts() {
		return $this->db->get('Account')->result_array();
	}

	public function returnAccountsMeta() {
		$this->db->select('permission_id, Account.account_id, client_id, username, password');
		$this->db->join('Account', 'Account.account_id = Permissions.account_id');
		return $this->db->get('Permissions')->result_array();
	}

	public function returnCards() {
		return $this->db->get('Card')->result_array();
	}

	public function addNewClient($data) {
		$this->db->trans_start();
		$this->db->insert('Client',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		}
		else {
			return false;
		}
	}

	public function addNewAccount($data) {
		$this->db->trans_start();
		$this->db->insert('Account',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		}
		else {
			return false;
		}
	}

	public function addNewPermission($data) {
		$this->db->trans_start();
		$this->db->insert('Permissions',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		}
		else {
			return false;
		}
	}
	
	public function addNewCard($data) {
		$this->db->trans_start();
		$this->db->insert('Card',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		}
		else {
			return false;
		}
	}

	public function updateClient($data = array(), $editId) {
		$this->db->trans_start();
		$this->db->where('client_id',$editId);
		$this->db->update('Client', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		}
		else {
			return false;
		}
	}

	public function updateAccount($data = array(), $editId) {
		$this->db->trans_start();
		$this->db->where('account_id',$editId);
		$this->db->update('Account', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		}
		else {
			return false;
		}
	}

	public function updatePermission($data = array(), $editId) {
		$this->db->trans_start();
		$this->db->where('permission_id',$editId);
		$this->db->update('Permissions', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		}
		else {
			return false;
		}
	}

	public function updateCard($data = array(), $editId) {
		$this->db->trans_start();
		$this->db->where('card_id',$editId);
		$this->db->update('Card', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === true) {
			return true;
		}
		else {
			return false;
		}
	}

	public function deleteClient($client_id) {
		$this->db->trans_begin();
		$this->db->where('client_id', $client_id);
		$this->db->delete('Client');
		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			return false;
		}
		else {
			return true;
		}
	}

	public function deleteAccount($account_id) {
		$this->db->trans_begin();
		$this->db->where('account_id',$account_id);
		$this->db->delete('Account');
		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			return false;
		}
		else {
			return true;
		}
	}

	public function deletePermission($permission_id) {
		$this->db->trans_begin();
		$this->db->where('permission_id',$permission_id);
		$this->db->delete('Permissions');
		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			return false;
		}
		else {
			return true;
		}
	}

	public function deleteCard($card_id) {
		$this->db->trans_begin();
		$this->db->where('card_id',$card_id);
		$this->db->delete('Card');
		$this->db->trans_complete();
		if ($this->db->trans_status() === false) {
			return false;
		}
		else {
			return true;
		}
	}

	public function login($username, $password) { #login script which sets sessiondata
		$accounts = $this->Verkkopankki_model->returnUserPass();
		
		$loggedIn = false;

		foreach($accounts as $account) {
			if ($account['username'] === $username) {
				if ($account['password'] === $password) { #If post input is same as one of the databases
					$loggedIn = true;
					$session = array (
						'loggedIn' => true,
						'username' => $username,
						'password' => $password
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

	public function cardLogin($cardId, $password) { #cardlogin script which sets sessiondata
		$cards = $this->Verkkopankki_model->returnCardPass();
		$loggedIn = false;

		foreach($cards as $card) {
			if ($card['card_id'] === $cardId) {
				if ($card['password'] === $password) { #If post input is same as one of the databases
					$loggedIn = true;
					$session = array (
						'cardLoggedIn' => true,
						'card_id' => $cardId,
						'cardPassword' => $password
					);
					$this->session->set_userdata($session);
					return true;
				}
			}
		}
		$this->session->set_userdata('cardLoggedIn',false);
		$this->session->set_userdata('card_id',' ');
		$this->session->set_userdata('cardPassword',' ');
		return false;
	}

	public function returnCardPass() {
		return $this->db->get('Card')->result_array();
	}

	public function returnCardInfo($id) {
		$this->db->where('card_id', $id);
		$this->db->join('Account','Account.account_id = Card.account_id');
		return $this->db->get('Card')->result_array();
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

	public function returnAccountByCard($card_id) {
		$this->db->select('balance, Account.account_id, card_id');
		$this->db->join('Account','Account.account_id = Card.account_id');
		$this->db->where('card_id', $card_id);
		return $this->db->get('Card')->result_array();
	}

	public function cardWithdraw($id, $balance) {
		$cardAcc = $this->returnAccountByCard($id);
		if (!empty($cardAcc)) {
			foreach ($cardAcc as $ca) {
				$newBalance = $ca['balance'] - $balance; 
				if ($newBalance >= 0) {
					$data = array (
						'account_id' => $ca['account_id'],
						'balance' => $newBalance
					);
					$this->db->trans_start();
					$this->db->set('balance', $newBalance);
					$this->db->where('account_id', $data['account_id']);
					$this->db->update('Account');
					$this->db->trans_complete();				

					if ($this->db->trans_status()) {
						return true;
					}
					else {
						return false;
					}	
				}
				else {	
					return false;
				}
			}
		}
		else { 
			return false;
		}
	}
}
