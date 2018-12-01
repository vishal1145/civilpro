<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Project extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('Project_detail');
	}


	public function project_list()
	{
		$this->form_validation->set_rules('project_id', 'project_id', 'trim|required');
		//die('here');
		if($this->form_validation->run() == FALSE)
		{
			$error = strip_tags(validation_errors());
			$result = array(

					'status'	=> '0',
					'statuscode'=> '403',
					'msg'		=> $error,
				);
			print_r(json_encode($result));
		}else{

					$project_id = $this->input->post('project_id');
					$data = array('Project_id' => $project_id);

				
			$query = $this->Project_detail->project_result($project_id);

			if(!empty($query)){

				print_r($query);die;
				foreach ($query as $key => $projecy_records) {
					
					$material = $projecy_records['material'];
					$abc  = explode(',', $material);
					$total_id = count($abc);
					//print_r($material);

						for($i=0; $i < $total_id; $i++) { 
							
							$material_id = array('id' => $abc[$i]);
							//print_r($material_id);
							$this->db->select('*');
							$this->db->from('material');
							$this->db->where($material_id);
							$result = $this->db->get();
							$material_detail[] = $result->result_array();
							//print_r($material_detail);

						}
				}
				die;
					
				

			}


		}




	}













	/*public function project_list()
	{
		$this->form_validation->set_rules('project_id', 'project_id', 'trim|required');
		//die('here');
		if($this->form_validation->run() == FALSE)
		{
			$error = strip_tags(validation_errors());
			$result = array(

					'status'	=> '0',
					'statuscode'=> '403',
					'msg'		=> $error,
				);
			print_r(json_encode($result));
		}else{

			$project_id = $this->input->post('project_id');
			$data = array('Project_id' => $project_id);

				
			$query = $this->Project_detail->project_result($project_id);

			if(!empty($query)){

				//print_r($query);
			
			$material_data = '';
			$material_detail = '';
			$employee_data = array();
			foreach ($query as $key => $value1) {

				$material = $value1['material'];
				$abc  = explode(',', $material);
				$total_id = count($abc);
				//print_r($abc);
				//print_r($total_id);
					



					if(isset($value1['empl_id']) && !empty($value1['empl_id'])){
				
				$consumption = $value1['consumption'];
				$consump 	 = explode(',', $consumption);
					$employee_data[] = array('employee_id' => $value1['empl_id'],'employee_name' => $value1['username']);

					for ($i=0; $i < $total_id; $i++) { 
						///print_r($abc[$i]);
						$material_id = array('id' => $abc[$i]);
						$this->db->select('*');
						$this->db->from('material');
						$this->db->where($material_id);
						$result = $this->db->get();
						if(!empty($result)){
							$material_detail[] = $result->result_array();
						
						}
						//unset($result);
						

					}

					//print_r($abc);die;
					
				}
				
			}

			
						$end_date = strtotime($value1['end_date']); 
						$start_date = strtotime($value1['Start_date']);
						$day = $end_date - $start_date;										
						$cuurentdate = date('Y-m-d');
						$totalday = ceil(abs($end_date - $start_date) / 86400);
						if($value1['end_date'] <= $cuurentdate){
							$perday = 100;
						}else{
							$perday = round(100/$totalday);
						}
									
			
			//print_r($abc);die;
				if(isset($consump) && !empty($consump)){	
					foreach ($consump as $key_one => $consumption_val) {
							$final_consumption[]['consumption'] =  $consumption_val;
						}
				
				
			

				$total_id = count($abc);
				for ($i=0; $i < $total_id; $i++) { 
					//print_r($abc);
					$material_id = array('id' => $abc[$i]);
					$this->db->select('*');
					$this->db->from('material');
					$this->db->where($material_id);
					$result = $this->db->get();
					$material_detail[] = $result->result_array();
				}
			


			$material_amount = '';
			$material_data = '';
			foreach ($material_detail as $key1 => $value2) {


				foreach ($value2 as $key2 => $value3) {
//print_r($value3);
					//$value2[$key2]['consumption'] =  $final_consumption[$key1]['consumption'];	

					//print_r($final_consumption[$key1]['consumption']);

				
					$material_data[] = array(
										'material_id' => $value3['id'],
										'material_name' => $value3['materials_name'],
										'material_amount' => $value3['amount'],
										'consumption' => '',
									);
				
					
				}
					


				
			}
		}

					$client_name = array('id' => $value1['Client_id']);

							$this->db->select('*');
							$this->db->from('client');
							$this->db->where($client_name);
							$result   = $this->db->get();
							$final_2  = $result->result_array();
							foreach ($final_2 as $key => $val_final) {
								$client = $val_final['user_name'];
							}
				
				//unset($query[0]['status']);
							
				$result = array(

					'status'	 => '1',
					'statuscode' => '200',
					'msg'		 => 'Project detail!',
					'Project_id' => $query[0]['Project_id'],
					'Project_name'=>$query[0]['Project_name'],
					'client_name'=> $client,
					'Start_date' => $query[0]['Start_date'],
					'end_date'	 => $query[0]['end_date'],
					'total_hour' => $value1['Total_hours'],
					'Rate'	     => $query[0]['Rate'],
					'billing_type'=> $query[0]['billing_type'],
					'Priority'	 => $query[0]['Priority'],
					'Project_leader'=>$query[0]['Project_leader'],
					'Team_member' => $query[0]['Team_member'],
					'Project_Address'=> $query[0]['Project_Address'],
					'machine' 	 => $query[0]['machine'],
					//'material' 	 => $query[0]['material'],
					'material_detail'=> $material_detail,
					
					'decription' => $query[0]['decription'],
					'images' 	 => "http://$_SERVER[HTTP_HOST]/civilpro/Upload/project/".$query[0]['images'],
					'project_status' => $query[0]['project_status'],
					'progress'	=> $perday,
					'employee_detail' => $employee_data,
					
				);
				//print_r($result);die;
				print_r(json_encode($result));
			}
			else{
//die('here');
				$result = array(

					'status'	 => '0',
					'statuscode' => '403',
					'msg'		 => 'Project not found!',
					
				);
				print_r(json_encode($result));
			}	
		}

	}*/



}


?>