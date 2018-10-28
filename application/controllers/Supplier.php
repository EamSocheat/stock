<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_login');
        $this->load->library('session');
        $this->load->model('M_check_user');
        $this->load->model('M_menu');
        $this->load->helper('form');
        $this->load->model('M_supplier');
        $this->load->model('M_common');
    }
    
    public function index(){
        if(!$this->M_check_user->check()){
            redirect('/Login');
        }
        
        $dataMenu['menu_active'] = "Supplier";
        $data['header'] = $this->load->view('v_header', $dataMenu, TRUE);
        $data['footer'] = $this->load->view('v_footer', NULL, TRUE);
        $data['iframe'] = $this->load->view('v_iframe', NULL, TRUE);
        
        $this->load->view('v_supplier',$data);
    }
     
    public function getSupplierData(){
        if(!$this->M_check_user->check()){
            redirect('/Login');
        }
        
        $dataSrch = array (
            'sup_id'    => $this->input->post('sup_id'),
            'sup_nm'    => $this->input->post('suppplyNm'),
            'sup_nm_kh' => $this->input->post('suppplyNmKh'),
            'limit'     => $this->input->post('limit'),
            'offset'    => $this->input->post('offset'),
        );
        
        $data["OUT_REC"]     = $this->M_supplier->selectSupplierData($dataSrch);
        $data["OUT_REC_CNT"] = $this->M_supplier->countSupplierData($dataSrch);
        echo json_encode($data);
    }
    
    public function insertSupplierData(){
        if(!$this->M_check_user->check()){
            redirect('/Login');
        }
        
        $data = array (
            'sup_nm'      => $this->input->post('suppplyNm'),
            'sup_nm_kh'   => $this->input->post('suppplyNmKh'),
            'sup_phone'   => $this->input->post('phoneNum'),
            'sup_email'   => $this->input->post('supplEmail'),
            'sup_addr'    => $this->input->post('suppAddr'),
            'sup_des'     => $this->input->post('suppDescr'),
            'useYn'		  => "Y",
            'com_id'      => $_SESSION['comId']
        );
        
        if($this->input->post('supId') != null && $this->input->post('supId') != ""){
            $data['sup_id'] = $this->input->post('supId');
            //$data['upUsr'] = $_SESSION['usrId'];
            $data['upDt'] = date('Y-m-d H:i:s');
            $this->M_supplier->updateSupplierDB($data);
        }else{
            $data['regUsr'] = $_SESSION['usrId'];
            $data['regDt'] = date('Y-m-d H:i:s');
            $this->M_supplier->insertSupplierDB($data);
        }
        
        echo 'OK';
    }
    
    public function deleteSupplier(){
        if(!$this->M_check_user->check()){
            redirect('/Login');
        }
        
        $delObj = $this->input->post('delObj');
        $cntDel = 0;
        for($i=0; $i<sizeof($delObj); $i++){
            $data = array(
                'sup_id'    => $delObj[$i]['supId'],
                'useYn'		=> "N",
                'com_id'	=> $_SESSION['comId'],
                'upDt'		=> date('Y-m-d H:i:s'),
                //'upUsr'		=> $_SESSION['usrId']
            );
            
            $this->M_supplier->updateSupplierDB($data);
            $cntDel += 1;
        }
        
        echo $cntDel;
    }
    
}

?>