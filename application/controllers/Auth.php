<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('Theme', '', 'theme');
	}
	
	public function index()
	{
		$this->load->view('auth');
	}
}
