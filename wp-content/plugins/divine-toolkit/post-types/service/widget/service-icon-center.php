<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Services_Icon_Center', 'register_block'));

class DVT_Widget_Services_Icon_Center extends Kopa_Widget {
	
	public $kpb_group = 'service';
	
	public static function register_block($blocks){
        $blocks['DVT_Widget_Services_Icon_Center'] = new DVT_Widget_Services_Icon_Center();
        return $blocks;
    }

	public function __construct(){		
		$this->widget_cssclass    = 'kopa-service-2-widget';
		$this->widget_description = __( 'Display a service (icon align center)', 'divine-toolkit' );
		$this->widget_id          = 'kopa-services-icon-center';
		$this->widget_name        = __( 'Service (icon center)', 'divine-toolkit' );

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
                $link_to = esc_url(get_post_meta(get_the_ID(), DTK_PREFIX . 'link-to', true));
                ?>                   
                <div class="entry-item">          
                    <?php if(!empty($icon)): ?>
                    	<a class="sv-icon <?php echo $icon; ?>" href="<?php echo $link_to; ?>"></a>
                    <?php endif; ?>

                    <h5 class="entry-title"><a class="clearfix" href="<?php echo $link_to; ?>"><?php the_title(); ?></a></h5>
                 	
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