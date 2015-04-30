<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Testimonial_Carousel', 'register_block'));

class DVT_Widget_Testimonial_Carousel extends Kopa_Widget {

	public $kpb_group = 'testimonial';
	
	public static function register_block($blocks){
        $blocks['DVT_Widget_Testimonial_Carousel'] = new DVT_Widget_Testimonial_Carousel();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-testimonial-2-widget';
		$this->widget_description = __( 'Display list of testimonial by carousel effect.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-testimonials-carousel';
		$this->widget_name        = __( 'Testimonials carousel', 'divine-toolkit' );

		$this->settings 		  = array(		
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			), 	
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 4,
				'label' => __( 'Number of testimonial', 'divine-toolkit' )
			),			
		);	

		$cbo_tags_options = array('' => __( '-- All --', 'divine-toolkit' ));
				
		$tags = get_terms('testimonial-tag');			
	
		if($tags && !is_wp_error($tags) ){			
			foreach ($tags as $tag) {						
				$cbo_tags_options[$tag->slug] = "{$tag->name} ({$tag->count})";
			}
		}		
		
		$this->settings['tags'] = array(
			'type'    => 'select',
			'label'   => __( 'Tags', 'divine-toolkit' ),
			'std'     => '',
			'options' => $cbo_tags_options
		);
		
		parent::__construct();
	}

	public function widget( $args, $instance ) {
		ob_start();

		extract( $args );

		$instance = wp_parse_args((array) $instance, dvt_get_widget_default($this->settings));

		extract( $instance );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$query = array(
			'post_type'      => array('testimonial'),
			'posts_per_page' => (int) $instance['posts_per_page'],
			'post_status'    => array('publish')
		);

		if(!empty($tags)){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'testimonial-tag',
					'field'    => 'slug',
					'terms'    => $tags
				),
			);
		}
		
		$result_set = new WP_Query( $query );
		
		echo $before_widget;

		if($title)
			echo $before_title . $title .$after_title;	

		if ($result_set->have_posts()):

			?>
           		<div class="owl-carousel owl-carousel-2">
                    <?php
                    while ($result_set->have_posts()):
                        $result_set->the_post();
                        if (has_post_thumbnail()):
                            $image = divine_post_bfi_thumb(get_the_ID(), 'widget-testimonials-carousel');
                            ?>
                            <div class="item">
		                        <p><?php echo esc_textarea(get_post_meta(get_the_ID(), DTK_PREFIX . 'message', true)); ?></p>
		                        <div class="tes-author">
		                            <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
		                            <span><?php the_title(); ?></span>
		                            <p><?php echo esc_attr(get_post_meta(get_the_ID(), DTK_PREFIX . 'jobs', true)); ?></p>
		                        </div>
		                    </div>
                            <?php
                        endif;
                    endwhile;
                    ?>
                </div>
            <?php

		endif;
		wp_reset_postdata();

		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}