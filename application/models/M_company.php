<?php
	class M_company extends CI_Model{
		
		function __construct() 
		{
        	parent::__construct();
        	
    	}

    	function select(){
  
        	$this->db->select('*');
        	$this->db->from('tbl_company');
        	$this->db->order_by("com_id", "desc");
        	return $this->db->get()->result();;
		}

		public function update($id,$data){
			$this->db->where('com_id', $id);
			$this->db->update('tbl_company', $data);
		}
		
		public function insert($data){
			$this->db->insert('tbl_company',$data);
			return $this->db->insert_id();
		}
		

    }