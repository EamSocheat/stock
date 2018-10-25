<?php
	class M_branch extends CI_Model{
		
		function __construct() 
		{
        	parent::__construct();
        	
    	}

    	function selectBrandType(){
        	$this->db->select('*');
        	$this->db->from('tbl_branch_type');
        	//$this->db->where('com_id', $_SESSION['comId']);
        	return $this->db->get()->result();
		}
		
		function selectBrand($dataSrch){
        	$this->db->select('bra_id, tbl_branch.bra_nm, tbl_branch.bra_nm_kh, bra_phone1, bra_phone2, bra_email, bra_addr, tbl_branch.bra_des, tbl_branch_type.bra_nm_kh as bra_type_nm_kh, tbl_branch_type.bra_nm as bra_type_nm,tbl_branch_type.bra_type_id');
        	//$this->db->from('tbl_branch');
        	$this->db->join('tbl_branch_type','tbl_branch_type.bra_type_id = tbl_branch.bra_type_id');
        	$this->db->where('tbl_branch.com_id', $_SESSION['comId']);
        	$this->db->where('tbl_branch.useYn', 'Y');
        	//
        	if($dataSrch['bra_id'] != null && $dataSrch['bra_id'] != ""){
        	    $this->db->where('tbl_branch.bra_id', $dataSrch['bra_id']);
        	}
        	//
        	if($dataSrch['bra_nm'] != null && $dataSrch['bra_nm'] != ""){
        	    $this->db->like('tbl_branch.bra_nm', $dataSrch['bra_nm']);
        	}
        	//
        	if($dataSrch['bra_nm_kh'] != null && $dataSrch['bra_nm_kh'] != ""){
        	    $this->db->like('tbl_branch.bra_nm_kh', $dataSrch['bra_nm_kh']);
        	}
        	//
        	if($dataSrch['bra_phone1'] != null && $dataSrch['bra_phone1'] != ""){
        	    $this->db->like('tbl_branch.bra_phone1', $dataSrch['bra_phone1']);
        	}
        	//
        	if($dataSrch['bra_type_id'] != null && $dataSrch['bra_type_id'] != ""){
        	    $this->db->where('tbl_branch_type.bra_type_id', $dataSrch['bra_type_id']);
        	}
        	
        	//
        	if($dataSrch['srch_all'] != null && $dataSrch['srch_all'] != ""){
        		$this->db->like('tbl_branch.bra_nm', $dataSrch['srch_all']);
        	    $this->db->or_like('tbl_branch.bra_nm_kh', $dataSrch['srch_all']);
        	    $this->db->or_like('tbl_branch_type.bra_nm', $dataSrch['srch_all']);
        	    $this->db->or_like('tbl_branch_type.bra_nm_kh', $dataSrch['srch_all']);
        	}
        	
        	$this->db->order_by("bra_id", "desc");
        	return $this->db->get('tbl_branch',$dataSrch['limit'],$dataSrch['offset'])->result();
		}
		
		function countBrand($dataSrch){
        	$this->db->select('count(bra_id) as total_rec');
        	$this->db->from('tbl_branch');
        	$this->db->join('tbl_branch_type','tbl_branch_type.bra_type_id = tbl_branch.bra_type_id');
        	$this->db->where('tbl_branch.com_id', $_SESSION['comId']);
        	$this->db->where('tbl_branch.useYn', 'Y');
        	//
        	if($dataSrch['bra_nm'] != null && $dataSrch['bra_nm'] != ""){
        	    $this->db->like('tbl_branch.bra_nm', $dataSrch['bra_nm']);
        	}
        	//
        	if($dataSrch['bra_nm_kh'] != null && $dataSrch['bra_nm_kh'] != ""){
        	    $this->db->like('tbl_branch.bra_nm_kh', $dataSrch['bra_nm_kh']);
        	}
        	//
        	if($dataSrch['bra_phone1'] != null && $dataSrch['bra_phone1'] != ""){
        	    $this->db->like('tbl_branch.bra_phone1', $dataSrch['bra_phone1']);
        	}
        	//
        	if($dataSrch['bra_type_id'] != null && $dataSrch['bra_type_id'] != ""){
        	    $this->db->where('tbl_branch_type.bra_type_id', $dataSrch['bra_type_id']);
        	}
        	
        	return $this->db->get()->result();
		}

		public function update($data){
			$this->db->where('com_id', $_SESSION['comId']);
			$this->db->where('bra_id', $data['bra_id']);
			
			$this->db->update('tbl_branch', $data);
		}
		
		public function insert($data){
			$this->db->insert('tbl_branch',$data);
			return $this->db->insert_id();
		}
		

    }