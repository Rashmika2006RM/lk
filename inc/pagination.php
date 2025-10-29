<?php
/**
 *
 * Pagination Functions
 *
 * @package Business Classified Ads
 */

/**
 * Pagination for archive.
 */
function business_classified_ads_render_posts_pagination() {
    // Get the setting to check if pagination is enabled
    $business_classified_ads_is_pagination_enabled = get_theme_mod( 'business_classified_ads_enable_pagination', true );

    // Check if pagination is enabled
    if ( $business_classified_ads_is_pagination_enabled ) {
        // Get the selected pagination type from the Customizer
        $business_classified_ads_pagination_type = get_theme_mod( 'business_classified_ads_theme_pagination_type', 'numeric' );

        // Check if the pagination type is "newer_older" (Previous/Next) or "numeric"
        if ( 'newer_older' === $business_classified_ads_pagination_type ) :
            // Display "Newer/Older" pagination (Previous/Next navigation)
            the_posts_navigation(
                array(
                    'prev_text' => __( '&laquo; Newer', 'business-classified-ads' ),  // Change the label for "previous"
                    'next_text' => __( 'Older &raquo;', 'business-classified-ads' ),  // Change the label for "next"
                    'screen_reader_text' => __( 'Posts navigation', 'business-classified-ads' ),
                )
            );
        else :
            // Display numeric pagination (Page numbers)
            the_posts_pagination(
                array(
                    'prev_text' => __( '&laquo; Previous', 'business-classified-ads' ),
                    'next_text' => __( 'Next &raquo;', 'business-classified-ads' ),
                    'type'      => 'list', // Display as <ul> <li> tags
                    'screen_reader_text' => __( 'Posts navigation', 'business-classified-ads' ),
                )
            );
        endif;
    }
}
add_action( 'business_classified_ads_posts_pagination', 'business_classified_ads_render_posts_pagination', 10 );