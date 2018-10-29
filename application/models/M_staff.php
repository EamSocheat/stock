<?php
	class M_staff extends CI_Model{
		
		function __construct() 
		{
        	parent::__construct();
        	
    	}

    	function selectStaff($dataSrch){
  
        	$this->db->select('*');
        	//$this->db->from('tbl_staff');
        	$this->db->join('tbl_branch','tbl_branch.bra_id = tbl_staff.bra_id');
        	$this->db->where('tbl_staff.com_id', $_SESSION['comId']);
        	$this->db->where('tbl_staff.useYn', 'Y');
        	$this->db->order_by("sta_id", "desc");
        	return $this->db->get('tbl_staff',$dataSrch['limit'],$dataSrch['offset'])->result();
		}
		
		function countStaff($dataSrch){
  
        	$this->db->select('count(sta_id) as total_rec');
        	$this->db->from('tbl_staff');
        	$this->db->join('tbl_branch','tbl_branch.bra_id = tbl_staff.bra_id');
        	$this->db->where('tbl_staff.com_id', $_SESSION['comId']);
        	$this->db->where('tbl_staff.useYn', 'Y');
        	$this->db->order_by("sta_id", "desc");
        	return $this->db->get()->result();
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