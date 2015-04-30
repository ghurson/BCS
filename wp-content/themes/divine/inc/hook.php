<?php

function divine_enqueue_script(){
	global $wp_styles, $is_IE, $kopaCurrentLayout;
    $layout_setting = kopa_get_template_setting();

    $dir = get_template_directory_uri();
    
    wp_enqueue_style(KOPA_PREFIX . 'font-awesome', "{$dir}/framework/assets/css/font-awesome.css");
    wp_enqueue_style(KOPA_PREFIX . 'bootstrap', $dir . '/css/bootstrap.css', array(), NULL);
    wp_enqueue_style(KOPA_PREFIX . 'superfish', $dir . '/css/superfish.css', array(), NULL);
    wp_enqueue_style(KOPA_PREFIX . 'owl.carousel', $dir . '/css/owl.carousel.css', array(), NULL);
    wp_enqueue_style(KOPA_PREFIX . 'owl.theme', $dir . '/css/owl.theme.css', array(), NULL);
    wp_enqueue_style(KOPA_PREFIX . 'jquery.navgoco', $dir . '/css/jquery.navgoco.css', array(), NULL);    
    wp_enqueue_style(KOPA_PREFIX . 'animate', $dir . '/css/animate.css', array(), NULL);    
    wp_enqueue_style(KOPA_PREFIX . 'magnific-popup', $dir . '/css/magnific-popup.css', array(), NULL);
    wp_enqueue_style(KOPA_PREFIX . 'style', get_stylesheet_uri(), array(), NULL);

    $breadcrumb_background = kopa_get_option('breadcrumb-background-image');

    if($breadcrumb_background){
        $breadcrumb_css = sprintf('.kopa-breadcrumb {background-image: url("%s");}', $breadcrumb_background);
        wp_add_inline_style(KOPA_PREFIX . 'style', do_shortcode($breadcrumb_css));
    }        

    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-masonry');
    
    if (is_singular()) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script(KOPA_PREFIX . 'modernizr', $dir . '/js/modernizr.js', array('jquery'), NULL, TRUE);
    wp_enqueue_script(KOPA_PREFIX . 'bootstrap', $dir . '/js/bootstrap.js', array('jquery'), NULL, TRUE);
    wp_enqueue_script(KOPA_PREFIX . 'require', $dir . '/js/require.js', array('jquery'), NULL, TRUE);

    if (is_page()) {        
        wp_enqueue_script('jquery-form');
        wp_enqueue_script(KOPA_PREFIX . 'maps-api', 'http://maps.google.com/maps/api/js?sensor=true', array('jquery'), NULL, TRUE);
        wp_enqueue_script(KOPA_PREFIX . 'contact-form', $dir . '/js/kopa.contact-form.js', array('jquery'), NULL, TRUE);
    }
            
    wp_enqueue_script(KOPA_PREFIX . 'custom', $dir . '/js/custom.js', array('jquery'), NULL, TRUE);
    wp_localize_script(KOPA_PREFIX . 'custom', 'kopa_variable', array(
        'url' => array(
            'template_directory_uri' => get_template_directory_uri() . '/',
            'ajax' => admin_url('admin-ajax.php')
        ),
        'template' => array(
            'post_id' => (is_singular()) ? get_queried_object_id() : 0
        ),
        'contact' => array(
            'address' => kopa_get_option('contact_address', ''),
            'marker'  => '',
        ),        
        'option' => array(
            'is_enable_sticky_menu' => (int)kopa_get_option('is-enable-sticky-menu', 1)
        ),
        'i18n' => array(
            'SEARCH'    => __('Search...', divine_get_domain()),
            'LOADING'   => __('Loading...', divine_get_domain()),
            'LOAD_MORE' => __('Load more', divine_get_domain()),
            'LOADING'   => __('Loading...', divine_get_domain()),
            'VIEW'      => __('View', divine_get_domain()),
            'VIEWS'     => __('Views', divine_get_domain()),
            'validate'  => array(
                'form' => array(
                    'CHECKING' => __('Checking', divine_get_domain()),
                    'SUBMIT'   => __('Send message', divine_get_domain()),
                    'SENDING'  => __('Sending...', divine_get_domain())
                ),
                'recaptcha' => array(
                    'INVALID'  => __('Your captcha is incorrect. Please try again', divine_get_domain()),
                    'REQUIRED' => __('Captcha is required', divine_get_domain())
                ),
                'name' => array(
                    'REQUIRED'  => __('Please enter your name', divine_get_domain()),
                    'MINLENGTH' => __('At least {0} characters required', divine_get_domain())
                ),
                'email' => array(
                    'REQUIRED' => __('Please enter your email', divine_get_domain()),
                    'EMAIL'    => __('Please enter a valid email', divine_get_domain())
                ),
                'url' => array(
                    'REQUIRED' => __('Please enter your url', divine_get_domain()),
                    'URL'      => __('Please enter a valid url', divine_get_domain())
                ),
                'message' => array(
                    'REQUIRED'  => __('Please enter a message', divine_get_domain()),
                    'MINLENGTH' => __('At least {0} characters required', divine_get_domain())
                )
            )
        )
    ));

    wp_enqueue_script(KOPA_PREFIX . 'portfolio', $dir . '/js/kopa.portfolio.js', array('jquery', KOPA_PREFIX . 'custom', KOPA_PREFIX . 'require'), NULL, TRUE);
    /*
     * --------------------------------------------------
     * IE FIX
     * --------------------------------------------------
     */
    if ($is_IE) {
        wp_register_style(KOPA_PREFIX . 'ie', $dir . '/css/ie.css', array(), NULL);
        wp_enqueue_style(KOPA_PREFIX . 'ie');
        $wp_styles->add_data(KOPA_PREFIX . 'ie', 'conditional', 'lt IE 9');

        wp_register_style(KOPA_PREFIX . 'ie9', $dir . '/css/ie9.css', array(), NULL);
        wp_enqueue_style(KOPA_PREFIX . 'ie9');
        $wp_styles->add_data(KOPA_PREFIX . 'ie9', 'conditional', 'IE 9');
    }
}

