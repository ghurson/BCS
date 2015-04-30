<?php

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'dvt_shortcode_gallery');

function dvt_shortcode_gallery($atts) {
    extract(shortcode_atts(array("ids" => ''), $atts));
    $output = '';

    if (isset($atts['ids'])) {
        $ids = explode(',', $atts['ids']);
        if ($ids) {

            $output .= '<div class="owl-carousel owl-carousel-6">';
            foreach ($ids as $id) {
                $image_obj = wp_get_attachment_image_src($id, 'full');                
                if (!empty($image_obj)) {                    
                    $image = divine_bfi_thumb($image_obj[0], 'blog-thumnail');                
                    $output .= sprintf('<div class="item"><img src="%s" alt="%s"></div>', $image, get_post_field('post_excerpt', $id));
                }
            }

            $output.= '</div>';
        }
    }

    return apply_filters('dvt_shortcode_gallery', force_balance_tags($output), $atts);
}
