<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PopupFormBranch extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_check_user');
		$this->load->library('session');
		$this->load->helper('form'); 
	}
	public function index(){
	    
	    if(!$this->M_check_user->check()){
	        redirect('/Login');
	    }
	    $this->load->view('popup/v_popup_form_branch');
	}
	
}
