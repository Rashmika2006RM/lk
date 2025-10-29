<?php
/**
* Header Banner Options.
*
* @package Business Classified Ads
*/

$business_classified_ads_default = business_classified_ads_get_default_theme_options();
$business_classified_ads_post_category_list = business_classified_ads_post_category_list();

$wp_customize->add_section( 'header_banner_setting',
    array(
    'title'      => esc_html__( 'Slider Settings', 'business-classified-ads' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

// Show/Hide Site Logo
$wp_customize->add_setting('business_classified_ads_display_logo', array(
    'default'           => false,
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
));
$wp_customize->add_control('business_classified_ads_display_logo', array(
    'label'    => esc_html__('Enable / Disable Site Logo', 'business-classified-ads'),
    'section'  => 'title_tagline',
    'type'     => 'checkbox',
));

// Show/Hide Site Title
$wp_customize->add_setting('business_classified_ads_display_title', array(
    'default'           => true,
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
));
$wp_customize->add_control('business_classified_ads_display_title', array(
    'label'    => esc_html__('Enable / Disable Site Title', 'business-classified-ads'),
    'section'  => 'title_tagline',
    'type'     => 'checkbox',
));

// Show/Hide Site Tagline
$wp_customize->add_setting('business_classified_ads_display_header_text',
    array(
        'default'           => false,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_display_header_text',
    array(
        'label' => esc_html__('Enable / Disable Site Tagline', 'business-classified-ads'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('business_classified_ads_header_slider',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_header_slider'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_header_slider',
    array(
        'label' => esc_html__('Enable Slider', 'business-classified-ads'),
        'section' => 'header_banner_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'business_classified_ads_header_banner_cat',
    array(
    'default'           => 'Slider',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'business_classified_ads_sanitize_select',
    )
);
$wp_customize->add_control( 'business_classified_ads_header_banner_cat',
    array(
    'label'       => esc_html__( 'Slider Post Category', 'business-classified-ads' ),
    'section'     => 'header_banner_setting',
    'type'        => 'select',
    'choices'     => $business_classified_ads_post_category_list,
    )
);

$wp_customize->add_setting( 'business_classified_ads_contact_form_shortcode',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_contact_form_shortcode',
    array(
    'label'    => esc_html__( 'Form Shortcode ', 'business-classified-ads' ),
    'section'  => 'header_banner_setting',
    'type'     => 'text',
    )
);

// Latest Videos

$wp_customize->add_section( 'product_column_setting',
    array(
    'title'      => esc_html__( 'Latest Videos', 'business-classified-ads' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting('business_classified_ads_locations_post',
    array(
        'default' => $business_classified_ads_default['business_classified_ads_locations_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'business_classified_ads_sanitize_checkbox',
    )
);
$wp_customize->add_control('business_classified_ads_locations_post',
    array(
        'label' => esc_html__('Enable Recommend Ads', 'business-classified-ads'),
        'section' => 'product_column_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'business_classified_ads_team_section_title',
    array(
    'default'           => $business_classified_ads_default['business_classified_ads_team_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'business_classified_ads_team_section_title',
    array(
    'label'    => esc_html__( 'Section Heading ', 'business-classified-ads' ),
    'section'  => 'product_column_setting',
    'type'     => 'text',
    )
);

$categories = get_categories();
$cat_post = array();
$cat_post[]= 'select';
$m = 0;
foreach($categories as $category){
    if($m==0){
        $default = $category->slug;
        $m++;
    }
    $cat_post[$category->slug] = $category->name;
}

$wp_customize->add_setting('business_classified_ads_video_section_left_post_cat',array(
    'sanitize_callback' => 'business_classified_ads_sanitize_select',
));
$wp_customize->add_control('business_classified_ads_video_section_left_post_cat' ,array(
    'type'    => 'select',
    'choices' => $cat_post,
    'label' => __('Select Category to display Left Post','business-classified-ads'),
    'section' => 'product_column_setting',
));


for($i=1; $i<= 6; $i++) {

    $wp_customize->add_setting( 'business_classified_ads_ads_discription'.$i,
        array(
        'default'           => 'Automobile/Private Car',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( 'business_classified_ads_ads_discription'.$i,
        array(
        /* translators: %d: Post Description Count. */
        'label'    => sprintf( esc_html__( 'Ads Post Description %d', 'business-classified-ads' ), $i ),
        'section'  => 'product_column_setting',
        'type'     => 'text',
        )
    );

    $wp_customize->add_setting( 'business_classified_ads_ads_post_location'.$i,
        array(
        'default'           => 'Allentown, New Mexico',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( 'business_classified_ads_ads_post_location'.$i,
        array(
        /* translators: %d: Location Count. */
        'label'    => sprintf( esc_html__( 'Ads Location %d', 'business-classified-ads' ), $i ),
        'section'  => 'product_column_setting',
        'type'     => 'text',
        )
    );

    $wp_customize->add_setting( 'business_classified_ads_ads_post_amount'.$i,
        array(
        'default'           => '$12,000',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( 'business_classified_ads_ads_post_amount'.$i,
        array(
        /* translators: %d: Price Count. */
        'label'    => sprintf( esc_html__( 'Ads Price %d', 'business-classified-ads' ), $i ),
        'section'  => 'product_column_setting',
        'type'     => 'text',
        )
    );

    $wp_customize->add_setting( 'business_classified_ads_ads_post_amount_per_hours'.$i,
        array(
        'default'           => '/Per Month',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( 'business_classified_ads_ads_post_amount_per_hours'.$i,
        array(
        /* translators: %d: Price Duration Count. */
        'label'    => sprintf( esc_html__( 'Ads Price Duration %d', 'business-classified-ads' ), $i ),
        'section'  => 'product_column_setting',
        'type'     => 'text',
        )
    );

}