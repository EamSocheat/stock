<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Register extends CI_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_company');
		$this->load->model('M_user');
		$this->load->model('M_staff');
		$this->load->model('M_position');
		$this->load->model('M_menu');
		$this->load->library('encrypt');
		//$this->load->library('encryption');
	}
	
	
	public function index(){
		$this->load->view('v_register');
		
	}
	
	public function insert(){
	    $this->db->trans_begin();

	    $dataCompany = array(
	        'com_nm' 	=> $this->input->post('regComNm'),
	        'com_phone'	=> $this->input->post('regPhone'),
	        'regDt'		=> date('Y-m-d H:i:s'),
	        'useYn'		=> "N"/* ,
	        'regUsr'    => $usrId */
	    );
	    $comId=$this->M_company->insert($dataCompany);
	   
	    $dataPosition = array(
	        'pos_nm' 	=> "Admin",
	        'pos_nm_kh'	=> "ម្ចាស់ក្រុមហ៊ុន",
	        'regDt'		=> date('Y-m-d H:i:s'),
	        'useYn'		=> "Y",
	        'com_id'	=> $comId
	    );
	    $posId=$this->M_position->insert($dataPosition);
	    
	    
	    $dataStaff = array(
	        'sta_nm' 	=> $this->input->post('regLogNm'),
	        'sta_phone1'	=> $this->input->post('regPhone'),
	        'pos_id'    => $posId,
	        'regDt'		=> date('Y-m-d H:i:s'),
	        'useYn'		=> "Y",
	        'com_id'	=> $comId
	    );
	    $staId=$this->M_staff->insert($dataStaff);
	    
	    
        $data = array(
            'usr_nm' 	=> $this->input->post('regLogNm'),
            'usr_pwd'	=> $this->encrypt->encode($this->input->post('regPwd'),"PWD_ENCR"),
            'regDt'		=> date('Y-m-d H:i:s'),
            'usr_wri_yn'=> "Y",
            'useYn'		=> "Y",
			'usr_str'	=> "Y",
            'com_id'	=> $comId,
            'sta_id'	=> $staId
        );
        
        $usr_id=$this->M_user->insert($data);
		
		$this->M_menu->insertMenuCompany($comId);
        $this->M_menu->insertMenuUser($usr_id);
		
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            echo 'ERR';
        }else{
            $this->db->trans_commit();
            echo 'OK';
        }
    
	}
}
