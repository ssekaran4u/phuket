<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Category extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('app_model/category_model');
		}
		public function getCategory(){
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, POST');
			header('Content-Type: application/json; charset=utf-8');
        	$n_parent = $this->input->post('n_parent');

    		$like = [];
    		$where       = array('A.n_delete' => '1','A.n_status' => '1');
    		if(empty($n_parent))
    		{
    			$where['A.n_parent_id'] = 0;	
    		}
    		else {
    			if($n_parent>0) {
    				$where['A.n_parent_id'] = $n_parent;
    			}
    		}

			$option['order_by']   = 'A.n_sort';
			$option['disp_order'] = 'ASC';
			$res_column = 'A.n_id, A.c_category, B.c_category AS p_category, A.n_sort, A.c_category_image, A.n_status, A.dt_created_date,A.n_id';
			$data_list  = $this->category_model->getJoinCategory($where, '', '', 'result', $like, '', $option, '', $res_column);

			// echo $this->db->last_query();die();

			if($data_list)
			{            	
            	$j_data = [];
	            foreach ($data_list as $key => $val) {

	            	$n_id  = empty_check($val->n_id);
	            	$c_category       	= empty_check($val->c_category);
	            	$p_category       	= empty_check($val->p_category);
	            	$c_category_image 	= empty_check($val->c_category_image);

		            if(!empty($c_category_image))
				    {
				        $img_value = IMG_URL.'category/'.$c_category_image;
				    }
				    else
				    {
				        $img_value = BASE_URL.'app-assets/images/img_icon.png';
				    }

				    array_push(
				    	$j_data, 
				    	array("n_id"=>$n_id,"c_category"=>$c_category,"p_category"=>$p_category,"c_category_image"=>$img_value)
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