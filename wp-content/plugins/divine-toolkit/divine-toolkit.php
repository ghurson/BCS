<?php
/*
Plugin Name: Divine Toolkit
Plugin URI: http://kopatheme.com/
Description: A specific plugin use in Divine Theme to help you register post types, widgets and shortcodes.
Version: 2.0.7
Author: Kopatheme
Author URI: http://kopatheme.com/plugins/divine-toolkit/
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Divine Toolkit plugin, Copyright 2014 Kopatheme.com
Divine Toolkit is distributed under the terms of the GNU GPL
*/

define('DTK_IS_DEV', false);
define('DTK_PREFIX', 'divine_');
define('DTK_DOMAIN', 'divine-toolkit');
define('DTK_PATH', plugin_dir_path(__FILE__));

add_action('plugins_loaded', 'dvt_plugins_loaded' );
add_action('admin_init', 'dvt_add_shortcode_button');
add_action('admin_enqueue_scripts', 'dvt_admin_enqueue_scripts', 20);
add_action('after_setup_theme', 'dvt_after_setup_theme', 20);

function dvt_plugins_loaded(){
	load_plugin_textdomain( 'divine-toolkit', false, dirname(plugin_basename(__FILE__)) . '/languages/');    	
}

function dvt_after_setup_theme(){
	if (!class_exists('Kopa_Framework'))
		return; 	

  	#ACTION HOOK		
	add_action('wp_enqueue_scripts', 'dvt_enqueue_scripts');

	#FILTER HOOK
	add_filter('kopa_admin_meta_box_wrap_start', 'dvt_meta_box_wrap_start', 10, 3);
	add_filter('kopa_admin_meta_box_wrap_end', 'dvt_meta_box_wrap_end', 10, 3);	

	#UTILITY
	require_once DTK_PATH . 'extra/util.php';

	#EXTRA METABOX-FIELD
	require_once DTK_PATH . 'extra/metabox-fields/icon.php';
	require_once DTK_PATH . 'extra/metabox-fields/hidden.php';	
	require_once DTK_PATH . 'extra/metabox-fields/datetime.php';
	require_once DTK_PATH . 'extra/metabox-fields/gallery.php';		

	#EXTRA WIDGET-FORM-FIELD
	require_once DTK_PATH . 'extra/widget-form-fields/gallery.php';		

	#POST TYPE
  	require_once DTK_PATH . 'post-types/post/post.php';
  	require_once DTK_PATH . 'post-types/portfolio/portfolio.php';
  	require_once DTK_PATH . 'post-types/slide/slide.php';
  	require_once DTK_PATH . 'post-types/service/service.php';
   	require_once DTK_PATH . 'post-types/event/event.php';
  	require_once DTK_PATH . 'post-types/testimonial/testimonial.php';
  	require_once DTK_PATH . 'post-types/staff/staff.php';
  	
  	#WIDGETS	
	require_once DTK_PATH . 'post-types/author/widget/author-information.php';	
	require_once DTK_PATH . 'post-types/social/widget/latest-tweets.php';
	require_once DTK_PATH . 'post-types/social/widget/twitter-with-carousel.php';		
	require_once DTK_PATH . 'post-types/other/widget/tagline-arrow.php';
	require_once DTK_PATH . 'post-types/other/widget/tagline-square.php';
	require_once DTK_PATH . 'post-types/other/widget/images-carousel.php';
	require_once DTK_PATH . 'post-types/other/widget/adsense.php';	
	require_once DTK_PATH . 'post-types/contact/widget/contact-information.php';
	require_once DTK_PATH . 'post-types/contact/widget/contact-form.php';
	require_once DTK_PATH . 'post-types/contact/widget/google-map.php';

	if(!is_admin()){
		require_once DTK_PATH . 'shortcodes/contact.php';
		require_once DTK_PATH . 'shortcodes/accordions.php';		
		require_once DTK_PATH . 'shortcodes/blockquote.php';
		require_once DTK_PATH . 'shortcodes/button.php';
		require_once DTK_PATH . 'shortcodes/dropcaps.php';
		require_once DTK_PATH . 'shortcodes/gallery.php';
		require_once DTK_PATH . 'shortcodes/grid.php';
		require_once DTK_PATH . 'shortcodes/list.php';
		require_once DTK_PATH . 'shortcodes/pricing-table.php';		
		require_once DTK_PATH . 'shortcodes/tabs.php';
		require_once DTK_PATH . 'shortcodes/toggle.php';
		require_once DTK_PATH . 'shortcodes/video.php';
		require_once DTK_PATH . 'shortcodes/vimeo.php';
		require_once DTK_PATH . 'shortcodes/youtube.php';
	}
	require_once DTK_PATH . 'shortcodes/alert.php';
}