function divine_set_body_class($classes){
    $divine_layout_setting = kopa_get_template_setting();

    switch ($divine_layout_setting['layout_id']) {
        case 'blog-page':
            array_push($classes, 'kopa-blog-page');
            break;
        case 'portfolio-archive':
            array_push($classes, 'kopa-portfolio-page');
            break;  
    }

	return $classes;
}

function divine_get_site_title($title, $sep){
	global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    $title .= get_bloginfo('name', 'display');

    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() )) {
        $title = "$title $sep $site_description";
    }

    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', divine_get_domain()), max($paged, $page));
    }

    return $title;
}

function divine_get_social_links(){
    $socials = divine_get_social_networks(); 
    ?>
    <ul class="social-links pull-left clearfix">
        <?php    
        foreach ($socials as $index => $social) {
            $href = kopa_get_option($social['id']);

            if ('rss-url' == $social['id']) {
                if (empty($href)) {
                    $href = get_bloginfo_rss('rss2_url');
                } elseif ('HIDE' == strtoupper($href)) {
                    $href = '';
                }
            }

            if (!empty($href)) {
                printf('<li><a class="kopa-social-link %s" href="%s" target="_blank" title="%s" rel="nofollow"></a></li>', $social['icon'], $href, $social['title']);
            }
        }
        ?>
    </ul>
    <?php
}

