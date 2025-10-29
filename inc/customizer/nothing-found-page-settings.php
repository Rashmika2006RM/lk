<?php
/**
* Noting Found Page Settings.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

$wp_customize->add_section( 'business_classified_ads_noting_found_page_settings',
    array(
        'title'      => esc_html__( 'Noting Found Page Settings', 'business-classified-ads' ),
        'priority'   => 200,
        'capability' => 'edit_theme_options',
        'panel'      => 'business_classified_ads_theme_addons_panel',
    )
);

$wp_customize->add_setting( 'business_classified_ads_noting_found_main_title',
    array(
        'default'           => 'Nothing Found',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_noting_found_main_title',
    array(
        'label'    => esc_html__( 'Main Title', 'business-classified-ads' ),
        'section'  => 'business_classified_ads_noting_found_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'business_classified_ads_noting_found_para',
    array(
        'default'           => 'Sorry, but nothing matched your search terms. Please try again with some different keywords.',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_noting_found_para',
    array(
        'label'    => esc_html__( 'Para Text', 'business-classified-ads' ),
        'section'  => 'business_classified_ads_noting_found_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting('business_classified_ads_noting_found_saerch',
    array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_noting_found_saerch',
    array(
        'label' => esc_html__('Enable/Disable Search', 'business-classified-ads'),
        'section' => 'business_classified_ads_noting_found_page_settings',
        'type' => 'checkbox',
    )
);