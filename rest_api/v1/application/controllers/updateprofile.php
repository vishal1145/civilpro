<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class updateprofile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('Employee_project');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function test()
	{
		$emp_id = $this->input->get_post('emp_id', TRUE);
		$firstname= $this->input->get_post('task_id', TRUE);
		$lastname= $this->input->get_post('task_name', TRUE);
		$image= $this->input->get_post('task_name', TRUE);
		$hourlyrate= $this->input->get_post('task_name', TRUE);
		
		$this->form_validation->set_rules('emp_id','emp_id','trim|required');
		$this->form_validation->set_rules('firstname','firstname','trim|required');
		$this->form_validation->set_rules('lastname','lastname','trim|required');
		$this->form_validation->set_rules('image','image','trim|required');
		$this->form_validation->set_rules('hourlyrate','hourlyrate','trim|required');


		if($this->form_validation->run() == FALSE)
		{
			$error = strip_tags(validation_errors());
			$result = array(

					'status'	 => '0',
					'statuscode' => '403',
					'msg'		 => $error

			);
			echo (json_encode($result));
		}else {

        $arr = array();

		header('Content-Type: application/json');
		echo json_encode( $arr );
		}
    }
    
    public function get_all_task()
	{
	

        $query = $this->db->query("select * from project_tasks");
        $arr =  $query->result_array();
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	public function updateprofile()
	{
		$emp_id = $this->input->get_post('emp_id', TRUE);
		$firstname= $this->input->get_post('firstname', TRUE);
		$lastname= $this->input->get_post('lastname', TRUE);
		$image= $this->input->get_post('image', TRUE);
		$hourlyrate= $this->input->get_post('hourlyrate', TRUE);
		
		$this->form_validation->set_rules('emp_id','emp_id','trim|required');
		$this->form_validation->set_rules('firstname','firstname','trim|required');
		$this->form_validation->set_rules('lastname','lastname','trim|required');
		$this->form_validation->set_rules('image','image','trim|required');
		$this->form_validation->set_rules('hourlyrate','hourlyrate','trim|required');


		if($this->form_validation->run() == FALSE)
		{
			$error = strip_tags(validation_errors());
			$result = array(

					'status'	 => '0',
					'statuscode' => '403',
					'msg'		 => $error

			);
			header('Content-Type: application/json');
			echo (json_encode($result));
		}
		else {
        $this->db->query("UPDATE employee set first_name='$firstname', last_name='$lastname' ,img='$image' , hourly_rate=$hourlyrate WHERE empl_id=$emp_id");
		
		$query = $this->db->query("select first_name , last_name ,img , hourly_rate from employee WHERE empl_id=$emp_id");
	

		$arr =  $query->result_array();
			
			$result = array(

				'status'	 => '1',
				'record'     => $arr[0]
			);

			header('Content-Type: application/json');
			echo json_encode( $result);
		}
	}

	public function setnotification()
	{
		$emp_id = $this->input->get_post('emp_id', TRUE);
		$notification_status = $this->input->get_post('noti_status', TRUE);
		$this->form_validation->set_rules('emp_id','emp_id','trim|required');
		$this->form_validation->set_rules('noti_status','noti_status','trim|required');
		// $dis_date = $this->input->get_post('dispatch_date', TRUE);
		// $this->form_validation->set_rules('dispatch_date','dispatch_date','trim|required');
		//$task_id= $this->input->get_post('id', TRUE);
		// $task_name= $this->input->get_post('task_name', TRUE);
		// $task_dec= $this->input->get_post('task_discription', TRUE);
		if($this->form_validation->run() == FALSE)
		{
			$error = strip_tags(validation_errors());
			$result = array(

					'status'	 => '0',
					'statuscode' => '403',
					'msg'		 => $error

			);
			header('Content-Type: application/json');
			echo (json_encode($result));
		}else{

		 $this->db->query("UPDATE employee set noti_status='$notification_status' WHERE empl_id=$emp_id");
		

			 $query =   $this->db->query("select noti_status from employee where empl_id=$emp_id");

		   $arr =  $query->result_array();
			
			$result = array(

				'status'	 => '1',
				'record'     => $arr[0]
			);

			header('Content-Type: application/json');
			echo json_encode( $result);
		}

		
		}	



	public function delete_task()
	{
		$task_name= $this->input->get_post('task_name', TRUE);

		$query = $this->db->query("DELETE FROM project_tasks WHERE task_name='$task_name';");
        $arr =  $query->result_array();
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
}
