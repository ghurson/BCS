<?php
function dvt_get_widget_default($args){
	$default = array();
	
	if($args){
		foreach ($args  as $key => $value) {
			$default[$key] = $value['std'];
		}
	}

	return $default;
}

function dvt_human_time_diff($from) {
    $periods = array(
        __("second", 'divine-toolkit'),
        __("minute", 'divine-toolkit'),
        __("hour", 'divine-toolkit'),
        __("day", 'divine-toolkit'),
        __("week", 'divine-toolkit'),
        __("month", 'divine-toolkit'),
        __("year", 'divine-toolkit'),
        __("decade", 'divine-toolkit')
    );
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = current_time('timestamp');

    // Determine tense of date
    if ($now > $from) {
        $difference = $now - $from;
        $tense = __("ago", 'divine-toolkit');
    } else {
        $difference = $from - $now;
        $tense = __("from now", 'divine-toolkit');
    }

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        $periods[$j].= __("s", 'divine-toolkit');
    }

    return "$difference $periods[$j] {$tense}";
}

function dvt_get_post_widget_args(){
	
	$all_cats = get_categories();
	$categories = array('' => __('-- none --', 'divine-toolkit'));
	foreach ( $all_cats as $cat ) {
		$categories[ $cat->slug ] = $cat->name;
	}

	$all_tags = get_tags();
	$tags = array('' => __('-- none --', 'divine-toolkit'));
	foreach( $all_tags as $tag ) {
		$tags[ $tag->slug ] = $tag->name;
	}

	return array(
		'title'  => array(
			'type'  => 'text',
			'std'   => '',
			'label' => __( 'Title', 'divine-toolkit' ),
		),
		'categories' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => __( 'Categories', 'divine-toolkit' ),
			'options' => $categories,
			'size'    => '5',
		),
		'relation'    => array(
			'type'    => 'select',
			'label'   => __( 'Relation', 'divine-toolkit' ),
			'std'     => 'OR',
			'options' => array(
				'AND' => __( 'AND', 'divine-toolkit' ),
				'OR'  => __( 'OR', 'divine-toolkit' ),
			),
		),
		'tags' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => __( 'Tags', 'divine-toolkit' ),
			'options' => $tags,
			'size'    => '5',
		),
		'order' => array(
			'type'  => 'select',
			'std'   => 'DESC',
			'label' => __( 'Order', 'divine-toolkit' ),
			'options' => array(
				'ASC'  => __( 'ASC', 'divine-toolkit' ),
				'DESC' => __( 'DESC', 'divine-toolkit' ),
			),
		),
		'orderby' => array(
			'type'  => 'select',
			'std'   => 'date',
			'label' => __( 'Orderby', 'divine-toolkit' ),
			'options' => array(
				'date'          => __( 'Date', 'divine-toolkit' ),
				'rand'          => __( 'Random', 'divine-toolkit' ),
				'comment_count' => __( 'Number of comments', 'divine-toolkit' ),
			),
		),
		'number' => array(
			'type'    => 'number',
			'std'     => '5',
			'label'   => __( 'Number of posts', 'divine-toolkit' ),
			'min'     => '1',
		)
	);
}

function dvt_get_post_widget_query( $instance ){
	$query = array(
		'post_type'      => 'post',
		'posts_per_page' => $instance['number'],
		'order'          => $instance['order'] == 'ASC' ? 'ASC' : 'DESC',
		'orderby'        => $instance['orderby'],
		'ignore_sticky_posts' => true
	);

	if ( $instance['categories'] ) {		
		if($instance['categories'][0] == '')
			unset($instance['categories'][0]);

		if ( $instance['categories'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $instance['categories'],
			);
		}
	}

	if ( $instance['tags'] ) {
		if($instance['tags'][0] == '')
			unset($instance['tags'][0]);

		if ( $instance['tags'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'post_tag',
				'field'    => 'slug',
				'terms'    => $instance['tags'],
			);
		}
	}

	if ( isset( $query['tax_query'] ) && 
		 count( $query['tax_query'] ) === 2 ) {
		$query['tax_query']['relation'] = $instance['relation'];
	}

	return apply_filters( 'dvt_get_post_widget_query', $query );
}