function divine_get_footer_social_links(){
    $is_enable_social_links = (int)kopa_get_option('is-enable-social-links-footer');
    $is_enable_newsletter_form = (int)kopa_get_option('is-enable-newsletter-footer');

    if ($is_enable_social_links || $is_enable_newsletter_form):
        ?>    
        <section class="kopa-area-3">
            <div class="wrapper">
                <?php if ($is_enable_social_links): ?>
                    <div class="left-area">
                        <div class="widget kopa-social-link-widget">
                            <span><?php _e('Stay in touch', divine_get_domain()); ?></span>
                            <ul class="social-links pull-left clearfix">
                                <?php
                                $socials = divine_get_social_networks(); 
                                foreach ($socials as $index => $social) {
                                    $href = kopa_get_option($social['id']);

                                    if ('rss-url' == $social['id']) {
                                        if (empty($href)) {
                                            $href = get_bloginfo_rss('rss2_url');
                                        } elseif ('HIDE' == strtoupper($href)) {
                                            $href = '';
                                        }
                                    }

                                    if (!empty($href)) {
                                        printf('<li><a class="%s" href="%s" target="_blank" title="%s" rel="nofollow"></a></li>', $social['icon'], $href, $social['title']);
                                    }
                                }                           
                                ?>
                            </ul>                
                        </div>            
                    </div>        
                <?php endif; ?>

                <?php if ($is_enable_newsletter_form): ?>           
                    <?php
                    $uri = kopa_get_option('newsletter-feed-burner-uri');
                    $mailchimp = kopa_get_option('newsletter-mail-chimp');      

                    if($mailchimp){         
                        $mailchimp = divine_get_attribute( 'action', $mailchimp );                                    
                    }

                    if ($uri || $mailchimp):
                        ?>
                        <div class="right-area">
                            <div class="widget kopa-newsletter-widget">
                                <span class="news-icon fa fa-envelope"></span>
                                <div class="media-body">
                                    <p><?php _e('Newsletter Signup', divine_get_domain()); ?></p>                            
                                    
                                    <?php if($uri){ ?>
                                    <form class="newsletter-form clearfix" 
                                          action="http://feedburner.google.com/fb/a/mailverify" 
                                          method="post" target="popupwindow" 
                                          onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $uri; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');
                                                          return true;">                                  
                                        <p class="input-email clearfix">
                                            <input type="text" name="email" value="" placeholder="<?php _e('Your Email', divine_get_domain()); ?>" class="email">                
                                            <input type="hidden" value="<?php echo $uri; ?>" name="uri"/>
                                            <input type="hidden" name="loc" value="en_US"/>                
                                            <input type="submit" value="<?php _e('Subscribe', divine_get_domain()); ?>" class="submit">
                                        </p>                    
                                    </form> 
                                    <?php }else{ ?>

                                    
                                    <form 
                                    action="<?php echo esc_url($mailchimp); ?>" 
                                    method="post" 
                                    name="mc-embedded-subscribe-form" 
                                    class="newsletter-form clearfix validate"
                                    target="_blank" 
                                    novalidate>                                  
                                        <p class="input-email clearfix">
                                            <input type="text" name="EMAIL" value="" placeholder="<?php _e('Your Email', divine_get_domain()); ?>" class="email">                                                        
                                            <input type="submit" value="<?php _e('Subscribe', divine_get_domain()); ?>" class="submit">
                                        </p>                    
                                    </form> 

                                    <?php } ?>
                                </div>
                            </div>            
                        </div>      
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </section>
    <?php endif;
}

