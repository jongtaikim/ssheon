<!DOCTYPE html>
<html>
<head>
<title>수수헌 관리자 페이지 - 잇컴퍼니</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="user-scalable=yes, maximum-scale=1.0, minimum-scale=0.2, width=1400" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?=ADMIN_CSS_DIR?>/validationEngine.jquery.css?20151118" />
	<link rel="stylesheet" type="text/css" href="<?=ADMIN_CSS_DIR?>/default.css?20151118" />

	<script src="<?=ADMIN_JS_DIR?>/jquery-1.11.1.min.js"></script>
	<script src="<?=ADMIN_JS_DIR?>/jquery-ui-1.9.2.custom.js"></script>      
	<script src="<?=ADMIN_JS_DIR?>/jquery.validationEngine-kr.js"></script>
	<script src="<?=ADMIN_JS_DIR?>/jquery.validationEngine.js"></script>     
	<script src="<?=ADMIN_JS_DIR?>/common.js"></script>      
	
</head>
<body>

<div class="layout-wrapper">
	<div class="layout-header">
		<div class="area-logo">
			<!--img src="<?=ADMIN_IMG_DIR?>/layout/logo_top.png" style="width:100px;" onclick="loginwritesubmit();" style="cursor:pointer;"-->
			&nbsp;
		</div>
		<ul class="nav" style="cursor: pointer;">
			<li class="<?=($this->left=='left1')?'selected':''?>" style="width:120px;"><a href="/admin/member/index"  class="top-menu"  >관리자 정보</a></li>
			<li class="<?=($this->left=='left2')?'selected':''?>" style="width:120px;"><a href="/admin/board/lists/notice"  class="top-menu"  >공지게시판</a></li>
			<li class="<?=($this->left=='left3')?'selected':''?>" style="width:120px;"><a href="/admin/calendar/index"  class="top-menu"  >예약관리</a></li>

		</ul>
		<!-- 비밀번호변경:S -->
		<div style="float: right; text-align: right; margin-right: 20px; padding-top: 15px; cursor: pointer;padding-left:10px">
			<button class="btn btn-theme-darkgr" onclick="location.href='/admin/login/logout'">로그아웃</button>&nbsp;
		</div>
		<!-- 비밀번호변경:E -->
		<div style=" text-align: right; margin-right: 4px; padding-top: 15px;">
			<span style="color: #fff;">&nbsp;<?=$this->session->userdata('ss_name')?>님 환영합니다.</span>
		</div>
	</div>
	<div class="layout-center">
		<div class="row">
			<div class="layout-west">
			{left}
				<style>
				ul.left-func li {
					margin-bottom:3px;
				}
				ul.left-func li button{
					width:130px;
					height:40px;
					text-align:left;
				}
				ul.left-func li button span, ul.left-func li button i{
					font-size:14px;
				}
				ul.left-func li button i {
					margin-right:5px;
				}
				</style>
				<div style="padding: 10px; vertical-align: bottom; position: fixed; bottom: 20px; clear: both; cursor: pointer">
					<ul class="left-func">
						<li><button class="btn btn-gray" onclick="window.open('/')"><i class="fa fa-undo"></i> <span>홈페이지</span></button></li>
					</ul>
				</div>
			</div><!--layout-west-->
			<div class="layout-east">
				<div class="area-body" >
				{yield}
				</div>
			</div>		
		</div>
	</div>
</div>

</body>
</html>