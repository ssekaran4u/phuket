<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pages extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('app_model/pages_model');
		}

		public function getPages(){
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, POST');
			header('Content-Type: application/json; charset=utf-8');
    		$like = [];
    		$where       = array('n_delete' => '1','n_status' => '1');
			$option['order_by']   = 'n_sort';
			$option['disp_order'] = 'ASC';
			$res_column = 'c_pages,c_short_code,n_page_type,c_description,c_page_random';
			$data_list  = $this->pages_model->getPages($where, '', '', 'result', $like, '', $option, '', $res_column);
			// print_r($data_list);die();
			// echo $this->db->last_query();die();
			if($data_list)
			{            	
            	$j_data = [];
	            foreach ($data_list as $key => $val) {

	            	$c_page_random  = empty_check($val->c_page_random);
	            	$c_description  = empty_check($val->c_description);
	            	$c_pages       	= empty_check($val->c_pages);
	            	$n_page_type    = empty_check($val->n_page_type);
				    array_push(
				    	$j_data, 
				    	array("n_page_id"=>$c_page_random,"c_pages"=>$c_pages,"n_page_type"=>$n_page_type,"c_description"=>($n_page_type==1) ? $c_description : "","c_page_link"=>($n_page_type==2) ? $c_description : "")
				    );
	            }

	        	$response['n_status']   = 1;  
	            $response['j_result']   = $j_data;  
	            $response['c_message']  = "Success";
	            echo json_encode($response);
	            return;     	
			}
			else
        	{
        		$response['n_status']   = 0;  
	            $response['j_result']   = [];  
	            $response['c_message']  = "No records";
	            echo json_encode($response);
	            return;
        	}
		}

		public function getPage($params){
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, POST');
			header('Content-Type: application/json; charset=utf-8');
			if(!empty($params)) 
			{
	    		$like = [];
	    		$where       = array('n_delete' => '1','n_status' => '1','c_page_random'=>$params);
				$option['order_by']   = 'n_sort';
				$option['disp_order'] = 'ASC';
				$res_column = 'c_pages,c_short_code,n_page_type,c_description,c_page_random';
				$data_list  = $this->pages_model->getPages($where, '', '', 'row', $like, '', $option, '', $res_column);
				// print_r($data_list);die();
				// echo $this->db->last_query();die();
				if($data_list)
				{            	
	            	$j_data = [];
	            	$c_page_random  = empty_check($data_list->c_page_random);
	            	$c_description  = empty_check($data_list->c_description);
	            	$c_pages       	= empty_check($data_list->c_pages);
	            	$n_page_type    = empty_check($data_list->n_page_type);
				    array_push(
				    	$j_data, 
				    	array("n_page_id"=>$c_page_random,"c_pages"=>$c_pages,"n_page_type"=>$n_page_type,"c_description"=>($n_page_type==1) ? $c_description : "","c_page_link"=>($n_page_type==2) ? $c_description : "")
				    );

		        	$response['n_status']   = 1;  
		            $response['j_result']   = $j_data;  
		            $response['c_message']  = "Success";
		            echo json_encode($response);
		            return;     	
				}
				else
	        	{
	        		$response['n_status']   = 0;  
		            $response['j_result']   = [];  
		            $response['c_message']  = "No records";
		            echo json_encode($response);
		            return;
	        	}
	        }
    		else {
    			$response['n_status']  = 0;  
	            $response['j_result']   = [];  
	            $response['c_message']  = "Page Id does not exist";
	            echo json_encode($response);
	            return;
    		}
		}
	}
?>