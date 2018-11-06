var _btnId;
var _this;
$(document).ready(function() {
	_thisPage.init();
});

var _thisPage = {
		init : function(){
			_this = this;
			
			_this.onload();
			_this.event();
		},
		onload : function(){
			parent.$("#loading").hide();
			clearForm();
			if($("#frmAct").val() == "U"){
			    getDataEdit($("#staId").val());
			    $("#popupTitle").html("<i class='fa fa-home'></i> "+$.i18n.prop("btn_edit")+" "+ $.i18n.prop("lb_staff"));
			}else{
			    $("#btnSaveNew").show();
			    $("#popupTitle").html("<i class='fa fa-home'></i> "+$.i18n.prop("btn_add_new")+" "+ $.i18n.prop("lb_staff"));
			}
			$("#frmStaff").show();
			$("#braNm").focus();
		},
		event : function(){
			//
			$("#btnClose,#btnExit").click(function(e){
				//parent.$("#modalMd").modal('hide');
				parent.stock.comm.closePopUpForm("PopupFormStaff",parent.popupStaffCallback);
			});
			//
			$("#frmStaff").submit(function(e){
				e.preventDefault();
				if(_btnId == "btnSave"){
			    	saveData();
				}else{
			    	saveData("new");
				}
			
			});
			//
			$("#btnSave").click(function(e){
				_btnId= $(this).attr("id");
				
			});
			//
			$("#btnSaveNew").click(function(e){
				_btnId= $(this).attr("id");
				
			});
			//
			$("#btnSelectPhoto").click(function(e){
				$("#fileStaPhoto").trigger( "click" );
				
			});
			//
			$("#fileStaPhoto").change(function(){
			    readURL(this);
			});
			//
			//
			$("#btnPopupBranch").click(function(e){
				var data="parentId=ifameStockForm";
				data+="&dataSrch="+$("#txtBraNm").val();
				var controllerNm = "PopupSelectBranch";
				var option={};
				option["height"] = "450px";
			    stock.comm.openPopUpSelect(controllerNm,option, data,"modal-md");
			});
			
			//
			$("#btnPopupPosition").click(function(e){
				var data="parentId=ifameStockForm";
				data+="&dataSrch="+$("#txtPosNm").val();
				var controllerNm = "PopupSelectPosition";
				var option={};
				option["height"] = "450px";
			    stock.comm.openPopUpSelect(controllerNm,option, data,"modal-md");
			});
			
			
		}
};


function saveData(str){
	$("#staId").appendTo("#frmStaff");
    parent.$("#loading").show();
	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Staff/save",
		data: new FormData($("#frmStaff")[0]),
		cache: false,
        contentType: false,
        processData: false,
		success: function(res) {
			console.log(res);
		    parent.$("#loading").hide();
			if(res =="OK"){
				parent.stock.comm.alertMsg($.i18n.prop("msg_save_com"),"braNm");
				if(str == "new"){
				    clearForm();
				}else{
				    //close popup
				    parent.stock.comm.closePopUpForm("PopupFormStaff",parent.popupStaffCallback);
				}
			}
		},
		error : function(data) {
			console.log(data);
			stock.comm.alertMsg($.i18n.prop("msg_err"));
        }
	});
}

function getDataEdit(sta_id){
    //
    $("#loading").show();
    $.ajax({
		type: "POST",
		url: $("#base_url").val() +"Staff/getStaff",
		data: {"staId":sta_id},
		dataType: "json",
		async: false,
		success: function(res) {
			
			if(res.OUT_REC != null && res.OUT_REC.length >0){
			    $("#txtBraNm").val(res.OUT_REC[0]["bra_nm"]);
			    $("#txtBraId").val(res.OUT_REC[0]["bra_id"]);
			    $("#txtStaffNm").val(res.OUT_REC[0]["sta_nm"]);
			    $("#txtPosNm").val(res.OUT_REC[0]["pos_nm"]);
			    $("#txtPosId").val(res.OUT_REC[0]["pos_id"]);
			    $("#txtStaffNmKh").val(res.OUT_REC[0]["sta_nm_kh"]);
			    $("#cboGender").val(res.OUT_REC[0]["sta_gender"]);
			    $("#txtDob").val(res.OUT_REC[0]["sta_dob"]);
			    $("#txtAddr").val(res.OUT_REC[0]["sta_addr"]);
			    $("#txtPhone1").val(res.OUT_REC[0]["sta_phone1"]);
			    $("#txtPhone2").val(res.OUT_REC[0]["sta_phone2"]);
			    $("#txtEmail").val(res.OUT_REC[0]["sta_email"]);
			    $("#txtStartDate").val(res.OUT_REC[0]["sta_start_dt"]);
			    $("#txtEndDate").val(res.OUT_REC[0]["sta_end_dt"]);
			    $("#txtDes").val(res.OUT_REC[0]["sta_des"]);
			    if(res.OUT_REC[0]["sta_photo"] != null && res.OUT_REC[0]["sta_photo"] != ""){
			    	$("#staImgView").attr("src",$("#base_url").val()+"upload"+res.OUT_REC[0]["sta_photo"]);
			    }
			    
			    $("#txtStaffNm").focus();
			}else{
			    console.log(res);
			    stock.comm.alertMsg($.i18n.prop("msg_err"));
			}
			$("#loading").hide();
		},
		error : function(data) {
		    console.log(data);
		    stock.comm.alertMsg($.i18n.prop("msg_err"));
        }
	});

}

function clearForm(){
    $("#frmStaff input").val("");
    $("#frmStaff textarea").val("");
    $("#staImgView").attr("src",$("#base_url").val()+"assets/image/default-staff-photo.png");
    $("#txtStaffNm").focus();
}

function selectBranchCallback(data){
	$("#txtBraNm").val(data["bra_nm"]);
	$("#txtBraId").val(data["bra_id"]);
}

function selectPositionCallback(data){
	$("#txtPosNm").val(data["pos_nm"]);
	$("#txtPosId").val(data["pos_id"]);
}

/**
 * 
 */
//
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#staImgView').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

