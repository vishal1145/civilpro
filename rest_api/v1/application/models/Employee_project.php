<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Employee_project extends CI_Model{



	/*public function all_project($data)
	{
		//print_r($data);die;
		$this->db->select('*');
		$this->db->from('project');
		$search="FIND_IN_SET ('".$data."')";
		$this->db->where($search);
		$result = $this->db->get();
		$eproject = $result->result_array();
		return $eproject;

	}*/

public function all_project_old($data)
	{
		$this->db->select('*');
		$this->db->from('time_card');
		$this->db->where($data);
		$result = $this->db->get();
		$eproject = $result->result_array();
		return $eproject;
		//print_r($eproject);die;
		/*if(empty($eproject)){
			$emply = $data['employee_id'];
			//print_r($emply);
			$this->db->select('*');
			$this->db->from('project');
			$search="FIND_IN_SET ('".$emply."',Team_member)";
			$this->db->where($search);
		
			$result1 = $this->db->get();
			$eproject1 = $result1->result_array();
			return $eproject1;
		}else{
			return $eproject;
		}*/

		
	}


	public function all_project($data)
	{  
		$emply = $data['employee_id'];
       $this->db->select('*');
			$this->db->from('project');
			$search="FIND_IN_SET ('".$emply."',Team_member)";
			$this->db->where($search);
		
			$result1 = $this->db->get();
			$eproject1 = $result1->result_array();

           return $eproject1;

/*
		$this->db->select('*');
		$this->db->from('time_card');
		$this->db->where($data);
		$result = $this->db->get();
		$eproject = $result->result_array();
		return $eproject;
		
		//print_r($eproject);die;
		if(empty($eproject)){
			$emply = $data['employee_id'];
			//print_r($emply);
			$this->db->select('*');
			$this->db->from('project');
			$search="FIND_IN_SET ('".$emply."',Team_member)";
			$this->db->where($search);
		
			$result1 = $this->db->get();
			$eproject1 = $result1->result_array();
			foreach ($eproject1 as $key => $value1) {
              $eproject1[$key]['check_type'] = 'Project_type';

			}
			return $eproject1;
		}else{
			//return $eproject;

foreach ($eproject as $key => $value1) {
$eproject[$key]['check_type'] = 'Time_type';

			}
			return $eproject;

		}
*/
		
	}


	public function assign()
	{
		$this->db->select('*');
		$this->db->from('project');
		//$this->db->where($data);
		$result = $this->db->get();
		$final  = $result->result_array();
		return $final;

	}


}

?>