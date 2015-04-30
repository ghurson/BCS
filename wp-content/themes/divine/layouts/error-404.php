<?php
get_header();
?>
<div class="bg-hb"></div>

<?php divine_get_breadcrumb(); ?>

<div id="main-content" class="clearfix">
    <section class="error-404 clearfix">

        <div class="left-col">
            <p><?php _e('404', divine_get_domain()); ?></p>
        </div>
        <div class="right-col">
            <h1><?php _e('Page not found...', divine_get_domain()); ?></h1>
            <p><?php _e("We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of this options:", divine_get_domain()); ?></p>
            <ul class="arrow-list">
                <li><a href="javascript: history.go(-1);"><?php _e('Go back to previous page', divine_get_domain()); ?></a></li>
                <li><a href="<?php echo home_url(); ?>"><?php _e('Go to homepage', divine_get_domain()); ?></a></li>
            </ul>
        </div>

    </section>    
</div>
<?php
get_footer();
