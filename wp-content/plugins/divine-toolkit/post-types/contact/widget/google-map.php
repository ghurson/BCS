<?php

add_action( 'widgets_init', array('DVT_Widget_Google_Map', 'register_widget'));

class DVT_Widget_Google_Map extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_widget(){
        register_widget('DVT_Widget_Google_Map');
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-widget-google-map';
		$this->widget_description = __( 'Display your google map.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-widget-google-map';
		$this->widget_name        = __( 'Google Map', 'divine-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			),            
            'latitude'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Latitude', 'divine-toolkit')
            ),
			'longitude'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Longitude', 'divine-toolkit')
            ),		            
            'height'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Height', 'divine-toolkit')
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
        
        if (!empty($latitude) && !empty($longitude)):   
            $style = ($height) ? "height: {$height};" : '';
            ?>            
            <div class="kopa-map-wrapper">
                <div id="kopa-map" 
                    style="<?php echo esc_attr($style); ?>"
                    class="kopa-map"                    
                    data-latitude="<?php echo esc_attr($latitude); ?>" 
                    data-longitude="<?php echo esc_attr($longitude); ?>"></div>
            </div>            
            <?php             
        endif;            
      
		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}