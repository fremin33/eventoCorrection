<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

</head><!--/head-->

<body <?php body_class(); ?>>
<header id="header" role="banner">
    <div class="main-nav">
        <div class="container">
            <div class="header-top">
                <div class="pull-right social-icons">
                    <?php
                    $tw = get_option("twitter");
                    $fb = get_option("facebook");
                    $gplus = get_option("gplus");
                    $yt = get_option("yt");

                    if ($tw): ?>
                        <a href="<?= $tw ?>"><i class="fa fa-twitter"></i></a>
                    <?php endif;
                    if ($fb): ?>
                        <a href="<?= $fb ?>"><i class="fa fa-facebook"></i></a>
                    <?php endif;
                    if ($gplus): ?>
                        <a href="<?= $gplus ?>"><i class="fa fa-google-plus"></i></a>
                    <?php endif;
                    if ($yt): ?>
                        <a href="<?= $yt ?>"><i class="fa fa-youtube"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= home_url('/') ?>">
                        <img class="img-responsive" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png"
                             alt="logo">
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <?php
                    if (is_front_page()) {
                        wp_nav_menu(array('theme_location' => 'main_menu', 'menu_class' => 'nav navbar-nav navbar-right'));
                    } else {
                        wp_nav_menu(array('theme_location' => 'main_menu_int', 'menu_class' => 'nav navbar-nav navbar-right'));
                    }
                    ?>
                    <!--
		                <ul class="nav navbar-nav navbar-right">  
		                	               
		                    <li class="scroll active"><a href="#home">Accueil</a></li>
		                    <li class="scroll"><a href="#explore">Blog</a></li>                         
		                    <li class="scroll"><a href="#event">L'équipe</a></li>
		                    <li class="scroll"><a href="#about">A propos</a></li>                     
		                    <li class="scroll"><a href="#twitter">Témoignages</a></li>
		                    <li class="no-scroll"><a href="contact.html">Contact</a></li>       
		                </ul>
		                -->
                </div>
            </div>
        </div>
    </div>
</header>
<!--/#header-->
