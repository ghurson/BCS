<?php

if(!class_exists('DVT_Service')){

	class DVT_Service{

		public function __construct(){				
			add_action('init', array($this, 'register_post_type'), 0);			
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_service_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_service_posts_custom_column' , array($this, 'manage_colum'));		

			add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));					
		}

		public function require_widgets(){
			require_once DTK_PATH . 'post-types/service/widget/service-icon-left.php';
			require_once DTK_PATH . 'post-types/service/widget/service-icon-center.php';
		}

		public function register_post_type(){

			$labels = array(
				'name'               => _x( 'Services', 'post type general name', 'divine-toolkit' ),
				'singular_name'      => _x( 'Service', 'post type singular name', 'divine-toolkit' ),
				'menu_name'          => _x( 'Services', 'admin menu', 'divine-toolkit' ),
				'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'divine-toolkit' ),
				'add_new'            => _x( 'Add New', 'service', 'divine-toolkit' ),
				'add_new_item'       => __( 'Add New Service', 'divine-toolkit' ),
				'new_item'           => __( 'New Service', 'divine-toolkit' ),
				'edit_item'          => __( 'Edit Service', 'divine-toolkit' ),
				'view_item'          => __( 'View Service', 'divine-toolkit' ),
				'all_items'          => __( 'All Services', 'divine-toolkit' ),
				'search_items'       => __( 'Search Services', 'divine-toolkit' ),
				'parent_item_colon'  => __( 'Parent Services:', 'divine-toolkit' ),
				'not_found'          => __( 'No services found.', 'divine-toolkit' ),
				'not_found_in_trash' => __( 'No services found in Trash.', 'divine-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-lightbulb',
				'public'             => true,	      
				'labels'             => $labels,
				'supports'           => array('title', 'thumbnail'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'service' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('service', $args);
		}

		public function admin_enqueue_scripts($hook){
			if(in_array($hook, array('post.php', 'post-new.php'))){
				global $post;				
				if($post->post_type == 'service'){
					wp_enqueue_media();
				}				
			}			
		}
		
		public function register_metabox(){
			$args = array(
				'id'          => DTK_PREFIX . 'service-options-metabox',
			    'title'       => __('Options', 'divine-toolkit'),
			    'desc'        => '',
			    'pages'       => array( 'service' ),
			    'context'     => 'normal',
			    'priority'    => 'low',
			    'fields'      => array(		
			    	array(
						'title'   => __('Description', 'divine-toolkit'),
						'type'    => 'textarea',
						'id'      => DTK_PREFIX . 'description',				
					),    	
			    	array(
						'title'   => __('Link to', 'divine-toolkit'),
						'type'    => 'text',
						'id'      => DTK_PREFIX . 'link-to',						
					),
					array(
						'title'   => __('Icon', 'divine-toolkit'),
						'type'    => 'icon',
						'id'      => DTK_PREFIX . 'icon',						
					)					
			    )
			);			
			
			kopa_register_metabox( $args );
		}



		public function manage_colums($columns){				
			$columns = array(
				'cb'                     => __('<input type="checkbox" />', 'divine-toolkit'),				
				'title'                  => __('Title', 'divine-toolkit'),				
				'dvt-icon'               => __('Icon', 'divine-toolkit'),
				'dvt-link-to'               => __('Link to', 'divine-toolkit')				
			);

			return $columns;	
		}

		public function manage_colum($column){
			global $post;
			switch ($column) {			
				case 'dvt-icon':
					if($icon = get_post_meta($post->ID, DTK_PREFIX . 'icon', true)){
						echo sprintf('<a href="http://fortawesome.github.io/Font-Awesome/icon/%1$s" target="_blank">%1$s</a>', str_replace('fa fa-', '', $icon));
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

	$dvt_service = new DVT_Service();
	$dvt_service->require_widgets();

}