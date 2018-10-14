$(document).ready(function() {
	
	stock.comm.inputNumber("usrPhone");
	
	$("#frmReg").submit(function(e){
		e.preventDefault();
		register();
	});
	
	$("#regPwdCon").keyup(function(e){
		if($("#regPwd").val() != $("#regPwdCon").val()){
			showPwdErr();
		}else{
			$("#msgErr").hide();
			$("#regPwd").css("border-color","#ced4da");
			$("#regPwdCon").css("border-color","#ced4da");
		}
	});
	
	$("#regPwd").keyup(function(e){
		if($("#regPwd").val() != $("#regPwdCon").val()){
			showPwdErr();
		}else{
			$("#msgErr").hide();
			$("#regPwd").css("border-color","#ced4da");
			$("#regPwdCon").css("border-color","#ced4da");
		}
	});
	/*
	$("#chkTerm").click(function(e){
		console.log("OK");
		if($(this).is(":checked")){
			$("#msgErr").hide();
		}
	});
	*/
	$('input#chkTerm').on('ifClicked', function() {
		if(!$(this).is(":checked") && $("#regPwd").css("border-color") != "rgb(255, 0, 0)"){
			$("#msgErr").hide();
		}
	});
	
});

function register(){
	var checkUsr = stock.comm.checkUserName($("#regLogNm").val(),null);
	if(checkUsr == true){
		stock.comm.alertMsg("Login name already exists! Please choose other one.","regLogNm");
		return;
	}
	
	if($("#regPwd").val() != $("#regPwdCon").val()){
		showPwdErr()
		return;
	}
	
	if(!$("#chkTerm").is(":checked")){
		$("#msgShw").html("Please agree to the terms.");
		$("#msgErr").show();
		$("#chkTerm").parent().addClass("hover");
		return;
	}
	
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Register/insert",
		data: $("#frmReg").serialize(),
		success: function(res) {
			$('#loading').hide();
			if (res == "OK"){
				stock.comm.alertMsg("You were registered, please contact NorkorAPP to confirm.");
				$("#alertMsgOk").click(function(e){
					//
					window.location.href= $("#base_url").val()+"Login";
				});
			}else{
				console.log(res);
	            stock.comm.alertMsg("System Error!!! PLease connect again.");
			}
		},
		error : function(data) {
			console.log(data);
            stock.comm.alertMsg("System Error!!! PLease connect again.");
        }
	});
}

function showPwdErr(){
	$("#regPwd").css("border-color","red");
	$("#regPwdCon").css("border-color","red");
	$("#msgShw").html("Password do not match!!!");
	$("#msgErr").show();
	
}