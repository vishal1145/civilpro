<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Field_report extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->model('Field_model');
		$this->load->library('upload');

	}

	public function field_result()
	{
	

		//$this->form_validation->set_rules('fieldreport_employee_name','fieldreport_employee_name','trim|required');
		$this->form_validation->set_rules('fieldreport_employee_id','fieldreport_employee_id','trim|required|numeric');
		$this->form_validation->set_rules('fieldreport_issue_date','fieldreport_issue_date','trim|required');
		$this->form_validation->set_rules('filedreport_project_title','filedreport_project_title','trim|required|numeric');
		$this->form_validation->set_rules('fieldreport_delay','fieldreport_delay','trim|required|numeric');
		$this->form_validation->set_rules('fieldreport_completed_scopeOfwork','fieldreport_completed_scopeOfwork','trim|required');

		if(empty($_FILES['filedreport_picture_list']['name']))
		{
		$this->form_validation->set_rules('filedreport_picture_list','filedreport_picture_list','trim|required');
		}

		if(empty($_FILES['filedreport_picture_list']['type']))
		{
		$this->form_validation->set_rules('filedreport_picture_list2','file is not image','trim|required');
		}


       


            //die('12');

		if($this->form_validation->run() == FALSE)
		{
			$error = strip_tags(validation_errors());
			$result = array(

					'status'	 => '0',
					'statuscode' => '403',
					'msg'		 => $error,
			);
			print_r(json_encode($result));
		}else{


			$employee_id   = $this->input->post('fieldreport_employee_id');
			$issue_date    = $this->input->post('fieldreport_issue_date');
			$project_title = $this->input->post('filedreport_project_title');
			$delay 		   = $this->input->post('fieldreport_delay');
			$scopeOfwork   = $this->input->post('fieldreport_completed_scopeOfwork');
			$time_set	   = time();

        
			$total_image = count($_FILES['filedreport_picture_list']['name']);
			//print_r($_FILES);die;
			$img_name = '';
			for($i=0; $i < $total_image; $i++){
			 $image_name = $_FILES['filedreport_picture_list']['name'];
				$img_name.= 'http://'.$_SERVER['HTTP_HOST'].'/civilpro/rest_api/v1/uploads/uploads/'.$image_name.'#';
			  $img_name."<br>";
			}
			
			$img_name2 = rtrim($img_name,"#");
			/*echo $img_name2;
			die('here');*/
		 
		 // upload file
		 if(!empty($_FILES["filedreport_picture_list"]["name"]))
						{

				// foreach($_FILES['filedreport_picture_list'] as $key)
           		//  {
               		 $file_name=$_FILES["filedreport_picture_list"]["name"];
               		 $file_tmp=$_FILES["filedreport_picture_list"]["tmp_name"];

               		

				//generate unique file name
						  $fileName = $_FILES["filedreport_picture_list"]["name"];
						    //file upload path

						    $targetDir = "uploads/uploads/";
						     $targetFilePath = $targetDir . $fileName;
						   
						    //allow certain file formats
						     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
		//print_r($_FILES['filedreport_picture_list']);die;
						 
						    $allowTypes = array('jpg','png','jpeg','gif');
						    if(in_array($fileType, $allowTypes)){
						        //upload file to server
						        if(move_uploaded_file($_FILES["filedreport_picture_list"]["tmp_name"], $targetFilePath)){
									
									//return true;
						  
				       		 }else{
								 echo "error";
							 }
							}
						}
					//}
		 // upload file
	

		



			//$picture_list  = $this->input->post('filedreport_picture_list');

			$field_detail = array(

					'employe_id' => $employee_id,
					'date' 		 => $issue_date,
					'project'	 => $project_title,
					'delay' 	 => $delay,
					'scope_work' => $scopeOfwork,
					'picture' 	 => $img_name2,
					'time_set'   => $time_set,
			);
			//print_r($field_detail);die('test');
			
			$query = $this->Field_model->new_field($field_detail);
			$final = array('id' => $query);
			//print_r($final);die('here');
			if(!empty($final))
			{
				$final_result = $this->Field_model->field_record($final);
				//print_r($final_result);die;


                $explode = explode('#',$final_result[0]['picture']);
               // print_r($explode);

               //"http://$_SERVER[HTTP_HOST]/civilpro/rest_api/v1/uploads/uploads/".
       for($i=0;$i<count($explode);$i++)
       {
           $img_data[] = $explode[$i];


       }
                

              

				$result = array(
					'status'	=> '1',
					'statuscode'=> '200',
					'msg'		=> 'Add field report successfully!',
					'id'		=> $final_result[0]['id'],
					'employe_id'=> $final_result[0]['employe_id'],
					'date'		=> $final_result[0]['date'],
					'project'	=> $final_result[0]['project'],
					'scope_work'=> $final_result[0]['scope_work'],
					'picture'	=> $img_data,
					
				);
				print_r(json_encode($result));

			}

		}

	}



}

?>