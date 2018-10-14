<?php
class M_login extends CI_Model{

	function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        //$this->load->library('session');
        $this->load->helper('form'); 
        //session_start();
    }
    
    
    function getEmail($user){
        
        $this->db->select('usrEmail');
        $this->db->from('tbluser');
        $this->db->where('usrIdNm', $user);
        return $this->db->get()->result();
    }
    
    function getPwd($userIdNm){
        $this->db->select('usrPwd,usrEmail');
        $this->db->from('tbluser');
        $this->db->where('usrIdNm', $userIdNm);
     
        $emailArr = $this->db->get()->result();
        if(sizeof( $emailArr) > 0){
            $userEmail="";
            $pwd="";
            foreach($emailArr as $r){
                $userEmail = $r->usrEmail;
                $pwd = $this->encrypt->decode($r->usrPwd,"PWD_ENCR");
            }
            $chk = $this->sendMail( $userEmail, $pwd );
            if($chk){
                return "OK";
            }else{
                return "ERR";
            }
        }else{
            return "ERR";
        }
        
    }
    
    
    //
    
    public function sendMail($toMail,$pwd)
    {
        $this->load->library('email');
        
        $message = '<!DOCTYPE html>';
        $message .= '<html>';
        $message .= '<head>';
        $message .= '</head>';
        $message .= '<body>';
        $message .= "Please use this password for login again. Password: <span style='font-size:18px;color:blue;'>".$pwd."</span>";
        $message .= '</body>';
        $message .= '</html>';


        
        $this->email->from('vkhmer@gmail.com', "v-khmer software");
        $this->email->to($toMail);
        
        $this->email->subject('Your Password');
        $this->email->message("Please use this password for login again. Password: ".$pwd);
        
        $chk=$this->email->send();
        if($chk){
            return "OK";
        }else{
            return "ERR";
        }
        
    }
    //
    
    
    function checkUser($user,$pass){
   
    	$this->db->select('*');
    	$this->db->from('tbl_user');
    	$this->db->join('tbl_company', 'tbl_user.com_id = tbl_company.com_id');
		$this->db->join('tbl_staff', 'tbl_staff.sta_id = tbl_user.sta_id');
		$this->db->join('tbl_position', 'tbl_position.pos_id = tbl_staff.pos_id');
		$this->db->where('usr_nm', $user);
    	$this->db->where('usr_pwd', $this->encrypt->decode($pass,"PWD_ENCR"));
    	$this->db->where('tbl_company.useYn', 'Y');
    	$this->db->where('tbl_user.useYn', 'Y');
    	$this->db->where('tbl_user.usr_str', 'Y');
    	
    	$login = $this->db->get()->result();
		return $login;
    	
    }
 
}