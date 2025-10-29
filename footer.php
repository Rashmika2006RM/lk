<?php
/**
 * The template for displaying the footer
 * @package Business Classified Ads
 * @since 1.0.0
 */

/**
 * Toogle Contents
 * @hooked business_classified_ads_content_offcanvas - 30
*/

do_action('business_classified_ads_before_footer_content_action'); ?>

</div>

<footer id="site-footer" role="contentinfo">

    <?php
    /**
     * Footer Content
     * @hooked business_classified_ads_footer_content_widget - 10
     * @hooked business_classified_ads_footer_content_info - 20
    */

    do_action('business_classified_ads_footer_content_action'); ?>

</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>