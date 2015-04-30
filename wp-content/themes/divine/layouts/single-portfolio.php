<?php
get_header();
global $divine_layout_setting;

$sb_right = $divine_layout_setting['sidebars']['pos_right'];
?>
<div class="bg-hb"></div>

<?php divine_get_breadcrumb(); ?>

<div id="main-content">
    <section class="kopa-area kopa-area-1">
        <div class="wrapper">
            <div class="row">
                <?php
                $wrap_classes = is_active_sidebar($sb_right) ? 'col-md-9 col-sm-9 col-xs-9' : 'col-md-12 col-sm-12 col-xs-12';
                ?>
                <div class="kopa-main-col <?php echo $wrap_classes; ?>">                
                    <div class="kopa-entry-post"> 
                        <?php
                        if (have_posts()):
                            $is_enable_featured_content = (int) kopa_get_option('is-enable-portfolio-featured-content', 1);                            
                            $is_enable_tag              = (int) kopa_get_option('is-enable-portfolio-tag', 1);
                            $is_enable_datetime         = (int) kopa_get_option('is-enable-portfolio-created-date', 1);
                            $is_enable_comments         = (int) kopa_get_option('is-enable-portfolio-comment-counts', 1);
                            $is_enable_shares           = (int) kopa_get_option('is-enable-portfolio-share-buttons', 1);
                            $is_enable_author           = (int) kopa_get_option('is-enable-portfolio-author-info', 1);
                            
                            while (have_posts()) : the_post();
                                $post_id = get_the_ID();
                                $post_url = get_permalink();
                                $post_title = get_the_title();
                                $post_format = get_post_format();
                                ?>
                                <article <?php post_class(array('entry-item', 'gallery-post', 'clearfix')); ?>>                                                                    
                                    
                                    <?php
                                        if ($is_enable_featured_content):
                                            $featured['gallery'] = get_post_meta($post_id, KOPA_PREFIX . 'gallery', true);
                                            $featured['custom']  = get_post_meta($post_id, KOPA_PREFIX . 'custom-content', true);                                            
                                            
                                            if (!empty($featured['gallery'])):
                                                ?>
                                                <div class="entry-thumb">
                                                    <div class="kopa-post-content-formated clearfix">
                                                        <?php echo do_shortcode(sprintf('[gallery ids="%s"]', $featured['gallery'])); ?>
                                                    </div>
                                                </div>
                                                <?php
                                            elseif( !empty($featured['custom']) ):
                                                ?>
                                                <div class="entry-thumb">
                                                    <div class="kopa-post-content-formated clearfix">
                                                        <?php echo do_shortcode($featured['custom']); ?>
                                                    </div>
                                                </div>
                                                <?php
                                            else:
                                                ?>
                                                <?php 
                                                if (has_post_thumbnail()): 
                                                    $image = divine_post_bfi_thumb($post_id, 'blog-thumnail');
                                                    ?>
                                                    <div class="entry-thumb">
                                                        <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>">
                                                            <img src="<?php echo $image; ?>" alt="<?php echo $post_title; ?>">
                                                        </a>                            
                                                    </div>
                                                <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>                            

                                    <div class="entry-content">
                                        <div class="entry-date style1 pull-left">
                                            <span class="entry-month"><?php echo get_the_date('M'); ?></span>
                                            <span class="entry-day"><span><?php echo get_the_date('d'); ?></span></span>
                                        </div>
                                        <div class="content-body">
                                            <header>
                                                <h4 class="entry-title"><?php echo $post_title; ?></h4>
                                                
                                                <?php if ($is_enable_author || $is_enable_comments || $is_enable_tag): ?>
                                                    <div class="entry-meta">

                                                        <?php if ($is_enable_author): ?>
                                                            <p class="entry-author">
                                                                <span class="fa fa-edit"></span>
                                                                <?php the_author(); ?>
                                                            </p>
                                                        <?php endif; ?>

                                                        <?php if ($is_enable_comments): ?>
                                                            <p class="entry-comment">                                                                
                                                                <span class="fa fa-comments"></span>
                                                                <?php comments_popup_link(__('No Comment', divine_get_domain()), __('1 Comment', divine_get_domain()), __('% Comments', divine_get_domain()), '', __('0 Comment', divine_get_domain())); ?>                                                                
                                                            </p>
                                                        <?php endif; ?>
                                                        
                                                        <?php 
                                                        if ($is_enable_tag): 
                                                            $terms = get_the_terms(get_the_ID(), 'portfolio-tag');
                                                            if($terms):
                                                                $term_links = array();
                                                                ?>
                                                                <p class="entry-categories">
                                                                    <span class="fa fa-file-o"></span>  
                                                                    <?php
                                                                    foreach ($terms as $term){
                                                                        array_push( $term_links, sprintf('<a href="%s">%s</a>', get_term_link($term, 'portfolio-tag'), $term->name));
                                                                    }
                                                                    echo implode(', ', $term_links);
                                                            endif;
                                                            ?>                                                            
                                                        <?php endif ?>
                                             
                                                    </div>
                                                <?php endif; ?>
                                            </header>

                                            <div class="kopa_post_content clearfix">
                                                <?php the_content(); ?>
                                            </div>

                                            <?php
                                            wp_link_pages(array(
                                                'before'           => '<p class="page-links clearfix">',
                                                'after'            => '</p>',
                                                'next_or_number'   => 'next',
                                                'nextpagelink'     => '<span class="pull-left">' . __('Next', divine_get_domain()) . '</span>',
                                                'previouspagelink' => '<span class="pull-right">' . __('Previous', divine_get_domain()) . '</span>',
                                                'echo'             => 1
                                            ));
                                            ?>

                                            <br />

                                            <?php
                                            if ($is_enable_shares){
                                                divine_get_share_buttons();
                                            }
                                            ?>                                                                   
                                            
                                        </div>
                                        
                                        <?php
                                        if ($is_enable_author) {
                                            kopa_get_about_author();
                                        }
                                        ?>
                                    </div> 
                                </article>

                                <?php divine_get_related_portfolios(); ?>

                                <?php comments_template(); ?>

                                <?php
                            endwhile;
                        else:
                            printf('<blockquote>%1$s</blockquote>', __('Nothing Found...', divine_get_domain()));
                        endif;
                        ?>
                    </div> 
                    <div class="mb-60"></div>
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
