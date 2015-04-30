<?php
add_filter('kpb_get_widgets_list', array('DVT_Widget_Featured_Video', 'register_block'));

class DVT_Widget_Featured_Video extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_block($blocks){
        $blocks['DVT_Widget_Featured_Video'] = new DVT_Widget_Featured_Video();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-article-list-widget article-list-2';
		$this->widget_description = __( 'Display a video with thumbnail & summary', 'divine-toolkit' );
		$this->widget_id          = 'kopa-featured-video';
		$this->widget_name        = __( 'Featured Video', 'divine-toolkit' );

		$this->settings 		  = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			),
			'excerpt_word_limit'  => array(
				'type'  => 'text',
				'std'   => 50,
				'label' => __( 'Excerpt word limit', 'divine-toolkit' )
			)		
		);	

		$posts = get_posts(array(
			'posts_per_page'   => -1,
			'post_type'        => 'post',	
			'tax_query' => array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => 'post-format-video'
                )
            )		
		));

		$cbo_options = array();
		if($posts){			
			foreach ($posts as $post) {						
				$cbo_options[$post->post_name] = $post->post_title;
			}
		}		

		$this->settings['post_name'] = array(
			'type'    => 'select',
			'label'   => __( 'Select a post', 'divine-toolkit' ),
			'std'     => '',
			'options' => $cbo_options
		);
		
		wp_reset_query();

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		ob_start();

		extract( $args );
		
		$instance = wp_parse_args((array) $instance, dvt_get_widget_default($this->settings));

		extract( $instance );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);		
		
		echo $before_widget;
		
		if($title)
			echo $before_title . $title .$after_title;	
	
		$result_set = new WP_Query(array(
			'posts_per_page' => 1,
			'post_type'      => 'post',
			'name'           => $post_name
		));		

		if ($result_set->have_posts()):
			
            while ($result_set->have_posts()):
                $result_set->the_post();
                $post_id = get_the_id();  
                $post_title = get_the_title();
                $post_url = get_permalink();

                ?>                   
                <article class="entry-item video-post clearfix">
	                <?php 
	                if (has_post_thumbnail($post_id)): 
	                	$image = divine_post_bfi_thumb(get_the_ID(), 'widget-featured-video');
	                	?>
	                    <div class="entry-thumb">
	                        <a href="<?php echo $post_url; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $post_title; ?>"></a>
	                        <div class="thumb-hover">
	                            <a class="thumb-icon" href="<?php echo $post_url; ?>"></a>
	                        </div>
	                    </div> 
	                <?php endif; ?>

	                <h6 class="entry-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h6>
	                <span class="entry-date"><i class="fa fa-calendar"></i><span><?php echo get_the_date(); ?></span></span>
	                <div class="entry-content">
	                    <?php
	                    $content = strip_shortcodes(get_post_field('post_content', $post_id));
	                    $excerpt = wp_trim_words($content, $excerpt_word_limit, '');
	                    printf('<p>%s</p>', $excerpt);
	                    ?>                        
	                </div>
	            </article>                   
                <?php
            endwhile;

		endif;

		wp_reset_postdata();

		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}
