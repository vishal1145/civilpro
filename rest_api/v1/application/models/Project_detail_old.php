<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Project_detail_old extends CI_Model{


	public function project_result($data)
	{
		$this->db->select('*');
		$this->db->from('Project');
		$this->db->where($data);
		$this->db->join('time_card', 'project.Project_id = time_card.project_name');
		$this->db->join('employee', 'time_card.employee_id = employee.empl_id');
		$detail = $this->db->get();
		$final  = $detail->result_array();
		if(!empty($final)){

			return $final;
		}else{
			$this->db->select('*');
			$this->db->from('Project');
			$this->db->where($data);
			$detail = $this->db->get();
			$final  = $detail->result_array();
			return $final;
		}
	}
//$this->db->join('tbl_usercategory','tbl_usercategory.usercategoryid=tbl_user.usercategoryid');

}

?>