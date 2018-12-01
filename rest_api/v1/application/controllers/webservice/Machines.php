<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Machines extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('Machines_model');
	}

	public function machine_list()
	{
		

			$query = $this->Machines_model->list();
			
			if(!empty($query)){

				$newArray = array();

				foreach ($query as  $key => $val) {
				
				    $query[$key]['image'] =  'http://'.$_SERVER['HTTP_HOST'].'/civilpro/Upload/Machines/'.$val['machine_image'];

				}


				$result = array(

					'status'	 => '1',
					'statuscode' => '200',
					'message'		 => 'Machine detail!',
					'Machine_id' =>  $query,
					
				);
				print_r(json_encode($result));
				

			}
			
	

	}



	
	public function machine()
	{
		$this->form_validation->set_rules('machine_id', 'machine_id', 'trim|required');
		//die('here');
		if($this->form_validation->run() == FALSE)
		{
			$error = strip_tags(validation_errors());
			$result = array(

					'status'	=> '0',
					'statuscode'=> '403',
					'message'		=> $error,
				);
			print_r(json_encode($result));
		}else{

			$machine_id = $this->input->post('machine_id');
			$data = array('machine_id' => $machine_id);

			$query = $this->Machines_model->list($data);
			if(!empty($query)){

				$result = array(

					'status'	 => '1',
					'statuscode' => '200',
					'message'		 => 'Machine detail!',
					'Machine_id' => $query[0]['machine_id'],
					'Machine_name'=>$query[0]['machine_name'],
					'Machine_image'=>'http://'.$_SERVER['HTTP_HOST'].'/civilpro/Upload/Machines/'.$query[0]['machine_image'],
				);
				print_r(json_encode($result));
			}
			else{

				$result = array(

					'status'	=> '0',
					'statuscode'=> '403',
					'message'		=> 'Machine id not valid!',
				);
			print_r(json_encode($result));
			}
			

		}

	}



}

?>