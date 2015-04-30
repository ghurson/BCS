<?php

add_shortcode('toggles', 'dvt_shortcode_toggles');
add_shortcode('toggle', '__return_false');

function dvt_shortcode_toggles($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));

    $items = dvt_get_shortcode($content, true, array('toggle'));

    $output = '';

    if ($items) {        
        $is_first = TRUE;
        
        $output.= '<div class="kopa-toggle-widget clearfix">';
        $output.= '<div class="panel-group">';


        foreach ($items as $item) {
            $child_id = 'toggle-' . wp_generate_password(4, false, false);            
            $title    = $item['atts']['title'];            
            $output   .= '<div class="panel panel-default">';

            if ($is_first) {
                $output .= '<div class="panel-heading active">';
            } else {
                $output .= '<div class="panel-heading">';
            }

            $output .= '<h4 class="panel-title">';
            $output .= sprintf('<a data-toggle="collapse" href="#%s">', $child_id);

            if ($is_first) {
                $output .= '<span class="b-collapse">-</span>';
            } else {
                $output .= '<span class="b-collapse">+</span>';
            }
            
            $output .= sprintf('<span class="tab-title">%s</span>', $title);
            $output .= '</a>';
            $output .= '</h4>';
            $output .= '</div>';

            if ($is_first) {
                $output.= sprintf('<div id="%s" class="panel-collapse collapse in">', $child_id);
            } else {
                $output.= sprintf('<div id="%s" class="panel-collapse collapse">', $child_id);
            }
            
            $output   .= '<div class="panel-body">';
            $output   .= do_shortcode($item['content']);
            $output   .= '</div>';
            $output   .= '</div>';
            $output   .= '</div>';
            
            $is_first = FALSE;
        }
    }

    $output .= '</div>';
    $output .= '</div>';

    return apply_filters('dvt_shortcode_toggles', $output, $atts, $content);
}