function divine_get_breadcrumb() {
    if(1 != (int)kopa_get_option('is-enable-breadcrumb', 1))
        return;

    if(is_page()){
        global $post;
        if(1 == (int)get_post_meta($post->ID, KOPA_PREFIX . 'breadcrumb-is-hide', true)){
            return;    
        }
    }    

    global $post, $wp_query;
    $current_class = 'current-page';
    $prefix = '&nbsp;/&nbsp;';

    $breadcrumb_before = '<div class="kopa-breadcrumb">';
    $breadcrumb_before.= '<div class="wrapper clearfix">';
    $breadcrumb_before.= '<div class="pull-left">';

    $site_title = get_bloginfo('name');
    $site_desc = get_bloginfo('description');

    if (is_archive()) {
        if (is_tag()) {
            $term = get_term(get_queried_object_id(), 'post_tag');
            $site_title = $term->name;
            
            if( $tag_desc = $term->description ){
                $site_desc = $tag_desc;
            }

        } else if (is_category()) {
            $term = get_term(get_queried_object_id(), 'category');
            $site_title = $term->name;

            if( $category_desc = $term->description ){
                $site_desc = $category_desc;
            }                

        }
    } else if (is_single() || is_page()) {
        $id         = get_queried_object_id();
        $site_title = get_the_title($id);
        $site_desc  = get_post_field('post_content', $id);     
    }

    $site_title        = apply_filters('divine_breadcrumb_site_title', $site_title);
    $site_desc         = strip_shortcodes(apply_filters('divine_breadcrumb_site_desc', wp_trim_words($site_desc, 10, '..')));
    
    $breadcrumb_before .= sprintf('<span>%s</span>', $site_title);
    $breadcrumb_before .= sprintf('<p>%s</p>', $site_desc);
    
    $breadcrumb_before .= '</div>';
    $breadcrumb_before .= '<div class="pull-right clearfix">';
    
    $breadcrumb_after  = '</div>';
    $breadcrumb_after  .= '</div>';
    $breadcrumb_after  .= '</div>';
    
    $breadcrumb_home   = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . home_url() . '" itemprop="url"><span itemprop="title">' . __('Home', divine_get_domain()) . '</span></a></span>';
    $breadcrumb        = '';

    if (is_archive()) {
        if (is_tag()) {
            $term = get_term(get_queried_object_id(), 'post_tag');
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $term->name);
        } else if (is_category()) {
            $terms_link = explode($prefix, substr(get_category_parents(get_queried_object_id(), TRUE, $prefix), 0, (strlen($prefix) * -1)));
            $n = count($terms_link);
            if ($n > 1) {
                for ($i = 0; $i < ($n - 1); $i++) {
                    $breadcrumb.= $prefix . $terms_link[$i];
                }
            }
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, get_the_category_by_ID(get_queried_object_id()));
        } else if (is_year() || is_month() || is_day()) {

            $m = get_query_var('m');
            $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);
            if (strlen($m) >= 4)
                $date['y'] = substr($m, 0, 4);
            if (strlen($m) >= 6)
                $date['m'] = substr($m, 4, 2);
            if (strlen($m) >= 8)
                $date['d'] = substr($m, 6, 2);
            if ($date['y'])
                if (is_year())
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $date['y']);
                else
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_year_link($date['y']), $date['y']);
            if ($date['m'])
                if (is_month())
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, date('F', mktime(0, 0, 0, $date['m'])));
                else
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_month_link($date['y'], $date['m']), date('F', mktime(0, 0, 0, $date['m'])));
            if ($date['d'])
                if (is_day())
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $date['d']);
                else
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_day_link($date['y'], $date['m'], $date['d']), $date['d']);
        }else if (is_author()) {

            $author_id = get_queried_object_id();
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf(__('Posts created by %1$s', divine_get_domain()), get_the_author_meta('display_name', $author_id)));
        }
    } else if (is_search()) {
        $s = get_search_query();
        $c = $wp_query->found_posts;
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf(__('Searched for "%s" return %s results', divine_get_domain()), $s, $c));
    } else if (is_singular()) {
        if (is_page()) {
            if (is_front_page()) {
                $breadcrumb = NULL;
            } else {
                $post_ancestors = get_post_ancestors($post);
                if ($post_ancestors) {
                    $post_ancestors = array_reverse($post_ancestors);
                    foreach ($post_ancestors as $crumb)
                        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_permalink($crumb), esc_html(get_the_title($crumb)));
                }
                $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_permalink(get_queried_object_id()), esc_html(get_the_title(get_queried_object_id())));
            }
        } else if (is_single()) {
            $categories = get_the_category(get_queried_object_id());
            if ($categories) {
                foreach ($categories as $category) {
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_category_link($category->term_id), $category->name);
                }
            }
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_permalink(get_queried_object_id()), esc_html(get_the_title(get_queried_object_id())));
        }
    } else if (is_404()) {
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, __('Page not found', divine_get_domain()));
    } else {
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, __('Latest News', divine_get_domain()));
    }

    echo $breadcrumb_before;
    echo $breadcrumb_home . apply_filters('kopa_get_breadcrumb', $breadcrumb, $current_class, $prefix);
    echo $breadcrumb_after;
}

