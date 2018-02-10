<?php
defined ('BASEPATH') or exit('No direct script path');
class Verkkopankki extends CI_Controller {

	public function loginPage() {
		$data['page'] = 'verkkopankki/loginpage';
		$data['message'] = 'Kirjaudu täyttäen kentät tili tiedoillasi';
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

	public function accountTransfer() {
		$data['page'] = 'verkkopankki/accountTransfer';
		$data['message'] = 'Lähetä rahaa';
		$this->load->view('content/content',$data);
	}

	public function transfer() {
		$this->load->model('Verkkopankki_model');
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
		$this->load->model('Verkkopankki_model');
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
			}
		}
		else {
			if ($this->session->has_userdata('loggedIn')) {
				if (!$this->session->userdata('loggedIn')) {

				}
				else {
					$data['page'] = 'verkkopankki/account';
					$data['message'] = '';
					$data['account'] = $this->Verkkopankki_model->returnAccountInformation
					($this->session->userdata('username'), $this->session->userdata('password'));
				}
			}	
			else {
					$data['page'] = 'verkkopankki/loginpage';
					$data['message'] = 'Vanha sessio kirjaudu uudelleen...';
			}
		}
		$this->load->view('content/content',$data);
	}
}
