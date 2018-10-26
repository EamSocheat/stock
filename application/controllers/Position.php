<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_login');
        $this->load->library('session');
        $this->load->model('M_check_user');
        $this->load->model('M_menu');
        $this->load->helper('form');
        $this->load->model('M_position');
        $this->load->model('M_common');
    }
    
    public function index(){
        if(!$this->M_check_user->check()){
            redirect('/Login');
        }
        
        $dataMenu['menu_active'] = "Position";
        $data['header'] = $this->load->view('v_header', $dataMenu, TRUE);
        $data['footer'] = $this->load->view('v_footer', NULL, TRUE);
        $data['iframe'] = $this->load->view('v_iframe', NULL, TRUE);
        
        $this->load->view('v_position',$data);
    }
    
    public function getPositionData(){
        if(!$this->M_check_user->check()){
            redirect('/Login');
        }
        
        $dataSrch = array (
            'pos_id'    => $this->input->post('pos_id'),
            'pos_nm'    => $this->input->post('posNm'),
            'pos_nm_kh' => $this->input->post('posNmKh'),
            'limit'     => $this->input->post('limit'),
            'offset'    => $this->input->post('offset'),
            'srch_all' 	=> $this->input->post('srchAll')
        );
        
        $data["OUT_REC"] = $this->M_position->selectPositionData($dataSrch);
        $data["OUT_REC_CNT"] = $this->M_position->countPositionData($dataSrch);
        echo json_encode($data);
    }
    
    public function insertPosition(){
        if(!$this->M_check_user->check()){
            redirect('/Login');
        }
        
        $data = array (
            'pos_nm'    => $this->input->post('posNm'),
            'pos_nm_kh' => $this->input->post('posNmKh'),
            'pos_des'   => $this->input->post('posDescr'),
            'useYn'		=> "Y",
            'com_id'    => $_SESSION['comId']
        );

        if($this->input->post('posId') != null && $this->input->post('posId') != ""){
            $data['pos_id'] = $this->input->post('posId');
            //$data['upUsr'] = $_SESSION['usrId'];
            $data['upDt'] = date('Y-m-d H:i:s');
            $this->M_position->updatePositionDB($data);
        }else{
            $data['regUsr'] = $_SESSION['usrId'];
            $data['regDt'] = date('Y-m-d H:i:s');
            $this->M_position->insertPositionDB($data);
        }
        
        echo 'OK';
    }
    
    public function deletePosition(){
        if(!$this->M_check_user->check()){
            redirect('/Login');
        }
        
        $delObj = $this->input->post('delObj');
        $cntDel = 0;
        for($i=0; $i<sizeof($delObj); $i++){
            $cntActive = 0;
            //check staff table using position or not
            $dataCol = array(
                'tbl_nm' 		=> "tbl_staff",
                'id_nm' 		=> "pos_id",
                'com_id' 		=> "com_id"
            );
            
            $dataVal = array(
                'id_val' 		=> $delObj[$i]['posId'],
                'com_val' 		=> $_SESSION['comId']
            );

            $chkData    = $this->M_common->checkActiveRecord($dataCol,$dataVal);
            $cntActive  += $chkData->active_rec;
            
            if($cntActive > 0){
                continue;
            }else{
                $data = array(
                    'pos_id'    => $delObj[$i]['posId'],
                    'useYn'		=> "N",
                    'com_id'	=> $_SESSION['comId'],
                    'upDt'		=> date('Y-m-d H:i:s'),
                    //'upUsr'		=> $_SESSION['usrId']
                );
                
                $this->M_position->updatePositionDB($data);
                $cntDel += 1;
            }
        }
        
        echo $cntDel;
    }
    
}

?>