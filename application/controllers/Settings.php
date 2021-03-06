<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
	}	


	public function profile()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record
			$data['title'] = 'Profile : ' . $data['user']['name'];

			$data['logs']		= $this->logs_model->fetch_user_logs($data['user']['username'], 50);
			

			//FORM VALIDATION
			$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email'); 
			$this->form_validation->set_rules('contact', 'Contact Number', 'trim'); 

			if($this->input->post('resetpass')) {
				$this->form_validation->set_rules('oldpass', 'Old Password', 'trim|required|callback_check_user');
				$this->form_validation->set_rules('newpass', 'New Password', 'trim|required|matches[confpass]');
				$this->form_validation->set_rules('confpass', 'Confirm Password', 'trim|required');
			}
			 
			   if($this->form_validation->run() == FALSE)	{

					$this->load->view('user/profile', $data);

				} else {

				//Proceed saving				
				if($this->user_model->update_profile($data['user']['username'])) {			
					if($this->input->post('resetpass')) {
						$this->user_model->update_profile_pass($data['user']['username']);

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'',
							'tag_id'	=> 	'',
							'action' 	=> 	'Updated Personal Profile'
							);

				
						//Save log loop
						foreach($log as $lg) {
							$this->logs_model->create_log($lg['user'], $lg['tag'], $lg['tag_id'], $lg['action']);				
						}		
						////////////////////////////////////
					}
					$this->session->set_flashdata('success', 'Success! Profile Updated!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					//failure
					$this->session->set_flashdata('error', 'Oops! Error occured!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}	
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	public function check_user($password) {
		$username = $this->session->userdata('admin_logged_in')['username'];
		$result = $this->user_model->check_user($username, $password);

		if($result) {			
			return TRUE;
		} else {
			$this->form_validation->set_message('check_user', 'Incorrect Password!');
			return FALSE;
		}
	}
}
