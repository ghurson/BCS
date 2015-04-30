<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Images_Carousel', 'register_block'));

class DVT_Widget_Images_Carousel extends Kopa_Widget {

    public $kpb_group = 'mics';

    public static function register_block($blocks){
        $blocks['DVT_Widget_Images_Carousel'] = new DVT_Widget_Images_Carousel();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-mission-carousel-widget';
		$this->widget_description = __( 'Display images list with carousel effect.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-widget-images-carousel';
		$this->widget_name        = __( 'Images (carousel)', 'divine-toolkit' );
		$this->settings 		  = array(			
            'caption'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Title', 'divine-toolkit')
            ),
            'images'  => array(
                'type'  => 'gallery',
                'std'   => '',
                'label' => __('Images', 'divine-toolkit')
            ),
            'with'  => array(
                'type'  => 'number',
                'std'   => 565,
                'label' => __('Width', 'divine-toolkit')
            ),
            'height'  => array(
                'type'  => 'number',
                'std'   => 340,
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

        if($images):
            if( $ids = explode(',', $images)):
                ?>
                <div class="owl-carousel owl-carousel-3">
                    <?php
                        foreach ($ids as $id):
                            $image_obj = wp_get_attachment_image_src($id, 'full');                        
                            $thumb = divine_bfi_thumb($image_obj[0], '', $with, $height);
                            ?>
                            <div class="item">
                                <img src="<?php echo $thumb; ?>" alt="<?php echo get_post_field('post_excerpt', $id); ?>">                                                               
                            </div>
                            <?php
                        endforeach;
                    ?>
                </div>
                <?php
            endif;
        endif;
      
		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}