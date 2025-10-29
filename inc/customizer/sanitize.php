<?php
/**
* Custom Functions.
*
* @package Business Classified Ads
*/

if( !function_exists( 'business_classified_ads_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function business_classified_ads_sanitize_sidebar_option( $business_classified_ads_input ){

        $business_classified_ads_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $business_classified_ads_input,$business_classified_ads_metabox_options ) ){

            return $business_classified_ads_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'business_classified_ads_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function business_classified_ads_sanitize_checkbox( $business_classified_ads_checked ) {

		return ( ( isset( $business_classified_ads_checked ) && true === $business_classified_ads_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'business_classified_ads_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function business_classified_ads_sanitize_select( $business_classified_ads_input, $business_classified_ads_setting ) {
        $business_classified_ads_input = sanitize_text_field( $business_classified_ads_input );
        $choices = $business_classified_ads_setting->manager->get_control( $business_classified_ads_setting->id )->choices;
        return ( array_key_exists( $business_classified_ads_input, $choices ) ? $business_classified_ads_input : $business_classified_ads_setting->default );
    }

endif;