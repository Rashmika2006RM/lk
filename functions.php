<?php
/**
 * Business Classified Ads functions and definitions
 * @package Business Classified Ads
 */

if ( ! function_exists( 'business_classified_ads_after_theme_support' ) ) :

	function business_classified_ads_after_theme_support() {
		
		add_theme_support( 'automatic-feed-links' );

		add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('woocommerce', array(
            'gallery_thumbnail_image_width' => 300,
        ));

		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
			)
		);

		$GLOBALS['content_width'] = apply_filters( 'business_classified_ads_content_width', 1140 );
		
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 270,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		
		add_theme_support( 'title-tag' );

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		add_theme_support( 'post-formats', array(
			'video',
			'audio',
			'gallery',
			'quote',
			'image',
			'link',
			'status',
			'aside',
			'chat',
		) );
		
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );

        require get_template_directory() . '/inc/metabox.php';
        require get_template_directory() . '/inc/homepage-setup/homepage-setup-settings.php';


        if (! defined( 'BUSINESS_CLASSIFIED_ADS_DOCS_PRO' ) ){
        define('BUSINESS_CLASSIFIED_ADS_DOCS_PRO',__('https://layout.omegathemes.com/steps/pro-business-classified-ads/','business-classified-ads'));
        }
        if (! defined( 'BUSINESS_CLASSIFIED_ADS_BUY_NOW' ) ){
        define('BUSINESS_CLASSIFIED_ADS_BUY_NOW',__('https://www.omegathemes.com/products/classified-ads-wordpress-theme','business-classified-ads'));
        }
        if (! defined( 'BUSINESS_CLASSIFIED_ADS_SUPPORT_FREE' ) ){
        define('BUSINESS_CLASSIFIED_ADS_SUPPORT_FREE',__('https://wordpress.org/support/theme/business-classified-ads/','business-classified-ads'));
        }
        if (! defined( 'BUSINESS_CLASSIFIED_ADS_REVIEW_FREE' ) ){
        define('BUSINESS_CLASSIFIED_ADS_REVIEW_FREE',__('https://wordpress.org/support/theme/business-classified-ads/reviews/#new-post/','business-classified-ads'));
        }
        if (! defined( 'BUSINESS_CLASSIFIED_ADS_DEMO_PRO' ) ){
        define('BUSINESS_CLASSIFIED_ADS_DEMO_PRO',__('https://layout.omegathemes.com/business-classified-ads/','business-classified-ads'));
        }
        if (! defined( 'BUSINESS_CLASSIFIED_ADS_LITE_DOCS_PRO' ) ){
        define('BUSINESS_CLASSIFIED_ADS_LITE_DOCS_PRO',__('https://layout.omegathemes.com/steps/free-business-classified-ads/','business-classified-ads'));
        }
        if (! defined( 'BUSINESS_CLASSIFIED_ADS_BUNDLE_BUTTON' ) ){
            define('BUSINESS_CLASSIFIED_ADS_BUNDLE_BUTTON',__('https://www.omegathemes.com/products/wp-theme-bundle','business-classified-ads'));
        }

	}

endif;

add_action( 'after_setup_theme', 'business_classified_ads_after_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function business_classified_ads_register_styles() {

	wp_enqueue_style( 'dashicons' );

    $business_classified_adstheme_version = wp_get_theme()->get( 'Version' );
	$business_classified_adsfonts_url = business_classified_ads_fonts_url();
    if( $business_classified_adsfonts_url ){
    	require_once get_theme_file_path( 'lib/custom/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
			'business-classified-ads-google-fonts',
			business_classified_ads_wptt_get_webfont_url( $business_classified_adsfonts_url ),
			array(),
			$business_classified_adstheme_version
		);
    }

    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/lib/swiper/css/swiper-bundle.min.css');
    wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/lib/custom/css/owl.carousel.min.css');
	wp_enqueue_style( 'business-classified-ads-style', get_stylesheet_uri(), array(), $business_classified_adstheme_version );

	wp_enqueue_style( 'business-classified-ads-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom_css.php' );
	wp_add_inline_style( 'business-classified-ads-style',$business_classified_ads_custom_css );

	$business_classified_ads_css = '';

	if ( get_header_image() ) :

		$business_classified_ads_css .=  '
			section#center-header{
				background-image: url('.esc_url(get_header_image()).');
				-webkit-background-size: cover !important;
				-moz-background-size: cover !important;
				-o-background-size: cover !important;
				background-size: cover !important;
			}';

	endif;

	wp_add_inline_style( 'business-classified-ads-style', $business_classified_ads_css );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'business-classified-ads-custom', get_template_directory_uri() . '/lib/custom/js/theme-custom-script.js', array('jquery'), '', 1);
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/lib/swiper/js/swiper-bundle.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/lib/custom/js/owl.carousel.js', array('jquery'), '', 1);

    // Global Query
    if( is_front_page() ){

    	$posts_per_page = absint( get_option('posts_per_page') );
        $c_paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
        $posts_args = array(
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $c_paged,
        );
        $posts_qry = new WP_Query( $posts_args );
        $max = $posts_qry->max_num_pages;

    }else{
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $c_paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    }

    $business_classified_ads_default = business_classified_ads_get_default_theme_options();
    $business_classified_ads_pagination_layout = get_theme_mod( 'business_classified_ads_pagination_layout',$business_classified_ads_default['business_classified_ads_pagination_layout'] );
}

