<?php

if(!class_exists('DVT_Portfolio')){

	class DVT_Portfolio{

		public function __construct(){				
			add_action('init', array($this, 'init'), 0);			
			add_filter('manage_portfolio_posts_columns', array($this, 'manage_colums'));			
			add_action('manage_portfolio_posts_custom_column' , array($this, 'manage_colum'));	
		}

		public function require_widgets(){
			require_once DTK_PATH . 'post-types/portfolio/widget/portfolios-filter-bar.php';
			require_once DTK_PATH . 'post-types/portfolio/widget/portfolios-of-an-author.php';
		}

		public function add_nav(){
			require_once DTK_PATH . 'post-types/portfolio/nav.php';
		}

		public function register_layout(){
			require_once DTK_PATH . 'post-types/portfolio/layout.php';	
		}

		public function config(){			
			require_once DTK_PATH . 'post-types/portfolio/config.php';	
		}

		public function init(){

			$labels = array(
				'name'               => _x( 'Portfolios', 'post type general name', 'divine-toolkit' ),
				'singular_name'      => _x( 'Portfolio', 'post type singular name', 'divine-toolkit' ),
				'menu_name'          => _x( 'Portfolios', 'admin menu', 'divine-toolkit' ),
				'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'divine-toolkit' ),
				'add_new'            => _x( 'Add New', 'portfolio', 'divine-toolkit' ),
				'add_new_item'       => __( 'Add New Portfolio', 'divine-toolkit' ),
				'new_item'           => __( 'New Portfolio', 'divine-toolkit' ),
				'edit_item'          => __( 'Edit Portfolio', 'divine-toolkit' ),
				'view_item'          => __( 'View Portfolio', 'divine-toolkit' ),
				'all_items'          => __( 'All Portfolios', 'divine-toolkit' ),
				'search_items'       => __( 'Search Portfolios', 'divine-toolkit' ),
				'parent_item_colon'  => __( 'Parent Portfolios:', 'divine-toolkit' ),
				'not_found'          => __( 'No portfolios found.', 'divine-toolkit' ),
				'not_found_in_trash' => __( 'No portfolios found in Trash.', 'divine-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-portfolio',
				'public'             => true,	      
				'labels'             => $labels,
				'supports'           => array('title', 'thumbnail', 'editor', 'comments', 'author'),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'portfolio' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type('portfolio', $args);

		    $labels = array(
				'name'              => _x('Portfolio Tags', 'taxonomy general name', 'divine-toolkit'),
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
				'rewrite'           => array('slug' => 'portfolio-tag'),
			);

			register_taxonomy('portfolio-tag', array('portfolio'), $args);
		}

		public function manage_colums($columns){	
			$columns = array(
				'cb'                     => __('<input type="checkbox" />', 'divine-toolkit'),
				'dvt-thumb'              => __('Thumb', 'divine-toolkit'),
				'title'                  => __('Title', 'divine-toolkit'),
				'taxonomy-portfolio-tag' => __('Tags', 'divine-toolkit'),				
				'date'                   => __('Date', 'divine-toolkit'),
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
			}
		}

	}

	$dvt_portfolio = new DVT_Portfolio();
	$dvt_portfolio->require_widgets();
	$dvt_portfolio->add_nav();
	$dvt_portfolio->register_layout();
	$dvt_portfolio->config();
}