<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller {

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
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			$otp_res  = $this->input->post('otp_res');
			$cur_date = date('Y-m-d');
			$cur_time = date('H:i:s');
			$cur_year = date('Y');
			$cur_dt   = date('Y-m-d H:i:s');
			$method   = $this->input->post('method');

			if($method == '_adminLogin')
			{
				$error    = FALSE;
				$required = array('email', 'password');

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

			    
		    	$log_whr = array(
		        	'c_emailid'  => $email,
		        	'c_password' => $password,
		        	'n_status'   => 1,
		        	'n_delete'   => 1,
		        );

		    	$log_col  = 'n_id, c_full_name, c_short_name, c_emailid,  n_role,n_accessible_role, n_auth';
		        $log_data = $this->login_model->getLoginStatus($log_whr, '', '', 'row', '', '', '', '', $log_col);

		        if(!empty($log_data))
		        {
		        	$n_id        = empty_check($log_data->n_id);
		            $c_full_name = empty_check($log_data->c_full_name);
		            $c_emailid   = empty_check($log_data->c_emailid);
		            $n_role = empty_check($log_data->n_role);
		            $n_accessible_role = empty_check($log_data->n_accessible_role);
		            $n_auth      = empty_check($log_data->n_auth);

		            if($n_auth == 1)
		            {
		            	// Send OTP
		            	$randomOtp = generateRandomnumber(6);

		            	$otp_data = array(
				        	'c_emailid'       => $email,
				        	'n_otp'           => $randomOtp,
				        	'dt_date'         => $cur_date,
				        	'dt_time'         => $cur_time,
				        	'dt_created_date' => $cur_dt,
				        );

		            	$otp_ins   = $this->login_model->emailOtp_insert($otp_data);
		            	// $otp_email = $this->email_temp->otp_template($c_full_name, $c_emailid, $randomOtp);

		            	$exp_value = explode('@', $c_emailid);
		            	$frt_name  = $exp_value[0];
			            $sed_name  = $exp_value[1];
			            $frt_value = mb_strimwidth($frt_name, 0, 3);
			            $send_link = $frt_value.'xxxx@'.$sed_name;

			            $data_res  = array(
			            	'hide_email' => $send_link,
			            	'c_emailid'  => $c_emailid,
			            	'n_auth'     => $n_auth,
			            );

		            	$response['status']  = 1;
				        $response['message'] = response_msg('otp_success');  
				        $response['data']    = $data_res;
				        echo json_encode($response);
				        return; 
		            }
		            else
		            {
		            	$role_whr  = array('n_id' => $n_role);
		        		$role_col  = 'n_id, c_role_title,c_role_list';
		        		$this->load->model('app_model/role_model', NULL, TRUE);
		        		$role_list = $this->role_model->getRole($role_whr, '', '', 'row', '', '', '', '', $role_col);

		            	$data_res  = array(
		            		'n_id'         => $n_id,
			            	'c_full_name'  => $c_full_name,
			            	'hide_email'   => '',
			            	'c_emailid'    => $c_emailid,
			            	'n_role'  	   => $n_role,
			            	'n_accessible_role'	=> $n_accessible_role,
			            	'n_auth'       => $n_auth,
			            	'log_verify'   => 2,
			            	'log_url'      => 'vendor/manage',
			            	'random_value' => generateRandomString(32),
			            	'layout_view'  => 'sun',
			            	'c_role_title' => $role_list->c_role_title,
			            	'n_user_access' => $role_list->c_role_list
			            );

			            $this->session->set_userdata($data_res);

			            $browser  = $this->agent->browser();
			            $version  = $this->agent->version();
			            $robot    = $this->agent->robot();
			            $mobile   = $this->agent->is_mobile();
			            $platform = $this->agent->platform();

			            $log_val = array(
				        	'n_user_id'      => $n_id,
				        	'c_browser'      => empty_check($browser),
				        	'c_version'      => empty_check($version),
				        	'c_robot'        => empty_check($robot),
				        	'c_mobile'       => empty_check($mobile),
				        	'c_platform'     => empty_check($platform),
				        	'dt_logged_date' => $cur_dt,
				        );

		            	$log_ins = $this->login_model->userLogin_insert($log_val);

		            	$response['status']  = 1;
				        $response['message'] = response_msg('login_success');  
				        $response['data']    = $data_res;
				        echo json_encode($response);
			        	return; 
		            }
		        }
		        else
		        {
		        	$response['status']  = 0;
			        $response['message'] = response_msg('invalid_login');  
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
		        }
			}

			else if($method == '_verifyOTP')
			{
				$error    = FALSE;
				$required = array('email', 'otp_res');

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

		    	$start_time = date('H:i:s', strtotime($cur_time.' - 10 minutes'));
			    $end_time   = date('H:i:s', strtotime($cur_time.' + 10 minutes'));

			    $otp_whr = array(
		    		'c_emailid'  => $email,
		    		'n_otp'      => $otp_res,
		    		'n_verify'   => 1,
		    		'dt_date'    => $cur_date,
		    		'dt_time >=' => $start_time,
		    		'dt_time <=' => $end_time,
		    	);

			    $otp_col  = 'n_id';
		    	$otp_res  = $this->login_model->getEmailOtp($otp_whr, '', '', 'row', '', '', '', '', $otp_col);

		    	if(!empty($otp_res))
		    	{	
		    		$otp_id   = empty_check($otp_res->n_id);

		    		$upt_data = array(
					    'n_verify'        => 2,
					    'dt_updated_date' => date('Y-m-d H:i:s'),
			    	);

			    	$upt_whr  = array('n_id' => $otp_id);
			    	$upt_otp  = $this->login_model->emailOtp_update($upt_data, $upt_whr);

			    	// User details
			    	$log_whr = array(
			        	'c_emailid'  => $email,
			        	'n_status'   => 1,
			        	'n_delete'   => 1,
			        );

			    	$log_col  = 'n_id, c_full_name, c_short_name, c_emailid,  n_role,n_accessible_role, n_auth';
			        $log_data = $this->login_model->getLoginStatus($log_whr, '', '', 'row', '', '', '', '', $log_col);

			        if(!empty($log_data))
			        {

			        	$role_whr  = array('n_id' => $n_role);
		        		$role_col  = 'n_id, c_role_title,c_role_list';
		        		$this->load->model('app_model/role_model', NULL, TRUE);
		        		$role_list = $this->role_model->getRole($role_whr, '', '', 'row', '', '', '', '', $role_col);

			        	$n_id        = empty_check($log_data->n_id);
			            $c_full_name = empty_check($log_data->c_full_name);
			            $c_emailid   = empty_check($log_data->c_emailid);
			            $n_role = empty_check($log_data->n_role);
			            $n_accessible_role = empty_check($log_data->n_accessible_role);
			            $n_auth      = empty_check($log_data->n_auth);

			            $data_res  = array(
			            	'n_id'         => $n_id,
			            	'c_full_name'  => $c_full_name,
			            	'hide_email'   => '',
			            	'c_emailid'    => $c_emailid,
			            	'n_role'  	   => $n_role,
			            	'n_accessible_role'	=> $n_accessible_role,
			            	'n_auth'       => $n_auth,
			            	'log_verify'   => 2,
			            	'log_url'      => 'app/dashboard',
			            	'random_value' => generateRandomString(32),
			            	'layout_view'  => 'sun',
			            	'c_role_title' => $role_list->c_role_title,
			            	'n_user_access' => $role_list->c_role_list
			            );

			            $this->session->set_userdata($data_res);

			            $log_val = array(
				        	'n_user_id'      => $n_id,
				        	'dt_logged_date' => $cur_dt,
				        );

		            	$log_ins = $this->login_model->userLogin_insert($log_val);

		            	$response['status']  = 1;
				        $response['message'] = response_msg('login_success');  
				        $response['data']    = $data_res;
				        echo json_encode($response);
		        		return; 
			        }
			        else
			        {
			        	$response['status']  = 0;
				        $response['message'] = response_msg('invalid_login');  
				        $response['data']    = [];
				        echo json_encode($response);
				        return; 
			        }
		    	}
		    	else
		    	{
		    		$response['status']  = 0;
			        $response['message'] = response_msg('invalid_otp');  
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
		    	}
			}

			else if($method == '_resendOTP')
			{
				$error    = FALSE;
				$required = array('email');

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

		    	// Send OTP
            	$randomOtp = generateRandomnumber(6);

            	$otp_data = array(
		        	'c_emailid'       => $email,
		        	'n_otp'           => $randomOtp,
		        	'dt_date'         => $cur_date,
		        	'dt_time'         => $cur_time,
		        	'dt_created_date' => $cur_dt,
		        );

            	$otp_ins   = $this->login_model->emailOtp_insert($otp_data);
            	// $otp_email = $this->email_temp->otp_template($c_full_name, $c_emailid, $randomOtp);

            	$exp_value = explode('@', $email);
            	$frt_name  = $exp_value[0];
	            $sed_name  = $exp_value[1];
	            $frt_value = mb_strimwidth($frt_name, 0, 3);
	            $send_link = $frt_value.'xxxx@'.$sed_name;

	            $data_res  = array(
	            	'hide_email' => $send_link,
	            	'c_emailid'  => $email,
	            );

            	$response['status']  = 1;
		        $response['message'] = response_msg('otp_success');  
		        $response['data']    = $data_res;

		        echo json_encode($response);
		        return; 
			}

			else
			{
				$page['directory']    = "app";
		    	$page['cntrl']        = "login";
		    	$page['func']         = "index";
		    	$page['data_value']   = "";
				$page['page_title']   = "Home";
				$page['page_heading'] = "Home";
				$data['page_temp']    = $this->load->view('app_view/login',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Login Page";
				$data['currentmenu']  = "";
				$this->bassthaya->load_login_template($data);
			}
		}
	}
?>
