<?php
get_header();
global $divine_layout_setting;

$sb_right = $divine_layout_setting['sidebars']['pos_right'];
?>
<div class="bg-hb"></div>

<?php divine_get_breadcrumb(); ?>

<div id="main-content">
    <section class="kopa-area-1 kopa-area">
        <div class="wrapper">
            <div class="row">
                <?php
                $wrap_classes = is_active_sidebar($sb_right) ? 'col-md-9 col-sm-9 col-xs-9' : 'col-md-12 col-sm-12 col-xs-12';
                ?>
                <div class="<?php echo $wrap_classes; ?>">
                    <div class="kopa-portfolio-widget">

                        <?php
                        $data = '';
                        $filter_bars = array();

                        if (have_posts()):
                            ob_start();
                            ?>
                            <div class="portfolio-container2">
                                <ul id="tiles" class="row portfolio-list clearfix">
                                    <?php
                                    while (have_posts()) : the_post();
                                        $post_id = get_the_ID();
                                        $post_url = get_permalink();
                                        $post_title = get_the_title();
                                        $post_format = get_post_format();

                                        $image = divine_post_bfi_thumb(get_the_ID(), 'portfolio-archive');
                                        $image_lightbox = divine_post_bfi_thumb(get_the_ID(), 'post-lightbox');

                                        $classes = array('kopa-all');
                                        $terms = get_the_terms(get_the_ID(), 'portfolio-tag');
                                        if ($terms) {
                                            foreach ($terms as $term) {
                                                $classes[] = "kopa-{$term->slug}";
                                                $filter_bars[$term->slug] = $term->name;
                                            }
                                        }


                                        $portfolio_popup_detail_url = apply_filters('portfolio_popup_detail_url', $post_url, $post_id);
                                        ?>
                                        <li class="col-md-3 col-sm-3" data-filter-class='["<?php echo implode('","', $classes); ?>"]'>
                                            <article class="portfolio-item">
                                                <div class="portfolio-thumb">
                                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
                                                    <div class="thumb-hover">
                                                        <ul class="clearfix">
                                                            <li><a href="<?php echo $image_lightbox; ?>" title="<?php echo $post_title; ?>" class="group1 pf-gallery fa fa-search-plus"></a></li>
                                                            <li><a href="<?php echo $portfolio_popup_detail_url; ?>" class="pf-detail fa fa-sign-out"></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                                <span class="portfolio-categories">
                                                    <?php
                                                    if ($terms) {
                                                        $str_tags = array();
                                                        foreach ($terms as $index => $term) {
                                                            $str_tags[] = sprintf('<span>%s</span>', $term->name);
                                                        }
                                                        echo implode(', ', $str_tags);
                                                    }
                                                    ?>
                                                </span>
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
                            <ol class="filters-options2">
                                <?php
                                printf('<li class="active" data-filter="kopa-all">%s</li>', __('All', divine_get_domain()));
                                if ($filter_bars) {
                                    foreach ($filter_bars as $slug => $name) {
                                        printf('<li data-filter="kopa-%s">%s</li>', $slug, $name);
                                    }
                                }
                                ?>
                            </ol>
                            <?php
                            echo $data;
                            ?>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12"> 
                                    <div class="kopa-loadmore">
                                        <?php
                                        global $wp_rewrite;

                                        $url = get_post_type_archive_link('portfolio');
                                        if (is_tax('portfolio-tag')) {
                                            $url = get_term_link(get_query_var('term'), 'portfolio-tag');
                                        }
                                        $current = (intval(get_query_var('paged'))) ? intval(get_query_var('paged')) : 1;


                                        if ($wp_rewrite->using_permalinks()) {
                                            $url = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/', 'paged=');
                                        } else {
                                            $url = sprintf('%s&paged=', $url);
                                        }
                                        ?>
                                        <span data-url="<?php echo esc_url($url); ?>" data-paged="<?php echo $current + 1; ?>" id="kopa-loadmore-portfolio"><?php _e('Load more', divine_get_domain()); ?><i class="fa fa-spinner"></i></span>
                                    </div>
                                </div>                               
                            </div>

                            <?php
                        endif;
                        ?>

                    </div>                   
                </div>

                <?php
                #WIDGET AREA {RIGHT}

                if (is_active_sidebar($sb_right)):
                    echo '<div class="sidebar col-md-3 col-sm-3 col-xs-3">';
                    add_filter('dynamic_sidebar_params', 'divine_sidebar_right_params');
                    dynamic_sidebar($sb_right);
                    remove_filter('dynamic_sidebar_params', 'divine_sidebar_right_params');
                    echo '<div class="mb-20"></div>';
                    echo '</div>';
                endif;
                ?>                                     
            </div>              
        </div>    
    </section>        
</div>
<?php
get_footer();