add_action( 'wp_enqueue_scripts', 'business_classified_ads_register_styles',200 );

function business_classified_ads_admin_enqueue_scripts_callback() {
    if ( ! did_action( 'wp_enqueue_media' ) ) {
    wp_enqueue_media();
    }
    wp_enqueue_script('business-classified-ads-uploaderjs', get_stylesheet_directory_uri() . '/lib/custom/js/uploader.js', array(), "1.0", true);
}
add_action( 'admin_enqueue_scripts', 'business_classified_ads_admin_enqueue_scripts_callback' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function business_classified_ads_menus() {

	$business_classified_ads_locations = array(
		'business-classified-ads-primary-menu'  => esc_html__( 'Primary Menu', 'business-classified-ads' ),
	);

	register_nav_menus( $business_classified_ads_locations );
}

add_action( 'init', 'business_classified_ads_menus' );

add_filter('loop_shop_columns', 'business_classified_ads_loop_columns');
if (!function_exists('business_classified_ads_loop_columns')) {
	function business_classified_ads_loop_columns() {
		$business_classified_ads_columns = get_theme_mod( 'business_classified_ads_per_columns', 3 );
		return $business_classified_ads_columns;
	}
}

add_filter( 'loop_shop_per_page', 'business_classified_ads_per_page', 20 );
function business_classified_ads_per_page( $business_classified_ads_cols ) {
  	$business_classified_ads_cols = get_theme_mod( 'business_classified_ads_product_per_page', 9 );
	return $business_classified_ads_cols;
}

add_filter( 'woocommerce_output_related_products_args', 'business_classified_ads_products_args' );

function business_classified_ads_products_args( $business_classified_ads_args ) {

    $business_classified_ads_args['posts_per_page'] = get_theme_mod( 'business_classified_ads_custom_related_products_number', 6 );

    $business_classified_ads_args['columns'] = get_theme_mod( 'business_classified_ads_custom_related_products_number_per_row', 3 );

    return $business_classified_ads_args;
}

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/lib/custom/css/dynamic-style.php';


function business_classified_ads_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'business_classified_ads_remove_customize_register', 11 );

function business_classified_ads_radio_sanitize(  $business_classified_ads_input, $business_classified_ads_setting  ) {
	$business_classified_ads_input = sanitize_key( $business_classified_ads_input );
	$business_classified_ads_choices = $business_classified_ads_setting->manager->get_control( $business_classified_ads_setting->id )->choices;
	return ( array_key_exists( $business_classified_ads_input, $business_classified_ads_choices ) ? $business_classified_ads_input : $business_classified_ads_setting->default );
}
require get_template_directory() . '/inc/general.php';

function business_classified_ads_timeAgo($timestamp) {
    // If timestamp is already an integer, use it directly
    if (is_numeric($timestamp)) {
        $business_classified_ads_timeAgo = (int) $timestamp;
    } else {
        $business_classified_ads_timeAgo = strtotime($timestamp);
        
        // Ensure conversion was successful
        if (!$business_classified_ads_timeAgo) {
            return "Invalid date format";
        }
    }

    $currentTime = time();
    $timeDifference = $currentTime - $business_classified_ads_timeAgo;

    if ($timeDifference < 0) {
        return "Future date";
    }

    $seconds = $timeDifference;
    $minutes = round($seconds / 60);
    $hours = round($seconds / 3600);
    $days = round($seconds / 86400);
    $weeks = round($seconds / 604800);
    $months = round($seconds / 2629440);
    $years = round($seconds / 31553280);

    if ($seconds < 60) {
        return "just now";
    } elseif ($minutes < 60) {
        return "$minutes min" . ($minutes > 1 ? "s" : "") . " ago";
    } elseif ($hours < 24) {
        return "$hours hr" . ($hours > 1 ? "s" : "") . " ago";
    } elseif ($days < 7) {
        return "$days day" . ($days > 1 ? "s" : "") . " ago";
    } elseif ($weeks < 4) {
        return "$weeks week" . ($weeks > 1 ? "s" : "") . " ago";
    } elseif ($months < 12) {
        return "$months month" . ($months > 1 ? "s" : "") . " ago";
    } else {
        return "$years year" . ($years > 1 ? "s" : "") . " ago";
    }
}

