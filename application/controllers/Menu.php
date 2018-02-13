<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('menu_model');
	}	



	public function index()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Menu';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Search 
			$search = '';
			if(isset($_GET['search'])) {
				$search = $_GET['search'];
			}

			//Paginated data				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/menu/index/');
			$config["total_rows"] = $this->menu_model->count_items();
			$config['per_page'] = 50;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(3)){
		       $page = ($this->uri->segment(3)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->menu_model->fetch_items($config["per_page"], $page);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION			

			$this->load->view('menu/list', $data);	
		
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
			$data['categories']   = $this->menu_model->fetch_category();			

			$data['info']		= $this->menu_model->view($id);
			$data['logs']		= $this->logs_model->fetch_logs('item', $id, 50);
			$data['title'] 		= $data['info']['title'];
			

			//Validate if record exist
			//IF NO ID OR NO RESULT, REDIRECT
			if(!$id || !$data['info'] || $data['info']['is_deleted']) {
					redirect('menu', 'refresh');
			}	

			//Form Validation
			$this->form_validation->set_rules('title', 'Title', 'trim|required');  
			$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
			$this->form_validation->set_rules('description', 'Description', 'trim|required'); 
			$this->form_validation->set_rules('category', 'Menu Category', 'trim|required');  
			
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator') {
		
				if($this->form_validation->run() == FALSE)	{
					$this->load->view('menu/view', $data);						
				} else {	


					$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row
					//Proceed saving candidate				
					if($this->menu_model->update($key_id)) {		

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'menu',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Updated Menu Information'
							);

						//Save log loop
						foreach($log as $lg) {
							$this->logs_model->create_log($lg['user'], $lg['tag'], $lg['tag_id'], $lg['action']);				
						}		
						////////////////////////////////////
						
					
						$this->session->set_flashdata('success', 'Succes! Menu Updated!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
	
					} else {
						//failure
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

	public function create()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] = 'Register Menu';
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			//Page Data 
			$data['categories']		= $this->menu_model->fetch_category();			

			//Form Validation for user
			$this->form_validation->set_rules('title', 'Title', 'trim|required');  
			$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
			$this->form_validation->set_rules('description', 'Description', 'trim|required'); 
			$this->form_validation->set_rules('category', 'Menu Category', 'trim|required');  
		
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator') {
				if($this->form_validation->run() == FALSE)	{
				$this->load->view('menu/create', $data);
				} else {			

					//Proceed saving candidate				
					if($this->menu_model->create()) {		
					
						$this->session->set_flashdata('success', 'Succes! New Menu created!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
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


	public function category()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Menu Category';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Search 
			$search = '';
			if(isset($_GET['search'])) {
				$search = $_GET['search'];
			}

			//Paginated data				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/menu/index/');
			$config["total_rows"] = $this->menu_model->count_categories();
			$config['per_page'] = 50;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(3)){
		       $page = ($this->uri->segment(3)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->menu_model->fetch_categories($config["per_page"], $page);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION			

			$this->load->view('menu/category', $data);	
		
		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}

	public function create_menu()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record	

			//Form Validation for user
			$this->form_validation->set_rules('title', 'Title', 'trim|required');  
		
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator') {
				if($this->form_validation->run() == FALSE)	{

					$this->session->set_flashdata('error', 'An Error has Occured!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');

				} else {			

					//Proceed saving candidate				
					if($this->menu_model->create_menu()) {		
					
						$this->session->set_flashdata('success', 'Succes! New Menu Category Created!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
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


	public function update_menu()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record	

			//Form Validation for user
			$this->form_validation->set_rules('id', 'ID', 'trim|required'); 
			$this->form_validation->set_rules('title', 'Title', 'trim|required');  
		
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator') {
				if($this->form_validation->run() == FALSE)	{

					$this->session->set_flashdata('error', 'An Error has Occured!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');

				} else {			

					//Proceed saving candidate	
					$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row			
					if($this->menu_model->update_menu($key_id)) {		

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'menu_category',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Updated Menu Category'
							);

				
						//Save log loop
						foreach($log as $lg) {
							$this->logs_model->create_log($lg['user'], $lg['tag'], $lg['tag_id'], $lg['action']);				
						}		
						////////////////////////////////////
					
						$this->session->set_flashdata('success', 'Succes! Updated Menu Category!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
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
	/**
	 * Checks the Serial of the Item. Returns True if Serial Exist from another Record
	 * @param  [type] $item [description]
	 * @return [type]       [description]
	 */
	function check_serial($serial) {


		if($serial) {
			$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata
			$item = $this->encryption->decrypt($this->input->post('id')); 

			if($this->item_model->check_serial($item, $serial)) {
				$this->form_validation->set_message('check_serial', 'Serial is Registered from another Item!');		
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			return TRUE;
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

				if($this->menu_model->delete($key_id)) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'menu',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Deleted Menu'
							);

				
						//Save log loop
						foreach($log as $lg) {
							$this->logs_model->create_log($lg['user'], $lg['tag'], $lg['tag_id'], $lg['action']);				
						}		
						////////////////////////////////////
					$this->session->set_flashdata('success', 'Menu Deleted!');
					redirect('menu', 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}


	public function delete_menu()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				$this->session->set_flashdata('error', 'An Error has Occured!');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				

				if($this->menu_model->delete_menu($key_id)) {

					$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'menu_category',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Deleted Menu Category'
							);

				
						//Save log loop
						foreach($log as $lg) {
							$this->logs_model->create_log($lg['user'], $lg['tag'], $lg['tag_id'], $lg['action']);				
						}		
						////////////////////////////////////
					$this->session->set_flashdata('success', 'Menu Category Deleted!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}

	public function print_total_inventory()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			//Page Data 
			$data['items']		= $this->item_model->total_inventory();
			$data['total_items'] = $this->item_model->count_items('', '');
			$data['title'] 		= 'Total Inventory Report';

		
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator') {
				
				$this->load->view('items/print_total_inventory', $data);
				
			} else {
				show_error('Oops! Your account does not have the privilege to view the content. Please Contact the Administrator', 403, 'Access Denied!');				
			}		

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('dashboard/login', 'refresh');
		}

	}





	public function test()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record



			//Form Validation
			$this->form_validation->set_rules('title', 'Title', 'trim|required');  
			$this->form_validation->set_rules('price', 'Price', 'trim|required'); 
			$this->form_validation->set_rules('description', 'Description', 'trim|required'); 
			$this->form_validation->set_rules('category', 'Menu Category', 'trim|required');  
			
			//Validate Usertype
			if($data['user']['usertype'] == 'Administrator') {
		
				if($this->form_validation->run() == FALSE)	{
					$this->load->view('blank', $data);						
				} else {	


					$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row
					//Proceed saving candidate				
					if($this->menu_model->update($key_id)) {		

						$log[] = array(
							'user' 		=> 	$userdata['username'],
							'tag' 		=> 	'menu',
							'tag_id'	=> 	$key_id,
							'action' 	=> 	'Updated Menu Information'
							);

						//Save log loop
						foreach($log as $lg) {
							$this->logs_model->create_log($lg['user'], $lg['tag'], $lg['tag_id'], $lg['action']);				
						}		
						////////////////////////////////////
						
					
						$this->session->set_flashdata('success', 'Succes! Menu Updated!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
	
					} else {
						//failure
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





}
