<?php
	class M_supplier extends CI_Model{
		
		function __construct() 
		{
        	parent::__construct();
        	
    	}

    	function selectSupplierData($dataSrch){
        	$this->db->select('sup_id, sup_nm, sup_nm_kh, sup_phone, sup_email, sup_addr, sup_des, regDt, upDt, useYn, com_id');
        	//$this->db->from('tbl_supplier');
        	$this->db->where('com_id', $_SESSION['comId']);
        	$this->db->where('useYn', 'Y');
        	
        	if($dataSrch['sup_id'] != null && $dataSrch['sup_id'] != ""){
        	    $this->db->where('tbl_supplier.sup_id', $dataSrch['sup_id']);
        	}
        	
        	if($dataSrch['sup_nm'] != null && $dataSrch['sup_nm'] != ""){
        	    $this->db->like('tbl_supplier.sup_nm', $dataSrch['sup_nm']);
        	}
            
        	if($dataSrch['sup_nm_kh'] != null && $dataSrch['sup_nm_kh'] != ""){
        	    $this->db->like('tbl_supplier.sup_nm_kh', $dataSrch['sup_nm_kh']);
        	}
        	
        	$this->db->order_by("com_id", "sup_des");
        	return $this->db->get('tbl_supplier',$dataSrch['limit'],$dataSrch['offset'])->result();
		}

		public function countSupplierData($dataSrch){
		    $this->db->select('count(sup_des) as total_rec');
		    $this->db->from('tbl_supplier');
		    $this->db->where('com_id', $_SESSION['comId']);
		    $this->db->where('useYn', 'Y');
		    
		    if($dataSrch['sup_nm'] != null && $dataSrch['sup_nm'] != ""){
		        $this->db->like('tbl_supplier.sup_nm', $dataSrch['sup_nm']);
		    }
		    
		    if($dataSrch['sup_nm_kh'] != null && $dataSrch['sup_nm_kh'] != ""){
		        $this->db->like('tbl_supplier.sup_nm_kh', $dataSrch['sup_nm_kh']);
		    }
		    
		    return $this->db->get()->result();
		}
		
		public function updateSupplierDB($data){
		    $this->db->where('sup_id', $data['sup_id']);
			$this->db->update('tbl_supplier', $data);
		}
		
		public function insertSupplierDB($data){
			$this->db->insert('tbl_supplier',$data);
			return $this->db->insert_id();
		}
		

    }