<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeList extends CI_Controller {

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
	public function index()
	{
		$emp_id = $this->input->get_post('emp_id', TRUE);
		$queryText = "select empl_id,first_name,last_name,img,joining_date,email,phone,'employee' as role from employee where empl_id = ".$emp_id." union select user_id as empl_id,first_name,last_name,img,birthday as joining_date,email,phone,'admin' as role from Users where user_id = 30"; 
		$query = $this->db->query($queryText);
		$arr = $query->result_array();    
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
}
