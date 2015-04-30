<?php

add_shortcode('youtube', 'dvt_shortcode_youtube');

function dvt_shortcode_youtube($atts, $content = null) {
    extract(shortcode_atts(array('id' => ''), $atts));
    $out = NULL;

    if (isset($atts['id']) && !empty($atts['id'])) {     
        $out .= '<div class="video-wrapper"><iframe src="http://www.youtube.com/embed/' . $atts['id'] . '?rel=0&color=white&modestbranding=1&showinfo=0&wmode=transparent" frameborder="0" allowfullscreen></iframe></div>';
    }

    return apply_filters('dvt_shortcode_youtube', force_balance_tags($out));
}
