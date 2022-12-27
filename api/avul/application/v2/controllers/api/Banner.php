<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Banner extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('app_model/banner_model');
		}
		public function getBanner($params=''){
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, POST');
			header('Content-Type: application/json; charset=utf-8');
    		if(!empty($params)) {
	    		$like = [];
	    		$option['order_by']   = 'n_id';
    			$option['disp_order'] = 'ASC';
    			$where       = array('n_delete' => 1,'n_status'=>1);
    			if($params>0 && !empty($params))
    			{
    				$where['n_banner_type'] = $params;
    			}
    			$res_column = 'n_id, c_banner, n_banner_type, n_banner_pos, c_banner_image';
    			$data_list  = $this->banner_model->getBanner($where, '', '', 'result', $like, '', $option, '', $res_column);

    			if($data_list)
    			{
	            	$j_data = [];
    	            foreach ($data_list as $key => $val) {
    	            	$n_id            = empty_check($val->n_id);
    	            	$c_banner        = empty_check($val->c_banner);
    	            	$c_banner_image  = empty_check($val->c_banner_image);

			            if(!empty($c_banner_image)) {
					        $img_value = IMG_URL.'banner/'.$c_banner_image;
					    }
					    else{
					        $img_value = BASE_URL.'app-assets/images/img_icon.png';
					    }

					    array_push(
					    	$j_data, 
					    	array("n_id"=>$n_id,"c_banner"=>$c_banner,"c_banner_image"=>$img_value)
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
    		else {
    			$response['n_status']   = 0;  
	            $response['j_result']   = [];  
	            $response['c_message']  = "Pass page value";
	            echo json_encode($response);
	            return;
    		}
		}
	}
?>