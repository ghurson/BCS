<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Services_Icon_Left', 'register_block'));

class DVT_Widget_Services_Icon_Left extends Kopa_Widget {

	public $kpb_group = 'service';
	
	public static function register_block($blocks){
        $blocks['DVT_Widget_Services_Icon_Left'] = new DVT_Widget_Services_Icon_Left();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-service-widget';
		$this->widget_description = __( 'Display a service (icon float left)', 'divine-toolkit' );
		$this->widget_id          = 'kopa-services-icon-left';
		$this->widget_name        = __( 'Service (icon left)', 'divine-toolkit' );

		$this->settings 		  = array();	

		$services = get_posts(array(
			'posts_per_page'   => -1,
			'post_type'        => 'service',			
		));

		$cbo_options = array();
		if($services){			
			foreach ($services as $service) {						
				$cbo_options[$service->post_name] = $service->post_title;
			}
		}		

		$this->settings['service_name'] = array(
			'type'    => 'select',
			'label'   => __( 'Select a service', 'divine-toolkit' ),
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
		
		echo $before_widget;		

		$result_set = new WP_Query(array(
			'posts_per_page'   => 1,
			'post_type'        => 'service',
			'name' => $service_name
		));		

		if ($result_set->have_posts()):

            while ($result_set->have_posts()):
                $result_set->the_post();
                $icon = get_post_meta(get_the_ID(), DTK_PREFIX . 'icon', true);
                $description = get_post_meta(get_the_ID(), DTK_PREFIX . 'description', true);
                ?>                   
                    <div class="service-item">
                        <header class="clearfix">                                        
                            <h6 class="service-title">
                            	<a class="clearfix" href="<?php echo get_post_meta(get_the_ID(), DTK_PREFIX . 'link-to', true); ?>">
                            		<?php if(!empty($icon)): ?>
                            			<i class="<?php echo $icon; ?> pull-left"></i>
                            		<?php endif; ?>

                            		<?php the_title(); ?>
                            	</a>
                            </h6>
                        </header>
                        <?php if(!empty($description)): ?>
                        	<p><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div>                    
                <?php
            endwhile;

		endif;
		
		wp_reset_postdata();

		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}
