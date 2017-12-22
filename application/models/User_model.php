<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->table = 'user';
    }

    function check($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get('user');
	}

	function checkUsername($username){
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		if(!$query->num_rows()){
			return false;
		}else{
			return true;
		}
	}

}