<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Vendor_model extends CI_Model {

        // Data Table
        public $tbl_listings       = "tbl_listings";
        public $tbl_listings_image = "tbl_listings_image";

        //User Create
        public function insert($data)
        {
            $this->db->insert($this->tbl_listings, $data);      
            return $this->db->insert_id();
        }

        //User Detail
        public function getVendor($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
        {           
            if($column !=''){
                $this->db->select($column);
            }else{
                $this->db->select('*');
            }
            if (is_array($param) && count($param)>0)
            {
                if(!empty($param['A.n_created_by']))
                {
                    $this->db->where_in('A.n_created_by', $param['A.n_created_by'], FALSE);
                }
                else
                {
                    $this->db->where($param);
                }
            }

            if (is_array($where_or) && count($where_or)>0){
                $this->db->or_where($where_or);     
            }
            
            if($limit !=0 && $offset >=0){
               $this->db->limit($limit, $offset);
            }
            if(is_array($like)){
                if(isset($like['name']))
                {
                    $this->db->like('c_name',$like['name']);
                    $this->db->or_like('c_name_in_thai',$like['name']);
                    $this->db->or_like('c_c_contact_number',$like['name']);
                    $this->db->or_like('c_c_whatsapp',$like['name']);
                    $this->db->or_like('c_c_line',$like['name']);
                    $this->db->or_like('c_c_emailid',$like['name']);
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get($this->tbl_listings);
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }

        public function getJoinVendor($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
        {
            $this->db->select($column);             
            $this->db->from('tbl_listings A');
            $this->db->join('tbl_users B','A.n_supervisor = B.n_id','left');
            $this->db->join('tbl_users C','A.n_agent = C.n_id','left');
            $this->db->join('tbl_city D','A.n_city = D.n_id','left');
            $this->db->join('tbl_category E','A.n_category = E.n_id','left');

            if (is_array($param) && count($param)>0){
                $this->db->where($param);       
            }

            if (is_array($where_or) && count($where_or)>0){
                $this->db->or_where($where_or);     
            }
            
            if($limit !=0 && $offset >=0){
               $this->db->limit($limit, $offset);
            }
            if(is_array($like)){
                if(isset($like['name']))
                {
                    $this->db->like('c_name',$like['name']);
                    $this->db->or_like('c_name_in_thai',$like['name']);
                    $this->db->or_like('c_c_contact_number',$like['name']);
                    $this->db->or_like('find_in_set("'.$like['name'].'", c_mobile_numbers)');
                    $this->db->or_like('c_c_whatsapp',$like['name']);
                    $this->db->or_like('c_c_line',$like['name']);
                    $this->db->or_like('c_c_emailid',$like['name']);
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get();
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }
        
        public function getApiVendor($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
        {
            $this->db->select($column);             
            $this->db->from('tbl_listings A');
            $this->db->join('tbl_city B','B.n_id = A.n_city','left');
            $this->db->join('tbl_district C','C.n_id = A.n_district','left');
            $this->db->join('tbl_town D','D.n_id = A.n_town','left');
            $this->db->join('tbl_category E','E.n_id = A.n_category','left');

            if (is_array($param) && count($param)>0){
                $this->db->where($param);       
            }

            if (is_array($where_or) && count($where_or)>0){
                $this->db->or_where($where_or);     
            }
            
            if($limit !=0 && $offset >=0){
               $this->db->limit($limit, $offset);
            }
            if(is_array($like)){
                if(isset($like['name']))
                {
                    $this->db->like('A.c_name',$like['name']);
                    $this->db->or_like('A.c_name_in_thai',$like['name']);
                    $this->db->or_like('A.c_c_contact_number',$like['name']);
                    // $this->db->or_like('find_in_set("'.$like['name'].'", c_mobile_numbers)');
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get();
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }
        public function getJoinEmptyVendor($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
        {
            $this->db->select($column);             
            $this->db->from('tbl_listings A');
            $this->db->join('tbl_users B','A.n_supervisor = B.n_id','left');
            $this->db->join('tbl_users C','A.n_agent = C.n_id','left');

            if (is_array($param) && count($param)>0){
                $this->db->where($param);       
            }

            if (is_array($where_or) && count($where_or)>0){
                $this->db->or_where($where_or);     
            }
            
            if($limit !=0 && $offset >=0){
               $this->db->limit($limit, $offset);
            }
            if(is_array($like)){
                if(isset($like['name']))
                {
                    $this->db->like('c_name',$like['name']);
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get();
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }

        public function searchVendor($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
        {
            if($column !=''){
                $this->db->select($column);
            }else{
                $this->db->select('*');
            }
            if (is_array($param) && count($param)>0){
                $this->db->where($param);       
            }

            if (is_array($where_or) && count($where_or)>0){
                $this->db->or_where($where_or);     
            }
            
            if($limit !=0 && $offset >=0){
               $this->db->limit($limit, $offset);
            }
            if(is_array($like)){
                if(isset($like['name']))
                {
                    $this->db->like('c_name',$like['name']);
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get($this->tbl_listings);
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }

        //User Update
        public function update($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->update($this->tbl_listings, $data);
        }

        //User Delete
        public function delete($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->delete($this->tbl_listings);
        }

        //List Image Create
        public function listImage_insert($data)
        {
            $this->db->insert($this->tbl_listings_image, $data);     
            return $this->db->insert_id();
        }

        //List Image Detail
        public function getListImage($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
        {
            if($column !=''){
                $this->db->select($column);
            }else{
                $this->db->select('*');
            }
            if (is_array($param) && count($param)>0){
                $this->db->where($param);       
            }

            if (is_array($where_or) && count($where_or)>0){
                $this->db->or_where($where_or);     
            }
            
            if($limit !=0 && $offset >=0){
               $this->db->limit($limit, $offset);
            }
            if(is_array($like)){
                if(isset($like['name']))
                {
                    $this->db->like('c_listing_img',$like['name']);
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get($this->tbl_listings_image);
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }

        //List Image Update
        public function listImage_update($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->update($this->tbl_listings_image, $data);
        }

        //List Image Delete
        public function listImage_delete($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->delete($this->tbl_listings_image);
        }
    }
?>