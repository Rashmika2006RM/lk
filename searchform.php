<?php
/**
 * Search Template for search form
 * @package Business Classified Ads
 * @since 1.0.0
 */
?>
<form role="search" method="get" class="search-form search-form-custom" action="<?php echo esc_url(home_url('/')); ?>">

    <label>
        <input type="search" class="search-field" placeholder="<?php esc_attr_e('Search...', 'business-classified-ads'); ?>" value="<?php echo esc_attr(get_search_query()) ?>" name="s">
    </label>
    <button type="submit" class="search-submit"><?php business_classified_ads_the_theme_svg('search'); ?></button>
</form>