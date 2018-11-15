var _pageNo=1;
var _this;
$(document).ready(function(){
	_thisPage.init();
});

var _thisPage = {
	init : function(){
		_this = this;
		_this.onload();
		_this.event();
	},
	onload : function(){
		//
		getData(); 
		//
		stock.comm.inputNumber("txtSrchBraPhone");
		stock.comm.checkAllTblChk("chkAllBox","tblStaff","chk_box");
		
		$("#cbxSrchBraType").prepend("<option value='' selected='selected'></option>");
		
		
		stock.comm.getPositionSelect("cbxSrchPos");
		$("#cbxSrchPos").prepend("<option value='' selected='selected'></option>");
		stock.comm.getBrnachSelect("cbxSrchBranch");
		$("#cbxSrchBranch").prepend("<option value='' selected='selected'></option>");
	},event : function(){
		$("#perPage").change(function(e){
			_pageNo=1;
			getData();
		});

		//--pagination
		$("#paging").on("click", "li a", function(e) {
			var pageNo = $(this).html();
			_pageNo = pageNo;
			getData(pageNo);
		});
		$(".box-footer").on("click", "#btnGoToPage", function(e) {
			var pageNo = $("#txtGoToPage").val();
			getData(pageNo);
		}); 
		
		
		//
		$("#btnAddNew").click(function(){
			$("#loading").show();
			var controllerNm = "PopupFormStaff";
			var option={};
			option["height"] = "650px";
			
			stock.comm.openPopUpForm(controllerNm,option, null,"modal-md");
		});
		
		//
		$("#btnEdit").click(function(){
			var chkVal = $('#tblStaff tbody tr td.chk_box input[type="checkbox"]:checked');
			if(chkVal.length != 1){
				stock.comm.alertMsg($.i18n.prop("msg_con_edit1"));
				return;
			}
			
			var tblTr = chkVal.parent().parent();
			var braId=tblTr.attr("data-id");
			editData(braId);
		});
		
		//
		$("#btnDelete").click(function(e){
			var chkVal = $('#tblStaff tbody tr td.chk_box input[type="checkbox"]:checked');
			
			if(chkVal.length <=0){
				stock.comm.alertMsg($.i18n.prop("msg_con_del"));
				return;
			}
			
			stock.comm.confirmMsg($.i18n.prop("msg_sure_del"));
			$("#btnConfirmOk").unbind().click(function(e){
				$("#mdlConfirm").modal('hide');
				
				var delArr=[];
				var delObj={};
				chkVal.each(function(i){
					var delData={};
					var tblTr = $(this).parent().parent();
					var braId=tblTr.attr("data-id");
					delData["staId"] = braId;
					delArr.push(delData);
				});
				
				delObj["delObj"]= delArr;
				//
				deleteDataArr(delObj);
			});
			
		});
		
		//
		$("#btnSearch").click(function(e){
			getData(1);
		});
		
		//
		$("#btnReset").click(function(e){
			resetFormSearch();
		});
	}
};

