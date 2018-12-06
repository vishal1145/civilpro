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
		$query = $this->db->query("select * from employee where empl_id in (".$emp_id.",'50','82')");
		$arr = $query->result_array();    
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}
}