function dvt_meta_box_wrap_start($wrap, $value, $loop_index){
	if(0 == $loop_index){
		$wrap = '<div class="dvt-metabox-wrap dvt-metabox-wrap-first dvt-row">';
	}else{
		$wrap = '<div class="dvt-metabox-wrap dvt-row">';	
	}
	
	if ( $value['title'] ) {
		$wrap .= '<div class="dvt-col-3">';
		$wrap .= esc_html($value['title']);
		$wrap .= '</div>';
		$wrap .= '<div class="dvt-col-9">';
	}else{
		$wrap .= '<div class="dvt-col-12">';
	}

	return $wrap;
}

function dvt_meta_box_wrap_end($wrap, $value, $loop_index){
	$wrap = '';

	if ( $value['desc'] ) {
		$wrap .= '<p class="dvt-help">'. $value['desc'] . '</p>';		
	}

	$wrap .= '</div>';
	$wrap .= '</div>';

	return $wrap;
}

function dvt_admin_enqueue_scripts(){
	global $pagenow;
	$affix = DTK_IS_DEV ? '' : '.min';
	
	if(in_array( $pagenow, array('post.php', 'post-new.php', 'widgets.php'))){							
		wp_enqueue_style('jquery-datetimepicker', plugins_url("assets/css/jquery.datetimepicker{$affix}.css", __FILE__), NULL, NULL);
		wp_enqueue_style('kopa_font_awesome');
		wp_enqueue_style(DTK_PREFIX . 'metabox', plugins_url("assets/css/metabox{$affix}.css", __FILE__), NULL, NULL);		
		wp_enqueue_style(DTK_PREFIX . 'widgets', plugins_url("assets/css/widgets{$affix}.css", __FILE__), NULL, NULL);		
		wp_enqueue_style(DTK_PREFIX . 'tinymce', plugins_url("assets/css/tinymce{$affix}.css", __FILE__), NULL, NULL);		

		wp_enqueue_script('jquery-datetimepicker', plugins_url("assets/js/jquery.datetimepicker{$affix}.js", __FILE__), array('jquery'), NULL, TRUE);
		wp_enqueue_script(DTK_PREFIX . 'metabox', plugins_url("assets/js/metabox{$affix}.js", __FILE__), array('jquery'), NULL, TRUE);

	}else if(in_array( $pagenow, array('edit.php'))){
		wp_enqueue_style(DTK_PREFIX . 'manage-colums', plugins_url("assets/css/manage-colums{$affix}.css", __FILE__), NULL, NULL);		
	}

	wp_localize_script('jquery', 'dvt_vars', array(
		'i18n' => array(
			'shortcodes'             => __('Shortcodes', 'divine-toolkit'),
			'list'                   => __('List', 'divine-toolkit'),
			'grid'                   => __('Grid', 'divine-toolkit'),
			'container'              => __('Container', 'divine-toolkit'),
			'horizontal_tabs'        => __('Horizontal Tabs', 'divine-toolkit'),
			'vertical_tabs'          => __('Vertical Tabs', 'divine-toolkit'),
			'accordion'              => __('Accordion', 'divine-toolkit'),
			'toggle'                 => __('Toggle', 'divine-toolkit'),
			'video'                  => __('Video', 'divine-toolkit'),
			'youtube'                => __('Youtube', 'divine-toolkit'),
			'vimeo'                  => __('Vimeo', 'divine-toolkit'),
			'mp4'                    => __('Mp4', 'divine-toolkit'),
			'dropcap'                => __('Dropcap', 'divine-toolkit'),
			'square'                 => __('Square', 'divine-toolkit'),
			'circle'                 => __('Circle', 'divine-toolkit'),
			'solid'                  => __('Solid', 'divine-toolkit'),
			'mp4'                    => __('Square', 'divine-toolkit'),
			'blockquote'             => __('Blockquote', 'divine-toolkit'),
			'blockquote_icon_after'  => __('Icon after', 'divine-toolkit'),
			'blockquote_icon_before' => __('Icon before', 'divine-toolkit'),
			'button'                 => __('Button', 'divine-toolkit'),
			'icons'                  => __('Icons', 'divine-toolkit'),
			'alert'                  => __('Alert box', 'divine-toolkit'),
			'info'                   => __('Info', 'divine-toolkit'),
			'success'                => __('Success', 'divine-toolkit'),
			'warning'                => __('Warning', 'divine-toolkit'),
			'danger'                 => __('Danger', 'divine-toolkit'),
			'contact'                => __('Contact form', 'divine-toolkit'),
			'default'                => __('Default', 'divine-toolkit'),
			'without_border'         => __('Without border', 'divine-toolkit'), 
			'style_1'                => __('Style 1', 'divine-toolkit'),     
			'style_2'                => __('Style 2', 'divine-toolkit'),     
			'style_3'                => __('Style 3', 'divine-toolkit'),    
			'small'                  => __('Small', 'divine-toolkit'),     
			'medium'                 => __('Medium', 'divine-toolkit'),     
			'large'                  => __('Large', 'divine-toolkit'),
			'pricing_table'          => __('Pricing Table', 'divine-toolkit'),
			'special'                => __('Special', 'divine-toolkit'),
        )
	));
}

