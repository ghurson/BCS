<?php

if (!class_exists('WooCommerce'))
    return;

require_once trailingslashit(get_template_directory()) . '/woocommerce/include/image-size.php';
require_once trailingslashit(get_template_directory()) . '/woocommerce/include/layout.php';
require_once trailingslashit(get_template_directory()) . '/woocommerce/include/theme-options.php';
require_once trailingslashit(get_template_directory()) . '/woocommerce/include/hook.php';

add_action('init', 'divine_woocommerce_init');

function divine_woocommerce_init() {    
    #LAYOUT
    add_filter('kopa_layout_manager_settings', 'divine_woocommerce_add_layout_product_archive');
    add_filter('kopa_layout_manager_settings', 'divine_woocommerce_add_layout_product_single');
    add_filter('kopa_custom_template_setting_id', 'divine_woocommerce_product_set_setting_id');
    add_filter('kopa_custom_template_setting', 'divine_woocommerce_get_setting', 10, 2);

    #BREADCRUMB
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    add_filter('kopa_get_breadcrumb', 'divine_woocommerce_breadcrumb', 10, 3);
    add_filter('divine_breadcrumb_site_title', 'divine_woocommerce_breadcrumb_site_title');
    add_filter('divine_breadcrumb_site_desc', 'divine_woocommerce_breadcrumb_site_desc');

    #THEME-OPTION
    add_filter( 'kopa_theme_options_settings', 'divine_woocommerce_settings');


    // #CONTENT
    add_action('woocommerce_after_shop_loop_item', 'divine_woocommerce_insert_clearfix_after_last_col');

    // #ARCHIVE
    add_filter('loop_shop_columns', 'divine_woocommerce_modify_loop_shop_columns');
    add_filter('post_class', 'divine_woocommerce_add_post_class_for_product_archive', 20);
    add_action('pre_get_posts', 'divine_woocommerce_edit_query');   

    #THUMBNAIL        
    add_filter('post_thumbnail_html', 'divine_woocommerce_thumbnail_html', 10, 5);
    add_filter('wp_get_attachment_image_attributes', 'divine_woocommerce_get_attachment_image_attributes', 10, 2);        
}