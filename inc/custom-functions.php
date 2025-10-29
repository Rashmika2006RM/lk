<?php
/**
 * Custom Functions.
 *
 * @package Business Classified Ads
 */

if( !function_exists( 'business_classified_ads_fonts_url' ) ) :

    //Google Fonts URL
    function business_classified_ads_fonts_url(){

        $business_classified_ads_font_families = array(
            'Work+Sans:ital,wght@0,100..900;1,100..900', // font-family: "Work Sans", sans-serif;
        );

        $business_classified_ads_fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $business_classified_ads_font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($business_classified_ads_fonts_url);

    }

endif;

if ( ! function_exists( 'business_classified_ads_sub_menu_toggle_button' ) ) :

    function business_classified_ads_sub_menu_toggle_button( $business_classified_ads_args, $business_classified_ads_item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $business_classified_ads_args->theme_location == 'business-classified-ads-primary-menu' && isset( $business_classified_ads_args->show_toggles ) ) {
            
            // Wrap the menu item link contents in a div, used for positioning
            $business_classified_ads_args->before = '<div class="submenu-wrapper">';
            $business_classified_ads_args->after  = '';

            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $business_classified_ads_item->classes ) ) {

                $toggle_target_string = '.menu-item.menu-item-' . $business_classified_ads_item->ID . ' > .sub-menu';

                // Add the sub menu toggle
                $business_classified_ads_args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'business-classified-ads' ) . '</span>' . business_classified_ads_get_theme_svg( 'chevron-down' ) . '</span></button>';

            }

            // Close the wrapper
            $business_classified_ads_args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)

        }elseif( $business_classified_ads_args->theme_location == 'business-classified-ads-primary-menu' ) {

            if ( in_array( 'menu-item-has-children', $business_classified_ads_item->classes ) ) {

                $business_classified_ads_args->before = '<div class="link-icon-wrapper">';
                $business_classified_ads_args->after  = business_classified_ads_get_theme_svg( 'chevron-down' ) . '</div>';

            } else {

                $business_classified_ads_args->before = '';
                $business_classified_ads_args->after  = '';

            }

        }

        return $business_classified_ads_args;

    }

endif;

add_filter( 'nav_menu_item_args', 'business_classified_ads_sub_menu_toggle_button', 10, 3 );

