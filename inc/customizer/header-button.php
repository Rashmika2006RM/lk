<?php
/**
* Header Options.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

// Header Section.
$wp_customize->add_section( 'button_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'business-classified-ads' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'business_classified_ads_theme_option_panel',
	)
);

$wp_customize->add_setting('business_classified_ads_sticky',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_sticky'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_sticky',
    array(
        'label' => esc_html__('Enable Sticky Header', 'business-classified-ads'),
        'section' => 'button_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_menu_font_size',
    array(
        'default'           => $business_classified_ads_default['business_classified_ads_menu_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
    )
);
$wp_customize->add_control('business_classified_ads_menu_font_size',
    array(
        'label'       => esc_html__('Menu Font Size', 'business-classified-ads'),
        'section'     => 'button_header_setting',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 30,
           'step'   => 1,
        ),
    )
);

$wp_customize->add_setting( 'business_classified_ads_menu_text_transform',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_menu_text_transform'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_menu_transform',
    )
);
$wp_customize->add_control( 'business_classified_ads_menu_text_transform',
    array(
    'label'       => esc_html__( 'Menu Text Transform', 'business-classified-ads' ),
    'section'     => 'button_header_setting',
    'type'        => 'select',
    'choices'     => array(
        'capitalize' => esc_html__( 'Capitalize', 'business-classified-ads' ),
        'uppercase'  => esc_html__( 'Uppercase', 'business-classified-ads' ),
        'lowercase'    => esc_html__( 'Lowercase', 'business-classified-ads' ),
        ),
    )
);


$wp_customize->add_setting( 'business_classified_ads_header_layout_button_text',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_header_layout_button_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_header_layout_button_text',
    array(
    'label'    => esc_html__( 'Button Text', 'business-classified-ads' ),
    'section'  => 'button_header_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'business_classified_ads_header_layout_button_link',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_header_layout_button_link'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_header_layout_button_link',
    array(
    'label'    => esc_html__( 'Button Url', 'business-classified-ads' ),
    'section'  => 'button_header_setting',
    'type'     => 'url',
    )
);