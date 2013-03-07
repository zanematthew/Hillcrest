<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php
/**
 * Pull in our first post and check if it has a custom field for 'meta_description'
 */
global $post;
(isset( $post->ID )) ? $post_meta = get_post_custom( $post->ID ) : '';
$meta_description = isset( $post_meta['meta_description'][0] ) ? $post_meta['meta_description'][0] : get_bloginfo('meta_description' );
$keywords = isset( $post_meta['keywords'][0]) ? $post_meta['keywords'][0] : '';
?>

<meta name="description" content="<?php print $meta_description; ?>" />
<meta name="keywords" content="<?php print $keywords; ?>" />
<meta name="expires"   content="never" />
<meta name="language"  content="english" />
<meta name="distribution"  content="Global" />
<meta name="author"    content="<?php bloginfo( 'name' ); ?>" />
<meta name="publisher" content="<?php bloginfo( 'name' ); ?>" />
<meta content="<?php echo the_date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>" name="copyright"/>

<?php
/**
 * Favicon is pulled in from the ROOT of the template
 */
?>
<link rel="Shortcut Icon" href="<?php bloginfo( 'template_directory' ); ?>/favicon.ico" />
<link rel="icon" type="image/ico" href="<?php bloginfo( 'template_directory' ); ?>/favicon.ico" />
<title><?php wp_title( ':', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
/**
 * Call wp_head to allow plugins to add CSS and JS
 */
wp_head(); ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>

<body <?php body_class(); ?>>
<div class="container_12">
    <div class="push_1 grid_10 alpha">
        <header>
            <?php if ( is_active_sidebar( 'first-header-widget-area' ) ) : ?>
                <div id="first" class="widget-area">
                    <ul class="xoxo">
                        <?php dynamic_sidebar( 'first-header-widget-area' ); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'second-header-widget-area' ) ) : ?>
                <div id="second" class="widget-area">
                    <ul class="xoxo">
                        <?php dynamic_sidebar( 'second-header-widget-area' ); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php wp_nav_menu( array( 'container_class' => 'menu-container', 'theme_location' => 'primary' ) ); ?>
            <?php if ( is_single() || is_page() ) : ?>
                <h2 class="slogan"><a href="<?php bloginfo('url'); ?>"><span class="name"><?php bloginfo('name'); ?></span></a> <span class="description"><?php bloginfo('description'); ?></span></h2>
            <?php else : ?>
                <h1 class="slogan"><a href="<?php bloginfo('url'); ?>"><span class="name"><?php bloginfo('name'); ?></span></a> <span class="description"><?php bloginfo('description'); ?></span></h1>
            <?php endif; ?>
        </header>
    </div>
