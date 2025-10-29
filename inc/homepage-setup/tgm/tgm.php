<?php

	require get_template_directory() . '/inc/homepage-setup/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function business_classified_ads_register_recommended_plugins() {
	$plugins = array(
		
		array(
			'name'             => __( 'Posts Like Dislike', 'business-classified-ads' ),
			'slug'             => 'posts-like-dislike',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Easy Post Views Count', 'business-classified-ads' ),
			'slug'             => 'easy-post-views-count',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'WooCommerce', 'business-classified-ads' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Contact Form 7', 'business-classified-ads' ),
			'slug'             => 'contact-form-7',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		)

	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'business_classified_ads_register_recommended_plugins' );