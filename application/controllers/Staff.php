<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_login');
		$this->load->library('session');
		$this->load->model('M_check_user');
		$this->load->model('M_menu');
		$this->load->helper('form'); 
		$this->load->model('M_branch');
		$this->load->model('M_common');
		$this->load->model('M_staff');
		//$this->load->library('../controllers/upload');
	}
	public function index(){
	    
	    if(!$this->M_check_user->check()){
	        redirect('/Login');
	    }
	    $dataMenu['menu_active'] = "Staff";
	    $data['header'] = $this->load->view('v_header', $dataMenu, TRUE);
	    $data['footer'] = $this->load->view('v_footer', NULL, TRUE);
	    $data['iframe'] = $this->load->view('v_iframe', NULL, TRUE);
	    
	    $this->load->view('v_staff',$data);
	}
	
	public function getBranchType(){
	    $data["OUT_REC"] = $this->M_branch->selectBrandType();
	    echo json_encode($data);
	}
	
	public function save(){
	    if(!$this->M_check_user->check()){
	        redirect('/Login');
	    }

	    $staPhoto="";
	    if(!empty($_FILES['fileStaPhoto']['name'])){
	        $staPhoto = $this->M_common->uploadImage($_FILES['fileStaPhoto'],'fileStaPhoto','./upload/stock/staff','/stock/staff/');
	    }

		$data = array(
            'bra_id' 		=> $this->input->post('txtBraId'),
            'pos_id' 		=> $this->input->post('txtPosId'),
            'sta_nm'		=> $this->input->post('txtStaffNm'),
            'sta_nm_kh'		=> $this->input->post('txtStaffNmKh'),
		    'sta_photo'	    => $staPhoto,
            'sta_gender'	=> $this->input->post('cboGender'),
		    'sta_dob'		=> date('Y-m-d',strtotime($this->input->post('txtDob'))),
			'sta_addr'		=> $this->input->post('txtAddr'),
			'sta_phone1'	=> $this->input->post('txtPhone1'),
			'sta_phone2'	=> $this->input->post('txtPhone2'),
			'sta_email'		=> $this->input->post('txtEmail'),
		    'sta_start_dt'	=> date('Y-m-d',strtotime($this->input->post('txtStartDate'))),
		    'sta_end_dt'	=> date('Y-m-d',strtotime($this->input->post('txtStopDate'))),
			'sta_des'		=> $this->input->post('txtDes'),
			'useYn'			=> "Y",
            'com_id'		=> $_SESSION['comId']
        );
 
        if($this->input->post('staId') != null && $this->input->post('staId') != ""){
            //update data
            $data['sta_id'] = $this->input->post('staId');
            $data['upUsr'] = $_SESSION['usrId'];
            $data['upDt'] = date('Y-m-d H:i:s');
            $this->M_staff->update($data);

        }else{
            //insert data
            $data['regUsr'] = $_SESSION['usrId'];
            $data['regDt'] = date('Y-m-d H:i:s');
            $this->M_staff->insert($data);
        
        }
	    
	    echo 'OK';
	    
	}
	
	public function getStaff(){
	    if(!$this->M_check_user->check()){
	        redirect('/Login');
	    }
	    
	    $dataSrch = array(
            'limit' 		=> $this->input->post('perPage'),
            'offset' 		=> $this->input->post('offset'),
            'sta_id' 		=> $this->input->post('staId'),
            'sta_nm' 		=> $this->input->post('staNm'),
        	'sta_nm_kh' 	=> $this->input->post('staNmKh'),
            'sta_phone' 	=> $this->input->post('staPhone'),
            'bra_id' 		=> $this->input->post('braId'),
            'pos_id' 		=> $this->input->post('posId')
            
        );
	    $data["OUT_REC"] = $this->M_staff->selectStaff($dataSrch);
	    $data["OUT_REC_CNT"] = $this->M_staff->countStaff($dataSrch);
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
            'id_val' 		=> $delObj[$i]['staId'],
            'com_val' 		=> $_SESSION['comId']
            );
	        $chkData = $this->M_common->checkActiveRecord($dataCol,$dataVal);
	        $cntActive +=$chkData->active_rec;
	        
	        //check stock table using import or not 
	        $dataCol = array(
            'tbl_nm' 		=> "tbl_import",
            'id_nm' 		=> "regUsr",
            'com_id' 		=> "com_id"
            );
            
            $dataVal = array(
            'id_val' 		=> $delObj[$i]['staId'],
            'com_val' 		=> $_SESSION['comId']
            );
	        $chkData = $this->M_common->checkActiveRecord($dataCol,$dataVal);
	        $cntActive += $chkData->active_rec;
	        
	        //check use table using staff or not 
	        $dataCol = array(
            'tbl_nm' 		=> "tbl_use",
            'id_nm' 		=> "regUsr",
            'com_id' 		=> "com_id"
            );
            
	        $chkData = $this->M_common->checkActiveRecord($dataCol,$dataVal);
	        $cntActive += $chkData->active_rec;
	        
	        //check use table using staff or not
	        $dataCol = array(
            'tbl_nm' 		=> "tbl_use",
            'id_nm' 		=> "sta_id",
            'com_id' 		=> "com_id"
            );
            
	        $chkData = $this->M_common->checkActiveRecord($dataCol,$dataVal);
	        $cntActive += $chkData->active_rec;
	        
	        if($cntActive >0){
	            continue;
	        }else{
	            $data = array(
	                'sta_id'    => $delObj[$i]['staId'],
        			'useYn'		=> "N",
                    'com_id'	=> $_SESSION['comId'],
                    'upDt'		=> date('Y-m-d H:i:s'),
                    'upUsr'		=> $_SESSION['usrId']
                );
	            $this->M_staff->update($data);
	            $cntDel+=1;
	        }
	    }
	    //
	    echo $cntDel;
	}
	
	
}   
