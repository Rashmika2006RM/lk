<?php

$business_classified_ads_custom_css = "";

	$business_classified_ads_theme_pagination_options_alignment = get_theme_mod('business_classified_ads_theme_pagination_options_alignment', 'Center');
	if ($business_classified_ads_theme_pagination_options_alignment == 'Center') {
		$business_classified_ads_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		$business_classified_ads_custom_css .= 'justify-content: center;margin: 0 auto;';
		$business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_theme_pagination_options_alignment == 'Right') {
		$business_classified_ads_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		$business_classified_ads_custom_css .= 'justify-content: right;margin: 0 0 0 auto;';
		$business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_theme_pagination_options_alignment == 'Left') {
		$business_classified_ads_custom_css .= '.navigation.pagination,.navigation.posts-navigation .nav-links{';
		$business_classified_ads_custom_css .= 'justify-content: left;margin: 0 auto 0 0;';
		$business_classified_ads_custom_css .= '}';
	}

	$business_classified_ads_theme_breadcrumb_enable = get_theme_mod('business_classified_ads_theme_breadcrumb_enable',true);
    if($business_classified_ads_theme_breadcrumb_enable != true){
        $business_classified_ads_custom_css .='nav.breadcrumb-trail.breadcrumbs,nav.woocommerce-breadcrumb{';
            $business_classified_ads_custom_css .='display: none;';
        $business_classified_ads_custom_css .='}';
    }

	$business_classified_ads_theme_breadcrumb_options_alignment = get_theme_mod('business_classified_ads_theme_breadcrumb_options_alignment', 'Left');
	if ($business_classified_ads_theme_breadcrumb_options_alignment == 'Center') {
	    $business_classified_ads_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
	    $business_classified_ads_custom_css .= 'text-align: center !important;';
	    $business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_theme_breadcrumb_options_alignment == 'Right') {
	    $business_classified_ads_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
	    $business_classified_ads_custom_css .= 'text-align: Right !important;';
	    $business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_theme_breadcrumb_options_alignment == 'Left') {
	    $business_classified_ads_custom_css .= '.breadcrumbs ul,nav.woocommerce-breadcrumb{';
	    $business_classified_ads_custom_css .= 'text-align: Left !important;';
	    $business_classified_ads_custom_css .= '}';
	}

	$business_classified_ads_single_page_content_alignment = get_theme_mod('business_classified_ads_single_page_content_alignment', 'left');
	if ($business_classified_ads_single_page_content_alignment == 'left') {
	    $business_classified_ads_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
	    $business_classified_ads_custom_css .= 'text-align: left !important;';
	    $business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_single_page_content_alignment == 'center') {
	    $business_classified_ads_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
	    $business_classified_ads_custom_css .= 'text-align: center !important;';
	    $business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_single_page_content_alignment == 'right') {
	    $business_classified_ads_custom_css .= '#single-page .type-page,section.theme-custom-block.theme-error-sectiontheme-error-section.error-block-middle,section.theme-custom-block.theme-error-section.error-block-heading .theme-area-header{';
	    $business_classified_ads_custom_css .= 'text-align: right !important;';
	    $business_classified_ads_custom_css .= '}';
	}

	$business_classified_ads_single_post_content_alignment = get_theme_mod('business_classified_ads_single_post_content_alignment', 'left');
	if ($business_classified_ads_single_post_content_alignment == 'left') {
	    $business_classified_ads_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
	    $business_classified_ads_custom_css .= 'text-align: left !important;justify-content: left;';
	    $business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_single_post_content_alignment == 'center') {
	    $business_classified_ads_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
	    $business_classified_ads_custom_css .= 'text-align: center !important;justify-content: center;';
	    $business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_single_post_content_alignment == 'right') {
	    $business_classified_ads_custom_css .= '#single-page .type-post,#single-page .type-post .entry-meta,#single-page .type-post .is-layout-flex{';
	    $business_classified_ads_custom_css .= 'text-align: right !important;justify-content: right;';
	    $business_classified_ads_custom_css .= '}';
	}

	$business_classified_ads_footer_widget_title_alignment = get_theme_mod('business_classified_ads_footer_widget_title_alignment', 'left');
	if ($business_classified_ads_footer_widget_title_alignment == 'left') {
	    $business_classified_ads_custom_css .= 'h2.widget-title{';
	    $business_classified_ads_custom_css .= 'text-align: left !important;';
	    $business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_footer_widget_title_alignment == 'center') {
	    $business_classified_ads_custom_css .= 'h2.widget-title{';
	    $business_classified_ads_custom_css .= 'text-align: center !important;';
	    $business_classified_ads_custom_css .= '}';
	} else if ($business_classified_ads_footer_widget_title_alignment == 'right') {
	    $business_classified_ads_custom_css .= 'h2.widget-title{';
	    $business_classified_ads_custom_css .= 'text-align: right !important;';
	    $business_classified_ads_custom_css .= '}';
	}

	$business_classified_ads_menu_text_transform = get_theme_mod('business_classified_ads_menu_text_transform', 'capitalize'); 
	if ($business_classified_ads_menu_text_transform == 'capitalize') {
	$business_classified_ads_custom_css .= '.site-navigation .primary-menu > li a{';
	$business_classified_ads_custom_css .= 'text-transform: capitalize !important;';
	$business_classified_ads_custom_css .= '}'; 
	} 
	else if ($business_classified_ads_menu_text_transform == 'uppercase') {
	$business_classified_ads_custom_css .= '.site-navigation .primary-menu > li a{';
	$business_classified_ads_custom_css .= 'text-transform: uppercase !important;';
	$business_classified_ads_custom_css .= '}'; 
	} 
	else if ($business_classified_ads_menu_text_transform == 'lowercase') {
	$business_classified_ads_custom_css .= '.site-navigation .primary-menu > li a{';
	$business_classified_ads_custom_css .= 'text-transform: lowercase !important;';
	$business_classified_ads_custom_css .= '}'; 
	}

	$business_classified_ads_show_hide_related_product = get_theme_mod('business_classified_ads_show_hide_related_product',true);
    if($business_classified_ads_show_hide_related_product != true){
        $business_classified_ads_custom_css .='.related.products{';
            $business_classified_ads_custom_css .='display: none;';
        $business_classified_ads_custom_css .='}';
    }

	/*-------------------- Global First Color -------------------*/

	$business_classified_ads_global_color = get_theme_mod('business_classified_ads_global_color', '#F87B54'); // Add a fallback if the color isn't set

	if ($business_classified_ads_global_color) {
		$business_classified_ads_custom_css .= ':root {';
		$business_classified_ads_custom_css .= '--global-color: ' . esc_attr($business_classified_ads_global_color) . ';';
		$business_classified_ads_custom_css .= '}';
	}

	/*-------------------- Content Font -------------------*/

	$business_classified_ads_content_typography_font = get_theme_mod('business_classified_ads_content_typography_font', 'inter'); // Add a fallback if the color isn't set

	if ($business_classified_ads_content_typography_font) {
		$business_classified_ads_custom_css .= ':root {';
		$business_classified_ads_custom_css .= '--font-main: ' . esc_attr($business_classified_ads_content_typography_font) . ';';
		$business_classified_ads_custom_css .= '}';
	}

	/*-------------------- Heading Font -------------------*/

	$business_classified_ads_heading_typography_font = get_theme_mod('business_classified_ads_heading_typography_font', 'inter'); // Add a fallback if the color isn't set

	if ($business_classified_ads_heading_typography_font) {
		$business_classified_ads_custom_css .= ':root {';
		$business_classified_ads_custom_css .= '--font-head: ' . esc_attr($business_classified_ads_heading_typography_font) . ';';
		$business_classified_ads_custom_css .= '}';
	}
										
	$business_classified_ads_columns = get_theme_mod('business_classified_ads_posts_per_columns', 3);
	$business_classified_ads_columns = absint($business_classified_ads_columns);
	if ( $business_classified_ads_columns < 1 || $business_classified_ads_columns > 6 ) {
		$business_classified_ads_columns = 3;
	}
	$business_classified_ads_custom_css .= "
		.site-content .article-wraper-archive {
			grid-template-columns: repeat({$business_classified_ads_columns}, 1fr);
		}
	";

	$business_classified_ads_copyright_alignment = get_theme_mod( 'business_classified_ads_copyright_alignment', 'Default' );
	if ( $business_classified_ads_copyright_alignment === 'Reverse' ) {
		$business_classified_ads_custom_css .= '.site-info .column-row { flex-direction: row-reverse; }';
		$business_classified_ads_custom_css .= '.footer-credits { justify-content: flex-end; }';
		$business_classified_ads_custom_css .= '.footer-copyright { text-align: right; }';
		$business_classified_ads_custom_css .= '.site-info .column.column-3 { text-align: left; }';
	} elseif ( $business_classified_ads_copyright_alignment === 'Center' ) {
		$business_classified_ads_custom_css .= '.site-info .column-row { flex-direction: column; align-items: center; gap: 15px; }';
		$business_classified_ads_custom_css .= '.footer-credits { justify-content: center; }';
		$business_classified_ads_custom_css .= '.footer-copyright { text-align: center; }';
		$business_classified_ads_custom_css .= '.site-info .column.column-3 { text-align: center; }';
	}