<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Role extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/role_model');
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
        	$active_user = $this->session->get_userdata()['n_id'];
        	$formpage = $this->input->post('formpage');

        	if($formpage == 'BTBM_X_P')
        	{
        		$n_id        = $this->input->post('n_id');
			    $c_role      = $this->input->post('c_role');
			    $heading_val = $this->input->post('heading_val');
			    $check_val   = $this->input->post('check_val');
			    $method      = $this->input->post('method');
			    $n_status    = $this->input->post('n_status');
			    $random_val  = generateRandomString(32);

			    $error = FALSE;
			    $errors = array();
				$required = array('c_role');
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
		    		if(userAccess('role_add') == TRUE)
		    		{
		    			$exs_whr = array(
			    			'c_role_title' => str_value($c_role),
		    				// 'n_status'     => 1,
		    				'n_delete'     => 1,
		    			);

		    			$exs_col = 'n_id';
		    			$exs_res = $this->role_model->getRole($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

		    			if($exs_res)
		    			{
		    				$response['status']  = 0;
					        $response['message'] = response_msg('already_exist'); 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
		    			}
		    			else
		    			{
		    				$heading_res = '';
		    				if(!empty($heading_val))
					    	{
					    		$heading_res = implode(',', $heading_val);
					    	}

					    	$check_res = '';
					    	if(!empty($check_val))
					    	{
					    		$check_res = implode(',', $check_val);
					    	}

		    				$ins_data = array(
		    					'c_role_title'    => str_value($c_role,3),
		    					'c_role_heading'  => $heading_res,
		    					'c_role_list'     => $check_res,
			    				'n_created_by'    => $this->session->userdata('n_id'),
			    				'dt_created_date' => date('Y-m-d H:i:s'),
			    			);

			    			$insert = $this->role_model->insert($ins_data);

			    			if($insert)
						    {
			        			$response['status']  = 1;
						        $response['message'] = response_msg('store_success'); 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
						    }
						    else
						    {
			        			$response['status']  = 0;
						        $response['message'] = response_msg('store_failure'); 
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
		    		if(userAccess('role_edit') == TRUE)
		    		{
		    			$exs_whr = array(
		    				'n_id !='      => $n_id,
			    			'c_role_title' => str_value($c_role),
		    				'n_status'     => 1,
		    				'n_delete'     => 1,
		    			);


		    			$exs_col = 'n_id';
		    			$exs_res = $this->role_model->getRole($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

		    			if($exs_res)
		    			{
		    				$response['status']  = 0;
					        $response['message'] = '<b>'.str_value($c_role).'</b>'.' is already exist'; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
		    			}
		    			else
		    			{
		    				if($n_id != 1)
		    				{
		    					$heading_res = '';
			    				if(!empty($heading_val))
						    	{
						    		$heading_res = implode(',', $heading_val);
						    	}

						    	$check_res = '';
						    	if(!empty($check_val))
						    	{
						    		$check_res = implode(',', $check_val);
						    	}
			    				$n_status_ = $n_status ? 1 : 2;
			    				$upt_data = array(
			    					'c_role_title'    => str_value($c_role,3),
			    					'c_role_heading'  => $heading_res,
			    					'c_role_list'     => $check_res,
				    				'n_status'        => $n_status_,
				    				'n_updated_by'    => $this->session->userdata('n_id'),
				    				'dt_updated_date' => date('Y-m-d H:i:s'),
				    			);

							    $upt_whr = array('n_id' => $n_id);
							    // if($active_user>1)
				    			// {
				    			// 	$upt_whr['n_created_by'] = $active_user;
				    			// }
		    					$update  = $this->role_model->update($upt_data, $upt_whr);

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
        	else
        	{
        		if($param1 == 'Edit')
        		{
        			$data_whr = array('n_id' => $param2, 'n_delete' => 1);
	    			$data_col = 'n_id, c_role_title, c_role_heading, c_role_list, n_status';
	    			$data_res = $this->role_model->getRole($data_whr, '', '', 'result', '', '', '', '', $data_col);
        			$page['dataval']    = $data_res;
					$page['method']     = '_Edit';
					$page['page_title'] = "Edit Role";
        		}
        		else
        		{
        			$page['dataval']    = '';
					$page['method']     = '_Create';
					$page['page_title'] = "Create Role";
        		}

        		$page['role_access']  = userAccess('role_view');
        		$page['formpage']     = "BTBM_X_P";
        		$page['directory']    = "app/users";
		    	$page['cntrl']        = "role";
		    	$page['func']         = "add";
				$page['main_heading'] = "Role";
				$page['pre_title']    = "List Role";
				$page['pre_menu']     = "app/users/role/manage";
				$data['page_temp']    = $this->load->view('app_view/users/role/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Create Role";
				$data['currentmenu']  = "add_role";
				$this->bassthaya->load_form_template($data);
        	}
        }

		public function manage($param1="", $param2="", $param3="")
		{
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');
        	$active_user = $this->session->get_userdata()['n_id'];

        	$method = $this->input->post('method');

        	if($method == 'data_list')
        	{
        		if(userAccess('role_view') == TRUE)
        		{
	        		$_limit   = $this->input->post('limitval');
	            	$page     = $this->input->post('page');
	            	$search   = $this->input->post('search');
	            	$sort_column   = $this->input->post('sort_column');
	            	$sort_type     = $this->input->post('sort_type');
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

		    		$sort_col_ = array("n_id","c_role_title","n_status","dt_created_date");
		    		array_unshift($sort_col_,"");
					unset($sort_col_[0]);

		    		$where       = array('n_id !=' => 1, 'n_delete' => 1);
		    		if($active_user>1)
		    		{
		    			$where['n_created_by'] = $active_user;
		    		}
					$overall_col = $this->role_model->getRole($where, '', '', "row", $like, array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$total_count = !empty($overall_col->autoid)?$overall_col->autoid:'0';

					$option['order_by']   = !empty($sort_column) ? $sort_col_[$sort_column] : 'n_id';
	    			$option['disp_order'] = !empty($sort_type) ? ($sort_type==1? 'DESC' : 'ASC') : 'DESC';

	    			$res_column = 'n_id, c_role_title, n_status, dt_created_date';
	    			$data_list  = $this->role_model->getRole($where, $limit, $offset, 'result', $like, '', $option, '', $res_column);
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
	    	            	$c_role_title     = empty_check($val->c_role_title);
				            $n_status         = zero_check($val->n_status);
				            $dt_created_date  = date_check($val->dt_created_date);

				            $edit   = '';
				            $delete = '';
				            if(userAccess('role_edit') == TRUE)
				            {
				            	$edit = '<a href="'.BASE_URL.'app/users/role/add/Edit/'.$n_id.'" class="btn btn-warning waves-effect waves-light" style="padding: 8px;"><i class="icon-pencil"></i></a>';
				            }

				            if(userAccess('role_delete') == TRUE)
				            {
				            	$delete = '<span data-directory="app/user" data-cntrl="role" data-func="manage" data-id="'.$n_id.'" class="del_btn btn btn-danger waves-effect waves-light" style="margin-left: 4px; padding: 8px; cursor: pointer;"><i class="icon-trash"></i></span>';
				            }

	    	            	$table .= '
	    	            		<tr class="row_'.$n_id.'">
	    	            			<td>'.$i.'</td>
	    	            			<td>'.str_compress($c_role_title, 15).'</td>
	                                <td>'.active_status($n_status).'</td>
	                                <td>'.$dt_created_date.'</td>';
	                                if(userAccess('role_edit') == TRUE || userAccess('role_delete') == TRUE)
	                                {
	                                	$table .= '<td>'.$edit.$delete.'</td>';
	                                }
	    	            		$table .= '</tr>
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
					$res_1 = $this->role_model->getRole($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_1 = !empty($res_1->autoid)?$res_1->autoid:'0';

	                // Active Records
					$whr_2 = array('n_id !=' => 1, 'n_status' => 1, 'n_delete' => 1);
					if($active_user>1)
		    		{
		    			$whr_2['n_created_by'] = $active_user;
		    		}
					$res_2 = $this->role_model->getRole($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_2 = !empty($res_2->autoid)?$res_2->autoid:'0';

	                // Inactive Records
					$whr_3 = array('n_id !=' => 1, 'n_status' => 2, 'n_delete' => 1);
					if($active_user>1)
		    		{
		    			$whr_3['n_created_by'] = $active_user;
		    		}
					$res_3 = $this->role_model->getRole($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_3 = !empty($res_3->autoid)?$res_3->autoid:'0';

					$records = array(
						'total_record'    => $cnt_1,
						'active_record'   => $cnt_2,
						'inactive_record' => $cnt_3,
					);

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
        		if(userAccess('role_delete') == TRUE)
        		{
        			$n_id = $this->input->post('n_id');
        			if($n_id>1)
        			{
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
					    	$this->load->model('app_model/user_model', NULL, TRUE);
					    	$check_user = array(
					    		'n_delete'        => 1,
					    		'n_status'        => 1,
					    		'n_role'		  => $n_id
					    	);
					    	if($active_user>1)
				    		{
				    			$check_user['n_created_by'] = $active_user;
				    		}
					    	$check =  $this->user_model->getUser($check_user,'', '', "result", array(), array(), array(), TRUE, 'n_id');
					    	if(!$check)
					    	{
						    	$del_data = array(
				        			'n_delete'        => 2,
				        			'n_deleted_by'    => $this->session->userdata('n_id'),
							    	'dt_deleted_date' => date('Y-m-d H:i:s'),
				        		);

				        		$del_whr  = array('n_id' => $n_id);
				        		if($active_user>1)
					    		{
					    			$del_whr['n_created_by'] = $active_user;
					    		}
				    			$del_upt  = $this->role_model->update($del_data, $del_whr);

				    			// Total Records
				                $whr_1 = array('n_id !=' => 1, 'n_delete' => 1);
				                if($active_user>1)
					    		{
					    			$whr_1['n_created_by'] = $active_user;
					    		}
								$res_1 = $this->role_model->getRole($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
								$cnt_1 = !empty($res_1->autoid)?$res_1->autoid:'0';

				                // Active Records
								$whr_2 = array('n_id !=' => 1, 'n_status' => 1, 'n_delete' => 1);
								if($active_user>1)
					    		{
					    			$whr_2['n_created_by'] = $active_user;
					    		}
								$res_2 = $this->role_model->getRole($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
								$cnt_2 = !empty($res_2->autoid)?$res_2->autoid:'0';

				                // Inactive Records
								$whr_3 = array('n_id !=' => 1, 'n_status' => 2, 'n_delete' => 1);
								if($active_user>1)
					    		{
					    			$whr_3['n_created_by'] = $active_user;
					    		}
								$res_3 = $this->role_model->getRole($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
								$cnt_3 = !empty($res_3->autoid)?$res_3->autoid:'0';

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
						    else
						    {
						    	$response['status']  = 0;
						        $response['message'] = response_msg('model_mapped'); 
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
        			$response['status']  = 0;
			        $response['message'] = response_msg('access_denied'); 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
        		}
        	}

        	else
        	{
        		$page['role_access']  = userAccess('role_add');
        		$page['directory']    = "app/users";
		    	$page['cntrl']        = "role";
		    	$page['func']         = "manage";
		    	$page['data_value']   = "";
				$page['main_heading'] = "Role";
				$page['sub_heading']  = "List Role";
				$page['pre_title']    = "Add Role";
				$page['pre_menu']     = "app/users/role/add";
				$data['page_temp']    = $this->load->view('app_view/users/role/manage',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Manage Role";
				$data['currentmenu']  = "manage_role";
				$this->bassthaya->load_table_template($data);
        	}
		}
	}
?>