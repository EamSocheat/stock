var _btnId;

$(document).ready(function(){
	_thisPage.onload();
});


var _thisPage = {
		onload : function(){
			_this = this;
			parent.$("#loading").hide();
			_this.event();
			if($("#posId").val() != ""){
			    _thisPage.fillData($("#posId").val());
			    $("#popupTitle").html("<i class='fa fa-user-plus'></i> "+$.i18n.prop("btn_edit")+" "+ $.i18n.prop("lb_position"));
			}else{
			    $("#btnSaveNew").show();
			    $("#popupTitle").html("<i class='fa fa-user-plus'></i> "+$.i18n.prop("btn_add_new")+" "+ $.i18n.prop("lb_position"));
			}
		}, fillData : function(pos_id){
			$.ajax({
				type: "POST",
				url: $("#base_url").val() +"Position/getPositionData",
				data: {"pos_id" : pos_id},
				dataType: "json",
				success: function(data) {
					$("#loading").hide();
					if(data.OUT_REC.length > 0){
						$("#posNm").val(data.OUT_REC[0]["pos_nm"]);
						$("#posNmKh").val(data.OUT_REC[0]["pos_nm_kh"]);
						$("#posDescr").val(data.OUT_REC[0]["pos_des"]);
					}
				}, error : function(data) {
				    console.log(data);
				    $("#loading").hide();
				    parent.stock.comm.alertMsg($.i18n.prop("msg_err"));
		        }
			});
		}, savePositionName : function(str){
			parent.$("#loading").show();
			
			$.ajax({
				type: "POST",
				url: $("#base_url").val() + "Position/insertPosition",
				data: $("#frmBranch").serialize() + "&posId=" + $("#posId").val(),
				success: function(res) {
				    parent.$("#loading").hide();
					if(res =="OK"){
						parent.stock.comm.alertMsg($.i18n.prop("msg_save_com"),"posNm");
						if(str == "new"){
						    clearForm();
						}else{
							var parentFrame="";
							var callbackFunction=null;
							if($("#parentId").val() !="" && $("#parentId").val() !=null){
								parentFrame= $("#parentId").val();
								callbackFunction=parent.$("#"+parentFrame)[0].contentWindow.popupPositionCallback
							}else{
								callbackFunction=parent.popupBranchCallback;
							}
							
							parent.stock.comm.closePopUpForm("PopupFormPosition", callbackFunction);
						}
					}
				},
				error : function(data) {
					console.log(data);
					parent.stock.comm.alertMsg($.i18n.prop("msg_err"));
		        }
			});
		}, event : function(){
			$("#btnClose, #btnExit").click(function(e){
				var parentFrame="";
				var callbackFunction=null;
				if($("#parentId").val() !="" && $("#parentId").val() !=null){
					parentFrame= $("#parentId").val();
					callbackFunction=parent.$("#"+parentFrame)[0].contentWindow.popupPositionCallback
				}else{
					callbackFunction=parent.popupBranchCallback;
				}
				
				parent.stock.comm.closePopUpForm("PopupFormPosition", callbackFunction);
			});
			$("#btnSave").click(function(){
				_btnId = $(this).attr("id");
			});
			$("#btnSaveNew").click(function(){
				_btnId= $(this).attr("id");
			});
			$("#frmBranch").submit(function(e){
				e.preventDefault();
				if(_btnId == "btnSave"){
					_this.savePositionName();
				}else{
					_this.savePositionName('new');
				}
			
			});
		}
}

function clearForm(){
    $("#frmBranch input").val("");
    $("#frmBranch textarea").val("");
    
    $("#posNm").focus();
}