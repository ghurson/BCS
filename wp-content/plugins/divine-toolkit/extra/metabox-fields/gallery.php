<?php

add_filter('kopa_admin_meta_box_field_gallery', 'dvt_metabox_field_gallery', 10, 5);

function dvt_metabox_field_gallery($html, $wrap_start, $wrap_end, $value, $option_value){
    ob_start();

    echo $wrap_start;   
    ?>
    <div class="dvt-ui-gallery-wrap">
        <input 
        class="medium-text dvt-ui-gallery" 
        type="text" 
        name="<?php echo esc_attr($value['id']);?>" 
        id="<?php echo esc_attr($value['id']);?>" 
        value="<?php echo esc_attr($option_value);?>"         
        autocomplete="off">

        <a title="" href="#" class="dvt-ui-gallery-button button button-secondary"><?php _e('Config', 'divine-toolkit'); ?></a>  

    </div>
    <?php
    echo $wrap_end;

    $html = ob_get_clean();

    return $html;
}