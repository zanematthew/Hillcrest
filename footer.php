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
            <div class="bottom">
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
