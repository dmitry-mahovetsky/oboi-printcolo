<!DOCTYPE html>
<html id = "pw_main_theme" lang = "ru" itemscope itemtype="http://schema.org/LocalBusiness">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<title><?php
if(get_post_meta($post->ID, 'title', true)){
 echo get_post_meta($post->ID, 'title', true);
} else { 
 bloginfo('name'); wp_title(); 
} ?></title>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lightbox.css">

<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
    <link type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/favourites.css" rel="stylesheet">
<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/adaptiv.css" rel="stylesheet">
<script type="text/javascript" src="https://code.jquery.com/jquery-2.0.0.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--    добавил-->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/master.css">
    <!--    добавил-->

    <?php wp_head();?>
</head>
<body>



<!-- Google -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-76619520-1', 'auto');
  ga('send', 'pageview');
</script>
<!-- end google -->
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5ZQWCD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5ZQWCD');</script>
<!-- End Google Tag Manager -->

<div id="wrapper">
        <div class = "pw_main_content_holder">
            <header id="header">
                <div class="col-md-2">
                    <a href="<?php echo home_url(); ?>" rel="nofollow" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/image/logo.png" height="79" width="100" alt="PrintColor"></a>
                </div>
                <div class="col-md-3 text-center">
                    <span class="block_hours">Мы работаем 9:00 - 18:00 <br>понедельник-пятница</span>
                </div>
                <div class="col-md-2">
                    <ul class="social_top">
                        <li><a href="https://www.facebook.com/oboi.printcolor/" rel="nofollow" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="skype:printcolor45gmail.com?chat"><i class="fa fa-skype"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <div class="phone_top">
                        <span class="hidden-xs hidden-sm"><i class="fa fa-phone"></i></span>
                        <ul>
                            <li><a href="tel:+380957140305">(095) 714-03-05</a></li>
                            <li><a href="tel:+380984259984">(098) 425-99-84</a></li>
                        </ul>
                        <button class="button_call_back"><i class="fa fa-volume-control-phone"></i>Заказать звонок</button>
                    </div>
                </div>
            </header>
        </div>
        <nav>
            <div class="open_catalog visible-xs">Открыть каталог <i class="fa fa-toggle-off"></i></div>
        <?php wp_nav_menu( array('theme_location' => 'pw_header_menu','menu'=>'Верхнее меню','container_class'=>'menu-glavnoe-menyu-container') ); ?>
            <div class="nav_menu_hidden hidden">

            </div>
        </nav>
        <div class = "pw_main_content_holder">
