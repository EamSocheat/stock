/**
 * 
 */
var stock;
if(!stock) stock={};	

if(!stock.comm) {stock.comm={};}
	
	stock.comm.inputCurrency = function (targetId){
		
		
		$("#"+targetId).keydown(function (e) {
	        // Allow: backspace, delete, tab, escape, enter and .
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	             // Allow: Ctrl+A, Command+A
	            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
	             // Allow: home, end, left, right, down, up
	            (e.keyCode >= 35 && e.keyCode <= 40)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });
		
		
		$("#"+targetId).focusout(function (e) {
			if(targetId != "lndWidth" && targetId != "lndHeight" && targetId != "lndArea"){
				$("#"+targetId).val(stock.comm.formatCurrency( $("#"+targetId).val() ));
			}
			
	    });
		
	};
	
	stock.comm.inputCurrencyByClass = function (parentId,targetClass){
		$(parentId).on('keydown', targetClass, function (e) {
		//$("."+targetClass).keydown(function (e) {
			
	        // Allow: backspace, delete, tab, escape, enter and .
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	             // Allow: Ctrl+A, Command+A
	            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
	             // Allow: home, end, left, right, down, up
	            (e.keyCode >= 35 && e.keyCode <= 40)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });
		
	};
	
	stock.comm.inputNumber = function (targetId){
		
		
		$("#"+targetId).keydown(function (e) {
	        // Allow: backspace, delete, tab, escape, enter and .
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
	             // Allow: Ctrl+A, Command+A
	            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
	             // Allow: home, end, left, right, down, up
	            (e.keyCode >= 35 && e.keyCode <= 40)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });
		
	};
	
	
	stock.comm.formatCurrency = function(val){
		if(stock.comm.nullToEmpty(val) == ""){
			return "";
		}
		val = stock.comm.nullToEmpty(val);
		val = val.toString().replace(/,/g, "");
		val = parseFloat(val);
		val = val.toString();
		val = val.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		
		/*
		value=val+"";
		value=val.replace(/,/g,"");
		var str = val.toString().split('.');
	    if (str[0].length >= 4) {
	        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
	    }
	    if (str[1] && str[1].length >= 4) {
	        str[1] = str[1].replace(/(\d{3})/g, '$1 ');
	    }
	    return str.join(',');
	    */
		
		return val;
	};
	
	stock.comm.formatDate = function(val){
		var dt="";
		value=val.toString();
		
		dt=val.substring(0,2)+"-"+val.substring(2,4)+"-"+val.substring(4,8);
		return dt;
	}
	
	
	stock.comm.alertMsg = function(val,id_focus,element_focus){
		$("#mdlAlert").css("border-radius","5px");
		$("#mdlAlert .modal-body").html("<p>"+val+"</p>");
		
		$("#mdlAlert").modal({ backdrop: 'static',keyboard: false });
		
		$('#mdlAlert').on('hidden.bs.modal', function (e) {
			
			var modalLeng = $('.modal').length;
			var chModal="f";
			for(var i=0; i < modalLeng; i++){
				if($('.modal').eq(i).css('display') != "none"){
					chModal = "t";
					break;
				}
			}
			if(chModal == "t"){
				$('body').addClass('modal-open');
			}
			if(id_focus != null && id_focus != undefined){
				$("#"+id_focus).focus();
			}
			if(element_focus != null && element_focus != undefined){
				element_focus.focus();
			}
			//$('body').addClass('modal-open');
		});
		
		var eqChk=$("div.modal-backdrop").length - 1;
		$("div.modal-backdrop").eq(eqChk).css("z-index","99998");
		$("div.modal-backdrop.show").eq(eqChk).css("opacity","0.2");
		
	}
	
	stock.comm.confirmMsg = function(val){
		
		$("#mdlConfirm .modal-body").html("<p>"+val+"</p>");
		$("#mdlConfirm").modal({ backdrop: 'static',keyboard: false });
		
		$('#mdlConfirm').on('hidden.bs.modal', function (e) {
			var modalLeng = $('.modal').length;
			var chModal="f";
			for(var i=0; i < modalLeng; i++){
				if($('.modal').eq(i).css('display') != "none"){
					chModal = "t";
					break;
				}
			}
			if(chModal == "t"){
				$('body').addClass('modal-open');
			}
		});
		
		var eqChk=$("div.modal-backdrop").length - 1;
		$("div.modal-backdrop").eq(eqChk).css("z-index","99998");
		$("div.modal-backdrop.show").eq(eqChk).css("opacity","0.2");
				
	}
	
	stock.comm.checkConfirmMsg = function(val){
		var chkBtn="";
		$("#btnConfirmCancel,#btnExitConfirm").click(function(e){
			$("#mdlConfirm").modal('hide');
			chkBtn="true";
		});
		$("#btnConfirmOk").click(function(e){
			$("#mdlConfirm").modal('hide');
			chkBtn="false";
		});
		return chkBtn; 
	}


	stock.comm.isNull = function(dat){
		 return dat==undefined||typeof(dat)==undefined||dat==null||(typeof(dat)=="string"&&$.trim(dat)=="");
	};
	
	stock.comm.nullToEmpty = function(val){
		if(val == "null" || val ==null || val == undefined || val == "undefined"){
			return "";
		}else{
			return val;
		}
		
	};


	stock.comm.renderYn = function(val){
		
		if(val =="Y"){
			return '<span class="label label-success lndStr" style ="background-color: #f0ad4e;color: white;padding: 2px;font-size: 11px;" data-val="Pay"> '+$.i18n.prop("lb_yes")+' </span>';
		}else{
			return '<span class="label label-warning lndStr" style ="background-color: #777;color: white;padding: 2px;font-size: 11px;" data-val="Wait">'+$.i18n.prop("lb_no")+'</span>';
		}
	};
	
	stock.comm.getComanyProfile = function(){
		var data =[];
		$.ajax({
			type: "POST",
			url: $("#base_url").val() +"User/selectCompanyData",
			dataType: 'json',
			async: false,
			success: function(res) {
				if (res){
					data= res.COM_REC;
				}else{
					console.log(data);
					stock.comm.alertMsg($.i18n.prop("msg_err"));
				}
				
			},
			error : function(data) {
				console.log(data);
	            stock.comm.alertMsg($.i18n.prop("msg_err"));
	        }
		});
		
		return data;
	};
	
	stock.comm.checkUserName = function(login_nm){
		var data=false;
		$.ajax({
			type: "POST",
			url: $("#base_url").val() +"User/checkUserName",
			dataType: 'json',
			async: false,
			data: {regLogNm: login_nm},
			success: function(res) {
				if (res){
					
					if(res.USER_REC.length >0){
						data = true;
					}else{
						data = false;
					}
					
				}
				
			},
			error : function(data) {
				console.log(data);
	            stock.comm.alertMsg($.i18n.prop("msg_err"));
	        }
		});
		
		
		return data;
	};
	
	
	stock.comm.getUserById = function(usr_id){
		var data=null;
		$.ajax({
			type: "POST",
			url: $("#base_url").val() +"User/select",
			dataType: 'json',
			async: false,
			data: {usrId: usr_id},
			success: function(res) {
				if (res){
					
					if(res.USER_REC.length >0){
						data = res.USER_REC;
					}else{
						data = null;
					}
					
				}
				
			},
			error : function(data) {
				console.log(data);
	            stock.comm.alertMsg($.i18n.prop("msg_err"));
	        }
		});
		
		
		return data;
	};
		
	/**
	 * 
	 */
	stock.comm.openPopUpForm = function(controller_nm, option, data, modal_size, id_popup, id_popup_content, id_iframe){
		var modalId= "";
		var popupContentId = "";
		var iframeId = "";
		if(id_popup != undefined && id_popup !="" && id_popup != null){
			modalId= id_popup;
			popupContentId = id_popup_content;
			iframeId = $("#"+id_iframe);
		}else{
			modalId = "modalMd";
			popupContentId = "modalMdContent";
			iframeId = parent.$("#ifameStockForm");
		}
		//
		if(modal_size !="" && modal_size !=null && modal_size != undefined){
			if(modal_size == "modal-sm" || modal_size == "modal-md" || modal_size == "modal-lg" ){
				parent.$("#"+modalId+" .modal-dialog").removeClass("modal-sm");
				parent.$("#"+modalId+" .modal-dialog").removeClass("modal-md");
				parent.$("#"+modalId+" .modal-dialog").removeClass("modal-lg");
				//
				parent.$("#"+modalId+" .modal-dialog").addClass(modal_size);
			}
		}
	    $("#loading").show();
		var dataUrl="";
		if(data !=null && data !="" && data != undefined){
			dataUrl="?"+data;
		}
		
		var iframe = iframeId;
	    iframe.attr("src", $("#base_url").val()+controller_nm+dataUrl); 
	    iframe.show();
	    parent.$("#"+modalId).modal({backdrop: "static"});
	    
	    parent.$("#"+modalId).removeClass();
	    parent.$("#"+modalId).addClass(controller_nm);
	    parent.$("#"+modalId).addClass("modal");
	    parent.$("#"+modalId).addClass("fade");
	    
	    parent.$("#"+popupContentId).css("height",option["height"]);
	    parent.$("#"+popupContentId).css("border-radius","5px");
	    iframe.css("border-radius","5px");
	    parent.$("#"+popupContentId).html(iframe);
	    
	};
	/**
	 * 
	 */ 
	stock.comm.closePopUpForm = function(class_name,callback,data){
	    $("."+class_name).modal("hide");
    	if (typeof callback === "function") {
    		callback(data);
    	}
	};
	
	/**
	 * 
	 */
	stock.comm.openPopUpSelect = function(controller_nm, option, data, modal_size, id_popup, id_popup_content, id_iframe){
		var modalId= "";
		var popupContentId = "";
		var iframeId;
		if(id_popup != undefined && id_popup !="" && id_popup != null){
			modalId= id_popup;
			popupContentId = id_popup_content;
			iframeId = parent.$("#"+id_iframe);
		}else{
			modalId = "modalMdSelect";
			popupContentId = "modalMdContentSelect";
			iframeId = parent.$("#ifameStockSelect");
		}
		
		if(modal_size !="" && modal_size !=null && modal_size != undefined){
			if(modal_size == "modal-sm" || modal_size == "modal-md" || modal_size == "modal-lg" ){
				parent.$("#"+modalId+" .modal-dialog").removeClass("modal-sm");
				parent.$("#"+modalId+" .modal-dialog").removeClass("modal-md");
				parent.$("#"+modalId+" .modal-dialog").removeClass("modal-lg");
				//
				parent.$("#"+modalId+" .modal-dialog").addClass(modal_size);
			}
		}
	    $("#loading").show();
		var dataUrl="";
		if(data !=null && data !="" && data != undefined){
			dataUrl="?"+data;
		}
		
		var iframe = iframeId;
	    iframe.attr("src", $("#base_url").val()+controller_nm+dataUrl); 
	    iframe.show();
	    parent.$("#"+modalId+"").modal({backdrop: "static"});
	    
	    parent.$("#"+modalId+"").removeClass();
	    parent.$("#"+modalId+"").addClass(controller_nm);
	    parent.$("#"+modalId+"").addClass("modal");
	    parent.$("#"+modalId+"").addClass("fade");
	    
	    parent.$("#"+popupContentId+"").css("height",option["height"]);
	    parent.$("#"+popupContentId+"").css("border-radius","5px");
	    iframe.css("border-radius","5px");
	    parent.$("#"+popupContentId+"").html(iframe);
	    
	};
	
    stock.comm.renderPaging = function(target_id, per_page, total_rec, page_no){
        $("#chkAllBranch").prop( "checked", false );
    	var numPaging = total_rec/per_page;
    	numPaging = parseInt(numPaging);
    	
    	var checkNumPaging = total_rec % per_page;
    	if(checkNumPaging != 0){
    	    numPaging=numPaging+1;
    	}
    	if(numPaging > 1){
        	$("#"+target_id).html("");
        	$("#"+target_id).show();
        	var checkDotPageNo=false;
        	var checkDrawPage=0;
        	$("#goToPage").remove();
        	//
        	if(numPaging >10){
    	    	var goHtml='<div id="goToPage" class="input-group input-group-sm pull-right" style="margin-left: 10px;    width: 80px;">';
                goHtml+='   <input type="text" class="form-control" id="txtGoToPage">';
                goHtml+='   <span class="input-group-btn">';
                goHtml+='   <button id="btnGoToPage" type="button" class="btn btn-primary btn-flat"><i class="fa fa-arrow-circle-right"></i></button>';
                goHtml+='   </span>';
                goHtml+='</div>'
            	$(goHtml).insertBefore("#"+target_id);
            	
            	stock.comm.inputNumber("txtGoToPage");
        	}
        	
        	//
        	if(page_no > numPaging){
        	    page_no =numPaging;
        	    return;
        	}else if(page_no <= 0){
        	    page_no = 1;
        	}else if(isNaN(page_no)){
        	    page_no = 1;
        	}
        	//
        	for(var i=1; i<=numPaging; i++){
        	    if(checkDrawPage==10){
        	        break;
        	    }
        	    var classActive="";
        	    if(page_no == i){
        	        classActive = "active";
        	    }
        	    var html="";
        	    
        	    if((numPaging > 10) && checkDrawPage >= 8){
    	            //add last page
    	            if(numPaging > (parseInt(page_no)+3)){
    	                html = "<li class='"+classActive+"'><a disabled style='cursor:default;pointer-events: none;' href='javascript:void(0)'>...</a></li>";
    	                checkDrawPage+=1;
    	            }
    	            
    	            html += "<li class='"+classActive+"' ><a href='javascript:void(0)'>"+numPaging+"</a></li>";
    	            checkDrawPage+=1;
    	            $("#"+target_id).append(html);
    	            break;
    	        }
        	    
        	    if(page_no > 6 && numPaging >10){
        	        if(i > 1 && i < (page_no - 3)){
        	            if(checkDotPageNo == false){
        	                checkDotPageNo = true
        	                html = "<li class='"+classActive+"'><a disabled style='cursor:default;pointer-events: none;' href='javascript:void(0)'>...</a></li>";
        	            
        	                checkDrawPage+=1;
        	            }
        	        }else{
        	            html = "<li class='"+classActive+"' ><a href='javascript:void(0)'>"+i+"</a></li>";
        	            checkDrawPage+=1;
        	        }
        	    }else{
    	            html = "<li class='"+classActive+"'><a href='javascript:void(0)'>"+i+"</a></li>";
    	            checkDrawPage+=1;
        	    }
        	    
        	    $("#"+target_id).append(html);
        	}
        	
    	}else{
    	    $("#"+target_id).hide();
    	    $("#goToPage").remove();
    	}
    	
    };
    
    stock.comm.checkAllTblChk = function(chk_id, tbl_id, class_tocheck){
    	
        $("#"+chk_id).prop( "checked", false );
        
        $("#"+chk_id).click(function(e){
            if($("#"+chk_id).is(":checked")){
                $("#"+tbl_id+" tbody ."+class_tocheck+" input[type=checkbox]").prop( "checked", true );
                $("#"+tbl_id+" tbody tr").css("background-color","#f4f4f4");
            }else{
                $("#"+tbl_id+" tbody ."+class_tocheck+" input[type=checkbox]").prop( "checked", false );
                $("#"+tbl_id+" tbody tr").removeAttr("style");
            }
        });
        $("#"+tbl_id+" tbody").on("click", "."+class_tocheck+" input[type=checkbox]", function(e) {
            if($("#"+tbl_id+" tbody ."+class_tocheck+" input[type=checkbox]").length == $("#"+tbl_id+" tbody ."+class_tocheck+" input[type=checkbox]:checked").length){
                $("#"+chk_id).prop( "checked", true );
            }else{
                $("#"+chk_id).prop( "checked", false );
            }
            //
            if($(this).is(":checked")){
            	$(this).parent().parent().css("background-color","#f4f4f4");
            }else{
            	$(this).parent().parent().removeAttr("style");
            }
        });
      
        
    };  
	
	/**
	 * 
	 */
    stock.comm.getBrnachType = function(target_id){
    	$.ajax({
    		type: "POST",
    		url: $("#base_url").val() +"Branch/getBranchType",
    		dataType: 'json',
    		async: false,
    		success: function(res) {
    			if(res.OUT_REC.length > 0){
    				$("#"+target_id+" option").remove();
    				for(var i=0; i<res.OUT_REC.length; i++){
    					var braNm = (getCookie("lang") == "kh" ? res.OUT_REC[i]["bra_nm_kh"] : res.OUT_REC[i]["bra_nm"]);
    					$("#"+target_id).append("<option value='"+res.OUT_REC[i]["bra_type_id"]+"'>"+braNm+"</option>");
    				}
    				
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
    };
    

	/**
	 * 
	 */
    stock.comm.getBrnachSelect = function(target_id){
    	$.ajax({
    		type: "POST",
    		url: $("#base_url").val() +"Branch/getBranch",
    		dataType: 'json',
    		async: false,
    		success: function(res) {
    			if(res.OUT_REC.length > 0){
    				$("#"+target_id+" option").remove();
    				for(var i=0; i<res.OUT_REC.length; i++){
    					var braNm = (getCookie("lang") == "kh" ? res.OUT_REC[i]["bra_nm_kh"] : res.OUT_REC[i]["bra_nm"]);
    					$("#"+target_id).append("<option value='"+res.OUT_REC[i]["bra_id"]+"'>"+braNm+"</option>");
    				}
    				
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
    };
    
    /**
     *
     */
    stock.comm.getPositionSelect = function(target_id){
    	$.ajax({
    		type: "POST",
    		url: $("#base_url").val() +"Position/getPositionData",
    		dataType: 'json',
    		async: false,
    		success: function(res) {
    			if(res.OUT_REC.length > 0){
    				$("#"+target_id+" option").remove();
    				for(var i=0; i<res.OUT_REC.length; i++){
    					var braNm = (getCookie("lang") == "kh" ? res.OUT_REC[i]["pos_nm_kh"] : res.OUT_REC[i]["pos_nm"]);
    					$("#"+target_id).append("<option value='"+res.OUT_REC[i]["pos_id"]+"'>"+braNm+"</option>");
    				}
    				
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
    };
    
