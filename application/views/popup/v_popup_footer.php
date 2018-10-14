

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

$(document).ready(function() {
    parent.$("#loading").show();
	/* onload */
	//
	checkCookieLang();
	//
			
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
    		$("#langDrop").html('<img style="width: 28px;" alt="" src="'+$("#base_url").val()+'assets/image/khmer.png"/>&nbsp;ភាសាខ្មែរ');
    		$("#langDrop").attr("data-lng","kh");
			/* 
    		$("body .form-control").css("font-size","14px");
    		$("body .form-control-sm").css("font-size","13px");
    		 */
        }else{
        	$("#langDrop").html('<img style="width: 28px;" alt="" src="'+$("#base_url").val()+'assets/image/english.png"/>&nbsp;English');
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
    	$("body .form-control-sm").css("font-size","13px");
    	lang="kh";
    	changeLang("kh");
    	$("#langDrop").attr("data-lng","kh");
    	
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


</script>



</body>
</html>