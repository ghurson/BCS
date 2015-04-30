<?php

add_filter( 'kopa_theme_options_settings', 'dvt_portfolio_settings');

function dvt_portfolio_settings($options){	
	$options[] = array(
		'title'   => __( 'Portfolio', 'divine-toolkit' ),
		'type'    => 'title',		
		'id'      => 'portfolio'		
	);			
		$options[] = array(
			'title' => __( 'Breadcrumb', 'divine-toolkit' ),
			'type'  => 'groupstart',
			'id'    => 'portfolio-archive-group',			
		);
			$options[] = array(
				'title'   => __( 'Title', 'divine-toolkit' ),
				'type' 	  => 'text',			
				'id' 	  => 'portfolio-archive-breadcrumb-title',
				'default' => __( 'Portfolio', 'divine-toolkit' ),
			);
			$options[] = array(
				'title'   => __( 'Description', 'divine-toolkit' ),
				'type' 	  => 'textarea',				
				'id' 	  => 'portfolio-archive-breadcrumb-description',
				'default' => '',		
			);
		$options[] = array(
			'type'  => 'groupend',
			'id'    => 'portfolio-archive-group',			
		);
		$options[] = array(
			'title'   => __( 'Project per page', 'divine-toolkit' ),
			'type' 	  => 'text',			
			'id' 	  => 'portfolio-archive-project-per-page',
			'default' => 8,
		);

	$options[] = array(
		'title' => __( 'Single portfolio', divine_get_domain() ),
		'type'  => 'title',
		'id'    => 'single-portfolio',	
		);
		#start group "metadata"
		$options[] = array(
			'title' => __( 'Metadata', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'single-portfolio-metadata-group',			
		);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-portfolio-featured-content',
				'default' => 1,
				'label'   => __( 'Featured content', divine_get_domain() ),
			);			
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-portfolio-tag',
				'default' => 1,
				'label'   => __( 'Tags', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-portfolio-created-date',
				'default' => 1,
				'label'   => __( 'Created date', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-portfolio-comment-counts',
				'default' => 1,
				'label'   => __( 'Number of comments', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-portfolio-share-buttons',
				'default' => 1,
				'label'   => __( 'Share buttons', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-portfolio-author-info',
				'default' => 1,
				'label'   => __( 'Author information', divine_get_domain() ),
			);
		#end group "metadata"
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'single-portfolio-metadata-group',
		);
		#start group "related"
		$options[] = array(
			'title' => __( 'Related portfolios', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'single-portfolio-related-group',			
		);						
			$options[] = array(
				'title'   => __( 'Number of portfolios', divine_get_domain() ),
				'type'    => 'number',				
				'id'      => 'single-portfolio-related-limit',
				'default' => 6,			
			);
		#end group "related"
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'single-portfolio-related-group',
		);


	return $options;
}

add_action('pre_get_posts', 'divine_edit_query_portfolio_archive');

function divine_edit_query_portfolio_archive($query){
    if (!is_admin() && $query->is_main_query()) {
        if(is_post_type_archive('portfolio') || is_tax('portfolio-tag')){
        	if($project_per_page = kopa_get_option('portfolio-archive-project-per-page', 8)){        		
        		$query->query_vars['posts_per_page'] = $project_per_page;
        	}                   
        }
    }
}

add_filter('divine_breadcrumb_site_title', 'dvt_set_portfolio_breadcrumb_title');

function dvt_set_portfolio_breadcrumb_title($title){

	if(is_post_type_archive('portfolio')){				
		if($new_title = kopa_get_option('portfolio-archive-breadcrumb-title')){			
			$title = $new_title;
		}
	}else if(is_tax('portfolio-tag')){
		$tag = get_queried_object();
		if($tag){
			$title = $tag->name;
		}
	}

	return $title;
}

add_filter('divine_breadcrumb_site_desc', 'dvt_set_portfolio_breadcrumb_desc');

function dvt_set_portfolio_breadcrumb_desc($desc){

	if(is_post_type_archive('portfolio')){				
		if($new_desc = kopa_get_option('portfolio-archive-breadcrumb-description')){			
			$desc = $new_desc;
		}
	}else if(is_tax('portfolio-tag')){
		$tag = get_queried_object();
		if($tag){
			$desc = wp_trim_words($tag->description, 10, '..');
		}
	}	

	return $desc;
}

add_filter('kopa_get_breadcrumb', 'dvt_set_portfolio_breadcrumb', 10, 3);

function dvt_set_portfolio_breadcrumb($breadcrumb, $current_class, $prefix){
	if(is_post_type_archive('portfolio') || is_tax('portfolio-tag')){
		$root_label = __('Portfolio', 'divine-toolkit');
		if($new_title = kopa_get_option('portfolio-archive-breadcrumb-title')){			
			$root_label = $new_title;
		}

		if(is_post_type_archive('portfolio')){				
			$breadcrumb .= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%s" href="%s" itemprop="url"><span itemprop="title">%s</span></a></span>', $current_class, get_post_type_archive_link('portfolio'), $root_label);
		}else if(is_tax('portfolio-tag')){
			$breadcrumb .= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%s" href="%s" itemprop="url"><span itemprop="title">%s</span></a></span>', '', get_post_type_archive_link('portfolio'), $root_label);

			$tag = get_queried_object();
			if($tag){
				$breadcrumb .= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%s" href="%s" itemprop="url"><span itemprop="title">%s</span></a></span>', $current_class, get_term_link( $tag, 'portfolio-tag'), $tag->name);				
			}
		}
	}

	return $breadcrumb;
} 