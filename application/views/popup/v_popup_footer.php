

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/') ?>bower_components/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- daterangepicker -->
<script src="<?php echo base_url('assets/') ?>bower_components/moment/min/moment.min.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url('assets/') ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/') ?>dist/js/adminlte.min.js"></script>

<!-- fullCalendar -->
<script src="<?php echo base_url('assets/') ?>bower_components/moment/moment.js"></script>
<script src="<?php echo base_url('assets/') ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

<!--Multi language  -->
<script src="<?php echo base_url('assets/') ?>lib/jquery.i18n.properties-min.js"></script>
<script src="<?php echo base_url('assets/') ?>js/comm/stock.comm.js"></script>
<script type="text/javascript">
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

//parseInt($("#divFilterSrch").css("height"))
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity($.i18n.prop("msg_err_null"));
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
});


//Date for the calendar events (dummy data)
var date = new Date()
var d    = date.getDate(),
    m    = date.getMonth(),
    y    = date.getFullYear()
$('#adminCalendar').fullCalendar({
  disableDragging: true,
  eventStartEditable: false,
  header    : {
    left  : 'prev,next today',
    center: 'title',
    right : ''
  },
  buttonText: {
    today: 'today',
    month: 'month',
    week : 'week',
    day  : 'day'
  },
  //Random default events
  events    : [
    {
      title          : 'All Day Event',
      start          : new Date(y, m, 1),
      backgroundColor: '#f56954', //red
      borderColor    : '#f56954' //red
    },
    {
      title          : 'Long Event',
      start          : new Date(y, m, d - 5),
      end            : new Date(y, m, d - 2),
      backgroundColor: '#f39c12', //yellow
      borderColor    : '#f39c12' //yellow
    },
    {
      title          : 'Meeting',
      start          : new Date(y, m, d, 10, 30),
      allDay         : false,
      backgroundColor: '#0073b7', //Blue
      borderColor    : '#0073b7' //Blue
    },
    {
      title          : 'Lunch',
      start          : new Date(y, m, d, 12, 0),
      end            : new Date(y, m, d, 14, 0),
      allDay         : false,
      backgroundColor: '#00c0ef', //Info (aqua)
      borderColor    : '#00c0ef' //Info (aqua)
    },
    {
      title          : 'Birthday Party',
      start          : new Date(y, m, d + 1, 19, 0),
      end            : new Date(y, m, d + 1, 22, 30),
      allDay         : false,
      backgroundColor: '#00a65a', //Success (green)
      borderColor    : '#00a65a' //Success (green)
    },
    {
      title          : 'Click for Google',
      start          : new Date(y, m, 28),
      end            : new Date(y, m, 29),
      url            : 'http://google.com/',
      backgroundColor: '#3c8dbc', //Primary (light-blue)
      borderColor    : '#3c8dbc' //Primary (light-blue)
    }
  ],
  editable  : true,
  droppable : true, // this allows things to be dropped onto the calendar !!!
  drop      : function (date, allDay) { // this function is called when something is dropped

    // retrieve the dropped element's stored Event Object
    var originalEventObject = $(this).data('eventObject')

    // we need to copy it, so that multiple events don't have a reference to the same object
    var copiedEventObject = $.extend({}, originalEventObject)

    // assign it the date that was reported
    copiedEventObject.start           = date
    copiedEventObject.allDay          = allDay
    copiedEventObject.backgroundColor = $(this).css('background-color')
    copiedEventObject.borderColor     = $(this).css('border-color')

    // render the event on the calendar
    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
    $('#adminCalendar').fullCalendar('renderEvent', copiedEventObject, true)

  }


  	

  
});

$(document).ready(function() {


	/* onload */
	
	//render menu for user
	getUserMenu();
	
	//
	checkCookieLang();
	//
	
	/*  */
	
	
	$("#langDropSelect a").click(function(e){
		$('#loading').show();
		//$("#langDrop").html($(this).html());
		var lang="";
		if($(this).attr("id") =="langKh"){
			lang="kh";
		}else{
			lang="en";
		}
		//changeLang(lang);
		setCookie("lang", lang, 100);
		window.location.reload();
	});

	$(".box-search .box-header h3").click(function(e){
		$(".box-search .box-body").slideToggle(500,function(){
			$(".form-control").eq(0).focus();
			if($(".box-search .box-body").css("display") == "block"){
				$(".box-search .box-header i").removeClass("fa-search-plus");
				$(".box-search .box-header i").addClass("fa-search");
			}else{
				$(".box-search .box-header i").removeClass("fa-search");
				$(".box-search .box-header i").addClass("fa-search-plus");
			}
		});
		
	});	
		
});