function divine_sidebar_right_params($params){
    $params[0]['before_title']  = '<h4 class="widget-title style4">';
    $params[0]['after_title']   = '</h4>';

    return $params;
}

function divine_get_comments_by_post_id($post_id, $return_only_number = false) {
    $count = NULL;

    if (comments_open($post_id)) {
        $comment_number = (int) get_comments_number($post_id);
        switch ($comment_number) {
            case 0:
                $count = __('Comment Now', divine_get_domain());
                break;
            case 1:
                $count = sprintf('%s %s', $comment_number, __('Comment', divine_get_domain()));
                break;
            default:
                $count = sprintf('%s %s', $comment_number, __('Comments', divine_get_domain()));
                break;
        }
    } else {
        $count = __('0 Comment', divine_get_domain());
    }

    if ($return_only_number) {
        $count = (int) $count;
    }

    return apply_filters('divine_get_comments_by_post_id', $count);
}

function divine_get_share_buttons(){
    global $post;

    $post_url = get_permalink($post->ID);
    $post_title = get_the_title($post->ID);
    $email_subject = get_bloginfo('name') . ': ' . $post_title;
    $email_body = __('I recommend this page: ', divine_get_domain()) . $post_title . __('. You can read it on: ', divine_get_domain()) . get_permalink($post->ID);

    $featured_image = kopa_get_option('logo');
    if (has_post_thumbnail($post->ID)) {
        $featured_image = divine_post_bfi_thumb($post->ID, 'full');
    }
    ?>
    <div class="kopa-share-post">
        <span><?php _e('Share This:', divine_get_domain()); ?></span> 
        <div class="kopa-social-link">
            <ul class="social-links style3 clearfix">
                <li><a href="<?php echo esc_url( sprintf( 'http://www.facebook.com/share.php?u=%s', urlencode($post_url) ) ); ?>" title="Facebook" target="_blank" class="fa fa-facebook" rel="nofollow"></a></li>
                <li><a href="<?php echo esc_url( sprintf( 'http://twitter.com/home?status=%s+%s', $post_title, $post_url ) ); ?>" title="Twitter" target="_blank" class="fa fa-twitter" rel="nofollow"></a></li>
                <li><a href="<?php echo esc_url( sprintf( 'https://plus.google.com/share?url=%s', $post_url ) ); ?>" title="Google" target="_blank" class="fa fa-google-plus" rel="nofollow"></a></li>
                <li><a href="<?php echo esc_url( sprintf( 'http://pinterest.com/pin/create/button/?url=%s&media=%s&description=%s', $post_url, $featured_image, $post_title ) ); ?> " title="Pinterest" target="_blank" class="fa fa-pinterest" rel="nofollow"></a></li>
                <li><a href="<?php echo esc_url( sprintf( 'mailto:?subject=%s&body=%s', $email_subject, $email_body ) ); ?>" title="Email" target="_blank" class="fa fa-envelope" rel="nofollow"></a></li>               
            </ul>
        </div>
    </div>
    <?php
}

