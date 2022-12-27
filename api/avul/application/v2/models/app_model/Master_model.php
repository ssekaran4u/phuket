<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Master_model extends CI_Model {

		// Data Table
		public $tbl_state          = "tbl_state";
		public $tbl_city           = "tbl_city";
		public $tbl_amenities      = "tbl_amenities";
		public $tbl_inclusions     = "tbl_inclusions";
		public $tbl_image_category = "tbl_image_category";
		public $tbl_property_type  = "tbl_property_type";
		public $tbl_room_type      = "tbl_room_type";

		//State Create
		public function state_insert($data)
		{
			$this->db->insert($this->tbl_state, $data);		
			return $this->db->insert_id();
		}

		//State Detail
		public function getState($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
					$this->db->like('c_state',$like['name']);
					$this->db->or_like('c_state_code',$like['name']);
				}
			}
			if(is_array($orderby) && count($orderby) > 0){
				
				 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
				 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
				$this->db->order_by($order_by, $disp_order); 
			}	
			$result = $this->db->get($this->tbl_state);
			
			if ($result != FALSE && $result->num_rows()>0){

				$result =  $result->$option();
				
				$aResponse = $result;
				return $aResponse;
			}
			return FALSE;
		}

		//State Update
		public function state_update($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
	        return $this->db->update($this->tbl_state, $data);
	    }

	    //State Delete
		public function state_delete($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
      		return $this->db->delete($this->tbl_state);
	    }

	    //City Create
		public function city_insert($data)
		{
			$this->db->insert($this->tbl_city, $data);		
			return $this->db->insert_id();
		}

		//City Detail
		public function getCity($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
					$this->db->like('c_city',$like['name']);
				}
			}
			if(is_array($orderby) && count($orderby) > 0){
				
				 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
				 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
				$this->db->order_by($order_by, $disp_order); 
			}	
			$result = $this->db->get($this->tbl_city);
			
			if ($result != FALSE && $result->num_rows()>0){

				$result =  $result->$option();
				
				$aResponse = $result;
				return $aResponse;
			}
			return FALSE;
		}

		//City Join Detail
		public function getCityJoin($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
		{			
					
			$this->db->select($column);  
			$this->db->from('tbl_city A');
			$this->db->join('tbl_state B', 'B.n_id = A.n_state_id');

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
					$this->db->like('A.c_city',$like['name']);
					$this->db->or_like('B.c_state',$like['name']);
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

		//City Update
		public function city_update($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
	        return $this->db->update($this->tbl_city, $data);
	    }

	    //City Delete
		public function city_delete($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
	  		return $this->db->delete($this->tbl_city);
	    }

	    //Amenities Create
		public function amenities_insert($data)
		{
			$this->db->insert($this->tbl_amenities, $data);		
			return $this->db->insert_id();
		}

		//Amenities Detail
		public function getAmenities($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
					$this->db->like('c_amenities',$like['name']);
				}
			}
			if(is_array($orderby) && count($orderby) > 0){
				
				 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
				 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
				$this->db->order_by($order_by, $disp_order); 
			}	
			$result = $this->db->get($this->tbl_amenities);
			
			if ($result != FALSE && $result->num_rows()>0){

				$result =  $result->$option();
				
				$aResponse = $result;
				return $aResponse;
			}
			return FALSE;
		}

		//Amenities Update
		public function amenities_update($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
	        return $this->db->update($this->tbl_amenities, $data);
	    }

	    //Amenities Delete
		public function amenities_delete($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
      		return $this->db->delete($this->tbl_amenities);
	    }

	    //Inclusions Create
		public function inclusions_insert($data)
		{
			$this->db->insert($this->tbl_inclusions, $data);		
			return $this->db->insert_id();
		}

		//Inclusions Detail
		public function getInclusions($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
					$this->db->like('c_inclusions',$like['name']);
				}
			}
			if(is_array($orderby) && count($orderby) > 0){
				
				 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
				 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
				$this->db->order_by($order_by, $disp_order); 
			}	
			$result = $this->db->get($this->tbl_inclusions);
			
			if ($result != FALSE && $result->num_rows()>0){

				$result =  $result->$option();
				
				$aResponse = $result;
				return $aResponse;
			}
			return FALSE;
		}

		//Inclusions Update
		public function inclusions_update($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
	        return $this->db->update($this->tbl_inclusions, $data);
	    }

	    //Inclusions Delete
		public function inclusions_delete($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
      		return $this->db->delete($this->tbl_inclusions);
	    }

	    //Image Category Create
		public function imageCategory_insert($data)
		{
			$this->db->insert($this->tbl_image_category, $data);		
			return $this->db->insert_id();
		}

		//Image Category Detail
		public function getImageCategory($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
					$this->db->like('c_image_category',$like['name']);
				}
			}
			if(is_array($orderby) && count($orderby) > 0){
				
				 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
				 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
				$this->db->order_by($order_by, $disp_order); 
			}	
			$result = $this->db->get($this->tbl_image_category);
			
			if ($result != FALSE && $result->num_rows()>0){

				$result =  $result->$option();
				
				$aResponse = $result;
				return $aResponse;
			}
			return FALSE;
		}

		//Image Category Update
		public function imageCategory_update($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
	        return $this->db->update($this->tbl_image_category, $data);
	    }

	    //Image Category Delete
		public function imageCategory_delete($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
      		return $this->db->delete($this->tbl_image_category);
	    }

	    //Property Type Create
		public function propertyType_insert($data)
		{
			$this->db->insert($this->tbl_property_type, $data);		
			return $this->db->insert_id();
		}

		//Property Type Detail
		public function getPropertyType($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
					$this->db->like('c_property_type',$like['name']);
				}
			}
			if(is_array($orderby) && count($orderby) > 0){
				
				 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
				 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
				$this->db->order_by($order_by, $disp_order); 
			}	
			$result = $this->db->get($this->tbl_property_type);
			
			if ($result != FALSE && $result->num_rows()>0){

				$result =  $result->$option();
				
				$aResponse = $result;
				return $aResponse;
			}
			return FALSE;
		}

		//Property Type Update
		public function propertyType_update($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
	        return $this->db->update($this->tbl_property_type, $data);
	    }

	    //Property Type Delete
		public function propertyType_delete($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
      		return $this->db->delete($this->tbl_property_type);
	    }

	    //Room Type Create
		public function roomType_insert($data)
		{
			$this->db->insert($this->tbl_room_type, $data);		
			return $this->db->insert_id();
		}

		//Room Type Detail
		public function getRoomType($param=array(),$limit=0,$offset=0,$option="result",$like=array(),$where_or =array(),$orderby = array(),$other =TRUE,$column='')
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
					$this->db->like('c_room_type',$like['name']);
				}
			}
			if(is_array($orderby) && count($orderby) > 0){
				
				 $order_by = isset($orderby['order_by']) ? $orderby['order_by'] : FALSE;
				 $disp_order = isset($orderby['disp_order']) ? $orderby['disp_order'] : FALSE;
				$this->db->order_by($order_by, $disp_order); 
			}	
			$result = $this->db->get($this->tbl_room_type);
			
			if ($result != FALSE && $result->num_rows()>0){

				$result =  $result->$option();
				
				$aResponse = $result;
				return $aResponse;
			}
			return FALSE;
		}

		//Room Type Update
		public function roomType_update($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
	        return $this->db->update($this->tbl_room_type, $data);
	    }

	    //Room Type Delete
		public function roomType_delete($data, $where = array())
	    {
	        if (count($where) > 0)
	        $this->db->where($where);
      		return $this->db->delete($this->tbl_room_type);
	    }
	}
?>