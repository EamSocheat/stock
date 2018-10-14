<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Norkor APP | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/skins/_all-skins.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
 
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
    
    .margin-lr-5{
        margin-left: 5px;
        margin-right: 5px;    
    }
    .modal-header{
    	background-color: #f4f4f4;
    }
    
    .mdl-msg.modal::before {
	     content: "";	  
	     /* display: inline-block; */
	     height: 100%;	 
	     margin-right: -4px;
	     vertical-align: middle;
	}
	
	.mdl-msg .modal-dialog {	
	     /* display: inline-block; */
	     text-align: left;	
	     vertical-align: middle;
	     max-width: 400px;
	}
	
	.mdl-msg .modal-body {
		padding-top: 30px;
	    padding-left: 50px;
	    padding-right: 50px;
	}
	
	.mdl-msg{
		z-index: 9999999;
	}
	.mdl-msg .modal-header .close {
        margin-top: -25px;
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
    
    .box-search .box-header{
        text-align: right;
    }
    
    .box-search .box-body{
        display: none;
    }
    
    .box-search .box-header h3{
        cursor: pointer;
    }
    
 
  </style>
</head>
<body class="hold-transition skin-black-light sidebar-mini fixed">
<input type="hidden" id="menu_active" value="<?php echo $menu_active; ?>"/>
<input type="hidden" id="base_url" value="<?php echo base_url() ?>"/>
<div class="wrapper">
<div class="col-lg-12 col-sm-12 col-md-12" id="loading" style="text-align:center ; position: absolute;top: 0px;padding-left: 8%; padding-top: 23%;background-color: #ffffff; width: 100%;  height: 100%;    z-index: 9999;    opacity: 0.5;">
  <p style=""><img style="width: 20px" src="<?php echo base_url('assets/image/loading.gif') ?>"/></p>
</div>



  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
      	<div class="pull-left image">
          <img src="<?php echo base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle" style="width: 40px;" alt="User Image">
        </div>
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
      	<div class="pull-left image">
          <img src="<?php echo base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle" style="width: 40px;" alt="User Image">
        </div>
      	<b>Tulip Salon</b>
      </span>
      
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-home"></i> <span data-i18nCd="lb_com_pro">Company Profile</span>
            </a>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="langDrop">
              <img data-lng="kh" style="width: 28px;" alt="" src="">
            </a>
            <ul class="dropdown-menu" style="min-width: 150px; width: 150px;" id="langDropSelect">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#" id="langKh">
                   		<img style="width: 28px;" alt="" src="<?php echo base_url('assets/')?>image/khmer.png"> ភាសាខ្មែរ
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#" id="langEn">
                    	<img style="width: 28px;" alt="" src="<?php echo base_url('assets/')?>image/english.png"> English
                    </a>
                  </li>
                  <!-- end task item -->
                  
                </ul>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/') ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <!-- <a href="#">Followers</a> -->
                  </div>
                  <div class="col-xs-4 text-center">
                    <!-- <a href="#">Sales</a> -->
                  </div>
                  <div class="col-xs-4 text-center">
                    <!-- <a href="#">Friends</a> -->
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
           -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
		
      <ul class="sidebar-menu" data-widget="tree" id="divMenu">
		<!--
        <li class="header">MAIN NAVIGATION</li>
       	<li>
          <a href="javascript:void(0)">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
		<li>
          <a href="javascript:void(0)">
            <i class="fa fa-home"></i> <span>Branch</span>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="fa fa-refresh"></i> <span>Stock</span>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="fa fa-user-plus"></i> <span>Position</span>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="fa fa-users"></i> <span>Staff</span>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="fa fa-user-circle-o"></i> <span>User Account</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        
        <li class="header">PRODUCT NAVIGATION</li>

	
       	<li>
          <a href="javascript:void(0)">
            <i class="fa fa-address-card-o"></i> <span>Supplier</span>
          </a>
        </li>
       	<li>
          <a href="javascript:void(0)">
            <i class="fa fa-tags"></i> <span>Category</span>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="fa fa-bar-chart"></i> <span>Product</span>
          </a>
        </li>
       	<li>
          <a href="javascript:void(0)">
            <i class="fa fa-truck"></i> <span>Transfer</span>
          </a>
        </li>
       	<li>
          <a href="javascript:void(0)">
            <i class="fa fa-shopping-cart"></i> <span>Checkout</span>
          </a>
        </li>
        
        <li>
          <a href="javascript:void(0)">
            <i class="fa fa-ship"></i> <span>Import</span>
          </a>
        </li>
       	-->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

