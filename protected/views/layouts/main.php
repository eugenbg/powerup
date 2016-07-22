<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="shortcut icon" href="<?php echo Yii::app()->getBaseUrl(true); ?>/img/favicon.ico">

    <meta name="description" content="<?php echo Yii::app()->params['metaDescription']; ?>">

    <!-- CSS -->
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans&subset=cyrillic-ext,latin' rel='stylesheet' type='text/css'>    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/yamm.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/bootstrap-switch.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/animate.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/slidebars.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/lightbox.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/jquery.bxslider.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/style-green4.css" rel="stylesheet" media="screen" title="default">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/width-full.css" rel="stylesheet" media="screen" title="default">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/buttons.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/custom.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/cart.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/header.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/overlay.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/html5shiv.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div id="overlay">
</div>
<div id="sb-site">
<div class="boxed">

<header id="header-full-top" class="hidden-xs header-full">
    <div class="container">
        <div class="header-full-title" onclick="window.location.href='/'">
            <h1 class="animated fadeInRight"><a href="/">Powerup.by <span> Зарядись!</span></a></h1>

            <p class="animated fadeInRight">Магазин аккумуляторов и зарядок</p>
        </div>
        <div id="search-mini" class="hidden-xs col-md-3">
            <form role="form" action="/search/index" method="POST">
                <div class="input-group">
                    <input type="text" name="search_query" class="form-control" placeholder="Поиск...">
                            <span class="input-group-btn">
                                <button class="btn btn-ar btn-primary" type="submit">Искать!</button>
                            </span>
                </div><!-- /input-group -->
            </form>
        </div>
        <div id="phones-top" class="col-md-2">
            <ul class="list-unstyled">
                <li>
                    Телефоны:
                </li>
                <li>
                    <?php echo Yii::app()->settings->get('main', 'phone1'); ?>
                </li>
                <li>
                    <?php echo Yii::app()->settings->get('main', 'phone2'); ?>
                </li>
            </ul>
        </div>
        <nav class="top-nav">
                <?php $this->widget('miniCartWidget', array() ) ?>
        </nav>
    </div>
    <!-- container -->
</header>
<!-- header-full -->
<nav class="navbar navbar-static-top navbar-default navbar-header-full" role="navigation" id="header">
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars"></i>
    </button>
    <a class="navbar-brand hidden-lg hidden-md hidden-sm" href="/">Powerup <span>by</span></a>
</div>
<!-- navbar-header -->

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li>
            <a href="/">Главная</a>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Аккумуляторы</a>
            <ul class="dropdown-menu dropdown-menu-left">
                <li><a href="<?php echo $this->createUrl('custom/category', array('category'=>1)); ?>">Для фотоаппаратов</a></li>
                <li><a href="<?php echo $this->createUrl('custom/category', array('category'=>3)); ?>">Для видеокамер</a></li>
                <li><a href="<?php echo $this->createUrl('custom/category', array('category'=>2)); ?>">Для мобильных телефонов</a></li>
            </ul>
        </li>
        <li>
            <a href="/dostavka">Доставка</a>
        </li>
        <li>
            <a href="/oplata">Оплата</a>
        </li>
        <li>
            <a href="/o-nas">О нас</a>
        </li>
        <li>
            <a href="/kontakti">Контакты</a>
        </li>
    </ul>
</div>
<!-- navbar-collapse -->
</div>
<!-- container -->
</nav>

<header class="main-header">
    <div class="container">
        <h1 class="page-title"><?php echo CHtml::encode($this->pageTitle); ?></h1>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'tagName' => 'div',
            'homeLink' => sprintf(<<<EOF
<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
<a href="%s" itemprop="url">
<span itemprop="title">PowerUp.by</span>
</a>
</span>
EOF
, Yii::app()->getBaseUrl(true)),
            'activeLinkTemplate'=> <<<EOF
<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
<a href="{url}" itemprop="url">
<span itemprop="title">{label}</span>
</a>
</span>
EOF
            ,'inactiveLinkTemplate'=> <<<EOF
<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
<a href="#" itemprop="url">
<span itemprop="title">{label}</span>
</a>
</span>
EOF
        ,'htmlOptions' => array('class' => 'breadcrumb'),
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    </div>
</header>

<div class="container">
    <p class="bg-danger" style="padding: 15px; text-align: center;">Извините за неудобства, магазин временно не работает! Мы снова откроемся примерно сентябре 2016</p>
    <?php echo $content; ?>
</div>

<aside id="footer-widgets">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3 class="footer-widget-title">Каталог</h3>
                <ul class="list-unstyled">
                    <li><a href="<?php echo $this->createUrl('custom/category', array('category'=>1)); ?>">Аккумуляторы для фотоаппаратов</a></li>
                    <li><a href="<?php echo $this->createUrl('custom/category', array('category'=>3)); ?>">Аккумуляторы для видеокамер</a></li>
                    <li><a href="<?php echo $this->createUrl('custom/category', array('category'=>2)); ?>">Аккумуляторы для мобильных телефонов</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3 class="footer-widget-title">Информация</h3>
                <ul class="list-unstyled">
                    <li><a href="/oplata">Способы оплаты</a></li>
                    <li><a href="/garantii">Наша гарантия</a></li>
                    <li><a href="/kontakti">Контакты</a></li>
                    <li><a href="/dostavka">Доставка</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3 class="footer-widget-title">Телефоны</h3>
                <ul class="list-unstyled">
                    <li>
                        <?php echo Yii::app()->settings->get('main', 'phone1'); ?>
                    </li>
                    <li>
                        <?php echo Yii::app()->settings->get('main', 'phone2'); ?>
                    </li>
<!--                    <li>
                        life: +375 44 111111
                    </li>
-->
                </ul>
            </div>

        </div>
        <!-- row -->
    </div>
    <!-- container -->
</aside>
<!-- footer-widgets -->
<footer id="footer">
    <p>&copy; 2015 <a href="/">Powerup.by</a> - магазин качественных аккумуляторов</p>
</footer>

</div>
<!-- boxed -->
</div>
<!-- sb-site -->


<div id="back-top">
    <a href="#header"><i class="fa fa-chevron-up"></i></a>
</div>
<!-- Scripts -->

<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/slidebars.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/holder.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/buttons.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/app.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/e-commerce_product.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/app/base.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/app/cart.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/jquery.validate.min.js"></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter30224751 = new Ya.Metrika({id:30224751,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/30224751" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>

</html>

