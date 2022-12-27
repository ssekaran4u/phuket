<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pages extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/pages_model');
		}

		public function index($param1="", $param2="", $param3="")
		{
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');
    	}

    	public function add($param1="", $param2="", $param3="")
    	{
    		if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');

        	$formpage = $this->input->post('formpage');

        	if($formpage == 'BTBM_X_P')
        	{
        		$n_id          = $this->input->post('n_id');
        		$c_pages       = $this->input->post('c_pages');
        		$n_page_type   = $this->input->post('n_page_type');
        		$c_description = $this->input->post('c_description');
        		$c_link        = $this->input->post('c_link');
        		$method        = $this->input->post('method');
        		$n_status      = $this->input->post('n_status');
        		$random_val    = generateRandomString(32);

        		$error = FALSE;
			    $errors = array();
				$required = array('c_pages', 'n_page_type');
				if($n_page_type == 1)
				{
					array_push($required, 'c_description');
				}
				else if($n_page_type == 2)
				{
					array_push($required, 'c_link');
				}
				else if($method == '_Edit')
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

			    if(count($errors)==0)
			    {
			    	if($method == '_Create')
			    	{
			    		if(userAccess('pages_add') == TRUE)
			    		{
			    			$exs_whr = array(
				    			'c_short_code' => urlSlug($c_pages),
			    				'n_status'     => '1',
			    				'n_delete'     => '1',
			    			);

			    			$exs_col = 'n_id';
			    			$exs_res = $this->pages_model->getPages($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

			    			if($exs_res)
			    			{
			    				$response['status']  = 0;
						        $response['message'] = response_msg('already_exist', $c_pages); 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
			    			}
			    			else
			    			{
			    				$ins_data = array(
				    				'c_pages'         => str_value($c_pages),
				    				'c_short_code'    => urlSlug($c_pages),
				    				'n_page_type'     => $n_page_type,
				    				'c_page_random'   => $random_val,
				    				'n_created_by'    => $this->session->userdata('n_id'),
				    				'dt_created_date' => date('Y-m-d H:i:s'),
				    			);

				    			if($n_page_type == 1)
				    			{
				    				$ins_data['c_description'] = $c_description;
				    			}

				    			if($n_page_type == 2)
				    			{
				    				$ins_data['c_description'] = $c_link;
				    			}

				    			$insert  = $this->pages_model->pages_insert($ins_data);

				    			if($insert)
							    {
				        			$response['status']  = 1;
							        $response['message'] = response_msg('success', 1); 
							        $response['data']    = [];
							        echo json_encode($response);
							        return; 
							    }
							    else
							    {
				        			$response['status']  = 0;
							        $response['message'] = response_msg('try_again'); 
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
			    		if(userAccess('pages_edit') == TRUE)
			    		{
			    			$exs_whr = array(
			    				'n_id !='      => $n_id,
				    			'c_short_code' => urlSlug($c_pages),
			    				'n_status'     => '1',
			    				'n_delete'     => '1',
			    			);

			    			$exs_col = 'n_id';
			    			$exs_res = $this->pages_model->getPages($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

			    			if($exs_res)
			    			{
			    				$response['status']  = 0;
						        $response['message'] = response_msg('already_exist', $c_pages); 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
			    			}
			    			else
			    			{
			    				$upt_data = array(
				    				'c_pages'         => str_value($c_pages),
								    'n_page_type'     => $n_page_type,
								    'n_status'        => $n_status,
				    				'n_updated_by'    => $this->session->userdata('n_id'),
				    				'dt_updated_date' => date('Y-m-d H:i:s'),
				    			);

				    			if($n_page_type == 1)
				    			{
				    				$upt_data['c_description'] = $c_description;
				    			}

				    			if($n_page_type == 2)
				    			{
				    				$upt_data['c_description'] = $c_link;
				    			}

				    			$upt_whr = array('n_id' => $n_id);
			    				$update  = $this->pages_model->pages_update($upt_data, $upt_whr);

				    			if($update)
							    {
				        			$response['status']  = 1;
							        $response['message'] = response_msg('success', 1); 
							        $response['data']    = [];
							        echo json_encode($response);
							        return; 
							    }
							    else
							    {
				        			$response['status']  = 0;
							        $response['message'] = response_msg('try_again'); 
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
        	else
        	{
        		if($param1 == 'Edit')
        		{
        			// Pages Details
        			$data_whr = array('n_id' => $param2, 'n_delete' => '1');
	    			$data_col = 'n_id, c_pages, c_description, n_page_type, n_status';
	    			$data_res = $this->pages_model->getPages($data_whr, '', '', 'row', '', '', '', '', $data_col);

	    			$page['dataval']    = $data_res;
					$page['method']     = '_Edit';
					$page['page_title'] = "Edit Pages";
        		}
        		else
        		{
        			$page['dataval']      = '';
					$page['method']       = '_Create';
					$page['page_title']   = "Create Pages";
        		}

        		$page['formpage']     = "BTBM_X_P";
        		$page['directory']    = "app";
		    	$page['cntrl']        = "pages";
		    	$page['func']         = "add";
		    	$page['page_access']  = userAccess('pages_view');
				$page['main_heading'] = "Pages";
				$page['pre_title']    = "List Pages";
				$page['pre_menu']     = "app/pages/manage";
				$data['page_temp']    = $this->load->view('app_view/pages/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['currentmenu']  = "pages_add";
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
        		$_limit      = $this->input->post('limitval');
            	$page        = $this->input->post('page');
            	$search      = $this->input->post('search');
            	$sort_column = $this->input->post('sort_column');
	            $sort_type   = $this->input->post('sort_type');
            	$cur_page    = isset($page)?$page:'1';
            	$_offset     = ($cur_page-1) * $_limit;
            	$nxt_page    = $cur_page + 1;
            	$pre_page    = $cur_page - 1;
            	$page_val    = $cur_page * $_limit;

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

	    		// Sorting
	    		$sort_col_ = array('n_id', 'c_pages', 'n_page_type', 'n_status', 'dt_created_date');
	    		array_unshift($sort_col_,"");
				unset($sort_col_[0]);

	    		$option['order_by']   = !empty($sort_column) ? $sort_col_[$sort_column] : 'n_id';
	    		$option['disp_order'] = !empty($sort_type) ? ($sort_type==1? 'DESC' : 'ASC') : 'DESC';

	    		$where       = array('n_delete' => '1');
				$overall_col = $this->pages_model->getPages($where, '', '', "result", $like, array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$total_count = zero_check($overall_col[0]->autoid);

    			$res_column = 'n_id, c_pages, n_page_type, n_status, dt_created_date';
    			$data_list  = $this->pages_model->getPages($where, $limit, $offset, 'result', $like, '', $option, '', $res_column);

    			if($data_list)
    			{
    				$count    = count($data_list);
	            	$tot_page = ceil($total_count / $limit); 

    				$status  = 1;
	            	$message = response_msg('success');
	            	$table   = '';
	            	
	            	$i=1;
    	            foreach ($data_list as $key => $val) {

    	            	$n_id            = empty_check($val->n_id);
    	            	$c_pages         = empty_check($val->c_pages);
    	            	$n_page_type     = empty_check($val->n_page_type);
			            $n_status        = zero_check($val->n_status);
			            $dt_created_date = date_check($val->dt_created_date);

			            $edit   = '';
			            $delete = '';
			            if(userAccess('pages_edit') == TRUE)
			            {
			            	$edit = '<a href="'.BASE_URL.'app/pages/add/Edit/'.$n_id.'" class="btn btn-warning waves-effect waves-light" style="padding: 8px;"><i class="icon-pencil"></i></a>';
			            }
			            if(userAccess('pages_delete') == TRUE)
			            {
			            	$delete = '<span data-directory="app" data-cntrl="pages" data-func="manage" data-id="'.$n_id.'" class="del_btn btn btn-danger waves-effect waves-light" style="margin-left: 4px; padding: 8px; cursor: pointer;"><i class="icon-trash"></i></span>';
			            }

    	            	$table .= '
    	            		<tr data-section-id="'.$n_id.'" class="row_'.$n_id.'">
    	            			<td>'.$i.'</td>
    	            			<td>'.str_compress($c_pages, 25).'</td>
    	            			<td>'.page_status($n_page_type).'</td>
                                <td>'.active_status($n_status).'</td>
                                <td>'.$dt_created_date.'</td>';
                                if(userAccess('pages_edit') == TRUE || userAccess('pages_delete') == TRUE)
                                {
                                	$table .= '<td>'.$edit.$delete.'</td>';
                                }
    	            		$table .='</tr>';
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
                    $offset_val = '1';
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
                $whr_1 = array('n_delete' => '1');
				$res_1 = $this->pages_model->getPages($whr_1, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$cnt_1 = zero_check($res_1[0]->autoid);

                // Active Records
				$whr_2 = array('n_status' => '1', 'n_delete' => '1');
				$res_2 = $this->pages_model->getPages($whr_2, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$cnt_2 = zero_check($res_2[0]->autoid);

                // Inactive Records
				$whr_3 = array('n_status' => '2', 'n_delete' => '1');
				$res_3 = $this->pages_model->getPages($whr_3, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$cnt_3 = zero_check($res_3[0]->autoid);

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

        	else if($method == 'data_delete')
        	{
        		if(userAccess('pages_delete') == TRUE)
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
				    		'n_status'        => '2',
		        			'n_delete'        => '2',
		        			'n_deleted_by'    => $this->session->userdata('n_id'),
					    	'dt_deleted_date' => date('Y-m-d H:i:s'),
		        		);

		        		$del_whr  = array('n_id' => $n_id);
		    			$del_upt  = $this->pages_model->pages_update($del_data, $del_whr);

		    			// Total Records
		                $whr_1 = array('n_delete' => '1');
						$res_1 = $this->pages_model->getPages($whr_1, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_1 = zero_check($res_1[0]->autoid);

		                // Active Records
						$whr_2 = array('n_status' => '1', 'n_delete' => '1');
						$res_2 = $this->pages_model->getPages($whr_2, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_2 = zero_check($res_2[0]->autoid);

		                // Inactive Records
						$whr_3 = array('n_status' => '2', 'n_delete' => '1');
						$res_3 = $this->pages_model->getPages($whr_3, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_3 = zero_check($res_3[0]->autoid);

						$records = array(
							'total_record'    => $cnt_1,
							'active_record'   => $cnt_2,
							'inactive_record' => $cnt_3,
						);

					    if($del_upt)
					    {
		        			$response['status']  = 1;
					        $response['message'] = response_msg('success', 3); 
					        $response['data']    = [];
					        $response['records'] = $records;
					        echo json_encode($response);
					        return; 
					    }
					    else
					    {
		        			$response['status']  = 0;
					        $response['message'] = response_msg('try_again'); 
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
	    				$update = $this->pages_model->pages_update($upt_data, $upt_id);
					}
					$response['status']  = 1;  
	                $response['message'] = response_msg('success', 2); 
	                $response['data']    = [];
	                echo json_encode($response);
	                return;
				}
        	}

        	else
        	{
        		$page['directory']    = "app";
		    	$page['cntrl']        = "pages";
		    	$page['func']         = "manage";
		    	$page['load_data']    = "";
		    	$page['data_value']   = "";
		    	$page['page_access']  = userAccess('pages_add');
				$page['main_heading'] = "Pages";
				$page['sub_heading']  = "List Pages";
				$page['pre_title']    = "Add Pages";
				$page['pre_menu']     = "app/pages/add";
				$data['page_temp']    = $this->load->view('app_view/pages/manage',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['currentmenu']  = "pages_view";
				$this->bassthaya->load_table_template($data);
        	}
    	}
    }
?>