<?php
/**
 * The template for displaying single posts and pages.
 * @package Business Classified Ads
 * @since 1.0.0
 */

get_header();

$business_classified_ads_default = business_classified_ads_get_default_theme_options();
$business_classified_ads_global_layout = get_theme_mod('business_classified_ads_global_sidebar_layout', $business_classified_ads_default['business_classified_ads_global_sidebar_layout']);
$business_classified_ads_page_layout = get_theme_mod('business_classified_ads_page_sidebar_layout', $business_classified_ads_global_layout);
$business_classified_ads_post_layout = get_theme_mod('business_classified_ads_post_sidebar_layout', $business_classified_ads_global_layout);
$business_classified_ads_post_meta = get_post_meta(get_the_ID(), 'business_classified_ads_post_sidebar_option', true);

$business_classified_ads_final_layout = $business_classified_ads_global_layout;
if (!empty($business_classified_ads_post_meta) && $business_classified_ads_post_meta !== 'default') {
    $business_classified_ads_final_layout = $business_classified_ads_post_meta;
} elseif (is_page() || (function_exists('is_shop') && is_shop())) {
    $business_classified_ads_final_layout = $business_classified_ads_page_layout;
} elseif (is_single()) {
    $business_classified_ads_final_layout = $business_classified_ads_post_layout;
}

// Set content column order based on sidebar layout
$business_classified_ads_sidebar_column_class = 'column-order-1';
if ($business_classified_ads_final_layout === 'left-sidebar') {
    $business_classified_ads_sidebar_column_class = 'column-order-2';
}

?>

<div id="single-page" class="singular-main-block">
    <div class="wrapper">
        <div class="column-row <?php echo esc_attr($business_classified_ads_final_layout === 'no-sidebar' ? 'no-sidebar-layout' : ''); ?>">

            <?php if ($business_classified_ads_final_layout === 'left-sidebar') : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

            <div id="primary" class="content-area <?php echo esc_attr($business_classified_ads_final_layout === 'no-sidebar' ? 'full-width-content' : $business_classified_ads_sidebar_column_class); ?>">
                <main id="site-content" role="main">

                    <?php
                    business_classified_ads_breadcrumb(); // Display breadcrumb

                    if (have_posts()) : ?>

                        <div class="article-wraper">
                            <?php while (have_posts()) : the_post(); ?>

                                <?php get_template_part('template-parts/content', 'single'); ?>

                                <?php if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) : ?>
                                    <div class="comments-wrapper">
                                        <?php comments_template(); ?>
                                    </div>
                                <?php endif; ?>

                            <?php endwhile; ?>
                        </div>

                    <?php else : ?>

                        <?php get_template_part('template-parts/content', 'none'); ?>

                    <?php endif;

                    do_action('business_classified_ads_navigation_action');
                    ?>

                </main>
            </div>

            <?php if ($business_classified_ads_final_layout === 'right-sidebar') : ?>
                <?php get_sidebar(); ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>