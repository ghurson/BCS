<?php

add_filter('kopa_admin_meta_box_field_hidden', 'dvt_metabox_field_hidden', 10, 5);

function dvt_metabox_field_hidden($html, $wrap_start, $wrap_end, $value, $option_value){
    ob_start();    
    ?>   
    <input     
    type="hidden"
    name="<?php echo esc_attr($value['id']);?>" 
    id="<?php echo esc_attr($value['id']);?>" 
    value="<?php echo esc_attr($option_value);?>" 
    autocomplete="off">
    <?php    
    $html = ob_get_clean();
    return $html;
}