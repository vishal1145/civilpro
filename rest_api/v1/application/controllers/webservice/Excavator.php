<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Excavator extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->helper('form');
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->model('Excavator_model');
	}

	public function add_excavator(){
		$this->form_validation->set_rules('due_date','due_date','trim|required');
		$this->form_validation->set_rules('operator','operator','trim|required');
		$this->form_validation->set_rules('site_area','site_area','trim|required');
		$this->form_validation->set_rules('hour_start','hour_start','trim|required');
		$this->form_validation->set_rules('hour_finish','hour_finish','trim|required');
		$this->form_validation->set_rules('fuel_lavel','fuel_lavel','trim|required');
		$this->form_validation->set_rules('engine_oil_lavel','engine_oil_lavel','trim|required');
		$this->form_validation->set_rules('oil_lavel','oil_lavel','trim|required');
		$this->form_validation->set_rules('radiator_lavel','radiator_lavel','trim|required');
		$this->form_validation->set_rules('transmission_lavel','transmission_lavel','trim|required');
		$this->form_validation->set_rules('fluids_leak','fluids_leak','trim|required');
		$this->form_validation->set_rules('fluid_level_comment','fluid_level_comment','trim|required');
		$this->form_validation->set_rules('air_conditioning','air_conditioning','trim|required');
		$this->form_validation->set_rules('bucket_teeth_pins','bucket_teeth_pins','trim|required');
		$this->form_validation->set_rules('cleaning_products','cleaning_products','trim|required');
		$this->form_validation->set_rules('damage_report','damage_report','trim|required');
		$this->form_validation->set_rules('fire_extinguisher','fire_extinguisher','trim|required');
		$this->form_validation->set_rules('first_aid_kit','first_aid_kit','trim|required');
		$this->form_validation->set_rules('general_defects','general_defects','trim|required');
		$this->form_validation->set_rules('grease_lines_pins','grease_lines_pins','trim|required');
		$this->form_validation->set_rules('hand_rails_door_handles','hand_rails_door_handles','trim|required');
		$this->form_validation->set_rules('horn','horn','trim|required');
		$this->form_validation->set_rules('hydraulic_hoses','hydraulic_hoses','trim|required');
		$this->form_validation->set_rules('lights','lights','trim|required');
		$this->form_validation->set_rules('mirrors','mirrors','trim|required');
		$this->form_validation->set_rules('panel_damage','panel_damage','trim|required');
		$this->form_validation->set_rules('radiator','radiator','trim|required');
		$this->form_validation->set_rules('radiator_hoses','radiator_hoses','trim|required');
		$this->form_validation->set_rules('seat_seatbelts','seat_seatbelts','trim|required');
		$this->form_validation->set_rules('slew_motor_oil','slew_motor_oil','trim|required');
		$this->form_validation->set_rules('tracks_chains_shoes','tracks_chains_shoes','trim|required');
		$this->form_validation->set_rules('windows_wipers','windows_wipers','trim|required');
		$this->form_validation->set_rules('additional_notes','additional_notes','trim|required');
		if(empty($_FILES['image']['name']))
		{
		$this->form_validation->set_rules('image','image','trim|required');
		}

		if(empty($_FILES['image']['type']))
		{
		$this->form_validation->set_rules('image2','file is not image','trim|required');
		}

		if($this->form_validation->run() == FALSE){
			$error = strip_tags(validation_errors());
			$result = array(
					'status'	 => '0',
					'statuscode' => '403',
					'message'	 => $error
				);
			print_r(json_encode($result));
		}else{

			$due_date 	 = $this->input->post('due_date');
			$operator 	 = $this->input->post('operator');
			$site_area	 = $this->input->post('site_area');
			$hour_start  = $this->input->post('hour_start');
			$hour_finish = $this->input->post('hour_finish');
			$fuel_lavel  = $this->input->post('fuel_lavel');
			$engine_oil_lavel  = $this->input->post('engine_oil_lavel');
			$oil_lavel 	 	   = $this->input->post('oil_lavel');
			$radiator_lavel    = $this->input->post('radiator_lavel');
			$transmission_lavel= $this->input->post('transmission_lavel');
			$fluids_leak       = $this->input->post('fluids_leak');
			$fluid_level_comment= $this->input->post('fluid_level_comment');
			$air_conditioning  = $this->input->post('air_conditioning');
			$bucket_teeth_pins = $this->input->post('bucket_teeth_pins');
			$damage_report     = $this->input->post('damage_report');
			$fire_extinguisher = $this->input->post('fire_extinguisher');
			$first_aid_kit     = $this->input->post('first_aid_kit');
			$general_defects   = $this->input->post('general_defects');
			$grease_lines_pins = $this->input->post('grease_lines_pins');
			$hand_rails_door_handles = $this->input->post('hand_rails_door_handles');
			$horn 			   = $this->input->post('horn');
			$hydraulic_hoses   = $this->input->post('hydraulic_hoses');
			$lights 		   = $this->input->post('lights');
			$mirrors 		   = $this->input->post('mirrors');
			$panel_damage	   = $this->input->post('panel_damage');
			$radiator 		   = $this->input->post('radiator');
			$radiator_hoses    = $this->input->post('radiator_hoses');
			$seat_seatbelts    = $this->input->post('seat_seatbelts');
			$slew_motor_oil    = $this->input->post('slew_motor_oil');
			$tracks_chains_shoes= $this->input->post('tracks_chains_shoes');
			$windows_wipers 	= $this->input->post('windows_wipers');
			$additional_notes   = $this->input->post('additional_notes');
			$cleaning_products  = $this->input->post('cleaning_products');
			$image   			= 			$this->input->post('image');
			
		// 	$image = $_FILES['image']['name'];
		// //	print_r($image);die;
		// 	 if(!empty($_FILES["image"]["name"]))
		// 				{
		// 		//generate unique file name
		// 				  $fileName = $_FILES["image"]["name"];
		// 				    //file upload path

		// 				    $targetDir = "uploads/uploads/";
		// 				     $targetFilePath = $targetDir . $fileName;
						   
		// 				    //allow certain file formats
		// 				     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
						 
		// 				    $allowTypes = array('jpg','png','jpeg','gif');
		// 				    if(in_array($fileType, $allowTypes)){
		// 				        //upload file to server
		// 				        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
									
		// 							//return true;
						  
		// 		       		 }else{
		// 						 echo "error";
		// 					 }
		// 					}
		// 				}

			$currnt_date = date("Y-m-d");
			$timecard = array(

				'date' 				=> $due_date,
				'operator'			=> $operator,
				'site_area'			=> $site_area,
				'hour_start'		=> $hour_start,
				'hour_finish' 		=> $hour_finish,
				'fuel_lavel'		=> $fuel_lavel,
				'engine_oil_lavel'	=> $engine_oil_lavel,
				'oil_lavel' 	  	=> $oil_lavel,
				'radiator_lavel'  	=> $radiator_lavel,
				'transmission_lavel'=> $transmission_lavel,
				'fluids_leak'		=> $fluids_leak,
				'fluid_level_comment'=> $fluid_level_comment,
				'air_conditioning'	=> $air_conditioning,
				'bucket_teeth_pins' => $bucket_teeth_pins,
				'damage_report'		=> $damage_report,
				'fire_extinguisher' => $fire_extinguisher,
				'first_aid_kit'		=> $first_aid_kit,
				'general_defects'	=> $general_defects,
				'grease_lines_pins' => $grease_lines_pins,
				'horn'				=> $horn,
				'hydraulic_hoses'	=> $hydraulic_hoses,
				'lights'			=> $lights,
				'mirrors'			=> $mirrors,
				'panel_damage'		=> $panel_damage,
				'radiator'			=> $radiator,
				'radiator_hoses'	=> $radiator_hoses,
				'seat_seatbelts'	=> $seat_seatbelts,
				'slew_motor_oil'	=> $slew_motor_oil,
				'tracks_chains_shoes'=> $tracks_chains_shoes,
				'windows_wipers'	=> $windows_wipers,
				'cleaning_products' => $cleaning_products,
				'additional_notes'  => $additional_notes,
				'image'				=> $image,
			);
			
			//print_r($timecard);die('test');
			$query = $this->Excavator_model->new_field($timecard);
			if(!empty($query)){
				$data_value =  array('excavator_id' => $query);
				$get_result = $this->Excavator_model->get_field($data_value);

				//$sign = 'http://'.$_SERVER['HTTP_HOST'].'/civilpro/rest_api/v1/uploads/uploads/'.$get_result[0]['image'];
				
				//$sign = $get_result[0]['image'];

				$result = array(

							'status'	 		=> '1',
							'statuscode' 		=> '200',
							'message'			=> 'Excavator log update Successfully',
							'log_id' 		    => $get_result[0]['excavator_id'],
							'operator' 			=> $get_result[0]['operator'],
							'site_area' 		=> $get_result[0]['site_area'],
							'hour_start' 		=> $get_result[0]['hour_start'],
							'hour_finish' 		=> $get_result[0]['hour_finish'],
							'due_date' 			=> $get_result[0]['date'],
							'fuel_lavel' 		=> $get_result[0]['fuel_lavel'],
							'engine_oil_lavel' 	=> $get_result[0]['engine_oil_lavel'],
							'oil_lavel' 		=> $get_result[0]['oil_lavel'],
							'radiator_lavel' 	=> $get_result[0]['radiator_lavel'],
							'transmission_lavel'=> $get_result[0]['transmission_lavel'],
							'fluids_leak' 		=> $get_result[0]['fluids_leak'],
							'fluid_level_comment'=> $get_result[0]['fluid_level_comment'],
							
							'air_conditioning' 	=> $get_result[0]['air_conditioning'],
							'bucket_teeth_pins' => $get_result[0]['bucket_teeth_pins'],
							'damage_report' 	=> $get_result[0]['damage_report'],
							'fire_extinguisher' => $get_result[0]['fire_extinguisher'],
							'first_aid_kit' 	=> $get_result[0]['first_aid_kit'],
							'general_defects' 	=> $get_result[0]['general_defects'],
							'grease_lines_pins' => $get_result[0]['grease_lines_pins'],
							'horn' 				=> $get_result[0]['horn'],
							'hydraulic_hoses' 	=> $get_result[0]['hydraulic_hoses'],
							'lights' 			=> $get_result[0]['lights'],
							'mirrors' 			=> $get_result[0]['mirrors'],
							'panel_damage' 		=> $get_result[0]['panel_damage'],
							'radiator' 			=> $get_result[0]['radiator'],
							'radiator_hoses' 	=> $get_result[0]['radiator_hoses'],
							'seat_seatbelts' 	=> $get_result[0]['seat_seatbelts'],
							'slew_motor_oil' 	=> $get_result[0]['slew_motor_oil'],
							'tracks_chains_shoes'=> $get_result[0]['tracks_chains_shoes'],
							'windows_wipers' 	=> $get_result[0]['windows_wipers'],
							'cleaning_products' => $get_result[0]['cleaning_products'],
							'additional_notes' 	=> $get_result[0]['additional_notes'],
							'signature_image' 	=> $get_result[0]['image'],
						);
				print_r(json_encode($result));
			}else{

				$result = array(
					'status'	 => '0',
					'statuscode' => '403',
					'message'	 => 'Excavator log update failed!',
				);
			print_r(json_encode($result));
			}
			


		}
		
	}




}


?>