<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('category_model');
	}	



	public function index()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Item Categories';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Search
			$search = '';
			if(isset($_GET['search'])) {
				$search = $_GET['search'];
			}

			//Paginated data		            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/categories/index/');
			$config["total_rows"] = $this->category_model->count_categories($search);
			$config['per_page'] = 20;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(3)){
		       $page = ($this->uri->segment(3)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->category_model->fetch_categories($config["per_page"], $page, $search);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION		
		
			//Form Validation for user
			$this->form_validation->set_rules('title', 'Category Title', 'trim|required'); 
		
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator') {

				if($this->form_validation->run() == FALSE)	{
					$this->load->view('category/list', $data);
				} else {	
					
					//Proceed saving user				
					if($this->category_model->create()) {			

						$loc_id = $this->db->insert_id(); //fetch last insert case Row ID
						// Save Log Data ///////////////////				

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'category',
							'tag_id'	=> 	$loc_id,
							'action' 	=> 	'Category Registration'
							);

				
						//Save log loop
						foreach($log as $lg) {
							$this->logs_model->create_log($lg['user'], $lg['tag'], $lg['tag_id'], $lg['action']);				
						}		
						////////////////////////////////////
					
						$this->session->set_flashdata('success', 'Category Registered!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
						$this->session->set_flashdata('error', 'Error occured!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}		
				}
			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}

	public function view($id)		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			//Page Data 
			$data['info']			= $this->category_model->view($id);		
			$data['logs']			= $this->logs_model->fetch_logs('category', $id, 50);
			$data['title'] 			= $data['info']['title'];

			//Paginated data			            
		   	$config['num_links'] = 5;
			$config['base_url'] = base_url('categories/view/'.$id.'/items/');
			$config["total_rows"] = $this->category_model->count_inventory($data['info']['title']);
			$config['per_page'] = 30;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG
			$this->pagination->initialize($config);

			$page = 1;	//default page

			if($this->uri->segment(4) == 'items') {
			    if($this->uri->segment(5)){
			       $page = ($this->uri->segment(5)) ;
			  	}
			}

			$data["results"] = $this->category_model->fetch_inventory($config["per_page"], $page, $data['info']['title']);

			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );

			//ITEM NUMBERING
			$data['per_page'] = $config['per_page'];
			$data['page'] = $page;

			//GET TOTAL RESULT
			$data['total_result'] = $config["total_rows"];
		 	//END PAGINATION	

			//Validate if record exist
			 //IF NO ID OR NO RESULT, REDIRECT
				if(!$id || !$data['info'] || $data['info']['is_deleted']) {
					redirect('items', 'refresh');
			}	

			//Form Validation
			$this->form_validation->set_rules('id', 'ID', 'trim|required'); 
			$this->form_validation->set_rules('title', 'Location Title', 'trim|required'); 
		
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator') {
				if($this->form_validation->run() == FALSE)	{
					$this->load->view('category/view', $data);
				} else {			

					//Proceed saving candidate				
					$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row
					if($this->category_model->update($key_id)) {		

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'category',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Updated Category Information'
							);

				
						//Save log loop
						foreach($log as $lg) {
							$this->logs_model->create_log($lg['user'], $lg['tag'], $lg['tag_id'], $lg['action']);				
						}		
						////////////////////////////////////
						
					
						$this->session->set_flashdata('success', 'Succes! Category Updated!');
						$this->session->set_flashdata('flash_loc', '1');

						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
						$this->session->set_flashdata('flash_loc', '1');						
						$this->session->set_flashdata('error', 'Oops! Error occured!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}			
					
				}	
			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');				
			}		

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	public function delete()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				$this->session->set_flashdata('error', 'An Error has Occured!');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				

				if($this->category_model->delete($key_id)) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'category',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Deleted Category'
							);

				
						//Save log loop
						foreach($log as $lg) {
							$this->logs_model->create_log($lg['user'], $lg['tag'], $lg['tag_id'], $lg['action']);				
						}		
						////////////////////////////////////
					$this->session->set_flashdata('success', 'Category Deleted!');
					redirect('categories', 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


}
