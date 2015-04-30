<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Events_Timeline', 'register_block'));

class DVT_Widget_Events_Timeline extends Kopa_Widget {

    public $kpb_group = 'event';

    public static function register_block($blocks){
        $blocks['DVT_Widget_Events_Timeline'] = new DVT_Widget_Events_Timeline();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-event-widget article-list-1';
		$this->widget_description = __( 'Display events list with timeline layout.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-events-timeline';
		$this->widget_name        = __( 'Events Timeline', 'divine-toolkit' );

		$this->settings 		  = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			),
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 4,
				'label' => __( 'Number of event', 'divine-toolkit' )
			),			
		);	

        $cbo_tags_options = array('' => __( '-- All --', 'divine-toolkit' ));

        
        $tags = get_terms('event-tag');             
        if($tags && !is_wp_error($tags)){          
            foreach ($tags as $tag) {                       
                $cbo_tags_options[$tag->slug] = "{$tag->name} ({$tag->count})";
            }
        }
		
		$this->settings['tags'] = array(
			'type'    => 'select',
			'label'   => __( 'Tags', 'divine-toolkit' ),
			'std'     => '',
			'options' => $cbo_tags_options
		);
		
		parent::__construct();
	}    

	public function widget( $args, $instance ) {
		ob_start();

		extract( $args );
		
        $instance = wp_parse_args((array) $instance, dvt_get_widget_default($this->settings));
		
        extract( $instance );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		$query = array(
			'post_type' => array('event'),
            'posts_per_page' => (int) $instance['posts_per_page'],
            'post_status' => array('publish')
		);

        if(!empty($tags)){
            $query['tax_query'] = array(
                array(
                    'taxonomy' => 'event-tag',
                    'field'    => 'slug',
                    'terms'    => $tags
                ),
            );
        }

		$result_set = new WP_Query( $query );
		
		echo $before_widget;
		
		if($title)
			echo $before_title . $title .$after_title;	

		if ($result_set->have_posts()):
			?>
           	<div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="kopa-event-content">
                        <div class="kopa-line"></div>
                        <div class="event-post-content">
                            <ul class="event-list clearfix">
                                <?php
                                $loop_index = 1;
                                while ($result_set->have_posts()):
                                    $result_set->the_post();
                                    
                                    $classes = (0 == $loop_index % 2) ? 'right-content' : 'left-content';

                                    $month = get_the_date('M');
                                    $day = get_the_date('d');

                                    $start_date = get_post_meta(get_the_ID(), DTK_PREFIX . 'start-date', true);
                                    $start_time = get_post_meta(get_the_ID(), DTK_PREFIX . 'start-time', true);

                                    $end_date = get_post_meta(get_the_ID(), DTK_PREFIX . 'end-date', true);
                                    $end_time = get_post_meta(get_the_ID(), DTK_PREFIX . 'end-time', true);
                                    
                                    if($start_date){
                                        $tmp = DateTime::createFromFormat ( 'd-m-Y' , $start_date );                                                
                                        $month = date_format($tmp, 'M');
                                        $day = date_format($tmp, 'd');                                          

                                        $start_date = date_i18n(get_option('date_format'), strtotime($start_date));
                                    }

                                    if($end_date){
                                        $end_date = date_i18n(get_option('date_format'), strtotime($end_date));
                                    }
                                    ?>
                                    <li <?php post_class($classes); ?>>
                                        <article class="entry-item clearfix">
                                            <div class="entry-date style1 pull-left">
                                                <span class="entry-month"><?php echo $month; ?></span>
                                                <span class="entry-day"><span><?php echo $day; ?></span></span>
                                            </div>
                                            <div class="entry-content">
                                                <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                                
                                                <?php 
                                                if(empty($start_date) && empty($end_date) && ($start_time || $end_time) ): 
                                                    $start_time = $start_time ? $start_time : '00:00';
                                                    $end_time = $end_time ? $end_time : '24:00';
                                                ?>
                                                    <p>
                                                        <?php echo get_post_meta(get_the_ID(), DTK_PREFIX . 'location', true); ?>                                         
                                                        <?php printf(__('&nbsp;<span>%s</span> to <span>%s</span>', 'divine-toolkit'), $start_time, $end_time); ?>
                                                    </p>
                                                <?php else: ?>
                                                    <p>
                                                        <?php echo get_post_meta(get_the_ID(), DTK_PREFIX . 'location', true); ?> 
                                                    </p>
                                                    <?php if($start_date || $start_time): ?>
                                                    <p>
                                                        <strong><?php echo __('Start: ') . '&nbsp;'; ?></strong>
                                                        <span>
                                                            <?php                                         
                                                            if($start_date && $start_time){
                                                                echo $start_date . ' - ' . $start_time;
                                                            }else if($start_date && !$start_time){
                                                                echo $start_date;
                                                            }else if($start_time){
                                                                echo $start_time;
                                                            }                                    
                                                            ?>
                                                        </span> 
                                                    </p>
                                                    <?php endif;?>
                                                    <?php if($end_date || $end_time): ?>
                                                    <p>  
                                                        <strong><?php echo __('End: ') . '&nbsp;'; ?></strong>
                                                        <span>
                                                            <?php 
                                                            if($end_date && $end_time){
                                                                echo $end_date . ' - ' . $end_time;     
                                                            }else if($end_date && !$end_time){
                                                                echo $end_date;
                                                            }else if($end_time){
                                                                echo $end_time;    
                                                            }                                    
                                                            ?>
                                                        </span>
                                                    </p> 
                                                    <?php endif;?>
                                                <?php endif;?>

                                            </div>
                                            <span class="triggle"></span>
                                            <span class="entry-icon"></span>
                                        </article> 
                                    </li>                   
                                    <?php 
                                    $loop_index ++;                   
                                endwhile;
                                ?>
                            </ul>
                        </div>                                       
                    </div>                                    
                </div>                               
            </div>
            <div class="kopa-loadmore">
                <span id="divine-loadmore-events" data-paged="1" data-post-id="<?php echo get_queried_object_id(); ?>"><?php _e('Load more', 'divine-toolkit'); ?><i class="fa fa-spinner"></i></span>
                <?php wp_nonce_field('kopa_load_events', 'kopa_load_events_ajax_nonce'); ?>
            </div>
            <?php
		endif;
		wp_reset_postdata();

		echo $after_widget;

		$content = ob_get_clean();
		echo $content;		
	}

}