function kopa_get_about_author(){
    global $post;

    $user_id     = $post->post_author;
    $description = get_the_author_meta('description', $user_id);
    $email       = get_the_author_meta('user_email', $user_id);
    $name        = get_the_author_meta('display_name', $user_id);
    $url         = trim(get_the_author_meta('user_url', $user_id));
    $link        = ($url) ? $url : get_author_posts_url($user_id);
    $jobs        = get_the_author_meta('jobs', $user_id);

    ?>
    <div class="kopa-author clearfix">

        <?php
        $socials = array('facebook', 'twitter', 'dribbble', 'flickr', 'pinterest', 'google_plus');
        $social_links = array();
        foreach ($socials as $social) {
            $tmp = get_the_author_meta($social, $user_id);
            if ($tmp) {
                $social_links[$social] = $tmp;
            }
        }
        if (!empty($social_links)):
            ?>
            <div class="author-social-link">            
                <div>               
                    <span><?php _e('Follow me on:', divine_get_domain()); ?></span>
                    <div class="social-filter clearfix">
                        <?php
                        $is_first = true;
                        foreach ($social_links as $type => $url):
                            $type = str_replace('_', '-', $type);

                            if ($is_first):
                                ?>
                                <div class="clearfix">
                                    <a href="<?php echo $url; ?>" title="<?php printf(__('Follow author %s on %s', divine_get_domain()), $name, $type); ?>" class="fa <?php echo "fa-{$type}"; ?>"></a>
                                    <span class="fa fa-sort-desc"></span>
                                </div>
                                <ul>
                                    <?php
                                else:
                                    ?>
                                    <li><a href="<?php echo $url; ?>" title="<?php printf(__('Follow author %s on %s', divine_get_domain()), $name, $type); ?>" class="fa <?php echo "fa-{$type}"; ?>"></a></li>
                                <?php
                                endif;
                                $is_first = false;
                            endforeach;
                            ?>
                        </ul>                                   
                    </div>
                </div>            
            </div>
        <?php endif; ?>


        <a class="avatar-thumb" href="<?php echo $link; ?>" title="<?php echo $name; ?>"><?php echo get_avatar($email, 86); ?></a> 

        <div class="author-content">
            <header class="clearfix">
                <h6 class="author-name"><a href="<?php echo $link; ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a></h6>                
                <?php if ($jobs): ?>
                    <span class="author-job"><?php echo $jobs; ?></span>
                <?php endif; ?>
            </header>
            <?php echo ($description) ? "<p>{$description}</p>" : ''; ?>
        </div>
    </div>
    <?php
}

function divine_add_user_socials($methods) {
    $methods['jobs']        = __('Jobs', divine_get_domain());
    $methods['facebook']    = __('Facebook URL', divine_get_domain());
    $methods['twitter']     = __('Twitter URL', divine_get_domain());
    $methods['dribbble']    = __('Dribbble URL', divine_get_domain());
    $methods['pinterest']   = __('Pinterest URL', divine_get_domain());
    $methods['flickr']      = __('Flickr URL', divine_get_domain());
    $methods['google_plus'] = __('Google Plus URL', divine_get_domain());
    
    return $methods;
}

