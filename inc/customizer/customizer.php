<?php
/**
 * Business Classified Ads Theme Customizer
 * @package Business Classified Ads
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

if (!function_exists('business_classified_ads_customize_register')) :

function business_classified_ads_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/header-button.php';
	require get_template_directory() . '/inc/customizer/custom-addon.php';
	require get_template_directory() . '/inc/customizer/colors.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/footer.php';
	require get_template_directory() . '/inc/customizer/layout-setting.php';
	require get_template_directory() . '/inc/customizer/homepage-content.php';
	require get_template_directory() . '/inc/customizer/typography.php';
	require get_template_directory() . '/inc/customizer/global-color-setting.php';
	require get_template_directory() . '/inc/customizer/additional-woocommerce.php';
	require get_template_directory() . '/inc/customizer/404-page-settings.php';
	require get_template_directory() . '/inc/customizer/nothing-found-page-settings.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','business-classified-ads');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';

	if ( isset( $wp_customize->selective_refresh ) ) {
		
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.header-titles .custom-logo-name',
			'render_callback' => 'business_classified_ads_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'business_classified_ads_customize_partial_blogdescription',
		) );

	}

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'business-classified-ads' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'business-classified-ads' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_footer_option_panel',
		array(
			'title'      => esc_html__( 'Footer Settings', 'business-classified-ads' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Template Options
	$wp_customize->add_panel( 'theme_home_pannel',
		array(
			'title'      => esc_html__( 'Frontpage Settings', 'business-classified-ads' ),
			'priority'   => 4,
			'capability' => 'edit_theme_options',
		)
	);

	// Theme Addons Panel.
	$wp_customize->add_panel( 'business_classified_ads_theme_addons_panel',
		array(
			'title'      => esc_html__( 'Theme Addons', 'business-classified-ads' ),
			'priority'   => 5,
			'capability' => 'edit_theme_options',
		)
	);
	
	// Theme Options Panel.
	$wp_customize->add_panel( 'business_classified_ads_theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'business-classified-ads' ),
			'priority'   => 5,
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_setting('business_classified_ads_logo_width_range',
	    array(
	        'default'           => $business_classified_ads_default['business_classified_ads_logo_width_range'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'business_classified_ads_sanitize_number_range',
	    )
	);
	$wp_customize->add_control('business_classified_ads_logo_width_range',
	    array(
	        'label'       => esc_html__('Logo width', 'business-classified-ads'),
	        'description'       => esc_html__( 'Specify the range for logo size with a minimum of 200px and a maximum of 700px, in increments of 20px.', 'business-classified-ads' ),
	        'section'     => 'title_tagline',
	        'type'        => 'range',
	        'input_attrs' => array(
	           'min'   => 100,
	           'max'   => 700,
	           'step'   => 20,
        	),
	    )
	);

	// Register custom section types.
	$wp_customize->register_section_type( 'Business_Classified_Ads_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Business_Classified_Ads_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Business Classified Ads', 'business-classified-ads' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'business-classified-ads' ),
				'pro_url'  => esc_url('https://www.omegathemes.com/products/classified-ads-wordpress-theme'),
				'priority'  => 1,
			)
		)
	);
	
	// Register second custom section (Buy Bundle)
	$wp_customize->add_section(
		new Business_Classified_Ads_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell_bundle',
			array(
				'title'    => esc_html__( 'Buy WP Theme Bundle', 'business-classified-ads' ),
				'pro_text' => esc_html__( 'Get Bundle', 'business-classified-ads' ),
				'pro_url'  => esc_url( 'https://www.omegathemes.com/products/wp-theme-bundle' ),
				'priority' => 2,
			)
		)
	);
}

endif;
add_action( 'customize_register', 'business_classified_ads_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('business_classified_ads_customizer_scripts')) :

    function business_classified_ads_customizer_scripts(){
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('business-classified-ads-customizer', get_template_directory_uri() . '/lib/custom/css/customizer.css');
        wp_enqueue_script('business-classified-ads-customizer', get_template_directory_uri() . '/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);

        $ajax_nonce = wp_create_nonce('business_classified_ads_ajax_nonce');
        wp_localize_script( 
		    'business-classified-ads-customizer',
		    'business_classified_ads_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'business_classified_ads_customizer_scripts');
add_action('customize_controls_init', 'business_classified_ads_customizer_scripts');

function business_classified_ads_customize_preview_js() {
	wp_enqueue_script( 'business-classified-ads-customizer-preview', get_template_directory_uri() . '/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '', true );
}
add_action( 'customize_preview_init', 'business_classified_ads_customize_preview_js' );

if (!function_exists('business_classified_ads_customize_partial_blogname')) :
	function business_classified_ads_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

if (!function_exists('business_classified_ads_customize_partial_blogdescription')) :
	function business_classified_ads_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
endif;