<?php
/**
 * The template for displaying 404 pages (not found)
 * @package Business Classified Ads
 */
get_header();

$business_classified_ads_default = business_classified_ads_get_default_theme_options();

?>
    <div class="singular-main-block">
        <section class="theme-custom-block theme-error-section error-block-heading">
            <div class="wrapper">
                <div class="theme-area-header">
                    <div class="theme-area-headlines">
                        <?php 
                            $business_classified_ads_404_main_title = get_theme_mod( 'business_classified_ads_404_main_title', $business_classified_ads_default['business_classified_ads_404_main_title'] ); 
                        ?>
                        <h2 class="theme-area-title"><?php echo esc_html( $business_classified_ads_404_main_title ); ?></h2>
                        <div class="theme-animated-line"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="theme-custom-block theme-error-sectiontheme-error-section error-block-middle">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-12">
                        <?php 
                            $business_classified_ads_404_subtitle_one = get_theme_mod( 'business_classified_ads_404_subtitle_one', $business_classified_ads_default['business_classified_ads_404_subtitle_one'] ); 
                        ?>
                        <h2><?php echo esc_html( $business_classified_ads_404_subtitle_one ); ?></h2>
                        
                        <?php 
                            $business_classified_ads_404_para_one = get_theme_mod( 'business_classified_ads_404_para_one', $business_classified_ads_default['business_classified_ads_404_para_one'] ); 
                        ?>
                        <p><?php echo esc_html( $business_classified_ads_404_para_one ); ?> 
                            <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e('Homepage','business-classified-ads'); ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-12">
                        <?php 
                            $business_classified_ads_404_subtitle_two = get_theme_mod( 'business_classified_ads_404_subtitle_two', $business_classified_ads_default['business_classified_ads_404_subtitle_two'] ); 
                        ?>
                        <h2><?php echo esc_html( $business_classified_ads_404_subtitle_two ); ?></h2>
                        
                        <?php 
                            $business_classified_ads_404_para_two = get_theme_mod( 'business_classified_ads_404_para_two', $business_classified_ads_default['business_classified_ads_404_para_two'] ); 
                        ?>
                        <p><?php echo esc_html( $business_classified_ads_404_para_two ); ?></p>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php
get_footer();