if (!function_exists('kopa_load_events')) {

    add_action('wp_ajax_kopa_load_events', 'kopa_load_events');
    add_action('wp_ajax_nopriv_kopa_load_events', 'kopa_load_events');

    function kopa_load_events() {
        check_ajax_referer('kopa_load_events', 'ajax_nonce');

        $widget_id = $_POST['widget_id'];
        $paged = $_POST['paged'];
        $post_id = (int)$_POST['post_id'];
        
        if($widget_data = get_post_meta($post_id, $widget_id, true)){
            $instance = $widget_data['widget'];

            $tags = isset($instance['tags']) ? $instance['tags'] : array();
            $posts_per_page = (int) $instance['posts_per_page'];
            $paged = (int) $paged;
            $query = array(
                'post_type' => array('event'),
                'posts_per_page' => $posts_per_page,
                'post_status' => array('publish'),
                'paged' => $paged
            );

            if (!empty($tags)) {
                $query['tax_query'][] = array(
                    'taxonomy' => 'event_tag',
                    'field' => 'id',
                    'terms' => $tags
                );
            }

            $events = new WP_Query($query);

            if ($events->have_posts()):

                $loop_index = 1;
                while ($events->have_posts()):
                    $events->the_post();

                    if (0 != $paged % 2) {
                        $classes = (0 == $loop_index % 2) ? 'right-content' : 'left-content';
                    } else {
                        if(0 != $posts_per_page % 2){
                            $classes = (0 == $loop_index % 2) ? 'left-content' : 'right-content';                            
                        }else{
                            $classes = (0 == $loop_index % 2) ? 'right-content' : 'left-content';
                        }                        
                    }

                    divine_log($classes);

                    $month = get_the_date('M');
                    $day = get_the_date('d');

                    $start_date = get_post_meta(get_the_ID(), DTK_PREFIX . 'start-date', true);
                    $start_time = get_post_meta(get_the_ID(), DTK_PREFIX . 'start-time', true);

                    $end_date = get_post_meta(get_the_ID(), DTK_PREFIX . 'end-date', true);
                    $end_time = get_post_meta(get_the_ID(), DTK_PREFIX . 'end-time', true);
                    
                    if($start_date){
                        $tmp = DateTime::createFromFormat ( 'd-m-Y' , $start_date );                                                
                        $month = date_format($tmp, 'M');
                        $day = date_format($tmp, 'd');                                          

                        $start_date = date_i18n(get_option('date_format'), strtotime($start_date));
                    }

                    if($end_date){
                        $end_date = date_i18n(get_option('date_format'), strtotime($end_date));
                    }

                    ?>
                    <li <?php post_class($classes); ?>>
                        <article class="entry-item clearfix">
                            <div class="entry-date style1 pull-left">
                                <span class="entry-month"><?php echo $month; ?></span>
                                <span class="entry-day"><span><?php echo $day; ?></span></span>
                            </div>
                            <div class="entry-content">
                                <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                
                                <?php 
                                if(empty($start_date) && empty($end_date) && ($start_time || $end_time) ): 
                                    $start_time = $start_time ? $start_time : '00:00';
                                    $end_time = $end_time ? $end_time : '24:00';
                                ?>
                                    <p>
                                        <?php echo get_post_meta(get_the_ID(), DTK_PREFIX . 'location', true); ?>                                         
                                        <?php printf(__('&nbsp;<span>%s</span> to <span>%s</span>', 'divine-toolkit'), $start_time, $end_time); ?>
                                    </p>
                                <?php else: ?>
                                    <p>
                                        <?php echo get_post_meta(get_the_ID(), DTK_PREFIX . 'location', true); ?> 
                                    </p>
                                    <?php if($start_date || $start_time): ?>
                                    <p>
                                        <strong><?php echo __('Start: ') . '&nbsp;'; ?></strong>
                                        <span>
                                            <?php                                         
                                            if($start_date && $start_time){
                                                echo $start_date . ' - ' . $start_time;
                                            }else if($start_date && !$start_time){
                                                echo $start_date;
                                            }else if($start_time){
                                                echo $start_time;
                                            }                                    
                                            ?>
                                        </span> 
                                    </p>
                                    <?php endif;?>
                                    <?php if($end_date || $end_time): ?>
                                    <p>  
                                        <strong><?php echo __('End: ') . '&nbsp;'; ?></strong>
                                        <span>
                                            <?php 
                                            if($end_date && $end_time){
                                                echo $end_date . ' - ' . $end_time;     
                                            }else if($end_date && !$end_time){
                                                echo $end_date;
                                            }else if($end_time){
                                                echo $end_time;    
                                            }                                    
                                            ?>
                                        </span>
                                    </p> 
                                    <?php endif;?>
                                <?php endif;?>

                            </div>
                            <span class="triggle"></span>
                            <span class="entry-icon"></span>
                        </article> 
                    </li>
                    <?php
                    $loop_index ++;
                endwhile;

            endif;

            wp_reset_postdata();
        }

        exit();
    }

}