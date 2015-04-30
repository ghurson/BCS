<?php
add_action( 'widgets_init', array('Kopa_Widget_Adsense', 'register_widget'));

class Kopa_Widget_Adsense extends Kopa_Widget {

	public $kpb_group = 'mics';
	
	public static function register_widget(){
        register_widget('Kopa_Widget_Adsense');
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-adsense';
		$this->widget_description = __( 'Display your banner adsense with link.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-adsense';
		$this->widget_name        = __( 'Adsense', 'divine-toolkit' );
		
		$this->settings 		  = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			),
			'banner'  => array(
				'type'  => 'upload',
				'std'   => '',
				'label' => __( 'Banner', 'divine-toolkit' )
			),
			'url' => array(
				'type'    => 'text',
				'std'     =>  NULL,
				'label'   => __( 'Link to', 'divine-toolkit' )				
			)			
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {	

		ob_start();

		extract( $args );

		$instance = wp_parse_args((array) $instance, dvt_get_widget_default($this->settings));

		extract( $instance );

		echo $before_widget;

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		if($title)
			echo $before_title . $title .$after_title;		
		
		if($banner){
			printf('<a href="%s" target="_blank"><img src="%s" alt="" class="img-responsive"></a>', esc_url( $url ), esc_url( $banner ));
		}			

		echo $after_widget;

		$content = ob_get_clean();

		echo $content;
	}

}