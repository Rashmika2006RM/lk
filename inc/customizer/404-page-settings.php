<?php
/**
* 404 Page Settings.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

$wp_customize->add_section( 'business_classified_ads_404_page_settings',
    array(
        'title'      => esc_html__( '404 Page Settings', 'business-classified-ads' ),
        'priority'   => 200,
        'capability' => 'edit_theme_options',
        'panel'      => 'business_classified_ads_theme_addons_panel',
    )
);

$wp_customize->add_setting( 'business_classified_ads_404_main_title',
    array(
        'default'           => $business_classified_ads_default['business_classified_ads_404_main_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_404_main_title',
    array(
        'label'    => esc_html__( '404 Main Title', 'business-classified-ads' ),
        'section'  => 'business_classified_ads_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'business_classified_ads_404_subtitle_one',
    array(
        'default'           => $business_classified_ads_default['business_classified_ads_404_subtitle_one'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_404_subtitle_one',
    array(
        'label'    => esc_html__( '404 Sub Title One', 'business-classified-ads' ),
        'section'  => 'business_classified_ads_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'business_classified_ads_404_para_one',
    array(
        'default'           => $business_classified_ads_default['business_classified_ads_404_para_one'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_404_para_one',
    array(
        'label'    => esc_html__( '404 Para Text One', 'business-classified-ads' ),
        'section'  => 'business_classified_ads_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'business_classified_ads_404_subtitle_two',
    array(
        'default'           => $business_classified_ads_default['business_classified_ads_404_subtitle_two'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_404_subtitle_two',
    array(
        'label'    => esc_html__( '404 Sub Title Two', 'business-classified-ads' ),
        'section'  => 'business_classified_ads_404_page_settings',
        'type'     => 'text',
    )
);

$wp_customize->add_setting( 'business_classified_ads_404_para_two',
    array(
        'default'           => $business_classified_ads_default['business_classified_ads_404_para_two'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_404_para_two',
    array(
        'label'    => esc_html__( '404 Para Text Two', 'business-classified-ads' ),
        'section'  => 'business_classified_ads_404_page_settings',
        'type'     => 'text',
    )
);