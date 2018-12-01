<?php

Class Timecard_model extends CI_Model{

	public function new_time_value($data)
	{

		//print_r($data);
		$query = $this->db->insert('time_card',$data);
		$insert_id = $this->db->insert_id();

   		return  $insert_id;
	}



	public function get_time_value($timecard_id)
	{	

		$this->db->select('*');
		$this->db->from('time_card');
		$this->db->where($timecard_id);
		$value = $this->db->get();
		$timedata = $value->result_array();
		return $timedata;
	
	}

	public function time_result($_data)
	{
		$this->db->select('*');
		$this->db->from('time_card');
		$this->db->where($_data);
		$get_data = $this->db->get();
		$final = $get_data->result_array();
		return $final;
	}


}

?>