<?php 
$divine_layout_setting = kopa_get_template_setting();        
$sb_right = $divine_layout_setting['sidebars']['pos_right'];
?>

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

<div class="mb-20"></div>

<?php divine_get_footer_social_links(); ?>

<div id="bottom-sidebar">
    <div class="wrapper">
        <div class="row">
            <?php
            #WIDGET AREA {FOOTER 1}
            $footer_1 = $divine_layout_setting['sidebars']['pos_footer_1'];
            if (is_active_sidebar( $footer_1)):                
                echo '<div class="col-md-4 col-sm-4">';
                dynamic_sidebar($footer_1);
                echo '</div>';                            
            endif;
            ?>

            <?php
            #WIDGET AREA {FOOTER 2}
            $footer_2 = $divine_layout_setting['sidebars']['pos_footer_2'];
            if (is_active_sidebar($footer_2)):               
                echo '<div class="col-md-2 col-sm-2">';
                dynamic_sidebar($footer_2);
                echo '</div>';                            
            endif;
            ?>

            <?php
            #WIDGET AREA {FOOTER 3}
            $footer_3 = $divine_layout_setting['sidebars']['pos_footer_3'];
            if (is_active_sidebar($footer_3)):                
                echo '<div class="col-md-2 col-sm-2">';
                dynamic_sidebar($footer_3);
                echo '</div>';                
            endif;
            ?>

            <?php
            #WIDGET AREA {FOOTER 4}
            $footer_4 = $divine_layout_setting['sidebars']['pos_footer_4'];
            if (is_active_sidebar($footer_4)):                
                echo '<div class="col-md-2 col-sm-2">';
                dynamic_sidebar($footer_4);
                echo '</div>';                            
            endif;
            ?>

            <?php
            #WIDGET AREA {FOOTER 5}
            $footer_5 = $divine_layout_setting['sidebars']['pos_footer_5'];
            if (is_active_sidebar($footer_5)):                
                echo '<div class="col-md-2 col-sm-2">';
                dynamic_sidebar($footer_5);
                echo '</div>';                            
            endif;
            ?>
        </div>
    </div>
</div>

<footer id="kopa-page-footer">
    <div class="wrapper clearfix">
        <?php if ($footer_info = kopa_get_option('footer-info')): ?>
            <p id="copyright" class="pull-left"><?php echo $footer_info; ?></p>
        <?php endif; ?>

        <?php
        #TOP MENU
        if (has_nav_menu('footer-nav')) {
            wp_nav_menu(
                    array(
                        'theme_location' => 'footer-nav',
                        'container' => 'nav',
                        'container_id' => 'footer-nav',
                        'container_class' => 'footer-nav pull-right',
                        'menu_id' => 'footer-menu',
                        'menu_class' => 'footer-menu clearfix'
                    )
            );
        }
        ?>       
    </div>
    <p id="back-top"><a href="#top"></a></p>
</footer>    
<?php wp_footer(); ?>
</body>
</html>