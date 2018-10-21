
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
		$("#frmBranch").show();
		//
	    getData(); 
	    //
	    parent.stock.comm.checkAllTblChk("chkAllBranch","tblBranch","chk_box");
	    
	},event : function(){
		$("#btnClose,#btnExit").click(function(e){
			parent.parent.stock.comm.closePopUpForm("PopupSelectBranch",parent.popupBranchCallback);
		});
		//
		$("#btnAddNew").click(function(){
		    $("#loading").show();
			var controllerNm = "PopupFormBranch";
			var option={};
			option["height"] = "460px";
			var data="parentId="+"ifameStockSelect";
			
			parent.stock.comm.openPopUpForm(controllerNm,option, data,null,"modalMdBranch","modalMdContentBranch","ifameStockFormBranch");
		});
		
		
		//
		$("#btnEdit").click(function(){
			var chkVal = $('#tblBranch tbody tr td.chk_box input[type="checkbox"]:checked');
			if(chkVal.length != 1){
			    parent.stock.comm.alertMsg($.i18n.prop("msg_con_edit1"));
				return;
			}
			
			var tblTr = chkVal.parent().parent();
			var braId=tblTr.attr("data-id");
			editData(braId);
		});
		
		//
		$("#btnDelete").click(function(e){
			var chkVal = $('#tblBranch tbody tr td.chk_box input[type="checkbox"]:checked');
			
			if(chkVal.length <=0){
				parent.stock.comm.alertMsg($.i18n.prop("msg_con_del"));
				return;
			}
			
			parent.stock.comm.confirmMsg($.i18n.prop("msg_sure_del"));
			parent.$("#btnConfirmOk").unbind().click(function(e){
				parent.$("#mdlConfirm").modal('hide');
				
				var delArr=[];
				var delObj={};
				chkVal.each(function(i){
					var delData={};
					var tblTr = $(this).parent().parent();
					var braId=tblTr.attr("data-id");
					delData["braId"] = braId;
					delArr.push(delData);
				});
				
				delObj["delObj"]= delArr;
				//
				deleteDataArr(delObj);
			});
			
		});
		
		//
		$("#btnSearch").click(function(e){
		    getData();
		});
		
	}
};

function getData(){
	var dat=null;
	
    //
    $("#loading").show();
    $.ajax({
		type: "POST",
		url: $("#base_url").val() +"Branch/getBranch",
		data: dat,
		dataType: "json",
		success: function(res) {
			$("#loading").hide();
			$("#tblBranch tbody").html("");
			if(res.OUT_REC != null && res.OUT_REC.length >0){
			    for(var i=0; i<res.OUT_REC.length;i++){
			        var html = "<tr data-id='"+res.OUT_REC[i]["bra_id"]+"'>";
			        html += "<td class='chk_box'><input type='checkbox'></td>";
			        html += "<td class='bra_nm'>"+res.OUT_REC[i]["bra_nm"]+"</td>";
			        html += "<td class='bra_nm_kh'>"+res.OUT_REC[i]["bra_nm_kh"]+"</td>";
			        html += "<td class='bra_type_nm'>"+(getCookie("lang") == "kh" ? res.OUT_REC[i]["bra_type_nm_kh"] : res.OUT_REC[i]["bra_type_nm"])+"</td>";
			        //html += "<td class='act_btn text-center'><button onclick='deleteData("+res.OUT_REC[i]["bra_id"]+")' type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash' aria-hidden='true'></i></button>&nbsp;<button onclick='editData("+res.OUT_REC[i]["bra_id"]+")' type='button' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
			        html += "<td class='act_btn text-center'><button onclick='editData("+res.OUT_REC[i]["bra_id"]+")' type='button' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
			
			        html += "</tr>";
			        
			        $("#tblBranch tbody").append(html);
			    }    
			    
			}else{
			    $("#tblBranch tbody").append("<tr><td colspan='5' style='    text-align: center;'>"+$.i18n.prop("lb_no_data")+"</td></tr>");
			}
			
		},
		error : function(data) {
		    console.log(data);
            parent.stock.comm.alertMsg($.i18n.prop("msg_err"));
        }
	});
}
function deleteData(bra_id){
    parent.stock.comm.confirmMsg($.i18n.prop("msg_sure_del"));
    parent.$("#btnConfirmOk").unbind().click(function(e){
		parent.$("#mdlConfirm").modal('hide');
		
		var delArr=[];
		var delObj={};
		var delData={};
		
		delData["braId"] = bra_id;
		delArr.push(delData);
		delObj["delObj"]= delArr;
		//
		deleteDataArr(delObj);
	});
}

function editData(bra_id){
	var data="id="+bra_id;
	data+="&action=U";
	data+="&parentId="+"ifameStockSelect";
	var controllerNm = "PopupFormBranch";
	var option={};
	option["height"] = "460px";
    parent.stock.comm.openPopUpForm(controllerNm,option, data,null,"modalMdBranch","modalMdContentBranch","ifameStockFormBranch");
}

/**
 * 
 */
function deleteDataArr(dataArr){

	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Branch/delete",
		data: dataArr,
		success: function(res) {
			console.log("tset")
			console.log(res)
		    if(res > 0){
		        parent.stock.comm.alertMsg(res+$.i18n.prop("msg_del_com"));
		        getData();
		    }else{
		        parent.stock.comm.alertMsg($.i18n.prop("msg_err_del"));
		        return;
		    }
		    $("#loading").hide();
		},
		error : function(data) {
			console.log(data);
			parent.stock.comm.alertMsg($.i18n.prop("msg_err"));
        }
	});
}

/**
 * 
 */
function resetFormSearch(){
	$("#txtSrchBraNm").val("");
    $("#txtSrchBraNmKh").val("");
    $("#txtSrchBraPhone").val("");
    $("#cbxSrchBraType").val("");
}

/**
 * 
*/
function popupBranchCallback(){
    getData();
}
