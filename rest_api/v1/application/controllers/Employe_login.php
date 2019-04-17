<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe_login extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Register_model');
		$this->load->library('form_validation');

	}

	public function index(){
		//echo "Hello";
	}

	public function login_employe(){
 
		

		$this->form_validation->set_rules('email','email','trim|required|valid_email');
		$this->form_validation->set_rules('password','password','trim|required');
		$this->form_validation->set_rules('device_id','device_id','trim|required');
		$this->form_validation->set_rules('device_type','device_type','trim|required');

		if($this->form_validation->run() == FALSE)
			{
				$error = strip_tags(validation_errors());
					$result = array(
							'status' 	 => '0',
							'statuscode' => '403',
							'msg'	 => $error
					);
					print_r(json_encode($result));

			}
			else{

				$email 		= $this->input->post('email');
				$pass  		= $this->input->post('password');
				$device_id  = $this->input->post('device_id');
				$device_type= $this->input->post('device_type');
				
				$data_fet = array(
					'email'    => $email,
					'password' => md5($pass),
					);
				
				$data1 = array(
					'device_id'   => $device_id,
					'device_type' => $device_type,
					); 

				$query = $this->Register_model->login_user($data_fet);
				if($query){

					$eid = $query[0]['empl_id'];

					$table_name = 'employee';
					$this->db->where('empl_id',$eid);

					$query2 = $this->db->update($table_name,$data1);

					//print_r($query);die;
					if($query[0]['img'] == ''){
						$img = 'http://'.$_SERVER['HTTP_HOST'].'/civilpro/rest_api/v1/uploads/uploads/avatar.png';
						//die('here');
					}
					else{
						$img = $query[0]['img'];
						//die('test');
					}
					$result = array(
						'status'	=> '1',
						'msg'	    => 'Login successfully',
						'statuscode'=> '200',
						'id'		=> $query[0]['empl_id'],
						'user_name'	=> $query[0]['username'],
						'first_name'=> $query[0]['first_name'],
						'last_name'	=> $query[0]['last_name'],
						'phone'		=> $query[0]['phone'],
						'email'		=> $query[0]['email'],
						'password'	=> $query[0]['password'],
						'company'	=> $query[0]['company'],
						'designation'=> $query[0]['designation'],
						'noti_status'=> $query[0]['noti_status'],
						'image'		=> $img,
						
						
					);
					print_r(json_encode($result));
				}
				else{
					$result = array(
							'status' 	 => '0',
							'statuscode' => '403',
							'msg'	 	=> 'Invalid User and Password',
					);
					print_r(json_encode($result));
				}

			}
	}


		/**** Forget password *****/

	public function forget_pass(){
		//$email 		= $this->input->post('email');

	$this->form_validation->set_rules('email','email','trim|required|valid_email');
		
		
		if ($this->form_validation->run() == FALSE)
                {
                       $error = strip_tags(validation_errors());
						$result = array(
							'status'=>'0',
							'statuscode' => '403',
							'msg' => $error
						);
						print_r(json_encode($result));
                }
			else{

				$email = $this->input->post('email');

				$data = array('email' => $email);
				//die('here');
				$query = $this->Register_model->login_user($data);
				//print_r($query[0]['email']);die('here');

				if($query){
					
					$otp = rand(1000,100000);

					$data = array(
						'otp_manage'  => md5($otp), 
					);

					$final_otp = md5($otp);




						$to = $email;
						$subject = "Civilpro Forget Password";
						$from = 'testerone@a1professionals.com';
						$message = "
						<html>
							<head>
							<title>HTML email</title>
							</head>
							<body>
								<p>This email contains new otp!</p>
								<div>
								<p>".'http://'.$_SERVER['HTTP_HOST'].'/civilpro/newpass.php?s='.$final_otp."</p>
								
								</div>
							</body>
						</html>
						";

						// Always set content-type when sending HTML email
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

						// More headers
						$headers .= 'From: <testerone@a1professionals.com>' . "\r\n";
						$headers .= 'Cc: myboss@example.com' . "\r\n";

						custom_mail($to,$subject,$message,$from);

					//$query2 = $this->Register_model->otp_manage($data);
						
					$table_name = 'users';
					$this->db->where('user_id',$query[0]['user_id']);

					$query2 = $this->db->update($table_name,$data);
					//print_r($query2);die('Enter');
					$result = array(
									'status'=>'1',
									'statuscode' => '200',
									'message' => "Otp generated successfully!",
									);
								print_r(json_encode($result));
				}
				
					
				else{
						$result = array(
									'status'=>'0',
									'statuscode' => '403',
									'message' => "Invalid Email.",
									);
								print_r(json_encode($result));			
						}


			}


	}


				/****End Forget password *****/


public function rest_password(){
	$this->form_validation->set_rules('email','email','trim|required');
	$this->form_validation->set_rules('otp','otp','trim|required');
	$this->form_validation->set_rules('new_password','new_password','trim|required');
	//die('here');
	if($this->form_validation->run() == FALSE)
	{	
		$error = strip_tags(validation_errors());
		$result = array(

				'status'	 => '0',
				'statuscode' => '403',
				'msg'		 => $error,
		);
		print_r(json_encode($result));

	}
	else{

		$email = $this->input->post('email');
		$otp   = $this->input->post('otp');
		$npass  = $this->input->post('new_password');

		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('users.email', $email);
		$this->db->where('users.otp_manage', $otp);
		$query = $this->db->get();
		$res = $query->result();
		//print_r($res);
		
		if(!empty($res)){

			$id = $res[0]->user_id;
			$data = array(
					'password'   => md5($npass),
					'otp_manage' => '',
				);

			$table = 'users';
			$this->db->where('user_id',$id);
			$query2 = $this->db->update($table,$data);
			

						$result = array(
									'status'	 => '1',
									'statuscode' => '200',
									'message' 	 => "Password has been updated Successfully!",
									);
								print_r(json_encode($result));
			
		}
		else{

			$result = array(
						'status'	 => '0',
						'statuscode' => '403',
						'message' 	 => 'Wrong Email and Otp!',
						);
					print_r(json_encode($result));
			
			
			}

	}

}





}



?>