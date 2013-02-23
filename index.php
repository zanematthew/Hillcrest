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

    <?php if ( is_archive() ) : if ( have_posts() ) the_post(); ?>
        <h2 class="page-title">
           	<?php if ( is_day() ) : ?>
                <?php printf( __( 'Daily Archives <span>%s</span>', 'zm' ), get_the_date() ); ?>
           	<?php elseif ( is_month() ) : ?>
                <?php printf( __( 'Monthly Archives <span>%s</span>', 'zm' ), get_the_date( 'F Y' ) ); ?>
           	<?php elseif ( is_year() ) : ?>
                <?php printf( __( 'Yearly Archives <span>%s</span>', 'zm' ), get_the_date( 'Y' ) ); ?>
           	<?php elseif ( is_tag() ) : ?>
                <?php $tag_obj = get_term_by( 'slug', get_query_var('tag'), 'post_tag' ); print $tag_obj->name . ' Archives'; ?>
           	<?php elseif ( is_category() ) : ?>
                <?php print ucfirst( get_query_var('category_name') ); ?> Archives
           	<?php else : ?>
                <?php _e( 'Blog Archives', 'zm' ); ?>
           	<?php endif; ?>
        </h2>
        <?php rewind_posts(); ?>
    <?php endif; ?>

    <div class="grid_7 push_1 alpha">
        <?php
        /**
         * Page
         */
         ?>
        <?php if ( is_page() ) : ?>
            <article>
                <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; // end of the loop. ?>
            </article>
        <?php
        /**
         * Single
         */
         ?>
        <?php elseif ( is_single() ) : ?>
            <article>
                <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                    <?php if ( get_option('zm_ajax_comments_version') ) zm_ajax_comments(); ?>
                </div>
                <?php endwhile; // end of the loop. ?>
            </article>
        <?php
        /**
         * Default loop
         */
         ?>
        <?php else: ?>
            <ul class="main <?php if ( is_search() || is_archive() ) : ?>results-container<?php endif; ?>">
                <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                    <li <?php post_class()?>>
                        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                        <?php the_excerpt(); ?>
                        <small><span class="posted-in"><?php zm_posted_in(); ?></span> <time><?php the_date(); ?></time></small>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>

    <aside class="sidebar-container grid_3 push_1 omega">
        <?php if ( is_active_sidebar( 'first-sidebar-widget-area' ) ) : ?>
            <div id="first" class="widget-area">
                <ul class="xoxo">
                    <?php dynamic_sidebar( 'first-sidebar-widget-area' ); ?>
                </ul>
            </div>
        <?php endif; ?>
        <h3 class="title">Tags</h3>
        <ul>
            <?php $queried_term = get_query_var('tag'); foreach( get_tags() as $tag) : ?>
                <li class="<?php if ( $queried_term == $tag->slug ) : ?>current<?php endif; ?>">
                <a href="<?php print get_tag_link( $tag->term_id ); ?>" title="<?php print $tag->name; ?>" class="<?php print $tag->slug; ?>">
                <?php print $tag->name; ?></a>
                <span class="count"><?php print $tag->count; ?></span></li>
            <?php endforeach; ?>
       </ul>
    </aside>

    <div class="container_12">
        <footer class="grid_12">
            <div class="footer-wrapper">
            <?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
                <div class="widget-area">
                    <ul class="xoxo">
                        <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
                    </ul>
                </div>
            <?php endif; ?>
            </div>

            <div class="bottom">
            <?php if ( is_active_sidebar( 'absolute-footer-widget-area' ) ) : ?>
                <div class="widget-area">
                    <ul class="xoxo">
                        <?php dynamic_sidebar( 'absolute-footer-widget-area' ); ?>
                    </ul>
                </div>
            <?php endif; ?>
                <ul class="inline">
                    <li>Powered By <a href="http://wordpress.org/" target="_blank">WordPress</a> version <span class="version"><?php bloginfo('version'); ?></span> A Blog Tool and Publishing Platform</li>
                </ul>
            </div>
        </footer>
    </div>
</div>

<?php
/**
 * Call wp_footer to allow plugins to add CSS and JS
 */
wp_footer(); ?>

</body>
</html>

