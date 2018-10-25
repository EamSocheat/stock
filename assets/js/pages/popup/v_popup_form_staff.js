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
			getBrnachType();
			clearForm();
			if($("#frmAct").val() == "U"){
			    getDataEdit($("#braId").val());
			    $("#popupTitle").html("<i class='fa fa-home'></i> "+$.i18n.prop("btn_edit")+" "+ $.i18n.prop("lb_branch"));
			}else{
			    $("#btnSaveNew").show();
			    $("#popupTitle").html("<i class='fa fa-home'></i> "+$.i18n.prop("btn_add_new")+" "+ $.i18n.prop("lb_branch"));
			}
			$("#frmBranch").show();
			$("#braNm").focus();
		},
		event : function(){
			//
			$("#btnClose,#btnExit").click(function(e){
				//parent.$("#modalMd").modal('hide');
				parent.stock.comm.closePopUpForm("PopupFormStaff",parent.popupStaffCallback);
			});
			//
			$("#frmBranch").submit(function(e){
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
				$("#userfile").trigger( "click" );
				
			});
			
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


function getBrnachType(){
	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Branch/getBranchType",
		dataType: 'json',
		async: false,
		success: function(res) {
			if(res.OUT_REC.length > 0){
				$("#braType option").remove();
				for(var i=0; i<res.OUT_REC.length; i++){
					var braNm = (parent.getCookie("lang") == "kh" ? res.OUT_REC[i]["bra_nm_kh"] : res.OUT_REC[i]["bra_nm"]);
					$("#braType").append("<option value='"+res.OUT_REC[i]["bra_type_id"]+"'>"+braNm+"</option>");
				}
				
			}else{
				console.log(res);
				stock.comm.alertMsg($.i18n.prop("msg_err"));
			}
		},
		error : function(data) {
			console.log(data);
			stock.comm.alertMsg($.i18n.prop("msg_err"));
        }
	});
}


function saveData(str){
    parent.$("#loading").show();
	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Branch/save",
		data: $("#frmBranch").serialize()+ "&braId=" +$("#braId").val(),
		success: function(res) {
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

function getDataEdit(bra_id){
    //
    $("#loading").show();
    $.ajax({
		type: "POST",
		url: $("#base_url").val() +"Branch/getBranch",
		data: {"bra_id":bra_id},
		dataType: "json",
		async: false,
		success: function(res) {
			
			if(res.OUT_REC != null && res.OUT_REC.length >0){
			    $("#braNm").val(res.OUT_REC[0]["bra_nm"]);
			    $("#braNmKh").val(res.OUT_REC[0]["bra_nm_kh"]);
			    $("#braPhone").val(res.OUT_REC[0]["bra_phone1"]);
			    $("#braPhone2").val(res.OUT_REC[0]["bra_phone2"]);
			    $("#braEmail").val(res.OUT_REC[0]["bra_email"]);
			    $("#braType").val(res.OUT_REC[0]["bra_type_id"]);
			    $("#braAddr").val(res.OUT_REC[0]["bra_addr"]);
			    $("#braDes").val(res.OUT_REC[0]["bra_des"]);
			    $("#braNm").focus();
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
    $("#frmBranch input").val("");
    $("#frmBranch textarea").val("");
    
    $("#braNm").focus();
}

function selectBranchCallback(data){
	$("#txtBraNm").val(data["bra_nm"]);
	$("#txtBraId").val(data["bra_id"]);
}
