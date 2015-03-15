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
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/preload.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/yamm.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/bootstrap-switch.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/animate.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/slidebars.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/lightbox.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/jquery.bxslider.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/syntaxhighlighter/shCore.css" rel="stylesheet" media="screen">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/style-green4.css" rel="stylesheet" media="screen" title="default">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/width-full.css" rel="stylesheet" media="screen" title="default">
    <link href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/buttons.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/html5shiv.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div id="sb-site">
<div class="boxed">

<header id="header-full-top" class="hidden-xs header-full">
    <div class="container">
        <div class="header-full-title">
            <h1 class="animated fadeInRight"><a href="index.html">artificial <span>reason</span></a></h1>

            <p class="animated fadeInRight">Clean and elegant theme</p>
        </div>
        <nav class="top-nav">

            <div class="dropdown animated fadeInDown animation-delay-11">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Login</a>

                <div class="dropdown-menu dropdown-menu-right dropdown-login-box animated fadeInUp">
                    <form role="form">
                        <h4>Login Form</h4>

                        <div class="form-group">
                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <br>

                            <div class="input-group login-input">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="checkbox pull-left">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                            <button type="submit" class="btn btn-ar btn-primary pull-right">Login</button>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- dropdown -->

            <div class="dropdown animated fadeInDown animation-delay-13">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>

                <div class="dropdown-menu dropdown-menu-right dropdown-search-box animated fadeInUp">
                    <form role="form">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-ar btn-primary" type="button">Go!</button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </form>
                </div>
            </div>
            <!-- dropdown -->
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
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Home</a>
            <ul class="dropdown-menu dropdown-menu-left">
                <li><a href="index.html">Option 1: Default</a></li>
                <li><a href="home_services.html">Option 2: Services</a></li>
                <li><a href="home_full.html">Option 3: Full Intro</a></li>
                <li><a href="home_only_full.html">Option 4: Only Full Intro</a></li>
                <li><a href="home_news.html">Option 5: News</a></li>
                <li><a href="home_profile.html">Option 6: Professional Profile</a></li>
                <li><a href="home_plan.html">Option 7: Subscribe <span class="label label-success pull-right">New</span></a>
                </li>
                <li role="presentation" class="dropdown-header">Header Options</li>
                <li><a href="configurator.html">Configurator<span class="label label-success pull-right">New</span></a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">UI Elements</a>
            <ul class="dropdown-menu dropdown-menu-left">
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">CSS</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="css_typography.html">Typography</a></li>
                        <li><a href="css_headers.html">Headers</a></li>
                        <li><a href="css_dividers.html">Dividers</a></li>
                        <li><a href="css_blockquotes.html">Blockquotes</a></li>
                        <li><a href="css_forms.html">Forms</a></li>
                        <li><a href="css_tables.html">Tables</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Buttons</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="btn_basic_buttons.html">Basic Buttons</a></li>
                        <li><a href="btn_library_buttons.html">Buttons Library</a></li>
                        <li><a href="btn_social_buttons.html">Social Buttons</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Icons</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="icons_artificial_reason.html">Artificial Reason Icons</a></li>
                        <li><a href="icons_glyph.html">Glyphicons Icons</a></li>
                        <li><a href="icons_awesome.html">Font Awesome</a></li>
                        <li><a href="icons_social.html">Social Icons</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Components</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="components_dropdowns.html">Components Dropdowns</a></li>
                        <li><a href="components_panels.html">Panels</a></li>
                        <li><a href="components_lists.html">Lists</a></li>
                        <li><a href="components_paginations.html">Paginations</a></li>
                        <li><a href="components_labels_badges.html">Labels and Badges</a></li>
                        <li><a href="components_alerts_wells.html">Alerts and Wells</a></li>
                        <li><a href="components_thumbnails.html">Thumbnails</a></li>
                        <li><a href="components_modals.html">Modals</a></li>
                        <li><a href="components_progress_bars.html">Progress Bars</a></li>
                        <li><a href="components_tooltip_popover.html">Tooltip &amp; Popover</a></li>
                    </ul>
                </li>
                <li><a href="collapses_tabs.html">Collapses &amp; Tabs</a></li>
                <li><a href="components_vertical_tabs.html">Vertical Tabs <span class="label label-success pull-right">New</span></a>
                </li>
                <li><a href="components_switch.html">Switch Controls <span
                            class="label label-success pull-right">New</span></a></li>
                <li><a href="content_box.html">Contents Box</a></li>
                <li><a href="carousels.html">Carousels</a></li>
                <li><a href="charts.html">Charts &amp; CountDowns</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Pages</a>
            <ul class="dropdown-menu dropdown-menu-left">
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">About us &amp; Team</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="page_about.html">About us Option 1</a></li>
                        <li><a href="page_about2.html">About us Option 2</a></li>
                        <li><a href="page_about3.html">About us &amp; Team</a></li>
                        <li class="divider"></li>
                        <li><a href="page_team.html">Our Team Option 1</a></li>
                        <li><a href="page_team2.html">Our Team Option 2</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Form</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="page_contact.html">Contact Option 1</a></li>
                        <li><a href="page_contact2.html">Contact Option 2</a></li>
                        <li class="divider"></li>
                        <li><a href="page_login.html">Login Integrated</a></li>
                        <li><a href="page_login_full.html">Login Full Page</a></li>
                        <li class="divider"></li>
                        <li><a href="page_login_register.html">Login and Register</a></li>
                        <li><a href="page_register.html">Register Option 1</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Profiles</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="page_profile.html">User Profile Option 1</a></li>
                        <li><a href="page_profile2.html">User Profile Option 2</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Error</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="page_404.html">Error 404 Full Page</a></li>
                        <li><a href="page_404_2.html">Error 404 Integrated</a></li>
                        <li><a href="page_500.html">Error 500 Full Page</a></li>
                        <li><a href="page_500_2.html">Error 500 Integrated</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Bussiness &amp; Products</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="page_testimonial.html">Testimonials</a></li>
                        <li><a href="page_clients.html">Our Clients</a></li>
                        <li><a href="page_product.html">Products</a></li>
                        <li><a href="page_services.html">Services</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Pricing</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="page_pricing.html">Pricing Box</a></li>
                        <li><a href="page_pricing-mega.html">Pricing Mega Table</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">FAQ &amp; Support</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="page_support.html">Support Center</a></li>
                        <li><a href="page_faq.html">FAQ Option 1</a></li>
                        <li><a href="page_faq2.html">FAQ Option 2</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Coming Soon</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="page_coming.html">Coming Soon Option 1</a></li>
                        <li><a href="page_coming2.html">Coming Soon Option 2</a></li>
                    </ul>
                </li>
                <li class="dropdown-submenu">
                    <a href="javascript:void(0);" class="has_children">Timeline</a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <li><a href="page_timeline_left.html">Timeline Left</a></li>
                        <li><a href="page_timeline.html">Timeline Center</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Blog</a>
            <ul class="dropdown-menu dropdown-menu-left">
                <li><a href="blog.html">Blog Right Sidebar</a></li>
                <li><a href="blog_left.html">Blog Left Sidebar</a></li>
                <li><a href="blog_full.html">Blog Full</a></li>
                <li><a href="blog2.html">Other Option</a></li>
                <li class="divider"></li>
                <li><a href="single.html">Blog Item</a></li>
                <li><a href="single_full.html">Blog Item Full</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">E-commerce</a>
            <ul class="dropdown-menu dropdown-menu-left">
                <li><a href="e-commerce_home.html">E-commerce Home</a></li>
                <li><a href="e-commerce.html">E-commerce Filters</a></li>
                <li><a href="e-commerce_product.html" class="active">Product</a></li>
                <li><a href="e-commerce_cart.html">Cart</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">Portfolio</a>
            <ul class="dropdown-menu dropdown-menu-left">
                <li><a href="portfolio_sidebar.html">Portfolio sidebar filters</a></li>
                <li><a href="portfolio_topbar.html">Portfolio topbar filters</a></li>
                <li><a href="portfolio_caption_hover.html">Portfolio with captions</a></li>
                <li class="divider"></li>
                <li><a href="portfolio_item.html">Portfolio item</a></li>
                <li><a href="portfolio_item_devices.html">Portfolio item device</a></li>
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
            'htmlOptions' => array('class' => 'breadcrumb pull-right'),
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
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/slidebars.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/holder.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/buttons.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/app.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/e-commerce_product.js"></script>

</body>

</html>

