<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=11"/>
<meta name="viewport" content="width=device-width, initial-scale=0.3, maximum-scale=0.5, minimum-scale=0.3, user-scalable=yes, target-densitydpi=medium-dpi">
<? if ( $_SERVER['PHP_SELF'] =="/index.php" ) : ?>
<link rel="stylesheet" href="<?=FRONT_CSS_DIR?>/main.css" type="text/css" media="screen" />
<? else:?>
<link rel="stylesheet" href="<?=FRONT_CSS_DIR?>/sub.css" type="text/css" media="screen" />
<? endif;?>

<link rel="stylesheet" href="<?=FRONT_CSS_DIR?>/default.css" type="text/css" media="screen" />

<script src="<?=ADMIN_JS_DIR?>/jquery-1.11.1.min.js"></script>
<script src="<?=ADMIN_JS_DIR?>/jquery-ui-1.9.2.custom.js"></script>      
<script src="<?=FRONT_JS_DIR?>/common.js"></script>  


<title>수수헌</title>
</head>

<style>

.modal {
	position: fixed;
	z-index: 1040;
}

.modal-content {
		background-color: #ffffff;
		border: 1px solid #C3C3C3;
		min-width: 300px;
		border-radius: 2px;
}


.modal-header {
		background-color:#ffffff;
		padding: 10px 10px;
		border-bottom:solid 1px #C3C3C3;
}

.modal-header > .modal-title {
	font-family: "NG";
	font-size: 14px;
	color:#414141;
	font-weight: normal;
	/*height: 25px;*/
	margin: 0;
}

