<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class User_model extends CI_Model {

        // Data Table
        public $tbl_users     = "tbl_users";

        

        //User Create
        public function insert($data)
        {
            $this->db->insert($this->tbl_users, $data);      
            return $this->db->insert_id();
        }

        //User Detail
        public function getUser($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
                    $this->db->like('c_full_name',$like['name']);
                    $this->db->or_like('c_short_name',$like['name']);
                    $this->db->or_like('c_emailid',$like['name']);
                    $this->db->or_like('c_contact_number',$like['name']);
                    $this->db->or_like('c_line_or_whatsapp',$like['name']);
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get($this->tbl_users);
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }

        public function getJoinUser($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
        {
            $this->db->select($column);             
            $this->db->from('tbl_users A');
            $this->db->join('tbl_user_role B','B.n_id = A.n_role','inner');

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
                    $this->db->like('c_full_name',$like['name']);
                    $this->db->or_like('c_short_name',$like['name']);
                    $this->db->or_like('c_emailid',$like['name']);
                    $this->db->or_like('c_contact_number',$like['name']);
                    $this->db->or_like('c_line_or_whatsapp',$like['name']);
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

        //User Update
        public function update($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->update($this->tbl_users, $data);
        }

        //User Delete
        public function delete($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->delete($this->tbl_users);
        }
    }
?>