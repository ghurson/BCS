<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Slider_With_Only_Title', 'register_block'));

class DVT_Widget_Slider_With_Only_Title extends Kopa_Widget {

	public $kpb_group = 'slider';
	
	public static function register_block($blocks){
        $blocks['DVT_Widget_Slider_With_Only_Title'] = new DVT_Widget_Slider_With_Only_Title();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'home-slider-widget';
		$this->widget_description = __( 'Display simple slider with a title per slide.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-slider';
		$this->widget_name        = __( 'Slider (with only title)', 'divine-toolkit' );

		$this->settings 		  = array(			
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 4,
				'label' => __( 'Number of slide', 'divine-toolkit' )
			),			
		);	

		$cbo_tags_options = array('' => __( '-- All --', 'divine-toolkit' ));
		
		$tags = get_terms('slide-tag');				
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

		$query = array(
			'post_type'      => array('slide'),
			'posts_per_page' => (int) $instance['posts_per_page'],
			'post_status'    => array('publish')
		);

		if(!empty($tags)){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'slide-tag',
					'field'    => 'slug',
					'terms'    => $tags
				),
			);
		}

		$result_set = new WP_Query( $query );
		
		echo $before_widget;

		if ($result_set->have_posts()):

			?>
            <div class="flexslider kopa-home-slider">
                <ul class="slides">
                    <?php
                    while ($result_set->have_posts()):
                        $result_set->the_post();
                        if (has_post_thumbnail()):
                            $image = divine_post_bfi_thumb(get_the_ID(), 'widget-slider');
                            ?>
                            <li>
                                <article class="entry-item">
                                    <div class="entry-thumb">
                                        <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
                                    </div>
                                    <div class="slider-caption">
                                        <h2><a href="<?php echo esc_url( get_post_meta(get_the_ID(), DTK_PREFIX . 'link-to', true) ); ?>"><?php the_title(); ?></a></h2>
                                    </div>
                                </article>
                            </li>
                            <?php
                        endif;
                    endwhile;
                    ?>
                </ul>
                <div class="slides-info">
                    <span class="current-slide"></span>
                    <span>&nbsp;<?php _e('of', 'divine-toolkit'); ?>&nbsp;</span>
                    <span class="total-slides"></span>                                
                </div>
            </div>
            <div class="loading"></div>
            <?php

		endif;
		
		wp_reset_postdata();

		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}