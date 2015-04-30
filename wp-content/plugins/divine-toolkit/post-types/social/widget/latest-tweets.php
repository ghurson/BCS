<?php

add_action( 'widgets_init', array('DVT_Widget_Latest_Tweets', 'register_widget'));

class DVT_Widget_Latest_Tweets extends Kopa_Widget {

    public $kpb_group = 'social';

    public static function register_widget(){
        register_widget('DVT_Widget_Latest_Tweets');
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-twitter-widget kopa-twitter-widget-single';
		$this->widget_description = __( 'Display list tweets from twitter.com', 'divine-toolkit' );
		$this->widget_id          = 'kopa-widget-latest-tweets';
		$this->widget_name        = __( 'Latest Tweets', 'divine-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			),
            'screen_name'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Username', 'divine-toolkit' )
            ),
			'count'  => array(
				'type'  => 'text',
				'std'   => 3,
				'label' => __( 'Number of tweet', 'divine-toolkit' )
			),		
            'consumer_key'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Consumer key', 'divine-toolkit' )
            ),
            'consumer_secret'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Consumer secret', 'divine-toolkit' )
            ),
            'oauth_access_token'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Oauth access token', 'divine-toolkit' )
            ),
            'oauth_access_token_secret'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => __( 'Oauth access token secret', 'divine-toolkit' )
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

        if ($screen_name && $count && $consumer_key && 
            $consumer_secret && $oauth_access_token && $oauth_access_token_secret) {
            ?>
            <input type="hidden" class="tweets-data" name="security" value="<?php echo wp_create_nonce('dvt_load_tweets'); ?>" autocomplete="off">
            <span class="dvt-tweets-loading"><?php _e('Loading...', 'divine-toolkit'); ?></span>
            <?php            
        }

		echo $after_widget;

		$content = ob_get_clean();

		echo $content;		
	}

}

if (!function_exists('dvt_load_tweets')) {
    add_action('wp_ajax_dvt_load_tweets', 'dvt_load_tweets');
    add_action('wp_ajax_nopriv_dvt_load_tweets', 'dvt_load_tweets');

    function dvt_load_tweets() {
        check_ajax_referer('dvt_load_tweets', 'security');

        $data      = $_POST;        
        $widget_id = $data['widget_id'];        
        $post_id   = (int)$data['post_id'];
        $instance  = array();

        if($post_id){
            $widget_data = get_post_meta($post_id, $widget_id, true);
            if(isset($widget_data['widget']) && !empty($widget_data['widget'])){
                $instance = $widget_data['widget'];
            }
        }

        if(empty($instance)){
            global $wp_registered_widgets;

            $widget_obj = $wp_registered_widgets[$widget_id];
            $widget_opt = get_option($widget_obj['callback'][0]->option_name);
            $widget_num = $widget_obj['params'][0]['number'];
            $instance   = $widget_opt[$widget_num];
        }

        if(!empty($instance)){            
            
            $instance = wp_parse_args((array) $instance, array(
                'oauth_access_token'        => '',
                'oauth_access_token_secret' => '',
                'consumer_key'              => '',
                'consumer_secret'           => '',
                'screen_name'               => '',
                'count'                     => '',
                )
            );        

            extract($instance);

            if ($screen_name && $count && $consumer_key && 
                $consumer_secret && $oauth_access_token && $oauth_access_token_secret) {            

                require_once DTK_PATH. 'addon/TwitterAPIExchange.class.php';

                $settings = array(
                    'oauth_access_token' => $oauth_access_token,
                    'oauth_access_token_secret' => $oauth_access_token_secret,
                    'consumer_key' => $consumer_key,
                    'consumer_secret' => $consumer_secret
                );
                
                $url           = "https://api.twitter.com/1.1/statuses/user_timeline.json";
                $requestMethod = "GET";
                $getfield      = "?screen_name={$screen_name}&count={$count}";
                $twitter       = new TwitterAPIExchange($settings);
                $data          = json_decode($twitter->setGetfield($getfield)
                                ->buildOauth($url, $requestMethod)
                                ->performRequest(), TRUE);

                 if ((isset($data["error"]) || !empty($data["error"])) || 
                    isset($data["errors"]) || !empty($data["errors"])) {
                    _e("Sorry, there was a problem when load", 'divine-toolkit');
                } else {
                    $tweets = array();

                    if (!empty($data)){
                        ?>
                        <ul class="clearfix">
                            <?php
                            foreach ($data as $items){
                                preg_match('!https?://[\S]+!', $items['text'], $matches);
                                $url = '';
                                if (isset($matches) && !empty($matches))
                                    $url = $matches[0];

                                $pattern = '~http://[^\s]*~i';
                                $title = preg_replace($pattern, '', $items['text']);                        
                                ?>
                                <li>
                                    <span class="twitter-icon fa fa-twitter"></span>
                                    <div class="twitter-content">
                                        <span>
                                            <?php echo $title; ?>
                                            <?php if (!empty($url)) : ?>
                                                <a href="<?php echo $url; ?>"><?php echo $url; ?></a>
                                            <?php endif; ?>
                                        </span>
                                        <a href="<?php echo $url; ?>" class="entry-date">
                                            <?php
                                            $date = date_create($items['created_at']);
                                            if (version_compare(PHP_VERSION, '5.3') >= 0) {
                                                $created_at = $date->getTimestamp();
                                                echo dvt_human_time_diff($created_at);
                                            } else {
                                                echo date_format($date, "Y/m/d H:iP");
                                            }
                                            ?>
                                        </a>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                }

            }
        }
        exit();
    }
}