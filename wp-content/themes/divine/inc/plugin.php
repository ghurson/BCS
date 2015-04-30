<?php
require_once trailingslashit(get_template_directory()) . '/inc/addon/TGMPluginActivation.class.php';

add_action('tgmpa_register', 'divine_register_required_plugins');

function divine_register_required_plugins() {
    $plugins = array(            
        array(
            'name' => 'WooCommerce',
            'slug' => 'woocommerce',
            'source' => 'http://downloads.wordpress.org/plugin/woocommerce.2.3.7.zip',
            'required' => false,
            'version' => '2.3.7',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),
        array(
            'name' => 'Envato WordPress Toolkit',
            'slug' => 'envato-wordpress-toolkit',
            'source' => get_template_directory() . '/plugins/envato-wordpress-toolkit.zip',
            'required' => false,
            'version' => '1.7.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),
        array(
            'name' => 'Revolution Slider',
            'slug' => 'revslider',
            'source' => get_template_directory() . '/plugins/revslider.zip',
            'required' => false,
            'version' => '4.6.5',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),
        array(
            'name' => 'Divine Toolkit',
            'slug' => 'divine-toolkit',
            'source' => get_template_directory() . '/plugins/divine-toolkit.zip',
            'required' => false,
            'version' => '2.0.7',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),
        array(
            'name' => 'Kopa Page Builder',
            'slug' => 'kopa-page-builder',
            'source' => get_template_directory() . '/plugins/kopa-page-builder.zip',
            'required' => false,
            'version' => '1.1.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),        
    );
    
    $config = array(        
        'has_notices' => true,
        'is_automatic' => false
    );
    
    tgmpa($plugins, $config);    
}
