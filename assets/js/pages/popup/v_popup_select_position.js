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
	    stock.comm.checkAllTblChk("chkAllPosition","tblPosition","chk_box");
	},
	onload : function(){
		parent.parent.$("#loading").hide();
		$("#frmBranch").show();
		//
	    getData(); 
	    
	    
	},event : function(){
		$("#btnClose,#btnExit").click(function(e){
			
			parent.parent.stock.comm.closePopUpForm("PopupSelectPosition");
			
		});
		//
		$("#btnAddNew").click(function(){
		    parent.$("#loading").show();
			var controllerNm = "PopupFormPosition";
			var option={};
			option["height"] = "320px";
			var data="parentId="+"ifameStockSelect";
			
			parent.stock.comm.openPopUpForm(controllerNm,option, data,null,"modalMdPosition","modalMdContentPosition","ifameStockFormPosition");
		});
		
		
		//
		$("#btnEdit").click(function(){
			var chkVal = $('#tblPosition tbody tr td.chk_box input[type="checkbox"]:checked');
			if(chkVal.length != 1){
			    parent.stock.comm.alertMsg($.i18n.prop("msg_con_edit1"));
				return;
			}
			
			var tblTr = chkVal.parent().parent();
			var posId=tblTr.attr("data-id");
			editData(posId);
		});
		
		//
		$("#btnDelete").click(function(e){
			var chkVal = $('#tblPosition tbody tr td.chk_box input[type="checkbox"]:checked');
			
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
					var posId=tblTr.attr("data-id");
					delData["posId"] = posId;
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
			var chkVal = $('#tblPosition tbody tr td.chk_box input[type="checkbox"]:checked');
			if(chkVal.length != 1){
			    parent.stock.comm.alertMsg($.i18n.prop("msg_con_choose1"));
				return;
			}
			
			var tblTr = chkVal.parent().parent();
			var data={};
			data["pos_nm"] = tblTr.find("td.pos_nm").html();
			data["pos_id"] = tblTr.attr("data-id");
			
			var parentFrame="";
			var callbackFunction=null;
			if($("#parentId").val() !="" && $("#parentId").val() !=null){
				parentFrame= $("#parentId").val();
				callbackFunction=parent.$("#"+parentFrame)[0].contentWindow.selectPositionCallback
			}
			parent.stock.comm.closePopUpForm("PopupSelectPosition",callbackFunction,data);
		});
		
		//
		$("#tblPosition tbody").on("dblclick", "tr td:not(.chk_box,.act_btn)", function() {
			var tblTr = $(this).parent();
			var data={};
			data["pos_nm"] = tblTr.find("td.pos_nm").html();
			data["pos_id"] = tblTr.attr("data-id");
			
			var parentFrame="";
			var callbackFunction=null;
			if($("#parentId").val() !="" && $("#parentId").val() !=null){
				parentFrame= $("#parentId").val();
				callbackFunction=parent.$("#"+parentFrame)[0].contentWindow.selectPositionCallback
			}
			parent.stock.comm.closePopUpForm("PopupSelectPosition",callbackFunction,data);
		});
	}
};

function getData(){
	var dat={};
	//paging
    dat["limit"] = _perPage;
    dat["offset"] = _perPage * ( _pageNo - 1);
    //searching
    dat["srchAll"] = $("#txtSearch").val().trim();	
    //
    parent.$("#loading").show();
    $.ajax({
		type: "POST",
		url: $("#base_url").val() +"Position/getPositionData",
		data: dat,
		dataType: "json",
		success: function(data) {
			parent.$("#loading").hide();
			if(dat["offset"] == 0){
				$("#tblPosition tbody").empty();
			}
			var html = "";
			if(data.OUT_REC.length > 0){
				$.each(data.OUT_REC, function(i,v){
					html += '<tr data-id='+v.pos_id+'>';
					html += '  	<td class="chk_box"><input type="checkbox"></td>';
					html += '  	<td class="pos_nm">'+v.pos_nm+'</td>';
					html += ' 	<td class="pos_nm_kh">'+v.pos_nm_kh+'</td>';							
					html += '	<td class="text-center act_btn"><button onclick="editData('+v.pos_id+')" type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>';
					html += '</tr>';
				});
				$("#tblPosition tbody").append(html);
				$("#chkAll").prop("checked",false);
			}else{
				if($("#tblPosition tbody tr").length <= 0){
					$("#tblPosition tbody").append("<tr><td colspan='6' style='text-align:center;'>"+$.i18n.prop("lb_no_data")+"</td></tr>");
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
		
		delData["posId"] = bra_id;
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
	var controllerNm = "PopupFormPosition";
	var option={};
	option["height"] = "320px";
    parent.stock.comm.openPopUpForm(controllerNm,option, data,null,"modalMdPosition","modalMdContentPosition","ifameStockFormPosition");
}

/**
 * 
 */
function deleteDataArr(dataArr){

	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Position/deletePosition",
		data: dataArr,
		success: function(res) {
		    if(res > 0){
		        parent.stock.comm.alertMsg(res+$.i18n.prop("msg_del_com"));
		        _pageNo=1;
		    	_perPage=$("#tblPosition tbody tr").length;
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
function popupPositionCallback(){
	_pageNo=1;
	_perPage=$("#tblPosition tbody tr").length;
    getData();
}
