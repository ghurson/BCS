<?php

// sidebar manager
add_filter( 'kopa_sidebar_default', 'divine_set_default_sidebars' );

function divine_set_default_sidebars( $options ) {
	$options['sb_right']    = array('name' => __( 'Right', divine_get_domain()));
	$options['sb_footer_1'] = array('name' => __( 'Footer 1', divine_get_domain()));
	$options['sb_footer_2'] = array('name' => __( 'Footer 2', divine_get_domain()));
	$options['sb_footer_3'] = array('name' => __( 'Footer 3', divine_get_domain()));
	$options['sb_footer_4'] = array('name' => __( 'Footer 4', divine_get_domain()));
	$options['sb_footer_5'] = array('name' => __( 'Footer 5', divine_get_domain()));

	return $options;
}

add_filter( 'kopa_sidebar_default_attributes', 'divine_set_default_sidebar_wrap' );

function divine_set_default_sidebar_wrap($wrap) {
	$wrap['before_widget'] = '<div id="%1$s" class="widget clearfix %2$s">';
	$wrap['after_widget']  = '</div>';
	$wrap['before_title']  = '<h3 class="widget-title">';
	$wrap['after_title']   = '</h3>';

	return $wrap;
}