function divine_get_related_posts(){
    $get_by = kopa_get_option('single-post-related-by', 'post_tag');
    $limit  = (int) kopa_get_option('single-post-related-limit', 6);

    if ($limit > 0) {
        global $post;
        $taxs = array();

        if ('category' == $get_by) {
            $cats = get_the_category(($post->ID));
            if ($cats) {
                $ids = array();
                foreach ($cats as $cat) {
                    $ids[] = $cat->term_id;
                }
                $taxs [] = array(
                    'taxonomy' => 'category',
                    'field'    => 'id',
                    'terms'    => $ids
                );
            }
        } else if ('post_tag' == $get_by) {
            $tags = get_the_tags($post->ID);
            if ($tags) {
                $ids = array();
                foreach ($tags as $tag) {
                    $ids[] = $tag->term_id;
                }
                $taxs [] = array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'id',
                    'terms'    => $ids
                );
            }
        }

        if ($taxs) {
            $related_args = array(
                'post_type' => array($post->post_type),
                'tax_query' => $taxs,
                'post__not_in' => array($post->ID),
                'posts_per_page' => $limit
            );

            $related_posts = new WP_Query($related_args);
            if ($related_posts->have_posts()):

                $list_classes = array('kopa-related-post', 'portfolio-list');
                $list_classes[] = sprintf('portfolio-list-%d-items', $related_posts->post_count);
                
                ?>  
                <div class="<?php echo implode(' ', $list_classes); ?>">
                    <h4 class="widget-title style3"><?php echo apply_filters('divine_divine_get_related_posts_title', __('Related articles', divine_get_domain())); ?></h4>  
                    <div class="row">
                        <div class="owl-carousel owl-carousel-8">
                            <?php
                            while ($related_posts->have_posts()):
                                $related_posts->the_post();
                                $post_id = get_the_ID();
                                $post_url = get_permalink();
                                $post_title = get_the_title();
                                ?>
                                <div class="item">
                                    <article class="portfolio-item">
                                        <div class="portfolio-thumb">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php
                                                $image_full = divine_post_bfi_thumb($post_id, 'post-lightbox');
                                                $image      = divine_post_bfi_thumb($post_id, 'post-related');
                                                ?>
                                                <a href="<?php echo $post_url; ?>">
                                                    <img src="<?php echo $image; ?>" alt="<?php echo $post_title; ?>">
                                                </a>

                                                <div class="thumb-hover">
                                                    <ul class="clearfix">
                                                        <li><a href="<?php echo $image_full; ?>" class="group2 pf-gallery fa fa-search-plus" title="<?php echo $post_title; ?>"></a></li>
                                                        <li><a href="<?php echo $post_url; ?>" class="pf-detail fa fa-sign-out" title="<?php echo $post_title; ?>"></a></li>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <h6 class="portfolio-title"><a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a></h6>
                                        <span class="entry-date"><i class="fa fa-calendar"></i><span><?php echo get_the_date(); ?></span></span>
                                        <?php printf('<span>%s</span>', wp_trim_words( strip_shortcodes($post->post_content), 20)); ?>
                                    </article>  
                                </div>
                                <?php
                            endwhile;
                            ?>
                        </div>
                    </div>
                </div>                    
                <?php
            endif;
            wp_reset_postdata();
        }
    }
}

function divine_get_related_portfolios(){
    $get_by = kopa_get_option('single-portfolio-related-by', 'portfolio-tag');
    $limit  = (int) kopa_get_option('single-portfolio-related-limit', 6);

    if ($limit > 0) {
        global $post;
        $taxs = array();

        $tags = get_the_terms($post->ID, 'portfolio-tag');
        if ($tags) {
            $ids = array();
            foreach ($tags as $tag) {
                $ids[] = $tag->term_id;
            }
            $taxs [] = array(
                'taxonomy' => 'portfolio-tag',
                'field'    => 'id',
                'terms'    => $ids
            );
        }

        if ($taxs) {
            $related_args = array(
                'post_type' => array($post->post_type),
                'tax_query' => $taxs,
                'post__not_in' => array($post->ID),
                'posts_per_page' => $limit
            );

            $related_posts = new WP_Query($related_args);
            if ($related_posts->have_posts()):

                $list_classes = array('kopa-related-post', 'portfolio-list');
                $list_classes[] = sprintf('portfolio-list-%d-items', $related_posts->post_count);
                
                ?>  
                <div class="<?php echo implode(' ', $list_classes); ?>">
                    <h4 class="widget-title style3"><?php echo apply_filters('divine_divine_get_related_posts_title', __('Related portfolio', divine_get_domain())); ?></h4>  
                    <div class="row">
                        <div class="owl-carousel owl-carousel-8">
                            <?php
                            while ($related_posts->have_posts()):
                                $related_posts->the_post();
                                $post_id = get_the_ID();
                                $post_url = get_permalink();
                                $post_title = get_the_title();
                                ?>
                                <div class="item">
                                    <article class="portfolio-item">
                                        <div class="portfolio-thumb">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php
                                                $image_full = divine_post_bfi_thumb($post_id, 'post-lightbox');
                                                $image      = divine_post_bfi_thumb($post_id, 'post-related');
                                                ?>
                                                <a href="<?php echo $post_url; ?>">
                                                    <img src="<?php echo $image; ?>" alt="<?php echo $post_title; ?>">
                                                </a>

                                                <div class="thumb-hover">
                                                    <ul class="clearfix">
                                                        <li><a href="<?php echo $image_full; ?>" class="group2 pf-gallery fa fa-search-plus" title="<?php echo $post_title; ?>"></a></li>
                                                        <li><a href="<?php echo $post_url; ?>" class="pf-detail fa fa-sign-out" title="<?php echo $post_title; ?>"></a></li>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <h6 class="portfolio-title"><a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a></h6>
                                        <span class="entry-date"><i class="fa fa-calendar"></i><span><?php echo get_the_date(); ?></span></span>
                                        <?php printf('<span>%s</span>', wp_trim_words( strip_shortcodes($post->post_content), 20)); ?>
                                    </article>  
                                </div>
                                <?php
                            endwhile;
                            ?>
                        </div>
                    </div>
                </div>                    
                <?php
            endif;
            wp_reset_postdata();
        }
    }
}

