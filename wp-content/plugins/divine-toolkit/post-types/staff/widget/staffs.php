<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Staffs', 'register_block'));

class DVT_Widget_Staffs extends Kopa_Widget {

    public $kpb_group = 'staff';

    public static function register_block($blocks){
        $blocks['DVT_Widget_Staffs'] = new DVT_Widget_Staffs();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-team-widget';
		$this->widget_description = __( 'Display list of staff by carousel effect.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-staffs';
		$this->widget_name        = __( 'Staffs (carousel)', 'divine-toolkit' );

		$this->settings 		  = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			),
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 4,
				'label' => __( 'Number of staff', 'divine-toolkit' )
			),			
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
			'post_type' => array('staff'),
            'posts_per_page' => (int) $instance['posts_per_page'],
            'post_status' => array('publish')
		);

		$result_set = new WP_Query( $query );
		
		echo $before_widget;
		
		if($title)
			echo $before_title . $title .$after_title;	

		if ($result_set->have_posts()):
			?>
           	 <div class="row">
                <div class="owl-carousel owl-carousel-4">
                    <?php
                    while ($result_set->have_posts()):
                        $result_set->the_post();
                        
                        $position = get_post_meta(get_the_ID(), DTK_PREFIX . 'position', true);                        
                        $bio      = get_post_meta(get_the_ID(), DTK_PREFIX . 'bio', true);
                        $avatar   = divine_post_bfi_thumb(get_the_ID(), 'widget-staffs');                          
                        ?>
                        <div <?php post_class('item'); ?>>
                            <article class="entry-item">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="entry-thumb">
                                        <a href="#" rel="nofollow"><img src="<?php echo $avatar; ?>" alt="<?php the_title(); ?>"></a>
                                        <div class="thumb-hover">
                                            <ul class="social-links clearfix">
                                                <?php if( $facebook = get_post_meta(get_the_ID(), DTK_PREFIX . 'facebook', true) ): ?>
                                                    <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="nofollow" class="fa fa-facebook"></a></li>
                                                <?php endif; ?>
                                                
                                                <?php if( $twitter = get_post_meta(get_the_ID(), DTK_PREFIX . 'twitter', true) ): ?>
                                                    <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="nofollow" class="fa fa-twitter"></a></li>
                                                <?php endif; ?>
                                                
                                                <?php if( $google_plus = get_post_meta(get_the_ID(), DTK_PREFIX . 'google_plus', true) ): ?>
                                                    <li><a href="<?php echo esc_url( $google_plus ); ?>" target="_blank" rel="nofollow" class="fa fa-google-plus"></a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="entry-content">
                                    <header>
                                        <h4 class="team-name"><?php the_title(); ?></h4>                                                                            
                                        <span class="team-pos"><?php echo $position; ?></span>
                                    </header>
                                    <?php if ($bio): ?>
                                        <p><?php echo $bio; ?></p>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>
                        <?php                    
                    endwhile;
                    ?>
                </div>
            </div>
            <?php
		endif;
		wp_reset_postdata();

		echo $after_widget;

		$content = ob_get_clean();
		echo $content;		
	}

}