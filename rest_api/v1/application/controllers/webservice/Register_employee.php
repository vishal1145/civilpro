<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_employee extends CI_Controller{

	public function __construct(){
		parent::__construct(){

			$this->load->libarary('form_validation');
			$this->load->helper('form');
			$this->load->datbase();
			$this->load->model('Employee_model');
		}
	}


}


?>