function getData(page_no){
	$("#chkAllBox").prop( "checked", false );
    var pageNo =1;
    if(page_no != "" && page_no != null && page_no != undefined){
        if(page_no <=0){
            page_no = 1;
        }
        pageNo = page_no;
    }
    var dat = {};
    //paging
    dat["perPage"] = $("#perPage").val();
    dat["offset"] = parseInt($("#perPage").val())  * ( pageNo - 1);
    //searching
    dat["staNm"] =      $("#txtSrchStaNm").val().trim();
    dat["staNmKh"] =    $("#txtSrchStaNmKh").val().trim();
    dat["staPhone"] =   $("#txtSrchStaPhone").val().trim();
    dat["braId"] =    	$("#cbxSrchBranch option:selected").val();
    dat["posId"] =    	$("#cbxSrchPos option:selected").val();
    //
    $("#loading").show();
    $.ajax({
		type: "POST",
		url: $("#base_url").val() +"Staff/getStaff",
		data: dat,
		dataType: "json",
		success: function(res) {
			$("#loading").hide();
			$("#tblStaff tbody").html("");
			if(res.OUT_REC != null && res.OUT_REC.length >0){
			    for(var i=0; i<res.OUT_REC.length;i++){
			        var html = "<tr data-id='"+res.OUT_REC[i]["sta_id"]+"'>";
			        var urlPhoto ="";
			        if(res.OUT_REC[i]["sta_photo"] != null && res.OUT_REC[i]["sta_photo"] != ""){
			        	urlPhoto = $("#base_url").val()+"/upload"+ res.OUT_REC[i]["sta_photo"];
			        }
			        html += "<td class='chk_box'><input type='checkbox'></td>";
			        html += "<td class='sta_image'><img style='width: 20px;height: 20px;' src='"+ urlPhoto +"' class='img-circle' /></td>";
			        html += "<td class='sta_nm'>"+res.OUT_REC[i]["sta_nm"]+"</td>";
			        html += "<td class='sta_nm_kh'>"+res.OUT_REC[i]["sta_nm_kh"]+"</td>";
			        html += "<td class='sta_gender'>"+res.OUT_REC[i]["sta_gender"]+"</td>";
			        html += "<td class='sta_phone1'>"+res.OUT_REC[i]["sta_phone1"]+"</td>";
			        html += "<td class='pos_nm'>"+res.OUT_REC[i]["pos_nm"]+"</td>";
			        html += "<td class='bra_nm'>"+res.OUT_REC[i]["bra_nm"]+"</td>";
			        html += "<td class='act_btn text-center'><button onclick='editData("+res.OUT_REC[i]["sta_id"]+")' type='button' class='btn btn-primary btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
			
			        html += "</tr>";
			        
			        $("#tblStaff tbody").append(html);
			    }    
			    //--pagination
			    stock.comm.renderPaging("paging",$("#perPage").val(),res.OUT_REC_CNT[0]["total_rec"],pageNo);
			}else{
			    $("#tblStaff tbody").append("<tr><td colspan='9' style='    text-align: center;'>"+$.i18n.prop("lb_no_data")+"</td></tr>");
			    //--pagination
			    stock.comm.renderPaging("paging",$("#perPage").val(),0,pageNo);
			}
			
		},
		error : function(data) {
		    console.log(data);
            stock.comm.alertMsg($.i18n.prop("msg_err"));
        }
	});
}
function deleteData(sta_id){
    stock.comm.confirmMsg($.i18n.prop("msg_sure_del"));
	$("#btnConfirmOk").unbind().click(function(e){
		$("#mdlConfirm").modal('hide');
		
		var delArr=[];
		var delObj={};
		var delData={};
		
		delData["staId"] = sta_id;
		delArr.push(delData);
		delObj["delObj"]= delArr;
		//
		deleteDataArr(delObj);
	});
}

function editData(sta_id){
	var data="id="+sta_id;
	data+="&action=U";
	
	var controllerNm = "PopupFormStaff";
	var option={};
	option["height"] = "650px";
    stock.comm.openPopUpForm(controllerNm,option, data,"modal-md");
}

/**
 * 
 */
function deleteDataArr(dataArr){

	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Staff/delete",
		data: dataArr,
		success: function(res) {
		    if(res > 0){
		        stock.comm.alertMsg(res+$.i18n.prop("msg_del_com"));
		        getData(_pageNo);
		    }else{
		        stock.comm.alertMsg($.i18n.prop("msg_err_del"));
		        return;
		    }
		    $("#loading").hide();
		},
		error : function(data) {
			console.log(data);
			stock.comm.alertMsg($.i18n.prop("msg_err"));
        }
	});
}

/**
 * 
 */
function resetFormSearch(){
	$("#txtSrchStaNm").val("");
    $("#txtSrchStaNmKh").val("");
    $("#txtSrchStaPhone").val("");
    $("#cbxSrchBranch").val("");
    $("#cbxSrchPos").val("");
}

/**
 * 
*/
function popupStaffCallback(){
    getData(_pageNo);
}