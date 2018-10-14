<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NorkorAPP | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  
    <style type="text/css">
  	.mdl-msg.modal{
        text-align: center;
	}
	.mdl-msg.modal::before {
	     content: "";	  
	     display: inline-block;
	     height: 100%;	 
	     margin-right: -4px;
	     vertical-align: middle;
	}
	.mdl-msg .modal-dialog {	
	     display: inline-block;	
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
	.modal-header .close {
        margin-top: -25px;
    }
    .btn{
        border-radius: 0px; 
    }
  </style>
  
  
</head>
<body class="hold-transition login-page">
<div class="col-lg-12 col-sm-12 col-md-12" id="loading" style="display:none ; text-align:center ; position: absolute;top: 0px;padding-left: 8%; padding-top: 23%;background-color: #ffffff; width: 100%;  height: 100%;    z-index: 9999;    opacity: 0.7;">
  <p style=""><img style="width: 20px" src="<?php echo base_url('assets/image/loading.gif') ?>"/></p>
</div>
<div class="login-box">

  <div class="login-logo">
    <a href="javascript:void(0)"><b>Norkor<span style="color: #555299">APP</span></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post" id="frmLogin">
      <div class="form-group has-feedback"> 
        <input type="text" class="form-control" placeholder="Login name" id="usrNm" name="usrNm" required="required">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="usrPwd" name="usrPwd" required="required">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Login name
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- 
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
     -->
    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="Register" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



<!-- Modal land.comm.alertMsg -->
  <div class="modal fade mdl-msg" id="mdlAlert" role="dialog" >
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #007bff;color: white;">
          <h4 class="modal-title" id=""><i class="fa fa-info-circle"></i> Information</h4>
          <button type="button" class="close" data-dismiss="modal" id="btnExitland.comm.alertMsg">&times;</button>
        </div>
        <div class="modal-body">
			<!--  -->	          
	
			<!--  -->
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-primary btn-sm" id="alertMsgOk" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- end modal  --> 



<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/') ?>plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url('assets/') ?>js/comm/stock.comm.js"></script>
<script src="<?php echo base_url('assets/') ?>js/pages/v_login.js"></script>

<input type="hidden" id="base_url" value="<?php echo base_url() ?>"/>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