function register_metabox_custom_breadcrumb(){
    $args = array(
        'id'          => KOPA_PREFIX . 'metabox-custom-breadcrumb',
        'title'       => __('Breadcrumb', divine_get_domain()),
        'desc'        => '',
        'pages'       => array('post', 'page', 'portfolio'),
        'context'     => 'normal',
        'priority'    => 'low',
        'fields'      => array(               
            array(
                'title'   => __('Is hide breadcrumb', divine_get_domain()),
                'type'    => 'checkbox',
                'id'      => KOPA_PREFIX . 'breadcrumb-is-hide',
                'default' => 0
            ),      
            array(
                'title'   => __('Title', divine_get_domain()),
                'type'    => 'text',
                'id'      => KOPA_PREFIX . 'breadcrumb-title'
            ),
            array(
                'title'   => __('Description', divine_get_domain()),
                'type'    => 'textarea',
                'id'      => KOPA_PREFIX . 'breadcrumb-description',                
            ), 
            array(
                'title'   => __('Background image', divine_get_domain()),
                'type'    => 'upload',
                'id'      => KOPA_PREFIX . 'breadcrumb-background', 
                'desc'  => __('Please upload image with size 1364 x 115 (px)', divine_get_domain()),                             
            ),                  
        )
    );          
    
    kopa_register_metabox( $args );
}

function register_metabox_post_featured_content(){
    $post_type = array('post');
    
    if(class_exists('DVT_Portfolio')){
        array_push($post_type, 'portfolio');
    }        

    $args = array(
        'id'          => KOPA_PREFIX . 'post-options-metabox',
        'title'       => __('Featured content', divine_get_domain()),
        'desc'        => '',
        'pages'       => $post_type,
        'context'     => 'normal',
        'priority'    => 'low',
        'fields'      => array(                         
            array(
                'title'   => __('Gallery', divine_get_domain()),
                'type'    => 'gallery',
                'id'      => KOPA_PREFIX . 'gallery'
            ),
            array(
                'title'   => __('Custom', divine_get_domain()),
                'type'    => 'textarea',
                'id'      => KOPA_PREFIX . 'custom-content',
                'desc'  => __('Enter custom content as video, youtube, vimeo shortcode or custom HTML, ...', divine_get_domain()),
            ),                  
        )
    );          
    
    kopa_register_metabox( $args );
}

function  divine_edit_footer_sidebar($params){    
    if($effect = kopa_get_option('footer-effect', false)){
        $duration = kopa_get_option('footer-effect-duration', '0.5s');
        $delay    = kopa_get_option('footer-effect-delay', '0.5s');

        $str = sprintf('data-wow-duration="%s" data-wow-delay="%s" class="wow animated %s ', $duration, $delay, $effect);

        $params[0]['before_widget'] = str_replace("'", '"', $params[0]['before_widget']);
        $params[0]['before_widget'] = str_replace('class="', $str, $params[0]['before_widget']);        
    }


    return $params;   
}