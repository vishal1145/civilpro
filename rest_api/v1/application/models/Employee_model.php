<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Employee_model extends CI_Model{


	public function register_user($data)
	{
		$query = $this->db->insert('users',$data);

		return $query;
	}



	public function login($data)
	{

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($data);
		$query = $this->db->get();
		$userdata = $query->result_array();
		return $userdata;
	}

	
}


?>