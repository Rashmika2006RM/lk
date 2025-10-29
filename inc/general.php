<?php

function business_classified_ads_enqueue_fonts() {
    $business_classified_ads_default_font_content = 'inter';
    $business_classified_ads_default_font_heading = 'inter';

    $business_classified_ads_font_content = esc_attr(get_theme_mod('business_classified_ads_content_typography_font', $business_classified_ads_default_font_content));
    $business_classified_ads_font_heading = esc_attr(get_theme_mod('business_classified_ads_heading_typography_font', $business_classified_ads_default_font_heading));

    $business_classified_ads_css = '';

    // Always enqueue main font
    $business_classified_ads_css .= '
    :root {
        --font-main: ' . $business_classified_ads_font_content . ', ' . (in_array($business_classified_ads_font_content, ['inter', ' ']) ? 'serif' : 'sans-serif') . '!important;
    }';
    wp_enqueue_style('business-classified-ads-style-font-general', get_template_directory_uri() . '/fonts/' . $business_classified_ads_font_content . '/font.css');

    // Always enqueue header font
    $business_classified_ads_css .= '
    :root {
        --font-head: ' . $business_classified_ads_font_heading . ', ' . (in_array($business_classified_ads_font_heading, ['inter', 'inter']) ? 'serif' : 'sans-serif') . '!important;
    }';
    wp_enqueue_style('business-classified-ads-style-font-h', get_template_directory_uri() . '/fonts/' . $business_classified_ads_font_heading . '/font.css');

    // Add inline style
    wp_add_inline_style('business-classified-ads-style-font-general', $business_classified_ads_css);
}
add_action('wp_enqueue_scripts', 'business_classified_ads_enqueue_fonts', 50);