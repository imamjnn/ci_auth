<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('Theme', '', 'theme');
		$this->load->model('User_model', 'User');
		$this->load->model('Usersession_model', 'USession');
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
		$decod = json_decode(file_get_contents("php://input"));
		// $username = $decod->username;
		// $password =	$decod->password;

		$username = $this->input->post('username');
		$password =	$this->input->post('password');

		$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);

		// encryp password
		$hash_pass = password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);

		$user = $this->User->getBy(['username'=>$username]);
		if($user)
			$check_pass = password_verify($password, $user->password);
		$check_user = $this->User->checkUsername($username);

		if($check_user == true && $check_pass == true){
			$sess_data = array('id'=>$user->id, 'username'=>$user->username);
			$sess_key = $this->session->set_userdata($sess_data);
			$token = password_hash($user->username, PASSWORD_BCRYPT, ['cost'=>10]);
			$sess_save = $this->USession->create(['user'=>$user->id, 'token' => $token, 'ip'=>$ip]);
			
			$result['status'] = 'success';
			$result['message'] = 'Login success.';
						
		}else{
			$result['status'] = 'failed';
			$result['message'] = 'Invalid username or password.';
		}

		echo json_encode($result);

	}
}
