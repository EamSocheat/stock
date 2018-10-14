<?php
	class M_common extends CI_Model{
		
		function __construct() 
		{
        	parent::__construct();
        	
    	}

    	
		function checkActiveRecord($col_obj, $data_obj){
        	$this->db->select('count('.$col_obj["id_nm"].') as active_rec');
        	$this->db->from($col_obj["tbl_nm"]);
        	$this->db->where($col_obj["id_nm"], $data_obj["id_val"]);
			$this->db->where($col_obj["com_id"],$data_obj["com_val"]);
			$this->db->where("useYn","Y");
        	return $this->db->get()->result();
		}
		
    }