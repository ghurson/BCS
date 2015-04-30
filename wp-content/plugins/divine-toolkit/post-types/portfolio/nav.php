<?php

add_action('admin_head-nav-menus.php', 'dvt_add_portfolio_archive_nav');

function dvt_add_portfolio_archive_nav() {
    add_meta_box(
        'dvt-metabox-nav-menu-posttype', 
        __('Portfolio Archive', 'divine-toolkit'), 
        'dvt_metabox_portfolio_archive_nav', 
        'nav-menus', 
        'side', 
        'default');
}

function dvt_metabox_portfolio_archive_nav() {
    $post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');
    
    if ($post_types) :
        $items = array();
        $loop_index = 999999;

        foreach ($post_types as $slug => $post_type) {
            if('portfolio' == $slug){
                $item = new stdClass();
                $loop_index++;

                $item->object_id = $loop_index;
                $item->db_id = 0;
                $item->object = 'post_type_' . $post_type->query_var;
                $item->menu_item_parent = 0;
                $item->type = 'custom';
                $item->title = $post_type->labels->name;
                $item->url = get_post_type_archive_link($post_type->query_var);
                $item->target = '';
                $item->attr_title = '';
                $item->classes = array();
                $item->xfn = '';

                $items[] = $item;

                break;
            }            
        }

        $walker = new Walker_Nav_Menu_Checklist(array());

        echo '<div id="dvt-portfolio-archived" class="posttypediv">';
        echo '<div id="tabs-panel-dvt-portfolio-archived" class="tabs-panel tabs-panel-active">';
        echo '<ul id="dvt-portfolio-archived-checklist" class="categorychecklist form-no-clear">';
        echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
        echo '</ul>';
        echo '</div>';
        echo '</div>';

        echo '<p class="button-controls">';
        echo '<span class="add-to-menu">';
        echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'divine-toolkit') . '" name="add-dvt-portfolio-archived-menu-item" id="submit-dvt-portfolio-archived" />';
        echo '<span class="spinner"></span>';
        echo '</span>';
        echo '</p>';

    endif;
}
