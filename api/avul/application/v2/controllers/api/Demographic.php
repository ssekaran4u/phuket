<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Demographic extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('app_model/demographic_model');
		}
		public function getDemographic(){
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, POST');
			header('Content-Type: application/json; charset=utf-8');

    		$like = [];
    		$option['order_by']   = 'n_sort';
    		$option['disp_order'] = 'ASC';

    		$where       = array('n_delete'=>1,'n_status'=>1);
			$res_column = 'n_id, c_demographic';
			$data_list  = $this->demographic_model->getDemographic($where, '', '', 'result', $like, '', $option, '', $res_column);

			if($data_list)
			{
				$j_data = [];
				$count    = count($data_list);
				$status  = 1;
            	$message = response_msg('success');
            	$table   = '';
	            foreach ($data_list as $key => $val) {
	            	$n_id            = empty_check($val->n_id);
	            	$c_demographic   = empty_check($val->c_demographic);
	            	array_push(
				    	$j_data, 
				    	array("n_id"=>$n_id,"c_demographic"=>$c_demographic)
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
	}
?>