<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Role_model extends CI_Model {

        // Data Table
        public $tbl_user_role = "tbl_user_role";

        //Role Create
        public function insert($data)
        {
            $this->db->insert($this->tbl_user_role, $data);     
            return $this->db->insert_id();
        }

        //Role Detail
        public function getRole($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
                    $this->db->like('c_role_title',$like['name']);
                }
            }
            if(is_array($orderby) && count($orderby) > 0){
                
                 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
                 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
                $this->db->order_by($order_by, $disp_order); 
            }   
            $result = $this->db->get($this->tbl_user_role);
            
            if ($result != FALSE && $result->num_rows()>0){

                $result =  $result->$option();
                
                $aResponse = $result;
                return $aResponse;
            }
            return FALSE;
        }

        //Role Update
        public function update($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->update($this->tbl_user_role, $data);
        }

        //Role Delete
        public function delete($data, $where = array())
        {
            if (count($where) > 0)
            $this->db->where($where);
            return $this->db->delete($this->tbl_user_role);
        }
    }
?>