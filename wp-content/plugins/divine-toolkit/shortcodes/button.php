<?php

add_shortcode('button', 'dvt_shortcode_button');

function dvt_shortcode_button($atts, $content = null) {
    extract(shortcode_atts(array('class' => '', 'link' => '', 'target' => ''), $atts));

    $link    = isset($atts['link']) ? $atts['link'] : '#';
    $class   = isset($atts['class']) ? $atts['class'] : 'kp-button';
    $target  = isset($atts['target']) ? $atts['target'] : '';    
    $classes = explode(' ', $class);

    if (is_array($classes) && count($classes) > 0) {
        if (in_array('span-button', $classes)) {
            $content = "<span>{$content}</span>";
        }
    }

    if(!$target){
        $target = '_self';
    }

    $output = sprintf('<a href="%s" class="%s" target="%s">%s</a>', $link, $class, $target, do_shortcode($content));
    return apply_filters('dvt_shortcode_button', $output);
}
