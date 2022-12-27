<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Vendor_coupon_model extends CI_Model {

        // Data Table
        public $tbl_vendor_coupons     = "tbl_vendor_coupons";
        public $tbl_vendor_coupon_details     = "tbl_vendor_coupon_details";

        //Coupon Create
        public function insert_coupon($data)
        {
            $this->db->insert($this->tbl_vendor_coupons, $data);      
            return $this->db->insert_id();
        }

        public function insert_coupon_detail($data)
        {
            $this->db->insert($this->tbl_vendor_coupon_details, $data);      
            return $this->db->insert_id();
        }

        public function getCoupon($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get($this->tbl_vendor_coupons);
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }

        //Coupon Detail
        public function getCouponDetail($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get($this->tbl_vendor_coupon_details);
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }

        public function getJoinCoupon($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='',$where_in='')
        {
            // print_r($param);die();
            $this->db->select($column);             
            $this->db->from('tbl_vendor_coupons A');
            $this->db->join('tbl_listings B','B.n_id = A.n_vendor','inner');

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
                    $this->db->like('B.c_name',$like['name']);
                }
            }

            if (is_array($where_in) && count($where_in)>0)
            {
                if(!empty($where_in['A.n_created_by']))
                {
                    $this->db->where_in('A.n_created_by', $where_in['A.n_created_by'], FALSE);
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

        //Coupon Update
        public function update_coupon($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->update($this->tbl_vendor_coupons, $data);
        }
        public function update_coupon_detail($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->update($this->tbl_vendor_coupon_details, $data);
        }

        //Coupon Delete
        public function delete_coupon($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->delete($this->tbl_vendor_coupons);
        }
        public function delete_coupon_detail($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->delete($this->tbl_vendor_coupon_details);
        }
    }
?>