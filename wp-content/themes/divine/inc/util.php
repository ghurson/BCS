<?php

function divine_log($message){
	if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

function divine_get_image_src($post_id = 0, $size = 'thumbnail') {
    $thumb = get_the_post_thumbnail($post_id, $size);
    if (!empty($thumb)) {
        $_thumb = array();
        $regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
        preg_match($regex, $thumb, $_thumb);
        $thumb = $_thumb[2];
    }
    
    return $thumb;
}

function divine_bfi_thumb($image, $size = NULL, $width = NULL, $height = NULL, $crop = true, $params = array()) {
    $src = NULL;

    if (!empty($image)) {
        if (empty($width) && empty($height) && !empty($size)) {
            $sizes = divine_get_image_sizes();

            if (isset($sizes[$size])) {
                $width = $sizes[$size]['width'];
                $height = $sizes[$size]['height'];
                $crop = $sizes[$size]['crop'];
            }            
        }
        $params = array_merge($params, array('width' => $width, 'height' => $height, 'crop' => $crop));
        $src = bfi_thumb($image, $params);
    }  

    return apply_filters('divine_bfi_thumb', $src, $image, $size, $width, $height, $crop);
}

function divine_post_bfi_thumb($post_id = 0, $size = NULL, $width = NULL, $height = NULL, $crop = true, $params = array()) {
    $src = NULL;    

    if( $custom_image = get_post_meta( $post_id, KOPA_PREFIX . $size , true ) ){
        $src = $custom_image;
    }

    if (isset($post_id) && !empty($post_id) && has_post_thumbnail($post_id)) {       
        if (empty($src)) {
            if( $image = divine_get_image_src($post_id, 'full')){
                $src = divine_bfi_thumb($image, $size, $width, $height, $crop, $params);
            }            
        }
    }

    return apply_filters('divine_post_bfi_thumb', $src, $post_id, $size, $width, $height, $crop);
}

function divine_get_attribute($attrib, $tag){        
    $re = '/' . preg_quote($attrib) . '=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
    if (preg_match($re, $tag, $match)) {
        return urldecode($match[2]);
    }
    return false;
}

function divine_convert_hex2rgba($color, $opacity = false) {
    $default = 'rgb(0,0,0)';    
    
    if (empty($color))
        return $default;    

    if ($color[0] == '#')
        $color = substr($color, 1);
    
    if (strlen($color) == 6)
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    
    elseif (strlen($color) == 3)
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    
    else
        return $default;
       
    $rgb = array_map('hexdec', $hex);    

    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;

        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }    
    return $output;
}

function divine_adjust_color_lighten_darken($color_code, $percentage_adjuster = 0) {
    $percentage_adjuster = round($percentage_adjuster / 100, 2);
    if (is_array($color_code)) {
        $r = $color_code["r"] - (round($color_code["r"]) * $percentage_adjuster);
        $g = $color_code["g"] - (round($color_code["g"]) * $percentage_adjuster);
        $b = $color_code["b"] - (round($color_code["b"]) * $percentage_adjuster);

        return array("r" => round(max(0, min(255, $r))),
            "g" => round(max(0, min(255, $g))),
            "b" => round(max(0, min(255, $b))));
    } else if (preg_match("/#/", $color_code)) {
        $hex = str_replace("#", "", $color_code);
        $r = (strlen($hex) == 3) ? hexdec(substr($hex, 0, 1) . substr($hex, 0, 1)) : hexdec(substr($hex, 0, 2));
        $g = (strlen($hex) == 3) ? hexdec(substr($hex, 1, 1) . substr($hex, 1, 1)) : hexdec(substr($hex, 2, 2));
        $b = (strlen($hex) == 3) ? hexdec(substr($hex, 2, 1) . substr($hex, 2, 1)) : hexdec(substr($hex, 4, 2));
        $r = round($r - ($r * $percentage_adjuster));
        $g = round($g - ($g * $percentage_adjuster));
        $b = round($b - ($b * $percentage_adjuster));

        return "#" . str_pad(dechex(max(0, min(255, $r))), 2, "0", STR_PAD_LEFT)
                . str_pad(dechex(max(0, min(255, $g))), 2, "0", STR_PAD_LEFT)
                . str_pad(dechex(max(0, min(255, $b))), 2, "0", STR_PAD_LEFT);
    }
}

function divine_get_text_shadow( $total, $color ){
    $ts = 'text-shadow:';
    $first = true;
    for( $i = 0; $i < $total; $i++ ){
        if( !$first ){
            $ts .= ', ';
        }else{
            $first = false;
        }
        $ts .= $i.'px '.$i.'px 0 '.$color;
    }
    return $ts.';';
}