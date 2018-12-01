<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class View_projects extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('Employee_project');
	}


	public function project()
	{

		$this->form_validation->set_rules('employee_id','employee_id','trim|required');
		$this->form_validation->set_rules('employee_name','employee_name','trim');

		if($this->form_validation->run() == FALSE)
		{
			$error = strip_tags(validation_errors());
			$result = array(

					'status'	=> '0',
					'statuscode'=> '403',
					'msg'	    => $error,
			);
			print_r(json_encode($result));
		}else{

			$eid = $this->input->post('employee_id');
			$ename = $this->input->post('employee_name');

			$data = array('employee_id' => $eid);

			$query = $this->Employee_project->all_project($data);
			
			if(!empty($query))
			{
						
				//print_r($query);die;
					

				foreach ($query as $key => $value1) {
            
				 $client_name = array('id' => $value1['Client_id']);

				           $this->db->select('*');
							$this->db->from('client');
							$this->db->where($client_name);
							$result   = $this->db->get();
							$final_2  = $result->result_array();

 
				//print_r($query[$key]['Start_date']);die;
				$query[$key]['project_id'] = $query[$key]['Project_id'];
				$query[$key]['project_name'] = $query[$key]['Project_name'];
				$query[$key]['client_id']	 = $query[$key]['Client_id'];
				$query[$key]['client_name']	 = $final_2[0]['user_name'];
				$query[$key]['total_hours']	 = $query[$key]['Total_hours'];
				$query[$key]['rate']	 	 = $query[$key]['Rate'];
				$query[$key]['priority']	 = $query[$key]['Priority'];
				$query[$key]['project_leader']= $query[$key]['Project_leader'];
				$query[$key]['project_address']= $query[$key]['Project_Address'];
				$query[$key]['time_card_id'] = '';
				$query[$key]['remain_hours'] = '';
				$query[$key]['employee_id']  = $eid;
				$query[$key]['work_type'] 	 = '';
				$query[$key]['machine_hours']= '';
				$query[$key]['card_date']	 = $query[$key]['Start_date'];
				$query[$key]['deadline']	 = $query[$key]['end_date'];
				$query[$key]['deadline']	 = $query[$key]['end_date'];
				$query[$key]['created_date'] = '';
				unset($query[$key]['Project_id']);
				unset($query[$key]['Project_name']);
				unset($query[$key]['Client_id']);
				unset($query[$key]['Total_hours']);
				unset($query[$key]['Start_date']);
				unset($query[$key]['end_date']);
				unset($query[$key]['Rate']);
				unset($query[$key]['Priority']);
				unset($query[$key]['Project_leader']);
				unset($query[$key]['Project_Address']);


					$proj_idd = array('project_name' => $query[$key]['project_id']);
						//print_r($proj_idd);die;
						$emp_idd = array('employee_id' => $eid);
						//print_r($emp_idd);die('test');
								$this->db->select('*');
								$this->db->from('time_card');
								$this->db->where($proj_idd);
								$this->db->where($emp_idd);
								$result   = $this->db->get();
								$finals_2  = $result->result_array();
								
							if(isset($finals_2)){
								foreach ($finals_2 as $key_time => $final_2) {
								
									$query[$key]['time_card_id'] = $final_2['id'];
									$query[$key]['remain_hours'] = $final_2['remain_hours'];
									$query[$key]['work_type'] 	 = $final_2['work_type'];
									$query[$key]['machine_hours']= $final_2['machine_hours'];
									$query[$key]['created_date'] = $final_2['created_date'];
								}
							}
				
			}

/*print_r($query);
die;*/
				/*$pname = array('Team_member' => $time_project[$key]['project_name']);

			  $pro_name =	$this->db->select('*');
							$this->db->from('project');
							$this->db->where($pname);
							$result = $this->db->get();
							$projectname = $result->result_array();*/

							//print_r($projectname);die;
					

					/*foreach ($time_project as $key => $value2) {
						$total_time = $value2['Total_hours'];
						$consumption = $value2['consumption'];
						//print_r($value2);die;
					}*/

					$client_name = array('id' => $query[$key]['client_id']);

							$this->db->select('*');
							$this->db->from('client');
							$this->db->where($client_name);
							$result   = $this->db->get();
							$final_2  = $result->result_array();
							foreach ($final_2 as $key => $val_final) {
								$client = $val_final['user_name'];
							}

					

							
							//print_r($value1);die;

				


				

				

				


				$result = array(

					'status'	  => '1',
					'statuscode'  => '200',
					'message'	  => 'All employee related projects!',
					'project'	  => $query,	

				);
				print_r(json_encode($result));
			}else{

				$result = array(

					'status'	  => '0',
					'statuscode'  => '403',
					'message'	  => 'No project assign to this employee.',
					

				);
				print_r(json_encode($result));
			}


		}

	}



	//Project assign Start here


	public function project_assign(){

		
			$query = $this->Employee_project->assign();
			//print_r($query);die;

			if(!empty($query)){

				if(isset($query) && !empty($query)){
					foreach ($query as  $key => $pro_result) {
					$pro_result['Team_member'];
					$array_value = $pro_result['Team_member'];
					$array =  explode(',', $array_value);

						
						foreach($array as $value_data){

						  $this->db->select('*');
									$this->db->from('employee');
									$this->db->where('empl_id',$value_data);
									$result   = $this->db->get();
									$query2  = $result->result();
									//$query[$key]['employee_2'][] = $result->result();

									foreach ($query2 as  $val_emp2) {
										
											$emp_idd = $val_emp2;
										
									}
							$query[$key]['employee_2'][] = $emp_idd;
								
			 			}
	 			
					
					}
				}
					/*print_r($query);
					die;*/

				


	 			
	 			


	 			
	 			if(isset($query) and !empty($query)){
					foreach ($query as $key => $projects) {
						$project_detail[$key]['project_id'] = $projects['Project_id'];
						$project_detail[$key]['project_name'] = $projects['Project_name'];
						
						$project_detail[$key]['employee'] = $query[$key]['employee_2'];
						

						$query3 = $this->db->select('*');
								$this->db->from('time_card');
								$this->db->where('project_name',$project_detail[$key]['project_id']);
								$this->db->order_by('id','desc');
								$this->db->limit(1);
								$result   = $this->db->get();
								$final2  = $result->result_array();

							if(isset($final2)){
								foreach ($final2 as $final_val_hour) {
									$final_result_hour = $final_val_hour['remain_hours'];
								}
							}
					
					$project_detail[$key]['hour'] = $final_result_hour;
								
								
					}
				}
				

					$result = array(

							'status'	   => '1',
							'statuscode'   => '200',
							'message'	   => 'project detail.',
							'project'      => $project_detail,
							
					);
					print_r(json_encode($result));
				}else{

					$result = array(

							'status'	   => '0',
							'statuscode'   => '403',
							'message'	   => 'project id not valid.',
							
					);
					print_r(json_encode($result));

				}
			

			
		
	}



