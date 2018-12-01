<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_employee extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->helper('form');
		$this->load->database();
		$this->load->model('Register_model');
		$this->load->library('form_validation');
	}


	public function index(){
		//echo "hello";
	}


	public function register_employee(){

		$this->form_validation->set_rules('first_name','first_name','trim|required');
		$this->form_validation->set_rules('last_name','last_name','trim|required');
		$this->form_validation->set_rules('username','username','trim|required');
		$this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[employee.email]');
		$this->form_validation->set_rules('phone','phone','trim|required');
		$this->form_validation->set_rules('password','password','trim|required');
		//$this->form_validation->set_rules('confirm_password','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('user_company_id','user_company_id','trim|required');
		$this->form_validation->set_rules('user_employee_id','designation','trim|required');
		$this->form_validation->set_rules('device_id', 'Device id', 'trim|required');
		$this->form_validation->set_rules('device_type', 'Device type', 'trim|required');


		if($this->form_validation->run() == FALSE)
		{

			$error = strip_tags(validation_errors());
			$result = array(
					'status'	=> '0',
					'statuscode'=> '403',
					'msg'	=> $error,
				);
				print_r(json_encode($result));
		}
		else{

				$fname = $this->input->post('first_name');
				$lname = $this->input->post('last_name');
				$uname = $this->input->post('username');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$pass  = $this->input->post('password');
				$company 	 = $this->input->post('user_company_id');
				$designation = $this->input->post('user_employee_id');
				$device_id 	 = $this->input->post('device_id');
				$device_type = $this->input->post('device_type');

				$data_sub = array(
					'first_name'		 => $fname,
					'last_name'			 => $lname,
					'username'			 => $uname,
					'email'			 	 => $email,
					'phone'				 => $phone,
					'password'			 => md5($pass),
					'company'			 => $company,
					'designation'	 => $designation,
					'device_id'	 		 => $device_id,
					'device_type'		 => $device_type,
				);

				$data_fet = array(
					'email' => $email
					);
				//print_r($data_sub);die;
				$query = $this->Register_model->register_user($data_sub);
				//pr($query);
				if($query){

					$query_result = $this->Register_model->login_user($data_fet);
					//print_r($query_result);die;
					$final_result = array(

								'status'	=> '1',
								'msg'	    => 'Register successfully',
								'statuscode'=> '200',
								'id'		=> $query_result[0]['empl_id'],
								'user_name'	=> $query_result[0]['username'],
								'first_name'=> $query_result[0]['first_name'],
								'last_name'	=> $query_result[0]['last_name'],
								'phone'		=> $query_result[0]['phone'],
								'email'		=> $query_result[0]['email'],
								'password'	=> $query_result[0]['password'],
								'user_company_id'=> $query_result[0]['company'],
								'user_employee_id'=> $query_result[0]['designation'],
								'device_id' => $query_result[0]['device_id'],
								'device_type'=> $query_result[0]['device_type'],
								
							);
					print_r(json_encode($final_result));


				}
				
			}

	}



}


