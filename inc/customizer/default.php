<?php
/**
 * Default Values.
 *
 * @package Business Classified Ads
 */

if ( ! function_exists( 'business_classified_ads_get_default_theme_options' ) ) :
	function business_classified_ads_get_default_theme_options() {

		$business_classified_ads_defaults = array();
		
        // Options.
        $business_classified_ads_defaults['business_classified_ads_logo_width_range']  = 200;
	    $business_classified_ads_defaults['business_classified_ads_global_sidebar_layout'] = 'right-sidebar';
        $business_classified_ads_defaults['business_classified_ads_header_search'] = 0;
        $business_classified_ads_defaults['business_classified_ads_display_header_toggle'] = 0;
        $business_classified_ads_defaults['business_classified_ads_theme_pagination_options_alignment'] = 'Center';
        $business_classified_ads_defaults['business_classified_ads_theme_breadcrumb_options_alignment'] = 'Left';
        $business_classified_ads_defaults['business_classified_ads_pagination_layout'] = 'numeric';
        $business_classified_ads_defaults['business_classified_ads_menu_text_transform'] = 'capitalize';
        $business_classified_ads_defaults['business_classified_ads_single_page_content_alignment'] = 'left';
        $business_classified_ads_defaults['business_classified_ads_footer_column_layout'] = 3;
        $business_classified_ads_defaults['business_classified_ads_menu_font_size'] = 16;
        $business_classified_ads_defaults['business_classified_ads_copyright_font_size'] = 16;
        $business_classified_ads_defaults['business_classified_ads_breadcrumb_font_size'] = 16;
        $business_classified_ads_defaults['business_classified_ads_excerpt_limit'] = 20;
        $business_classified_ads_defaults['business_classified_ads_per_columns'] = 3;
        $business_classified_ads_defaults['business_classified_ads_product_per_page'] = 9;
        $business_classified_ads_defaults['business_classified_ads_custom_related_products_number'] = 6;
        $business_classified_ads_defaults['business_classified_ads_custom_related_products_number_per_row'] = 3;
        $business_classified_ads_defaults['business_classified_ads_footer_copyright_text'] = esc_html__( 'All rights reserved.', 'business-classified-ads' );
        $business_classified_ads_defaults['twp_navigation_type'] = 'theme-normal-navigation';
        $business_classified_ads_defaults['business_classified_ads_post_author'] = 1;
        $business_classified_ads_defaults['business_classified_ads_post_date'] = 1;
        $business_classified_ads_defaults['business_classified_ads_post_category'] = 1;
        $business_classified_ads_defaults['business_classified_ads_post_tags'] = 1;
        $business_classified_ads_defaults['business_classified_ads_floating_next_previous_nav'] = 1;
        $business_classified_ads_defaults['business_classified_ads_category_section'] = 0;
        $business_classified_ads_defaults['business_classified_ads_courses_category_section'] = 0;
        $business_classified_ads_defaults['business_classified_ads_sticky'] = 0;
        $business_classified_ads_defaults['business_classified_ads_background_color'] = '#fff';
        
        $business_classified_ads_defaults['business_classified_ads_display_single_post_image']            = 1;
        $business_classified_ads_defaults['business_classified_ads_display_archive_post_format_icon']       = 1;

        $business_classified_ads_defaults['business_classified_ads_theme_loader']                  = 0;
        $business_classified_ads_defaults['business_classified_ads_theme_breadcrumb_enable']                 = 1;
        $business_classified_ads_defaults['business_classified_ads_single_post_content_alignment']                 = 'left';
        $business_classified_ads_defaults['business_classified_ads_global_color']                                   = '#F87B54';
        $business_classified_ads_defaults['business_classified_ads_display_archive_post_category']          = 1;
        $business_classified_ads_defaults['business_classified_ads_display_archive_post_sticky_post']       = 1;
        $business_classified_ads_defaults['business_classified_ads_display_archive_post_title']             = 1;
        $business_classified_ads_defaults['business_classified_ads_show_hide_related_product']                      = 1;
        $business_classified_ads_defaults['business_classified_ads_display_footer']                                 = 1;
        $business_classified_ads_defaults['business_classified_ads_display_archive_post_content']           = 1;
        $business_classified_ads_defaults['business_classified_ads_display_archive_post_image']            = 1;
        $business_classified_ads_defaults['business_classified_ads_display_archive_post_button']            = 1;
        $business_classified_ads_defaults['business_classified_ads_enable_to_the_top']                      = 1;
        $business_classified_ads_defaults['business_classified_ads_to_the_top_text']                      = esc_html__( 'To The Top', 'business-classified-ads' );
        $business_classified_ads_defaults['business_classified_ads_footer_widget_title_alignment']                 = 'left'; 

        //Header 
        $business_classified_ads_defaults['business_classified_ads_header_layout_wishlist_url']                    = esc_url( '#', 'business-classified-ads' );
        $business_classified_ads_defaults['business_classified_ads_header_layout_button_text']                     = esc_html__( 'log in', 'business-classified-ads' );
        $business_classified_ads_defaults['business_classified_ads_header_layout_button_link']                     = esc_url( '#', 'business-classified-ads' );

        // Top Post 
        $business_classified_ads_defaults['business_classified_ads_top_post_section']                               = 1;
        
        //slider
        $business_classified_ads_defaults['business_classified_ads_header_slider']                                  = 1;

        // Courses Section
        $business_classified_ads_defaults['business_classified_ads_locations_post']                               = 1;
        $business_classified_ads_defaults['business_classified_ads_team_section_title']                             = esc_html__( 'Our Recommend Ads', 'business-classified-ads' );
               
        // Pass through filter.
        $business_classified_ads_defaults = apply_filters( 'business_classified_ads_filter_default_theme_options', $business_classified_ads_defaults );

        // 404 Page Defaults
        $business_classified_ads_defaults['business_classified_ads_404_main_title'] = esc_html__( 'Oops! That page can’t be found.', 'business-classified-ads' );
        $business_classified_ads_defaults['business_classified_ads_404_subtitle_one'] = esc_html__( 'Maybe it’s out there, somewhere...', 'business-classified-ads' );
        $business_classified_ads_defaults['business_classified_ads_404_para_one'] = esc_html__( 'You can always find insightful stories on our', 'business-classified-ads' );
        $business_classified_ads_defaults['business_classified_ads_404_subtitle_two'] = esc_html__( 'Still feeling lost? You’re not alone.', 'business-classified-ads' );
        $business_classified_ads_defaults['business_classified_ads_404_para_two'] = esc_html__( 'Enjoy these stories about getting lost, losing things, and finding what you never knew you were looking for.', 'business-classified-ads' );

		return $business_classified_ads_defaults;
	}
endif;
