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
	        $staPhoto = $this->M_common->uploadImage($_FILES['fileStaPhoto'],'fileStaPhoto','./upload/stock/staff');
	    }
	   /*  if(!empty($_FILES['fileStaPhoto']['name'])){
	        if(!empty($_FILES['fileStaPhoto']['name'])){
	            $filesCount = count($_FILES['fileStaPhoto']['name']);
	            
	            for($i = 0; $i < $filesCount; $i++){
	               
	                $_FILES['userfile']['name'] 		= $_FILES['fileStaPhoto']['name'][$i];
	                $_FILES['userfile']['type'] 		= $_FILES['fileStaPhoto']['type'][$i];
	                $_FILES['userfile']['tmp_name'] 	= $_FILES['fileStaPhoto']['tmp_name'][$i];
	                $_FILES['userfile']['error'] 		= $_FILES['fileStaPhoto']['error'][$i];
	                $_FILES['userfile']['size'] 		= $_FILES['fileStaPhoto']['size'][$i];
	                
	                
	                $uploadPath = './upload/stock/staff';
	                $config['upload_path'] = $uploadPath;
	                $config['allowed_types'] = 'gif|jpg|png';
	                $config['max_size'] = 1024 * 50;
	                $new_name=date('Y-m-d H:i:s');
	                $new_name=str_replace(" ", "-", $new_name);
	                $new_name=str_replace(":", "-", $new_name);
	                $config['file_name'] = $new_name."_".$_SESSION['comId']."_".$_SESSION['usrId'];
	                
	                $this->load->library('upload', $config);
	                $this->upload->initialize($config);
	                
	                
	                if($this->upload->do_upload("fileStaPhoto")){
	                    $fileData = $this->upload->data();
	                    $fileNmImg.= $fileData['file_name'];
	                    $staPhoto = $fileNmImg;
	                }
	                
	            }
	        }
	    } */
	    /* 
		$data = array(
            'bra_id' 		=> $this->input->post('txtBraId'),
            'pos_id' 		=> $this->input->post('txtPosId'),
            'sta_nm'		=> $this->input->post('txtStaffNm'),
            'sta_nm_kh'		=> $this->input->post('txtStaffNmKh'),
		    'sta_photo'	    => $staPhoto,
            'sta_gender'	=> $this->input->post('cboGender'),
		    //'sta_dob'		=> $this->input->post('txtDob'),
		    'sta_dob'		=> date('Y-m-d',strtotime("01-01-1992")),
			'sta_addr'		=> $this->input->post('txtAddr'),
			'sta_phone1'	=> $this->input->post('txtPhone1'),
			'sta_phone2'	=> $this->input->post('txtPhone2'),
			'sta_email'		=> $this->input->post('txtEmail'),
		    //'sta_start_dt'	=> $this->input->post('txtStartDate'),
		    'sta_start_dt'	=> date('Y-m-d',strtotime("01-01-2018")),
		    //'sta_end_dt'	=> $this->input->post('txtEndDate'),
			'sta_des'		=> $this->input->post('txtDes'),
			'useYn'			=> "Y",
            'com_id'		=> $_SESSION['comId']
        );
 
        if($this->input->post('braId') != null && $this->input->post('braId') != ""){
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
	    */
	}
	
	public function getStaff(){
	    if(!$this->M_check_user->check()){
	        redirect('/Login');
	    }
	    
	    $dataSrch = array(
            'limit' 		=> $this->input->post('perPage'),
            'offset' 		=> $this->input->post('offset'),
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
