<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('Theme', '', 'theme');
		$this->load->model('User_model', 'User');
	}
	
	public function index() {
		$this->load->view('auth');
	}

	public function login() {
		$this->load->view('login');
		deb($this->session->userdata());
	}

	public function logout() {
		$this->session->sess_destroy();
	}

	public function check_login() {
		$username = 'root';
		$password = 'jnn007';

		//$key = $this->config->item('encryption_key');
		//$hash_pass = hash('sha512', $key. $password);
		$hash_pass = password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);
		$check_pass = password_verify($password, $hash_pass);
		$check_user = $this->User->checkUsername($username);
		//deb($check_user);
		if($check_user == true){
			$user = $this->User->getBy(['username'=>$username]);
			$sess_data = array('id'=>$user->id, 'username'=>$user->username);
			$sess_key = $this->session->set_userdata($sess_data);
			$check_pass = password_verify($password, $user->password);
			if($check_pass == true){
				$result['code'] = 200;
				$result['type'] = 'success';
			}else{
				$result['code'] = 400;
				$result['type'] = 'failed';
				$result['message'] = 'Invalid username or password';
			}
			//deb($check_pass);
			
		}else{
			$result['code'] = 404;
			$result['type'] = 'failed';
			$result['message'] = 'Invalid username or password';
		}

		echo json_encode($result);

		// deb($check_pass);
	}
}
