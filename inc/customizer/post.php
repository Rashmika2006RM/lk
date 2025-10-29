<?php
/**
* Posts Settings.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'business_classified_ads_single_posts_settings',
    array(
    'title'      => esc_html__( 'Single Meta Information Settings', 'business-classified-ads' ),
    'priority'   => 35,
    'capability' => 'edit_theme_options',
    'panel'      => 'business_classified_ads_theme_option_panel',
    )
);

$wp_customize->add_setting('business_classified_ads_display_single_post_image',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_display_single_post_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_display_single_post_image',
    array(
        'label' => esc_html__('Enable Single Posts Image', 'business-classified-ads'),
        'section' => 'business_classified_ads_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_post_author',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'business-classified-ads'),
        'section' => 'business_classified_ads_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_post_date',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'business-classified-ads'),
        'section' => 'business_classified_ads_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_post_category',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'business-classified-ads'),
        'section' => 'business_classified_ads_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_post_tags',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'business-classified-ads'),
        'section' => 'business_classified_ads_single_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'business_classified_ads_single_page_content_alignment',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_single_page_content_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_page_content_alignment',
    )
);
$wp_customize->add_control( 'business_classified_ads_single_page_content_alignment',
    array(
    'label'       => esc_html__( 'Single Page Content Alignment', 'business-classified-ads' ),
    'section'     => 'business_classified_ads_single_posts_settings',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'business-classified-ads' ),
        'center'  => esc_html__( 'Center', 'business-classified-ads' ),
        'right'    => esc_html__( 'Right', 'business-classified-ads' ),
        ),
    )
);

$wp_customize->add_setting( 'business_classified_ads_single_post_content_alignment',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_single_post_content_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_page_content_alignment',
    )
);
$wp_customize->add_control( 'business_classified_ads_single_post_content_alignment',
    array(
    'label'       => esc_html__( 'Single Post Content Alignment', 'business-classified-ads' ),
    'section'     => 'business_classified_ads_single_posts_settings',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'business-classified-ads' ),
        'center'  => esc_html__( 'Center', 'business-classified-ads' ),
        'right'    => esc_html__( 'Right', 'business-classified-ads' ),
        ),
    )
);

// Archive Post Section.
$wp_customize->add_section( 'business_classified_ads_posts_settings',
    array(
    'title'      => esc_html__( 'Archive Meta Information Settings', 'business-classified-ads' ),
    'priority'   => 36,
    'capability' => 'edit_theme_options',
    'panel'      => 'business_classified_ads_theme_option_panel',
    )
);

$wp_customize->add_setting('business_classified_ads_display_archive_post_format_icon',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_display_archive_post_format_icon'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_display_archive_post_format_icon',
    array(
        'label' => esc_html__('Enable Posts Format Icon', 'business-classified-ads'),
        'section' => 'business_classified_ads_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_display_archive_post_image',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_display_archive_post_image'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_display_archive_post_image',
    array(
        'label' => esc_html__('Enable Posts Image', 'business-classified-ads'),
        'section' => 'business_classified_ads_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_display_archive_post_category',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_display_archive_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_display_archive_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'business-classified-ads'),
        'section' => 'business_classified_ads_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_display_archive_post_title',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_display_archive_post_title'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_display_archive_post_title',
    array(
        'label' => esc_html__('Enable Posts Title', 'business-classified-ads'),
        'section' => 'business_classified_ads_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_display_archive_post_content',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_display_archive_post_content'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_display_archive_post_content',
    array(
        'label' => esc_html__('Enable Posts Content', 'business-classified-ads'),
        'section' => 'business_classified_ads_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_display_archive_post_button',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_display_archive_post_button'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_display_archive_post_button',
    array(
        'label' => esc_html__('Enable Posts Button', 'business-classified-ads'),
        'section' => 'business_classified_ads_posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_excerpt_limit',
    array(
        'default'           => $business_classified_ads_default['business_classified_ads_excerpt_limit'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
    )
);
$wp_customize->add_control('business_classified_ads_excerpt_limit',
    array(
        'label'       => esc_html__('Blog Posts Excerpt limit', 'business-classified-ads'),
        'section'     => 'business_classified_ads_posts_settings',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 100,
           'step'   => 1,
        ),
    )
);

$wp_customize->add_setting( 'business_classified_ads_archive_image_size',
	array(
	'default'           => 'medium',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'business_classified_ads_sanitize_select',
	)
);
$wp_customize->add_control( 'business_classified_ads_archive_image_size',
	array(
	'label'       => esc_html__( 'Blog Posts Image Size', 'business-classified-ads' ),
	'section'     => 'business_classified_ads_posts_settings',
	'type'        => 'select',
	'choices'               => array(
		'full' => esc_html__( 'Large Size Image', 'business-classified-ads' ),
		'large' => esc_html__( 'Big Size Image', 'business-classified-ads' ),
		'medium' => esc_html__( 'Medium Size Image', 'business-classified-ads' ),
		'small' => esc_html__( 'Small Size Image', 'business-classified-ads' ),
		'xsmall' => esc_html__( 'Extra Small Size Image', 'business-classified-ads' ),
		'thumbnail' => esc_html__( 'Thumbnail Size Image', 'business-classified-ads' ),
	    ),
	)
);

$wp_customize->add_setting('business_classified_ads_posts_per_columns',
    array(
    'default'           => '3',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
    )
);
$wp_customize->add_control('business_classified_ads_posts_per_columns',
    array(
    'label'       => esc_html__('Blog Posts Per Column', 'business-classified-ads'),
    'section'     => 'business_classified_ads_posts_settings',
    'type'        => 'number',
    'input_attrs' => array(
    'min'   => 1,
    'max'   => 5,
    'step'   => 1,
    ),
    )
);