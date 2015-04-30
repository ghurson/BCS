<?php

if(!class_exists('DVT_Slide')){

	class DVT_Slide{

		public function __construct(){				
			add_action('init', array($this, 'init'), 0);			
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_slide_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_slide_posts_custom_column' , array($this, 'manage_colum'));				
		}

		public function require_widgets(){
			require_once DTK_PATH . 'post-types/slide/widget/slider-with-only-title.php';
			require_once DTK_PATH . 'post-types/slide/widget/slider-with-excerpt.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Slides', 'post type general name', 'divine-toolkit' ),
				'singular_name'      => _x( 'Slide', 'post type singular name', 'divine-toolkit' ),
				'menu_name'          => _x( 'Slides', 'admin menu', 'divine-toolkit' ),
				'name_admin_bar'     => _x( 'Slide', 'add new on admin bar', 'divine-toolkit' ),
				'add_new'            => _x( 'Add New', 'slide', 'divine-toolkit' ),
				'add_new_item'       => __( 'Add New Slide', 'divine-toolkit' ),
				'new_item'           => __( 'New Slide', 'divine-toolkit' ),
				'edit_item'          => __( 'Edit Slide', 'divine-toolkit' ),
				'view_item'          => __( 'View Slide', 'divine-toolkit' ),
				'all_items'          => __( 'All Slides', 'divine-toolkit' ),
				'search_items'       => __( 'Search Slides', 'divine-toolkit' ),
				'parent_item_colon'  => __( 'Parent Slides:', 'divine-toolkit' ),
				'not_found'          => __( 'No slides found.', 'divine-toolkit' ),
				'not_found_in_trash' => __( 'No slides found in Trash.', 'divine-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-slides',
				'public'             => true,	      
				'labels'             => $labels,
				'supports'           => array('title', 'thumbnail'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'slide' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('slide', $args);

		    $labels = array(
				'name'              => _x('Slide Tags', 'taxonomy general name', 'divine-toolkit'),
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
				'rewrite'           => array('slug' => 'slide-tag'),
			);

			register_taxonomy('slide-tag', array('slide'), $args);
		}

		public function register_metabox(){
			$args = array(
				'id'          => DTK_PREFIX . 'slide-options-metabox',
			    'title'       => __('Options', 'divine-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'slide' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(		
			    	array(
						'title'   => __('Excerpt:', 'divine-toolkit'),
						'type'    => 'textarea',
						'id'      => DTK_PREFIX . 'summary',				
					),    	
			    	array(
						'title'   => __('Link to:', 'divine-toolkit'),
						'type'    => 'text',
						'id'      => DTK_PREFIX . 'link-to',						
					)					
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'                 => __('<input type="checkbox" />', 'divine-toolkit'),
				'dvt-thumb'          => __('Slide', 'divine-toolkit'),
				'title'              => __('Title', 'divine-toolkit'),
				'taxonomy-slide-tag' => __('Tags', 'divine-toolkit'),
				'dvt-link-to'        => __('Link to', 'divine-toolkit'),
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
				case 'dvt-link-to':
					if($link_to = get_post_meta($post->ID, DTK_PREFIX . 'link-to', true)){
						printf('<a href="%1$s" target="_blank">%1$s</a>', $link_to);
					}
					break;					
			}
		}

	}

	$dvt_slide = new DVT_Slide();
	$dvt_slide->require_widgets();

}