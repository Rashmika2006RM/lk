<?php
/**
* Footer Settings.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

$wp_customize->add_section( 'business_classified_ads_footer_widget_area',
	array(
	'title'      => esc_html__( 'Footer Settings', 'business-classified-ads' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'business_classified_ads_theme_option_panel',
	)
);

$wp_customize->add_setting('business_classified_ads_display_footer',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_display_footer'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_display_footer',
    array(
        'label' => esc_html__('Enable Footer', 'business-classified-ads'),
        'section' => 'business_classified_ads_footer_widget_area',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'business_classified_ads_footer_column_layout',
	array(
	'default'           => $business_classified_ads_default['business_classified_ads_footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'business_classified_ads_sanitize_select',
	)
);
$wp_customize->add_control( 'business_classified_ads_footer_column_layout',
	array(
	'label'       => esc_html__( 'Footer Column Layout', 'business-classified-ads' ),
	'section'     => 'business_classified_ads_footer_widget_area',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'business-classified-ads' ),
		'2' => esc_html__( 'Two Column', 'business-classified-ads' ),
		'3' => esc_html__( 'Three Column', 'business-classified-ads' ),
	    ),
	)
);

$wp_customize->add_setting( 'business_classified_ads_footer_copyright_text',
	array(
	'default'           => $business_classified_ads_default['business_classified_ads_footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'business_classified_ads_footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'business-classified-ads' ),
	'section'  => 'business_classified_ads_footer_widget_area',
	'type'     => 'text',
	)
);

$wp_customize->add_setting('business_classified_ads_copyright_font_size',
    array(
        'default'           => $business_classified_ads_default['business_classified_ads_copyright_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
    )
);
$wp_customize->add_control('business_classified_ads_copyright_font_size',
    array(
        'label'       => esc_html__('Copyright Font Size', 'business-classified-ads'),
        'section'     => 'business_classified_ads_footer_widget_area',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 5,
           'max'   => 30,
           'step'   => 1,
    	),
    )
);

$wp_customize->add_setting( 'business_classified_ads_copyright_alignment', array(
    'default'           => 'Default',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_copyright_alignment_meta',
) );

$wp_customize->add_control( 'business_classified_ads_copyright_alignment', array(
    'label'    => esc_html__( 'Copyright Section Alignment', 'business-classified-ads' ),
    'section'  => 'business_classified_ads_footer_widget_area',
    'type'     => 'select',
    'choices'  => array(
        'Default' => esc_html__( 'Default View', 'business-classified-ads' ),
        'Reverse' => esc_html__( 'Reverse View', 'business-classified-ads' ),
        'Center'  => esc_html__( 'Centered Content', 'business-classified-ads' ),
    ),
) );

$wp_customize->add_setting( 'business_classified_ads_footer_widget_background_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
));
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'business_classified_ads_footer_widget_background_color', array(
    'label'     => __('Footer Widget Background Color', 'business-classified-ads'),
    'description' => __('It will change the complete footer widget background color.', 'business-classified-ads'),
    'section' => 'business_classified_ads_footer_widget_area',
    'settings' => 'business_classified_ads_footer_widget_background_color',
)));

$wp_customize->add_setting('business_classified_ads_footer_widget_background_image',array(
    'default'   => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'business_classified_ads_footer_widget_background_image',array(
    'label' => __('Footer Widget Background Image','business-classified-ads'),
    'section' => 'business_classified_ads_footer_widget_area'
)));

$wp_customize->add_setting( 'business_classified_ads_footer_widget_title_alignment',
        array(
        'default'           => $business_classified_ads_default['business_classified_ads_footer_widget_title_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_footer_widget_title_alignment',
        )
    );
    $wp_customize->add_control( 'business_classified_ads_footer_widget_title_alignment',
        array(
        'label'       => esc_html__( 'Footer Widget Title Alignment', 'business-classified-ads' ),
        'section'     => 'business_classified_ads_footer_widget_area',
        'type'        => 'select',
        'choices'     => array(
            'left' => esc_html__( 'Left', 'business-classified-ads' ),
            'center'  => esc_html__( 'Center', 'business-classified-ads' ),
            'right'    => esc_html__( 'Right', 'business-classified-ads' ),
            ),
        )
    );

$wp_customize->add_setting('business_classified_ads_enable_to_the_top',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_enable_to_the_top'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_enable_to_the_top',
    array(
        'label' => esc_html__('Enable To The Top', 'business-classified-ads'),
        'section' => 'business_classified_ads_footer_widget_area',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'business_classified_ads_to_the_top_text',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_to_the_top_text'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_to_the_top_text',
    array(
    'label'    => esc_html__( 'Edit Text Here', 'business-classified-ads' ),
    'section'  => 'business_classified_ads_footer_widget_area',
    'type'     => 'text',
    )
);