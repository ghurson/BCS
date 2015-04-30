<?php

add_shortcode('alert', 'dvt_shortcode_alert');

function dvt_shortcode_alert($atts, $content = null) {
    if ($content) {
        extract(shortcode_atts(array('class' => 'alert-info alert-dismissable'), $atts));
        $class = isset($atts['class']) ? $atts['class'] : 'alert-info alert-dismissable';
        
        return apply_filters('dvt_shortcode_alert', sprintf('<div class="kopa-alert %s">%s<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button></div>', $class, $content));
    }
}