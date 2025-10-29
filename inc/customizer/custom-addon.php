<?php
/**
* Custom Addons.
*
* @package Business Classified Ads
*/

$wp_customize->add_section( 'business_classified_ads_theme_pagination_options',
    array(
    'title'      => esc_html__( 'Customizer Custom Settings', 'business-classified-ads' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'business_classified_ads_theme_addons_panel',
    )
);

$wp_customize->add_setting('business_classified_ads_theme_loader',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_theme_loader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_theme_loader',
    array(
        'label' => esc_html__('Enable Preloader', 'business-classified-ads'),
        'section' => 'business_classified_ads_theme_pagination_options',
        'type' => 'checkbox',
    )
);

// Add Pagination Enable/Disable option to Customizer
$wp_customize->add_setting( 'business_classified_ads_enable_pagination', 
    array(
        'default'           => true, // Default is enabled
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_enable_pagination', // Sanitize the input
    )
);

// Add the control to the Customizer
$wp_customize->add_control( 'business_classified_ads_enable_pagination', 
    array(
        'label'    => esc_html__( 'Enable Pagination', 'business-classified-ads' ),
        'section'  => 'business_classified_ads_theme_pagination_options', // Add to the correct section
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting( 'business_classified_ads_theme_pagination_type', 
    array(
        'default'           => 'numeric', // Set "numeric" as the default
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_pagination_type', // Use our sanitize function
    )
);

$wp_customize->add_control( 'business_classified_ads_theme_pagination_type',
    array(
        'label'       => esc_html__( 'Pagination Style', 'business-classified-ads' ),
        'section'     => 'business_classified_ads_theme_pagination_options',
        'type'        => 'select',
        'choices'     => array(
            'numeric'      => esc_html__( 'Numeric (Page Numbers)', 'business-classified-ads' ),
            'newer_older'  => esc_html__( 'Newer/Older (Previous/Next)', 'business-classified-ads' ), // Renamed to "Newer/Older"
        ),
    )
);

$wp_customize->add_setting( 'business_classified_ads_theme_pagination_options_alignment',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_theme_pagination_options_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'business_classified_ads_theme_pagination_options_alignment',
    array(
    'label'       => esc_html__( 'Pagination Alignment', 'business-classified-ads' ),
    'section'     => 'business_classified_ads_theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'business-classified-ads' ),
        'Right' => esc_html__( 'Right', 'business-classified-ads' ),
        'Left'  => esc_html__( 'Left', 'business-classified-ads' ),
        ),
    )
);

$wp_customize->add_setting('business_classified_ads_theme_breadcrumb_enable',
array(
    'default' => $business_classified_ads_default['business_classified_ads_theme_breadcrumb_enable'],
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
)
);
$wp_customize->add_control('business_classified_ads_theme_breadcrumb_enable',
    array(
        'label' => esc_html__('Enable Breadcrumb', 'business-classified-ads'),
        'section' => 'business_classified_ads_theme_pagination_options',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'business_classified_ads_theme_breadcrumb_options_alignment',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_theme_breadcrumb_options_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'business_classified_ads_theme_breadcrumb_options_alignment',
    array(
    'label'       => esc_html__( 'Breadcrumb Alignment', 'business-classified-ads' ),
    'section'     => 'business_classified_ads_theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'business-classified-ads' ),
        'Right' => esc_html__( 'Right', 'business-classified-ads' ),
        'Left'  => esc_html__( 'Left', 'business-classified-ads' ),
        ),
    )
);

$wp_customize->add_setting('business_classified_ads_breadcrumb_font_size',
    array(
        'default'           => $business_classified_ads_default['business_classified_ads_breadcrumb_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
    )
);
$wp_customize->add_control('business_classified_ads_breadcrumb_font_size',
    array(
        'label'       => esc_html__('Breadcrumb Font Size', 'business-classified-ads'),
        'section'     => 'business_classified_ads_theme_pagination_options',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 45,
           'step'   => 1,
        ),
    )
);