if ( ! function_exists( 'business_classified_ads_the_theme_svg' ) ):
    
    function business_classified_ads_the_theme_svg( $business_classified_ads_svg_name, $business_classified_ads_return = false ) {

        if( $business_classified_ads_return ){

            return business_classified_ads_get_theme_svg( $business_classified_ads_svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in business_classified_ads_get_theme_svg();.

        }else{

            echo business_classified_ads_get_theme_svg( $business_classified_ads_svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in business_classified_ads_get_theme_svg();.

        }
    }

endif;

if ( ! function_exists( 'business_classified_ads_get_theme_svg' ) ):

    function business_classified_ads_get_theme_svg( $business_classified_ads_svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $business_classified_ads_svg = wp_kses(
            Business_Classified_Ads_SVG_Icons::get_svg( $business_classified_ads_svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
                'polyline' => array(
                    'fill'      => true,
                    'points'    => true,
                ),
                'line' => array(
                    'fill'      => true,
                    'x1'      => true,
                    'x2' => true,
                    'y1'    => true,
                    'y2' => true,
                ),
            )
        );
        if ( ! $business_classified_ads_svg ) {
            return false;
        }
        return $business_classified_ads_svg;

    }

endif;

if( !function_exists( 'business_classified_ads_post_category_list' ) ) :

    // Post Category List.
    function business_classified_ads_post_category_list( $business_classified_ads_select_cat = true ){

        $business_classified_ads_post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $business_classified_ads_post_cat_cat_array = array();
        if( $business_classified_ads_select_cat ){

            $business_classified_ads_post_cat_cat_array[''] = esc_html__( '-- Select Category --','business-classified-ads' );

        }

        foreach ( $business_classified_ads_post_cat_lists as $business_classified_ads_post_cat_list ) {

            $business_classified_ads_post_cat_cat_array[$business_classified_ads_post_cat_list->slug] = $business_classified_ads_post_cat_list->name;

        }

        return $business_classified_ads_post_cat_cat_array;
    }

endif;

if( !function_exists('business_classified_ads_single_post_navigation') ):

    function business_classified_ads_single_post_navigation(){

        $business_classified_ads_default = business_classified_ads_get_default_theme_options();
        $business_classified_ads_twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $business_classified_ads_current_id = '';
        $article_wrap_class = '';
        global $post;
        $business_classified_ads_current_id = $post->ID;
        if( $business_classified_ads_twp_navigation_type == '' || $business_classified_ads_twp_navigation_type == 'global-layout' ){
            $business_classified_ads_twp_navigation_type = get_theme_mod('twp_navigation_type', $business_classified_ads_default['twp_navigation_type']);
        }

        if( $business_classified_ads_twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

            if( $business_classified_ads_twp_navigation_type == 'theme-normal-navigation' ){ ?>

                <div class="navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . business_classified_ads_the_theme_svg('arrow-left',$business_classified_ads_return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Previous post:', 'business-classified-ads') . '</span><span class="post-title">%title</span>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . business_classified_ads_the_theme_svg('arrow-right',$business_classified_ads_return = true ) . '</span><span class="screen-reader-text">' . esc_html__('Next post:', 'business-classified-ads') . '</span><span class="post-title">%title</span>',
                    )); ?>
                </div>
                <?php

            }else{

                $business_classified_ads_next_post = get_next_post();
                if( isset( $business_classified_ads_next_post->ID ) ){

                    $business_classified_ads_next_post_id = $business_classified_ads_next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint( $business_classified_ads_next_post_id ) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action( 'business_classified_ads_navigation_action','business_classified_ads_single_post_navigation',30 );

if( !function_exists('business_classified_ads_content_offcanvas') ):

    // Offcanvas Contents
    function business_classified_ads_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'business-classified-ads'); ?>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'business-classified-ads'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('business-classified-ads-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'business-classified-ads-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );
                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Business_Classified_Ads_Walker_Page(),
                                    )
                                );
                            }
                            ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'business_classified_ads_before_footer_content_action','business_classified_ads_content_offcanvas',30 );

if( !function_exists('business_classified_ads_footer_content_widget') ):

    function business_classified_ads_footer_content_widget(){
        
        $business_classified_ads_default = business_classified_ads_get_default_theme_options();
        
        $business_classified_ads_footer_column_layout = absint(get_theme_mod('business_classified_ads_footer_column_layout', $business_classified_ads_default['business_classified_ads_footer_column_layout']));
        $business_classified_ads_footer_sidebar_class = 12;
        
        if($business_classified_ads_footer_column_layout == 2) {
            $business_classified_ads_footer_sidebar_class = 6;
        }
        
        if($business_classified_ads_footer_column_layout == 3) {
            $business_classified_ads_footer_sidebar_class = 4;
        }
        ?>
        
        <?php if ( get_theme_mod('business_classified_ads_display_footer', true) == true ) : ?>
            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">
                    
                        <?php for ($business_classified_ads_i = 0; $business_classified_ads_i < $business_classified_ads_footer_column_layout; $business_classified_ads_i++) : ?>
                            
                            <div class="column <?php echo 'column-' . absint($business_classified_ads_footer_sidebar_class); ?> column-sm-12">
                                
                                <?php 
                                // If no widgets are assigned, display default widgets
                                if ( ! is_active_sidebar( 'business-classified-ads-footer-widget-' . $business_classified_ads_i ) ) : 

                                    if ($business_classified_ads_i === 0) : ?>
                                        <div id="media_image-3" class="widget widget_media_image">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" style="max-width: 100%; height: auto;">
                                        </div>
                                        <div id="text-3" class="widget widget_text">
                                            <div class="textwidget">
                                                <p class="widget_text">
                                                    <?php esc_html_e('The Classified Ads WordPress Theme is a dynamic and user-friendly platform tailored for creating engaging online classifieds websites. Whether you\'re managing a platform for buy-and-sell ads, job classifieds, or real estate listings, this theme is designed to simplify the process of connecting buyers and sellers.', 'business-classified-ads'); ?>
                                                </p>
                                            </div>
                                        </div>

                                    <?php elseif ($business_classified_ads_i === 1) : ?>
                                        <div id="pages-2" class="widget widget_pages">
                                            <h2 class="widget-title"><?php esc_html_e('Calendar', 'business-classified-ads'); ?></h2>
                                            <?php get_calendar(); ?>
                                        </div>

                                    <?php elseif ($business_classified_ads_i === 2) : ?>
                                        <div id="search-2" class="widget widget_search">
                                            <h2 class="widget-title"><?php esc_html_e('Enter Keywords Here', 'business-classified-ads'); ?></h2>
                                            <?php get_search_form(); ?>
                                        </div>
                                    <?php endif; 
                                    
                                else :
                                    // Display dynamic sidebar widget if assigned
                                    dynamic_sidebar('business-classified-ads-footer-widget-' . $business_classified_ads_i);
                                endif;
                                ?>
                                
                            </div>
                            
                        <?php endfor; ?>

                    </div>
                </div>
            </div>
        <?php endif; ?> 

    <?php
    }

