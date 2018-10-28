<?php
	class M_staff extends CI_Model{
		
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

		public function update($data){
			$this->db->where('com_id', $data["com_id"]);
			$this->db->where('sta_id', $data["sta_id"]);
			$this->db->update('tbl_staff', $data);
		}
		
		public function insert($data){
			$this->db->insert('tbl_staff',$data);
			return $this->db->insert_id();
		}
		

    }