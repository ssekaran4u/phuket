<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Assign extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/vendor_model');
			$this->load->model('app_model/user_model');
		}

		public function index($param1="", $param2="", $param3="") {
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL.'/app/dashboard', 'refresh');
		}

		public function add($param1="", $param2="", $param3="") {
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');
			$active_user = $this->session->get_userdata()['n_id'];
        	$formpage = $this->input->post('formpage');
        	$method   = $this->input->post('method');

        	if($formpage == 'BTBM_X_P')
        	{
        		$n_id = $this->input->post('n_id');
				$n_user = $this->input->post('n_user');
        		$n_vendor = $this->input->post('n_vendor');
			    $n_status = $this->input->post('n_status');
			    $error = FALSE;
				$required = array('n_user','n_vendor');
				if($method == '_Edit')
				{
					array_push($required, 'n_id');
				}


			    foreach ($required as $field) 
			    {
			        if(empty($this->input->post($field)))
			        {
			            $error = TRUE;
			        }
			    }

			    if($error)
			    {
			        $response['status']  = 0;
			        $response['message'] = response_msg('overall_required'); 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
			    }

		    	if($method == '_Create')
		    	{
		    		$vencount = 0;
		    		foreach ($n_vendor as $n_vendor_key => $n_vendor_value) {
		    			$upt_info = array(
			    			'n_assigned_by' => $active_user,
		    				'n_updated_by' => date('Y-m-d H:i:s')
		    			);

		    			if($active_user>1){
			    			$upt_info['n_agent'] = $n_user;	
		    			}
		    			else {
		    				$upt_info['n_supervisor'] = $n_user;
		    			}
		    			$vencount++; 
		    			$upt_whr = array('n_id' => $n_vendor_value);
		    			$this->vendor_model->update($upt_info, $upt_whr);
		    			// echo $this->db->last_query();die();
		    		}
		    		$response['status']  = 1;
			        $response['message'] = $vencount." assigned successfully"; 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
		    	}
        	}
			else
        	{
        		if($param1 == 'Edit')
        		{
        			$data_whr = array('n_id' => $param2, 'n_delete' => 1);
        			$data_col = 'n_id, n_city, n_district, n_town, n_category, n_latitude, n_longitude, c_name, c_name_in_thai, c_mobile_numbers, c_emailids, c_c_full_name, c_c_short_name, c_c_contact_number, c_n_is_other, c_c_whatsapp, c_c_line, c_c_emailid, j_opening_hours, c_address,n_status,c_terms,c_demographic';
					$edit_data = $this->vendor_model->getVendor($data_whr, '', '', "row", '', array(), array(), TRUE, $data_col);
        			$page['dataval']       = $edit_data;
					$page['method']        = '_Edit';
					$page['page_title']    = "Edit Vendor";
        		}
        		else
        		{
        			$page['dataval']    = '';
					$page['method']     = '_Create';
					$page['page_title'] = "Assign Vendor";
        		}
        		$roleuserwhr = array('n_status'=>1,'n_delete'=>1);
        		if($active_user>1) {
        			$roleuserwhr['n_created_by'] = $active_user;
        		}

	    		$roleusercol  = 'n_id';
	    		$roleuserlist = $this->user_model->getUser($roleuserwhr, '', '', 'result', '', '', '', '', $roleusercol);
	    		$_userlist = [];
	    		if($roleuserlist)
	    		{
	    			foreach ($roleuserlist as $roleuser) {
	    				array_push($_userlist, $roleuser->n_id);
	    			}
	    		}

				// Get User Lists
	    		$userwhr       = array('A.n_id !=' => 1, 'A.n_delete' => 1, 'A.n_status'=>1);
	    		if($active_user>1)
	    		{
	    			array_push($_userlist,$active_user);
	    			$userwhr['A.n_id'] = implode(",", $_userlist);
	    		}

				$useropt['order_by']   = 'A.c_full_name';
				$useropt['disp_order'] = 'ASC';

				$usercolm = 'A.n_id, c_full_name, c_short_name, B.c_role_title AS c_role_name, c_emailid, c_contact_number';
				$user_list  = $this->user_model->getJoinUser($userwhr, '', '', 'result', [], '', $useropt, '', $usercolm);

				// echo $this->db->last_query();die();

				// Get Vendor Lists
				$venopt['order_by']   = 'A.n_id';
				$venopt['disp_order'] = 'DESC';

				$venwhr = array('A.n_delete' => 1,'A.n_status'=>1,'A.n_type'=>2);
				// ,'c_mobile_numbers'=>'','n_supervisor'=>'');
				$vencol = 'A.n_id, B.c_full_name as c_supervisior, C.c_full_name as c_agent, A.c_name';

				if($active_user>1)
	    		{
	    			if($this->session->get_userdata()['n_accessible_role']!='')
	    			{
	    				$venwhr['A.c_mobile_numbers']='';
	    			}
	    			else
	    			{
	    				$venwhr['A.n_supervisor'] = $active_user;
	    			}
	    		}

				$vendor_list  = $this->vendor_model->getJoinEmptyVendor($venwhr, '', '', 'result', [], '', $venopt, '', $vencol);
				// echo $this->db->last_query(); die();
				// print_r($vendor_list);die();
        		
        		$page['formpage']     = "BTBM_X_P";
        		$page['vendor_list']  = $vendor_list;
        		$page['user_list']    = $user_list;
        		$page['directory']    = "app";
		    	$page['cntrl']        = "assign";
		    	$page['func']         = "add";
				$page['main_heading'] = "Assign";
				$page['pre_title']    = "List assign";
				$page['pre_menu']     = "app/vendor/manage";
				$data['page_temp']    = $this->load->view('app_view/assign/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Assign Assign";
				$data['currentmenu']  = "assign";


				$this->bassthaya->load_map_template($data);
        	}
		}
	}
?>