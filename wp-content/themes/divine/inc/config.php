<?php 

add_action('after_setup_theme', 'divine_setup');

function divine_setup(){
    add_theme_support('post-formats', array('gallery', 'audio', 'video'));
    add_theme_support('post-thumbnails');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');        

    register_nav_menus(array(
        'main-nav'   => __('Main Menu', kopa_get_domain()),       
        'footer-nav' => __('Footer Menu', kopa_get_domain()),         
    ));

    if(is_admin()){
        add_filter('user_contactmethods', 'divine_add_user_socials');
        add_action('admin_init', 'register_metabox_custom_breadcrumb'); 
        add_action('admin_init', 'register_metabox_post_featured_content');         
    }else{
        add_action('wp_enqueue_scripts', 'divine_enqueue_script');
        add_filter('body_class', 'divine_set_body_class');
        add_filter('wp_title', 'divine_get_site_title', 10, 2);        
        add_filter('widget_text', 'do_shortcode'); 
    }

    if ( ! isset( $content_width ) ){ $content_width = 770; }
}

function divine_get_domain(){
    return KOPA_DOMAIN;
}

function divine_get_social_networks(){
	$options = array();

	$options[] = array(
			'title' =>  __( 'Facebook', kopa_get_domain() ),
			'id'    => 'facebook-url',
			'type'  => 'url',
			'icon'	=> 'fa fa-facebook',
		);	

	$options[] = array(
		'title' =>  __( 'Twitter', kopa_get_domain() ),
		'id'    => 'twitter-url',
		'type'  => 'url',
		'icon'	=> 'fa fa-twitter',
	);	

	$options[] = array(
		'title' =>  __( 'Goggle Plus', kopa_get_domain() ),
		'id'    => 'google-plus-url',
		'type'  => 'url',
		'icon'	=> 'fa fa-google-plus',
	);	

	$options[] = array(
		'title' =>  __( 'Pinterest', kopa_get_domain() ),
		'id'    => 'pinterest-url',
		'type'  => 'url',
		'icon'	=> 'fa fa-pinterest',
	);	

	$options[] = array(
		'title' =>  __( 'Instagram', kopa_get_domain() ),
		'id'    => 'instagram-url',
		'type'  => 'url',
		'icon'	=> 'fa fa-instagram',
	);	

	$options[] = array(
		'title' =>  __( 'Tumblr', kopa_get_domain() ),
		'id'    => 'tumblr-url',
		'type'  => 'url',
		'icon'	=> 'fa fa-tumblr',
	);		

	$options[] = array(
		'title' =>  __( 'Rss', kopa_get_domain() ),
		'desc' 	  => __( 'enter HIDE if you want to disable this option', kopa_get_domain() ),
		'id'    => 'rss-url',
		'type'  => 'text',
		'icon'	=> 'fa fa-rss',
	);	

	return apply_filters('divine_get_social_networks', $options );
}

