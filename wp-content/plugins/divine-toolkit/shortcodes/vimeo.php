<?php

add_shortcode('vimeo', 'dvt_shortcode_vimeo');

function dvt_shortcode_vimeo($atts, $content = null) {
    extract(shortcode_atts(array('id' => ''), $atts));
    $out = NULL;

    if (isset($atts['id']) && !empty($atts['id'])) {        
        $out .= '<div class="video-wrapper"><iframe src="http://player.vimeo.com/video/' . $atts['id'] . '" frameborder="0" allowfullscreen></iframe></div>';
    }

    return apply_filters('dvt_shortcode_vimeo', force_balance_tags($out));
}