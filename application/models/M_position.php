<?php
	class M_position extends CI_Model{
		
		function __construct() 
		{
        	parent::__construct();
        	
    	}

    	function selectPositionData($dataSrch){
        	$this->db->select('pos_id, pos_nm, pos_nm_kh, pos_des, regDt, upDt, useYn, com_id');
        	//$this->db->from('tbl_position');
        	$this->db->where('com_id', $_SESSION['comId']);
        	$this->db->where('useYn', 'Y');
        	
        	if($dataSrch['pos_id'] != null && $dataSrch['pos_id'] != ""){
        	    $this->db->where('tbl_position.pos_id', $dataSrch['pos_id']);
        	}
        	
        	if($dataSrch['pos_nm'] != null && $dataSrch['pos_nm'] != ""){
        	    $this->db->like('tbl_position.pos_nm', $dataSrch['pos_nm']);
        	}
            
        	if($dataSrch['pos_nm_kh'] != null && $dataSrch['pos_nm_kh'] != ""){
        	    $this->db->like('tbl_position.pos_nm_kh', $dataSrch['pos_nm_kh']);
        	}
        	
        	//
        	if($dataSrch['srch_all'] != null && $dataSrch['srch_all'] != ""){
        		$this->db->like('tbl_position.pos_nm', $dataSrch['srch_all']);
        	    $this->db->or_like('tbl_position.pos_nm_kh', $dataSrch['srch_all']);
        	}
        	
        	$this->db->order_by("pos_id", "desc");
        	return $this->db->get('tbl_position',$dataSrch['limit'],$dataSrch['offset'])->result();
		}

		public function countPositionData($dataSrch){
		    $this->db->select('count(pos_id) as total_rec');
		    $this->db->from('tbl_position');
		    $this->db->where('com_id', $_SESSION['comId']);
		    $this->db->where('useYn', 'Y');
		    
		    if($dataSrch['pos_nm'] != null && $dataSrch['pos_nm'] != ""){
		        $this->db->like('tbl_position.pos_nm', $dataSrch['pos_nm']);
		    }
		    
		    if($dataSrch['pos_nm_kh'] != null && $dataSrch['pos_nm_kh'] != ""){
		        $this->db->like('tbl_position.pos_nm_kh', $dataSrch['pos_nm_kh']);
		    }
		    
		    return $this->db->get()->result();
		}
		
		public function updatePositionDB($data){
		    $this->db->where('pos_id', $data['pos_id']);
			$this->db->update('tbl_position', $data);
		}
		
		public function insertSupplierDB($data){
			$this->db->insert('tbl_supplier',$data);
			return $this->db->insert_id();
		}
		

    }