endif;

add_action( 'business_classified_ads_footer_content_action', 'business_classified_ads_footer_content_widget', 10 );

if( !function_exists('business_classified_ads_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function business_classified_ads_footer_content_info(){

        $business_classified_ads_default = business_classified_ads_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-9">
                        <div class="footer-credits">
                            <div class="footer-copyright">
                                <?php
                                    $business_classified_ads_footer_copyright_text = wp_kses_post( get_theme_mod( 'business_classified_ads_footer_copyright_text', $business_classified_ads_default['business_classified_ads_footer_copyright_text'] ) );
                                        echo esc_html( $business_classified_ads_footer_copyright_text );
                                        echo '<br>';
                                        echo esc_html__('Theme: ', 'business-classified-ads') . '<a href="' . esc_url('https://www.omegathemes.com/products/free-classified-wordpress-theme') . '" title="' . esc_attr__('Business Classified Ads ', 'business-classified-ads') . '" target="_blank"><span>' . esc_html__('Business Classified Ads ', 'business-classified-ads') . '</span></a>' . esc_html__(' By ', 'business-classified-ads') . '  <span>' . esc_html__('OMEGA ', 'business-classified-ads') . '</span>';
                                        echo esc_html__('Powered by ', 'business-classified-ads') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'business-classified-ads') . '" target="_blank"><span>' . esc_html__('WordPress.', 'business-classified-ads') . '</span></a>';
                                    ?>
                            </div>
                        </div>
                    </div>
                    <div class="column column-3 align-text-right">
                        <a class="to-the-top" href="#site-header">
                            <span class="to-the-top-long">
                                <?php if ( get_theme_mod('business_classified_ads_enable_to_the_top', true) == true ) : ?>
                                    <?php
                                    $business_classified_ads_to_the_top_text = get_theme_mod( 'business_classified_ads_to_the_top_text', __( 'To the Top', 'business-classified-ads' ) );
                                    printf( 
                                        wp_kses( 
                                            /* translators: %s is the arrow icon markup */
                                            '%s %s', 
                                            array( 'span' => array( 'class' => array(), 'aria-hidden' => array() ) ) 
                                        ), 
                                        esc_html( $business_classified_ads_to_the_top_text ),
                                        '<span class="arrow" aria-hidden="true">&uarr;</span>' 
                                    );
                                    ?>
                                <?php endif; ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'business_classified_ads_footer_content_action','business_classified_ads_footer_content_info',20 );


