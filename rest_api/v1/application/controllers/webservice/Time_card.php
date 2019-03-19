<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Time_card extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->model('Timecard_model');
		$this->load->database();
	}

	
	public function new_time_card()
	{

		$this->form_validation->set_rules('timecard_project_id','timecard_project_id','trim|required|numeric');
		$this->form_validation->set_rules('timecard_employee_id','timecard_employee_id','trim|required|numeric');
		$this->form_validation->set_rules('deadline','deadline','trim|required');
		$this->form_validation->set_rules('remain_hours','remain_hours','trim|required|numeric');
		$this->form_validation->set_rules('timecard_worktype','timecard_worktype','trim|required');
		$this->form_validation->set_rules('timecard_issue_date','timecard_issue_date','trim|required');
		$this->form_validation->set_rules('timecard_workhours','timecard_workhours','trim|required|numeric');
		$this->form_validation->set_rules('description','description','trim|required');
		$this->form_validation->set_rules('task_id','task_id','trim|required');

		if(empty($_POST['timecard_machinelist_id'])){
		$this->form_validation->set_rules('timecard_machinelist_id','timecard_machinelist_id','trim|required');
		}
		if(empty($_POST['machine_hour'])){
			$this->form_validation->set_rules('machine_hour','machine_hour','trim|required|numeric');
		}
	if(!empty($_POST['timecard_machinelist_id']) && !empty($_POST['machine_hour']))	{
	$total_Machine	= count($_POST['timecard_machinelist_id']);
	$total_Machine_hour	= count($_POST['machine_hour']);
		//$this->form_validation->set_rules('hours','hours','trim|required');
	if($total_Machine !== $total_Machine_hour){

$this->form_validation->set_rules('both_same','timecard machinelist and hour are not equal ','trim|required');
	}
}


		if($this->form_validation->run() == FALSE)
		{
			$error = strip_tags(validation_errors());
			$result = array(

					'status'	 => '0',
					'statuscode' => '403',
					'msg'		 => $error

			);
			print_r(json_encode($result));
		}
		else{

			
               $total_machin = '';
                foreach($_POST['timecard_machinelist_id'] as $key=>$val){
					if(isset($val) && $val !="")
						 $total_machin.=$val.",";
					  }
				    $total_machin = rtrim($total_machin, ',');

			    $total_machinhour = '';
                foreach($_POST['machine_hour'] as $key=>$val){
					if(isset($val) && $val !="")
						 $total_machinhour.=$val.",";
					  }
				    $total_machinhour = rtrim($total_machinhour, ',');

				    //echo $total_machin;
              
       			

			$project_name  = $this->input->post('timecard_project_id');
			$employee_name = $this->input->post('timecard_employee_id');
			$deadline      = $this->input->post('deadline');
			$remain_hours  = $this->input->post('remain_hours');
			$worktype 	   = $this->input->post('timecard_worktype');
			$issue_date    = $this->input->post('timecard_issue_date');
			$workhours 	   = $this->input->post('timecard_workhours');
			$description   = $this->input->post('description');
			$task_id       = $this->input->post('task_id');
			
			$machinelist   = $total_machin;
			$machine_hour  = $total_machinhour;


			$currnt_date = date("Y-m-d");
			$timecard = array(

				'project_name'  => $project_name,
				'employee_id'	=> $employee_name,
				'deadline'		=> $deadline,
				'remain_hours'	=> $remain_hours,
				'work_type' 	=> $worktype,
				'card_date'		=> $issue_date,
				'hours' 		=> $workhours,
				'description' 	=> $description,
				'machine' 		=> $machinelist,
				'machine_hours'	=> $machine_hour,
				'created_date'	=> $currnt_date,
				'taskid'	    => $task_id,
				

				);

			//echo $currnt_date;

			$_data = array(
					'employee_id'	=> $employee_name,
					'project_name'  => $project_name,
					'created_date'  => $currnt_date,
				);


			 $get_result = $this->Timecard_model->time_result($_data);
			 //print_r($get_result);die;
			 if(!empty($get_result)){

			 	$result = array(

					'status'	 => '0',
					'statuscode' => '403',
					'msg'		 => 'You submitted timecard already today!'
			 	);
			 	print_r(json_encode($result));
			 }else{
			 

			 $query = $this->Timecard_model->new_time_value($timecard);
			
				$timecard_id = array('id' => $query);
				$data = $this->Timecard_model->get_time_value($timecard_id);
				//print_r($data);

				$result = array(

							'status'	 => '1',
							'statuscode' => '200',
							'msg'		 => 'Time Card update Successfully',
							'id'		 => $data[0]['id'],
							'timecard_project_id'   => $data[0]['project_name'],
							'timecard_employee_id'  => $data[0]['employee_id'],
							'deadline'				=> $data[0]['deadline'],
							'remain_hours'			=> $data[0]['remain_hours'],
							'timecard_worktype' 	  => $data[0]['work_type'],
							'timecard_issue_date'     => $data[0]['card_date'],
							'timecard_workhours' 	  => $data[0]['hours'],
							'timecard_machinelist' 	  => $data[0]['machine'],
							'machine_hours'			  => $data[0]['machine_hours'],

				);
				print_r(json_encode($result));
			}
			

		}
	}




}


?>