function dvt_enqueue_scripts(){
	$affix = DTK_IS_DEV ? '' : '.min';
	wp_enqueue_script(DTK_PREFIX . 'event', plugins_url("assets/js/event{$affix}.js", __FILE__), array('jquery'), NULL, TRUE);					
	wp_enqueue_script(DTK_PREFIX . 'tweets', plugins_url("assets/js/tweets{$affix}.js", __FILE__), array('jquery'), NULL, TRUE);					
	wp_localize_script('jquery', 'dvt_tweets', array(
			'ajax' => array(
				'url' => admin_url('admin-ajax.php'),				
				'post_id' => is_page() ? get_queried_object_id() : 0
			)
		)
	);
}

function dvt_add_shortcode_button(){
	if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', 'dvt_add_shortcode_plugin');
        add_filter('mce_buttons', 'dvt_register_shortcode_button');
    }
}

function dvt_add_shortcode_plugin($plugin_array) {
	$affix = DTK_IS_DEV ? '' : '.min';
	
    $plugin_array['dvt_shortcode'] = plugins_url("assets/js/tinymce{$affix}.js", __FILE__);
    return $plugin_array;
}

function dvt_register_shortcode_button($buttons) {
    $buttons[] = 'dvt_shortcode';
    return $buttons;
}

function dvt_get_shortcode($content, $enable_multi = false, $shortcodes = array()) {
    
	$media         = array();
	$regex_matches = '';
	$regex_pattern = get_shortcode_regex();
    
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);

    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $shortcodes)) :
            $media[] = array(
				'shortcode' => $regex_matches_new[0],
				'type'      => $regex_matches_new[2],
				'content'   => $regex_matches_new[5],
				'atts'      => shortcode_parse_atts($regex_matches_new[3])
            );

            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $media;
}