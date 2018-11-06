<?php
	class M_common extends CI_Model{
		
		function __construct() 
		{
        	parent::__construct();
        	$this->load->helper('url');
    	}

    	
    	public function checkActiveRecord($col_obj, $data_obj){
        	$this->db->select('count('.$col_obj["id_nm"].') as active_rec');
        	$this->db->from($col_obj["tbl_nm"]);
        	$this->db->where($col_obj["id_nm"], $data_obj["id_val"]);
			$this->db->where($col_obj["com_id"],$data_obj["com_val"]);
			$this->db->where("useYn","Y");
        	return $this->db->get()->result();
		}
		
	    
		
		public function uploadImage($fileTarget, $nameTarget, $path,$pathSave){
		    $fileNmImg="";
		    if(!empty($fileTarget['name'])){
		        $filesCount = count($fileTarget['name']);
		        $YYY="YY";
		        for($i = 0; $i < $filesCount; $i++){
		            $_FILES['userfile']['name'] 		= $fileTarget['name'][$i];
		            $_FILES['userfile']['type'] 		= $fileTarget['type'][$i];
		            $_FILES['userfile']['tmp_name'] 	= $fileTarget['tmp_name'][$i];
		            $_FILES['userfile']['error'] 		= $fileTarget['error'][$i];
		            $_FILES['userfile']['size'] 		= $fileTarget['size'][$i];
		            
		            
		            $uploadPath = $path;
		            $config['upload_path'] = $uploadPath;
		            $config['allowed_types'] = 'gif|jpg|png';
		            $config['max_size'] = 1024 * 50;
		            $new_name=date('Y-m-d H:i:s');
		            $new_name=str_replace(" ", "-", $new_name);
		            $new_name=str_replace(":", "-", $new_name);
		            $config['file_name'] = $new_name."_".$_SESSION['comId']."_".$_SESSION['usrId'];
		            
		            $this->load->library('upload', $config);
		            $this->upload->initialize($config);
		            
		            
		            if($this->upload->do_upload($nameTarget)){
		                $fileData = $this->upload->data();
		                $fileNmImg.=$pathSave;
		                $fileNmImg.= $fileData['file_name'];
		            }
		            
		        }
		    }
		    return $fileNmImg;
		}
		
		
    }