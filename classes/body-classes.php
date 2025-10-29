<?php
/**
 * Body Classes.
 * @package Business Classified Ads
 */

if (!function_exists('business_classified_ads_body_classes')) :

    function business_classified_ads_body_classes($business_classified_ads_classes)
    {
        $business_classified_ads_defaults = business_classified_ads_get_default_theme_options();
        $business_classified_ads_layout = business_classified_ads_get_final_sidebar_layout();

        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) {
            $business_classified_ads_classes[] = 'hfeed';
        }

        // Sidebar layout logic
        $business_classified_ads_classes[] = $business_classified_ads_layout;

        // Copyright alignment
        $copyright_alignment = get_theme_mod('business_classified_ads_copyright_alignment', 'Default');
        $business_classified_ads_classes[] = 'copyright-' . strtolower($copyright_alignment);

        return $business_classified_ads_classes;
    }

endif;

add_filter('body_class', 'business_classified_ads_body_classes');