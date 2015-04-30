<?php

if(!class_exists('DVT_Staff')){

	class DVT_Staff{

		public function __construct(){							
			add_action('init', array($this, 'init'), 0);						
			add_action('admin_init', array($this, 'register_metabox'));			

			add_filter('manage_staff_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_staff_posts_custom_column' , array($this, 'manage_colum'));								
		}

		public function require_widgets(){
			require_once DTK_PATH . 'post-types/staff/widget/staffs.php';
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Staffs', 'post type general name', 'divine-toolkit' ),
				'singular_name'      => _x( 'Staff', 'post type singular name', 'divine-toolkit' ),
				'menu_name'          => _x( 'Staffs', 'admin menu', 'divine-toolkit' ),
				'name_admin_bar'     => _x( 'Staff', 'add new on admin bar', 'divine-toolkit' ),
				'add_new'            => _x( 'Add New', 'staff', 'divine-toolkit' ),
				'add_new_item'       => __( 'Add New Staff', 'divine-toolkit' ),
				'new_item'           => __( 'New Staff', 'divine-toolkit' ),
				'edit_item'          => __( 'Edit Staff', 'divine-toolkit' ),
				'view_item'          => __( 'View Staff', 'divine-toolkit' ),
				'all_items'          => __( 'All Staffs', 'divine-toolkit' ),
				'search_items'       => __( 'Search Staffs', 'divine-toolkit' ),
				'parent_item_colon'  => __( 'Parent Staffs:', 'divine-toolkit' ),
				'not_found'          => __( 'No staffs found.', 'divine-toolkit' ),
				'not_found_in_trash' => __( 'No staffs found in Trash.', 'divine-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-businessman',
				'public'             => true,	      
				'labels'             => $labels,
				'supports'           => array('title', 'thumbnail'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'staff' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('staff', $args);		    		    
		}		

		public function register_metabox(){
			$args = array(
				'id'       => DTK_PREFIX . 'staff-options-metabox',
				'title'    => __('Options', 'divine-toolkit'),
				'desc'     => '',
				'pages'    => array( 'staff' ),
				'context'  => 'normal',
				'priority' => 'low',
				'fields'   => array(		
			    	array(
						'title' => __('Biographical Info', 'divine-toolkit'),
						'type'  => 'textarea',
						'id'    => DTK_PREFIX . 'bio',	
						'rows'  => 10			
					),    	
			    	array(
						'title' => __('Position', 'divine-toolkit'),
						'type'  => 'text',
						'id'    => DTK_PREFIX . 'position',						
					),	
					array(
						'title' => __('Facebook', 'divine-toolkit'),
						'type'  => 'text',
						'id'    => DTK_PREFIX . 'facebook',						
					),
					array(
						'title' => __('Twitter', 'divine-toolkit'),
						'type'  => 'text',
						'id'    => DTK_PREFIX . 'twitter',						
					),
					array(
						'title' => __('Google plus', 'divine-toolkit'),
						'type'  => 'text',
						'id'    => DTK_PREFIX . 'google_plus',						
					),									
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums($columns){			
			$columns = array(
				'cb'           => __('<input type="checkbox" />', 'divine-toolkit'),	
				'dvt-thumb'    => __('Avatar', 'divine-toolkit'),			
				'title'        => __('Title', 'divine-toolkit'),				
				'dvt-bio'      => __('Biographical Info', 'divine-toolkit'),
				'dvt-position' => __('Position', 'divine-toolkit'),
				'dvt-socials'  => __('Social', 'divine-toolkit'),				
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
				case 'dvt-bio':
					if($bio = get_post_meta($post->ID, DTK_PREFIX . 'bio', true)){
						echo wp_trim_words($bio, 20);
					}
					break;
				case 'dvt-position':
					if($position = get_post_meta($post->ID, DTK_PREFIX . 'position', true)){
						echo $position;
					}
					break;	
				case 'dvt-socials':
					if($facebook = get_post_meta($post->ID, DTK_PREFIX . 'facebook', true)){
						echo "<a class='dvt-social-link dvt-sl-facebook' href='{$facebook}' target='_blank'>F</a>";
					}
					if($twitter = get_post_meta($post->ID, DTK_PREFIX . 'twitter', true)){
						echo "<a class='dvt-social-link dvt-sl-twitter' href='{$twitter}' target='_blank'>T</a>";
					}
					if($google_plus = get_post_meta($post->ID, DTK_PREFIX . 'google_plus', true)){
						echo "<a class='dvt-social-link dvt-sl-google_plus' href='{$google_plus}' target='_blank'>G</a>";
					}
					break;	
			}	
		}

	}

	$dvt_staff = new DVT_Staff();
	$dvt_staff->require_widgets();

}