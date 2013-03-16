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


if ( ! function_exists( 'pelham_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own pelham_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function pelham_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <header class="comment-meta comment-author vcard">
                <?php
                    echo get_avatar( $comment, 44 );
                    printf( '<cite class="fn">%1$s %2$s</cite>',
                        get_comment_author_link(),
                        // If current post author is also comment author, make it known visually.
                        ( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
                    );
                    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        get_comment_time( 'c' ),
                        /* translators: 1: date, 2: time */
                        sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
                    );
                ?>
            </header><!-- .comment-meta -->

            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
            <?php endif; ?>

            <section class="comment-content comment">
                <?php comment_text(); ?>
                <?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
            </section><!-- .comment-content -->

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->
    <?php
        break;
    endswitch; // end comment_type check
}
endif;