<?php

add_shortcode('row', 'dvt_shortcode_row');
add_shortcode('col', '__return_false');

function dvt_shortcode_row($atts, $content = null) {
    extract(shortcode_atts(array(), $atts));

    $items = dvt_get_shortcode($content, true, array('col'));
    $panels = array();

    if ($items) {
        foreach ($items as $item) {
            $panels[] = sprintf('<div class="col-sm-%s">%s</div>', $item['atts']['col'], do_shortcode($item['content']));
        }
    }

    $output = '<div class="row clearfix">';
    $output.= implode('', $panels);
    $output.= '</div>';

    return apply_filters('dvt_shortcode_row', $output);
}