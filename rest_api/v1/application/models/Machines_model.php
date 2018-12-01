<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Machines_model extends CI_Model{


public function list()
	{

		$this->db->select('*');
		$this->db->from('machine');
		//$this->db->where($data);
		$query = $this->db->get();
		$userdata = $query->result_array();
		return $userdata;
	}


}
?>