<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Vendor_coupon extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/vendor_coupon_model');
		}

		public function index($param1="", $param2="", $param3="")
		{
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL.'/app/dashboard', 'refresh');
		}

		function searchForId($id, $array) {
		   foreach ($array as $key => $val) {
		       if($val->n_id == $id) {
		           return $val->n_vailidity;
		       }
		   }
		   return null;
		}

		public function add($param1="", $param2="", $param3="")
		{
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');
        	$formpage = $this->input->post('formpage');
        	$active_user = $this->session->get_userdata()['n_id'];
        	if($formpage == 'BTBM_X_P')
        	{
        		$n_id = $this->input->post('n_id');
			    $n_vendor = $this->input->post('n_vendor');
			    $n_coupon = $this->input->post('n_coupons');
			    $n_callto_confirm = $this->input->post('n_callto_confirm');
			    $n_approve_supervisor = $this->input->post('n_approve_supervisor');
			    $n_approve_admin = $this->input->post('n_approve_admin');

			    $method = $this->input->post('method');
			    $n_status = $this->input->post('n_status');


			    $random_val	= generateRandomString(32);

			    $error = FALSE;
			    $errors = array();
				$required = array('n_vendor','n_coupons');
				
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
		    		if(userAccess('vendor_add') == TRUE)
		    		{
		    			foreach ($n_coupon as $coupon_value) {
				    		$coupon_check = array(
				    			'n_vendor' => $n_vendor,
				    			'n_coupon' => $coupon_value,
			    				'n_status' => 1,
			    				'n_delete' => 1,
			    			);
			    			if($active_user>1) {
			    				$coupon_check['n_created_by'] = $active_user;
			    			}
							$exs_res = $this->vendor_coupon_model->getCouponDetail($coupon_check, '', '', 'row', '', '', '', '', 'n_id');
							if($exs_res)
							{
								$response['status']  = 0;
						        $response['message'] = "Coupons already assigned to this vendor. Please check"; 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
							}
		    			}

		    			$coupon_whr  = array('n_status' => 1, 'n_delete' => 1);
			    		$coupon_col  = 'n_id, n_vailidity';
			    		$this->load->model('app_model/coupon_model', NULL, TRUE);
			    		$coupon_list = $this->coupon_model->getCoupon($coupon_whr, '', '', 'result', '', '', '', '', $coupon_col);

			    		$i = 0;
		    			foreach ($n_coupon as $coupon_) {
		    				// $coupon_
		    				$_callaction = 2;
		    				if($n_callto_confirm && sizeof($n_callto_confirm)>0)
		    				{
		    					if(in_array($coupon_, $n_callto_confirm))
		    					{
		    						$_callaction = 1;
		    					}
		    				}
		    				$n_vailidity_ = $this->searchForId($coupon_,$coupon_list);
							$coupon_de = array(
		    					'n_vendor' => $n_vendor,
		    					'n_coupon' => $coupon_,
		    					'n_vailidity' => $n_vailidity_,
		    					'n_calltoconfirm' => $_callaction,
			    				'n_created_by' => $this->session->userdata('n_id'),
			    				'dt_created_at' => date('Y-m-d H:i:s'),
			    			);
			    			$this->vendor_coupon_model->insert_coupon_detail($coupon_de);
			    			$i++;
			    		}

			    		$ins_bulk = array(
		    					'n_vendor' => $n_vendor,
		    					'n_coupons' => $i,
			    				'n_created_by' => $this->session->userdata('n_id'),
			    				'dt_created_at' => date('Y-m-d H:i:s'),
			    			);
			    		$insert = $this->vendor_coupon_model->insert_coupon($ins_bulk);
			    		// die();
		    			if($insert)
					    {
		        			$response['status']  = 1;
					        $response['message'] = "Coupon added successfully"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
					    }
					    else
					    {
		        			$response['status']  = 0;
					        $response['message'] = "Something went wrong. Please try again"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
				    	}
			    	}
			    	else
	        		{
	        			$response['status']  = 0;
				        $response['message'] = response_msg('access_denied'); 
				        $response['data']    = [];
				        echo json_encode($response);
				        return; 
	        		}
			    }
			    else
		    	{
		    		if(userAccess('vendor_edit') == TRUE)
		    		{
			    		$n_status_ = $n_status ? 1 : 2;
		    			$data_whr = array('n_id' => $n_id, 'n_delete' => 1);
		    			$data_col = 'n_id, n_vendor,n_status';
		    			$data_res = $this->vendor_coupon_model->getCoupon($data_whr, '', '', 'row', '', '', '', '', $data_col);
		    			// echo $this->db->last_query();die();
		    			// print_r($data_res);die();
		    			
		    			$data_whr_cou_det = array('n_vendor' => $data_res->n_vendor, 'n_delete' => 1);
		    			$data_cou_detcol = 'n_id, n_vendor,n_coupon,n_vailidity';
		    			$data_cou_det_res = $this->vendor_coupon_model->getCouponDetail($data_whr_cou_det, '', '', 'result', '', '', '', '', $data_cou_detcol);

		    			$exCoupons = [];
		    			if($data_cou_det_res)
		    			{	
		    				foreach ($data_cou_det_res as $key => $ata_cou_) {
		    					array_push($exCoupons, $ata_cou_->n_coupon);
		    				}
		    			}

		    			$coupon_whr  = array('n_status' => 1, 'n_delete' => 1);
			    		$coupon_col  = 'n_id, n_vailidity';
			    		$this->load->model('app_model/coupon_model', NULL, TRUE);
			    		$coupon_list = $this->coupon_model->getCoupon($coupon_whr, '', '', 'result', '', '', '', '', $coupon_col);

		    			$i = 0;
		    			foreach ($n_coupon as $coupon_) {
		    				if(in_array($coupon_, $exCoupons))
		    				{
		    					$_callaction = 2;
		    					$approve_supervisor = 2;
		    					$approve_admin = 2;
			    				
			    				if($n_callto_confirm && sizeof($n_callto_confirm)>0)
			    				{
			    					if(in_array($coupon_, $n_callto_confirm))
			    					{
			    						$_callaction = 1;
			    					}
			    				}

			    				if($n_approve_supervisor && sizeof($n_approve_supervisor)>0)
			    				{
			    					if(in_array($coupon_, $n_approve_supervisor))
			    					{
			    						$approve_supervisor = 1;
			    					}
			    				}

			    				if($n_approve_admin && sizeof($n_approve_admin)>0)
			    				{
			    					if(in_array($coupon_, $n_approve_admin))
			    					{
			    						$approve_admin = 1;
			    					}
			    				}

		    					$n_vailidity_ = $this->searchForId($coupon_,$coupon_list);
								$coupon_de = array(
									'n_calltoconfirm' => $_callaction,
									'n_is_approve_supervisor' => $approve_supervisor,
									'n_is_approve_admin' => $approve_admin,
			    					'n_vailidity' => $n_vailidity_,
				    				'n_status' => 1,
				    				'n_updated_by' => $this->session->userdata('n_id'),
				    				'dt_updated_at' => date('Y-m-d H:i:s')
				    			);

				    			$coupon_de_whr = array('n_vendor'=>$n_vendor, 'n_coupon' => $coupon_);
				    			$this->vendor_coupon_model->update_coupon_detail($coupon_de, $coupon_de_whr);

				    			// echo $this->db->last_query();die();
				    			$i++;
		    				}
			    		}

			    		foreach ($exCoupons as $excoupon) {
			    			if(!in_array($excoupon, $n_coupon))
		    				{
			    				// echo "1";
			    				$_callaction = 2;
			    				$approve_supervisor = 2;
		    					$approve_admin = 2;
			    				if($n_callto_confirm && sizeof($n_callto_confirm)>0)
			    				{
			    					if(in_array($excoupon, $n_callto_confirm))
			    					{
			    						$_callaction = 1;
			    					}
			    				}
			    				if($n_approve_supervisor && sizeof($n_approve_supervisor)>0)
			    				{
			    					if(in_array($excoupon, $n_approve_supervisor))
			    					{
			    						$approve_supervisor = 1;
			    					}
			    				}

			    				if($n_approve_admin && sizeof($n_approve_admin)>0)
			    				{
			    					if(in_array($excoupon, $n_approve_admin))
			    					{
			    						$approve_admin = 1;
			    					}
			    				}

		    					$coupon_de = array(
				    				'n_status' => 2,
				    				'n_calltoconfirm' => $_callaction,
				    				'n_is_approve_supervisor' => $approve_supervisor,
									'n_is_approve_admin' => $approve_admin,
				    				'n_updated_by' => $this->session->userdata('n_id'),
				    				'dt_updated_at' => date('Y-m-d H:i:s')
				    			);

				    			$coupon_dse_whr = array('n_vendor'=>$n_vendor, 'n_coupon' => $excoupon);
				    			$this->vendor_coupon_model->update_coupon_detail($coupon_de, $coupon_dse_whr);

				    			// echo $this->db->last_query();die();
		    				}
			    		}

			    		$ins_bulk = array(
		    					'n_coupons' => $i,
			    				'n_status' => $n_status_,
			    				'n_updated_by' => $this->session->userdata('n_id'),
			    				'dt_updated_at' => date('Y-m-d H:i:s')
			    			);
			    		$upt_whr_fin = array('n_id' => $n_id,'n_vendor'=>$n_vendor);
			    		$insert = $this->vendor_coupon_model->update_coupon($ins_bulk,$upt_whr_fin);
			    		// echo $this->db->last_query();die();
			    		// die();
		    			if($insert)
					    {
		        			$response['status']  = 1;
					        $response['message'] = "Coupon updated successfully"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
					    }
					    else
					    {
		        			$response['status']  = 0;
					        $response['message'] = "Something went wrong. Please try again"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
				    	}

		    			// echo $this->db->last_query();
		    			// print_r($data_res);
			    	}
		    	}
	        }
	        else 
	        {
        		$coupon_whr  = array('n_status' => 1, 'n_delete' => 1);
        		$coupon_col  = 'n_id, n_type, n_spend_amount, c_coupon, n_discount_percentage, n_coupon_price, n_vailidity';
        		$this->load->model('app_model/coupon_model', NULL, TRUE);
        		$coupon_list = $this->coupon_model->getCoupon($coupon_whr, '', '', 'result', '', '', '', '', $coupon_col);
        		$user_whr  = array('n_created_by' => $active_user);
	    		$user_col  = 'n_id';
	    		$this->load->model('app_model/user_model', NULL, TRUE);
	    		$user_list = $this->user_model->getUser($user_whr, '', '', 'result', '', '', '', '', $user_col);
        		// echo $this->db->last_query();die();
	    		$_userlist = [];
	    		if($user_list)
	    		{
	    			foreach ($user_list as $user_list) {
	    				array_push($_userlist, $user_list->n_id);
	    			}
	    		}

        		$vendor_whr = array('A.n_status' => 1, 'A.n_delete' => 1,'A.n_type' => 1);
    			if($active_user>1)
	    		{
	    			array_push($_userlist,$active_user);
	    			$vendor_whr['A.n_created_by'] = implode(",", $_userlist);
	    		}

        		$vendor_col = 'A.n_id,A.n_type, A.n_created_by as n_agent_id, A.c_name, A.c_c_contact_number, A.dt_created_on, A.n_verified, A.n_dormant, A.n_status, B.c_full_name AS c_agent,B.n_created_by as n_supervisior_id, C.c_full_name AS c_supervisior, D.c_city, E.c_category,A.n_suggest';
        		$this->load->model('app_model/vendor_model', NULL, TRUE);
        		$vendor_list = $this->vendor_model->getJoinVendor($vendor_whr, '', '', 'result', '', '', '', '', $vendor_col);
        		// echo $this->db->last_query();die();
        		// print_r($coupon_list);die();
        		if($param1 == 'Edit')
        		{
        			$data_whr = array('n_id' => $param2, 'n_delete' => 1);
	    			$data_col = 'n_id, n_vendor,n_status,n_created_by';
	    			$data_res = $this->vendor_coupon_model->getCoupon($data_whr, '', '', 'row', '', '', '', '', $data_col);
	    			// echo $this->db->last_query();die();
	    			$data_whr_cou_det = array('n_vendor' => $data_res->n_vendor, 'n_delete' => 1, 'n_status' => 1);
	    			$data_cou_detcol = 'n_id, n_vendor,n_coupon,n_calltoconfirm,n_vailidity,n_is_approve_supervisor,n_is_approve_admin';
	    			$data_cou_det_res = $this->vendor_coupon_model->getCouponDetail($data_whr_cou_det, '', '', 'result', '', '', '', '', $data_cou_detcol);

	    			if($this->session->get_userdata()['n_accessible_role']!='')
					{
		    			$user_whr  = array('n_created_by' => $active_user);
			    		$user_col  = 'n_id';
			    		$this->load->model('app_model/user_model', NULL, TRUE);
			    		$super_user = $this->user_model->getUser($user_whr, '', '', 'row', '', '', '', '', $user_col);
			    		$page['super_user']  = $super_user->n_id;
			    	}
		    		// print_r($super_user);die();
	    			$selectedCoupons = [];
	    			$calltoconfirm = [];
	    			$approve_admin = [];
	    			$approve_supervisor = [];
	    			if($data_cou_det_res)
	    			{	
	    				foreach ($data_cou_det_res as $key => $ata_cou_) {
	    					if($ata_cou_->n_calltoconfirm==1){
	    						array_push($calltoconfirm, $ata_cou_->n_coupon);
	    					}
	    					if($ata_cou_->n_is_approve_supervisor==1) {
	    						array_push($approve_supervisor, $ata_cou_->n_coupon);
	    					}
	    					if($ata_cou_->n_is_approve_admin==1) {
	    						array_push($approve_admin, $ata_cou_->n_coupon);
	    					}
	    					array_push($selectedCoupons, $ata_cou_->n_coupon);
	    				}
	    			}

	    			// echo in_array(2, $selectedCoupons);
	    			// print_r($selectedCoupons);die();
        			$page['approve_supervisor']  = $approve_supervisor;
        			$page['approve_admin'] = $approve_admin;
        			$page['dataval'] = $data_res;
        			$page['dataval_cou_det']= $selectedCoupons;
        			$page['calltoconfirm']= $calltoconfirm;
					$page['method']     = '_Edit';
					$page['page_title'] = "Edit Vendor Coupon";
        		}
        		else
        		{
        			$page['dataval']    = '';
					$page['method']     = '_Create';
					$page['page_title'] = "Create Vendor Coupon";
        		}

        		$page['active_user']  = $active_user;
        		$page['vendor_list']  = $vendor_list;
        		$page['coupon_list']  = $coupon_list;
        		$page['role_access']  = userAccess('coupon_view');
        		$page['formpage']     = "BTBM_X_P";
        		$page['directory']    = "app";
		    	$page['cntrl']        = "vendor-coupon";
		    	$page['func']         = "add";
				$page['main_heading'] = "Vendor Coupon";
				$page['pre_title']    = "Manage Vendor Coupon";
				$page['pre_menu']     = "app/vendor-coupon/manage";
				$data['page_temp']    = $this->load->view('app_view/vendor_coupon/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Create Vendor Coupon";
				$data['currentmenu']  = "vendorcoupon";
				$this->bassthaya->load_form_template($data);
        	}
        }

		public function manage($param1="", $param2="", $param3="")
		{

			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');
        	// var_dump($_SESSION);die();
        	// $active_role = $this->session->get_userdata()['n_role'];	
        	$active_user = $this->session->get_userdata()['n_id'];
        	$method = $this->input->post('method');

        	if($method == 'data_list')
        	{
        		if($active_user>1){
	        		$user_whr  = array('n_created_by' => $active_user);
		    		$user_col  = 'n_id';
		    		$this->load->model('app_model/user_model', NULL, TRUE);
		    		$user_list = $this->user_model->getUser($user_whr, '', '', 'result', '', '', '', '', $user_col);
		    		$_userlist = [];
		    		if($user_list)
		    		{
		    			array_push($_userlist, $active_user);
		    			foreach ($user_list as $user_list) {
		    				array_push($_userlist, $user_list->n_id);
		    			}
		    		}
	    		}

        		if(userAccess('vendor_view') == TRUE)
        		{
	        		$_limit   = $this->input->post('limitval');
	            	$page     = $this->input->post('page');
	            	$search   = $this->input->post('search');
	            	$cur_page = isset($page)?$page:1;
	            	$_offset  = ($cur_page-1) * $_limit;
	            	$nxt_page = $cur_page + 1;
	            	$pre_page = $cur_page - 1;
	            	$page_val = $cur_page * $_limit;

	            	if($_limit !='')
					{
						$limit  = $_limit;
						$offset = $_offset;
					}
					else
					{
						$limit  = 10;
						$offset = 0;
					}

					if($search !='')
		    		{
		    			$like['name'] = $search;
		    		}
		    		else
		    		{
		    			$like = [];
		    		}
		    		$where_in = [];
		    		// $where_in = array('A.n_delete' => 1);
		    		$where       = array('A.n_delete' => 1);
		    		if($active_user>1)
		    		{
			    		if($this->session->get_userdata()['n_accessible_role']){
			        		// echo $active_user; my users [select by n_created_by]
			        		$where_in['A.n_created_by'] = implode(",", $_userlist);
			        	}
			        	else {
			        		$where['A.n_created_by'] = $active_user;
			        	}
		        	}
		        	// print_r($where_in);die();
		    		// if($active_user>1)
		    		// {
		    		// 	$where['A.n_created_by'] = $active_user;
		    		// }

					$overall_col = $this->vendor_coupon_model->getJoinCoupon($where, '', '', "row", $like, [], [], TRUE, 'COUNT(A.n_id) AS autoid', $where_in);
					$total_count = !empty($overall_col->autoid)?$overall_col->autoid:0;

					$option['order_by']   = 'A.n_id';
	    			$option['disp_order'] = 'DESC';

	    			$res_column = 'A.n_id,A.n_coupons,A.dt_created_at,A.dt_updated_at,B.c_name,A.n_status';
	    			$data_list  = $this->vendor_coupon_model->getJoinCoupon($where, $limit, $offset, 'result', $like, '', $option, '', $res_column, $where_in);
	    			// echo $this->db->last_query();die();
	    			if($data_list)
	    			{
	    				$count    = count($data_list);
		            	$tot_page = ceil($total_count / $limit); 

	    				$status  = 1;
		            	$message = response_msg('success_message',4);
		            	$table   = '';
		            	
		            	$i=1;
	    	            foreach ($data_list as $key => $val) {
	    	            	$n_id             = empty_check($val->n_id);
	    	            	$n_coupons       = empty_check($val->n_coupons);
	    	            	$c_name       = empty_check($val->c_name);
				            $n_status         = zero_check($val->n_status);
				            $dt_created_date  = date_check($val->dt_created_at);
				            $dt_updated_date  = date_check($val->dt_updated_at);

				            $edit = '<a href="'.BASE_URL.'app/vendor-coupon/add/Edit/'.$n_id.'" class="btn btn-warning waves-effect waves-light" style="padding: 8px;"><i class="icon-pencil"></i></a>';

				            // $delete = '<span data-directory="app" data-cntrl="vendor-coupon" data-func="manage" data-id="'.$n_id.'" class="del_btn btn btn-danger waves-effect waves-light" style="margin-left: 4px; padding: 8px; cursor: pointer;"><i class="icon-trash"></i></span>';
				            $delete = '';
	    	            	$table .= '
	    	            		<tr class="row_'.$n_id.'">
	    	            			<td>'.$i.'</td>
	    	            			<td>'.str_compress($c_name, 25).'</td>
	    	            			<td>'.$n_coupons.'</td>
	                                <td>'.active_status($n_status).'</td>
	                                <td>'.$dt_created_date.'</td>
	                                <td>'.$dt_updated_date.'</td>
	                                <td>'.$edit.$delete.'</td>
	    	            		</tr>
	    	            	';
	    	            	$i++;
	    	            }

	    	            $prev    = '';

	    	            $next = '
			        		<tr>
			        			<td>';
			        				if($cur_page >= 2):
			        				$next .='<span data-page="'.$pre_page.'" class="pages btn btn-warning waves-effect waves-light" style="margin-right: 10px;">Previous</span>';
			        				endif;
			        			$next .= '</td>
			        			<td>';
			        				if($tot_page > $cur_page):
			        				$next .='<span data-page="'.$nxt_page.'" class="pages btn btn-success waves-effect waves-light">Next</span>';
			        				endif;
			        			$next .='</td>
			        		</tr>
			        	';
	    			}
	    			else
	            	{
	            		$status     = 0;
		            	$message    = response_msg('no_data');
		            	$table      = '';
		            	$next       = '';
		            	$prev       = '';
	            	}

	            	if($offset == 0)
	                {
	                    $offset_val = 1;
	                }
	                else
	                {
	                    $offset_val = $offset + 1;
	                }

	                if($total_count >= $page_val)
	                {
	                	$new_page = $page_val;
	                }
	                else
	                {
	                	$new_page = $total_count;
	                }

	                $page_value = '<span class="datadeatils ml-10 lh-40">Showing '.$offset_val.' to '.$new_page.' of '.$total_count.' entries</span>';

	                // Total Records
		            $whr_1 = array('n_delete' => 1);
	                if($active_user>1)
    				{
    					if($this->session->get_userdata()['n_accessible_role'])
			        	{
			        		$whr_1['n_created_by'] = implode(",", $_userlist);
			        	}
			        	else {
			        		$whr_1['n_created_by'] = $active_user;
			        	}
		            }
					$res_1 = $this->vendor_coupon_model->getCoupon($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_1 = !empty($res_1->autoid)?$res_1->autoid:0;

	                // Active Records
	                $whr_2 = array('n_status' => 1, 'n_delete' => 1);
	                if($active_user>1)
    				{
    					if($this->session->get_userdata()['n_accessible_role'])
			        	{
			        		$whr_2['n_created_by'] = implode(",", $_userlist);
			        	}
			        	else {
			        		$whr_2['n_created_by'] = $active_user;
			        	}
					}
					$res_2 = $this->vendor_coupon_model->getCoupon($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_2 = !empty($res_2->autoid)?$res_2->autoid:0;
					// echo $this->db->last_query();die();
	                // Inactive Records
	                $whr_3 = array('n_status' => 2, 'n_delete' => 1);
	                if($active_user>1)
    				{
    					if($this->session->get_userdata()['n_accessible_role'])
			        	{
			        		$whr_3['n_created_by'] = implode(",", $_userlist);
			        	}
			        	else {
			        		$whr_3['n_created_by'] = $active_user;
			        	}
					}

					$res_3 = $this->vendor_coupon_model->getCoupon($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');

					$cnt_3 = !empty($res_3->autoid)?$res_3->autoid:0;

					$records = array(
						'total_record'    => $cnt_1,
						'active_record'   => $cnt_2,
						'inactive_record' => $cnt_3,
					);

					// print_r($records);die();

	            	$response['status']   = $status;  
	                $response['result']   = $table;  
	                $response['message']  = $message;
	                $response['next']     = $next;
	                $response['prev']     = $prev;
	                $response['page_val'] = $page_value;
	                $response['records']  = $records;
	                echo json_encode($response);
	                return;
	            }
	            else
        		{
        			$response['status']  = 0;
			        $response['message'] = response_msg('access_denied'); 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
        		}
        	}	
        	else if($method == 'data_delete')
        	{
        		if(userAccess('vendor_delete') == TRUE)
        		{
	        		$n_id = $this->input->post('n_id');

	        		$error = FALSE;
				    $errors = array();
					$required = array('n_id');
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

				    if(count($errors)==0)
				    {
				    	$del_data = array(
		        			'n_delete'      => 2,
		        			'n_deleted_by'  => $this->session->userdata('n_id'),
					    	'dt_deleted_on' => date('Y-m-d H:i:s'),
		        		);

				    	$del_whr  = array('n_id' => $n_id);
				    	if($active_user>1)
				    	{
				    		$del_whr['n_created_by'] = $active_user;
				    	}

		       
		    			$del_upt  = $this->vendor_coupon_model->update($del_data, $del_whr);

		    			// Total Records
		                $whr_1 = array('n_delete' => 1);
		                if($active_user>1)
				    	{
				    		$whr_1['n_created_by'] = $active_user;
				    	}
						$res_1 = $this->vendor_coupon_model->getUser($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_1 = !empty($res_1->autoid)?$res_1->autoid:0;

		                // Active Records
						$whr_2 = array('n_status' => 1, 'n_delete' => 1);
						if($active_user>1)
				    	{
				    		$whr_2['n_created_by'] = $active_user;
				    	}
						$res_2 = $this->vendor_coupon_model->getUser($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_2 = !empty($res_2->autoid)?$res_2->autoid:0;

		                // Inactive Records
						$whr_3 = array('n_status' => 2, 'n_delete' => 1);
						if($active_user>1)
				    	{
				    		$whr_3['n_created_by'] = $active_user;
				    	}
						$res_3 = $this->vendor_coupon_model->getUser($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_3 = !empty($res_3->autoid)?$res_3->autoid:0;

						$records = array(
							'total_record'    => $cnt_1,
							'active_record'   => $cnt_2,
							'inactive_record' => $cnt_3,
						);

					    if($del_upt)
					    {
		        			$response['status']  = 1;
					        $response['message'] = response_msg('delete_success');
					        $response['data']    = [];
					        $response['records'] = $records;
					        echo json_encode($response);
					        return;
					    }
					    else
					    {
		        			$response['status']  = 0;
					        $response['message'] = response_msg('delete_failure');
					        $response['data']    = [];
					        echo json_encode($response);
					        return;
					    }
				    }
			    }
			    else
        		{
        			$response['status']  = 0;
			        $response['message'] = response_msg('access_denied'); 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
        		}
        	}
        	else
        	{
        		$page['role_access']  = userAccess('coupon_add');
        		$page['directory']    = "app";
		    	$page['cntrl']        = "vendor-coupon";
		    	$page['func']         = "manage";
		    	$page['data_value']   = "";
				$page['main_heading'] = "Vendor Coupon";
				$page['sub_heading']  = "Manage Vendor Coupon";
				$page['pre_title']    = "Add Vendor Coupon";
				$page['pre_menu']     = "app/vendor-coupon/add";
				$page['export_menu']  = "app/vendor-coupon/export";
				$data['page_temp']    = $this->load->view('app_view/vendor_coupon/manage',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Manage Vendor Coupon";
				$data['currentmenu']  = "vendorcoupons";
				$this->bassthaya->load_table_template($data);
        	}
		}
	}
?>