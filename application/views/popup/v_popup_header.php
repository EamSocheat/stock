<!DOCTYPE html>
<html>
<head>

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/AdminLTE.min.css">
 
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <style type="text/css">

	@font-face {
	         font-display: fallback;
             font-family: "Khmer Os Battambang";
             font-style: normal;
             font-weight: normal;
             src: local("Khmer Os Battambang"), <?php echo 'url('.base_url('assets/fonts/KhmerOSbattambang.woff').')'?> format("woff"),
                 <?php echo 'url('.base_url('assets/fonts/KhmerOSbattambang.ttf').')' ?> format("truetype"),
                 <?php echo 'url('.base_url('assets/fonts/KhmerOSsiemreap.ttf').')' ?> format("truetype"),
                 <?php echo 'url('.base_url('assets/fonts/KhmerOSbokor.ttf').')' ?> format("truetype");;
        }
    body{
        font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif, Khmer Os Battambang;
    }     
    
    .padding-forms-left{
        padding-left: 50px;
        padding-right: 20px;    
    }
    
    .padding-forms-right{
        padding-right: 20px;    
    }
    
    .modal-header{
    	background-color: #f4f4f4;
    }
    
    label{
        font-weight: 500;
    }
    
    .form-control{
        border-radius: 5px;
    }
    textarea{
        border-radius: 5px;
    } 
    
    .input-sm{
        border-radius: 3px;
    }
    
    .fix-header-tbl{
        overflow-y:scroll;overflow-x:none;
        border: none
    }
    
    .fix-header-tbl table th{
        position: sticky;
        top: -10px;
        background: #f4f4f4;
    }
   
  </style>
</head>
<body>
<input type="hidden" id="base_url" value="<?php echo base_url() ?>"/>
