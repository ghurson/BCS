<?php

if(!class_exists('DVT_Testimonial')){	

	class DVT_Testimonial{

		public function __construct(){				
			add_action('init', array($this, 'init'), 0);			
			add_action('admin_init', array($this, 'register_metabox'));		

			add_filter('manage_testimonial_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_testimonial_posts_custom_column' , array($this, 'manage_colum'));										
		}

		public function require_widgets(){
			require_once DTK_PATH . 'post-types/testimonial/widget/testimonials-carousel.php';
			require_once DTK_PATH . 'post-types/testimonial/widget/testimonials-with-border.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Testimonials', 'post type general name', 'divine-toolkit' ),
				'singular_name'      => _x( 'Testimonial', 'post type singular name', 'divine-toolkit' ),
				'menu_name'          => _x( 'Testimonials', 'admin menu', 'divine-toolkit' ),
				'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'divine-toolkit' ),
				'add_new'            => _x( 'Add New', 'testimonial', 'divine-toolkit' ),
				'add_new_item'       => __( 'Add New Testimonial', 'divine-toolkit' ),
				'new_item'           => __( 'New Testimonial', 'divine-toolkit' ),
				'edit_item'          => __( 'Edit Testimonial', 'divine-toolkit' ),
				'view_item'          => __( 'View Testimonial', 'divine-toolkit' ),
				'all_items'          => __( 'All Testimonials', 'divine-toolkit' ),
				'search_items'       => __( 'Search Testimonials', 'divine-toolkit' ),
				'parent_item_colon'  => __( 'Parent Testimonials:', 'divine-toolkit' ),
				'not_found'          => __( 'No testimonials found.', 'divine-toolkit' ),
				'not_found_in_trash' => __( 'No testimonials found in Trash.', 'divine-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-awards',
				'public'             => true,	      
				'labels'             => $labels,
				'supports'           => array('thumbnail', 'title'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'testimonial' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('testimonial', $args);

		    $labels = array(
				'name'              => _x('Testimonial Tags', 'taxonomy general name', 'divine-toolkit'),
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
				'rewrite'           => array('slug' => 'testimonial-tag'),
			);

			register_taxonomy('testimonial-tag', array('testimonial'), $args);
		}

		public function register_metabox(){
			$args = array(
				'id'          => DTK_PREFIX . 'testimonial-options-metabox',
			    'title'       => __('Options', 'divine-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'testimonial' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(					    	
					array(
						'title'   => __('Jobs', 'divine-toolkit'),
						'type'    => 'text',
						'id'      => DTK_PREFIX . 'jobs'
					),
					array(
						'title'   => __('Link to', 'divine-toolkit'),
						'type'    => 'text',
						'id'      => DTK_PREFIX . 'link-to',						
					),
					array(
						'title' => __('Message', 'divine-toolkit'),
						'type'  => 'textarea',
						'id'    => DTK_PREFIX . 'message',						
					)				
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'                       => __('<input type="checkbox" />', 'divine-toolkit'),	
				'dvt-thumb'				   => __('Avatar', 'divine-toolkit'),			
				'title'                    => __('Title', 'divine-toolkit'),
				'taxonomy-testimonial-tag' => __('Tags', 'divine-toolkit'),	
				'dvt-jobs'                 => __('Jobs', 'divine-toolkit'),
				'dvt-message'              => __('Message', 'divine-toolkit'),
			);

			return $columns;	
		}

		public function manage_colum($column){
			global $post;
			switch ($column) {		
				case 'dvt-thumb':
					if(has_post_thumbnail($post->ID)){
						printf('<img src="%s" width="40px" height="40px">', divine_post_bfi_thumb($post->ID, '', 40, 40, true));
					}					
					break;		
				case 'dvt-jobs':
					if($jobs = get_post_meta($post->ID, DTK_PREFIX . 'jobs', true)){
						echo $jobs;
					}
					break;		
				case 'dvt-message':
					if($message = get_post_meta($post->ID, DTK_PREFIX . 'message', true)){						
						echo wp_trim_words(strip_shortcodes($message), 30, ' ...');
					}
					break;		
			}	
		}
	}

	$dvt_testimonial  = new DVT_Testimonial();	
	$dvt_testimonial->require_widgets();
}