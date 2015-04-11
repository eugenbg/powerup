<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="shortcut icon" href="<?php echo Yii::app()->getBaseUrl(true); ?>/img/favicon.png">

    <meta name="description" content="">

    <!-- CSS -->
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
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
        <div class="header-full-title">
            <h1 class="animated fadeInRight"><a href="index.html">artificial <span>reason</span></a></h1>

            <p class="animated fadeInRight">Clean and elegant theme</p>
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
    <a class="navbar-brand hidden-lg hidden-md hidden-sm" href="index.html">Artificial <span>Reason</span></a>
</div>
<!-- navbar-header -->

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="pull-right">
    <a href="javascript:void(0);" class="sb-icon-navbar sb-toggle-right"><i class="fa fa-bars"></i></a>
</div>
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
            'tagName' => 'ol',
            'homeLink' => '<a href="'.Yii::app()->getBaseUrl(true).'">Главная</a>',
            'htmlOptions' => array('class' => 'breadcrumb'),
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    </div>
</header>

<div class="container">
<!--    <h1 class="section-title no-margin-top">Motorola Moto G 8GB Black</h1>
-->
    <div class="row">

        <?php echo $content; ?>

    </div>
</div>

<aside id="footer-widgets">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3 class="footer-widget-title">Sitemap</h3>
                <ul class="list-unstyled three_cols">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="portfolio_sidebar.html">Portafolio</a></li>
                    <li><a href="portfolio_topvar.html">Works</a></li>
                    <li><a href="page_timeline_left.html">Timeline</a></li>
                    <li><a href="page_pricing.html">Pricing</a></li>
                    <li><a href="page_about2.html">About Us</a></li>
                    <li><a href="page_team.html">Our Team</a></li>
                    <li><a href="page_services.html">Services</a></li>
                    <li><a href="page_support.html">FAQ</a></li>
                    <li><a href="page_login_full.html">Login</a></li>
                    <li><a href="page_contact.html">Contact</a></li>
                </ul>
                <h3 class="footer-widget-title">Subscribe</h3>

                <p>Lorem ipsum Amet fugiat elit nisi anim mollit minim labore ut esse Duis ullamco ad dolor veniam
                    velit.</p>

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email Adress">
                    <span class="input-group-btn">
                        <button class="btn btn-ar btn-primary" type="button">Subscribe</button>
                    </span>
                </div>
                <!-- /input-group -->
            </div>
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</aside>
<!-- footer-widgets -->
<footer id="footer">
    <p>&copy; 2014 <a href="#">Artificial Reason</a>, inc. All rights reserved.</p>
</footer>

</div>
<!-- boxed -->
</div>
<!-- sb-site -->

<div class="sb-slidebar sb-right">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
        </span>
    </div>
    <!-- /input-group -->

    <h2 class="slidebar-header no-margin-bottom">Navigation</h2>
    <ul class="slidebar-menu">
        <li><a href="index.html">Home</a></li>
        <li><a href="portfolio_topbar.html">Portfolio</a></li>
        <li><a href="page_about3.html">About us</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="page_contact.html">Contact</a></li>
    </ul>

    <h2 class="slidebar-header">Social Media</h2>

    <div class="slidebar-social-icons">
        <a href="#" class="social-icon-ar rss"><i class="fa fa-rss"></i></a>
        <a href="#" class="social-icon-ar facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="social-icon-ar twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="social-icon-ar pinterest"><i class="fa fa-pinterest"></i></a>
        <a href="#" class="social-icon-ar instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" class="social-icon-ar wordpress"><i class="fa fa-wordpress"></i></a>
        <a href="#" class="social-icon-ar linkedin"><i class="fa fa-linkedin"></i></a>
        <a href="#" class="social-icon-ar flickr"><i class="fa fa-flickr"></i></a>
        <a href="#" class="social-icon-ar vine"><i class="fa fa-vine"></i></a>
        <a href="#" class="social-icon-ar dribbble"><i class="fa fa-dribbble"></i></a>
    </div>
</div>
<!-- sb-slidebar sb-right -->
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


</body>

</html>

