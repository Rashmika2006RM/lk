<?php
/**
 * Settings for demo import
 *
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
require trailingslashit( WHIZZIE_DIR ) . 'homepage-setup-contents.php';
$business_classified_ads_current_theme = wp_get_theme();
$business_classified_ads_theme_title = $business_classified_ads_current_theme->get( 'Name' );


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['business_classified_ads_page_slug'] 	= 'business-classified-ads';
$config['business_classified_ads_page_title']	= 'Homepage Setup';

$config['steps'] = array(
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Install and Activate Essential Plugins', 'business-classified-ads' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', 'business-classified-ads' ),
		'can_skip'		=> true
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Setup Home Page', 'business-classified-ads' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text'	=> __( 'Start Home Page Setup', 'business-classified-ads' ),
		'can_skip'		=> true
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'Customize Your Site', 'business-classified-ads' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'Business_Classified_Ads_Whizzie' ) ) {
	$Business_Classified_Ads_Whizzie = new Business_Classified_Ads_Whizzie( $config );
}