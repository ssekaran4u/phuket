<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Demographic extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/demographic_model');
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

        	if($formpage == 'BTBM_X_P')
        	{
        		$n_id          = $this->input->post('n_id');
			    $c_demographic = $this->input->post('c_demographic');
			    $method        = $this->input->post('method');
			    $n_status      = $this->input->post('n_status');

        		$error = FALSE;
			    $errors = array();
				$required = array('c_demographic');
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

			    if(count($errors)==0)
			    {
			    	if($method == '_Create')
			    	{
			    		if(userAccess('demographic_add') == TRUE)
			    		{
			    			$exs_whr = array(
				    			'c_short_code' => clean($c_demographic),
			    				'n_delete'     => '1',
			    			);

			    			$exs_col = 'n_id';
			    			$exs_res = $this->demographic_model->getDemographic($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

			    			if($exs_res)
			    			{
			    				$response['status']  = 0;
						        $response['message'] = response_msg('already_exist', $c_demographic); 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
			    			}
			    			else
			    			{
			    				$ins_data = array(
			    					'c_demographic'   => str_value($c_demographic),
			    					'c_short_code'    => clean($c_demographic),
				    				'n_created_by'    => $this->session->userdata('n_id'),
				    				'dt_created_date' => date('Y-m-d H:i:s'),
				    			);

				    			$insert = $this->demographic_model->demographic_insert($ins_data);

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
			    		if(userAccess('demographic_edit') == TRUE)
			    		{
			    			$exs_whr = array(
				    			'n_id !='      => $n_id,
			    				'c_short_code' => clean($c_demographic),
			    				'n_delete'     => '1',
			    			);

			    			$exs_col = 'n_id';
			    			$exs_res = $this->demographic_model->getDemographic($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

			    			if($exs_res)
			    			{
			    				$response['status']  = 0;
						        $response['message'] = response_msg('already_exist', $c_demographic); 
						        $response['data']    = [];
						        echo json_encode($response);
						        return; 
			    			}
			    			else
			    			{
			    				$upt_data = array(
			    					'c_demographic'   => str_value($c_demographic),
			    					'c_short_code'    => clean($c_demographic),
			    					'n_status'        => $n_status,
				    				'n_updated_by'    => $this->session->userdata('n_id'),
				    				'dt_updated_date' => date('Y-m-d H:i:s'),
				    			);

			    				$upt_whr = array('n_id' => $n_id);
		    					$update  = $this->demographic_model->demographic_update($upt_data, $upt_whr);

							    if($update)
							    {
				        			$response['status']  = 1;
							        $response['message'] = response_msg('success', 2); 
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
        			$data_whr = array('n_id' => $param2, 'n_delete' => '1');
	    			$data_col = 'n_id, c_demographic, n_status';
	    			$data_res = $this->demographic_model->getDemographic($data_whr, '', '', 'result', '', '', '', '', $data_col);

        			$page['dataval']    = $data_res;
					$page['method']     = '_Edit';
					$page['page_title'] = "Edit Demographic";
        		}
        		else
        		{
        			$page['dataval']    = '';
					$page['method']     = '_Create';
					$page['page_title'] = "Create Demographic";
        		}

        		$page['formpage']     = "BTBM_X_P";
        		$page['directory']    = "app/master";
		    	$page['cntrl']        = "demographic";
		    	$page['func']         = "add";
		    	$page['page_access']  = userAccess('demographic_view');
				$page['main_heading'] = "Demographic";
				$page['pre_title']    = "List Demographic";
				$page['pre_menu']     = "app/master/demographic/manage";
				$data['page_temp']    = $this->load->view('app_view/masters/demographic/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['currentmenu']  = "demographic_add";
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
	    		$sort_col_ = array('n_id', 'c_demographic', 'n_status', 'dt_created_date');
	    		array_unshift($sort_col_,"");
				unset($sort_col_[0]);

	    		$option['order_by']   = !empty($sort_column) ? $sort_col_[$sort_column] : 'n_id';
	    		$option['disp_order'] = !empty($sort_type) ? ($sort_type==1? 'DESC' : 'ASC') : 'DESC';

	    		$where       = array('n_delete' => '1');
				$overall_col = $this->demographic_model->getDemographic($where, '', '', "result", $like, array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$total_count = zero_check($overall_col[0]->autoid);

    			$res_column = 'n_id, c_demographic, n_status, dt_created_date';
    			$data_list  = $this->demographic_model->getDemographic($where, $limit, $offset, 'result', $like, '', $option, '', $res_column);

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
    	            	$c_demographic   = empty_check($val->c_demographic);
			            $n_status        = zero_check($val->n_status);
			            $dt_created_date = date_check($val->dt_created_date);

			            $edit   = '';
			            $delete = '';
			            if(userAccess('demographic_edit') == TRUE)
			            {
			            	$edit = '<a href="'.BASE_URL.'app/package/demographic/add/Edit/'.$n_id.'" class="btn btn-warning waves-effect waves-light" style="padding: 8px;"><i class="icon-pencil"></i></a>';
			            }

			            if(userAccess('demographic_delete') == TRUE)
			            {
			            	$delete = '<span data-directory="app/package" data-cntrl="demographic" data-func="manage" data-id="'.$n_id.'" class="del_btn btn btn-danger waves-effect waves-light" style="margin-left: 4px; padding: 8px; cursor: pointer;"><i class="icon-trash"></i></span>';
			            }

    	            	$table .= '
    	            		<tr data-section-id="'.$n_id.'" class="row_'.$n_id.'">
    	            			<td>'.$i.'</td>
    	            			<td>'.$c_demographic.'</td>
                                <td>'.active_status($n_status).'</td>
                                <td>'.$dt_created_date.'</td>';
                                if(userAccess('demographic_edit') == TRUE || userAccess('demographic_delete') == TRUE)
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
				$res_1 = $this->demographic_model->getDemographic($whr_1, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$cnt_1 = zero_check($res_1[0]->autoid);

                // Active Records
				$whr_2 = array('n_status' => '1', 'n_delete' => '1');
				$res_2 = $this->demographic_model->getDemographic($whr_2, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$cnt_2 = zero_check($res_2[0]->autoid);

                // Inactive Records
				$whr_3 = array('n_status' => '2', 'n_delete' => '1');
				$res_3 = $this->demographic_model->getDemographic($whr_3, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
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
        		if(userAccess('demographic_delete') == TRUE)
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
		    			$del_upt  = $this->demographic_model->demographic_update($del_data, $del_whr);

		    			// Total Records
		                $whr_1 = array('n_delete' => '1');
						$res_1 = $this->demographic_model->getDemographic($whr_1, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_1 = zero_check($res_1[0]->autoid);

		                // Active Records
						$whr_2 = array('n_status' => '1', 'n_delete' => '1');
						$res_2 = $this->demographic_model->getDemographic($whr_2, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_2 = zero_check($res_2[0]->autoid);

		                // Inactive Records
						$whr_3 = array('n_status' => '2', 'n_delete' => '1');
						$res_3 = $this->demographic_model->getDemographic($whr_3, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
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
	    				$update = $this->demographic_model->demographic_update($upt_data, $upt_id);
					}
					$response['status']  = 1;  
					$response['message']  = "Updated successfully";
	                $response['data']    = [];
	                echo json_encode($response);
	                return;
				}
        	}

        	else
        	{
        		$page['directory']    = "app/master";
		    	$page['cntrl']        = "demographic";
		    	$page['func']         = "manage";
		    	$page['load_data']    = "";
		    	$page['data_value']   = "";
		    	$page['page_access']  = userAccess('demographic_add');
				$page['main_heading'] = "Demographic";
				$page['sub_heading']  = "List Demographic";
				$page['pre_title']    = "Add Demographic";
				$page['pre_menu']     = "app/master/demographic/add";
				$page['export_menu']  = "app/master/demographic/export";
				$data['page_temp']    = $this->load->view('app_view/masters/demographic/manage',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['currentmenu']  = "demographic_view";
				$this->bassthaya->load_table_template($data);
        	}
		}

		public function export() {
			
			$option['order_by']   = 'n_sort';
			$option['disp_order'] = 'ASC';

			$where  = array('n_delete' => 1);
			$column = 'n_id, c_demographic, n_sort, n_status, dt_created_date';
			$result = $this->demographic_model->getDemographic($where, '', '', 'result', '', '', $option, '', $column);

			$table = '<table border="1"><thead class="table-light"><tr><th>Sort</th><th>Amenities</th><th>Current Status</th><th>Created At</th></tr></thead><tbody>';

			foreach ($result as $key => $val) {
				$c_demographic     = empty_check($val->c_demographic);
	            $n_sort          = empty_check($val->n_sort);
	            $n_status        = zero_check($val->n_status);
	            $dt_created_date = date_check($val->dt_created_date);

	            $table .= '<tr><td>'.$n_sort.'</td><td>'.$c_demographic.'</td><td>'.active_status($n_status).'</td><td>'.$dt_created_date.'</td></tr>';
			}

			$table .= '</tbody></table>';

			echo $table;
            header("Content-Type: application/xls");    
			header("Content-Disposition: attachment; filename=".time().".xls");  
			header("Pragma: no-cache"); 
			header("Expires: 0");
		}
	}
?>