if ( ! function_exists( 'business_classified_ads_main_slider' ) ) :

    function business_classified_ads_main_slider() {
        $output = '';
        $business_classified_ads_defaults = business_classified_ads_get_default_theme_options();
        $business_classified_ads_header_slider = get_theme_mod( 'business_classified_ads_header_slider', $business_classified_ads_defaults['business_classified_ads_header_slider'] );

        $business_classified_ads_contact_form_shortcode = get_theme_mod( 'business_classified_ads_contact_form_shortcode' );

        // Debugging header slider status
        if ( ! $business_classified_ads_header_slider ) {
            error_log('Header slider is not enabled or has a falsy value.');
            return '';  // Exit early if no slider
        }

        $business_classified_ads_header_banner_cat = get_theme_mod( 'business_classified_ads_header_banner_cat','Slider' );

        $banner_query = new WP_Query( array(
            'post_type' => 'post',
            'posts_per_page' => 4,
            'post__not_in' => get_option( 'sticky_posts' ),
            'category_name' => esc_html( $business_classified_ads_header_banner_cat ),
        ) );

        // Check if the query has posts
        if ( ! $banner_query->have_posts() ) {
            error_log('No posts found for the banner query.');
            return '';  // Exit early if no posts
        }

        ob_start();  // Start output buffering
        ?>
        <div id="site-content" class="main-banner">
            <div class="slider-box" >
                <div class="main-slider">
                    <div class="swiper-container theme-main-carousel" <?php echo is_rtl() ? 'dir="rtl"' : ''; ?>>
                        <div class="swiper-wrapper">
                            <?php while ( $banner_query->have_posts() ) : $banner_query->the_post();
                                $business_classified_ads_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0] ?? get_template_directory_uri() . '/assets/images/default.jpg';
                                ?>
                                <div class="swiper-slide main-carousel-item">
                                    <div class="slider-main">
                                        <div class="data-bg banner-img" data-background="<?php echo esc_url( $business_classified_ads_featured_image ); ?>">
                                            <a href="<?php the_permalink(); ?>" class="theme-image-responsive"></a>
                                        </div>
                                        <?php business_classified_ads_post_format_icon(); ?>
                                        <div class="slide-heading-main">
                                            <div class="main-carousel-caption">
                                                <div class="post-content">
                                                    <header class="entry-header">
                                                        <h2 class="slider-heading">
                                                            <a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php echo esc_html( get_the_title() ); ?></span></a>
                                                        </h2>
                                                    </header>
                                                    <div class="entry-content">
                                                        <?php
                                                        if (has_excerpt()) {

                                                            the_excerpt();

                                                        } else {

                                                            echo esc_html(wp_trim_words(get_the_content(), 25, '...'));

                                                        } ?> 
                                                    </div>
                                                    <?php if( $business_classified_ads_contact_form_shortcode ){ ?>
                                                        <div class="form-shortcode">
                                                            <?php echo do_shortcode( $business_classified_ads_contact_form_shortcode ); ?>
                                                        </div>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        wp_reset_postdata();
        $output = ob_get_clean(); // Get buffered output and clean buffer
        return $output; // Return the output instead of echoing
    }

endif;


