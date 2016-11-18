<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=9"/>
    <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=0.8, user-scalable=no">


    <script src="<?=ADMIN_JS_DIR?>/jquery-1.11.1.min.js"></script>
    <script src="<?=ADMIN_JS_DIR?>/jquery-ui-1.9.2.custom.js"></script>
    <script src="<?=ADMIN_JS_DIR?>/jquery.validationEngine-kr.js"></script>
    <script src="<?=ADMIN_JS_DIR?>/jquery.validationEngine.js"></script>
    <link rel="stylesheet" href="/asset/animate.css/animate.css" type="text/css" />
    <link rel="stylesheet" href="/asset/font-awesome/css/font-awesome.min.css" type="text/css" />

    <link rel="stylesheet" href="/asset/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="/asset/styles/app.css" type="text/css" />
    <link rel="stylesheet" href="/asset/styles/now_to.css" type="text/css" />

    <link rel="stylesheet" href="/asset/libs/jquery/select2/dist/css/select2.min.css" type="text/css" />
    <link rel="stylesheet" href="/asset/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/asset/libs/jquery/select2-bootstrap-theme/dist/select2-bootstrap.4.css" type="text/css" />

    <link rel="stylesheet" href="./css/main.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="./css/default.css" type="text/css" media="screen" />

    <title>수수헌</title>
</head>
<body>
{yield}

<script type="text/javascript">
    function winset() {
        $('.autoheight').height($(window).height());
    }
    $(window).resize(function(){
        winset()
    });
    winset();
</script>
<script src="/asset/libs/jquery/tether/dist/js/tether.min.js"></script>
<script src="/asset/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script src="/asset/bootbox/bootbox.js"></script>
<script src="/asset/scripts/php.js"></script>
<script src="/asset/libs/jquery/select2/dist/js/select2.min.js" type="text/javascript"></script>
</body>
</html>
