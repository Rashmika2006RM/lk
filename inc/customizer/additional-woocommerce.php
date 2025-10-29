<?php
/**
* Additional Woocommerce Settings.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

// Additional Woocommerce Section.
$wp_customize->add_section( 'business_classified_ads_additional_woocommerce_options',
	array(
	'title'      => esc_html__( 'Additional Woocommerce Options', 'business-classified-ads' ),
	'priority'   => 210,
	'capability' => 'edit_theme_options',
	'panel'      => 'business_classified_ads_theme_option_panel',
	)
);

	$wp_customize->add_setting('business_classified_ads_per_columns',
		array(
		'default'           => $business_classified_ads_default['business_classified_ads_per_columns'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
		)
	);
	$wp_customize->add_control('business_classified_ads_per_columns',
		array(
		'label'       => esc_html__('Products Per Column', 'business-classified-ads'),
		'section'     => 'business_classified_ads_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 6,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('business_classified_ads_product_per_page',
		array(
		'default'           => $business_classified_ads_default['business_classified_ads_product_per_page'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
		)
	);
	$wp_customize->add_control('business_classified_ads_product_per_page',
		array(
		'label'       => esc_html__('Products Per Page', 'business-classified-ads'),
		'section'     => 'business_classified_ads_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 100,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('business_classified_ads_show_hide_related_product',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_show_hide_related_product'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
	);
	$wp_customize->add_control('business_classified_ads_show_hide_related_product',
	    array(
	        'label' => esc_html__('Enable Related Products', 'business-classified-ads'),
	        'section' => 'business_classified_ads_additional_woocommerce_options',
	        'type' => 'checkbox',
	    )
	);

	$wp_customize->add_setting('business_classified_ads_custom_related_products_number',
		array(
		'default'           => $business_classified_ads_default['business_classified_ads_custom_related_products_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
		)
	);
	$wp_customize->add_control('business_classified_ads_custom_related_products_number',
		array(
		'label'       => esc_html__('Related Products Per Page', 'business-classified-ads'),
		'section'     => 'business_classified_ads_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 10,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('business_classified_ads_custom_related_products_number_per_row',
		array(
		'default'           => $business_classified_ads_default['business_classified_ads_custom_related_products_number_per_row'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
		)
	);
	$wp_customize->add_control('business_classified_ads_custom_related_products_number_per_row',
		array(
		'label'       => esc_html__('Related Products Per Row', 'business-classified-ads'),
		'section'     => 'business_classified_ads_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 5,
		'step'   => 1,
		),
		)
	);