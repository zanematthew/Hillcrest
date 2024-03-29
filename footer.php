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
                <a href="<?php echo get_tag_link( $tag->term_id ); ?>" title="<?php echo $tag->name; ?>" class="<?php echo $tag->slug; ?>">
                <?php echo $tag->name; ?></a>
                <span class="count"><?php echo $tag->count; ?></span></li>
            <?php endforeach; ?>
       </ul>
    </aside>
</div>

    <div class="bottom-container">
        <div class="container_12">
            <div class="grid_10 push_1">
                <div class="padding">
                    <div class="bottom-left">
                        <?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
                            <div id="first" class="widget-area">
                                <ul class="xoxo">
                                    <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="widget-container" id="connect">
                            <h4 class="widget-title">Connect</h4>
                            <ul>
                                <li><a href="http://github.com/zanematthew" target="_blank"><span class="genericon genericon-github"></span>Fork me on GitHub</a></li>
                                <li><a href="http://twitter.com/zanematthew" target="_blank"><span class="genericon genericon-twitter"></span>Follow me on Twitter</a></li>
                                <li><a href="<?php echo site_url(); ?>/contact"><span class="genericon genericon-mail"></span>Contact me directly</a></li>
                            </ul>
                        </div>
                        <div class="widget-container" id="latest">
                            <?php zm_plugin_post_type_latest(); ?>
                        </div>
                    </div>

                    <div class="bottom-right">

                            <?php if ( is_active_sidebar( 'absolute-footer-widget-right-area' ) ) : ?>
                                <div id="first" class="widget-area">
                                    <ul class="xoxo">
                                        <?php dynamic_sidebar( 'absolute-footer-widget-right-area' ); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <div class="copyright">Copyright <?php echo bloginfo('name');?> <?php echo date('Y'); ?>.</div>
                            <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>

                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container_12">
                <div class="grid_5 push_3">
                    <div class="padding">
                        <?php if ( is_active_sidebar( 'absolute-footer-widget-area' ) ) : ?>
                            <div id="first" class="widget-area">
                                <ul class="xoxo">
                                    <?php dynamic_sidebar( 'absolute-footer-widget-area' ); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </footer>
    </div>

<?php
/**
 * Call wp_footer to allow plugins to add CSS and JS
 */
wp_footer(); ?>
<?php do_action('pelham_above_closing_body'); ?>
</body>
</html>
