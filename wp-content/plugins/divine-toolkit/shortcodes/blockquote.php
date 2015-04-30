<?php

add_shortcode('blockquote', 'dvt_shortcode_blockquote');

function dvt_shortcode_blockquote($atts, $content = null) {
    extract(shortcode_atts(array('class' => '', 'title' => ''), $atts));

    $output = NULL;

    if (!empty($content)) {
        $output = sprintf('<blockquote class="%s">%s', $atts['class'], $content);

        if (isset($atts['title'])) {
            $output.= '<div class="b-line"><span></span>';
            $output.= sprintf('<span>%s</span>', $atts['title']);
            $output.= '</div>';
        }

        $output.= '</blockquote>';
    }

    return apply_filters('dvt_shortcode_blockquote', force_balance_tags($output), $atts, $content);
}
