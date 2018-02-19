<?php
defined ('BASEPATH') or exit('No direct script path');
class Verkkopankki extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Verkkopankki_model');
	}

	public function loginPage() {
		$data['page'] = 'verkkopankki/loginpage';
		$data['message'] = 'Kirjaudu täyttäen kentät tili tiedoillasi';
		$this->load->view('content/content',$data);
	}

	public function cardLogin() {
		$data['page'] = 'verkkopankki/cardlogin';
		$data['message'] = 'Anna korttinumero ja sen salasana';
		$this->load->view('content/content',$data);
	}

	public function card() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->Verkkopankki_model->cardLogin($this->input->post('card_id'), $this->input->post('password'))) {
				$data['page'] = 'verkkopankki/card';
				$data['message'] = '';
				$data['cards'] = $this->Verkkopankki_model->returnCardInfo($this->input->post('card_id'));
			}
			else {
				$data['page'] = 'verkkopankki/cardlogin';
				$data['message'] = 'Virheellinen kortinnumero tai salasana';
			}
		}
		else {
			if ($this->session->has_userdata('cardLoggedIn')) {
				if ($this->Verkkopankki_model->cardLogin($this->session->userdata('card_id'), $this->session->userdata('cardPassword'))) {
					$data['page'] = 'verkkopankki/card';
					$data['message'] = '';
					$data['cards'] = $this->Verkkopankki_model->returnCardInfo($this->session->userdata('card_id'));
				}
				else {
					$data['page'] = 'verkkopankki/cardlogin';
					$data['message'] = 'Virheellinen kortinnumero tai salasana';
				}
			}	
			else {			
				$data['page'] = 'verkkopankki/cardlogin';
				$data['message'] = 'Vanha sessio, kirjaudu uudelleen';	
			}
		}
		$this->load->view('content/content',$data);
	}

	public function cardWithdraw() {
		$data['page'] = 'verkkopankki/cardwithdraw';
		$data['message'] = 'Valitse nostettava määrä ja klikkaa nosta nappia';
		$this->load->view('content/content',$data);
	}

	public function cardTransfer() {
		if ($this->session->has_userdata('card_id')) {
			if (empty($this->input->post('customBalance'))) {
				if ($this->Verkkopankki_model->cardWithdraw($this->session->userdata('card_id'), $this->input->post('balance'))) {
					$data['page'] = 'verkkopankki/cardwithdraw';
					$data['message'] = 'Onnistunut nosto, raha poistunut tililtä.';
				}
				else {
					$data['page'] = 'verkkopankki/cardwithdraw';
					$data['message'] = 'Epäonnistunut nosto, kokeile uudelleen.';
				}
			}
			else {	
				if ($this->Verkkopankki_model->cardWithdraw($this->session->userdata('card_id'), $this->input->post('customBalance'))) {
					$data['page'] = 'verkkopankki/cardwithdraw';
					$data['message'] = 'Onnistunut nosto, raha poistunut tililtä.';
				}
				else {
					$data['page'] = 'verkkopankki/cardwithdraw';
					$data['message'] = 'Epäonnistunut nosto mukautetulla summalla, Yritä uudelleen.';
				}
			}
		}
		else {
			$data['page'] = 'verkkopankki/cardlogin';
			$data['message'] = 'Vanha sessio, kirjaudu uudelleen.';
		}
		$this->load->view('content/content', $data);	
	}

	public function adminPage() {
		$data['page'] = 'verkkopankki/adminpage';
		$data['message'] = 'Asiakas- sekä tilitiedot';
		$data['clients'] = $this->Verkkopankki_model->returnClientInfo();
		$data['permissions'] = $this->Verkkopankki_model->returnAccountsMeta();
		$data['accounts'] = $this->Verkkopankki_model->returnAccounts();
		$data['cards'] = $this->Verkkopankki_model->returnCards();
		$this->load->view('content/content',$data);
	}

	public function adminAdd() {
		$data['page'] = 'verkkopankki/adminadd';
		$data['message'] = 'Lisää uutta tietoa tietokantaan.';
		$this->load->view('content/content',$data);
	}

	public function addClient() {
		$data_insert;
		if (!empty($this->input->post('client_id'))) {	
			$data_insert = array (
				'client_id' => $this->input->post('client_id'),
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname')
			);
		}
		else {
			$data_insert = array (
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname')
			);
		}
		if ($this->Verkkopankki_model->addNewClient($data_insert)) {
			$data['page'] = 'verkkopankki/adminadd';
			$data['message'] = 'Käyttäjän lisäys onnistui!';
			$this->load->view('content/content',$data);
		}
		else {
			redirect('verkkopankki/addfailure');
		}
	}

	public function addAccount() {
		$data_insert;	
		if (!empty($this->input->post('account_id'))) {
			$data_insert = array (
				'account_id' => $this->input->post('account_id'),
				'balance' => $this->input->post('balance')
			);
		}
		else {
			$data_insert = array (
				'balance' => $this->input->post('balance')
			);
		}
		if ($this->Verkkopankki_model->addNewAccount($data_insert)) {
			$data['page'] = 'verkkopankki/adminadd';
			$data['message'] = 'Tilin lisäys onnistui!';
			$this->load->view('content/content',$data);
		}
		else {
			redirect('verkkopankki/addfailure');
		}
	}

	public function addPermission() {
		$data_insert;
		if (!empty($this->input->post('permission_id'))) {
			$data_insert = array (
				'permission_id' => $this->input->post('permission_id'),
				'account_id' => $this->input->post('account_id'),
				'client_id' => $this->input->post('client_id'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			);
		}
		else {
			$data_insert = array (
				'account_id' => $this->input->post('account_id'),
				'client_id' => $this->input->post('client_id'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			);
		}
		if ($this->Verkkopankki_model->addNewPermission($data_insert)) {
			$data['page'] = 'verkkopankki/adminadd';
			$data['message'] = 'Tilin lisäys onnistui!';
			$this->load->view('content/content',$data);
		}
		else {
			redirect('verkkopankki/addfailure');
		}
	}
	
	public function addCard() {
		$data_insert;
		if (!empty($this->input->post('card_id'))) {
			$data_insert = array (
				'card_id' => $this->input->post('card_id'),
				'account_id' => $this->input->post('account_id'),
				'password' => $this->input->post('password')
			);
		}
		else {
			$data_insert = array (
				'account_id' => $this->input->post('account_id'),
				'password' => $this->input->post('password')
			);
		}
		if ($this->Verkkopankki_model->addNewCard($data_insert)) {
			$data['page'] = 'verkkopankki/adminadd';
			$data['message'] = 'Tilin lisäys onnistui!';
			$this->load->view('content/content',$data);
		}
		else {
			redirect('verkkopankki/addfailure');
		}
	}

	public function deleteClient() {
		if ($this->Verkkopankki_model->deleteClient($this->input->post('client_id')) === true) {
			redirect('verkkopankki/adminpage');
		}
		else {
			redirect('verkkopankki/deletefailure');
		}	
	}
	
	public function deleteAccount() {
		if ($this->Verkkopankki_model->deleteAccount($this->input->post('account_id')) === true) {
			redirect('verkkopankki/adminpage');
		}
		else {
			redirect('verkkopankki/deletefailure');
		}	
	}
	
	public function deletePermission() {
		if ($this->Verkkopankki_model->deletePermission($this->input->post('permission_id')) === true) {
			redirect('verkkopankki/adminpage');
		}
		else {
			redirect('verkkopankki/deletefailure');
		}	
	}
	
	public function deleteCard() {
		if ($this->Verkkopankki_model->deleteCard($this->input->post('card_id')) === true) {
			redirect('verkkopankki/adminpage');
		}
		else {
			redirect('verkkopankki/deletefailure');
		}	
	}

	public function editClient() {
		$data['page'] = 'verkkopankki/editclient';
		$data['message'] = 'Vaihda halutut kohdat ja paina "päivitä".';
		$this->load->view('content/content',$data);
	}

	public function editAccount() {
		$data['page'] = 'verkkopankki/editaccount';
		$data['message'] = 'Vaihda halutut kohdat ja paina "päivitä".';
		$this->load->view('content/content',$data);
	}

	public function editPermission() {
		$data['page'] = 'verkkopankki/editpermission';
		$data['message'] = 'Vaihda halutut kohdat ja paina "päivitä".';
		$this->load->view('content/content',$data);
	}

	public function editCard() {
		$data['page'] = 'verkkopankki/editcard';
		$data['message'] = 'Vaihda halutut kohdat ja paina "päivitä".';
		$this->load->view('content/content',$data);
	}

	public function updateAccount() {
		$data = array(
			'account_id' => $this->input->post('account_id'),
			'balance' => $this->input->post('balance')
		);
		$editId = $this->input->post('old_account_id');
		if ($this->Verkkopankki_model->updateAccount($data, $editId)) {
			redirect('verkkopankki/adminpage');
		}
		else {
			redirect('verkkopankki/updatefailure');
		}
	}

	public function updateClient() {
		$data = array(
			'client_id' => $this->input->post('client_id'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname')
		);
		$editId = $this->input->post('old_client_id');
		if ($this->Verkkopankki_model->updateClient($data, $editId)) {
			redirect('verkkopankki/adminpage');
		}
		else {
			redirect('verkkopankki/updatefailure');
		}
	}

	public function updatePermission() {
		$data = array(
			'permission_id' => $this->input->post('permission_id'),
			'account_id' => $this->input->post('account_id'),
			'client_id' => $this->input->post('client_id'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
		);
		$editId = $this->input->post('old_permission_id');
		if ($this->Verkkopankki_model->updatePermission($data, $editId)) {
			redirect('verkkopankki/adminpage');
		}
		else {
			redirect('verkkopankki/updatefailure');
		}
	}

	public function updateCard() {
		$data = array(
			'card_id' => $this->input->post('card_id'),
			'account_id' => $this->input->post('account_id'),
			'password' => $this->input->post('password')
		);
		$editId = $this->input->post('old_card_id');
		if ($this->Verkkopankki_model->updateCard($data, $editId)) {
			redirect('verkkopankki/adminpage');
		}
		else {
			redirect('verkkopankki/updatefailure');
		}
	}

	public function updateFailure() {
		$data['page'] = 'verkkopankki/editfailure';
		$data['message'] = '';
		$this->load->view('content/content', $data);
	}

	public function addFailure() {
		$data['page'] = 'verkkopankki/addfailure';
		$data['message'] = '';
		$this->load->view('content/content', $data);
	}

	public function deleteFailure() {
		$data['page'] = 'verkkopankki/deletefailure';
		$data['message'] = '';
		$this->load->view('content/content',$data);
	}
		
	public function home() {
		$data['page'] = 'verkkopankki/home';
		$data['message'] = '';
		$this->load->view('content/content',$data);
	}

	public function logout() {
		$data['page'] = 'verkkopankki/loginpage';
		$data['message'] = 'Kirjauduttiin ulos onnistuneesti';
		$this->session->unset_userdata('loggedIn');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		$this->load->view('content/content',$data);
	}

	public function cardLogout() {
		$data['page'] = 'verkkopankki/cardlogin';
		$data['message'] = 'Kirjauduttiin ulos onnistuneesti';
		$this->session->unset_userdata('cardLoggedIn');
		$this->session->unset_userdata('card_id');
		$this->session->unset_userdata('cardPassword');
		$this->load->view('content/content',$data);
	}

	public function accountTransfer() {
		$data['page'] = 'verkkopankki/accountTransfer';
		$data['message'] = 'Lähetä rahaa';
		$this->load->view('content/content',$data);
	}

	public function transfer() {
		$id;
		foreach ($this->Verkkopankki_model->returnAccountInformation($this->session->userdata('username'), $this->session->userdata('password')) as $account) {
			$id = $account['account_id'];
		}

		if ($this->Verkkopankki_model->lookForAccount($this->input->post('account_id'))) {
			if ($this->Verkkopankki_model->lookForBalance($id, $this->input->post('balance'))) {
				if ($this->Verkkopankki_model->transfer($id, $this->input->post('account_id'), $this->input->post('balance'))) {
					$data['message'] = 'Onnistunut siirto!';
				}
				else {
					$data['message'] = 'Siirtovirhe... rollingback...';
				}
			}
			else {
				$data['message'] = 'Tilisi kate ei riitä...';
			}
		}
		else {
			$data['message'] = 'Ei löytynyt annettua tiliä...';
		}
		$data['page'] = 'verkkopankki/accountTransfer';
		$this->load->view('content/content',$data);
	}

	public function account() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {	
			if (!$this->Verkkopankki_model->login($this->input->post('username'), $this->input->post('password'))) {
				$data['page'] = 'verkkopankki/loginpage';
				$data['message'] = 'Väärä käyttäjänimi tai salasana...';
			}
			else {
				$data['page'] = 'verkkopankki/account';
				$data['message'] = '';
				$data['account'] = $this->Verkkopankki_model->returnAccountInformation
					($this->input->post('username'), $this->input->post('password'));
				$data['cards'] = $this->Verkkopankki_model->returnAccountCards($this->input->post('username'), $this->input->post('password'));
			}
		}
		else {
			if ($this->session->has_userdata('loggedIn')) {
				$data['page'] = 'verkkopankki/account';
				$data['message'] = '';
				$data['account'] = $this->Verkkopankki_model->returnAccountInformation
					($this->session->userdata('username'), $this->session->userdata('password'));
				$data['cards'] = $this->Verkkopankki_model->returnAccountCards($this->session->userdata('username'), $this->session->userdata('password'));
			}	
			else {
					$data['page'] = 'verkkopankki/loginpage';
					$data['message'] = 'Vanha sessio kirjaudu uudelleen...';
			}
		}
		$this->load->view('content/content',$data);
	}
}
