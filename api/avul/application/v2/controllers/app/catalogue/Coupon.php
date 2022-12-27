<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Coupon extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/coupon_model');
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
        	$method       = $this->input->post('method');
        	
        	if($formpage == 'BTBM_X_P')
        	{
        		// var_dump($_POST);die(); 
        		$n_id         = $this->input->post('n_id');
			    $c_coupon   = $this->input->post('c_coupon');
			    $n_type  = $this->input->post('n_type');
			    $n_spend_amount = $this->input->post('n_spend_amount');
			    $n_coupon_price  = $this->input->post('n_coupon_price');
			    $n_discount_percentage = $this->input->post('n_discount_percentage');
			    $n_vailidity   = $this->input->post('n_vailidity');
			    $n_payable   = $this->input->post('n_payable');

			    $c_description   = $this->input->post('c_description');
			    $n_status     = $this->input->post('n_status');
			    $random_val   = generateRandomString(32);

			    $error = FALSE;
			    $errors = array();
				$required = array('c_coupon', 'n_coupon_price','n_discount_percentage','n_vailidity','n_payable');
				if($method == '_Edit')
				{
					array_push($required, 'n_id');
				}
				else
				{
					if(empty($_FILES['c_coupon_image']['name'][0]))
    				{
    					$error = TRUE;
    				}
				}

			    foreach ($required as $field) 
			    {
			        if(empty($this->input->post($field)))
			        {
			            $error = TRUE;
			        }
			    }

			    if(!empty($n_type))
				{
					if(empty($n_spend_amount))
					{
						$error = TRUE;
					}
					elseif (preg_match('#[^0-9]#', $this->input->post($n_spend_amount)))
					{
						$response['status']  = 0;
				        $response['message'] = "Spend amount does not appear to be valid"; 
				        $response['data']    = [];
				        echo json_encode($response);
					}
				}

			    if($error)
			    {
			        $response['status']  = 0;
			        $response['message'] = response_msg('overall_required'); 
			        $response['data']    = [];
			        echo json_encode($response); return;
			    }

			    foreach (array('n_coupon_price','n_discount_percentage','n_vailidity') as $isNumber) {
				    if (preg_match('#[^0-9]#', $this->input->post($isNumber)))
			        {
			        	$isNumberColumn =  ucfirst(trim(str_replace(array("n_","_"), array(" "," "), $isNumber)));
			            $response['status']  = 0;
				        $response['message'] = $isNumberColumn." does not appear to be valid"; 
				        $response['data']    = [];
				        echo json_encode($response);
				        return; 
			        }
			    }


			    if(count($errors)==0)
			    {
			    	if($method == '_Create')
			    	{
			    		if(userAccess('coupon_add') == TRUE)
			    		{
				    		$exs_whr = array(
				    			'c_coupon' => $c_coupon,
			    				'n_status' => 1,
			    				'n_delete' => 1,
			    			);

			    			$exs_col = 'n_id';
			    			$exs_res = $this->coupon_model->getCoupon($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

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
				    			if(!empty($_FILES['c_coupon_image']['name']))
							    {
							    	$img_name  = $_FILES['c_coupon_image']['name'];
									$img_val   = explode('.', $img_name);
									$img_res   = $img_val[1];
									$file_name = generateRandomString(13).'.'.$img_res;
									$configImg['upload_path']   = 'upload/coupon/';
									$configImg['allowed_types'] = 'jpg|jpeg|png|gif';
									$configImg['overwrite']     = FALSE;
									$configImg['remove_spaces'] = TRUE;
		                			$configImg['file_name']     = $file_name;
									$this->load->library('upload', $configImg);
									$this->upload->initialize($configImg);

									if(!$this->upload->do_upload('c_coupon_image'))
									{
								        $response['status']  = 0;
								        $response['message'] = $this->upload->display_errors();
								        $response['data']    = [];
								        echo json_encode($response);
								        return;
									}
									else
									{
										$ins_data = array(
					    					'c_coupon'        => str_value($c_coupon,3),
						    				'n_spend_amount'  => str_value($n_spend_amount,3),
						    				'n_discount_percentage' => str_value($n_discount_percentage,3),
						    				'n_coupon_price' => str_value($n_coupon_price,3),
						    				'n_payable' => str_value($n_payable,3),
						    				'n_vailidity' => str_value($n_vailidity,3),
						    				'c_image'	=> $file_name,
						    				'c_description' => str_value($c_description,3),
						    				'n_created_by' => $this->session->userdata('n_id'),
						    				'dt_created_at' => date('Y-m-d H:i:s')
						    			);
										if(empty($n_type))
							    		{
							    			$ins_data['n_type'] = 2;
							    		}
							    		else
							    		{
							    			$ins_data['n_type'] = 1;	
							    			$ins_data['n_spend_amount'] = $n_spend_amount;
							    			
							    		}
										$insert = $this->coupon_model->insert($ins_data);

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
			    		if(userAccess('coupon_edit') == TRUE)
			    		{
				    		$exs_whr = array(
				    			'n_id !='      => $n_id,
				    			'c_coupon' => $c_coupon,
			    				'n_status'     => 1,
			    				'n_delete'     => 1,
			    			);

			    			$exs_col = 'n_id';
			    			$exs_res = $this->coupon_model->getCoupon($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

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
			    				$n_status_ = $n_status ? 1 : 2;
			    				$file_name_ = '';
			    				if(!empty($_FILES['c_coupon_image']['name']))
								{
									$img_name  = $_FILES['c_coupon_image']['name'];
									$img_val   = explode('.', $img_name);
									$img_res   = $img_val[1];
									$file_name = generateRandomString(13).'.'.$img_res;
									$configImg['upload_path']   = 'upload/coupon/';
									$configImg['allowed_types'] = 'jpg|jpeg|png|gif';
									$configImg['overwrite']     = FALSE;
									$configImg['remove_spaces'] = TRUE;
									$configImg['file_name']     = $file_name;
									$file_name_ = $file_name;
									$this->load->library('upload', $configImg);
									$this->upload->initialize($configImg);	
									if(!$this->upload->do_upload('c_coupon_image'))
									{
								        $response['status']  = 0;
								        $response['message'] = $this->upload->display_errors();
								        $response['data']    = [];
								        echo json_encode($response);
								        return;
									}
								}

								$upt_data = array(
			    					'c_coupon'        => str_value($c_coupon,3),
				    				'n_spend_amount'  => str_value($n_spend_amount,3),
				    				'n_discount_percentage' => str_value($n_discount_percentage,3),
				    				'n_coupon_price' => str_value($n_coupon_price,3),
				    				'n_payable' => str_value($n_payable,3),
				    				'n_vailidity' => str_value($n_vailidity,3),
				    				'c_description' => str_value($c_description,3),
				    				'n_status'        => $n_status_,
				    				'n_updated_by'    => $this->session->userdata('n_id'),
				    				'dt_updated_at' => date('Y-m-d H:i:s'),
				    			);

								if(!empty($file_name_))
								{
									$upt_data['c_image'] = $file_name;
								}

			    				if(empty($n_type))
					    		{
					    			$upt_data['n_type'] = 2;
					    			$upt_data['n_spend_amount'] = 0;
					    		}
					    		else
					    		{
					    			$upt_data['n_type'] = 1;	
					    			$upt_data['n_spend_amount'] = $n_spend_amount;
					    			
					    		}

							    $upt_whr = array('n_id' => $n_id);
		    					$update  = $this->coupon_model->update($upt_data, $upt_whr);
		    					// echo $this->db->last_query();
		    					// die();
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
        	else if($method == 'data_autocomplete')
        	{
    			$search   = $this->input->post('c_search');
    			if(!empty($search))
    			{
	        		$option['order_by']   = 'c_coupon';
	    			$option['disp_order'] = 'ASC';

	    			$like['name'] = $search;
	    			$limit  = 10;
					$offset = 0;
	    			$res_column = 'n_id, c_coupon';
	    			$data_list  = $this->coupon_model->getCoupon(array('n_delete' => 1), $limit, $offset, 'result', $like, '', $option, '', $res_column);
	    			if($data_list)
	    			{
	    				$search_data = array();
	    				foreach ($data_list as $value) {
	    					$search_data[] = array("value"=>$value->n_id,"label"=>$value->c_coupon);
	    				}

	    				$response['status']   = 1;  
		                $response['result']   = $search_data;  
		                echo json_encode($response);
		                return;
	    			}
	    			// echo $this->db->last_query();
    			}
        	}
        	else
        	{
        		if($param1 == 'Edit')
        		{

        			$data_whr = array('n_id' => $param2, 'n_delete' => 1);
	    			$data_col = 'n_id, n_type, n_spend_amount, c_coupon, n_discount_percentage, n_coupon_price, n_vailidity, n_payable,c_description, c_image,n_status';
	    			$data_res = $this->coupon_model->getCoupon($data_whr, '', '', 'row', '', '', '', '', $data_col);
        			

        			$page['dataval']    = $data_res;
					$page['method']     = '_Edit';
					$page['page_title'] = "Edit Coupon";
        		}
        		else
        		{
        			$page['dataval']    = '';
					$page['method']     = '_Create';
					$page['page_title'] = "Create Coupon";
        		}

        		// Coupon List
        		// $coupon_whr  = array('n_id !=' => $param2, 'n_status' => 1, 'n_delete' => 1);
        		// $coupon_col  = 'n_id, c_coupon';
        		// $coupon_list = $this->coupon_model->getCoupon($coupon_whr, '', '', 'result', '', '', '', '', $coupon_col);

        		$page['role_access']  = userAccess('coupon_view');
        		$page['formpage']     = "BTBM_X_P";
        		$page['directory']    = "app/catalogue";
		    	$page['cntrl']        = "coupon";
		    	$page['func']         = "add";
				$page['main_heading'] = "Coupon";
				$page['pre_title']    = "List Coupon";
				$page['pre_menu']     = "app/catalogue/coupon/manage";
				$data['page_temp']    = $this->load->view('app_view/catalogue/coupon/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Create Coupon";
				$data['currentmenu']  = "coupon";
				$this->bassthaya->load_form_template($data);
        	}
        }

		public function manage($param1="", $param2="", $param3="")
		{
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');

        	$method = $this->input->post('method');

        	if($method == 'data_list')
        	{
        		if(userAccess('coupon_view') == TRUE)
        		{
	        		$_limit   	= $this->input->post('limitval');
	            	$page     	= $this->input->post('page');
	            	$search   	= $this->input->post('search');
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

		    		$sort_col_ = array("n_id","c_coupon","n_type", "n_coupon_price", "n_discount_percentage","n_payable", "n_vailidity", "n_status","dt_created_at");
		    		array_unshift($sort_col_,"");
					unset($sort_col_[0]);

		    		$where       = array('n_delete' => 1);
					$overall_col = $this->coupon_model->getCoupon($where, '', '', "row", $like, array(), array(), TRUE, 'COUNT(n_id) AS autoid');

					$total_count = !empty($overall_col->autoid)?$overall_col->autoid:'0';

					$option['order_by']   = !empty($sort_column) ? $sort_col_[$sort_column] : 'n_id';
	    			$option['disp_order'] = !empty($sort_type) ? ($sort_type==1? 'DESC' : 'ASC') : 'DESC';

	    			$res_column = 'n_id, n_type, c_coupon, n_discount_percentage,n_spend_amount, n_coupon_price, n_status,n_vailidity, n_payable, dt_created_at';
	    			$data_list  = $this->coupon_model->getCoupon($where, $limit, $offset, 'result', $like, '', $option, '', $res_column);
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
	    	            	$n_id = empty_check($val->n_id);
	    	            	$c_coupon = empty_check($val->c_coupon);
	    	            	$n_type = empty_check($val->n_type);
	    	            	$n_spend_amount = empty_check($val->n_spend_amount);
	    	            	$n_payable = empty_check($val->n_payable);
	    	            	$n_discount_percentage = empty_check($val->n_discount_percentage);
	    	            	$n_coupon_price = empty_check($val->n_coupon_price);
	    	            	$n_vailidity = empty_check($val->n_vailidity);

				            $n_status = zero_check($val->n_status);
				            $dt_created_at  = date_check($val->dt_created_at);

				            $edit   = '';
				            $delete = '';
				            if(userAccess('coupon_edit') == TRUE)
				            {
					            $edit = '<a href="'.BASE_URL.'app/catalogue/coupon/add/Edit/'.$n_id.'" class="btn btn-warning waves-effect waves-light" style="padding: 8px;"><i class="icon-pencil"></i></a>';
					        }
					        if(userAccess('coupon_delete') == TRUE)
				            {
					            $delete = '<span data-directory="app/catalogue" data-cntrl="coupon" data-func="manage" data-id="'.$n_id.'" class="del_btn btn btn-danger waves-effect waves-light" style="margin-left: 4px; padding: 8px; cursor: pointer;"><i class="icon-trash"></i></span>';
					        }

	    	            			// <td>'.str_compress($n_spend_amount, 15).'</td>
	    	            	$table .= '<tr data-section-id="'.$n_id.'" class="row_'.$n_id.'">
	    	            			<td>'.$n_id.'</td>
	    	            			<td>'.str_compress($c_coupon, 48).'</td>
	    	            			<td>'.($n_type==2? 'No limit' : $n_spend_amount. ' spend').'</td>
	    	            			<td>'.str_compress($n_coupon_price, 15).'</td>
	    	            			<td>'.str_compress($n_discount_percentage, 15).'</td>
	    	            			<td>'.$n_payable.'</td>
	    	            			<td>'.str_compress($n_vailidity, 15).'</td>
	                                <td>'.active_status($n_status).'</td>
	                                <td>'.$dt_created_at.'</td>';
	                                if(userAccess('coupon_edit') == TRUE || userAccess('coupon_delete') == TRUE)
	                                {
	                                	$table .= '<td>'.$edit.$delete.'</td>';
	                                }
	                                $table .= '</tr>';
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
					$res_1 = $this->coupon_model->getCoupon($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_1 = !empty($res_1->autoid)?$res_1->autoid:'0';

	                // Active Records
					$whr_2 = array('n_status' => 1, 'n_delete' => 1);
					$res_2 = $this->coupon_model->getCoupon($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_2 = !empty($res_2->autoid)?$res_2->autoid:'0';

	                // Inactive Records
					$whr_3 = array('n_status' => '2', 'n_delete' => 1);
					$res_3 = $this->coupon_model->getCoupon($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
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
        		if(userAccess('coupon_delete') == TRUE)
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
		        			'n_delete'        => '2',
		        			'n_deleted_by'    => $this->session->userdata('n_id'),
					    	'dt_deleted_date' => date('Y-m-d H:i:s'),
		        		);

		        		$del_whr  = array('n_id' => $n_id);
		    			$del_upt  = $this->coupon_model->update($del_data, $del_whr);

		    			// Total Records
		                $whr_1 = array('n_delete' => 1);
						$res_1 = $this->coupon_model->getCoupon($whr_1, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_1 = !empty($res_1[0]->autoid)?$res_1[0]->autoid:'0';

		                // Active Records
						$whr_2 = array('n_status' => 1, 'n_delete' => 1);
						$res_2 = $this->coupon_model->getCoupon($whr_2, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_2 = !empty($res_2[0]->autoid)?$res_2[0]->autoid:'0';

		                // Inactive Records
						$whr_3 = array('n_status' => '2', 'n_delete' => 1);
						$res_3 = $this->coupon_model->getCoupon($whr_3, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_3 = !empty($res_3[0]->autoid)?$res_3[0]->autoid:'0';

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
        	else if($param1 == 'sorting')
        	{
        		$section_ids = !empty($this->input->post('section_ids')) ? $this->input->post('section_ids') : '';
				if(!empty($section_ids) && count($section_ids)>0)
				{
					for($order_no= 0; $order_no < count($section_ids); $order_no++){
						$upt_data = array(
		    				'n_sort'	=> ($order_no+1)
		    			);

	    				$upt_id = array('n_id' => $section_ids[$order_no]);
	    				$update = $this->coupon_model->update($upt_data, $upt_id);
		    			// echo $this->db->last_query();die();
					}
					$response['status']   = 1;  
	                $response['message']  = "Updated successfully";
	                echo json_encode($response); return;
				}
        	}
        	else
        	{

            	$page['coupon_val']  = "";
        		$page['role_access'] = userAccess('coupon_add');
        		$page['directory']   = "app/catalogue";
		    	$page['cntrl']       = "coupon";
		    	$page['func']        = "manage";
		    	$page['data_value']  = "";
				$page['main_heading']= "Coupon";
				$page['sub_heading'] = "List Coupon";
				$page['pre_title']   = "Add Coupon";
				$page['pre_menu']    = "app/catalogue/coupon/add";
				$page['export_menu']    = "app/catalogue/coupon/export";
				$data['page_temp']   = $this->load->view('app_view/catalogue/coupon/manage',$page,TRUE);
				$data['view_file']   = "app_view/Page_Template";
				$data['title']       = "Manage Coupon";
				$data['currentmenu'] = "coupons";
				$this->bassthaya->load_table_template($data);
        	}
		}

		public function export() {
			$where       = array('n_delete' => '1');
			$option['order_by']   = 'n_id';
			$option['disp_order'] = 'DESC';
			$res_column = 'n_id, n_type, c_coupon, n_discount_percentage,n_spend_amount, n_coupon_price, n_status,n_vailidity,c_description, dt_created_at';
    		$data_list  = $this->coupon_model->getCoupon($where, '', '', 'result', [], '', $option, '', $res_column);

			$table = '<table><thead class="table-light"><tr><th>S.No</th><th>Coupon Type</th><th>Coupon Name</th><th>Min Spend</th><th>Discount Percentage</th><th>Coupon Price</th><th>Validity</th><th>Description</th><th>Current Status</th><th>Created At</th></tr></thead><tbody>';
			$i = 1;
			foreach ($data_list as $key => $val) {
            	$c_coupon = empty_check($val->c_coupon);
            	$n_type = empty_check($val->n_type);
            	$n_spend_amount = empty_check($val->n_spend_amount);
            	$n_discount_percentage = empty_check($val->n_discount_percentage);
            	$n_coupon_price = empty_check($val->n_coupon_price);
            	$n_vailidity = empty_check($val->n_vailidity);
            	$c_description = empty_check($val->c_description);
	            $n_status = zero_check($val->n_status);
	            $dt_created_at  = date_check($val->dt_created_at);

				$table .= '<tr><td>'.$i++.'</td><td>'.($n_type==2? 'No limit' : 'Spend').'</td><td>'.$c_coupon.'</td><td>'.$n_spend_amount.'</td><td>'.$n_discount_percentage.'</td><td>'.$n_coupon_price.'</td><td>'.$n_vailidity.'</td><td>'.$c_description.'</td><td>'.active_status($n_status).'</td><td>'.$dt_created_at.'</td></tr>';
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