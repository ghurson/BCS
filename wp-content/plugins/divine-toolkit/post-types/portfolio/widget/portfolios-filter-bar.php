<?php

add_filter('kpb_get_widgets_list', array('DVT_Widget_Portfolios_Filter_Bar', 'register_block'));

class DVT_Widget_Portfolios_Filter_Bar extends Kopa_Widget {

    public $kpb_group = 'portfolio';
    
    public static function register_block($blocks){
        $blocks['DVT_Widget_Portfolios_Filter_Bar'] = new DVT_Widget_Portfolios_Filter_Bar();        
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'kopa-portfolio-2-widget';
		$this->widget_description = __( 'Display list of portfolio with filter bar on top.', 'divine-toolkit' );
		$this->widget_id          = 'kopa-widget-portfolio-filter-bar';
		$this->widget_name        = __( 'Portfolios (filter bar)', 'divine-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'divine-toolkit' )
			),
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 8,
				'label' => __( 'Number of portfolios', 'divine-toolkit' )
			),		            
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

        $query = array(
            'post_type' => array('portfolio'),
            'posts_per_page' => (int) $posts_per_page,
            'post_status' => array('publish')
        );

        $result_set = new WP_Query($query);

        if ( $result_set->have_posts() ) :
            
            $data = '';
            $filter_bars = '';

            ob_start();
            ?>
            <div class="portfolio-container">
                <ul class="portfolio-list-item clearfix">
                    <?php
                    while ($result_set->have_posts()):
                        $result_set->the_post();
                        $image = divine_post_bfi_thumb(get_the_ID(), 'widget-portfolios-filter-bar');
                        $classes = array('kopa-all');
                        $terms = get_the_terms(get_the_ID(), 'portfolio-tag');
                        
                        if(!empty($terms)){
                            foreach ($terms as $term) {
                                $classes[] = "kopa-{$term->slug}";
                                $filter_bars[$term->slug] = $term->name;
                            }
                        }

                        ?>
                        <li data-filter-class='["<?php echo implode('","', $classes); ?>"]'>
                            <article class="portfolio-item">
                                <div class="portfolio-thumb">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"></a>
                                    <div class="thumb-hover">
                                        <a class="thumb-icon" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
                                    </div>
                                </div>
                                <div class="portfolio-caption">
                                    <h6 class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                    <?php if(!empty($terms)) : ?> 
                                        <span class="portfolio-categories">
                                            <?php 
                                            $data = '';
                                            foreach ($terms as $index => $term) {
                                                $data[] = $term->name;
                                            }   
                                            
                                            printf('<span>%s</span>', implode(', ', $data));
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </li>
                        <?php
                    endwhile;
                    ?>    
                </ul>
            </div>
            <?php
            $data = ob_get_clean();
            ?>
            <div class="wrapper">
                <ol class="filters-options">                    
                    <?php
                    printf('<li class="active" data-filter="kopa-all">%s</li>', __('All', 'divine-toolkit'));
                    foreach ($filter_bars as $slug => $name) {
                        printf('<li data-filter="kopa-%s">%s</li>', $slug, $name);
                    }
                    ?>
                </ol>               
            </div>
            <?php
            echo $data;

        endif;

        wp_reset_postdata();

		echo $after_widget;		
	}

}