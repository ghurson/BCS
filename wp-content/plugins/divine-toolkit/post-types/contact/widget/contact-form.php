<?php

add_action( 'widgets_init', array('DVT_Widget_Contact_Form', 'register_widget'));

class DVT_Widget_Contact_Form extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_widget(){
        register_widget('DVT_Widget_Contact_Form');
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-contact-widget';
		$this->widget_description = __( 'Display your contact information.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-widget-contact-form';
		$this->widget_name        = __( 'Contact Form', 'divine-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			)                    
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
        <div class="contact-box">            
            <form id="contact-form" 
            class="contact-form clearfix" 
            action="<?php echo admin_url('admin-ajax.php'); ?>" 
            method="post" 
            novalidate="novalidate">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <p class="input-block">
                            <input type="text" value="" id="contact_name" name="contact_name" class="valid" autocomplete="off">
                        </p>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <div class="input-label">
                            <p><?php _e('Name', 'divine-toolkit'); ?> <span>(*)</span></p>
                            <p><?php _e('Your full name please.', 'divine-toolkit'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <p class="input-block">
                            <input type="text" value="" id="contact_email" name="contact_email" class="valid" autocomplete="off">
                        </p>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <div class="input-label">
                            <p><?php _e('Email', 'divine-toolkit'); ?> <span>(*)</span></p>
                            <p><?php _e('Your email address.', 'divine-toolkit'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <p class="input-block">
                            <input type="text" value="" id="contact_url" name="contact_url" class="valid" autocomplete="off">
                        </p>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <div class="input-label">
                            <p><?php _e('URL', 'divine-toolkit'); ?></p>
                            <p><?php _e('Your website url.', 'divine-toolkit'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p class="textarea-label"><?php _e('Your Message', 'divine-toolkit'); ?> <span>(*):</span></p>
                        <p class="textarea-block">  
                            <textarea name="contact_message" id="contact_message" cols="88" rows="10"></textarea>
                        </p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p class="contact-button clearfix">    
                            <input type="hidden" name="action" value="kopa_send_contact">
                            <?php wp_nonce_field('kopa_send_contact', 'ajax_nonce_kopa_send_contact'); ?>
                            <span><input type="submit" value="<?php _e('Send Message', 'divine-toolkit'); ?>" id="submit-contact"></span>
                        </p>
                    </div>
                </div>
                
            </form>

            <div id="contact_response"></div>

        </div>
        <?php   
		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}