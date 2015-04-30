<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Tagline_Square', 'register_block'));

class DVT_Widget_Tagline_Square extends Kopa_Widget {

    public $kpb_group = 'mics';
    
    public static function register_block($blocks){
        $blocks['DVT_Widget_Tagline_Square'] = new DVT_Widget_Tagline_Square();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-tagline-2-widget';
		$this->widget_description = __( 'Display a tagline with description and button (ignore caption).', 'divine-toolkit' );
		$this->widget_id          = 'kopa-widget-tagline-arrow';
		$this->widget_name        = __( 'Tagline (square)', 'divine-toolkit' );
		$this->settings 		  = array(           
            'description'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'label' => __('Description', 'divine-toolkit')
            ),
            'button_text'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Button text', 'divine-toolkit')
            ),
			'button_url'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Button URL', 'divine-toolkit')
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

		echo $before_widget;

		if($title)
			echo $before_title . $title .$after_title;	

        ?>  

        <div class="tagline-left">
            <span class="fa-stack fa-lg">
                <i class="fa fa-comment fa-flip-horizontal fa-stack-2x"></i>
                <i class="fa fa-align-left fa-stack-1x"></i>
            </span>
            <p><?php echo esc_textarea($description); ?></p>
        </div>

        <div class="tagline-right">
            <a href="<?php echo esc_url($button_url); ?>" target="_blank" title=""><?php echo esc_attr($button_text); ?></a>
        </div>

        <?php
      
		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}