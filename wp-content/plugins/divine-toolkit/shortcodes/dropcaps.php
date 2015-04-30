<?php

add_shortcode('dropcap', 'dvt_shortcode_dropcap');

function dvt_shortcode_dropcap($atts, $content = null) {
    if ($content) {
        extract(shortcode_atts(array('class' => ''), $atts));
        $class = isset($atts['class']) ? $atts['class'] : 'kopa-dropcap dc1';
        return apply_filters('dvt_shortcode_dropcap', sprintf('<span class="%s">%s</span>', $class, $content));
    }
}