<!DOCTYPE html>
<html>
<head>
<title><?=ADMIN_TITLE?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" media="screen" href="<?=ADMIN_CSS_DIR?>/validationEngine.jquery.css"></link>
<script src="<?=ADMIN_JS_DIR?>/jquery-1.11.1.min.js"></script>
<script src="<?=ADMIN_JS_DIR?>/jquery.validationEngine-kr.js"></script>
<script src="<?=ADMIN_JS_DIR?>/jquery.validationEngine.js"></script>

</head>
<body>

<style>

body {
	background-color: #f1f1f1;
	margin: 0;
	padding: 0;
}

a img {
	border: 0;
}

button {
	width: 95px;
	height: 77px;
	border: 0px;
	cursor: pointer;
}

ul, li {
	list-style: none;
	border: 0
}

.userid {
	border: 1px solid #ccc;
	background-color: #fff;
	color: #666;
	height: 32px;
	margin-top: 9px;
	padding: 0 5px 0 5px;
	width: 220px;
}

.password {
	border: 1px solid #ccc;
	background-color: #fff;
	color: #666;
	height: 32px;
	width: 220px;
	margin-top: 9px;
	padding: 0 5px 0 5px;
}

.submit {
	width: 95px;
	height: 77px;
	top: 25px;
	right: 0px;
	position: absolute;
	left: 290px;
}

#login-footer {
	border-top: 2px solid #333;
	width: 100%;
	height: 70px;
	position: absolute;
	bottom: 0px;
	text-align: center;
	clear: both;
}


#login-footer  img {
	margin-top: 10px;
	width: 400px;
	height: 42px;
}

#login-area {
width: 640px; margin: auto; height: 100px; padding-top: 20%;
}
</style>
<script>
	$(document).ready(function() {
        $("#login-frm :input").keypress(function(){
            if (event.keyCode == 13) {
            	login();
            }
        });
	});

	function login() {
	
		if ($("#user_id").val() == "" || $("#passwd").val() == "") {			
			 $("#alert-msg").html("아이디와 비밀번호를 모두 입력해주세요.");
			 $("#msg").fadeIn();
			return false;
		}

		var data = $("#login-frm").serialize();
	    var url = "/admin/login/login_process";

		$.ajax({
			type : "POST",
			url : url,
			data : data,
			success : function(result_data) {
				var obj = $.parseJSON(result_data);

				if (obj.is_valid == "1") {
					document.location = "/admin/member/index";
				} else {
					$("#alert-msg").html("로그인 정보가 정확하지 않습니다.");
					$("#msg").fadeIn();
				}
			}
		});
	}
	
	function add_favorites(url, title){
		var url = "http://"+url;
		if(document.all){ // IE
			window.external.AddFavorite(url, title);
		}else if(window.chrome){ // Google Chrome
			alert("Ctrl+D키를 누르시면 즐겨찾기에 추가하실 수 있습니다.");
		}else if (window.sidebar && window.sidebar.addPanel){ // Firefox
			window.sidebar.addPanel(title, url,"");
		}else{			
			window.external.AddFavorite(url, title);			
			return ;
			// Opera
			var elem = document.createElement('a'); 
			elem.setAttribute('href',url); 
			elem.setAttribute('title',title); 
			elem.setAttribute('rel','sidebar'); 
			elem.click(); 
		}		
	}

</script>
<div id="login-area">
	<!--div class="logo" style="float: left;margin-top:32px;">
		<img src="<?=ADMIN_IMG_DIR?>/layout/login_logo.png">
	</div-->
	<div style="float: left; position: relative;left:100px;">
	<form id="login-frm">
		<ul>
			<li><input type="text" name="user_id" id="user_id" class="userid validate[required]" placeholder="아이디"/></li>
			<li><input type="password" name="passwd" id="passwd" class="password validate[required]" placeholder="비밀번호"/></li>
			<li class="submit"><button type="button" style="background-image: url(<?=ADMIN_IMG_DIR?>/layout/login_btn.gif);" onClick="login();"></button></li>
			<!--li style="text-align: left;padding-top: 10px;"> <a href="#" onClick="add_favorites('<?=$_SERVER['SERVER_NAME']?>', '<?=ADMIN_TITLE?>');"><img src="<?=ADMIN_IMG_DIR?>/layout/btn_02.gif"></a></li-->
			<li id="msg" style="font-size: 11px;display: none;padding-top: 15px;">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
				<!--strong>Alert:</strong--> <span id="alert-msg"></span></p>
			</div>
			</li>
		</ul>		
		</form>
	</div>
</div>

</body>
</html>