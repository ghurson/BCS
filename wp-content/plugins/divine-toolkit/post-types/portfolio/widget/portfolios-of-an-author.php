<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Portfolios_Of_An_Author', 'register_block'));

class DVT_Widget_Portfolios_Of_An_Author extends Kopa_Widget {

    public $kpb_group = 'portfolio';
    
    public static function register_block($blocks){
        $blocks['DVT_Widget_Portfolios_Of_An_Author'] = new DVT_Widget_Portfolios_Of_An_Author();    
        return $blocks;
    }
    
	public function __construct() {
		$this->widget_cssclass    = 'kopa-portfolio-widget kopa-widget-portfolios-of-an-author';
		$this->widget_description = __( 'Display list of portfolio created by an author.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-widget-portfolios-of-an-author';
		$this->widget_name        = __( 'Portfolios (of an author)', 'divine-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			),  				
            'portfolio_per_row'  => array(
                'type'    => 'select',
                'std'     => 3,
                'label'   => __( 'Portfolio per row', 'divine-toolkit' ),
                'options' => array(
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    6 => 6
                ),
            ),  
            'total_row'  => array(
                'type'  => 'number',
                'std'   => 1,
                'label' => __( 'Total row', 'divine-toolkit' )
            ),            
		);

        $users = get_users(array('fields' => array('display_name', 'user_login')));
        $users_list = array();

        foreach ($users as $user) {            
            $users_list[$user->user_login] = esc_attr($user->display_name);
        }

        $this->settings['author_name'] = array(
            'type'    => 'select',
            'std'     => '',
            'label'   => __('Author', 'divine-toolkit'),
            'options' => $users_list,
        );

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );
		
        $instance = wp_parse_args((array) $instance, dvt_get_widget_default($this->settings));
		
        extract( $instance );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		echo $before_widget;

		if($title)
			echo $before_title . $title .$after_title;	

        $portfolio_per_row = (int) $portfolio_per_row;
        $total_row         = (int) $total_row;

        $query = array(
            'post_type' => array('portfolio'),
            'posts_per_page' => $portfolio_per_row * $total_row,
            'post_status' => array('publish'),
            'author_name' => $author_name,
        );        

        $result_set = new WP_Query($query);

        if ( $result_set->have_posts() ) :
            $loop_index = 0;               
            ?>
                <div class="portfolio-list">                                          
                    <?php
                    $classes = array('portfolio-item-wrap');
                    switch ($portfolio_per_row) {
                        case 1:
                            array_push($classes, 'col-md-12 col-sm-12 col-xs-12');
                            break;
                        case 2:
                            array_push($classes, 'col-md-6 col-sm-6 col-xs-12');
                            break;
                        case 3:
                            array_push($classes, 'col-md-4 col-sm-4 col-xs-12');
                            break;
                        case 4:
                            array_push($classes, 'col-md-3 col-sm-3 col-xs-12');
                            break;
                        case 6:
                            array_push($classes, 'col-md-2 col-sm-2 col-xs-12');
                            break;
                        default:
                            array_push($classes, 'col-md-4 col-sm-4 col-xs-12');
                            break;
                    }

                    while ($result_set->have_posts()):
                        $result_set->the_post();                  
                        $post_id = get_the_ID();
                        $post_title = get_the_title();
                        $post_url = get_permalink();

                        $image = divine_post_bfi_thumb(get_the_ID(), 'widget-portfolios-of-an-author');
                        $full = divine_post_bfi_thumb(get_the_ID(), 'widget-portfolios-of-an-author-lightbox');                            

                        if(0 == $loop_index){
                            echo '<div class="row row-first">';
                        }else if($loop_index % $portfolio_per_row == 0){
                            echo '</div>';
                            echo '<div class="row row-other">';
                        }

                        ?>
                        <div <?php post_class($classes); ?>>
                            <?php  ?>
                            <article class="portfolio-item">
                                <div class="portfolio-thumb">
                                    <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $post_title; ?>"></a>
                                    <div class="thumb-hover">
                                        <ul class="clearfix">
                                            <li><a href="<?php echo $full; ?>" title="<?php echo $post_title; ?>" class="group1 pf-gallery fa fa-search-plus"></a></li>
                                            <li><a href="<?php echo $post_url; ?>" class="pf-detail fa fa-sign-out"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <h6 class="portfolio-title"><a href="<?php echo $post_url; ?>"><?php echo $post_title; ?></a></h6>
                                
                                <?php 
                                if($terms = get_the_terms(get_the_ID(), 'portfolio-tag')){
                                    $data = '';
                                    foreach ($terms as $index => $term) {
                                        $data[] = $term->name;
                                    }   
                                    
                                    printf('<span class="kopa-portfolio-tags-list">%s</span>', implode(', ', $data));
                                }                                                                        
                                ?>                                        
                            </article>
                            <?php  ?>
                        </div>
                        <?php
                        $loop_index++;
                    endwhile;                    
                    
                    echo '</div>';                    
                    ?>                                        
                </div>
            <?php
        endif;

        wp_reset_postdata();

		echo $after_widget;		
	}

}