<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Articles_List_With_Thumbnail_Left', 'register_block'));

class DVT_Widget_Articles_List_With_Thumbnail_Left extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_block($blocks){
        $blocks['DVT_Widget_Articles_List_With_Thumbnail_Left'] = new DVT_Widget_Articles_List_With_Thumbnail_Left();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-article-list-widget article-list-0';
		$this->widget_description = __( 'Display posts list with masonry effect.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-articles-list-with-thumbnail-left';
		$this->widget_name        = __( 'Articles List (thumbnail left)', 'divine-toolkit' );
		$this->settings 		  = dvt_get_post_widget_args();			

		$this->settings['excerpt_word_limit'] = array(			
			'type'  => 'number',
			'std'   => 25,
			'label' => __( 'Excerpt word limit', 'divine-toolkit' ),			
		);
		
		parent::__construct();
	}

	public function widget( $args, $instance ) {	
		ob_start();

		extract( $args );
		
		$instance = wp_parse_args((array) $instance, dvt_get_widget_default($this->settings));
		
		extract( $instance );
		
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);		
			
		if($title)
			echo $before_title . $title .$after_title;	
		
		$instance['posts_per_page'] = 3;
		
		$query = dvt_get_post_widget_query($instance);
		
		$result_set = new WP_Query( $query );
		
		echo $before_widget;
		
		if ( $result_set->have_posts() ) :			
			?>
			<ul class="clearfix">
				<?php
				global $post;
                $loop_index = 0;

				while ( $result_set->have_posts() ):
					$result_set->the_post();

					$post_id = get_the_ID();
                    $post_title = get_the_title();
                    $post_url = get_permalink();

                    $classes = array('col-md-6', 'col-sm-6', 'col-xs-6');                       
					?>
					<li <?php post_class($classes); ?>>
                        <article class="entry-item clearfix">

                            <?php if (has_post_thumbnail()): ?>
                                <?php $image = divine_post_bfi_thumb($post_id, 'widget-articles-list-with-thumbnail-left'); ?>
                                <div class="entry-thumb">
                                    <a href="<?php echo $post_url; ?>" tile="<?php echo $post_title; ?>"><img  alt="" src="<?php echo esc_url($image); ?>"></a>
                                </div>
                            <?php endif; ?>

                            <div class="entry-content">
                                <header>
                                    <span class="entry-date"><i class="fa fa-calendar"></i><span><?php echo get_the_date(); ?></span></span>
                                </header>
                                <h6 class="entry-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a><span></span></h6>

                                <?php                                                                    
                                $excerpt = wp_trim_words(strip_shortcodes($post->post_content), (int)$excerpt_word_limit);
                                echo ($excerpt) ? sprintf('<p>%s</p>', $excerpt) : '';                                    
                                ?>
                            </div>

                        </article>                        
                    </li>
					<?php
					$loop_index++;
				endwhile;
				?>
			</ul>
			<?php
		endif;

		wp_reset_postdata();

		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}