function divine_get_site_elements(){
    return apply_filters( 'divine_get_site_elements', array(
        'body' => array(
            'title' => __('Body', kopa_get_domain()),
            'element' => 'html, body, .kopa-testimonial-2-widget .item > p, #kopa-page-footer, .hotline-box > h6',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'main-menu' => array(
            'title' => __('Main menu', kopa_get_domain()),
            'element' => '#main-menu li a',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'footer-menu' => array(
            'title' => __('Footer menu', kopa_get_domain()),
            'element' => '#footer-menu li a',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'widget-title-main' => array(
            'title' => __('Widget title - main', kopa_get_domain()),
            'element' => '#main-content .widget-title',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),        
        'widget-title-footer' => array(
            'title' => __('Widget title - footer', kopa_get_domain()),
            'element' => '.bottom-sidebar h3.widget-title',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'post-title' => array(
            'title' => __('Post title', kopa_get_domain()),
            'element' => '.kopa-entry-post h4.entry-title',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'post-content' => array(
            'title' => __('Post content', kopa_get_domain()),
            'element' => '.kopa-entry-post .entry-content, #main-content .kopa-main-col > .entry-content',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'h1' => array(
            'title' => __('H1', kopa_get_domain()),
            'element' => '.kopa-entry-post .entry-content h1, #main-content .kopa-main-col > .entry-content h1',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'h2' => array(
            'title' => __('H2', kopa_get_domain()),
            'element' => '.kopa-entry-post .entry-content h2, #main-content .kopa-main-col > .entry-content h2',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'h3' => array(
            'title' => __('H3', kopa_get_domain()),
            'element' => '.kopa-entry-post .entry-content h3, #main-content .kopa-main-col > .entry-content h3',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'h4' => array(
            'title' => __('H4', kopa_get_domain()),
            'element' => '.kopa-entry-post .entry-content h4, #main-content .kopa-main-col > .entry-content h4',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'h5' => array(
            'title' => __('H5', kopa_get_domain()),
            'element' => '.kopa-entry-post .entry-content h5, #main-content .kopa-main-col > .entry-content h5',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        ),
        'h6' => array(
            'title' => __('H6', kopa_get_domain()),
            'element' => '.kopa-entry-post .entry-content h6, #main-content .kopa-main-col > .entry-content h6',
            'default' => array(
                'family' => '',
                'style'  => '',
                'size'   => '',
                'color'  => ''
            )
        )
    ) );
}

function divine_get_image_sizes(){
    $sizes = array();      

    $sizes['widget-slider'] = array(
        'name' => __('1150 x 510 (pixel)', divine_get_domain()),
        'width' => 1150,
        'height' => 510,
        'crop' => true,
        'desc' => __('Widget - Slider', divine_get_domain()),
        'type' => array('slide')
    );

    $sizes['widget-slider-without-title'] = array(
        'name' => __('565 x 340 (pixel)', divine_get_domain()),
        'width' => 565,
        'height' => 340,
        'crop' => true,
        'desc' => __('Widget - Slider without title', divine_get_domain()),
        'type' => array('slide')
    );

    $sizes['widget-featured-video'] = array(
        'name' => __('371 x 200 (pixel)', divine_get_domain()),
        'width' => 371,
        'height' => 200,
        'crop' => true,
        'desc' => __('Widget - Featured video', divine_get_domain()),
        'type' => array('post')
    );

    $sizes['widget-posts-fullwidth-large'] = array(
        'name' => __('620 x 376 (pixel)', divine_get_domain()),
        'width' => 620,
        'height' => 376,
        'crop' => true,
        'desc' => __('Widget - Articles masonry (large)', divine_get_domain()),
        'type' => array('post')
    );

    $sizes['widget-posts-fullwidth-small'] = array(
        'name' => __('274 x 184 (pixel)', divine_get_domain()),
        'width' => 274,
        'height' => 184,
        'crop' => true,
        'desc' => __('Widget - Articles masonry (small)', divine_get_domain()),
        'type' => array('post')
    );        
    
    $sizes['widget-testimonials-carousel'] = array(
        'name' => __('80 x 80 (pixel)', divine_get_domain()),
        'width' => 80,
        'height' => 80,
        'crop' => true,
        'desc' => __('Widget - Testimonials carousel', divine_get_domain()),
        'type' => array('testimonial')
    );

    $sizes['widget-articles-list-with-thumbnail-left'] = array(
        'name' => __('272 x 266 (pixel)', divine_get_domain()),
        'width' => 272,
        'height' => 266,
        'crop' => true,
        'desc' => __('Widget - Articles list with thumbnail left', divine_get_domain()),
        'type' => array('post')
    );

    $sizes['portfolio-archive'] = array(
        'name' => __('272 x 200 (pixel)', divine_get_domain()),
        'width' => 272,
        'height' => 200,
        'crop' => true,
        'desc' => __('Portfolios archive', divine_get_domain()),
        'type' => array('portfolio')
    );

    $sizes['widget-portfolios-of-an-author'] = array(
        'name' => __('272 x 200 (pixel)', divine_get_domain()),
        'width' => 272,
        'height' => 200,
        'crop' => true,
        'desc' => __('Widget - Portfolios of an author', divine_get_domain()),
        'type' => array('portfolio')
    );

    $sizes['widget-portfolios-of-an-author-lightbox'] = array(
        'name' => __('800 x auto (pixel)', divine_get_domain()),
        'width' => 800,
        'height' => NULL,
        'crop' => true,
        'desc' => __('Widget - Portfolios filter bar', divine_get_domain()),
        'type' => array('portfolio')
    );

    $sizes['widget-portfolios-filter-bar'] = array(
        'name' => __('341 x 242 (pixel)', divine_get_domain()),
        'width' => 341,
        'height' => 242,
        'crop' => true,
        'desc' => __('Widget - Portfolios filter bar', divine_get_domain()),
        'type' => array('portfolio')
    );

    $sizes['blog-thumnail'] = array(
        'name' => __('858 x 415 (pixel)', divine_get_domain()),
        'width' => 858,
        'height' => 415,
        'crop' => true,
        'desc' => __('Blog thumbnail', divine_get_domain()),
        'type' => array('post')
    );

    $sizes['post-lightbox'] = array(
       'name' => __('800 x auto (pixel)', divine_get_domain()),
        'width' => 800,
        'height' => NULL,
        'crop' => true,
        'desc' => __('Post - lightbox', divine_get_domain()),
        'type' => array('post')
    );

    $sizes['post-related'] = array(
       'name' => __('272 x 200 (pixel)', divine_get_domain()),
        'width' => 272,
        'height' => 200,
        'crop' => true,
        'desc' => __('Post - related', divine_get_domain()),
        'type' => array('post')
    );

    $sizes['widget-small-thumbnail'] = array(
        'name' => __('76 x 76 (pixel)', divine_get_domain()),
        'width' => 76,
        'height' => 76,
        'crop' => true,
        'desc' => __('Widget - small thumbnail', divine_get_domain()),
        'type' => array('post')
    );

    $sizes['widget-staffs'] = array(
        'name' => __('272 x 272 (pixel)', divine_get_domain()),
        'width' => 272,
        'height' => 272,
        'crop' => true,
        'desc' => __('Widget - staffs', divine_get_domain()),
        'type' => array('staff')
    );    
        
    return apply_filters('divine_get_image_sizes', $sizes);
}