function business_classified_ads_sticky_sidebar_enabled() {
    $business_classified_ads_sticky_sidebar = get_theme_mod('business_classified_ads_sticky_sidebar', true);
    
    if ($business_classified_ads_sticky_sidebar == false) {
        $business_classified_ads_custom_css = ".widget-area-wrapper { position: relative !important; }";
        wp_add_inline_style('business-classified-ads-style', $business_classified_ads_custom_css);
    }
}
add_action('wp_enqueue_scripts', 'business_classified_ads_sticky_sidebar_enabled');

function business_classified_ads_customizer_bg_image_css() {
    $business_classified_ads_footer_widget_background_image = get_theme_mod('business_classified_ads_footer_widget_background_image');

    if ($business_classified_ads_footer_widget_background_image) {
        $business_classified_ads_custom_css = ".footer-widgetarea { background-image: url(" . esc_url($business_classified_ads_footer_widget_background_image) . "); }";
        wp_add_inline_style('business-classified-ads-style', $business_classified_ads_custom_css);
    }
}
add_action('wp_enqueue_scripts', 'business_classified_ads_customizer_bg_image_css');

function business_classified_ads_add_dynamic_css() {
    $business_classified_ads_mod_id_value = get_theme_mod('business_classified_ads_header_slider', 1);

    $business_classified_ads_custom_css = "";
    if (!$business_classified_ads_mod_id_value) {
        $business_classified_ads_custom_css .= "
            #center-header {
                position: relative !important;
                background-color:#000000 !important;
            }
        ";
    }

    $business_classified_ads_footer_widget_background_color = get_theme_mod('business_classified_ads_footer_widget_background_color');
    if ($business_classified_ads_footer_widget_background_color) {

        $business_classified_ads_custom_css .= "
            .footer-widgetarea {
                background-color: ". esc_attr($business_classified_ads_footer_widget_background_color) .";
            }
        ";
    }

    $business_classified_ads_copyright_font_size = get_theme_mod('business_classified_ads_copyright_font_size');
    if ($business_classified_ads_copyright_font_size) {

        $business_classified_ads_custom_css .= "
            .footer-copyright {
                font-size: ". esc_attr($business_classified_ads_copyright_font_size) ."px;
            }
        ";
    }

    wp_add_inline_style('business-classified-ads-style', $business_classified_ads_custom_css);
}
add_action('wp_enqueue_scripts', 'business_classified_ads_add_dynamic_css');

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );


// NOTICE FUNCTION

function business_classified_ads_admin_notice() { 
    global $pagenow;
    $theme_args = wp_get_theme();
    $meta = get_option( 'business_classified_ads_admin_notice' );
    $name = $theme_args->get( 'Name' );
    $current_screen = get_current_screen();

    if ( ! $meta ) {
        if ( is_network_admin() ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( $current_screen->base != 'appearance_page_businessclassifiedads-wizard' ) {
            ?>
            <div class="notice notice-success notice-content">
                <h2><?php esc_html_e('Welcome! Thank you for choosing Business Classified Ads. Let’s Set Up Your Website!', 'business-classified-ads') ?> </h2>
                <p><?php esc_html_e('Before you dive into customization, let’s go through a quick setup process to ensure everything runs smoothly. Click below to start setting up your website in minutes!', 'business-classified-ads') ?> </p>
                <div class="info-link">
                    <a href="<?php echo esc_url( admin_url( 'themes.php?page=businessclassifiedads-wizard' ) ); ?>"><?php esc_html_e('Get Started with Business Classified Ads', 'business-classified-ads'); ?></a>
                </div>
                <p class="dismiss-link"><strong><a href="?business_classified_ads_admin_notice=1"><?php esc_html_e( 'Dismiss', 'business-classified-ads' ); ?></a></strong></p>
            </div>
            <?php
        }
    }
}
add_action( 'admin_notices', 'business_classified_ads_admin_notice' );

if ( ! function_exists( 'business_classified_ads_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
 */
function business_classified_ads_update_admin_notice() {
    if ( isset( $_GET['business_classified_ads_admin_notice'] ) && $_GET['business_classified_ads_admin_notice'] == '1' ) {
        update_option( 'business_classified_ads_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'business_classified_ads_update_admin_notice' );

// After Switch theme function
add_action( 'after_switch_theme', 'business_classified_ads_getstart_setup_options' );
function business_classified_ads_getstart_setup_options() {
    update_option( 'business_classified_ads_admin_notice', false );
}