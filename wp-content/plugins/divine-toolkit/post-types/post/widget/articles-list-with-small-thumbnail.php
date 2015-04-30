<?php

add_filter('widgets_init', array('DVT_Widget_Articles_List_With_Small_Thumbnail', 'register_widget'));

class DVT_Widget_Articles_List_With_Small_Thumbnail extends Kopa_Widget {

	public $kpb_group = 'post';

	public static function register_widget($blocks){
		register_widget('DVT_Widget_Articles_List_With_Small_Thumbnail');        
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-article-list-widget article-list-3';
		$this->widget_description = __( 'Display posts list with small thumbnail (align left).', 'divine-toolkit' );
		$this->widget_id          = 'kopa-articles-list-with-small-thumbnail';
		$this->widget_name        = __( 'Articles List (small thumbnail)', 'divine-toolkit' );
		$this->settings 		  = dvt_get_post_widget_args();			
		
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
					?>
					<li>
                        <article class="entry-item clearfix">
                            <?php 
                            if (has_post_thumbnail()): 
                                $image = divine_post_bfi_thumb($post_id, 'widget-small-thumbnail');
                                ?>
                                <div class="entry-thumb">
                                    <a href="<?php echo $post_url; ?>" title="<?php echo $post_title ; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $post_title ; ?>"></a>
                                </div>
                            <?php endif; ?>

                            <div class="entry-content">
                                <h6 class="entry-title">
                                    <a href="<?php echo $post_url; ?>"><?php echo $post_title ; ?></a><span></span>
                                </h6>
                                <span class="entry-date"><i class="fa fa-calendar"></i><span><?php echo get_the_date(); ?></span></span>
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