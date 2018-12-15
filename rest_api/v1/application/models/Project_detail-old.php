<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Project_detail extends CI_Model{


	public function project_result($data)
	{
		$this->db->select('*, project.status as project_status');
		$this->db->from('Project');
		$this->db->join('time_card', 'project.Project_id = time_card.project_name');
		$this->db->join('employee', 'time_card.employee_id = employee.empl_id');
		$this->db->where('project.Project_id',$data);
		$detail = $this->db->get();
		$final  = $detail->result_array();
		if(!empty($final)){
			
			return $final;
		}else{
			$this->db->select('*, project.status as project_status');
			$this->db->from('Project');
			$this->db->where('project.Project_id',$data);
			$detail2 = $this->db->get();
			$final2  = $detail2->result_array();
			
			return $final2;
		}
	}
			//$this->db->join('employee', 'project.Team_member = employee.empl_id');
//$this->db->join('tbl_usercategory','tbl_usercategory.usercategoryid=tbl_user.usercategoryid');

}

?>