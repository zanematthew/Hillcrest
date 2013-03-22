<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and some more
 *
 * @package zM
 * @subpackage Pelham
 * @since Pelham 0.1
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="expires"   content="never" />
<meta name="language"  content="english" />
<meta name="distribution"  content="Global" />
<meta name="author"    content="<?php bloginfo( 'name' ); ?>" />
<meta name="publisher" content="<?php bloginfo( 'name' ); ?>" />
<meta content="<?php echo the_date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>" name="copyright"/>

<title><?php wp_title( ':', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link rel="Shortcut Icon" href="<?php bloginfo( 'template_directory' ); ?>/favicon.ico" />
<link rel="icon" type="image/ico" href="<?php bloginfo( 'template_directory' ); ?>/favicon.ico" />
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>

<body <?php body_class(); ?>>
<div class="container_12">
    <div class="push_1 grid_10 alpha">
        <header>
            <?php wp_nav_menu( array( 'container_class' => 'menu-container', 'theme_location' => 'primary' ) ); ?>
            <?php if ( is_single() || is_page() ) : ?>
                <h2 class="slogan"><a href="<?php bloginfo('url'); ?>"><span class="name"><?php bloginfo('name'); ?></span></a> <span class="description"><?php bloginfo('description'); ?></span></h2>
            <?php else : ?>
                <h1 class="slogan"><a href="<?php bloginfo('url'); ?>"><span class="name"><?php bloginfo('name'); ?></span></a> <span class="description"><?php bloginfo('description'); ?></span></h1>
            <?php endif; ?>
        </header>
    </div>
