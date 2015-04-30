<?php

function divine_woocommerce_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr){
    
    if(has_post_thumbnail($post_id)){
        if('shop_catalog' == $size){
            $image = divine_post_bfi_thumb($post_id, NULL, 300, 300, TRUE);
            $html = sprintf('<img src="%s" class="attachment-shop_catalog wp-post-image">', $image);
        }else if('shop_single' == $size){
            $image = divine_post_bfi_thumb($post_id, NULL, 552, 552, TRUE);
            $html = sprintf('<img src="%s" class="attachment-shop_single wp-post-image">', $image);
        }else if('shop_thumbnail' == $size){
            $image = divine_post_bfi_thumb($post_id, NULL, 170, 170, TRUE);
            $html = sprintf('<img src="%s" class="attachment-shop_thumbnail">', $image);
        }
    }

    return $html;
}

function divine_woocommerce_get_attachment_image_attributes($attr, $attachment){
    if(isset($attr['class']) && 'attachment-shop_thumbnail' == $attr['class']){
        $image_obj = wp_get_attachment_image_src($attachment->ID, 'full');
        $attr['src'] = divine_bfi_thumb($image_obj[0], NULL, 170, 170, TRUE);                    
    }

    if(!isset($attr['alt'])){
        $attr['alt'] = '';
    }

    return $attr;
}