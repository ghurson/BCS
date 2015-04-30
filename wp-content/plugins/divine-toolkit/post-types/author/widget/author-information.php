<?php

add_action( 'widgets_init', array('DVT_Widget_Author_Info', 'register_widget'));

class DVT_Widget_Author_Info extends Kopa_Widget {

    public $kpb_group = 'user';

    public static function register_widget(){
        register_widget('DVT_Widget_Author_Info');
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-portfolio-widget kopa-author-info';
		$this->widget_description = __( 'Display a information of an author.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-widget-user-info';
		$this->widget_name        = __( 'Author information', 'divine-toolkit' );
		$this->settings 		  = array(			
            'title'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Title', 'divine-toolkit')
            ),            
            'name'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Name', 'divine-toolkit')
            ),
            'bio'  => array(
                'type'  => 'textarea',
                'std'   => '',
                'label' => __('Biographical Info', 'divine-toolkit')
            ),
			'jobs'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Jobs', 'divine-toolkit')
            ),
            'facebook'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Facebook URL', 'divine-toolkit')
            ),
            'twitter'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Twitter URL', 'divine-toolkit')
            ),
            'google_plus'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Google plus URL', 'divine-toolkit')
            ),
            'pinterest'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Pinterest URL', 'divine-toolkit')
            ),
            'dribbble'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __('Dribbble URL', 'divine-toolkit')
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
        <div class="author-info">
            <?php if($name || $jobs): ?>
                <header>
                    <?php if($name): ?>
                        <strong><?php echo $name; ?></strong> 
                    <?php endif;?>

                    <?php if($jobs): ?>
                        &nbsp;-&nbsp;<em><?php echo $jobs; ?></em>
                    <?php endif;?>
                </header>
            <?php endif;?>

            <?php 
            if($bio)
                echo "<p>{$bio}</p>";        
            ?>                             

            <?php
            $socials = array('facebook', 'twitter', 'dribbble', 'pinterest', 'google_plus');
            $social_links = array();
            foreach ($socials as $social) {                
                if ($tmp = $instance[$social]){
                    $social_links[$social] = $tmp;                
                }
            }

            if (!empty($social_links)):
                ?>
                <ul class="social-links pull-left clearfix">
                    <?php
                    foreach ($social_links as $type => $url):
                        $type = str_replace('_', '-', $type);
                        ?>
                        <li><a href="<?php echo $url; ?>" 
                            title="<?php printf(__('Follow author %s on %s', 'divine-toolkit'), $name, $type); ?>" 
                            class="fa <?php echo "fa-{$type}"; ?>" 
                            target="_blank"
                            rel="nofollow"></a></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            <?php endif; ?>   
        </div>
        <?php
      
		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}