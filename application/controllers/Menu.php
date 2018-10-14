<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");
class Menu extends CI_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_menu');
		$this->load->library('session');
	}
	
	public function insert(){
	    
	}
	
	public function getMenuUser(){
	    $data['menu_user'] = $this->M_menu->selectMenuUser($_SESSION['usrId']);
		echo json_encode($data);
	}
	
	
}
