<?php
/**
* Color Settings.
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

$wp_customize->add_setting( 'business_classified_ads_default_text_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'business_classified_ads_default_text_color',
    array(
        'label'      => esc_html__( 'Text Color', 'business-classified-ads' ),
        'section'    => 'colors',
        'settings'   => 'business_classified_ads_default_text_color',
    ) ) 
);

$wp_customize->add_setting( 'business_classified_ads_border_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'business_classified_ads_border_color',
    array(
        'label'      => esc_html__( 'Border Color', 'business-classified-ads' ),
        'section'    => 'colors',
        'settings'   => 'business_classified_ads_border_color',
    ) ) 
);