<?php
/**
 * Custom page walker for this theme.
 *
 * @package Business Classified Ads
 */

if (!class_exists('Business_Classified_Ads_Walker_Page')) {
    /**
     * CUSTOM PAGE WALKER
     * A custom walker for pages.
     */
    class Business_Classified_Ads_Walker_Page extends Walker_Page
    {

        /**
         * Outputs the beginning of the current element in the tree.
         *
         * @param string $business_classified_ads_output Used to append additional content. Passed by reference.
         * @param WP_Post $page Page data object.
         * @param int $business_classified_ads_depth Optional. Depth of page. Used for padding. Default 0.
         * @param array $business_classified_ads_args Optional. Array of arguments. Default empty array.
         * @param int $current_page Optional. Page ID. Default 0.
         * @since 2.1.0
         *
         * @see Walker::start_el()
         */

        public function start_lvl( &$business_classified_ads_output, $business_classified_ads_depth = 0, $business_classified_ads_args = array() ) {
            $business_classified_ads_indent  = str_repeat( "\t", $business_classified_ads_depth );
            $business_classified_ads_output .= "$business_classified_ads_indent<ul class='sub-menu'>\n";
        }

        public function start_el(&$business_classified_ads_output, $page, $business_classified_ads_depth = 0, $business_classified_ads_args = array(), $current_page = 0)
        {

            if (isset($business_classified_ads_args['item_spacing']) && 'preserve' === $business_classified_ads_args['item_spacing']) {
                $t = "\t";
                $n = "\n";
            } else {
                $t = '';
                $n = '';
            }
            if ($business_classified_ads_depth) {
                $business_classified_ads_indent = str_repeat($t, $business_classified_ads_depth);
            } else {
                $business_classified_ads_indent = '';
            }

            $business_classified_ads_css_class = array('page_item', 'page-item-' . $page->ID);

            if (isset($business_classified_ads_args['pages_with_children'][$page->ID])) {
                $business_classified_ads_css_class[] = 'page_item_has_children';
            }

            if (!empty($current_page)) {
                $_current_page = get_post($current_page);
                if ($_current_page && in_array($page->ID, $_current_page->ancestors, true)) {
                    $business_classified_ads_css_class[] = 'current_page_ancestor';
                }
                if ($page->ID === $current_page) {
                    $business_classified_ads_css_class[] = 'current_page_item';
                } elseif ($_current_page && $page->ID === $_current_page->post_parent) {
                    $business_classified_ads_css_class[] = 'current_page_parent';
                }
            } elseif (get_option('page_for_posts') === $page->ID) {
                $business_classified_ads_css_class[] = 'current_page_parent';
            }

            /** This filter is documented in wp-includes/class-walker-page.php */
            $business_classified_ads_css_classes = implode(' ', apply_filters('page_css_class', $business_classified_ads_css_class, $page, $business_classified_ads_depth, $business_classified_ads_args, $current_page));
            $business_classified_ads_css_classes = $business_classified_ads_css_classes ? ' class="' . esc_attr($business_classified_ads_css_classes) . '"' : '';

            if ('' === $page->post_title) {
                /* translators: %d: ID of a post. */
                $page->post_title = sprintf(__('#%d (no title)', 'business-classified-ads'), $page->ID);
            }

            $business_classified_ads_args['link_before'] = empty($business_classified_ads_args['link_before']) ? '' : $business_classified_ads_args['link_before'];
            $business_classified_ads_args['link_after'] = empty($business_classified_ads_args['link_after']) ? '' : $business_classified_ads_args['link_after'];

            $business_classified_ads_atts = array();
            $business_classified_ads_atts['href'] = get_permalink($page->ID);
            $business_classified_ads_atts['aria-current'] = ($page->ID === $current_page) ? 'page' : '';

            /** This filter is documented in wp-includes/class-walker-page.php */
            $business_classified_ads_atts = apply_filters('page_menu_link_attributes', $business_classified_ads_atts, $page, $business_classified_ads_depth, $business_classified_ads_args, $current_page);

            $business_classified_ads_attributes = '';
            foreach ($business_classified_ads_atts as $attr => $business_classified_ads_value) {
                if (!empty($business_classified_ads_value)) {
                    $business_classified_ads_value = ('href' === $attr) ? esc_url($business_classified_ads_value) : esc_attr($business_classified_ads_value);
                    $business_classified_ads_attributes .= ' ' . $attr . '="' . $business_classified_ads_value . '"';
                }
            }

            $business_classified_ads_args['list_item_before'] = '';
            $business_classified_ads_args['list_item_after'] = '';
            $business_classified_ads_args['icon_rennder'] = '';
            // Wrap the link in a div and append a sub menu toggle.
            if (isset($business_classified_ads_args['show_toggles']) && true === $business_classified_ads_args['show_toggles']) {
                // Wrap the menu item link contents in a div, used for positioning.
                $business_classified_ads_args['list_item_after'] = '';
            }


            // Add icons to menu items with children.
            if (isset($business_classified_ads_args['show_sub_menu_icons']) && true === $business_classified_ads_args['show_sub_menu_icons']) {
                if (isset($business_classified_ads_args['pages_with_children'][$page->ID])) {
                    $business_classified_ads_args['icon_rennder'] = '';
                }
            }

            // Add icons to menu items with children.
            if (isset($business_classified_ads_args['show_toggles']) && true === $business_classified_ads_args['show_toggles']) {
                if (isset($business_classified_ads_args['pages_with_children'][$page->ID])) {

                    $toggle_target_string = '.page_item.page-item-' . $page->ID . ' > .sub-menu';

                    $business_classified_ads_args['list_item_after'] = '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __( 'Show sub menu', 'business-classified-ads' ) . '</span>' . business_classified_ads_get_theme_svg( 'chevron-down' ) . '</span></button>';
                }
            }

            if (isset($business_classified_ads_args['show_toggles']) && true === $business_classified_ads_args['show_toggles']) {

                $business_classified_ads_output .= $business_classified_ads_indent . sprintf(
                        '<li%s>%s%s<a%s>%s%s%s</a>%s%s',
                        $business_classified_ads_css_classes,
                        '<div class="submenu-wrapper">',
                        $business_classified_ads_args['list_item_before'],
                        $business_classified_ads_attributes,
                        $business_classified_ads_args['link_before'],
                        /** This filter is documented in wp-includes/post-template.php */
                        apply_filters('the_title', $page->post_title, $page->ID),
                        $business_classified_ads_args['link_after'],
                        $business_classified_ads_args['list_item_after'],
                        '</div>'
                    );

            }else{

                $business_classified_ads_output .= $business_classified_ads_indent . sprintf(
                        '<li%s>%s<a%s>%s%s%s%s</a>%s',
                        $business_classified_ads_css_classes,
                        $business_classified_ads_args['list_item_before'],
                        $business_classified_ads_attributes,
                        $business_classified_ads_args['link_before'],
                        /** This filter is documented in wp-includes/post-template.php */
                        apply_filters('the_title', $page->post_title, $page->ID),
                        $business_classified_ads_args['icon_rennder'],
                        $business_classified_ads_args['link_after'],
                        $business_classified_ads_args['list_item_after']
                    );

            }

            if (!empty($business_classified_ads_args['show_date'])) {
                if ('modified' === $business_classified_ads_args['show_date']) {
                    $business_classified_ads_time = $page->post_modified;
                } else {
                    $business_classified_ads_time = $page->post_date;
                }

                $business_classified_ads_date_format = empty($business_classified_ads_args['date_format']) ? '' : $business_classified_ads_args['date_format'];
                $business_classified_ads_output .= ' ' . mysql2date($business_classified_ads_date_format, $business_classified_ads_time);
            }
        }
    }
}