function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookieLang(){
    var lang=getCookie("lang");

    if (lang != "") {
    	changeLang(lang);
    	if(lang =="kh"){
    		/* $("body").css("font-family","Source Sans Pro,Helvetica Neue,Helvetica,Arial,sans-serif,Khmer Os Battambang");
    		$("body").css("font-size","14px");
    		*/
    		$("#langDrop").html('<img style="width: 28px;" alt="" src="'+$("#base_url").val()+'assets/image/khmer.png"/>');
    		$("#langDrop").attr("data-lng","kh");
    		$("body").css("font-size","14px");
	    	$("body .form-control").css("font-size","14px");
	    	$("body .input-sm").css("font-size","13px");
	    	$("body .form-control-sm").css("font-size","13px");
			/* 
    		$("body .form-control").css("font-size","14px");
    		$("body .form-control-sm").css("font-size","13px");
    		 */
        }else{
        	$("#langDrop").html('<img style="width: 28px;" alt="" src="'+$("#base_url").val()+'assets/image/english.png"/>');
        	$("#langDrop").attr("data-lng","en");
			/* 
        	$("body").css("font-family","Source Sans Pro,Helvetica Neue,Helvetica,Arial,sans-serif,Khmer Os Battambang");
        	$("body").css("font-size","14px");

        	$("body .form-control").css("font-size","14px");
        	$("body .form-control-sm").css("font-size","13px"); */
        }
    }else{
    	$("body").css("font-family","Source Sans Pro,Helvetica Neue,Helvetica,Arial,sans-serif,Khmer Os Battambang");
    	$("body").css("font-size","14px");
    	$("body .form-control").css("font-size","14px");
    	$("body .input-sm").css("font-size","13px");
    	$("body .form-control-sm").css("font-size","13px");
    	lang="en";
    	changeLang("en");
    	$("#langDrop").attr("data-lng","en");
    	$("#langDrop").html('<img style="width: 28px;" alt="" src="'+$("#base_url").val()+'assets/image/english.png"/>');
    }
	

    $("#main-top").show();
    
}

function changeLang(lang) {
    jQuery.i18n.properties({
        name: 'Messages',
        path: $("#base_url").val()+'assets/msg/',
        mode: 'both',
        language: lang,
        async: true,
        callback: function () {
        	setAllBody("body", $.i18n.prop);
        	//
            $('#loading').hide();	
        }
    });


    //
    var eleTarget=$("input[type='text'],input[type='email'], input[type='password'], textarea").not(":disabled");
    var eleTargetDis=$("input[type='text'],input[type='email'], input[type='password'], textarea").not(":enabled");

    eleTargetDis.attr("placeholder","");
    
	var holdLang="";
	
	if(lang=="kh"){
		holdLang="បញ្ជូល ";
	}else{
		holdLang="Enter ";
	}
    eleTarget.each(function(i){
      
		var labelTxt = $("label[for='"+$(this).attr("id")+"']").eq(0).html();
		if(labelTxt != null && labelTxt !="" && labelTxt != undefined){
			labelTxt=labelTxt;
		}else{
			labelTxt="";
		}
    	$(this).attr("placeholder",holdLang+labelTxt);
		
		
	});
	
}

/*
 * selector 안에 있는 모든 id 값에 프로퍼티값을 맵핑
 */
function setAllBody(selector, dat) {
    $.each($(selector).find("[data-i18nCd]"),function() {
        var o = $(this).attr("data-i18nCd");
      
        if (isNull(o)) return true;
        var d = dat(o);
        if($(this).attr("data-i18nMsg")) d = eval($(this).attr("data-i18nCd"))($(this).attr("data-i18nMsg"));
        if (d.indexOf("[") > -1) return true;
        if (d!=undefined)  $(this).html(d);
        //if (d!=undefined)  $(this).val(d);
    });
    return this;
}
/*
 * Null 인지 체크
 */
function isNull(dat) {
    return dat==undefined||typeof(dat)==undefined||dat==null||(typeof(dat)=="string"&&$.trim(dat)=="");
}


function getUserMenu(){
	$.ajax({
		type: "POST",
		url: $("#base_url").val() +"Menu/getMenuUser",
		dataType: 'json',
		async: false,
		success: function(res) {
			$("#divMenu").html("");
			var checkPreant1= false;
			var checkPreant2= false
			for(var i=0; i<res["menu_user"].length; i++){
				
				var datarow = res["menu_user"][i];
				//-- fix data to add parent menu
				if(datarow["menu_group"] == "1" && checkPreant1 == false){
					$("#divMenu").append('<li class="header">MAIN NAVIGATION</li>');
					checkPreant1 = true;
				}
				//-- fix data to add parent menu
				if(datarow["menu_group"] == "2" && checkPreant2 == false){
					$("#divMenu").append('<li class="header">PRODUCT NAVIGATION</li>');
					checkPreant2 = true;
				}
				var menuNm = (getCookie("lang") == "kh" ? datarow["menu_nm_kh"] : datarow["menu_nm"]);
				var menuActiveId = $("#menu_active").val();
				var activeClass="";
				var styleFont="font-weight: 500;";
				if(menuActiveId == datarow["menu_nm"]){
					activeClass = "active";
					styleFont="font-weight: 600;";
				}
				var htmlMenu = '<li class="'+activeClass+'">';
				htmlMenu += '<a style="'+styleFont+'" href="'+datarow["menu_nm"]+'">';
				htmlMenu += '<i class="'+datarow["menu_icon_nm"]+'"></i> <span>'+menuNm+'</span>';
				htmlMenu += '</a>';
				htmlMenu += '</li>';

				$("#divMenu").append(htmlMenu);
			}
			
		},
		error : function(data) {
			console.log(data);
			stock.comm.alertMsg($.i18n.prop("msg_err"));
        }
	});
}

</script>




</body>
</html>