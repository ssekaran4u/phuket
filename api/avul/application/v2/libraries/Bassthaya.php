<?php
	class Bassthaya{
		private $CI;
		
		public function __construct(){
			$this->CI = & get_instance();
		}
			
		// Login
		public function load_login_template($data = array('content' => '', 'title' => '', 'current_menu' => '', 'view_file' => '')){
			$this->CI->load->view('app_view/Laylogintemp/header', $data);
			$this->CI->load->view( $data['view_file'], $data);
			$this->CI->load->view('app_view/Laylogintemp/footer', $data);
		}

		// Dashboard
		public function load_dashboard_template($data = array('content' => '', 'title' => '', 'current_menu' => '', 'view_file' => '')){
			$this->CI->load->view('app_view/Laydashtemp/header', $data);
			$this->CI->load->view('app_view/Laymenu/navmenu', $data);
			$this->CI->load->view('app_view/Laymenu/mainmenu', $data);
			$this->CI->load->view( $data['view_file'], $data);
			$this->CI->load->view('app_view/Laydashtemp/footer', $data);
		}

		// Table View
		public function load_table_template($data = array('content' => '', 'title' => '', 'current_menu' => '', 'view_file' => '')){
			$this->CI->load->view('app_view/Laytabletemp/header', $data);
			$this->CI->load->view('app_view/Laymenu/navmenu', $data);
			$this->CI->load->view('app_view/Laymenu/mainmenu', $data);
			$this->CI->load->view( $data['view_file'], $data);
			$this->CI->load->view('app_view/Laytabletemp/footer', $data);
		}

		// Form View
		public function load_form_template($data = array('content' => '', 'title' => '', 'current_menu' => '', 'view_file' => '')){
			$this->CI->load->view('app_view/Layformtemp/header', $data);
			$this->CI->load->view('app_view/Laymenu/navmenu', $data);
			$this->CI->load->view('app_view/Laymenu/mainmenu', $data);
			$this->CI->load->view( $data['view_file'], $data);
			$this->CI->load->view('app_view/Layformtemp/footer', $data);
		}

		// Map View
		public function load_map_template($data = array('content' => '', 'title' => '', 'current_menu' => '', 'view_file' => '')){
			$this->CI->load->view('app_view/Laymaptemp/header', $data);
			$this->CI->load->view('app_view/Laymenu/navmenu', $data);
			$this->CI->load->view('app_view/Laymenu/mainmenu', $data);
			$this->CI->load->view( $data['view_file'], $data);
			$this->CI->load->view('app_view/Laymaptemp/footer', $data);
		}
	}
?>