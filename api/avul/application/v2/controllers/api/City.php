<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class City extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('app_model/cities');
		}
		public function getCity(){
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET');
			header('Content-Type: application/json; charset=utf-8');

    		$like = [];
    		$where       = array('n_delete' => 1, 'n_status' => 1);
			$option['order_by']   = 'n_sort';
			$option['disp_order'] = 'ASC';
			$res_column = 'n_id, c_city';
			$data_list  = $this->cities->getCity($where, '', '', 'result', $like, '', $option, '', $res_column);
			// echo $this->db->last_query();die();
			if($data_list)
			{
	            $response['n_status']   = 1;  
	            $response['j_result']   = $data_list;  
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
	}
?>