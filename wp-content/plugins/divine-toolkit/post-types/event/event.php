<?php

if(!class_exists('DVT_Event')){

	class DVT_Event{

		public function __construct(){							
			add_action('init', array($this, 'init'), 0);						
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_event_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_event_posts_custom_column' , array($this, 'manage_colum'));

			add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));								
		}

		public function require_widgets(){
			require_once DTK_PATH . 'post-types/event/widget/events.php';
			require_once DTK_PATH . 'post-types/event/widget/events-timeline.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Events', 'post type general name', 'divine-toolkit' ),
				'singular_name'      => _x( 'Event', 'post type singular name', 'divine-toolkit' ),
				'menu_name'          => _x( 'Events', 'admin menu', 'divine-toolkit' ),
				'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'divine-toolkit' ),
				'add_new'            => _x( 'Add New', 'event', 'divine-toolkit' ),
				'add_new_item'       => __( 'Add New Event', 'divine-toolkit' ),
				'new_item'           => __( 'New Event', 'divine-toolkit' ),
				'edit_item'          => __( 'Edit Event', 'divine-toolkit' ),
				'view_item'          => __( 'View Event', 'divine-toolkit' ),
				'all_items'          => __( 'All Events', 'divine-toolkit' ),
				'search_items'       => __( 'Search Events', 'divine-toolkit' ),
				'parent_item_colon'  => __( 'Parent Events:', 'divine-toolkit' ),
				'not_found'          => __( 'No events found.', 'divine-toolkit' ),
				'not_found_in_trash' => __( 'No events found in Trash.', 'divine-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-clock',
				'public'             => true,	      
				'labels'             => $labels,
				'supports'           => array('title', 'editor', 'comments'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'event' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('event', $args);		    

		    $labels = array(
				'name'              => _x('Tags', 'taxonomy general name', 'divine-toolkit'),
				'singular_name'     => _x('Tag', 'taxonomy singular name', 'divine-toolkit'),
				'search_items'      => __('Search Tags', 'divine-toolkit'),
				'all_items'         => __('All Tags', 'divine-toolkit'),
				'parent_item'       => __('Parent Tag', 'divine-toolkit'),
				'parent_item_colon' => __('Parent Tag:', 'divine-toolkit'),
				'edit_item'         => __('Edit Tag', 'divine-toolkit'),
				'update_item'       => __('Update Tag', 'divine-toolkit'),
				'add_new_item'      => __('Add New Tag', 'divine-toolkit'),
				'new_item_name'     => __('New Tag Name', 'divine-toolkit'),
				'menu_name'         => __('Tag', 'divine-toolkit'),
			);

			$args = array(
				'hierarchical'      => false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_in_nav_menus' => false,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array('slug' => 'event-tag'),
			);

			register_taxonomy('event-tag', array('event'), $args);
		}		

		public function admin_enqueue_scripts($hook){
			if(in_array($hook, array('post.php', 'post-new.php'))){
				global $post;				
				if($post->post_type == 'event'){
					wp_enqueue_media();
				}				
			}			
		}	

		public function register_metabox(){
			$args = array(
				'id'          => DTK_PREFIX . 'event-options-metabox',
			    'title'       => __('Options', 'divine-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'event' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(		
			    	array(
						'title'   => __('Location', 'divine-toolkit'),
						'type'    => 'textarea',
						'id'      => DTK_PREFIX . 'location',				
					),    	
			    	array(
						'title'   => __('Start date', 'divine-toolkit'),
						'type'    => 'datetime',
						'id'      => DTK_PREFIX . 'start-date',
						'format'	=> 'd-m-Y',			
						'datepicker' => true,
						'timepicker' => false,
					),					
					array(
						'title'   => __('Start time', 'divine-toolkit'),
						'type'    => 'datetime',
						'id'      => DTK_PREFIX . 'start-time',
						'format'	=> 'H:i',
						'datepicker' => false,
						'timepicker' => true,
					),	
					array(
						'title'   => __('End date', 'divine-toolkit'),
						'type'    => 'datetime',
						'id'      => DTK_PREFIX . 'end-date',
						'format'	=> 'd-m-Y',			
						'datepicker' => true,
						'timepicker' => false,
					),					
					array(
						'title'   => __('End time', 'divine-toolkit'),
						'type'    => 'datetime',
						'id'      => DTK_PREFIX . 'end-time',
						'format'	=> 'H:i',
						'datepicker' => false,
						'timepicker' => true,
					),
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'                 => __('<input type="checkbox" />', 'divine-toolkit'),				
				'title'              => __('Title', 'divine-toolkit'),
				'taxonomy-event-tag' => __('Tags', 'divine-toolkit'),
				'dvt-location'        => __('Location', 'divine-toolkit'),
				'dvt-start'        => __('Start', 'divine-toolkit'),
				'dvt-end'        => __('End', 'divine-toolkit'),				
			);

			return $columns;	
		}

		public function manage_colum($column){
			global $post;
			switch ($column) {				
				case 'dvt-location':
					if($location = get_post_meta($post->ID, DTK_PREFIX . 'location', true)){
						echo $location;
					}
					break;

				case 'dvt-start':
					$start_date = get_post_meta($post->ID, DTK_PREFIX . 'start-date', true);
					$start_time = get_post_meta($post->ID, DTK_PREFIX . 'start-time', true);										
					
					if( !empty($start_date) && !empty($start_time) ){
						printf('<span class="dvt-datetime">%s (<i>%s</i>)</span>', $start_date, $start_time);
					} else if( !empty($start_date) && empty($start_time) ){
						echo $start_date;
					} else if( empty($start_date) && !empty($start_time) ){
						echo $start_time;
					} else{
						echo '00:00';
					}

					break;	

				case 'dvt-end':
					$end_date = get_post_meta($post->ID, DTK_PREFIX . 'end-date', true);
					$end_time = get_post_meta($post->ID, DTK_PREFIX . 'end-time', true);					
					
					if( !empty($end_date) && !empty($end_time) ){
						printf('<span class="dvt-datetime">%s (<i>%s</i>)</span>', $end_date, $end_time);
					} else if( !empty($end_date) && empty($end_time) ){
						echo $end_date;
					} else if( empty($end_date) && !empty($end_time) ){
						echo $end_time;
					}else{
						echo '24:00';
					}

					break;	
			}	
		}

	}

	$dvt_event = new DVT_Event();
	$dvt_event->require_widgets();

}