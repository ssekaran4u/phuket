<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class User extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/catalogue_model');
			$this->load->model('app_model/user_model');
		}

		public function index($param1="", $param2="", $param3="")
		{
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL.'/app/dashboard', 'refresh');
		}

		public function add($param1="", $param2="", $param3="")
		{
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');
        	$formpage = $this->input->post('formpage');
        	$active_user = $this->session->get_userdata()['n_id'];
        	if($formpage == 'BTBM_X_P')
        	{
        		// var_dump($_POST);die();
        		$n_id          			= $this->input->post('n_id');
			    $n_role        			= $this->input->post('n_role');
			    $n_accessible_role  	= $this->input->post('n_accessible_role');
			    $c_full_name     		= $this->input->post('c_full_name');
			    $c_short_name      		= $this->input->post('c_short_name');

			    $c_contact_number 		= $this->input->post('c_contact_number');
			    $c_contact_number_pre 	= $this->input->post('c_contact_number_pre');

			    $n_is_other     		= $this->input->post('n_is_other');
			    $c_whatsapp 			= $this->input->post('c_whatsapp');
			    $c_whatsapp_pre 		= $this->input->post('c_whatsapp_pre');

			    $c_line 				= $this->input->post('c_line');
			    $c_line_pre 			= $this->input->post('c_line_pre');

			    $c_emailid    			= $this->input->post('c_emailid');
			    $c_password       		= $this->input->post('c_password');
			    $c_address          	= $this->input->post('c_address');
			    $method        			= $this->input->post('method');
			    $n_status      			= $this->input->post('n_status');
			    $random_val    			= generateRandomString(32);

			    $error = FALSE;
			    $errors = array();
				$required = array('n_role','c_full_name','c_short_name','c_contact_number','c_emailid','c_emailid','c_password');
				
				
				if($n_is_other==null)
				{
					if(empty($c_whatsapp) && empty($c_line))
					{
						$error = TRUE;
					}
				}

				if($method == '_Edit')
				{
					array_push($required, 'n_id');
					$unsetkey = array_keys($required, 'c_password')[0];
					unset($required[$unsetkey]);
					$required = array_values($required);
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

		    	if(validateCountryPhone($c_contact_number,$c_contact_number_pre))
		    	{
		            $response['status']  = 0;
			        $response['message'] = $c_contact_number. " No. does not appear to be valid"; 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
		    	}

			    if (mb_strlen($c_emailid) > 254 || !filter_var($c_emailid, FILTER_VALIDATE_EMAIL))
			    {
			        $response['status']  = 0;
			        $response['message'] = $c_emailid. " does not appear to be valid"; 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
			    }
			    if(empty($n_is_other) && ($c_whatsapp || $c_line) )
				{
					if(!empty($c_whatsapp))
					{
						if(validateCountryPhone($c_whatsapp,$c_whatsapp_pre))
				        {
				            $response['status']  = 0;
					        $response['message'] = $c_whatsapp. " No. does not appear to be valid"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
				        }
			        }
			        if(!empty($c_line))
			        {
			        	// var_dump($c_line,$c_line_pre);
			        	// print_r(validateCountryPhone($c_line,$c_line_pre));die();
			        	if(validateCountryPhone($c_line,$c_line_pre))
				        {
				            $response['status']  = 0;
					        $response['message'] = $c_line. " No. does not appear to be valid"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
				        }
			        }
				}
				
				$c_contact_number_merge = getCountryPhone($c_contact_number,$c_contact_number_pre );
				$c_whatsapp_merge 		= getCountryPhone($c_whatsapp,$c_whatsapp_pre );
				$c_line_merge 			= getCountryPhone($c_line,$c_line_pre );

			    if(count($errors)==0)
			    {
			    	if($method == '_Create')
			    	{
			    		if(userAccess('user_add') == TRUE)
			    		{
				    		$email_check = array(
				    			'c_emailid'    => $c_emailid,
			    				'n_status'     => 1,
			    				'n_delete'     => 1,
			    			);
			    			if($active_user>1) {
			    				$email_check['n_created_by'] = $active_user;
			    			}

							$exs_res = $this->user_model->getUser($email_check, '', '', 'result', '', '', '', '', 'n_id');

							if($exs_res)
							{
								$response['status']  = 0;
						        $response['message'] = $c_emailid. " already exist"; 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
							}

							$contact_check = array(
				    			'c_contact_number'  => $c_contact_number_merge,
			    				'n_status'     		=> 1,
			    				'n_delete'     		=> 1,
			    			);
			    			if($active_user>1) {
			    				$contact_check['n_created_by'] = $active_user;
			    			}

							$contact_res = $this->user_model->getUser($contact_check, '', '', 'result', '', '', '', '', 'n_id');

							if($contact_res)
							{
								$response['status']  = 0;
						        $response['message'] = $c_contact_number. " already exist"; 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
							}

							if(empty($n_is_other) && ($c_whatsapp || $c_line))
							{
								if(!empty($c_whatsapp))
								{
									$whatsapp_check = array(
						    			'c_whatsapp'   => $c_whatsapp_merge,
					    				'n_status'     => 1,
					    				'n_delete'     => 1,
					    			);

									if($active_user>1) {
					    				$whatsapp_check['n_created_by'] = $active_user;
					    			}
									$whatsapp_res = $this->user_model->getUser($whatsapp_check, '', '', 'result', '', '', '', '', 'n_id');

									if($whatsapp_res)
									{
										$response['status']  = 0;
								        $response['message'] = $c_whatsapp. " already exist"; 
								        $response['data']    = [];
								        echo json_encode($response);
								        return; 
									}
								}
								if(!empty($c_line))
								{
									$line_check = array(
						    			'c_line'    => $c_line_merge,
					    				'n_status'  => 1,
					    				'n_delete'  => 1,
					    			);
					    			
					    			if($active_user>1) {
					    				$line_check['n_created_by'] = $active_user;
					    			}

									$line_res = $this->user_model->getUser($line_check, '', '', 'result', '', '', '', '', 'n_id');

									if($line_res)
									{
										$response['status']  = 0;
								        $response['message'] = $c_line. " already exist"; 
								        $response['data']    = [];
								        echo json_encode($response);
								        return; 
									}
								}
							}

							$ins_data = array(
		    					'c_full_name'        => str_value($c_full_name,3),
		    					'c_short_name'       => str_value($c_short_name,3),
			    				'c_emailid'      	 => $c_emailid,
			    				'c_password'      	 => $c_password,
			    				'c_contact_number'   => $c_contact_number_merge,
			    				'c_address' 		 => str_value($c_address),
			    				'n_role' 			 => $n_role,
			    				'n_created_by'       => $this->session->userdata('n_id'),
			    				'dt_created_on'      => date('Y-m-d H:i:s'),
			    			);

							if($n_accessible_role && sizeof($n_accessible_role)>0)
							{
								$ins_data['n_accessible_role'] =  implode(",", $n_accessible_role);
							}

							if(empty($n_is_other) && ($c_whatsapp || $c_line) )
							{
								$ins_data['n_is_other'] 		= 2;
								if(!empty($c_whatsapp))
								{
									$ins_data['c_whatsapp'] = $c_whatsapp_merge;
								}
								if($c_line)
								{
									$ins_data['c_line'] = $c_line_merge;
								}
							}
							else
							{
								unset($ins_data['c_whatsapp']);
								unset($ins_data['c_line']);
							}
							// print_r($ins_data);die();
			    			$insert = $this->user_model->insert($ins_data);

			    			if($insert)
						    {
			        			$response['status']  = 1;
						        $response['message'] = "User added successfully"; 
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
			    		if(userAccess('user_edit') == TRUE)
			    		{
			    			$email_check = array(
			    				'n_id !='      => $n_id,
			    				'c_emailid'    => $c_emailid,
			    				'n_status'     => 1,
			    				'n_delete'     => 1,
			    			);

			    			if($active_user>1) {
			    				$email_check['n_created_by'] = $active_user;
			    			}
							$exs_res = $this->user_model->getUser($email_check, '', '', 'result', '', '', '', '', 'n_id');

							if($exs_res)
							{
								$response['status']  = 0;
						        $response['message'] = $c_emailid. " already exist"; 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
							}

							$contact_check = array(
								'n_id !='      	   => $n_id,
				    			'c_contact_number' => $c_contact_number_merge,
			    				'n_status'     	   => 1,
			    				'n_delete'     	   => 1,
			    			);

							if($active_user>1) {
			    				$contact_check['n_created_by'] = $active_user;
			    			}
							$contact_res = $this->user_model->getUser($contact_check, '', '', 'result', '', '', '', '', 'n_id');

							if($contact_res)
							{
								$response['status']  = 0;
						        $response['message'] = $c_contact_number. " already exist"; 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
							}

							if(empty($n_is_other) && ($c_whatsapp || $c_line))
							{
								if(!empty($c_whatsapp))
								{
									$whatsapp_check = array(
										'n_id !='      => $n_id,
						    			'c_whatsapp'   => $c_whatsapp_merge,
					    				'n_status'     => 1,
					    				'n_delete'     => 1,
					    			);
					    			if($active_user>1) {
					    				$whatsapp_check['n_created_by'] = $active_user;
					    			}

									$whatsapp_res = $this->user_model->getUser($whatsapp_check, '', '', 'result', '', '', '', '', 'n_id');

									if($whatsapp_res)
									{
										$response['status']  = 0;
								        $response['message'] = $c_whatsapp. " already exist"; 
								        $response['data']    = [];
								        echo json_encode($response);
								        return; 
									}
								}
								if(!empty($c_line))
								{
									$line_check = array(
										'n_id !='   => $n_id,
						    			'c_line'    => $c_line_merge,
					    				'n_status'  => 1,
					    				'n_delete'  => 1,
					    			);

									if($active_user>1) {
					    				$line_check['n_created_by'] = $active_user;
					    			}

									$line_res = $this->user_model->getUser($line_check, '', '', 'result', '', '', '', '', 'n_id');

									if($line_res)
									{
										$response['status']  = 0;
								        $response['message'] = $c_line. " already exist"; 
								        $response['data']    = [];
								        echo json_encode($response);
								        return; 
									}
								}
							}
							$n_status_ = $n_status ? 1 : 2;
							$upt_data = array(
		    					'c_full_name'        => str_value($c_full_name,3),
		    					'c_short_name'       => str_value($c_short_name,3),
			    				'c_emailid'      	 => $c_emailid,
			    				'c_contact_number'   => $c_contact_number_merge,
			    				'c_address' 		 => str_value($c_address),
			    				'n_role' 			 => $n_role,
			    				'n_status'        	 => $n_status_,
			    				'n_updated_by'    	 => $this->session->userdata('n_id'),
			    				'dt_updated_on' 	 => date('Y-m-d H:i:s')
			    			);

			    			if(!empty($c_password))
			    			{
			    				$upt_data['c_password'] = $c_password;
			    			}

							if(empty($n_is_other) && ($c_whatsapp || $c_line) )
							{
								$upt_data['n_is_other'] = 2;
								if(!empty($c_whatsapp))
								{
									$upt_data['c_whatsapp'] = $c_whatsapp_merge;
								}
								if(!empty($c_line))
								{
									$upt_data['c_line'] = $c_line_merge;
								}
							}
							else
							{
								$upt_data['n_is_other'] = 1;
								$upt_data['c_whatsapp'] = '';
								$upt_data['c_line'] = '';
							}


							if($n_accessible_role && sizeof($n_accessible_role)>0)
							{
								$upt_data['n_accessible_role'] =  implode(",", $n_accessible_role);
							}
							else
							{
								$upt_data['n_accessible_role'] = '';
							}

							// print_r($upt_data);die();
							$upt_whr = array('n_id' => $n_id);
							if($active_user>1) {
			    				$upt_whr['n_created_by'] = $active_user;
			    			}
							$update  = $this->user_model->update($upt_data, $upt_whr);

						    if($update)
						    {
			        			$response['status']  = 1;
						        $response['message'] = response_msg('update_success'); 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
						    }
						    else
						    {
			        			$response['status']  = 0;
						        $response['message'] = response_msg('update_failure'); 
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
	        	}
	        }
	        else 
	        {

	        	// Role List
        		$role_whr  = array('n_status' => 1, 'n_delete' => 1);
       			// if($active_user>1) {
    			// 	$role_whr['n_created_by'] = $active_user;
    			// }
        		$role_col  = 'n_id, c_role_title';
        		$this->load->model('app_model/role_model', NULL, TRUE);
        		$role_list = $this->role_model->getRole($role_whr, '', '', 'result', '', '', '', '', $role_col);

        		if($param1 == 'Edit')
        		{
        			$data_whr = array('n_id' => $param2, 'n_delete' => 1);
        			if($active_user>1) {
	    				$data_whr['n_created_by'] = $active_user;
	    			}
	    			$data_col = 'n_id, c_full_name, c_short_name, c_emailid, c_contact_number, n_is_other, c_line, c_whatsapp, n_login_count, c_address, n_role,n_accessible_role, n_status';
	    			$data_res = $this->user_model->getUser($data_whr, '', '', 'row', '', '', '', '', $data_col);
        			$page['dataval']    = $data_res;
					$page['method']     = '_Edit';
					$page['page_title'] = "Edit User";
        		}
        		else
        		{
        			$page['dataval']    = '';
					$page['method']     = '_Create';
					$page['page_title'] = "Create User";
        		}

        	
        		$role_val = [];
        		if(sizeof($role_list)>0)
        		{
					foreach ($role_list as $role_list_)  {
						if($this->session->userdata('n_id')==1)
						{
							array_push($role_val, array("n_id"=>$role_list_->n_id,"c_role_title"=>$role_list_->c_role_title));
						}
						else
						{
							// $c_filter_role = $this->session->userdata('n_accessible_role');
							$c_filter_role = $this->session->userdata('n_accessible_role');
							if(!empty($c_filter_role))
							{
        						$p_access_role = explode(",", $c_filter_role);
        						if(in_array($role_list_->n_id, $p_access_role))
        						{
        							array_push($role_val, array("n_id"=>$role_list_->n_id,"c_role_title"=>$role_list_->c_role_title));
        						}
							}
						}
					}
        		}

        		$page['role_val']     = $role_val;
        		$page['role_access']  = userAccess('user_view');
        		$page['formpage']     = "BTBM_X_P";
        		$page['directory']    = "app/users";
		    	$page['cntrl']        = "user";
		    	$page['func']         = "add";
				$page['main_heading'] = "Users";
				$page['pre_title']    = "Manage users";
				$page['pre_menu']     = "app/users/user/manage";
				$data['page_temp']    = $this->load->view('app_view/users/user/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Create User";
				$data['currentmenu']  = "user";
				// print_r($data);die();
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
        		if(userAccess('user_view') == TRUE)
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
		    		
		    		$where       = array('A.n_id !=' => 1, 'A.n_delete' => 1);
		    		if($active_user>1)
		    		{
		    			$where['A.n_created_by'] = $active_user;
		    		}

					$overall_col = $this->user_model->getJoinUser($where, '', '', "row", $like, array(), array(), TRUE, 'COUNT(A.n_id) AS autoid');
					$total_count = !empty($overall_col->autoid)?$overall_col->autoid:0;

					$option['order_by']   = 'A.n_id';
	    			$option['disp_order'] = 'DESC';

	    			$res_column = 'A.n_id, c_full_name, c_short_name, B.c_role_title AS c_role_name, c_emailid, c_contact_number, n_is_other, A.n_status, c_line, c_whatsapp,dt_created_on';
	    			$data_list  = $this->user_model->getJoinUser($where, $limit, $offset, 'result', $like, '', $option, '', $res_column);
	    			// echo $this->db->last_query();die();
	    			if($data_list)
	    			{
	    				$count    = count($data_list);
		            	$tot_page = ceil($total_count / $limit); 

	    				$status  = 1;
		            	$message = response_msg('success_message');
		            	$table   = '';
		            	
		            	$i=1;
	    	            foreach ($data_list as $key => $val) {

	    	            	$n_id             = empty_check($val->n_id);
	    	            	$c_full_name       = empty_check($val->c_full_name);
	    	            	$c_short_name       = empty_check($val->c_short_name);
	    	            	$c_role_name       = empty_check($val->c_role_name);
	    	            	$c_contact_number       = empty_check($val->c_contact_number);
	    	            	$c_emailid = empty_check($val->c_emailid);
				            $n_status         = zero_check($val->n_status);
				            $dt_created_date  = date_check($val->dt_created_on);

				            $edit = '<a href="'.BASE_URL.'app/users/user/add/Edit/'.$n_id.'" class="btn btn-warning waves-effect waves-light" style="padding: 8px;"><i class="icon-pencil"></i></a>';

				            $delete = '<span data-directory="app/users" data-cntrl="user" data-func="manage" data-id="'.$n_id.'" class="del_btn btn btn-danger waves-effect waves-light" style="margin-left: 4px; padding: 8px; cursor: pointer;"><i class="icon-trash"></i></span>';

	    	            	$table .= '
	    	            		<tr class="row_'.$n_id.'">
	    	            			<td>'.$i.'</td>
	    	            			<td>'.str_compress($c_full_name, 15).', '.$c_short_name.'</td>
	    	            			<td>'.$c_role_name.'</td>
	    	            			<td>'.$c_contact_number.'</td>
	    	            			<td>'.$c_emailid.'</td>
	                                <td>'.active_status($n_status).'</td>
	                                <td>'.$dt_created_date.'</td>
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
		            $whr_1 = array('n_id !=' => 1, 'n_delete' => 1);
	                if($active_user>1)
    				{
    					$whr_1['n_created_by'] = $active_user;
		            }
					$res_1 = $this->user_model->getUser($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_1 = !empty($res_1->autoid)?$res_1->autoid:0;

	                // Active Records
	                $whr_2 = array('n_id !=' => 1, 'n_status' => 1, 'n_delete' => 1);
	                if($active_user>1)
    				{
    					$whr_2['n_created_by'] = $active_user;
					}
					$res_2 = $this->user_model->getUser($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_2 = !empty($res_2->autoid)?$res_2->autoid:0;

	                // Inactive Records
	                $whr_3 = array('n_id !=' => 1, 'n_status' => 2, 'n_delete' => 1);
	                if($active_user>1)
    				{
    					$whr_3['n_created_by'] = $active_user;
					}

					$res_3 = $this->user_model->getUser($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
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
        		if(userAccess('user_delete') == TRUE)
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

		       
		    			$del_upt  = $this->user_model->update($del_data, $del_whr);

		    			// Total Records
		                $whr_1 = array('n_delete' => 1);
		                if($active_user>1)
				    	{
				    		$whr_1['n_created_by'] = $active_user;
				    	}
						$res_1 = $this->user_model->getUser($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_1 = !empty($res_1->autoid)?$res_1->autoid:0;

		                // Active Records
						$whr_2 = array('n_status' => 1, 'n_delete' => 1);
						if($active_user>1)
				    	{
				    		$whr_2['n_created_by'] = $active_user;
				    	}
						$res_2 = $this->user_model->getUser($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_2 = !empty($res_2->autoid)?$res_2->autoid:0;

		                // Inactive Records
						$whr_3 = array('n_status' => 2, 'n_delete' => 1);
						if($active_user>1)
				    	{
				    		$whr_3['n_created_by'] = $active_user;
				    	}
						$res_3 = $this->user_model->getUser($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
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
        		$page['role_access']  = userAccess('user_add');
        		$page['directory']    = "app/users";
		    	$page['cntrl']        = "user";
		    	$page['func']         = "manage";
		    	$page['data_value']   = "";
				$page['main_heading'] = "Users";
				$page['sub_heading']  = "Manage Users";
				$page['pre_title']    = "Add Users";
				$page['pre_menu']     = "app/users/user/add";
				$page['export_menu']  = "app/users/user/export";
				$data['page_temp']    = $this->load->view('app_view/users/user/manage',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Manage Users";
				$data['currentmenu']  = "users";

				$this->bassthaya->load_table_template($data);
        	}
		}

		public function export() {
			$where       = array('A.n_id !=' => 1, 'A.n_delete' => 1);
			$option['order_by']   = 'A.n_id';
			$option['disp_order'] = 'DESC';
			$res_column = 'A.n_id, c_full_name, c_short_name, B.c_role_title AS c_role_name, c_emailid, c_contact_number, n_is_other, A.n_status, c_line, c_whatsapp,dt_created_on';
			$data_list  = $this->user_model->getJoinUser($where, '', '', 'result', [], '', $option, '', $res_column);

			$table = '<table><thead class="table-light"><tr><th>S.No</th><th>Full Name</th><th>Short Name</th><th>Role</th><th>Contact Number</th><th>WhatsApp Number</th><th>Line Number</th><th>Email Id</th><th>Current Status</th><th>Created At</th></tr></thead><tbody>';
			$i = 1;
			foreach ($data_list as $key => $val) {
	            $c_full_name    = empty_check($val->c_full_name);
	            $c_short_name    = empty_check($val->c_short_name);
	            $c_role_name    = empty_check($val->c_role_name);
	            $c_contact_number    = empty_check($val->c_contact_number);
	            $c_whatsapp    = empty_check($val->c_whatsapp);
	            $c_line    = empty_check($val->c_line);
	            $c_emailid    = empty_check($val->c_emailid);
	            $n_status        = zero_check($val->n_status);
	            $dt_created_on = date_check($val->dt_created_on);

				$table .= '<tr><td>'.$i++.'</td><td>'.$c_full_name.'</td><td>'.$c_short_name.'</td><td>'.$c_role_name.'</td><td>'.$c_contact_number.'</td><td>'.$c_whatsapp.'</td><td>'.$c_line.'</td><td>'.$c_emailid.'</td><td>'.active_status($n_status).'</td><td>'.$dt_created_on.'</td></tr>';
            }

            $table .= '</tbody></table>';

			echo $table;
            header("Content-Type: application/xlsx");    
			header("Content-Disposition: attachment; filename=".time().".xlsx");  
			header("Pragma: no-cache"); 
			header("Expires: 0");
		}
	}
?>