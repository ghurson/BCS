<?php

function divine_woocommerce_breadcrumb($breadcrumb, $current_class, $prefix) {
    if (is_post_type_archive('product')) {
        $breadcrumb = $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%s" class="%s" itemprop="url"><span itemprop="title">%s</span></a></span>', get_post_type_archive_link('product'), $current_class, __('Shop', kopa_get_domain()));
    } else if (is_tax('product_cat') || is_tax('product_tag')) {
        
    } else if (is_singular('product')) {
        global $post;
        $breadcrumb = $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%s" itemprop="url"><span itemprop="title">%s</span></a></span>', get_post_type_archive_link('product'), __('Shop', kopa_get_domain()));

        $tags = get_the_terms($post, 'product_cat');
        if ($tags) {
            foreach ($tags as $tag) {
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_term_link($tag->term_id, 'product_cat'), $tag->name);
            }
        }
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_permalink($post->ID), esc_html(get_the_title($post->ID)));
    }

    return $breadcrumb;
}

function divine_woocommerce_breadcrumb_site_title($title) {
    if (is_post_type_archive('product')) {
        $title = kopa_get_option('product-archive-breadcrumb-title', 'Shop');
    } else if(is_tax('product_cat') || is_tax('product_tag')){
        $term = get_queried_object();
        $title = $term->name;
    }else if (is_singular('product')) {
        global $post;
        $title = get_the_title($post);
    }
    return $title;
}

function divine_woocommerce_breadcrumb_site_desc($desc) {
    if (is_post_type_archive('product')) {
        $desc = kopa_get_option('product-archive-breadcrumb-description');
    } else if(is_tax('product_cat') || is_tax('product_tag')){
        $term = get_queried_object();        
        if($term->description){
            $desc = wp_trim_words($term->description, 10, '..');
        }else{
            $desc = kopa_get_option('product-archive-breadcrumb-description');
        }        
    } else if (is_singular('product')) {
        global $post;
        $desc =  wp_trim_words(get_post_field('post_excerpt', $post), 10, '..');
    }

    return $desc;
}

function divine_woocommerce_insert_clearfix_after_last_col(){
    global $product, $woocommerce_loop;

    $loop = (int) $woocommerce_loop['loop'];
    $columns = (int)$woocommerce_loop['columns'];

    if($loop % $columns == 0){
        ?>
        <li class="clearfix"></li>
        <?php
    }    
}

function divine_woocommerce_modify_loop_shop_columns($columns){
    $new_colums = (int)kopa_get_option('product-archive-products-per-row', 4);
    if($new_colums){
        $columns = $new_colums;
    }
    
    return $columns;
}

function divine_woocommerce_add_post_class_for_product_archive($classes){
    if(is_post_type_archive('product') || is_tax('product_tag') || is_tax('product_cat')){
        $classes = divine_woocommerce_add_post_class_for_product_list($classes);
    }

    return $classes;
}

function divine_woocommerce_add_post_class_for_product_list($classes){
    
    $new_colums = (int)kopa_get_option('product-archive-products-per-row', 4);
        if($new_colums){
            switch ($new_colums) {
                case 3:
                    array_push($classes, 'col-md-4', 'col-sm-4', 'col-xs-12');
                    break; 
                case 4:
                    array_push($classes, 'col-md-3', 'col-sm-3', 'col-xs-12');
                    break;           
                case 6:
                    array_push($classes, 'col-md-2', 'col-sm-2', 'col-xs-12');
                    break;
                default:
                    array_push($classes, 'col-md-4', 'col-sm-4', 'col-xs-12');
                    break;
            }
        }
    
    return $classes;
}

function divine_woocommerce_edit_query($query){
    if (!is_admin() && $query->is_main_query()) {
        if(is_post_type_archive('product')){       

            $columns = (int)kopa_get_option('product-archive-products-per-row', 3);
            $rows    = (int)kopa_get_option('product-archive-rows-per-page', 3);            

            if($rows && $columns){
                $query->query_vars['posts_per_page'] = (int) $rows * $columns;
            }
        }
    }
}