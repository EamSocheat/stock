<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_login');
		$this->load->library('session');
		$this->load->model('M_check_user');
		$this->load->model('M_menu');
		$this->load->helper('form'); 
		$this->load->model('M_branch');
		$this->load->model('M_common');
	}
	public function index(){
	    
	    if(!$this->M_check_user->check()){
	        redirect('/Login');
	    }
	    $dataMenu['menu_active'] = "Branch";
	    $data['header'] = $this->load->view('v_header', $dataMenu, TRUE);
	    $data['footer'] = $this->load->view('v_footer', NULL, TRUE);
	    $data['iframe'] = $this->load->view('v_iframe', NULL, TRUE);
	    
	    $this->load->view('v_branch',$data);
	}
	
	public function getBranchType(){
	    $data["OUT_REC"] = $this->M_branch->selectBrandType();
	    echo json_encode($data);
	}
	
	public function save(){
	    if(!$this->M_check_user->check()){
	        redirect('/Login');
	    }
	    
		$data = array(
            'bra_nm' 		=> $this->input->post('braNm'),
            'bra_nm_kh' 	=> $this->input->post('braNmKh'),
            'bra_phone1'	=> $this->input->post('braPhone'),
            'bra_phone2'	=> $this->input->post('braPhone2'),
            'bra_email'		=> $this->input->post('braEmail'),
            'bra_addr'		=> $this->input->post('braAddr'),
			'bra_des'		=> $this->input->post('braDes'),
			'useYn'			=> "Y",
            'bra_type_id'	=> $this->input->post('braType'),
            'com_id'		=> $_SESSION['comId']
        );
        
        if($this->input->post('braId') != null && $this->input->post('braId') != ""){
            //update data
            $data['bra_id'] = $this->input->post('braId');
            $data['upUsr'] = $_SESSION['usrId'];
            $data['upDt'] = date('Y-m-d H:i:s');
            $this->M_branch->update($data);

        }else{
            //insert data
            $data['regUsr'] = $_SESSION['usrId'];
            $data['regDt'] = date('Y-m-d H:i:s');
            $this->M_branch->insert($data);
        
        }
	    
	    echo 'OK';
	}
	
	public function getBranch(){
	    if(!$this->M_check_user->check()){
	        redirect('/Login');
	    }
	    
	    $dataSrch = array(
            'limit' 		=> $this->input->post('perPage'),
            'offset' 		=> $this->input->post('offset'),
            'bra_id' 		=> $this->input->post('bra_id'),
            'bra_nm' 		=> $this->input->post('braNm'),
            'bra_nm_kh' 		=> $this->input->post('braNmKh'),
            'bra_phone1' 	=> $this->input->post('braPhone'),
            'bra_type_id' 		=> $this->input->post('braType'),
        );
	    $data["OUT_REC"] = $this->M_branch->selectBrand($dataSrch);
	    $data["OUT_REC_CNT"] = $this->M_branch->countBrand($dataSrch);
	    echo json_encode($data);
	}
	
	public function delete(){
	    if(!$this->M_check_user->check()){
	        redirect('/Login');
	    }
	    
	    $delObj = $this->input->post('delObj');
	    $cntDel=0;
	    for($i=0; $i<sizeof($delObj); $i++){
	        $cntActive=0;
	        //check staff table using branch or not 
	        $dataCol = array(
            'tbl_nm' 		=> "tbl_staff",
            'id_nm' 		=> "bra_id",
            'com_id' 		=> "com_id"
            );
            
            $dataVal = array(
            'id_val' 		=> $delObj[$i]['braId'],
            'com_val' 		=> $_SESSION['comId']
            );
	        $chkData = $this->M_common->checkActiveRecord($dataCol,$dataVal);
	        $cntActive +=$chkData->active_rec;
	        
	        //check stock table using branch or not 
	        $dataCol = array(
            'tbl_nm' 		=> "tbl_stock",
            'id_nm' 		=> "bra_id",
            'com_id' 		=> "com_id"
            );
            
            $dataVal = array(
            'id_val' 		=> $delObj[$i]['braId'],
            'com_val' 		=> $_SESSION['comId']
            );
	        $chkData = $this->M_common->checkActiveRecord($dataCol,$dataVal);
	        $cntActive += $chkData->active_rec;
	        
	        if($cntActive >0){
	            continue;
	        }else{
	            $data = array(
	                'bra_id'    => $delObj[$i]['braId'],
        			'useYn'		=> "N",
                    'com_id'	=> $_SESSION['comId'],
                    'upDt'		=> date('Y-m-d H:i:s'),
                    'upUsr'		=> $_SESSION['usrId']
                );
	            $this->M_branch->update($data);
	            $cntDel+=1;
	        }
	    }
	    //
	    echo $cntDel;
	}
	
	
}   
