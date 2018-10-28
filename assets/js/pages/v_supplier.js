
var _pageNo = 1;
$(document).ready(function(){
	_thisPage.onload();
});

var _thisPage = {
		onload : function(){
			_this = this;
			_this.loadData();
			_this.event();
			stock.comm.checkAllTblChk("chkAll","tblSupplier","chk_box");
		}, loadData : function(page_no){
			
			var input = {};
			var pageNo = 1;
		    if(page_no != "" && page_no != null && page_no != undefined){
		        if(page_no <= 0){
		            page_no = 1;
		        }
		        pageNo = page_no;
		    }
			
			input["limit"]		 = $("#perPage").val();
			input["offset"]		 = parseInt($("#perPage").val()) * ( pageNo - 1);
			input["suppplyNm"]	 = $("#txtSrchSupplNm").val().trim();
			input["suppplyNmKh"] = $("#txtSrchSupplNmKh").val().trim();
			
		    $("#loading").show();
		    $.ajax({
				type: "POST",
				url: $("#base_url").val() +"Supplier/getSupplierData",
				data: input,
				dataType: "json",
				success: function(data) {
					$("#loading").hide();
					var html = "";
					$("#supplList").empty();
					
					if(data.OUT_REC.length > 0){
						$.each(data.OUT_REC, function(i,v){
							html += '<tr class="chk_box" data-id='+v.sup_id+'>';
							html += '	<td><input type="checkbox"></td>';
							html += '	<td><div>'+null2Void(v.sup_nm)+'</div></td>';
							html += '	<td><div>'+null2Void(v.sup_nm_kh)+'</div></td>';
							html += '	<td><div>'+null2Void(v.sup_phone)+'</div></td>';
							html += '	<td><div>'+null2Void(v.sup_email)+'</div></td>';
							html += '	<td><div>'+null2Void(v.sup_addr)+'</div></td>';
							html += '	<td><div>'+null2Void(v.sup_desc)+'</div></td>';
							html += '	<td><div>'+(null2Void(v.regDt)).substr(0,10)+'</div></td>';
							html += '	<td class="text-center">';
							html += '		<button onclick="_thisPage.editData('+v.sup_id+')" type="button" class="btn btn-primary btn-xs">';
							html += '		<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
							html += '	</td>';
							html += '</tr>';
						});
						
						$("#supplList").append(html);
						$("#chkAll").show();
						$("#chkAll").prop("checked",false);
						stock.comm.renderPaging("paging", $("#perPage").val(), data.OUT_REC_CNT[0]["total_rec"], pageNo);
					}else{
						$("#chkAll").hide();
						$("#supplList").append("<tr><td colspan='6' style='text-align:center;'>No data to show.</td></tr>");
						stock.comm.renderPaging("paging", $("#perPage").val(), 0, pageNo);
					}
					
				}, error : function(data) {
				    $("#loading").hide();
				    stock.comm.alertMsg($.i18n.prop("msg_err"));
		        }
			});
		}, editData : function(sup_id){
			$("#loading").show();
			var option = {};
			var data = "id="+sup_id;
			var controllerNm = "PopupFormSupplier";
			option["height"] = "458px";
			
			stock.comm.openPopUpForm(controllerNm, option, data);
		}, addNewSupplier : function(){
			$("#loading").show();
			var data = "";
			var controllerNm = "PopupFormSupplier";
			var option = {};
			option["height"] = "458px";
			
			stock.comm.openPopUpForm(controllerNm, option, data);
		}, deleteData : function(dataArr){
			console.log(dataArr)
			$.ajax({
				type: "POST",
				url: $("#base_url").val() +"Supplier/deleteSupplier",
				data: dataArr,
				success: function(res) {
				    if(res > 0){
				        stock.comm.alertMsg(res+$.i18n.prop("msg_del_com"));
				        if($("#chkAll").is(":checked")){
				        	_pageNo = 1;
				        }
				        _this.loadData(_pageNo);
				    }else{
				    	stock.comm.alertMsg($.i18n.prop("msg_err_del"));
				        return;
				    }
				}, error : function(data) {
					stock.comm.alertMsg($.i18n.prop("msg_err"));
		        }
			});
		}, event : function(){
			$("#txtSrchSupplNm, #txtSrchSupplNmKh").on("keypress", function(e){
				if(e.which == 13){
					_this.loadData(1);
				}
			});
			$("#paging").on("click", "li a", function(e) {
		        var pageNo = $(this).html();
		        _pageNo = pageNo;
		        _this.loadData(pageNo);
		    });
		}
}

function popupSupplierCallback(){
	_this.loadData(_pageNo);
}

function null2Void(dat){
	if(dat == null || dat == undefined || dat == "null" || dat == "undefined"){
		return "";
	}
	return dat;
}

function fn_delete(){
	var chkItem = $("#supplList input[type=checkbox]:checked");
	
	if(chkItem.length == 0){
		stock.comm.alertMsg($.i18n.prop("msg_con_del"));
		return;
	}
	
	stock.comm.confirmMsg($.i18n.prop("msg_sure_del"));
	$("#btnConfirmOk").unbind().click(function(e){
		$("#mdlConfirm").modal('hide');
		
		var delArr = [];
		var delObj = {};
		$(chkItem).each(function(i,v){
			var delData = {};
			var tblTr = $(this).parent().parent();
			var supId = tblTr.attr("data-id");
			delData["supId"] = supId;
			delArr.push(delData);
		});
		
		delObj["delObj"] = delArr;
		_thisPage.deleteData(delObj);
	});
}

















