<?php

function divine_woocommerce_add_layout_product_archive($options){
    $positions        = divine_get_positions(); 
    $sidebars_default = divine_get_sidebars_default();

    $layout = array(
        'title'     => __( 'Product archive', divine_get_domain() ),
        'preview'   => get_template_directory_uri() . '/images/layouts/product-archive.png',
        'positions' => array(           
            'pos_right',                        
            'pos_footer_1',
            'pos_footer_2',
            'pos_footer_3',
            'pos_footer_4',
            'pos_footer_5',
        )
    );

    $options[] = array(
        'title'   => __( 'Product archive',  divine_get_domain() ),
        'type'    => 'title',
        'id'      => 'product-archive',
    );

    $options[] = array(
        'title'     =>  __( 'Product archive',  divine_get_domain() ),
        'type'      => 'layout_manager',
        'id'        => 'product-archive',
        'positions' => $positions,
        'layouts'   => array(
            'product-archive' => $layout          
        ),
        'default' => array(
            'layout_id' => 'product-archive',
            'sidebars'  => array(
                'product-archive' => $sidebars_default                
            ),
        ),
    );

    return $options;
}

function divine_woocommerce_add_layout_product_single($options){
    $positions        = divine_get_positions(); 
    $sidebars_default = divine_get_sidebars_default();

    $layout = array(
        'title'     => __( 'Single product', divine_get_domain() ),
        'preview'   => get_template_directory_uri() . '/images/layouts/single-product.png',
        'positions' => array(           
            'pos_right',                        
            'pos_footer_1',
            'pos_footer_2',
            'pos_footer_3',
            'pos_footer_4',
            'pos_footer_5',
        )
    );

    $options[] = array(
        'title'   => __( 'Single product', divine_get_domain() ),
        'type'    => 'title',
        'id'      => 'single-product'
    );

    $options[] = array(
        'title'     =>  __( 'Single product',  divine_get_domain() ),
        'type'      => 'layout_manager',
        'id'        => 'single-product',
        'positions' => $positions,
        'layouts'   => array(
            'single-product' => $layout,      
        ),
        'default' => array(
            'layout_id' => 'single-product',
            'sidebars'  => array(
                'single-product' => $sidebars_default,            
            ),
        ),
    );

    return $options;
}

function divine_woocommerce_product_set_setting_id($setting_id){
    if(is_singular('product')){
         $setting_id = 'single-product';
    }else if (is_post_type_archive('product') || is_tax('product_tag') || is_tax('product_cat') ) {
         $setting_id = 'product-archive';
    }

    return $setting_id;
}


function divine_woocommerce_get_setting($setting, $setting_id){
    if(empty($setting)){
        if('single-product' == $setting_id){
            $layouts = divine_woocommerce_add_layout_product_single(array());
            if(isset($layouts[1]['default'])){
                $setting = $layouts[1]['default'];
            }
        }elseif('product-archive' == $setting_id){
            $layouts = divine_woocommerce_add_layout_product_archive(array());
            if(isset($layouts[1]['default'])){
                $setting = $layouts[1]['default'];
            }
        }
    }   

    return $setting;
}