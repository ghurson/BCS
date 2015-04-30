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

                <div class="kopa-main-col <?php echo $wrap_classes; ?>">
                    <div class="kopa-entry-list">   
                        <?php
                        if (have_posts()):
                            global $post;

                            $exceprt_type           = kopa_get_option('blog-posts-content-type', 'excerpt');
                            $excerpt_limit          = kopa_get_option('blog-posts-content-max-words', 40);                            
                            $is_enable_author       = (int) kopa_get_option('is-enable-blog-posts-author', 1);
                            $is_enable_category     = (int) kopa_get_option('is-enable-blog-posts-category', 1);                            
                            $is_enable_created_date = (int) kopa_get_option('is-enable-blog-posts-created-date', 1);
                            $is_enable_comments     = (int) kopa_get_option('is-enable-blog-posts-comment-counts', 1);
                            ?>

                            <ul class="list-post-cat-item list-unstyled">
                                <?php
                                while (have_posts()) : the_post();
                                    $post_id = get_the_ID();
                                    $post_url = get_permalink();
                                    $post_title = get_the_title();
                                    $post_format = get_post_format();
                                    ?>               
                                    <li>
                                        <article <?php post_class(array('entry-item', 'standard-post', 'clearfix')); ?>>
                                            <?php
                                            if (has_post_thumbnail() && 'full' != $exceprt_type && !is_search()):
                                                $image = divine_post_bfi_thumb($post_id, 'blog-thumnail');
                                                ?>                                                                                               
                                                <div class="entry-thumb">
                                                    <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $post_title; ?>"></a>                                                    
                                                </div>                                                
                                            <?php endif; ?>                                                

                                            <div class="entry-content">

                                                <?php if ($is_enable_created_date) : ?>
                                                    <div class="entry-date style1 pull-left">
                                                        <span class="entry-month"><?php echo get_the_date('M'); ?></span>
                                                        <span class="entry-day"><span><?php echo get_the_date('d'); ?></span></span>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="content-body">
                                                    <header>

                                                        <h4 class="entry-title">
                                                            <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
                                                        </h4>

                                                        <?php if ($is_enable_author || $is_enable_comments || $is_enable_category): ?>
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

                                                                <?php if ($is_enable_category): ?>
                                                                    <p class="entry-categories">
                                                                        <span class="fa fa-file-o"></span>                                                                
                                                                        <?php the_category(', '); ?>                                                                
                                                                    </p>
                                                                <?php endif ?>
                                                            </div>
                                                        <?php endif; ?>

                                                    </header>

                                                    <?php
                                                    if ('excerpt' == $exceprt_type) {
                                                        if (has_excerpt()) {
                                                            printf('<p>%s</p>', get_the_excerpt());
                                                        } else {
                                                            global $post;
                                                            if (strpos($post->post_content, '<!--more-->')) {
                                                                the_content(' ');
                                                            } else {
                                                                printf('<p>%s</p>', get_the_excerpt());
                                                            }
                                                        }
                                                    } elseif ('full' == $exceprt_type) {
                                                        global $more;
                                                        $more = true;
                                                        the_content();
                                                    } else {
                                                        if ($excerpt_limit) {
                                                            $excerpt = wp_trim_words($post->post_content, $excerpt_limit);
                                                            echo ($excerpt) ? sprintf('<p>%s</p>', $excerpt) : '';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                                    <?php
                                endwhile;
                                ?>
                            </ul>

                            <?php get_template_part('pagination'); ?>  

                            <?php
                        else:
                            printf('<blockquote>%1$s</blockquote>', __('Nothing Found...', divine_get_domain()));
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
