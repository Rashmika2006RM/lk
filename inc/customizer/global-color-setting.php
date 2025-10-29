<?php
/**
* Global Color Settings.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'business_classified_ads_global_color_setting',
	array(
	'title'      => esc_html__( 'Global Color Settings', 'business-classified-ads' ),
	'priority'   => 21,
	'capability' => 'edit_theme_options',
	'panel'      => 'business_classified_ads_theme_option_panel',
	)
);

$wp_customize->add_setting( 'business_classified_ads_global_color',
    array(
    'default'           => '#F87B54',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'business_classified_ads_global_color',
    array(
        'label'      => esc_html__( 'Global Color', 'business-classified-ads' ),
        'section'    => 'business_classified_ads_global_color_setting',
        'settings'   => 'business_classified_ads_global_color',
    ) ) 
);