<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class User extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('M_user');
		$this->load->library('encrypt');
		$this->load->library('session');
		//session_start();
		$this->load->model('M_check_user');
		$this->load->model('M_company');
		$this->load->model('M_login');
		$this->load->helper('url');
	
	}
	
	public function index(){
		
		if(!$this->M_check_user->check()){
			redirect('/Login');
		}
		
		if($_SESSION['usrPos'] !="Admin" && $_SESSION['usrPos'] !="Agency"){
			redirect('/Admin');
		}
		
		$data['header'] = $this->load->view('/admin/header', NULL, TRUE);
		$data['footer'] = $this->load->view('/admin/footer', NULL, TRUE);
		$data['sesUsrNm'] = $_SESSION['usrNm'];
		$this->load->view('/admin/user',$data);
	}
	
	public function select(){
		$usrId=$this->input->post('usrId');
		$usrPos=$this->input->post('usrPos');
		$data['USER_REC']=$this->M_user->select($usrId,$usrPos);
		echo json_encode($data);
	}
	
	public function selectUser(){
		$usrId=$this->input->post('usrId');
		$usrPos=$this->input->post('usrPos');
		$data['USER_REC']=$this->M_user->selectUser($usrId,$usrPos);
		echo json_encode($data);
	}
	
	public function selectUserName(){
	    $usrIdNm=$this->input->post('usrIdNm');
	    $usrId=$this->input->post('usrId');
	    
	    $data['USER_REC']=$this->M_user->selectUserName($usrIdNm,$usrId);
	    echo json_encode($data);
	}
	
	public function checkUserName(){
	    $usrNm=$this->input->post('regLogNm');
	  
	    $data['USER_REC']=$this->M_user->checkUserName($usrNm);
	    echo json_encode($data);
	}
	
	
	public function insert(){
	    $this->db->trans_begin();
	    
		$data = array(
				'usr_nm' 	=> $this->input->post('regLogNm'),
		        'usr_pwd'	=> $this->encrypt->encode($this->input->post('regPwd'),"PWD_ENCR"),
				'regDt'		=> date('d-m-Y H:i:s'),
				'usr_wri_yn'=> "Y",
				'useYn'		=> "Y",
				'com_id'	=> $_SESSION['comId'],
				'regUsr'    => $_SESSION['usrId']
		);
		
		$usrId=$this->M_user->insert($data);
		if ($this->db->trans_status() === FALSE){
		    $this->db->trans_rollback();
		    echo 'ERR';
		}else{
		    $dataCompany = array(
		        'com_nm' 	=> $this->input->post('regComNm'),
		        'com_phone'	=> $this->input->post('regPhone'),
		        'regDt'		=> date('d-m-Y H:i:s'),
		        'useYn'		=> "Y",
		        'regUsr'    => $usrId
		    );
		    $this->M_company->insert($dataCompany);
		    if ($this->db->trans_status() === FALSE){
		        $this->db->trans_rollback();
		        echo 'ERR';
		    }else{
		        $this->db->trans_commit();
		        echo 'OK';
		    }
		}
	   
	}
	
	public function delete(){
		$dataArr = $this->input->post('delObj');
		
		$data = array(
				'useYn' 	=> 'N'
				);
		for($i=0; $i<count($dataArr); $i++){
			$delId =$dataArr[$i]['usrId'];
			$this->M_user->update($delId,$data);
		}
			
		echo count($dataArr)."";
	}
	
	public function update(){
		
		$data = array(
				'usrNm' 	=> $this->input->post('usrNm'),
				'usrPwd'	=> $this->encrypt->encode($this->input->post('usrPwd'),"PWD_ENCR"),
				'usrPhone'	=> $this->input->post('usrPhone'),
				'usrEmail'	=> $this->input->post('usrEmail'),
				'usrAddr'	=> $this->input->post('usrAddr'),
				'usrDob'	=> $this->input->post('usrDob'),
				'usrPos'	=> $this->input->post('usrPos'),
				'usrStr'	=> $this->input->post('usrStr'),
		        'usrIdNm'	=> $this->input->post('usrIdNm'),
				'regDt'		=> date('Y-m-d H:i:s'),
				'useYn'		=> "Y",
				'comId'		=> $_SESSION['comId'],
				'regUsr'    => $_SESSION['usrId']
		);
		$delId= $this->input->post('usrId');
		$this->M_user->update($delId,$data);
		echo "Save data completed.";
	}
	
	public function updatePwd(){
		
		$data = array(
				'usrPwd'	=> $this->encrypt->encode($this->input->post('usrPwd'),"PWD_ENCR"),
				'regDt'		=> date('Y-m-d H:i:s'),
				'useYn'		=> "Y",
				'comId'		=> $_SESSION['comId'],
				'regUsr'    => $_SESSION['usrId']
		);
		$delId= $this->input->post('usrId');
		$this->M_user->update($delId,$data);
		echo "Save data completed.";
	}
	
	public function updateProfile(){
		
		$data = array(
				'usrNm' 	=> $this->input->post('usrNm'),
				'usrPhone'	=> $this->input->post('usrPhone'),
				'usrEmail'	=> $this->input->post('usrEmail'),
				'usrAddr'	=> $this->input->post('usrAddr'),
				'usrDob'	=> $this->input->post('usrDob'),
		        'usrIdNm'	=> $this->input->post('accUsrIdNm'),
				'regDt'		=> date('Y-m-d H:i:s'),
				'useYn'		=> "Y",
				'comId'		=> $_SESSION['comId'],
				'regUsr'    => $_SESSION['usrId']
		);
		
		
		$delId= $this->input->post('usrId');
		$this->M_user->update($delId,$data);
		/* 
		$comData=array('comNm' 	=> $this->input->post('comNm'));
		$this->M_company->update($_SESSION['comId'],$comData);
		 */
		$this->M_login->setSession($this->input->post('usrNm'),$_SESSION['comId'],$this->input->post('comNm'),$delId,$_SESSION['usrPos'],$this->input->post('usrPhone'));
		echo "Save data completed.";
	}
	
	
	public function selectCountSeller(){
		
		$data['USER_REC']=$this->M_user->selectCount();
		echo json_encode($data);
	}
	
	
	public function updateCompany(){
	    
	    $fileNmImg=null;
	    $YYY="Y";
	    if(!empty($_FILES['userfiles1']['name'])){
	        $filesCount = count($_FILES['userfiles1']['name']);
	        $YYY="YY";
	        for($i = 0; $i < $filesCount; $i++){
	            $_FILES['userfile']['name'] 		= $_FILES['userfiles1']['name'][$i];
	            $_FILES['userfile']['type'] 		= $_FILES['userfiles1']['type'][$i];
	            $_FILES['userfile']['tmp_name'] 	= $_FILES['userfiles1']['tmp_name'][$i];
	            $_FILES['userfile']['error'] 		= $_FILES['userfiles1']['error'][$i];
	            $_FILES['userfile']['size'] 		= $_FILES['userfiles1']['size'][$i];
	            
	            
	            $uploadPath = './upload/land/';
	            $config['upload_path'] = $uploadPath;
	            $config['allowed_types'] = 'gif|jpg|png';
	            $config['max_size'] = 1024 * 50;
	            //$config['encrypt_name'] = TRUE;
	            $new_name=date('Y-m-d H:i:s');
	            $new_name=str_replace(" ", "-", $new_name);
	            $new_name=str_replace(":", "-", $new_name);
	            $config['file_name'] = $new_name."_".$_FILES['userfile']['name'];
	            
	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);
	            
	            
	            if($this->upload->do_upload("userfile")){
	                $fileData = $this->upload->data();
	                $fileNmImg.= $fileData['file_name'];
	            }
	            
	        }
	        //remove if upload new image
	        if(!is_null($this->input->post('lndRemoveImg1'))){
	            $imgArr= $this->input->post('lndRemoveImg1');
	            $imgArr= explode("#@#",$imgArr);
	            for($j=0; $j<count($imgArr)-1; $j++){
	                @unlink("upload/land/".$imgArr[$j]);
	            }
	        }
	    }else{
	        //remove click removeAll image
	        if($this->input->post('lndRemoveImg1') == "1"){
	            if(!is_null($this->input->post('lndRemoveImg1'))){
	                $imgArr= $this->input->post('lndRemoveImg1');
	                $imgArr= explode("#@#",$imgArr);
	                for($j=0; $j<count($imgArr)-1; $j++){
	                    @unlink("upload/land/".$imgArr[$j]);
	                }
	            }
	        }
	        
	    }
	    
	    $lndImg=$this->input->post('lndImg1');
	    if( !is_null($fileNmImg) ){
	        $lndImg=$fileNmImg;
	    }
	    
	    
	    $data = array(
	        'comNm' 	=> $this->input->post('comNm'),
	        'comWeb'	=> $this->input->post('proComWeb'),
	        'comPhone'	=> $this->input->post('proComPhone1'),
	        'comPhone1'	=> $this->input->post('proComPhone2'),
	        'comEmail'	=> $this->input->post('proComEmail'),
	        'comFax'	=> $this->input->post('proComFax'),
	        'comAddr'	=> $this->input->post('comProvince'),
	        'comAddr1'	=> $this->input->post('comDis'),
	        'comAddr2'	=> $this->input->post('comCom'),
	        'comAddr3'	=> $this->input->post('comVill'),
	        'comHome'	=> $this->input->post('comHome'),
	        'comSt'	    => $this->input->post('comSt'),
	        'comImg'	=> $lndImg,
	        'upDt'		=> date('Y-m-d H:i:s'),
	        'upUsr'    => $_SESSION['usrId']
	    );
	  
	    $this->M_user->updateCompany($data);
	    echo $YYY;
	}
	
	function selectCompany(){
	    
	    $data['COM_REC']=$this->M_user->selectCompany();
	    echo json_encode($data);
	}
	
	function selectCompanyData(){
	    
	    $data['COM_REC']=$this->M_user->selectCompanyData();
	    echo json_encode($data);
	}
	
}