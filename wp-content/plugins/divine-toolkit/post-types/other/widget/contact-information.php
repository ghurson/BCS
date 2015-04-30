<?php

add_action( 'widgets_init', array('DVT_Widget_Contact_Information', 'register_widget'));

class DVT_Widget_Contact_Information extends Kopa_Widget {

    public $kpb_group = 'mics';

    public static function register_widget(){
        register_widget('DVT_Widget_Contact_Information');
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-contact-widget';
		$this->widget_description = __( 'Display your contact information.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-widget-contact-information';
		$this->widget_name        = __( 'Contact Information', 'divine-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			),
            'intro'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'label' => __('Introduction', 'divine-toolkit')
            ),
            'address'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Address', 'divine-toolkit')
            ),
            'phone'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Phone', 'divine-toolkit')
            ),
			'email'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Email', 'divine-toolkit')
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
        <address>
            <?php if($intro): ?>
            <p><?php echo $intro; ?></p>
            <?php endif;?>

            <?php if($address):?>
            <p><i class="fa fa-map-marker"></i><span class="media-body"><?php echo $address; ?></span></p>
            <?php endif;?>

            <?php if($phone): ?>
            <p><i class="fa fa-phone"></i><?php echo $phone;?></p>
            <?php endif;?>

            <?php if($email): ?>
                <p><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></p>
            <?php endif;?>
        </address>
        <?php
      
		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}