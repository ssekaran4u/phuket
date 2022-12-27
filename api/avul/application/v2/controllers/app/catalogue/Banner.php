<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Banner extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/banner_model');
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

        	$c_category_str = '';
            $mainCat_whr  = array(
                'n_parent_id' => 0, 
                'n_status'    => 1, 
                'n_delete'    => 1
            );
            $option['order_by']   = 'c_category';
	    	$option['disp_order'] = 'ASC';
            $mainCat_col  = 'n_id, c_category';
            $this->load->model('app_model/category_model', NULL, TRUE);
            $mainCat_list = $this->category_model->getCategory($mainCat_whr, '', '', 'result', '', '', $option, '', $mainCat_col);

            if(!empty($mainCat_list))
            {
                foreach ($mainCat_list as $key => $val_2) {
                    $m_id       = empty_check($val_2->n_id);
                    $m_category = empty_check($val_2->c_category);

                    $c_category_str .= '<option value="'.$m_id.'">'.$m_category.'</option>';
                    $subCat_whr  = array(
                        'n_parent_id' => $m_id, 
                        'n_status'    => 1, 
                        'n_delete'    => 1
                    );

                    $subCat_col  = 'n_id, c_category';
                    $subCat_list = $this->category_model->getCategory($subCat_whr, '', '', 'result', '', '', '', '', $subCat_col);

                    if(!empty($subCat_list))
                    {
                        foreach ($subCat_list as $key => $val_3) {
                            $s_id       = empty_check($val_3->n_id);
                            $s_category = empty_check($val_3->c_category);

                            $c_category_str .='<option value="'.$s_id.'">--'.$s_category.'</option>';

                            $childCat_whr  = array(
		                        'n_parent_id' => $s_id, 
		                        'n_status'    => 1, 
		                        'n_delete'    => 1
		                    );

                            $childCat_col  = 'n_id, c_category';
		                    $childCat_list = $this->category_model->getCategory($childCat_whr, '', '', 'result', '', '', '', '', $childCat_col);
		                    if(!empty($childCat_list))
                    		{
                    			foreach ($childCat_list as $key => $val_4) {
		                            $c_id       = empty_check($val_4->n_id);
		                            $c_category = empty_check($val_4->c_category);

		                            $c_category_str .='<option value="'.$c_id.'">---'.$c_category.'</option>';
		                        }	
                    		}
                        }
                    }
                }
            }

        	if($formpage == 'BTBM_X_P')
        	{
			    $n_id          = $this->input->post('n_id');
        		$c_banner      = $this->input->post('c_banner');
			    $n_banner_type = $this->input->post('n_banner_type');
			    $n_banner_pos = $this->input->post('n_banner_pos');
			    $dt_start_date = $this->input->post('dt_start_date');
			    $dt_end_date   = $this->input->post('dt_end_date');
			    $c_banner_link = $this->input->post('c_banner_link');
			    $n_category      = $this->input->post('n_category');
			    $n_status      = $this->input->post('n_status');

			    $method        = $this->input->post('method');

			    $error = FALSE;
			    $errors = array();
				$required = array('c_banner', 'n_banner_type','n_banner_pos');
				if($n_banner_type == 2)
				{
					array_push($required, 'dt_start_date', 'dt_end_date');
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

		    	if($method == '_Create')
		    	{
		    		if(userAccess('banner_add') == TRUE)
		    		{
		    			$ins_data = array(
		    				'c_banner'        => str_value($c_banner),
		    				'c_short_code'    => urlSlug($c_banner),
						    'n_banner_type'   => $n_banner_type,
						    'n_banner_pos'    => $n_banner_pos,
						    'dt_start_date'   => system_date($dt_start_date),
						    'dt_end_date'     => system_date($dt_end_date),
						    'n_category'     => $n_category,
						    'c_banner_link'   => str_value($c_banner_link, 2),
						    'n_created_by'    => $this->session->userdata('n_id'),
			    			'dt_created_date' => date('Y-m-d H:i:s'),
		    			);

	    				if(!empty($_FILES['c_banner_image']['name']))
					    {
					    	$img_name  = $_FILES['c_banner_image']['name'];
							$img_val   = explode('.', $img_name);
							$img_res   = $img_val[1];
							$file_name = generateRandomString(13).'.'.$img_res;

						    $configImg['upload_path']   ='upload/banner/';
							// $configImg['max_size']      = '1024000';
							$configImg['allowed_types'] = 'jpg|jpeg|png|gif';
							$configImg['overwrite']     = FALSE;
							$configImg['remove_spaces'] = TRUE;
							// $configImg['max_width']     = 120;
                			// $configImg['max_height']    = 120;
                			$configImg['file_name']     = $file_name;
							$this->load->library('upload', $configImg);
							$this->upload->initialize($configImg);

							if(!$this->upload->do_upload('c_banner_image'))
							{
						        $response['status']  = 0;
						        $response['message'] = $this->upload->display_errors();
						        $response['data']    = [];
						        echo json_encode($response);
						        return;
							}
							else
							{
								$ins_data['c_banner_image'] = $file_name;
							}

							$insert = $this->banner_model->banner_insert($ins_data);

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
					    else
					    {
					    	$response['status']  = 0;
					        $response['message'] = response_msg('overall_required'); 
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
		    		if(userAccess('banner_edit') == TRUE)
		    		{
		    			$upt_data = array(
		    				'c_banner'        => str_value($c_banner),
		    				'c_short_code'    => urlSlug($c_banner),
						    'n_banner_type'   => $n_banner_type,
						    'n_banner_pos'   => $n_banner_pos,
						    'dt_start_date'   => system_date($dt_start_date),
						    'dt_end_date'     => system_date($dt_end_date),
						    'c_banner_link'   => str_value($c_banner_link, 2),
						    'n_status'        => $n_status,
						    'n_category'     => $n_category,
		    				'n_updated_by'    => $this->session->userdata('n_id'),
		    				'dt_updated_date' => date('Y-m-d H:i:s'),
		    			);

	    				if(!empty($_FILES['c_banner_image']['name']))
					    {
					    	$img_name  = $_FILES['c_banner_image']['name'];
							$img_val   = explode('.', $img_name);
							$img_res   = $img_val[1];
							$file_name = generateRandomString(13).'.'.$img_res;

						    $configImg['upload_path']   ='../upload/banner/';
							$configImg['max_size']      = '1024000';
							$configImg['allowed_types'] = 'jpg|jpeg|png|gif';
							$configImg['overwrite']     = FALSE;
							$configImg['remove_spaces'] = TRUE;
							$configImg['max_width']     = 1920;
                			$configImg['max_height']    = 800;
                			$configImg['file_name']     = $file_name;
							$this->load->library('upload', $configImg);
							$this->upload->initialize($configImg);

							if(!$this->upload->do_upload('c_banner_image'))
							{
						        $response['status']  = 0;
						        $response['message'] = $this->upload->display_errors();
						        $response['data']    = [];
						        echo json_encode($response);
						        return;
							}
							else
							{
								$ins_data['c_banner_image'] = $file_name;
							}
					    }

					    $upt_whr = array('n_id' => $n_id);
	    				$update  = $this->banner_model->banner_update($upt_data, $upt_whr);

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
        			// Banner Details
        			$data_whr = array('n_id' => $param2, 'n_delete' => 1);
	    			$data_col = 'n_id, c_banner, c_short_code, c_banner_link, n_banner_type, n_banner_pos,n_category, dt_start_date, dt_end_date, c_banner_image, n_status';
	    			$data_res = $this->banner_model->getBanner($data_whr, '', '', 'row', '', '', '', '', $data_col);

	    			$c_category_str = '';
		            $mainCat_whr  = array(
		                'n_parent_id' => 0, 
		                'n_status'    => 1, 
		                'n_delete'    => 1
		            );

		            $option['order_by']   = 'c_category';
	    			$option['disp_order'] = 'ASC';
		            $mainCat_col  = 'n_id, c_category';
		            $this->load->model('app_model/category_model', NULL, TRUE);
		            $mainCat_list = $this->category_model->getCategory($mainCat_whr, '', '', 'result', '', '', $option, '', $mainCat_col);

		            if(!empty($mainCat_list))
		            {
		                foreach ($mainCat_list as $key => $val_2) {
		                    $m_id       = empty_check($val_2->n_id);
		                    $m_category = empty_check($val_2->c_category);
		                    $select1 = '';
		                    if($data_res->n_category==$m_id)
		                    {
		                    	$select1 = 'selected';
		                    }
		                    
		                    $c_category_str .= '<option '.$select1.' value="'.$m_id.'">'.$m_category.'</option>';
		                    $subCat_whr  = array(
		                        'n_parent_id' => $m_id, 
		                        'n_status'    => 1, 
		                        'n_delete'    => 1
		                    );

		                    $subCat_col  = 'n_id, c_category';
		                    $subCat_list = $this->category_model->getCategory($subCat_whr, '', '', 'result', '', '', '', '', $subCat_col);

		                    if(!empty($subCat_list))
		                    {
		                        foreach ($subCat_list as $key => $val_3) {
		                            $s_id       = empty_check($val_3->n_id);
		                            $s_category = empty_check($val_3->c_category);

		                            $select2 = '';
				                    if($data_res->n_category==$s_id)
				                    {
				                    	$select2 = 'selected';
				                    }
		                            $c_category_str .='<option '.$select2.' value="'.$s_id.'">--'.$s_category.'</option>';


		                            $childCat_whr  = array(
				                        'n_parent_id' => $s_id, 
				                        'n_status'    => 1, 
				                        'n_delete'    => 1
				                    );

		                            $childCat_col  = 'n_id, c_category';
				                    $childCat_list = $this->category_model->getCategory($childCat_whr, '', '', 'result', '', '', '', '', $childCat_col);
				                    if(!empty($childCat_list))
		                    		{
		                    			foreach ($childCat_list as $key => $val_4) {
				                            $c_id       = empty_check($val_4->n_id);
				                            $c_category = empty_check($val_4->c_category);

				                            $select_ = '';
				                            if($data_res->n_category==$c_id)
				                            {
				                                $select_ = 'selected';
				                            }
				                            $c_category_str .='<option value="'.$c_id.'" '.$select_.'>---'.$c_category.'</option>';
				                        }	
		                    		}

		                        }
		                    }
		                }
		            }

	    			$page['dataval']    = $data_res;
					$page['method']     = '_Edit';
					$page['page_title'] = "Edit Banner";
        		}
        		else
        		{
        			$page['dataval']      = '';
					$page['method']       = '_Create';
					$page['page_title']   = "Create Banner";
        		}

        		$page['category_val']  = $c_category_str;
        		$page['formpage']     = "BTBM_X_P";
        		$page['directory']    = "app/catalogue";
		    	$page['cntrl']        = "banner";
		    	$page['func']         = "add";
		    	$page['page_access']  = userAccess('banner_view');
				$page['main_heading'] = "Banner";
				$page['pre_title']    = "List Banner";
				$page['pre_menu']     = "app/catalogue/banner/manage";
				$data['page_temp']    = $this->load->view('app_view/catalogue/banner/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['currentmenu']  = "banner";
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
            	$cur_page    = isset($page)?$page:1;
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
	    		$sort_col_ = array('n_id', 'c_banner', 'n_banner_type', 'n_banner_pos', 'c_banner_image', 'n_status', 'dt_created_date');
	    		array_unshift($sort_col_,"");
				unset($sort_col_[0]);

				$option['order_by']   = !empty($sort_column) ? $sort_col_[$sort_column] : 'n_id';
	    		$option['disp_order'] = !empty($sort_type) ? ($sort_type==1? 'DESC' : 'ASC') : 'DESC';

	    		$where       = array('n_delete' => 1);
				$overall_col = $this->banner_model->getBanner($where, '', '', "row", $like, array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$total_count = zero_check($overall_col->autoid);

    			$res_column = 'n_id, c_banner, n_banner_type, n_banner_pos, c_banner_image, n_status, dt_created_date';
    			$data_list  = $this->banner_model->getBanner($where, $limit, $offset, 'result', $like, '', $option, '', $res_column);

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
    	            	$c_banner        = empty_check($val->c_banner);
    	            	$n_banner_type   = empty_check($val->n_banner_type);
    	            	$n_banner_pos   = empty_check($val->n_banner_pos);
    	            	$c_banner_image  = empty_check($val->c_banner_image);
			            $n_status        = zero_check($val->n_status);
			            $dt_created_date = date_check($val->dt_created_date);

			            $edit   = '';
			            $delete = '';
			            if(userAccess('banner_edit') == TRUE)
			            {
			            	$edit = '<a href="'.BASE_URL.'app/catalogue/banner/add/Edit/'.$n_id.'" class="btn btn-warning waves-effect waves-light" style="padding: 8px;"><i class="icon-pencil"></i></a>';
			            }
			            if(userAccess('banner_delete') == TRUE)
			            {
			            	$delete = '<span data-directory="app/catalogue" data-cntrl="banner" data-func="manage" data-id="'.$n_id.'" class="del_btn btn btn-danger waves-effect waves-light" style="margin-left: 4px; padding: 8px; cursor: pointer;"><i class="icon-trash"></i></span>';
			            }

			            if(!empty($c_banner_image)) {
					        $img_value = IMG_URL.'banner/'.$c_banner_image;
					    }
					    else{
					        $img_value = BASE_URL.'app-assets/images/img_icon.png';
					    }

    	            	$table .= '
    	            		<tr class="row_'.$n_id.'">
    	            			<td>'.$i.'</td>
    	            			<td>'.str_compress($c_banner, 15).'</td>
    	            			<td>'.banner_status($n_banner_type).'</td>
    	            			<td>'.($n_banner_pos==1? 'Home Screen' : 'Inner Screen').'</td>
    	            			<td><img src="'.$img_value.'" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="45" width="45"/></td>
                                <td>'.active_status($n_status).'</td>
                                <td>'.$dt_created_date.'</td>';
                                if(userAccess('banner_edit') == TRUE || userAccess('banner_delete') == TRUE)
                                {
                                	$table .= '<td>'.$edit.$delete.'</td>';
                                }
    	            		$table .='</tr>
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
				$res_1 = $this->banner_model->getBanner($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$cnt_1 = zero_check($res_1->autoid);

                // Active Records
				$whr_2 = array('n_status' => 1, 'n_delete' => 1);
				$res_2 = $this->banner_model->getBanner($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$cnt_2 = zero_check($res_2->autoid);

                // Inactive Records
				$whr_3 = array('n_status' => 2, 'n_delete' => 1);
				$res_3 = $this->banner_model->getBanner($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
				$cnt_3 = zero_check($res_3->autoid);

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
	        			'n_delete'        => 2,
	        			'n_deleted_by'    => $this->session->userdata('n_id'),
				    	'dt_deleted_date' => date('Y-m-d H:i:s'),
	        		);

	        		$del_whr  = array('n_id' => $n_id);
	    			$del_upt  = $this->banner_model->banner_update($del_data, $del_whr);

	    			// Total Records
	                $whr_1 = array('n_delete' => 1);
					$res_1 = $this->banner_model->getBanner($whr_1, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_1 = zero_check($res_1->autoid);

	                // Active Records
					$whr_2 = array('n_status' => 1, 'n_delete' => 1);
					$res_2 = $this->banner_model->getBanner($whr_2, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_2 = zero_check($res_2->autoid);

	                // Inactive Records
					$whr_3 = array('n_status' => 2, 'n_delete' => 1);
					$res_3 = $this->banner_model->getBanner($whr_3, '', '', "row", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
					$cnt_3 = zero_check($res_3->autoid);

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
        		$page['directory']    = "app/catalogue";
		    	$page['cntrl']        = "banner";
		    	$page['func']         = "manage";
		    	$page['load_data']    = "";
		    	$page['data_value']   = "";
		    	$page['page_access']  = userAccess('banner_add');
				$page['main_heading'] = "Banner";
				$page['sub_heading']  = "List Banner";
				$page['pre_title']    = "Add Banner";
				$page['pre_menu']     = "app/catalogue/banner/add";
				$data['page_temp']    = $this->load->view('app_view/catalogue/banner/manage',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['currentmenu']  = "banners";
				$this->bassthaya->load_table_template($data);
        	}
		}
	}
?>