if( !function_exists( 'business_classified_ads_product_section' ) ) :

    function business_classified_ads_product_section(){ 

        $business_classified_ads_default = business_classified_ads_get_default_theme_options();
        $business_classified_ads_locations_post = get_theme_mod( 'business_classified_ads_locations_post', $business_classified_ads_default['business_classified_ads_locations_post'] );
        $business_classified_ads_video_section_left_post_cat = get_theme_mod( 'business_classified_ads_video_section_left_post_cat' );

        $business_classified_ads_team_section_title = esc_html( get_theme_mod( 'business_classified_ads_team_section_title',
        $business_classified_ads_default['business_classified_ads_team_section_title'] ) );

        // Debugging header slider status
        if ( ! $business_classified_ads_locations_post ) {
            error_log('Header slider is not enabled or has a falsy value.');
            return '';  // Exit early if no slider
        }

        ?>
            <div class="theme-videos-block">
                <div class="wrapper">
                    <div class="videos-box">
                        <div class="section-heading">
                            <?php if( $business_classified_ads_team_section_title ){ ?>
                                <h4><?php echo esc_html( $business_classified_ads_team_section_title ); ?></h4>
                            <?php } ?>
                        </div>
                        <div class="video-left-box">
                            <div class="owl-carousel" role="listbox">
                                <?php  $business_classified_ads_locations_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 6,'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $business_classified_ads_video_section_left_post_cat ) ) );
                                if( $business_classified_ads_locations_query->have_posts() ): ?>
                                    <?php
                                        $s=1;
                                        while( $business_classified_ads_locations_query->have_posts() ):
                                        $business_classified_ads_locations_query->the_post();
                                        $business_classified_ads_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                        $business_classified_ads_featured_image = isset( $business_classified_ads_featured_image[0] ) ? $business_classified_ads_featured_image[0] : '';
                                        $business_classified_ads_ads_discription = get_theme_mod( 'business_classified_ads_ads_discription'.$s,'Automobile/Private Car' );
                                        $business_classified_ads_ads_post_location = get_theme_mod( 'business_classified_ads_ads_post_location' .$s,'Allentown, New Mexico');
                                        $business_classified_ads_ads_post_amount = get_theme_mod( 'business_classified_ads_ads_post_amount' .$s,'$12,000');
                                        $business_classified_ads_ads_post_amount_per_hours = get_theme_mod( 'business_classified_ads_ads_post_amount_per_hours' .$s,'/Per Month');

                                        ?>                                
                                        <div class="theme-article-post video-left-post-content">
                                            <div class="entry-thumbnail">
                                                <div class="data-bg featured-img" data-background="<?php echo esc_url($business_classified_ads_featured_image ? $business_classified_ads_featured_image : get_template_directory_uri() . '/assets/images/default.jpg'); ?>">
                                                </div>
                                                <?php business_classified_ads_post_format_icon(); ?>
                                            </div>
                                            <span class="video-cat-box">
                                                <?php 
                                                    if ( ! empty( get_the_category() ) ) {
                                                        $categories = get_the_category();
                                                        if ( ! empty( $categories ) && isset( $categories[0] ) ) { ?>
                                                            <span class="post-cat"><?php echo esc_html( $categories[0]->name ); ?></span>
                                                        <?php }
                                                    } 
                                                ?>
                                            </span>
                                            <div class="main-video-caption">
                                                <header class="entry-header">
                                                    <?php if( $business_classified_ads_ads_discription ){ ?>
                                                        <h6><?php echo esc_html( $business_classified_ads_ads_discription ); ?></h6>
                                                    <?php } ?>
                                                    <h2 class="entry-title entry-title-big">
                                                        <a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php the_title(); ?></span></a>
                                                    </h2>
                                                </header>
                                                <div class="meta-ads-box1">
                                                    <div class="meta-location">
                                                        <?php if( $business_classified_ads_ads_post_location ){ ?>
                                                            <p><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M172.3 501.7C27 291 0 269.4 0 192 0 86 86 0 192 0s192 86 192 192c0 77.4-27 99-172.3 309.7-9.5 13.8-29.9 13.8-39.5 0zM192 272c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80z"/></svg><?php echo esc_html( $business_classified_ads_ads_post_location ); ?></p>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="meta-time">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256S119 504 256 504 504 393 504 256 393 8 256 8zm92.5 313h0l-20 25a16 16 0 0 1 -22.5 2.5h0l-67-49.7a40 40 0 0 1 -15-31.2V112a16 16 0 0 1 16-16h32a16 16 0 0 1 16 16V256l58 42.5A16 16 0 0 1 348.5 321z"/></svg>
                                                       <?php
                                                       $postDateTime = get_post_datetime($business_classified_ads_locations_query->ID);
                                                       echo business_classified_ads_timeAgo($postDateTime->format('Y-m-d H:i:s')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="meta-ads-box2">
                                                <div class="ads-price">
                                                    <?php if( $business_classified_ads_ads_post_amount ){ ?>
                                                        <p><?php echo esc_html( $business_classified_ads_ads_post_amount ); ?><span><?php echo esc_html( $business_classified_ads_ads_post_amount_per_hours ); ?></span></p>
                                                    <?php } ?>
                                                </div>
                                                <div class="post-like-meta">
                                                    <?php if (class_exists('Posts_Like_Dislike')) { ?>
                                                        <span class="like-box">
                                                            <?php echo do_shortcode('[posts_like_dislike id="' . get_the_ID() . '"]'); ?>
                                                        </span>
                                                    <?php } ?>
                                                    <?php if (function_exists('epvc_fs')) { ?>
                                                        <span class="post-count">
                                                            <?php echo do_shortcode('[epvc_views id="' . get_the_ID() . '"]'); ?>
                                                        </span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $s++; endwhile; ?>
                                <?php wp_reset_postdata(); endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
    <?php }

endif;
if (!function_exists('business_classified_ads_post_format_icon')):

    // Post Format Icon.
    function business_classified_ads_post_format_icon() {

        $business_classified_ads_format = get_post_format(get_the_ID()) ?: 'standard';
        $business_classified_ads_icon = '';
        $business_classified_ads_title = '';
        if( $business_classified_ads_format == 'video' ){
            $business_classified_ads_icon = business_classified_ads_get_theme_svg( 'video' );
            $business_classified_ads_title = esc_html__('Video','business-classified-ads');
        }elseif( $business_classified_ads_format == 'audio' ){
            $business_classified_ads_icon = business_classified_ads_get_theme_svg( 'audio' );
            $business_classified_ads_title = esc_html__('Audio','business-classified-ads');
        }elseif( $business_classified_ads_format == 'gallery' ){
            $business_classified_ads_icon = business_classified_ads_get_theme_svg( 'gallery' );
            $business_classified_ads_title = esc_html__('Gallery','business-classified-ads');
        }elseif( $business_classified_ads_format == 'quote' ){
            $business_classified_ads_icon = business_classified_ads_get_theme_svg( 'quote' );
            $business_classified_ads_title = esc_html__('Quote','business-classified-ads');
        }elseif( $business_classified_ads_format == 'image' ){
            $business_classified_ads_icon = business_classified_ads_get_theme_svg( 'image' );
            $business_classified_ads_title = esc_html__('Image','business-classified-ads');
        } elseif( $business_classified_ads_format == 'link' ){
            $business_classified_ads_icon = business_classified_ads_get_theme_svg( 'link' );
            $business_classified_ads_title = esc_html__('Link','business-classified-ads');
        } elseif( $business_classified_ads_format == 'status' ){
            $business_classified_ads_icon = business_classified_ads_get_theme_svg( 'status' );
            $business_classified_ads_title = esc_html__('Status','business-classified-ads');
        } elseif( $business_classified_ads_format == 'aside' ){
            $business_classified_ads_icon = business_classified_ads_get_theme_svg( 'aside' );
            $business_classified_ads_title = esc_html__('Aside','business-classified-ads');
        } elseif( $business_classified_ads_format == 'chat' ){
            $business_classified_ads_icon = business_classified_ads_get_theme_svg( 'chat' );
            $business_classified_ads_title = esc_html__('Chat','business-classified-ads');
        }
        
        if (!empty($business_classified_ads_icon)) { ?>
            <div class="theme-post-format">
                <span class="post-format-icom"><?php echo business_classified_ads_svg_escape($business_classified_ads_icon); ?></span>
                <?php if( $business_classified_ads_title ){ echo '<span class="post-format-label">'.esc_html( $business_classified_ads_title ).'</span>'; } ?>
            </div>
        <?php }
    }

endif;

if ( ! function_exists( 'business_classified_ads_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $business_classified_ads_svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function business_classified_ads_svg_escape( $business_classified_ads_input ) {

        // Make sure that only our allowed tags and attributes are included.
        $business_classified_ads_svg = wp_kses(
            $business_classified_ads_input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $business_classified_ads_svg ) {
            return false;
        }

        return $business_classified_ads_svg;

    }

endif;

if( !function_exists( 'business_classified_ads_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function business_classified_ads_sanitize_sidebar_option_meta( $business_classified_ads_input ){

        $business_classified_ads_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $business_classified_ads_input,$business_classified_ads_metabox_options ) ){

            return $business_classified_ads_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'business_classified_ads_sanitize_pagination_meta' ) ) :

    // Sidebar Option Sanitize.
    function business_classified_ads_sanitize_pagination_meta( $business_classified_ads_input ){

        $business_classified_ads_metabox_options = array( 'Center','Right','Left');
        if( in_array( $business_classified_ads_input,$business_classified_ads_metabox_options ) ){

            return $business_classified_ads_input;

        }else{

            return '';

        }
    }

endif;

// Sanitize the enable/disable setting for pagination
if( !function_exists('business_classified_ads_sanitize_enable_pagination') ) :
    function business_classified_ads_sanitize_enable_pagination( $business_classified_ads_input ) {
        return (bool) $business_classified_ads_input;
    }
endif;

if( !function_exists( 'business_classified_ads_sanitize_pagination_type' ) ) :

    /**
     * Sanitize the pagination type setting.
     *
     * @param string $business_classified_ads_input The input value from the Customizer.
     * @return string The sanitized value.
     */
    function business_classified_ads_sanitize_pagination_type( $business_classified_ads_input ) {
        // Define valid options for the pagination type.
        $business_classified_ads_valid_options = array( 'numeric', 'newer_older' ); // Update valid options to include 'newer_older'

        // If the input is one of the valid options, return it. Otherwise, return the default option ('numeric').
        if ( in_array( $business_classified_ads_input, $business_classified_ads_valid_options, true ) ) {
            return $business_classified_ads_input;
        } else {
            // Return 'numeric' as the fallback if the input is invalid.
            return 'numeric';
        }
    }

endif;

if( !function_exists( 'business_classified_ads_sanitize_menu_transform' ) ) :

    // Sidebar Option Sanitize.
    function business_classified_ads_sanitize_menu_transform( $business_classified_ads_input ){

        $business_classified_ads_metabox_options = array( 'capitalize','uppercase','lowercase');
        if( in_array( $business_classified_ads_input,$business_classified_ads_metabox_options ) ){

            return $business_classified_ads_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'business_classified_ads_sanitize_page_content_alignment' ) ) :

    // Sidebar Option Sanitize.
    function business_classified_ads_sanitize_page_content_alignment( $business_classified_ads_input ){

        $business_classified_ads_metabox_options = array( 'left','center','right');
        if( in_array( $business_classified_ads_input,$business_classified_ads_metabox_options ) ){

            return $business_classified_ads_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'business_classified_ads_sanitize_footer_widget_title_alignment' ) ) :

    // Footer Option Sanitize.
    function business_classified_ads_sanitize_footer_widget_title_alignment( $business_classified_ads_input ){

        $business_classified_ads_metabox_options = array( 'left','center','right');
        if( in_array( $business_classified_ads_input,$business_classified_ads_metabox_options ) ){

            return $business_classified_ads_input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'business_classified_ads_sanitize_copyright_alignment_meta' ) ) :

    // Sidebar Option Sanitize.
    function business_classified_ads_sanitize_copyright_alignment_meta( $business_classified_ads_input ){

        $business_classified_ads_metabox_options = array( 'Default','Reverse','Center');
        if( in_array( $business_classified_ads_input,$business_classified_ads_metabox_options ) ){

            return $business_classified_ads_input;

        }else{

            return '';

        }
    }

endif;

/**
 * Sidebar Layout Function
 */
function business_classified_ads_get_final_sidebar_layout() {
	$business_classified_ads_defaults       = business_classified_ads_get_default_theme_options();
	$business_classified_ads_global_layout  = get_theme_mod('business_classified_ads_global_sidebar_layout', $business_classified_ads_defaults['business_classified_ads_global_sidebar_layout']);
	$business_classified_ads_page_layout    = get_theme_mod('business_classified_ads_page_sidebar_layout', $business_classified_ads_global_layout);
	$business_classified_ads_post_layout    = get_theme_mod('business_classified_ads_post_sidebar_layout', $business_classified_ads_global_layout);
	$business_classified_ads_meta_layout    = get_post_meta(get_the_ID(), 'business_classified_ads_post_sidebar_option', true);

	if (!empty($business_classified_ads_meta_layout) && $business_classified_ads_meta_layout !== 'default') {
		return $business_classified_ads_meta_layout;
	}
	if (is_page() || (function_exists('is_shop') && is_shop())) {
		return $business_classified_ads_page_layout;
	}
	if (is_single()) {
		return $business_classified_ads_post_layout;
	}
	return $business_classified_ads_global_layout;
}