<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Public_vendor extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('encryption');
			$this->load->helper('url');
			$this->load->model('app_model/master_model');
			$this->load->model('app_model/catalogue_model');
			$this->load->model('app_model/vendor_model');
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
        	$method   = $this->input->post('method');


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
        		$n_id         = $this->input->post('n_id');
				$n_city = $this->input->post('n_city');
        		$n_district = $this->input->post('n_district');
        		$n_town = $this->input->post('n_town');
				$n_category = $this->input->post('n_category');
				$n_latitude = $this->input->post('n_latitude');
				$n_longitude = $this->input->post('n_longitude');
				$c_name = $this->input->post('c_name');
				$c_name_in_thai = $this->input->post('c_name_in_thai');
				$c_address = $this->input->post('c_address');
				$c_mobile_numbers = $this->input->post('c_mobile_numbers');
				$c_emailids = $this->input->post('c_emailids');

				$c_c_full_name = $this->input->post('c_c_full_name');
				$c_c_short_name = $this->input->post('c_c_short_name');
				$c_c_contact_number = $this->input->post('c_c_contact_number');
				$c_n_is_other = $this->input->post('c_n_is_other');
				$c_c_whatsapp = $this->input->post('c_c_whatsapp');
				$c_c_line = $this->input->post('c_c_line');
				$c_c_emailid = $this->input->post('c_c_emailid');

				$n_sunday = $this->input->post('n_sunday');
				$n_sunday_start = $this->input->post('n_sunday_start');
				$n_sunday_end = $this->input->post('n_sunday_end');
				$n_monday = $this->input->post('n_monday');
				$n_monday_start = $this->input->post('n_monday_start');
				$n_monday_end = $this->input->post('n_monday_end');
				$n_tuesday = $this->input->post('n_tuesday');
				$n_tuesday_start = $this->input->post('n_tuesday_start');
				$n_tuesday_end = $this->input->post('n_tuesday_end');
				$n_wednesday = $this->input->post('n_wednesday');
				$n_wednesday_start = $this->input->post('n_wednesday_start');
				$n_wednesday_end = $this->input->post('n_wednesday_end');
				$n_thursday = $this->input->post('n_thursday');
				$n_thursday_start = $this->input->post('n_thursday_start');
				$n_thursday_end = $this->input->post('n_thursday_end');
				$n_friday = $this->input->post('n_friday');
				$n_friday_start = $this->input->post('n_friday_start');
				$n_friday_end = $this->input->post('n_friday_end');
				$n_saturday = $this->input->post('n_saturday');
				$n_saturday_start = $this->input->post('n_saturday_start');
				$n_saturday_end = $this->input->post('n_saturday_end');
			    $method       = $this->input->post('method');
			    $n_status     = $this->input->post('n_status');
			    $c_terms     = $this->input->post('c_terms');

			    

			    $error = FALSE;
			    $errors = array();
				$required = array('c_name');
				$day_count = 0;
				foreach (array('n_sunday','n_monday','n_tuesday','n_wednesday','n_thursday','n_friday','n_saturday') as $find_day) 
				{
					if($this->input->post($find_day)>0)
					{
						if($this->input->post($find_day.'_start')!=1)
						{
							if(empty($this->input->post($find_day.'_start')))
							{
								// array_push($required, $find_day.'_start');
							}
							if(empty($this->input->post($find_day.'_end')))
							{
								// array_push($required, $find_day.'_end');
							}
						}
					}
					else
					{
						$day_count++;
					}
				}
				if($method == '_Edit')
				{
					array_push($required, 'n_id');
				}
				else
				{
					if(empty($_FILES['c_product_image']['name'][0]))
    				{
    					// $error = TRUE;
    				}
				}

			    foreach ($required as $field) 
			    {
			        if(empty($this->input->post($field)))
			        {
			            $error = TRUE;
			        }
			    }

			    // print_r($c_n_is_other);die();
				if($c_n_is_other==null)
				{
					if(empty($c_c_whatsapp) && empty($c_c_line))
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

				if(!empty($c_mobile_numbers[0]) && !array_filter($c_mobile_numbers)) 
				{
					$response['status']  = 0;
			        $response['message'] = "Please enter a value into at least one mobile number"; 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
				}

				if(!empty($c_emailids[0]) && !array_filter($c_emailids)) 
				{
					$response['status']  = 0;
			        $response['message'] = "Please enter a value into at least one email id"; 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
				}

				

			    // if((7-$day_count)<=2)
			    // {
			    // 	$response['status']  = 0;
			    //     $response['message'] = "Please select aleast three working days"; 
			    //     $response['data']    = [];
			    //     echo json_encode($response);
			    //     return; 
			    // }

			    foreach ($c_mobile_numbers as $c_mobile_number) 
			    {
			    	if(!empty($c_mobile_number))
			    	{
			    		if(validateCountryPhone($c_mobile_number,2)) {
				            $response['status']  = 0;
					        $response['message'] = "Mobile No. does not appear to be valid"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
				        }
			    	}
			    }

			    foreach ($c_emailids as $c_emailid) 
			    {
			    	if(!empty($c_emailid))
			    	{
			    		if (mb_strlen($c_emailid) > 254 || !filter_var($c_emailid, FILTER_VALIDATE_EMAIL))
					    {
					        $response['status']  = 0;
					        $response['message'] = "E-mail address does not appear to be valid"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
					    }
			    	}
			    }
			    if(!empty($c_c_contact_number) && validateCountryPhone($c_c_contact_number,2)) {
		            $response['status']  = 0;
			        $response['message'] = "Contact Person Mobile No. does not appear to be valid"; 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
		        }

			    if (!empty($c_c_emailid) && (mb_strlen($c_c_emailid) > 254 || !filter_var($c_c_emailid, FILTER_VALIDATE_EMAIL)))
			    {
			        $response['status']  = 0;
			        $response['message'] = "Contact Person E-mail address does not appear to be valid"; 
			        $response['data']    = [];
			        echo json_encode($response);
			        return; 
			    }

			    if(empty($c_n_is_other) && $c_c_whatsapp)
				{
					if(validateCountryPhone($c_c_whatsapp,2)) {
			            $response['status']  = 0;
				        $response['message'] = "Contact Person WhatsApp No. does not appear to be valid"; 
				        $response['data']    = [];
				        echo json_encode($response);
				        return; 
			        }
				}

				if(empty($c_n_is_other) && $c_c_line)
				{
					if(validateCountryPhone($c_c_line,2)) {
			            $response['status']  = 0;
				        $response['message'] = "Contact Person Line No. does not appear to be valid"; 
				        $response['data']    = [];
				        echo json_encode($response);
				        return; 
			        }
				}

			    if(count($errors)==0)
			    {
			    	if($method == '_Create')
			    	{
						$j_opening_hours = [];
						if(!empty($n_sunday) && $n_sunday>0)
						{
						    if($n_sunday_start==1)
						    {
						        $j_opening_hours['n_sunday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_sunday_start']    = $n_sunday_start;
						        $j_opening_hours['n_sunday_end']    = $n_sunday_end;
						    }
						}
						if(!empty($n_monday) && $n_monday>0)
						{
						    if($n_monday_start==1)
						    {
						        $j_opening_hours['n_monday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_monday_start']    = $n_monday_start;
						        $j_opening_hours['n_monday_end']    = $n_monday_end;
						    }
						}
						if(!empty($n_tuesday) && $n_tuesday>0)
						{
						    if($n_tuesday_start==1)
						    {
						        $j_opening_hours['n_tuesday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_tuesday_start']    = $n_tuesday_start;
						        $j_opening_hours['n_tuesday_end']    = $n_tuesday_end;
						    }
						}
						if(!empty($n_wednesday) && $n_wednesday>0)
						{
						    if($n_wednesday_start==1)
						    {
						        $j_opening_hours['n_wednesday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_wednesday_start']    = $n_wednesday_start;
						        $j_opening_hours['n_wednesday_end']    = $n_wednesday_end;
						    }
						}
						if(!empty($n_thursday) && $n_thursday>0)
						{
						    if($n_thursday_start==1)
						    {
						        $j_opening_hours['n_thursday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_thursday_start']    = $n_thursday_start;
						        $j_opening_hours['n_thursday_end']    = $n_thursday_end;
						    }
						}
						if(!empty($n_friday) && $n_friday>0)
						{
						    if($n_friday_start==1)
						    {
						        $j_opening_hours['n_friday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_friday_start']    = $n_friday_start;
						        $j_opening_hours['n_friday_end']    = $n_friday_end;
						    }
						}
						if(!empty($n_saturday) && $n_saturday>0)
						{
						    if($n_saturday_start==1)
						    {
						        $j_opening_hours['n_saturday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_saturday_start']    = $n_saturday_start;
						        $j_opening_hours['n_saturday_end']    = $n_saturday_end;
						    }
						}

			    		$ins_data = array(
			    			'n_type' => 2,
			    			'n_city' => $n_city,
			    			'n_district' => $n_district,
			    			'n_town' => $n_town,
	    					'n_category' => $n_category,
	    					'n_latitude' => $n_latitude,
	    					'n_longitude' => $n_longitude,
							'c_name' => str_value($c_name,3),
							'c_name_in_thai' => str_value($c_name_in_thai,3),
							'c_mobile_numbers' => !empty($c_mobile_numbers) ? implode(",", $c_mobile_numbers) : '',
							'c_emailids' => !empty($c_emailids) ? implode(",", $c_emailids) : '',
							'c_address' => str_value($c_address,3),
							'c_c_full_name'	=> !empty($c_c_full_name) ? str_value($c_c_full_name,3) : '',
							'c_c_short_name' => !empty($c_c_short_name) ? str_value($c_c_short_name,3) : '',
							'c_c_contact_number' => !empty($c_c_contact_number) ? $c_c_contact_number : '',
							'c_c_emailid' => !empty($c_c_emailid) ? $c_c_emailid : '',
							'c_terms' => str_value($c_terms,3),
							'j_opening_hours' => json_encode($j_opening_hours),
		    				'n_created_by' => $this->session->userdata('n_id'),
		    				'dt_created_on' => date('Y-m-d H:i:s'),
		    			);

			    		if(empty($c_n_is_other) && ($c_c_whatsapp || $c_c_line))
			    		{
			    			$ins_data['c_n_is_other'] = 2;
				    		if(!empty($c_c_whatsapp))
							{
								$ins_data['c_c_whatsapp'] = $c_c_whatsapp;
							}
							if(!empty($c_c_line))
							{
								$ins_data['c_c_line'] = $c_c_line;
							}
			    		}

	    				$insert = $this->vendor_model->insert($ins_data);
	    				if($insert)
					    {
					    	if(!empty($_FILES['c_product_image']['name'][0]))
		    				{
		    					// echo $this->db->last_query();
		    					// die();
		    					$ImageCount = count($_FILES['c_product_image']['name']);

			    				for($i = 0; $i < $ImageCount; $i++)
			    				{
							    	$img_name = $_FILES['c_product_image']['name'][$i];

									$_FILES['file']['name']     = $_FILES['c_product_image']['name'][$i];
						            $_FILES['file']['type']     = $_FILES['c_product_image']['type'][$i];
						            $_FILES['file']['tmp_name'] = $_FILES['c_product_image']['tmp_name'][$i];
						            $_FILES['file']['error']    = $_FILES['c_product_image']['error'][$i];
						            $_FILES['file']['size']     = $_FILES['c_product_image']['size'][$i];

									$img_val   = explode('.', $img_name);
									$img_res   = $img_val[1];
									$file_name = generateRandomString(13).'.'.$img_res;

									$configImg['upload_path']   = 'upload/vendors/';
									// $configImg['max_size']      = '1024000';
									$configImg['allowed_types'] = 'jpg|jpeg|png|gif';
									$configImg['overwrite']     = FALSE;
									$configImg['remove_spaces'] = TRUE;
									// $configImg['max_width']     = 3000;
					    			// $configImg['max_height']    = 3000;
					    			$configImg['file_name']     = $file_name;
									$this->load->library('upload', $configImg);
									$this->upload->initialize($configImg);

									if(!$this->upload->do_upload('file'))
									{
								        $response['status']  = 0;
								        $response['message'] = $this->upload->display_errors();
								        $response['data']    = [];
								        echo json_encode($response);
								        return;
									}
									else
									{
										$img_data = array(
					    					'n_listing_id'    => $insert,
					    					'c_listing_img'   => $file_name,
					    					'n_created_by'    => $this->session->userdata('n_id'),
			    							'dt_created_date' => date('Y-m-d H:i:s'),
					    				);

										$img_insert = $this->vendor_model->listImage_insert($img_data);
									}
			    				}
		    				}
		    				
		        			$response['status']  = 1;
					        $response['message'] = "Vendor added successfully"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
					    }
					    else
					    {
		        			$response['status']  = 0;
					        $response['message'] = "Getting error. Please try again some time"; 
					        $response['data']    = [];
					        echo json_encode($response);
					        return; 
					    }
			    	}
			    	else
			    	{
			    		$j_opening_hours = [];
						if(!empty($n_sunday) && $n_sunday>0)
						{
						    if($n_sunday_start==1)
						    {
						        $j_opening_hours['n_sunday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_sunday_start']    = $n_sunday_start;
						        $j_opening_hours['n_sunday_end']    = $n_sunday_end;
						    }
						}
						if(!empty($n_monday) && $n_monday>0)
						{
						    if($n_monday_start==1)
						    {
						        $j_opening_hours['n_monday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_monday_start']    = $n_monday_start;
						        $j_opening_hours['n_monday_end']    = $n_monday_end;
						    }
						}
						if(!empty($n_tuesday) && $n_tuesday>0)
						{
						    if($n_tuesday_start==1)
						    {
						        $j_opening_hours['n_tuesday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_tuesday_start']    = $n_tuesday_start;
						        $j_opening_hours['n_tuesday_end']    = $n_tuesday_end;
						    }
						}
						if(!empty($n_wednesday) && $n_wednesday>0)
						{
						    if($n_wednesday_start==1)
						    {
						        $j_opening_hours['n_wednesday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_wednesday_start']    = $n_wednesday_start;
						        $j_opening_hours['n_wednesday_end']    = $n_wednesday_end;
						    }
						}
						if(!empty($n_thursday) && $n_thursday>0)
						{
						    if($n_thursday_start==1)
						    {
						        $j_opening_hours['n_thursday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_thursday_start']    = $n_thursday_start;
						        $j_opening_hours['n_thursday_end']    = $n_thursday_end;
						    }
						}
						if(!empty($n_friday) && $n_friday>0)
						{
						    if($n_friday_start==1)
						    {
						        $j_opening_hours['n_friday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_friday_start']    = $n_friday_start;
						        $j_opening_hours['n_friday_end']    = $n_friday_end;
						    }
						}
						if(!empty($n_saturday) && $n_saturday>0)
						{
						    if($n_saturday_start==1)
						    {
						        $j_opening_hours['n_saturday'] = 1;
						    }
						    else
						    {
						        $j_opening_hours['n_saturday_start']    = $n_saturday_start;
						        $j_opening_hours['n_saturday_end']    = $n_saturday_end;
						    }
						}

						$n_status_ = $n_status ? 1 : 2;


			    		$upt_data = array(
			    			'n_city' => $n_city,
			    			'n_district'=> $n_district,
			    			'n_town' => $n_town,
	    					'n_category' => $n_category,
	    					'n_latitude' => $n_latitude,
	    					'n_longitude' => $n_longitude,
							'c_name' => str_value($c_name,3),
							'c_name_in_thai' => str_value($c_name_in_thai,3),
							'c_mobile_numbers' => !empty($c_mobile_numbers) ? implode(",", $c_mobile_numbers) : '',
							'c_emailids' => !empty($c_emailids) ? implode(",", $c_emailids) : '',
							'c_address' => str_value($c_address,3),
							'c_terms' => str_value($c_terms,3),
							'c_c_full_name'	=> !empty($c_c_full_name) ? str_value($c_c_full_name,3):'',
							'c_c_short_name' => !empty($c_c_short_name) ? str_value($c_c_short_name,3) : '',
							'c_c_contact_number' => !empty($c_c_contact_number) ? $c_c_contact_number : '',
							'c_c_emailid' => !empty($c_c_emailid) ? $c_c_emailid : '',
							'j_opening_hours' => json_encode($j_opening_hours),
							'n_status' => $n_status_,
		    				'n_updated_by' => $this->session->userdata('n_id'),
		    				'dt_updated_on' => date('Y-m-d H:i:s'),
		    			);


		    			// print_r($upt_data);die();

			    		if(empty($c_n_is_other) && ($c_c_whatsapp || $c_c_line))
			    		{
			    			$upt_data['c_n_is_other'] = 2;
				    		if(!empty($c_c_whatsapp))
							{
								$upt_data['c_c_whatsapp'] = $c_c_whatsapp;
							}
							if(!empty($c_c_line))
							{
								$upt_data['c_c_line'] = $c_c_line;
							}
			    		}

			    		if(!empty($_FILES['c_product_image']['name'][0]))
	    				{
	    					$ImageCount  = count($_FILES['c_product_image']['name']);

		    				for($i = 0; $i < $ImageCount; $i++)
		    				{
						    	$img_name = $_FILES['c_product_image']['name'][$i];

								$_FILES['file']['name']     = $_FILES['c_product_image']['name'][$i];
					            $_FILES['file']['type']     = $_FILES['c_product_image']['type'][$i];
					            $_FILES['file']['tmp_name'] = $_FILES['c_product_image']['tmp_name'][$i];
					            $_FILES['file']['error']    = $_FILES['c_product_image']['error'][$i];
					            $_FILES['file']['size']     = $_FILES['c_product_image']['size'][$i];

								$img_val   = explode('.', $img_name);
								$img_res   = $img_val[1];
								$file_name = generateRandomString(13).'.'.$img_res;

								$configImg['upload_path']   = 'upload/vendors/';
								$configImg['max_size']      = '1024000';
								$configImg['allowed_types'] = 'jpg|jpeg|png|gif';
								$configImg['overwrite']     = FALSE;
								$configImg['remove_spaces'] = TRUE;
								$configImg['max_width']     = 1000;
				    			$configImg['max_height']    = 1000;
				    			$configImg['file_name']     = $file_name;
								$this->load->library('upload', $configImg);
								$this->upload->initialize($configImg);

								if(!$this->upload->do_upload('file'))
								{
							        $response['status']  = 0;
							        $response['message'] = $this->upload->display_errors();
							        $response['data']    = [];
							        echo json_encode($response);
							        return;
								}
								else
								{
									$img_data = array(
				    					'n_listing_id'    => $n_id,
				    					'c_listing_img'   => $file_name,
				    					'n_updated_by'    => $this->session->userdata('n_id'),
		    							'dt_updated_date' => date('Y-m-d H:i:s'),
				    				);

									$img_insert = $this->vendor_model->listImage_insert($img_data);

								}
		    				}
	    				}

	    				$upt_whr = array('n_id' => $n_id);
	    				if($active_user>1)
	    				{
	    					$upt_whr['n_created_by'] = $active_user;
	    				}
	    				$update = $this->vendor_model->update($upt_data, $upt_whr);

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
        	}

        	if($method == '_cityList')
        	{
        		$n_state = $this->input->post('n_state');

        		$option['order_by']   = 'c_city';
	    		$option['disp_order'] = 'ASC';
        		$state_whr = array('n_state_id' => $n_state, 'n_delete' => 1);
        		$state_col = 'n_id, c_city';
    			$state_res = $this->master_model->getCity($state_whr, '', '', 'result', '', '', $option, '', $state_col);

    			$city_list = '<option value="0">Select Option</option>';
    			if(!empty($state_res))
    			{
    				foreach ($state_res as $key => $val) {
    					$n_id   = empty_check($val->n_id);
            			$c_city = empty_check($val->c_city);

            			$city_list .= '<option value="'.$n_id.'">'.$c_city.'</option>';
    				}
    			}

    			$response['status']  = 1;
		        $response['message'] = 'success'; 
		        $response['data']    = $city_list;
		        echo json_encode($response);
		        return; 
        	}
        	else if($method == 'data_delete')
        	{
        		if(userAccess('vendor_edit') == TRUE)
        		{
        			$p_id = $this->input->post('p_id');
        			$n_id = $this->input->post('n_id');

	        		$error = FALSE;
				    $errors = array();
					$required = array('p_id', 'n_id');
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

				    $cnt_whr = array('n_listing_id' => $p_id, 'n_delete' => 1);
				    if($active_user>1)
				    {
				    	$cnt_whr['n_created_by'] = $active_user;
				    }
			    	$cnt_res = $this->catalogue_model->getPdtImage($cnt_whr, '', '', "result", array(), array(), array(), TRUE, 'COUNT(n_id) AS autoid');
			    	
					$cnt_val = !empty($cnt_res[0]->autoid)?$cnt_res[0]->autoid:0;

					if($cnt_val==1)
					{
						$response['status']  = 0;
				        $response['message'] = "Primary image can not delete."; 
				        $response['data']    = [];
				        $response['records'] = [];
				        echo json_encode($response);
				        return; 
					}
					else
					{
						$del_data = array(
		        			'n_delete'        => '2',
		        			'n_deleted_by'    => $this->session->userdata('n_id'),
					    	'dt_deleted_date' => date('Y-m-d H:i:s'),
		        		);

		        		$del_whr  = array('n_id' => $n_id);
		        		if($active_user>1)
					    {
					    	$del_whr['n_created_by'] = $active_user;
					    }

		    			$del_upt  = $this->catalogue_model->pdtImage_update($del_data, $del_whr);
		    			if($del_upt)
					    {
		        			$response['status']  = 1;
					        $response['message'] = response_msg('delete_success');
					        $response['data']    = [];
					        $response['records'] = [];
					        echo json_encode($response);
					        return;
					    }
					    else
					    {
		        			$response['status']  = 0;
					        $response['message'] = response_msg('delete_failure');
					        $response['data']    = [];
					        $response['records'] = [];
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
        	else if($method == 'data_autocomplete')
        	{
        		// echo 1;
    			$search   = $this->input->post('c_search');

    			$trans_url = 'https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=th&dt=t&q='.rawurlencode($search);
	    		$thai_trans = avul_get_tVal($trans_url);
    			if(!empty($search))
    			{
	        		$option['order_by']   = 'c_name';
	    			$option['disp_order'] = 'ASC';

	    			$like['name'] = $search;
	    			$limit  = 10;
					$offset = 0;
	    			$res_column = 'n_id, c_name';

	    			
	    			$data_list  = $this->vendor_model->searchVendor(array('n_delete' => 1), $limit, $offset, 'result', $like, '', $option, '', $res_column);
	    			if($data_list)
	    			{
	    				$search_data = array();
	    				foreach ($data_list as $value) {
	    					$search_data[] = array("value"=>$value->n_id,"label"=>$value->c_name);
	    				}

		                $response['result']   = $search_data;  
	    			}
    			}
    			$response['status']   = 1;  
                if(!empty($thai_trans))
                {
                	$response['translate']   = $thai_trans;  
                }
                echo json_encode($response);
                return;
        	}
			else
        	{
        		if($param1 == 'Edit')
        		{
        			$data_whr = array('n_id' => $param2, 'n_delete' => 1);
        			$data_col = 'n_id, n_city, n_district, n_town, n_category, n_latitude, n_longitude, c_name, c_name_in_thai, c_mobile_numbers, c_emailids, c_c_full_name, c_c_short_name, c_c_contact_number, c_n_is_other, c_c_whatsapp, c_c_line, c_c_emailid, j_opening_hours, c_address,n_status';
					$edit_data = $this->vendor_model->getVendor($data_whr, '', '', "row", '', array(), array(), TRUE, $data_col);


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
		                    if($edit_data->n_category==$m_id)
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
				                    if($edit_data->n_category==$s_id)
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
				                            if($edit_data->n_category==$c_id)
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

		            $img_where  = array('n_listing_id' => $param2, 'n_delete' => 1);
					$img_column = 'n_id, c_listing_img';
					$img_list   = $this->catalogue_model->getPdtImage($img_where, '', '', 'result', '', '', '', '', $img_column);

					$dis_whr  = array('n_city'=>$edit_data->n_city, 'n_status' => 1, 'n_delete' => 1);
					$dis_col  = 'n_id, c_district';
	        		$dis_opt['order_by']   = 'c_district';
		    		$dis_opt['disp_order'] = 'ASC';
	        		$this->load->model('app_model/districts', NULL, TRUE);
			        $dis_list = $this->districts->getDistrict($dis_whr, '', '', 'result', '', '', $dis_opt, '', $dis_col);
	        		$page['district_val']    = $dis_list;

	        		$town_whr  = array('n_district'=>$edit_data->n_district, 'n_status' => 1, 'n_delete' => 1);
					$town_col  = 'n_id, c_town';
	        		$town_opt['order_by']   = 'c_town';
		    		$town_opt['disp_order'] = 'ASC';
	        		$this->load->model('app_model/towns', NULL, TRUE);
			        $town_list = $this->towns->getTown($town_whr, '', '', 'result', '', '', $town_opt, '', $town_col);
	        		$page['town_val']    = $town_list;


					$page['img_val']       = $img_list;
        			$page['category_val']  = $c_category_str;
        			$page['dataval']       = $edit_data;
					$page['method']        = '_Edit';
					$page['page_title']    = "Edit Public Vendor";
        		}
        		else
        		{
        			$page['dataval']    = '';
					$page['method']     = '_Create';
					$page['page_title'] = "Create Public Vendor";
        		}

        		// districts
        		$common_whr  = array('n_status' => 1, 'n_delete' => 1);
        		$city_col  = 'n_id, c_city';
        		$city_opt['order_by']   = 'c_city';
	    		$city_opt['disp_order'] = 'ASC';

	    		$this->load->model('app_model/cities', NULL, TRUE);
		        $city_list = $this->cities->getCity($common_whr, '', '', 'result', '', '', $city_opt, '', $city_col);
        		$page['city_val']    = $city_list;
        		



        		$timing_str = array("1"=>"24 Hours","2"=>"01:00","3"=>"01:30","4"=>"02:00","5"=>"02:30","6"=>"03:00","7"=>"03:30","8"=>"04:00","9"=>"04:30","10"=>"05:00","11"=>"05:30","12"=>"06:00","13"=>"06:30","14"=>"07:00","15"=>"07:30","16"=>"08:00","17"=>"08:30","18"=>"09:00","19"=>"09:30","20"=>"10:00","21"=>"10:30","22"=>"11:00","23"=>"11:30","24"=>"12:00","25"=>"12:30","26"=>"13:00","27"=>"13:30","28"=>"14:00","29"=>"14:30","30"=>"15:00","31"=>"15:30","32"=>"16:00","33"=>"16:30","34"=>"17:00","35"=>"17:30","36"=>"18:00","37"=>"18:30","38"=>"19:00","39"=>"19:30","40"=>"20:00","41"=>"20:30","42"=>"21:00","43"=>"21:30","44"=>"22:00","45"=>"22:30","46"=>"23:00","47"=>"23:30");
        		$page['category_val'] = $c_category_str;
        		$page['timing_str']   = $timing_str;
        		$page['formpage']     = "BTBM_X_P";
        		$page['directory']    = "app";
		    	$page['cntrl']        = "public-vendor";
		    	$page['func']         = "add";
				$page['main_heading'] = "Vendor";
				$page['pre_title']    = "List vendor";
				$page['pre_menu']     = "app/vendor/manage";
				$data['page_temp']    = $this->load->view('app_view/public_vendor/create',$page,TRUE);
				$data['view_file']    = "app_view/Page_Template";
				$data['title']        = "Create Vendor";
				$data['currentmenu']  = "public-vendor";


				$this->bassthaya->load_map_template($data);
        	}
		}
	}
?>