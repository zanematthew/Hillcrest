<?php get_header(); ?>
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
                            <?php if ( get_option('zm_ajax_comments_version') ) zm_ajax_comments(); ?>
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
                    <?php do_action( 'pelham_below_the_title', $post->ID ); ?>
                    <?php the_content(); ?>
                    <?php do_action('pelham_below_the_content', $post->ID ); ?>
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

<?php get_footer(); ?>
