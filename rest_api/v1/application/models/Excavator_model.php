<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Excavator_model extends CI_Model{
	

	public function new_field($timecard)
	{
		$query = $this->db->insert('excavator',$timecard);
		//print_r($query);die('test');
		$insert_id = $this->db->insert_id();

   		return  $insert_id;
   	}


   	public function get_field($data_value)
	{
		$this->db->select('*');
		$this->db->from('excavator');
		$this->db->where($data_value);
		$value = $this->db->get();
		$log = $value->result_array();
		return $log;
   	}


}

?>