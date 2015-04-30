<?php
function divine_woocommerce_settings($options){
    $options[] = array(
        'title'   => __( 'Product', divine_get_domain() ),
        'type'    => 'title',       
        'id'      => 'product'        
    );          
        $options[] = array(
            'title' => __( 'Breadcrumb', divine_get_domain() ),
            'type'  => 'groupstart',
            'id'    => 'product-archive-group',           
        );
            $options[] = array(
                'title'   => __( 'Title', divine_get_domain() ),
                'type'    => 'text',            
                'id'      => 'product-archive-breadcrumb-title',
                'default' => __( 'Product', divine_get_domain() ),
            );
            $options[] = array(
                'title'   => __( 'Description', divine_get_domain() ),
                'type'    => 'textarea',                
                'id'      => 'product-archive-breadcrumb-description',
                'default' => '',        
            );
        $options[] = array(
            'type'  => 'groupend',
            'id'    => 'product-archive-group',           
        );

        $options[] = array(
            'title'   => __( 'Products per row', divine_get_domain() ),
            'type'    => 'select',            
            'id'      => 'product-archive-products-per-row',
            'default' => 4,
            'options' => array(
                1 => 1,
                2 => 2,
                3 => 3,
                4 => 4,
                6 => 6
            ),
        );
        $options[] = array(
            'title'   => __( 'Rows per page', divine_get_domain() ),
            'type'    => 'text',            
            'id'      => 'product-archive-rows-per-page',
            'default' => 3,
        );     

    return $options;
}