<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Articles_Masonry', 'register_block'));

class DVT_Widget_Articles_Masonry extends Kopa_Widget {

	public $kpb_group = 'post';
	
	public static function register_block($blocks){
        $blocks['DVT_Widget_Articles_Masonry'] = new DVT_Widget_Articles_Masonry();
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'kopa-blog-masonry-widget';
		$this->widget_description = __( 'Display posts list with masonry effect.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-articles-masonry';
		$this->widget_name        = __( 'Articles Masonry', 'divine-toolkit' );
		$this->settings 		  = dvt_get_post_widget_args();
		
		unset($this->settings['number']);

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
		
		$instance['number'] = 3;
		
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

                    $classes = array('ms-item1');
                    $image_size = 'widget-posts-fullwidth-small';
                    $excerpt_limit = 25;

                    if (0 == $loop_index) {
                        $classes[] = 'last-item';
                        $image_size = 'widget-posts-fullwidth-large';
                        $excerpt_limit = 30;
                    }
					?>
					<li class="<?php echo implode(' ', $classes); ?>">
                        <article class="entry-item">
                            <?php
                            if (has_post_thumbnail()):
                                $image = divine_post_bfi_thumb($post_id, $image_size);
                                ?>
                                <div class="entry-thumb">
                                    <a href="<?php echo $post_url; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $post_title; ?>"></a>
									
									<?php if(0 != $loop_index){
										?>
										<h6 class="entry-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h6>
										<?php
									} ?>
                                </div>
                            <?php endif; ?>
                            <div class="entry-content">
                                <?php if(0 == $loop_index){
										?>
										<h6 class="entry-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h6>
										<?php
									} ?>

                                <?php
                                $excerpt = strip_shortcodes($post->post_content);
                                $excerpt = wp_trim_words($excerpt, $excerpt_limit);
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