<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Field_model extends CI_Model{

	public function new_field($field_detail)
	{
		$query = $this->db->insert('field_report',$field_detail);
		$insert_id = $this->db->insert_id();
		//print_r($insert_id);die('test');

   		return  $insert_id;
	}

	public function field_record($final)
	{	

		$this->db->select('*');
		$this->db->from('field_report');
		$this->db->where($final);
		$value = $this->db->get();
		$timedata = $value->result_array();
		return $timedata;
	
	}

}


?>