<?php

add_filter('wp_video_shortcode', 'dvt_video_shortcode');

function dvt_video_shortcode($html) {    
    if (!empty($html)) {
        $out = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);
        $out = preg_replace('/(width|height)="\d*"\s/', "", $out);
    }

    return $out;
}
