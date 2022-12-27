<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Vendor extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('app_model/login_model');
			$this->load->model('app_model/master_model');
			$this->load->model('app_model/catalogue_model');
			$this->load->model('app_model/vendor_model');
		}

		public function getVendors(){
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, POST');
			header('Content-Type: application/json; charset=utf-8');

    		$_limit   = $this->input->post('n_limit');
    		$_offset   = $this->input->post('n_offset');
    		$_page   = $this->input->post('n_page');
        	$search   = $this->input->post('c_search');

        	$n_category_id = $this->input->post('n_category_id');
        	$n_city_id = $this->input->post('n_city_id');
        	$n_district_id = $this->input->post('n_district_id');
        	$n_town_id = $this->input->post('n_town_id');

        	$cur_page = isset($_page)?$_page:1;
        	$_offset  = ($cur_page-1) * $_limit;
        	$nxt_page = $cur_page + 1;
        	$pre_page = $cur_page - 1;
        	$page_val = $cur_page * $_limit;


			$limit  = !empty($_limit) ? $_limit : 10;
			$offset  = !empty($_offset) ? $_offset : 0;

			if($search !='')
    		{
    			$like['name'] = $search;
    		}
    		else
    		{
    			$like = [];
    		}

    		$option['order_by']   = 'A.n_id';
			$option['disp_order'] = 'DESC';

    		$getvendor = array('A.n_delete' => 1, 'A.n_status' => 1);

    		if(!empty($n_category_id)) {
				$getvendor['A.n_category'] = $n_category_id;
    		}

    		if(!empty($n_city_id)) {
				$getvendor['A.c_city'] = $n_city_id;
    		}

    		if(!empty($n_district_id)) {
				$getvendor['A.c_district'] = $n_district_id;
    		}

    		if(!empty($n_town_id)) {
				$getvendor['A.c_town'] = $n_town_id;
    		}

    		$overall_col = $this->vendor_model->getApiVendor($getvendor, '', '', 'row', $like, '', $option, '', 'COUNT(A.n_id) AS autoid'); 
			$total_count = !empty($overall_col->autoid)?$overall_col->autoid:0;
			// echo $this->db->last_query();die();
			// echo $total_count;die();

			$res_column = ' `A`.`n_id`, `A`.`n_type`, `A`.`c_name`, `A`.`c_c_contact_number`, `A`.`n_city` AS `n_city_id`, `A`.`n_district` AS `n_district_id`, `A`.`n_town` AS `n_town_id`, `A`.`n_category` AS `n_category_id`, `A`.`n_suggest`, `A`.`n_latitude`, `A`.`n_longitude`, `A`.`c_name_in_thai`, `A`.`c_mobile_numbers`, `A`.`c_emailids`, `A`.`c_address`, `A`.`c_terms`, `B`.`c_city` AS `c_city_name`, `C`.`c_district` AS `c_district_name`, `D`.`c_town` AS `c_town_name`, `E`.`c_category` AS `c_category_name`,`A`.`n_dormant`';

    		$suggest = array("1"=>"Direct vendor","2"=>"Direct customer");
			$data_list  = $this->vendor_model->getApiVendor($getvendor, $limit, $offset, 'result', $like, '', $option, '', $res_column);
			// echo $this->db->last_query();die();
			$j_data = [];
			if($data_list)
			{
				$count    = count($data_list);
            	$tot_page = ceil($total_count / $limit); 


				$status  = 1;
            	$message = response_msg('success_message');
            	$table   = '';
            	$i=1;
	            foreach ($data_list as $key => $val) {
	            	$img_get = $this->vendor_model->getListImage(array("n_listing_id"=>$val->n_id, "n_status"=>1,"n_delete"=>1), '', '', 'result', [], '', '', '', 'c_listing_img');
	            	$img_arr = [];
	            	if(!empty($img_get)) {
	            		foreach ($img_get as $imgValue) {
	            			array_push($img_arr,array("c_listing_img"=>IMG_URL.'vendors/'.$imgValue->c_listing_img));
	            		}
	            	}
	            	array_push(
				    	$j_data, 
				    	array("n_id"=>$val->n_id,
				    		"n_latitude" =>$val->n_latitude,
				    		"n_longitude" =>$val->n_longitude,
				    		"c_place_type"=>($val->n_type==1? 'Paid places' : 'Public places'),
				    		"c_since_type"=>$suggest[$val->n_suggest],
				    		"n_city_id"=>!empty($val->c_city) ? $val->c_city : '',
				    		"c_city"=>!empty($val->c_city) ? $val->c_city : '',
				    		"n_district_id"=>!empty($val->n_district_id) ? $val->n_district_id : '',
				    		"c_district"=>!empty($val->c_district) ? $val->c_district : '',
				    		"n_town_id"=>!empty($val->n_town_id) ? $val->n_town_id : '',
				    		"c_town"=>!empty($val->c_town) ? $val->c_town : '',
				    		"n_category_id"=>!empty($val->n_category_id) ? $val->n_category_id: '',
				    		"c_category"=>!empty($val->c_category_name) ? $val->c_category_name : '',
				    		"c_name"=>!empty($val->c_name) ? $val->c_name : '',
				    		"c_name_in_thai"=>!empty($val->c_name_in_thai) ? $val->c_name_in_thai : '',
				    		"c_mobile_numbers"=>!empty($val->c_mobile_numbers) ? $val->c_mobile_numbers : '',
				    		"c_emailids"=>!empty($val->c_emailids) ? $val->c_emailids : '',
				    		"c_address"=>!empty($val->c_address) ? $val->c_address : '',
				    		"c_terms"=>!empty($val->c_terms) ? $val->c_terms : '',
				    		"n_dormant"=>!empty($val->n_dormant) ? $val->n_dormant : '2',
				    		"j_images"=> $img_arr
				    	)
				    );
	            	$i++;
	            }

	            $response['n_status']  = 1;  
	            $response['n_next_page']  = ($tot_page==$_page) ? 0 : (int)$nxt_page;
	            $response['n_pre_page']  = $pre_page;  
	            $response['n_total_records']  = (int)$total_count;  
	            $response['n_total_page']  = (int)$tot_page;  
	            $response['j_result']   = $j_data;  
	            $response['c_message']  = $message;
	            echo json_encode($response);
	            return;
			}
			else
        	{
        		$response['n_status']  = 0;  
	            $response['n_next_page']  = 0;  
	            $response['n_pre_page']  = 0;
				$response['n_total_records'] = 0;
				$response['n_total_page'] = 0;
	            $response['j_result']   = [];  
	            $response['c_message']  = "Record not found";

	            echo json_encode($response);
	            return;
        	}
		}
		public function getVendor($params){
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET');
			header('Content-Type: application/json; charset=utf-8');

    		if(!empty($params)) {
		    	$getvendor = array('A.n_delete' => 1, 'A.n_status' => 1, 'A.n_id'=>$params);
		    	$res_column = ' `A`.`n_id`, `A`.`n_type`, `A`.`c_name`, `A`.`c_c_contact_number`, `A`.`n_city` AS `n_city_id`, `A`.`n_district` AS `n_district_id`, `A`.`n_town` AS `n_town_id`, `A`.`n_category` AS `n_category_id`, `A`.`n_suggest`, `A`.`n_latitude`, `A`.`n_longitude`, `A`.`c_name_in_thai`, `A`.`c_mobile_numbers`, `A`.`c_emailids`, `A`.`c_address`, `A`.`c_terms`, `B`.`c_city` AS `c_city_name`, `C`.`c_district` AS `c_district_name`, `D`.`c_town` AS `c_town_name`, `E`.`c_category` AS `c_category_name`,`A`.`n_dormant`';
	    		$data_list = $this->vendor_model->getApiVendor($getvendor, '', '', 'row', '', '', '', '', $res_column); 
	    		// echo $this->db->last_query();die();
	    		// echo $params;die();
	    		if(!empty($data_list)) {
	    			$img_get = $this->vendor_model->getListImage(array("n_listing_id"=>$data_list->n_id, "n_status"=>1,"n_delete"=>1), '', '', 'result', [], '', '', '', 'c_listing_img');
	            	$img_arr = [];
	            	if(!empty($img_get)) {
	            		foreach ($img_get as $imgValue) {
	            			array_push($img_arr,array("c_listing_img"=>IMG_URL.'vendors/'.$imgValue->c_listing_img));
	            		}
	            	}
	            	$suggest = array("1"=>"Direct vendor","2"=>"Direct customer");
	    			$res_data = array("n_id"=>$data_list->n_id,
				    		"n_latitude" =>$data_list->n_latitude,
				    		"n_longitude" =>$data_list->n_longitude,
				    		"c_place_type"=>($data_list->n_type==1? 'Paid places' : 'Public places'),
				    		"c_since_type"=>$suggest[$data_list->n_suggest],

				    		"n_city_id"=>!empty($data_list->c_city) ? $data_list->c_city : '',
				    		"c_city"=>!empty($data_list->c_city) ? $data_list->c_city : '',

				    		"n_district_id"=>!empty($data_list->n_district_id) ? $data_list->n_district_id : '',
				    		"c_district"=>!empty($data_list->c_district) ? $data_list->c_district : '',

				    		"n_town_id"=>!empty($data_list->n_town_id) ? $data_list->n_town_id : '',
				    		"c_town"=>!empty($data_list->c_town) ? $data_list->c_town : '',

				    		"n_category_id"=>!empty($data_list->n_category_id) ? $data_list->n_category_id: '',
				    		"c_category"=>!empty($data_list->c_category_name) ? $data_list->c_category_name : '',

				    		"c_name"=>!empty($data_list->c_name) ? $data_list->c_name : '',
				    		"c_name_in_thai"=>!empty($data_list->c_name_in_thai) ? $data_list->c_name_in_thai : '',
				    		"c_mobile_numbers"=>!empty($data_list->c_mobile_numbers) ? $data_list->c_mobile_numbers : '',
				    		"c_emailids"=>!empty($data_list->c_emailids) ? $data_list->c_emailids : '',
				    		"c_address"=>!empty($data_list->c_address) ? $data_list->c_address : '',
				    		"c_terms"=>!empty($data_list->c_terms) ? $data_list->c_terms : '',
				    		"n_dormant"=>!empty($val->n_dormant) ? $val->n_dormant : '2',
				    		"j_images"=> $img_arr);

	    			$response['n_status']  = 1;  
		            $response['j_result']   = $res_data;  
		            $response['c_message']  = "Succcess";
		            echo json_encode($response);
		            return;

	    		} else {
	    			$response['n_status']  = 0;  
		            $response['j_result']   = [];  
		            $response['c_message']  = "Record not found";

		            echo json_encode($response);
		            return;
	    		}

    		}   
    		else {
    			$response['n_status']  = 0;  
	            $response['j_result']   = [];  
	            $response['c_message']  = "Vendor Id does not exist";
	            echo json_encode($response);
	            return;
    		}
		}		
	}
?>