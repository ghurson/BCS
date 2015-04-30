<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Testimonial_With_Border', 'register_block'));

class DVT_Widget_Testimonial_With_Border extends Kopa_Widget {

	public $kpb_group = 'testimonial';
	
	public static function register_block($blocks){
        $blocks['DVT_Widget_Testimonial_With_Border'] = new DVT_Widget_Testimonial_With_Border();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-testimonial-widget';
		$this->widget_description = __( 'Display list of testimonial with border for container.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-testimonials-with-border';
		$this->widget_name        = __( 'Testimonials (with border)', 'divine-toolkit' );

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
		if($tags && !is_wp_error($tags)){			
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
           		<div class="owl-carousel kopa-testimonial-carousel">
                    <?php
                    while ($result_set->have_posts()):
                        $result_set->the_post();                                                    
                        ?>
	                    <div class="item">
		                    <p><?php echo esc_textarea(get_post_meta(get_the_ID(), DTK_PREFIX . 'message', true)); ?></p>
		                    <footer>
		                        <a href="<?php echo esc_url(get_post_meta(get_the_ID(), DTK_PREFIX . 'link-to', true)); ?>"><?php the_title(); ?></a>
		                        <p><?php echo esc_attr(get_post_meta(get_the_ID(), DTK_PREFIX . 'jobs', true)); ?></p>
		                    </footer>
		                </div>                       
                        <?php                        
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