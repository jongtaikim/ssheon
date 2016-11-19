<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=9"/>
        <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=0.8, user-scalable=no">
        <meta name="theme-color" content="">

        <script src="/asset/admin/js/jquery-1.11.1.min.js"></script>
        <script src="/asset/admin/js/jquery-ui-1.9.2.custom.js"></script>
        <script src="/asset/admin/js/jquery.validationEngine-kr.js"></script>
        <script src="/asset/admin/js/jquery.validationEngine.js"></script>
        <link rel="stylesheet" href="/asset/animate.css/animate.css" type="text/css" />
        <link rel="stylesheet" href="/asset/font-awesome/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="/asset/bootstrap-4.0.0-alpha.5-dist/css/bootstrap.css" type="text/css" />


        <link rel="stylesheet" href="/asset/styles/app.css" type="text/css" />
        <link rel="stylesheet" href="/asset/styles/now_to.css" type="text/css" />

        <link rel="stylesheet" href="/asset/libs/jquery/select2/dist/css/select2.min.css" type="text/css" />
        <link rel="stylesheet" href="/asset/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="/asset/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.4.css" type="text/css" />

        {? MAIN}
        <link rel="stylesheet" href="/mobile/views/css/main.css?v=1" type="text/css" media="screen" />
        {:}
        <link rel="stylesheet" href="/mobile/views/css/sub.css" type="text/css" media="screen" />
        {/}

        <link rel="stylesheet" href="/mobile/views/css/default.css" type="text/css" media="screen" />

        <title>수수헌</title>
    </head>
    <body>


    <div class="autoheight modal-backdrop opa20" id="backd" ></div>
    <div id="wrap">
        <div id="header" class="">
            <!-- top -->
            <div id="top">
                <div class="top">
                    <div class="logo"><a href="/"><img src="/mobile/views/images/logo.png"></a></div>
                    <div class="menu" id="menu_btn"><a href="javascript:$('#toggle').fadeIn(200);$('#menu_btn').hide()"><img src="/mobile/views/images/btn_toggle.png"></a></div>
                </div>
            </div>
            <!-- top E -->
            <!-- 메인슬라이드 -->
            {? MAIN}
            <!-- 메인슬라이드 -->

            <div id="slide" class="carousel    slide"  data-ride="carousel">
                <ol class="carousel-indicators wow fadeInUp" data-wow-delay="1.5s">
                    <li data-target="#slide" data-slide-to="0" class="active"></li>
                    <li data-target="#slide" data-slide-to="1"></li>
                    <li data-target="#slide" data-slide-to="2"></li>
                </ol>
                <ul class="auto carousel-inner carousel-inner_top">
                    <li class="carousel-item active"><div class="text wow fadeInDown" data-wow-delay="1s"><img src="/mobile/views/images/text.png"></div><img src="/mobile/views/images/slide_01.png"></li>

                <li class="carousel-item"><div class="text "><img src="/mobile/views/images/text.png"></div><img src="/mobile/views/images/slide_02.png"></li>
                <li class="carousel-item"><div class="text "><img src="/mobile/views/images/text.png"></div><img src="/mobile/views/images/slide_03.png"></li>

            </ul>


        </div>
        <!-- 메인슬라이드 E -->
        {/}
        <!-- 메인슬라이드 E -->
    </div>
    <!-- 컨텐츠 시작 -->
    <div id="container">
        {? HTML}
            {HTML}
        {:}
            {#CONTENT}
        {/}

    </div>
    <div id="footerwrap">
        <div class="banner wow fadeInDown">
            <div class="room wow fadeInLeft" data-wow-delay="0.8s"><a href="/front/main/doc/room"><img src="/mobile/views/images/ban_01.png"></a></div>
            <div class="tea wow fadeInRight" data-wow-delay="1s"><a href="/front/main/doc/special"><img src="/mobile/views/images/ban_02.png"></a></div>
        </div>
        <div id="footer" >
            <div class="copy wow fadeInDown" data-wow-delay="0.5s">
                <p>Copyright(C)2016 SSHEON. All Right Reserved<br>
                    충북 제천시 청풍면 청풍호로 42길 87(청풍면 북진리 26번지)<br>
                    TEL : <span>010 8924 1352</span>
                </p>
            </div>
            <div class="btn wow fadeInDown" data-wow-delay="0.7s">
                <ul>
                    <li><a href="https://www.facebook.com/%EC%88%98%EC%88%98%ED%97%8C-%E7%A7%80%E6%B0%B4%E8%BD%A9-1718326325081043/" target="_blank"><img src="/mobile/views/images/btn_01.png"></a></li>
                    <li><img src="/mobile/views/images/btn_02.png"></li>
                </ul>
            </div>
        </div>
        <div id="bottom" class="pos_f " style="bottom:0px;z-index: 2000;background-color: #000">
            <ul>
                <li><a href="tel:010-8924-1352"><img src="/mobile/views/images/btn_call.png"></a></li>
                <li><a href="http://plus.kakao.com/home/@수수헌" target="_blank"><img src="/mobile/views/images/btn_kakao.png"></a></li>
                <li><a href="/front/reserve/index"><img src="/mobile/views/images/btn_reserve.png"></a></li>
                <li class="last"><a href="/front/main/doc/guide"><img src="/mobile/views/images/btn_guide.png"></a></li>
            </ul>
        </div>
    </div>
</div>

<div id="toggle" class="hide">
	<div class="toggle">
    	<div class="menu"><a href="javascript:$('#toggle').fadeOut(200);$('#menu_btn').show()"><img src="/mobile/views/images/closed.png"></a></div>
    	<ul>
        	<li><a href="/front/main/doc/sshoen">수수헌</a></li>
            <li><a href="/front/main/doc/room">객실안내</a></li>
            <li><a href="/front/main/doc/facility">부대시설</a></li>
            <li><a href="/front/main/doc/special">스페셜</a></li>
            <li><a href="/front/board/lists/notice">공지사항</a></li>
            <li><a href="/front/main/faq">FAQ</a></li>
        </ul>
    </div>
</div>





<script type="text/javascript">
    function winset() {
        $('.autoheight').height($(window).height());
        $('#footer').css('margin-bottom',$('#bottom').height());
        if($(window).height() <=400) {
            $('#bottom').hide();
        }else{
            $('#bottom').show();
        }
        if($(window).height() <=700){
            $('#slide').css('oveflow','hidden').height($(window).height()-$('#bottom').height());
        }

    }
    $(window).resize(function(){
        winset()
    });
    setTimeout(function () {
        winset();
        $('#backd').fadeOut(100);
    },400);
    $(document).ready(function(){

    });
</script>
<script src="/asset/libs/jquery/tether/dist/js/tether.min.js"></script>
<script src="/asset/bootstrap-4.0.0-alpha.5-dist/js/bootstrap.js"></script>
<script src="/asset/bootbox/bootbox.js"></script>
<script src="/asset/scripts/php.js"></script>
<script src="/asset/libs/jquery/select2/dist/js/select2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/asset/scripts/jquery.mobile.custom.js"></script>
<script type="text/javascript" src="/asset/scripts/wow.min.js"></script>
<script type="text/javascript">


    $(".carousel-inner_top").on("swipeleft",function(){
        $('#slide').carousel('next');

    });
    $(".carousel-inner_top").on("swiperight",function(){
        $('#slide').carousel('prev');

    });

    new WOW().init();
    $('a').attr('rel','external');
</script>

</body>
</html>
