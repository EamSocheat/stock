$(document).ready(function() {
	
	$("#frmLogin").submit(function(e){
		e.preventDefault();
		login();
	});
	
	//
	$("#btnForgot").click(function(e){
		
		getEmail();
	
	});
	
	
	//
	$("#btnSend").click(function(e){
		if($("#usrNm").val().replace(/ /g,"") == ""){
			stock.comm.alertMsg("Please input your user account.","usrNm");
			
		}else{
			sendEmail();
		}
		
	
	});
	
	
	
});


function login(){
	$("#loading").show();
	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Login/checkLogin",
		data: {usrNm: $("#usrNm").val(), usrPwd: $("#usrPwd").val()},
		async: false,
		success: function(res) {
			$("#loading").hide();
			if (res == "OK"){
				window.location.href= $("#base_url").val()+"Dashboard";
			}else{
				stock.comm.alertMsg("You put wrong User name or password! Please try again.");
			}
		},
		error : function(data) {
            stock.comm.alertMsg("System Error!!! PLease connect again.");
        }
	});
}

function getEmail(){
	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Login/getEmail",
		data: {usrNm: $("#usrNm").val()},
		success: function(res) {
			if (res == "ERR"){
				stock.comm.alertMsg("This user name don't register an email! Please try again.","usrNm");
				return;
			}else{
				$("#usrEmail").val(res);
				$("#mdlForget").modal({ backdrop: 'static',keyboard: false });
			}
		},
		error : function(data) {
			console.log(data);
            stock.comm.alertMsg("System Error!!! PLease connect again.");
        }
	});
}

function sendEmail(){
	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Login/sendEmail",
		data: {usrNm: $("#usrNm").val()},
		success: function(res) {
			if (res == "ERR"){
			
				stock.comm.alertMsg("This user name don't register an email! Please try again.","usrNm");
				
			}else{
				$("#mdlForget").modal('hide');
				stock.comm.alertMsg("Password was sent! Please check your email.","usrNm");
			}
		},
		error : function(data) {
			console.log(data);
            stock.comm.alertMsg("System Error!!! PLease connect again.");
        }
	});
}