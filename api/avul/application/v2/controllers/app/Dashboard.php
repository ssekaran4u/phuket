<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/login_model');
		}

		public function index($param1="", $param2="", $param3="")
		{
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');

			$page['directory']    = "app";
	    	$page['cntrl']        = "dashboard";
	    	$page['func']         = "index";
	    	$page['data_value']   = "";
			$page['page_title']   = "Home";
			$page['page_heading'] = "Home";
			$data['page_temp']    = $this->load->view('app_view/dashboard',$page,TRUE);
			$data['view_file']    = "app_view/Page_Template";
			$data['title']        = "Dashboard";
			$data['currentmenu']  = "dashboard";
			$this->bassthaya->load_dashboard_template($data);
		}

		public function layout_view($param1="", $param2="", $param3="")
		{
			$view_val = $this->input->post('view_val');
			$method   = $this->input->post('method');

			if($method == '_setLayoutView')
			{
				// Unset Session
				// $old_layout  = $this->session->userdata('layout_view');
				// $unset_data  = array('layout_view'  => $old_layout);
				// $this->session->unset_userdata($unset_data);

				// Set Session
				$set_data  = array('layout_view'  => $view_val);
	            $this->session->set_userdata($set_data);

	            $response['status']  = 1;
		        $response['message'] = response_msg('success_message');  
		        $response['data']    = [];
		        echo json_encode($response);
        		return; 
			}
		}	

		public function logout($param1="", $param2="", $param3="")
		{
			$this->session->sess_destroy();
        	redirect(BASE_URL.'app/login', 'refresh');	
		}
	}
?>