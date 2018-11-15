var _pageNo=1;
var _perPage=6;
$(document).ready(function() {
	_thisPage.init();
});


var _thisPage = {
	init : function(){
		_this = this;
		_this.onload();
		_this.event();
		//
	    stock.comm.checkAllTblChk("chkAll","tblBranch","chk_box");
	},
	onload : function(){
		parent.parent.$("#loading").hide();
		$("#frmStaff").show();
		//
	    getData(); 
	    
	    
	},event : function(){
		$("#btnClose,#btnExit").click(function(e){
			
			parent.parent.stock.comm.closePopUpForm("PopupSelectBranch");
			
		});
		//
		$("#btnAddNew").click(function(){
		    parent.$("#loading").show();
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
			_pageNo=1;
			_perPage=6;
			getData();
		});
		
		//
		$("#txtSearch").keypress(function(e) {
		    if(e.which == 13) {
		    	_pageNo=1;
		    	_perPage=6;
			    getData();
		    }
		});
		//on scroll event
		var lastScrollTop = 0;
		$(".fix-header-tbl").scroll(function(e) {
			var st = $(this).scrollTop();
			if (st > lastScrollTop){
				if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
					_pageNo+=1;
		            getData();
		        }
			} 
			lastScrollTop = st;
			
		});
		//
		$("#btnChoose").click(function(e) {
			var chkVal = $('#tblBranch tbody tr td.chk_box input[type="checkbox"]:checked');
			if(chkVal.length != 1){
			    parent.stock.comm.alertMsg($.i18n.prop("msg_con_choose1"));
				return;
			}
			
			var tblTr = chkVal.parent().parent();
			var data={};
			data["bra_nm"] = tblTr.find("td.bra_nm").html();
			data["bra_id"] = tblTr.attr("data-id");
			
			var parentFrame="";
			var callbackFunction=null;
			if($("#parentId").val() !="" && $("#parentId").val() !=null){
				parentFrame= $("#parentId").val();
				callbackFunction=parent.$("#"+parentFrame)[0].contentWindow.selectBranchCallback
			}
			parent.stock.comm.closePopUpForm("PopupSelectBranch",callbackFunction,data);
		});
		
		//
		$("#tblBranch tbody").on("dblclick", "tr td:not(.chk_box,.act_btn)", function() {
			var tblTr = $(this).parent();
			var data={};
			data["bra_nm"] = tblTr.find("td.bra_nm").html();
			data["bra_id"] = tblTr.attr("data-id");
			
			var parentFrame="";
			var callbackFunction=null;
			if($("#parentId").val() !="" && $("#parentId").val() !=null){
				parentFrame= $("#parentId").val();
				callbackFunction=parent.$("#"+parentFrame)[0].contentWindow.selectBranchCallback
			}
			parent.stock.comm.closePopUpForm("PopupSelectBranch",callbackFunction,data);
		});
		
		
	}
};

function getData(){
	var dat={};
	//paging
    dat["perPage"] = _perPage;
    dat["offset"] = _perPage * ( _pageNo - 1);
    //searching
    dat["srchAll"] = $("#txtSearch").val().trim();	
    //
    parent.$("#loading").show();
    $.ajax({
		type: "POST",
		url: $("#base_url").val() +"Branch/getBranch",
		data: dat,
		dataType: "json",
		success: function(res) {
			parent.$("#loading").hide();
			if(dat["offset"] == 0){
				$("#tblBranch tbody").html("");
			}
			
			if(res.OUT_REC != null && res.OUT_REC.length >0){
			    for(var i=0; i<res.OUT_REC.length;i++){
			        var html = "<tr data-id='"+res.OUT_REC[i]["bra_id"]+"'>";
			        html += "<td class='chk_box'><input type='checkbox'></td>";
			        html += "<td class='bra_nm cur-pointer'>"+res.OUT_REC[i]["bra_nm"]+"</td>";
			        html += "<td class='bra_nm_kh cur-pointer'>"+res.OUT_REC[i]["bra_nm_kh"]+"</td>";
			        html += "<td class='bra_type_nm cur-pointer'>"+(getCookie("lang") == "kh" ? res.OUT_REC[i]["bra_type_nm_kh"] : res.OUT_REC[i]["bra_type_nm"])+"</td>";
			        //html += "<td class='act_btn text-center'><button onclick='deleteData("+res.OUT_REC[i]["bra_id"]+")' type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash' aria-hidden='true'></i></button>&nbsp;<button onclick='editData("+res.OUT_REC[i]["bra_id"]+")' type='button' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
			        html += "<td class='act_btn text-center'><button onclick='editData("+res.OUT_REC[i]["bra_id"]+")' type='button' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
			
			        html += "</tr>";
			        
			        $("#tblBranch tbody").append(html);
			    }    
			    
			}else{
				if($("#tblBranch tbody tr").length <= 0){
					$("#tblBranch tbody").append("<tr><td colspan='5' style='    text-align: center;'>"+$.i18n.prop("lb_no_data")+"</td></tr>");
				}
			    
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
		    if(res > 0){
		        parent.stock.comm.alertMsg(res+$.i18n.prop("msg_del_com"));
		        _pageNo=1;
		    	_perPage=$("#tblBranch tbody tr").length;
		        getData();
		    }else{
		        parent.stock.comm.alertMsg($.i18n.prop("msg_err_del"));
		        return;
		    }
		    parent.$("#loading").hide();
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
	_pageNo=1;
	_perPage=$("#tblBranch tbody tr").length;
    getData();
}
