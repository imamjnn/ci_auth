<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usersession_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->table = 'user_session';
    }

    function checkToken($token){
		$this->db->where('token', $token);
		$query = $this->db->get('user_session');
		if(!$query->num_rows()){
			return false;
		}else{
			return true;
		}
	}

}