<?php
$business_classified_ads_layout = business_classified_ads_get_final_sidebar_layout();
$business_classified_ads_sidebar_class = 'column-order-1';

if ( $business_classified_ads_layout === 'left-sidebar' ) {
    $business_classified_ads_sidebar_class = 'column-order-1';
} elseif ( $business_classified_ads_layout === 'right-sidebar' ) {
    $business_classified_ads_sidebar_class = 'column-order-2';
}

if ( $business_classified_ads_layout !== 'no-sidebar' ) : ?>
    <aside id="secondary" class="widget-area <?php echo esc_attr( $business_classified_ads_sidebar_class ); ?>">
        <div class="widget-area-wrapper">
            <?php if ( is_active_sidebar('sidebar-1') ) : ?>
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            <?php else : ?>
                <!-- Default widgets -->
                <div class="widget widget_block widget_search">
                    <h3 class="widget-title"><?php esc_html_e('Search', 'business-classified-ads'); ?></h3>
                    <?php get_search_form(); ?>
                </div>

                <div class="widget widget_pages">
                    <h3 class="widget-title"><?php esc_html_e('Pages', 'business-classified-ads'); ?></h3>
                    <ul>
                        <?php
                        wp_list_pages(array(
                            'title_li' => '',
                        ));
                        ?>
                    </ul>
                </div>

                <div class="widget widget_archive">
                    <h3 class="widget-title"><?php esc_html_e('Archives', 'business-classified-ads'); ?></h3>
                    <ul>
                        <?php wp_get_archives(['type' => 'monthly', 'show_post_count' => true]); ?>
                    </ul>
                </div>

                <div class="widget widget_categories">
                    <h3 class="widget-title"><?php esc_html_e('Categories', 'business-classified-ads'); ?></h3>
                    <ul class="wp-block-categories-list wp-block-categories">
                        <?php wp_list_categories(['orderby' => 'name', 'title_li' => '', 'show_count' => true]); ?>
                    </ul>
                </div>

                <div class="widget widget_tag_cloud">
                    <h3 class="widget-title"><?php esc_html_e('Tags', 'business-classified-ads'); ?></h3>
                    <?php
                    $business_classified_ads_tags = get_tags();
                    if ( $business_classified_ads_tags ) {
                        echo '<div class="tagcloud">';
                        foreach ( $business_classified_ads_tags as $business_classified_ads_tag ) {
                            $business_classified_ads_link = get_tag_link($business_classified_ads_tag->term_id);
                            echo '<a href="' . esc_url($business_classified_ads_link) . '" class="tag-cloud-link">' . esc_html($business_classified_ads_tag->name) . '</a> ';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>' . esc_html__('No tags found.', 'business-classified-ads') . '</p>';
                    }
                    ?>
                </div>

            <?php endif; ?>
        </div>
    </aside>
<?php endif; ?>
