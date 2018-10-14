<?php
class M_check_user extends CI_Model{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		//session_start();
	}
	
	public function check(){
		if( isset($_SESSION['usrId'])){
			return true;
		}else{
			return false;
		}
	}
}