<?php
/**
* Typography Settings.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'business_classified_ads_typography_setting',
	array(
	'title'      => esc_html__( 'Typography Settings', 'business-classified-ads' ),
	'priority'   => 21,
	'capability' => 'edit_theme_options',
	'panel'      => 'business_classified_ads_theme_option_panel',
	)
);

// -----------------  Font array
$business_classified_ads_fonts = array(
    'Select'           => __('Default Font', 'business-classified-ads'),
    'bad-script' => 'Bad Script',
    'cuprum'     => 'Cuprum',
    'exo-2'      => 'Exo 2',
    'jost'       => 'Jost',
    'oswald'     => 'Oswald',
    'inter'       => 'Inter',
);

 // -----------------  General text font
 $wp_customize->add_setting( 'business_classified_ads_content_typography_font', array(
    'default'           => 'inter',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_radio_sanitize',
) );
$wp_customize->add_control( 'business_classified_ads_content_typography_font', array(
    'type'     => 'select',
    'label'    => esc_html__( 'General Content Font', 'business-classified-ads' ),
    'section'  => 'business_classified_ads_typography_setting',
    'settings' => 'business_classified_ads_content_typography_font',
    'choices'  => $business_classified_ads_fonts,
) );

 // -----------------  General Heading Font
$wp_customize->add_setting( 'business_classified_ads_heading_typography_font', array(
    'default'           => 'inter',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_radio_sanitize',
) );
$wp_customize->add_control( 'business_classified_ads_heading_typography_font', array(
    'type'     => 'select',
    'label'    => esc_html__( 'General Heading Font', 'business-classified-ads' ),
    'section'  => 'business_classified_ads_typography_setting',
    'settings' => 'business_classified_ads_heading_typography_font',
    'choices'  => $business_classified_ads_fonts,
) );