//Project assign end here
	





	public function project_member(){

		$this->form_validation->set_rules('project_id','project_id','trim|required');

		if($this->form_validation->run() == FALSE){
			$error = strip_tags(validation_errors());

			$result = array(

				'status'	 => '0',
				'statuscode' => '403',
				'message'	 => $error,
			);
			print_r(json_encode($result));
		}

		else{

			$project_id = $_POST['project_id'];
			$data = array('Project_id' => $project_id);

			$query = $this->Employee_project->assign($data);
			//print_r($query);

			$employe['Team_member'] = $query[0]['Team_member'];
			$array_value = $employe['Team_member'];
			$array =  explode(',', $array_value);
			

			foreach($array as $value_data){

			  $query2 = $this->db->select('*');
						$this->db->from('employee');
						$this->db->where('empl_id',$value_data);
						$result   = $this->db->get();
						$final[]  = $result->result_array();
 			}
 			
 			foreach ($final as $key => $val) {
 				
				foreach ($val as $key2 => $final_val) {
					
                   
					$final_data2[]= $final_val;						

					
				}
 			}
 			/*print_r($final_data2);
 			die;*/

				if(!empty($query))
				{

					$result = array(

							'status'	   => '1',
							'statuscode'   => '200',
							'message'	   => 'project detail.',
							'Project_id'   => $query[0]['Project_id'],
							'Project_name' => $query[0]['Project_name'],
							'Team_member'  => $final_data2,
					);
					print_r(json_encode($result));
				}
			

			
		}
	}


}


?>