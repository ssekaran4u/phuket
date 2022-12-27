<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Town extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/towns');
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

        	if($formpage == 'BTBM_X_P')
        	{
        		$n_id = $this->input->post('n_id');
        		$n_city = $this->input->post('n_city');
        		$n_district = $this->input->post('n_district');
        		$c_town = $this->input->post('c_town');
			    $method = $this->input->post('method');
			    $n_status = $this->input->post('n_status');

			    $error = FALSE;
			    $errors = array();
				$required = array('n_city', 'n_district','c_town');
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
			    		if(userAccess('town_add') == TRUE)
			    		{
				    		$exs_whr = array(
				    			'c_town' => str_value($c_town,3),
				    			'n_city' => $n_city,
				    			'n_district' => $n_district,
			    				'n_status' => 1,
			    				'n_delete' => 1,
			    			);

			    			$exs_col = 'n_id';
			    			$exs_res = $this->towns->getTown($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

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
			    				$ins_data = array(
			    					'c_town' => str_value($c_town, 3),
			    					'n_city' => $n_city,
				    				'n_district' => $n_district,
				    				'n_created_by'    => $this->session->userdata('n_id'),
				    				'dt_created_at' => date('Y-m-d H:i:s'),
				    			);

				    			$insert = $this->towns->insert($ins_data);

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
			    		if(userAccess('town_edit') == TRUE)
			    		{
				    		$exs_whr = array(
				    			'n_city'	=> $n_city,
				    			'n_district'=> $n_district,
				    			'n_id !='   => $n_id,
				    			'c_town'    => str_value($c_town,3),
			    				'n_status'  => 1,
			    				'n_delete'  => 1,
			    			);

			    			$exs_col = 'n_id';
			    			$exs_res = $this->towns->getTown($exs_whr, '', '', 'result', '', '', '', '', $exs_col);

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
			    				$upt_data = array(
			    					'n_city' => $n_city,
				    				'n_district' => $n_district,
			    					'c_town' => str_value($c_town, 3),
			    					'n_status' => $n_status_,
				    				'n_updated_by' => $this->session->userdata('n_id'),
				    				'dt_updated_at' => date('Y-m-d H:i:s'),
				    			);

			    				$upt_whr = array('n_id' => $n_id);
		    					$update  = $this->towns->update($upt_data, $upt_whr);

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
			else
        	{
        		if($param1 == 'Edit')
        		{
        			$data_whr = array('n_id' => $param2, 'n_delete' => 1);
	    			$data_col = 'n_id, n_city,n_district,c_town, n_status';
	    			$data_res = $this->towns->getTown($data_whr, '', '', 'row', '', '', '', '', $data_col);
	    			// echo $this->db->last_query();die();

	    			$option['order_by']   = 'c_district';
		    		$option['disp_order'] = 'ASC';
	        		$this->load->model('app_model/districts', NULL, TRUE);
	        		$districts_whr  = array('n_status' => 1, 'n_delete' => 1);
	        		$districts_col  = 'n_id, c_district';
	        		$districts_list = $this->districts->getDistrict($districts_whr, '', '', 'result', '', '', $option, '', $districts_col);
	        		// print_r($districts_list);die();
	        		$page['district_list'] = $districts_list;
        			$page['dataval']    = $data_res;
					$page['method']     = '_Edit';
					$page['page_title'] = "Edit Town";
        		}
        		else
        		{
        			$page['dataval']    = '';
					$page['method']     = '_Create';
					$page['page_title'] = "Create Town";
        		}

        		$option['order_by']   = 'c_city';
	    		$option['disp_order'] = 'ASC';
        		$this->load->model('app_model/cities', NULL, TRUE);
        		$city_whr  = array('n_status' => 1, 'n_delete' => 1);
        		$city_col  = 'n_id, c_city';
        		$city_list = $this->cities->getCity($city_whr, '', '', 'result', '', '', $option, '', $city_col);

        		$page['city_list'] = $city_list;
        		$page['role_access']  = userAccess('town_view');
        		$page['formpage']     = "BTBM_X_P";
        		$page['directory']    = "app/master";
		    	$page['cntrl']        = "town";
		    	$page['func']         = "add";
				$page['main_heading'] = "Town";
				$page['pre_title']    = "List Town";
				$page['pre_menu']     = "app/master/town/manage";
				$data['page_temp']    = $this->load->view('app_view/masters/town/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Create Town";
				$data['currentmenu']  = "town";
				$this->bassthaya->load_form_template($data);
        	}
		}

		public function getDistrict() {
			$n_city = $this->input->post('n_city');
			if(!empty($n_city))
			{
				$option['order_by']   = 'c_district';
	    		$option['disp_order'] = 'ASC';
	    		$this->load->model('app_model/districts', NULL, TRUE);
	    		$districts_whr  = array('n_status' => 1, 'n_delete' => 1,'n_city'=>$n_city);
	    		$districts_col  = 'n_id, c_district';
	    		$districts_list = $this->districts->getDistrict($districts_whr, '', '', 'result', '', '', $option, '', $districts_col);
	    		$c_district_str = '<option value="0">Select Option</option>';
	    		if(!empty($districts_list))
                {
                    foreach ($districts_list as $key => $val_1) {
                        $s_id    = empty_check($val_1->n_id);
                        $c_district = empty_check($val_1->c_district);
                        $c_district_str .= '<option value="'.$s_id.'">'.$c_district.'</option>';
                    }
                }
                $response['status']  = 1;
		        $response['message'] = ""; 
		        $response['data']    = $c_district_str;
		        echo json_encode($response);
		        return; 
    		}
		}

		public function getTown() {
			$n_district = $this->input->post('n_district');
			if(!empty($n_district))
			{
				$option['order_by']   = 'c_town';
	    		$option['disp_order'] = 'ASC';
	    		$dist_whr  = array('n_status' => 1, 'n_delete' => 1,'n_district'=>$n_district);
	    		$dist_col  = 'n_id, c_town';
	    		$dist_list = $this->towns->getTown($dist_whr, '', '', 'result', '', '', $option, '', $dist_col);
	    		// echo $this->db->last_query();die();
	    		$c_town_str = '<option value="0">Select Option</option>';
	    		if(!empty($dist_list))
                {
                    foreach ($dist_list as $key => $val_1) {
                        $s_id    = empty_check($val_1->n_id);
                        $c_town = empty_check($val_1->c_town);
                        $c_town_str .= '<option value="'.$s_id.'">'.$c_town.'</option>';
                    }
                }
                $response['status']  = 1;
		        $response['message'] = ""; 
		        $response['data']    = $c_town_str;
		        echo json_encode($response);
		        return; 
    		}
		}

		public function manage($param1="", $param2="", $param3="") {
			if ($this->session->userdata('random_value') == '')
        	redirect(BASE_URL, 'refresh');
        	$active_user = $this->session->get_userdata()['n_id'];
        	$method = $this->input->post('method');

        	if($method == 'data_list') {
        		if(userAccess('town_view') == TRUE)
			    {
	        		$_limit   	   = $this->input->post('limitval');
	            	$page     	   = $this->input->post('page');
	            	$search   	   = $this->input->post('search');
	            	$sort_column   = $this->input->post('sort_column');
	            	$sort_type     = $this->input->post('sort_type');
	            	$n_city		   = $this->input->post('add_fields')['n_city'];
	            	$n_district	   = $this->input->post('add_fields')['n_district'];

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

		    		$sort_col_ = array("A.n_sort","B.c_district","C.c_city","n_status","dt_created_at");
		    		array_unshift($sort_col_,"");
					unset($sort_col_[0]);

		    		$where       = array('A.n_delete' => 1);
		    		if($n_city>0)
		    		{
		    			$where['A.n_city'] = $n_city;
		    		}
		    		if($n_district>0)
		    		{
		    			$where['A.n_district'] = $n_district;
		    		}
					$overall_col = $this->towns->getTownJoin($where, '', '', "row", $like, array(), array(), TRUE, 'COUNT(A.n_id) AS autoid');

					// echo $this->db->last_query();die();
					$total_count = !empty($overall_col->autoid)?$overall_col->autoid:0;

					$option['order_by']   = !empty($sort_column) ? $sort_col_[$sort_column] : 'A.n_sort';
	    			$option['disp_order'] = !empty($sort_type) ? ($sort_type==1? 'ASC' : 'DESC') : 'DESC';

	    			$res_column = 'A.n_id, A.n_sort, A.c_town, B.c_district, C.c_city, A.n_status, A.dt_created_at';
	    			$data_list  = $this->towns->getTownJoin($where, $limit, $offset, 'result', $like, '', $option, '', $res_column);
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
	    	            	$n_id            = empty_check($val->n_id);
				            $c_town         = empty_check($val->c_town);
				            $c_district    = empty_check($val->c_district);
				            $c_city    = empty_check($val->c_city);
				            $n_status        = zero_check($val->n_status);
				            $dt_created_at = date_check($val->dt_created_at);

				            $edit   = '';
				            $delete = '';
				            if(userAccess('town_edit') == TRUE)
				            {
				            	$edit = '<a href="'.BASE_URL.'app/master/town/add/Edit/'.$n_id.'" class="btn btn-warning waves-effect waves-light" style="padding: 8px;"><i class="icon-pencil"></i></a>';
				            }

				            if(userAccess('town_delete') == TRUE)
				            {
					            $delete = '<span data-directory="app/master" data-cntrl="town" data-func="manage" data-id="'.$n_id.'" class="del_btn btn btn-danger waves-effect waves-light" style="margin-left: 4px; padding: 8px; cursor: pointer;"><i class="icon-trash"></i></span>';
					        }
	    	            	$table .= '<tr data-section-id="'.$n_id.'" class="row_'.$n_id.'"><td>'.$val->n_sort.'</td><td>'.$c_town.'</td>
	                                <td>'.$c_district.'</td><td>'.$c_city.'</td><td>'.active_status($n_status).'</td><td>'.$dt_created_at.'</td>';
	                                if(userAccess('town_edit') == TRUE || userAccess('town_delete') == TRUE)
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
					$res_1 = $this->towns->getTown($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_1 = !empty($res_1->autoid)?$res_1->autoid:'0';

	                // Active Records
					$whr_2 = array('n_status' => 1, 'n_delete' => 1);
					$res_2 = $this->towns->getTown($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_2 = !empty($res_2->autoid)?$res_2->autoid:'0';

	                // Inactive Records
					$whr_3 = array('n_status' => 2, 'n_delete' => 1);
					$res_3 = $this->towns->getTown($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
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
        		if(userAccess('town_delete') == TRUE)
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

			    	$del_data = array(
	        			'n_delete'        => 2,
	        			'n_deleted_by'    => $this->session->userdata('n_id'),
				    	'dt_deleted_at' => date('Y-m-d H:i:s'),
	        		);

			    	$check_mapping = array(
			    		'n_delete'        => 1,
			    		'n_status'        => 1,
			    		'n_id'		      => $n_id
			    	);

			    	$check =  $this->towns->getCity($check_mapping,'', '', "row", array(), array(), array(), TRUE, 'n_id');

			    	if(!$check)
			    	{
		        		$del_whr  = array('n_id' => $n_id);
		    			$del_upt  = $this->towns->town_update($del_data, $del_whr);

		    			// Total Records
		                $whr_1 = array('n_delete' => 1);
						$res_1 = $this->towns->getTown($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_1 = !empty($res_1->autoid)?$res_1->autoid:'0';

		                // Active Records
						$whr_2 = array('n_status' => 1, 'n_delete' => 1);
						$res_2 = $this->towns->getTown($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
						$cnt_2 = !empty($res_2->autoid)?$res_2->autoid:'0';

		                // Inactive Records
						$whr_3 = array('n_status' => 2, 'n_delete' => 1);
						$res_3 = $this->towns->getTown($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
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
        		// echo "string";die();
        		$section_ids = !empty($this->input->post('section_ids')) ? $this->input->post('section_ids') : '';
				if(!empty($section_ids) && count($section_ids)>0)
				{
					for($order_no= 0; $order_no < count($section_ids); $order_no++){
						$upt_data = array(
		    				'n_sort'	=> ($order_no+1)
		    			);
	    				$upt_id = array('n_id' => $section_ids[$order_no]);
	    				$update = $this->towns->update($upt_data, $upt_id);
		    			// echo $this->db->last_query();die();
					}
					$response['status']   = 1;  
	                $response['message']  = "Updated successfully";
	                echo json_encode($response); return;
				}
        	}
        	else
        	{
        		$this->load->model('app_model/cities', NULL, TRUE);
        		$city_whr  = array('n_status' => 1, 'n_delete' => 1);
        		$city_col  = 'n_id, c_city';
        		$option['order_by']   = 'c_city';
	    		$option['disp_order'] = 'ASC';
        		$city_list = $this->cities->getCity($city_whr, '', '', 'result', '', '', $option, '', $city_col);

        		$page['city_val']     = $city_list;
        		$page['role_access']  = userAccess('town_add');
        		$page['directory']    = "app/master";
		    	$page['cntrl']        = "town";
		    	$page['func']         = "manage";
		    	$page['data_value']   = "";
				$page['main_heading'] = "Town";
				$page['sub_heading']  = "List Town";
				$page['pre_title']    = "Add Town";
				$page['pre_menu']     = "app/master/town/add";
				$page['export_menu']  = "app/master/town/export";
				$data['page_temp']    = $this->load->view('app_view/masters/town/manage',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Manage Town";
				$data['currentmenu']  = "towns";
				$this->bassthaya->load_table_template($data);
        	}
		}	
		public function export() {
			$option['order_by']   = 'A.n_sort';
			$option['disp_order'] = 'DESC';
			$where       = array('A.n_delete' => 1);
			$res_column = 'A.n_id, A.n_sort, A.c_town, B.c_district, C.c_city, A.n_status, A.dt_created_at';
			$data_list  = $this->towns->getTownJoin($where, '', '', 'result', [], '', $option, '', $res_column);
			// print_r($data_list);die();
			$table = '<table><thead class="table-light"><tr><th>Display Order</th><th>Town Name</th><th>District Name</th><th>City Name</th><th>Current Status</th><th>Created At</th></tr></thead><tbody>';
			foreach ($data_list as $key => $val) {
				$n_id            = empty_check($val->n_id);
	            $c_town         = empty_check($val->c_town);
	            $c_district    = empty_check($val->c_district);
	            $c_city    = empty_check($val->c_city);
	            $n_status        = zero_check($val->n_status);
	            $dt_created_at = date_check($val->dt_created_at);

				$table .= '<tr><td>'.$val->n_sort.'</td><td>'.$c_town.'</td>
                <td>'.$c_district.'</td><td>'.$c_city.'</td><td>'.active_status($n_status).'</td><td>'.$dt_created_at.'</td></tr>';
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