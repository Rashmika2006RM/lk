<?php
/**
* Layouts Settings.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'business_classified_ads_layout_setting',
	array(
	'title'      => esc_html__( 'Sidebar Settings', 'business-classified-ads' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'      => 'business_classified_ads_theme_option_panel',
	)
);

$wp_customize->add_setting( 'business_classified_ads_global_sidebar_layout',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_sidebar_option',
    )
);
$wp_customize->add_control( 'business_classified_ads_global_sidebar_layout',
    array(
    'label'       => esc_html__( 'Global Sidebar Layout', 'business-classified-ads' ),
    'section'     => 'business_classified_ads_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__( 'Right Sidebar', 'business-classified-ads' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'business-classified-ads' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'business-classified-ads' ),
        ),
    )
);

$wp_customize->add_setting('business_classified_ads_page_sidebar_layout', array(
    'default'           => $business_classified_ads_default['business_classified_ads_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_sidebar_option',
));

$wp_customize->add_control('business_classified_ads_page_sidebar_layout', array(
    'label'       => esc_html__('Single Page Sidebar Layout', 'business-classified-ads'),
    'section'     => 'business_classified_ads_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__('Right Sidebar', 'business-classified-ads'),
        'left-sidebar'  => esc_html__('Left Sidebar', 'business-classified-ads'),
        'no-sidebar'    => esc_html__('No Sidebar', 'business-classified-ads'),
    ),
));

$wp_customize->add_setting('business_classified_ads_post_sidebar_layout', array(
    'default'           => $business_classified_ads_default['business_classified_ads_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_sidebar_option',
));

$wp_customize->add_control('business_classified_ads_post_sidebar_layout', array(
    'label'       => esc_html__('Single Post Sidebar Layout', 'business-classified-ads'),
    'section'     => 'business_classified_ads_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__('Right Sidebar', 'business-classified-ads'),
        'left-sidebar'  => esc_html__('Left Sidebar', 'business-classified-ads'),
        'no-sidebar'    => esc_html__('No Sidebar', 'business-classified-ads'),
    ),
));

$wp_customize->add_setting('business_classified_ads_sticky_sidebar',
    array(
        'default'           => true,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_sticky_sidebar',
    array(
        'label' => esc_html__('Enable/Disable Sticky Sidebar', 'business-classified-ads'),
        'section' => 'business_classified_ads_layout_setting',
        'type' => 'checkbox',
    )
);