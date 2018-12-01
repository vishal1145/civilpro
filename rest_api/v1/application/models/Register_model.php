<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model{


// register 

	public function register_user($data_sub){

		$query = $this->db->insert('employee',$data_sub);
		return $query;
	}


// login 

	public function login_user($data_fet)
	{
		
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where($data_fet);
		$query= $this->db->get();
		$userData = $query->result_array();
		//print_r($userData);
		return $userData;
	}



// otp

	public function otp_manage($data)
	{
		$query = $this->db->insert('users',$data);
		return $query;
	}



}



  ?>