
<!DOCTYPE html>
<html <?php language_attributes(); ?>>              
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />                   
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php wp_title('|', true, 'right'); ?></title>                
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />                       
        <?php wp_head(); ?>
    </head>    
    <body <?php body_class(); ?>>  
        <header class="kopa-page-header">
            <?php
            $header_info = kopa_get_option('header-info');
            $is_enable_top_social_links = kopa_get_option('is-enable-social-links');
            $is_enable_search_form = kopa_get_option('is-enable-search-form');
            ?>

            <?php if (!empty($header_info) || $is_enable_top_social_links || $is_enable_search_form): ?>
                <div class="kopa-header-top">
                    <div class="wrapper clearfix">
                        <?php if (!empty($header_info)): ?>
                            <div class="hotline-box pull-left">
                                <h6><?php echo $header_info; ?></h6>
                                <span class="triangle-wrapper"></span>
                                <span class="triangle"></span>
                                <div class="kopa-border-bottom"></div>
                            </div>                        
                            <div class="left-bg-color">
                                <div class="kopa-border-bottom"></div>
                            </div>
                            <?php
                        endif;
                        ?>                                            
                        <div class="ss-box pull-right clearfix">
                            <?php
                            if ($is_enable_top_social_links) {
                                divine_get_social_links();
                            }
                            ?>                          

                            <?php if ($is_enable_search_form): ?>
                                <div class="search-box pull-right clearfix">
                                    <?php get_search_form(); ?>
                                </div>
                            <?php endif; ?>                        
                        </div>
                    </div>                
                </div>  
            <?php endif; ?>

            <div class="kopa-header-bottom ">
                <div class="wrapper clearfix">                                        
                    <?php if ($logo = kopa_get_option('logo')): ?>
                        <div class="left-color-bg">
                            <div class="left-color-bg-outer"></div>
                            <div class="triangle"></div>
                        </div>
                        <div class="logo-box pull-left">
                            <a href="<?php echo home_url(); ?>"><img src="<?php echo do_shortcode($logo); ?>" alt="<?php bloginfo('name'); ?>"></a>
                        </div>                       
                    <?php endif; ?>
                    <?php
                    #TOP MENU
                    if (has_nav_menu('main-nav')) {
                        
                        wp_nav_menu(
                                array(
                                    'theme_location' => 'main-nav',
                                    'container' => 'nav',
                                    'container_id' => 'main-nav',
                                    'container_class' => 'main-nav pull-right',
                                    'menu_id' => 'main-menu',
                                    'menu_class' => 'main-menu clearfix'
                                )
                        );

                        echo '<nav class="main-nav-mobile clearfix">';

                        echo '<a class="pull"><span class="fa fa-align-justify"></span></a>';

                        wp_nav_menu(
                                array(
                                    'theme_location' => 'main-nav',
                                    'container' => FALSE,                                                                                                            
                                    'menu_class' => 'main-menu-mobile clearfix'
                                )
                        );
                        
                        echo '</nav>';
                    }
                    ?>                
                </div>                
            </div>    

            <?php if ($is_enable_top_social_links || $is_enable_search_form): ?>
                <div class="kopa-header-top-2">
                    <div class="wrapper clearfix">
                        <?php if ($is_enable_top_social_links) {
                            divine_get_social_links();
                        }
                        ?>

                        <?php if ($is_enable_search_form): ?>
                            <div class="search-box pull-right clearfix">
                                <?php get_search_form(); ?>
                            </div>                        
                        <?php endif; ?>
                    </div>                
                </div> 
            <?php endif; ?>

        </header>
        
        <?php
        $divine_layout_setting = kopa_get_template_setting();        
		$sb_right = $divine_layout_setting['sidebars']['pos_right'];        
        $wrap_classes = is_active_sidebar($sb_right) ? 'col-md-9 col-sm-9 col-xs-9' : 'col-md-12 col-sm-12 col-xs-12';                
        ?>
        
        <div class="bg-hb"></div>

        <?php divine_get_breadcrumb(); ?>

        <div id="main-content">
            <section class="kopa-area kopa-area-1">
                <div class="wrapper">
                    <div class="row">                        
                        <div class="kopa-main-col <?php echo $wrap_classes; ?>">