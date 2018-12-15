<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class View_projects_old extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('Employee_project');
	}
	public function index(){
		echo "Hello";
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

			$query = $this->Employee_project->all_project_old($data);
			
			if(!empty($query))
			{
						
				//print_r($query);die;
					

				foreach ($query as $key => $value1) {
					$time_project = $value1;

				// print_r($time_project);die;

				$pname = array('Project_id' => $time_project['project_name']);

			  $pro_name =	$this->db->select('*');
							$this->db->from('Project');
							$this->db->where($pname);
							$result = $this->db->get();
							$projectname = $result->result_array();

							//print_r($projectname);die;
					

					foreach ($projectname as $key => $value2) {
						$total_time = $value2['Total_hours'];
						$consumption = $value2['consumption'];
					}

					if(isset($value2)){
					$client_name = array('id' => $value2['Client_id']);

							$this->db->select('*');
							$this->db->from('Client');
							$this->db->where($client_name);
							$result   = $this->db->get();
							$final_2  = $result->result_array();
							foreach ($final_2 as $key => $val_final) {
								$client = $val_final['user_name'];
							}

						}
				//print_r($final_2);die;

							


				$time_project1[] = array(
							'time_card_id' => $value1['id'],
							'project_id'   => $value1['project_name'],
							'project_name' => $projectname[0]['Project_name'],
							'client_name'  => $client,
							'employee_id'  => $value1['employee_id'],
							'deadline' 	   => $value1['deadline'],
							'total_hours'  => $total_time,
							'remain_hours' => $value1['remain_hours'],
							'work_type'	   => $value1['work_type'],
							'card_date'    => $value1['card_date'],
							//'hours' 	   => $value1['hours'],
							'description'  => $value1['description'],
							'status' 	   => $value1['status'],
							'machine' 	   => $value1['machine'],
							'machine_hours'=> $value1['machine_hours'],
							//'material_amount'=> $material_amount,
							//'consumption'  => $consumption,
							'created_date' => $value1['created_date'],
							);


				}

				

				


				$result = array(

					'status'	  => '1',
					'statuscode'  => '200',
					'message'	  => 'All employee related projects!',
					'project'	  => $time_project1,	

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