<?php

add_shortcode('tabs', 'dvt_shortcode_tabs');
add_shortcode('tab', '__return_false');

function dvt_shortcode_tabs($atts, $content = null) {
    extract(shortcode_atts(array(
        'class' => ''), $atts));

    $items = dvt_get_shortcode($content, true, array('tab'));
    $navs = array();
    $panels = array();

    if ($items) {
        $active = 'active';
        foreach ($items as $item) {
            $title    = $item['atts']['title'];
            $item_id  = 'tab-' . wp_generate_password(4, false, false);
            $navs[]   = sprintf('<li class="%s"><a href="#%s" data-toggle="tab">%s</a></li>', $active, $item_id, do_shortcode($title));
            $panels[] = sprintf('<div class="tab-pane %s" id="%s">%s</div>', $active, $item_id, do_shortcode($item['content']));
            $active   = '';
        }
    }

    $output = sprintf('<div class="%s widget clearfix">', $class);
    
    $output .= '<ul class="nav nav-tabs" >';
    $output .= implode('', $navs);
    $output .= '</ul>';
    
    $output .= '<div class="tab-content">';
    $output .= implode('', $panels);
    $output .= '</div>';
    
    $output .= '</div>';

    return apply_filters('dvt_shortcode_tabs', $output);
}