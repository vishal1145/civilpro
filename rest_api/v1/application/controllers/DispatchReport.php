<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DispatchReport extends CI_Controller {

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
	public function add_task()
	{
		$emp_id = $this->input->get_post('emp_id', TRUE);
		$task_id= $this->input->get_post('task_id', TRUE);
		$task_name= $this->input->get_post('task_name', TRUE);
		$this->form_validation->set_rules('emp_id','emp_id','trim|required');
		$this->form_validation->set_rules('task_name','task_name','trim|required');


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
		//$emp_id = $this->input->get_post('emp_id', TRUE);
		//$task_id= $this->input->get_post('id', TRUE);
		$task_name= $this->input->get_post('task_name', TRUE);
		$task_dec= $this->input->get_post('task_discription', TRUE);
		

        $query = $this->db->query("INSERT INTO project_tasks (task_name,task_discription) value ('$task_name','$task_dec');");
        $arr =  $query->result_array();
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
	public function get_dispatch()
	{
		$emp_id = $this->input->get_post('emp_id', TRUE);
		$dis_date = $this->input->get_post('dispatch_date', TRUE);
		$this->form_validation->set_rules('emp_id','emp_id','trim|required');
		$this->form_validation->set_rules('dispatch_date','dispatch_date','trim|required');
		//$task_id= $this->input->get_post('id', TRUE);
		// $task_name= $this->input->get_post('task_name', TRUE);
		// $task_dec= $this->input->get_post('task_discription', TRUE);

        $query = $this->db->query("select dl.*, e.first_name, p.Project_name, m.machine_name,i.materials_name,p.Project_name from dispatch_log dl
		inner join employee e on dl.emp_id = e.empl_id  
		left join machine m on dl.equipment_id = m.machine_id
		left join material i on dl.material_id = i.id
		left join Project p on dl.Project_id = p.Project_id where emp_id=$emp_id and dispatch_date = '$dis_date'");

		$arr =  $query->result_array();
		if( sizeof($arr) > 0)
		{
			$result = array(

				'status'	 => '1',
				'record'     => $arr[0]
			);

			header('Content-Type: application/json');
			echo json_encode( $result);

		}else{
			$result1 = array(

				'status'	 => '0',
				'record'     => 'Sorry No Record Found !'
			);
			header('Content-Type: application/json');
			echo json_encode( $result1  );
		}
		
		
	}

	public function get_notification()
	{
		$emp_id = $this->input->get_post('emp_id', TRUE);
		$this->form_validation->set_rules('emp_id','emp_id','trim|required');
		// $dis_date = $this->input->get_post('dispatch_date', TRUE);
		// $this->form_validation->set_rules('dispatch_date','dispatch_date','trim|required');
		//$task_id= $this->input->get_post('id', TRUE);
		// $task_name= $this->input->get_post('task_name', TRUE);
		// $task_dec= $this->input->get_post('task_discription', TRUE);

        $query = $this->db->query("select id, text ,created_date,isread from notification where empl_id=$emp_id");

		$arr =  $query->result_array();
			header('Content-Type: application/json');
			echo json_encode( $arr );

		
		
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
