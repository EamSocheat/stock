<?php
	class M_Menu extends CI_Model{
		
		function __construct() 
		{
        	parent::__construct();
        	$this->load->library('session');
        	
    	}
        
		function insertMenuCompany($comId){
			$sql = 'INSERT tbl_menu_company (menu_id, com_id, regDt, useYn)
                           SELECT menu_id, '.$comId.' as com_id , now() as regDt, "Y" as useYn
                           FROM tbl_menu';
                  
			$this->db->query($sql);
			
		}
		
		function insertMenuUser($staId){
			$sql = 'INSERT tbl_menu_user (menu_id, usr_id, regDt, useYn)
                           SELECT menu_id, '.$staId.' as com_id , now() as regDt, "Y" as useYn
                           FROM tbl_menu';
                  
			$this->db->query($sql);
			
		}
		
		function selectMenuUser($usrId){
			
			$this->db->select('tbl_menu_user.menu_id, menu_nm, menu_nm_kh, menu_icon_nm, menu_group, menu_order');
			$this->db->from('tbl_menu_user');
			$this->db->join('tbl_menu_company', 'tbl_menu_company.menu_id = tbl_menu_user.menu_id');
			$this->db->join('tbl_menu', 'tbl_menu.menu_id = tbl_menu_user.menu_id');
			$this->db->where('usr_id', $usrId);
			$this->db->where('com_id', $_SESSION['comId']);
			$this->db->where('tbl_menu_user.useYn', "Y");
			$this->db->where('tbl_menu_company.useYn', "Y");
			$this->db->order_by("menu_group", "asc");
			$this->db->order_by("menu_order", "asc");
			
			return $this->db->get()->result();
		}
    }