.modal-header > .modal-close {
		position: absolute;
		right: 10px;
		top: 8px;
		color:#8BC34A;
		font-size:18px;
		background:transparent;
		border-color:transparent;
}
.modal-header > .modal-close:hover { color:#558B2F; }

.modal-body {
		max-height: 700px;
		overflow-y: auto;
		padding: 10px 20px;
}

.modal-backdrop {
		background-color: #000000;
		bottom: 0;
		display: none;
		left: 0;
		opacity: 0.3;
		position: fixed;
		right: 0;
		top: 0;
		z-index: 1030;
}


</style>
<script type="text/javascript">
<!--
    $(document).ready(function(){
        $(".depth1 > li").mouseover(function(){

				var index = $("li").index(this) ;



				$("#gnb").mouseover(function(){

					$(".main_top_05").hide();
					$(".main_top_06").hide();
					$(".main_top_07").hide();
					$(".main_top_08").hide();
					$(".main_top_09").hide();
					$(".main_top_010").hide();

					$(".main_top_0"+index).show();

						$(".main_top_0"+index).mouseover(function(){

							$(".main_top_0"+index).show();
						}).mouseout(function(){

						});

				}).mouseout(function(){
						$(".main_top_05").hide();
						$(".main_top_06").hide();
						$(".main_top_07").hide();
						$(".main_top_08").hide();
						$(".main_top_09").hide();
						$(".main_top_010").hide();
				});

		});	

        $("#sub_lnbss").mouseover(function(){
				$(".main_top_05").hide();
				$(".main_top_06").hide();
				$(".main_top_07").hide();
				$(".main_top_08").hide();
				$(".main_top_09").hide();
				$(".main_top_010").hide();
		});	


	});	
	
//-->
</script>
</style>
<body>
<div id="wrap">
	<!--gnb-->
    <div id="headerwrap">
        <div id="header">
            <div id="logo"><a href="/"><img src="<?=FRONT_IMG_DIR?>/logo.png"></a>
            	<div class="top">
                	<ul>
                    	<li><a href="/"><img src="<?=FRONT_IMG_DIR?>/top_home.png"></a></li>
                        <li><img src="<?=FRONT_IMG_DIR?>/top_dot.png"></li>
                        <li><a href="JavaScript:window.external.AddFavorite('http://dev.mytest.com/ssh/','수수헌')"><img src="<?=FRONT_IMG_DIR?>/top_fav.png"></a></li>
                        <li><img src="<?=FRONT_IMG_DIR?>/top_dot.png"></li>
                        <li><a href="/admin/login"><img src="<?=FRONT_IMG_DIR?>/top_adm.png"></a></li>
                    </ul>
                </div>
            </div>
            <div id="gnb">
                <ul class="depth1">
                    <li><img src="<?=FRONT_IMG_DIR?>/gnb_01.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/gnb_01_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/gnb_01.png'" onclick="go_url('/front/sub/ssheon');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/gnb_02.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/gnb_02_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/gnb_02.png'" onclick="go_url('/front/sub/extarior');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/gnb_03.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/gnb_03_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/gnb_03.png'" onclick="go_url('/front/sub/bbq');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/gnb_04.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/gnb_04_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/gnb_04.png'" onclick="go_url('/front/sub/tea');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/gnb_05.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/gnb_05_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/gnb_05.png'" onclick="go_url('/front/reserve/index');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/gnb_06.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/gnb_06_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/gnb_06.png'" onclick="go_url('/front/board/lists/notice');"></li>
                </ul>
            </div>
            <div id="lnb" class="main_top_05" style="display:none" >
                <ul class="depth2_01" >
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_01.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_01_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_01.png'" onclick="go_url('/front/sub/ssheon');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_bar.png"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_02.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_02_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_02.png'" onclick="go_url('/front/sub/location');"></li>
                </ul>
            </div>
            <div id="lnb" class="main_top_06"  style="display:none">
                <ul id="main_top_06"  class="depth2_02">
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_03.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_03_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_03.png'" onclick="go_url('/front/sub/extarior');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_bar.png"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_04.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_04_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_04.png'" onclick="go_url('/front/sub/room');"></li>
                </ul>
            </div>
            <div id="lnb" class="main_top_07"  style="display:none">
                <ul class="depth2_03">
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_05.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_05_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_05.png'" onclick="go_url('/front/sub/bbq');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_bar.png"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_06.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_06_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_06.png'" onclick="go_url('/front/sub/campfire');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_bar.png"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_07.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_07_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_07.png'" onclick="go_url('/front/sub/outdoor');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_bar.png"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_08.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_08_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_08.png'" onclick="go_url('/front/sub/presentation');"></li>
                </ul>
            </div>
            <div id="lnb" class="main_top_08"  style="display:none">
                <ul class="depth2_04" >
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_09.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_09_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_09.png'" onclick="go_url('/front/sub/tea');"></li>
                </ul>
            </div>
            <div id="lnb" class="main_top_09"  style="display:none">
                <ul class="depth2_05">
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_12.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_12_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_12.png'" onclick="go_url('/front/reserve/index');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_bar.png"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_13.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_13_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_13.png'" onclick="go_url('/front/sub/guide');"></li>
                </ul>
            </div>
            <div id="lnb" class="main_top_010"  style="display:none">
                <ul class="depth2_06">
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_14.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_14_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_14.png'" onclick="go_url('/front/board/lists/notice');"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_bar.png"></li>
                    <li><img src="<?=FRONT_IMG_DIR?>/lnb_15.png" onmouseover="this.src='<?=FRONT_IMG_DIR?>/lnb_15_on.png'" onmouseout="this.src='<?=FRONT_IMG_DIR?>/lnb_15.png'" onclick="go_url('/front/main/faq');"></li>
                </ul>
            </div>

        </div>

		<div id="sub_lnbss" style="position:relative; top:45px; right:0; width:100%; height:13px;z-index:2000;" ></div>			

    </div> 

	<!--gnb-->
    <div id="container">
		{yield}
    </div> 

	<!--sitemap-->
	<div class="sitemapwrap">
    	<div class="sitemap">
        <ul>
        	<li class="sitemap_tt"><img src="<?=FRONT_IMG_DIR?>/sitemap_tt_01.png"></li>
            <li><a href="/front/sub/ssheon"><img src="<?=FRONT_IMG_DIR?>/sitemap_01_1.png"></a></li>
            <li><a href="/front/sub/location"><img src="<?=FRONT_IMG_DIR?>/sitemap_01_2.png"></a></li>
        </ul>
        <ul>
        	<li class="sitemap_tt"><img src="<?=FRONT_IMG_DIR?>/sitemap_tt_02.png"></li>
            <li><a href="/front/sub/extarior"><img src="<?=FRONT_IMG_DIR?>/sitemap_02_1.png"></a></li>
            <li><a href="/front/sub/room"><img src="<?=FRONT_IMG_DIR?>/sitemap_02_2.png"></a></li>
        </ul>
		
        <ul>
        	<li class="sitemap_tt"  ><img src="<?=FRONT_IMG_DIR?>/sitemap_tt_03.png"></li>
            <li><a href="/front/sub/bbq"><img src="<?=FRONT_IMG_DIR?>/sitemap_03_1.png"></a></li>
            <li><a href="/front/sub/campfire"><img src="<?=FRONT_IMG_DIR?>/sitemap_03_2.png"></a></li>
            <li><a href="/front/sub/outdoor"><img src="<?=FRONT_IMG_DIR?>/sitemap_03_3.png"></a></li>
            <li><a href="/front/sub/presentation"><img src="<?=FRONT_IMG_DIR?>/sitemap_03_4.png"></a></li>
        </ul>
        <ul>
        	<li class="sitemap_tt"><img src="<?=FRONT_IMG_DIR?>/sitemap_tt_04.png"></li>
            <li><a href="/front/sub/tea"><img src="<?=FRONT_IMG_DIR?>/sitemap_04_1.png"></a></li>
            <!--li><a href="#"><img src="<?=FRONT_IMG_DIR?>/sitemap_04_2.png"></a></li>
            <li><a href="#"><img src="<?=FRONT_IMG_DIR?>/sitemap_04_3.png"></a></li-->
        </ul>
        <ul>
        	<li class="sitemap_tt"><img src="<?=FRONT_IMG_DIR?>/sitemap_tt_05.png"></li>
            <li><a href="/front/reserve/index"><img src="<?=FRONT_IMG_DIR?>/sitemap_05_1.png"></a></li>
            <li><a href="/front/sub/guide"><img src="<?=FRONT_IMG_DIR?>/sitemap_05_2.png"></a></li>
        </ul>
        <ul>
        	<li class="sitemap_tt"><img src="<?=FRONT_IMG_DIR?>/sitemap_tt_06.png"></li>
            <li><a href="/front/board/lists/notice"><img src="<?=FRONT_IMG_DIR?>/sitemap_06_1.png"></a></li>
            <li><a href="/front/main/faq"><img src="<?=FRONT_IMG_DIR?>/sitemap_06_2.png"></a></li>
        </ul>
        </div>
    </div>   
	<!--sitemap-->

	<!--foot-->
	<div id="footerwrap"> 
		<div id="footer">
			<div class="address"><img src="<?=FRONT_IMG_DIR?>/footer_copy.png"></div>
			<div class="icon">
				<ul>
					<li><a href="https://www.facebook.com/%EC%88%98%EC%88%98%ED%97%8C-%E7%A7%80%E6%B0%B4%E8%BD%A9-1718326325081043/" target="_blank"><img src="<?=FRONT_IMG_DIR?>/footer_icon_01.png"></a></li>
					<li><img src="<?=FRONT_IMG_DIR?>/footer_icon_02.png"></li>
					<li><a href="http://plus.kakao.com/home/@수수헌" target="_blank"><img src="<?=FRONT_IMG_DIR?>/footer_icon_03.png"></a></li>
				</ul>
			</div>
		</div>
	</div>
	<!--foot-->	 
</div>

</body>
</html>
