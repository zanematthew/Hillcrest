<?php

register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'hbs' ),
    'sidebar' => __( 'Sidebar Navigation', 'hbs' )
    ) );

function zm_widgets_init() {

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'First header widget area', 'zm' ),
		'id' => 'first-header-widget-area',
		'description' => __( 'The first header widget area', 'zm' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

    register_sidebar( array(
        'name' => __( 'First Sidebar Widget Area', 'zm' ),
        'id' => 'first-sidebar-widget-area',
        'description' => __( 'The sideabr widget area', 'zm' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'zm' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The footer widget area', 'zm' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

    register_sidebar( array(
        'name' => __( 'Absolute Footer Widget Area', 'zm' ),
        'id' => 'absolute-footer-widget-area',
        'description' => __( 'The absolute footer widget area', 'zm' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action('widgets_init', 'zm_widgets_init');

add_theme_support( 'post-thumbnails');

add_shortcode('META_LIST', 'meta_list');
function meta_list($atts, $content=NULL) {
    $booo =  "<div class='meta-list-container'>{$content}</div>";
    return $booo;
}

if ( ! function_exists( 'zm_posted_on' ) ) :
function zm_posted_on() {
    printf( __( 'Category <span class="%1$s">%2$s</span> ago', 'collection' ),
        'meta-prep-author',
        sprintf( '<span class="date">%1$s</span>',
            esc_attr( human_time_diff( get_the_time('U'), current_time('timestamp') ) )
        )
    );
}
endif;

if ( ! function_exists( 'zm_posted_in' ) ) :
function zm_posted_in() {

    // Retrieves tag list of current post, separated by commas.
    $tag_list = get_the_tag_list( '', ', ' );

    if ($tag_list) {
        $posted_in = __('%1$s', 'collection');
    } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
   //     $posted_in = __('<span class="posted-in"> Posted in %1$s </span> ', 'collection');
    } else {
        $posted_in = null;
    }

    // Prints the string, replacing the placeholders.
    printf(
        $posted_in,
        $tag_list
    );
}
endif;


function pelham_list_pages(){
    global $wp_query;
    $pagename = get_query_var('pagename');
    $page_info = get_page_by_title( $pagename );
    $pages = get_pages( array( 'child_of' => $page_info->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
    ob_start(); ?>
    <ul class="main">
        <?php foreach( $pages as $page ) : ?>
        <li <?php post_class('post')?>>
            <h3><a href="<?php print get_permalink( $page->ID ); ?>" title="<?php get_the_title( $page->ID ); ?>"><?php print get_the_title( $page->ID ); ?></a></h3>
            <?php print $page->post_content; ?>
            <small><span class="posted-in"><?php zm_posted_in(); ?></span> <time><?php the_date(); ?></time></small>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php return ob_get_clean();
}
add_shortcode('list_pages', 'pelham_list_pages');
