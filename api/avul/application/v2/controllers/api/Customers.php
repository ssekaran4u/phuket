<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Customers extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model('app_model/customer_model');
			$this->load->model('app_model/vendor_coupon_model');
		}
		public function sendOTP() {
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: POST');
			header('Content-Type: application/json; charset=utf-8');
			$c_line = $this->input->post('c_line');

			if(!empty($c_line)) {
				if(validateCountryPhone($c_line,2))
		        {
		            $response['status']  = 0;
			        $response['message'] = $c_line. " No. does not appear to be valid"; 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
		        }

				$like = [];
	    		$where = array('n_verify' => 1 ,'c_line'=>$c_line);
				$option['order_by']   = 'n_id';
				$option['disp_order'] = 'ASC';
				$res_column = 'n_id';
				$checkMobile  = $this->customer_model->getCustomer($where, '', '', 'row', $like, '', $option, '', $res_column);
				// echo $this->db->last_query();die();
				if($checkMobile) {
					$response['n_status']   = 0;  
		            $response['j_result']   = [];  
		            $response['c_message']  = "Line number already exist";
		            echo json_encode($response);
		            return;	
				} else {
					$randomNumber = generateRandomNumber(6);
	    			$ins_otp_data = array(
    					'n_mobile' => $c_line,
    					'n_otp'	=> $randomNumber,
	    				'dt_created_at' => date('Y-m-d H:i:s')
	    			);

					$o_insert = $this->customer_model->insertOTP($ins_otp_data);

	    			if($o_insert)
				    {
	        			$response['status']  = 1;
				        $response['message'] = "OTP Sent Successfully"; 
				        $response['data']    = [];
				        echo json_encode($response);
				        return; 
				    }
				    else
				    {
	        			$response['status']  = 0;
				        $response['message'] = "Getting an error. Try after sometime"; 
				        $response['data']    = [];
				        echo json_encode($response);
				        return; 
				    }
				}
			} else {
				$response['n_status']   = 0;  
	            $response['j_result']   = [];  
	            $response['c_message']  = "Enter line number";
	            echo json_encode($response);
	            return;
			}
		}

		public function verifyOTP() {
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: POST');
			header('Content-Type: application/json; charset=utf-8');
			$error = FALSE;
			$required = array('n_otp','c_line','c_full_name');
			
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
		        echo json_encode($response); return; 
		    }

		    $c_full_name = $this->input->post('c_full_name');
			$c_short_name = $this->input->post('c_short_name');
			$c_emailid = $this->input->post('c_emailid');
			$c_password = $this->input->post('c_password');
			$c_line = $this->input->post('c_line');
			$c_address = $this->input->post('c_address');
			$n_otp = $this->input->post('n_otp');

		    $like = [];
    		$where = array('n_verify' => 1 ,'n_mobile' => $c_line);
			$option['order_by']	= 'n_id';
			$option['disp_order'] = 'DESC';
			$res_column = 'n_id';
			$checkMobile  = $this->customer_model->getOtp($where, '', '', 'row', $like, '', $option, '', $res_column);
			if($checkMobile) {
				$ins_cus_data = array(
					'c_full_name' => str_value($c_full_name,3),
					'c_short_name' => !empty($c_short_name) ? str_value($c_short_name,3) : '',
					'c_emailid' => !empty($c_emailid) ? str_value($c_emailid,3) : '',
					'c_address' => !empty($c_address) ? str_value($c_address,3) : '',
					'c_password' => !empty($c_password) ? str_value($c_password,3) : '',
					'c_line' => $c_line,
					'dt_created_at'=>date('Y-m-d H:i:s'),
					'n_verify'=>1
				);
				$this->customer_model->updateOTP(array('n_verify' => 2), $where);
				$o_insert = $this->customer_model->insert($ins_cus_data);
				if($o_insert)
			    {
			    	$showData = array(
			    		'n_id'=>$o_insert,
			    		'c_full_name' => str_value($c_full_name,3),
						'c_short_name' => !empty($c_short_name) ? str_value($c_short_name,3) : '',
						'c_emailid' => !empty($c_emailid) ? str_value($c_emailid,3) : '',
						'c_address' => !empty($c_address) ? str_value($c_address,3) : '',
						'c_line' => $c_line,
			    	);

        			$response['status']  = 1;
			        $response['message'] = "Customer register successfully"; 
			        $response['data']    = [$showData];
			        echo json_encode($response);
			        return; 
			    }
			    else
			    {
        			$response['status']  = 0;
			        $response['message'] = "Getting an error. Try after sometime"; 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
			    }
			} else {
				$response['n_status']   = 0;  
	            $response['j_result']   = [];  
	            $response['c_message']  = "Invalid OTP";
	            echo json_encode($response);
	            return;
			}
		}

		public function profile() {
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: POST');
			header('Content-Type: application/json; charset=utf-8');
			$n_userId = $this->input->post('n_user');
			if(!empty($n_userId)) {
				$like = [];
	    		$where = array('n_id' => $n_userId, 'n_status' => 1, 'n_delete' => 1);
				$option['order_by']   = 'n_id';
				$option['disp_order'] = 'ASC';
				$res_column = 'n_id,c_full_name,c_short_name,c_emailid,c_address,c_line,c_profile,dt_created_at';
				$checkMobile  = $this->customer_model->getCustomer($where, '', '', 'row', $like, '', $option, '', $res_column);

				if($checkMobile)
				{
					$showData = array(
			    		'n_id'=>$checkMobile->n_id,
						'c_line' => !empty($checkMobile->c_line) ? $checkMobile->c_line : '',
			    		'c_full_name' => !empty($checkMobile->c_full_name) ? $checkMobile->c_full_name : '',
			    		'c_short_name' => !empty($checkMobile->c_short_name) ? $checkMobile->c_short_name : '',
			    		'c_emailid' => !empty($checkMobile->c_emailid) ? $checkMobile->c_emailid : '',
			    		'c_address' => !empty($checkMobile->c_address) ? $checkMobile->c_address : '',
			    		'c_user_since' => !empty($checkMobile->dt_created_at) ? date_check($checkMobile->dt_created_at) : '',
			    		'c_profile' => !empty($checkMobile->c_profile) ? $checkMobile->c_profile : '',
			    	);

					$response['n_status']   = 1;  
		            $response['j_result']   = [$showData];  
		            $response['c_message']  = "";
		            echo json_encode($response);
		            return;
	            }
	            else {
	            	$response['n_status']   = 0;  
		            $response['j_result']   = [];  
		            $response['c_message']  = "User not available";
		            echo json_encode($response);
		            return;	
	            }
			} else {
				$response['n_status']   = 0;  
	            $response['j_result']   = [];  
	            $response['c_message']  = "User ID not available";
	            echo json_encode($response);
	            return;
			}
		}

		public function downloadCoupon() {

			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: POST');
			header('Content-Type: application/json; charset=utf-8');
			$error = FALSE;
			$required = array('n_user','n_coupon','n_vendor');
			
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

		    $n_userId = $this->input->post('n_user');
		    $n_coupon = $this->input->post('n_coupon');
			$n_vendor = $this->input->post('n_vendor');

    		$where = array('n_id' => $n_userId, 'n_status' => 1, 'n_delete' => 1);
			$option['order_by']   = 'n_id';
			$option['disp_order'] = 'ASC';
			$res_column = 'n_id';
			$checkUser  = $this->customer_model->getCustomer($where, '', '', 'row', [], '', $option, '', $res_column);

			if($checkUser) {
	    		$c_where = array('n_vendor' => $n_vendor,'n_coupon' => $n_coupon, 'n_status' => 1, 'n_delete' => 1);
				$checkCoupons  = $this->vendor_coupon_model->getCouponDetail($c_where, '', '', 'row', [], '', $option, '', $res_column);
				if($checkCoupons) {
					$c_d_where = array(
						'n_user' => $n_userId,
						'n_vendor' => $n_vendor,
						'n_coupon' => $n_coupon,
						'n_status' => 1,
						'n_delete' => 1);

					$checkDownloadedCoupon  = $this->customer_model->getDownloadedCoupon($c_d_where, '', '', 'row', [], '', $option, '', $res_column);
					if($checkDownloadedCoupon) {
						$response['n_status']   = 0;
			            $response['j_result']   = [];
			            $response['c_message']  = "Already coupon downloaded";
			            echo json_encode($response);
			            return;	
					}
					else {
						$ins_cus_data = array(
							'n_user' => $n_userId,
							'n_coupon' => $n_coupon,
							'n_coupon_det'=> $checkCoupons->n_id,
							'n_vendor' => $n_vendor,
							'dt_created_at'=>date('Y-m-d H:i:s')
						);

						$insertDcoupon  = $this->customer_model->downloadCoupon($ins_cus_data);
						if($insertDcoupon)
						{
							$response['n_status']   = 1;
				            $response['j_result']   = [];
				            $response['c_message']  = "Coupon downloaded successfully";
				            echo json_encode($response);
				            return;	
			            }
			            else
					    {
		        			$response['status']  = 0;
					        $response['message'] = "Getting an error. Try after sometime"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
					    }
		            }
				} else {
					$response['n_status']   = 0;  
		            $response['j_result']   = [];  
		            $response['c_message']  = "Coupon not available";
		            echo json_encode($response);
		            return;	
				}
			} else {
				$response['n_status']   = 0;  
	            $response['j_result']   = [];  
	            $response['c_message']  = "User not available";
	            echo json_encode($response);
	            return;
			}
		}
	}
?>