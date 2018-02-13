<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 *
	 * 
	 */
	public function __construct()	{
		parent::__construct();		
		$this->load->model('menu_model');
	}	

	public function index() {
		//FETCH DATA
		$data['title'] = 'Bianos Pizza';
		$data['site_title'] = APP_NAME;

		$data['menus']   = $this->menu_model->fetch_items(NULL, NULL);

		$this->load->view('frontend/index', $data);
			
	}

	public function shop_details() {

		//FETCH DATA
		$data['title'] = 'Bianos Pizza';
		$data['site_title'] = APP_NAME;

		$this->load->view('frontend/shop-details/shop-details', $data);

	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */