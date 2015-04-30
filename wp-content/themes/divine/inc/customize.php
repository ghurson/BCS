<?php

add_action( 'wp_head', 'divine_print_favicon', 11);

function divine_print_favicon(){
	if( $favicon = kopa_get_option('favicon'))
  		printf( '<link rel="shortcut icon" type="image/x-icon"  href="%s">', $favicon );  
}

add_action( 'wp_head', 'divine_print_apple_icon', 12);

function divine_print_apple_icon(){	
    if ($apple_icon = kopa_get_option('apple-icon')) {
	    $apple_icon = do_shortcode($apple_icon);
	    foreach (array(60, 76, 120, 152) as $size) {
	    	$tmp = bfi_thumb($apple_icon, array('width' => $size, 'height' => $size, 'crop' => true));
	        printf('<link rel="apple-touch-icon" sizes="%1$sx%1$s" href="%2$s">', $size, $tmp);
		}
	}
}

add_filter('divine_breadcrumb_site_title', 'divine_customize_breadcrumb_title', 20);

function divine_customize_breadcrumb_title($title){
	if(is_single() || is_page() || is_singular('portfolio')){
		global $post;
		if($custom_title = get_post_meta($post->ID, KOPA_PREFIX . 'breadcrumb-title', true)){
			$title = $custom_title;
		}
	}

	return $title;
}

add_filter('divine_breadcrumb_site_desc', 'divine_customize_breadcrumb_desc', 20);

function divine_customize_breadcrumb_desc($desc){
	if(is_single() || is_page() || is_singular('portfolio')){
		global $post;
		if($custom_desc = get_post_meta($post->ID, KOPA_PREFIX . 'breadcrumb-description', true)){
			$desc = $custom_desc;
		}
	}
	return $desc;
}

add_action('wp_enqueue_scripts', 'divine_customize_breadcrumb_enqueue_scripts', 11);

function divine_customize_breadcrumb_enqueue_scripts(){
	$image = '';

	if($tmp = kopa_get_option('breadcrumb-background-image', false)){
		$image = divine_bfi_thumb($tmp, NULL, 1364, 115, TRUE);
	}

	if(is_single() || is_page() || is_singular('portfolio')){
		global $post;
		if($tmp = get_post_meta($post->ID, KOPA_PREFIX . 'breadcrumb-background', true)){
			$image = divine_bfi_thumb($tmp, NULL, 1364, 115, TRUE);	
		}
	}

	if(!empty($image)){
		$style = sprintf(".kopa-breadcrumb { background-image: url('%s')}", $image);
		wp_add_inline_style(KOPA_PREFIX . 'style', $style);
	}
}

add_action('wp_enqueue_scripts', 'divine_customize_color_enqueue_scripts', 12);

function divine_customize_color_enqueue_scripts(){
	if(1 == (int) kopa_get_option('is-enable-custom-color', 0)){
		$style = '
			::selection{
			  background: %1$s;
			}
			::-moz-selection{
			  background: %1$s;
			}
			blockquote:before, .txt-highlight, 
			.kopa-toggle-widget .panel-group .panel .panel-heading, 
			.column.active .title-row, .column.active .footer-row .pt-btn, .column ul li.title-row span, .column ul li.pricing-row, .column ul li.footer-row .pt-btn:hover, 
			.kopa-tab-2-widget .nav-tabs li > a:hover, .kopa-tab-2-widget .nav-tabs li.active > a, .kopa-tab-2-widget .nav-tabs li.active > a:hover, .kopa-tab-2-widget .nav-tabs li.active > a:focus, .kopa-dropcap, .progress .progress-bar-danger, .kopa-button, .color-button, .border-button:hover, .span-button span, 
			.kopa-header-bottom .wrapper .left-color-bg, .kopa-header-bottom .wrapper .left-color-bg .left-color-bg-outer, 
			.bg-feature span, .home-slider-widget .kopa-home-slider .flex-direction-nav li:hover, .home-slider-2-widget .kopa-home-slider .flex-direction-nav li:hover, 
			.kopa-home-slider-4-widget .kopa-home-slider .flex-direction-nav li:hover, .owl-theme .owl-controls .owl-buttons div:hover, .home-slider-2-widget .entry-item .entry-content .entry-title, .home-slider-2-widget .owl-theme .owl-controls:before, .article-list-0 ul li .entry-item .entry-content header, .article-list-0 ul li .entry-item .entry-content .entry-title span, .kopa-testimonial-widget .widget-title, .owl-theme .owl-controls .owl-page.active span, .owl-theme .owl-controls .owl-page:hover span, .kopa-tagline-widget .tagline-left, .portfolio-list .portfolio-item .portfolio-thumb .thumb-hover ul li a, .kopa-newsletter-widget .newsletter-form .input-email .submit, .sv-icon, .widget-title.style1, .entry-date.style1 > span.entry-day, .kopa-portfolio-2-widget .portfolio-list-item .portfolio-item:hover .portfolio-thumb .thumb-icon:hover, 
			.filters-options li:before, .filters-options2 li:before, 
			.filters-options li:after, .filters-options2 li:after,  
			.filters-options li:before, .filters-options2 li:after, 
			.widget-title.style3:before, 
			.widget-title.style5:before, .kopa-team-widget .owl-carousel-4 .entry-content > header:before, .kopa-team-widget .owl-carousel-4 .owl-controls .owl-buttons div:hover, .kopa-loadmore span:hover, .widget-title.style4:before, .pagination ul li .current, #back-top a, .kopa-pagination ul li:hover, .kopa-pagination ul li.current, .slider-intro-2, .slider-link > a:hover, .right-area, .right-area:before,  .kopa-social-link-widget .social-links li a:hover, .product-info > ul > li.cl-border:hover > a, .woocommerce ul.products > li .onsale, .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products > li .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce input#submit, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page input#submit, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input#submit.alt, .woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page input#submit.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce nav.woocommerce-pagination ul li:hover a, .woocommerce nav.woocommerce-pagination ul li.current a, .woocommerce #content nav.woocommerce-pagination ul li:hover a, .woocommerce #content nav.woocommerce-pagination ul li.current a, .woocommerce-page nav.woocommerce-pagination ul li:hover a, .woocommerce-page nav.woocommerce-pagination ul li.current a, .woocommerce-page #content nav.woocommerce-pagination ul li:hover a, .woocommerce-page #content nav.woocommerce-pagination ul li.current a, .woocommerce nav.woocommerce-pagination ul li.current span, .woocommerce #content nav.woocommerce-pagination ul li.current span, .woocommerce-page nav.woocommerce-pagination ul li.current span, .woocommerce-page #content nav.woocommerce-pagination ul li.current span, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .contact-button > span input, .social-links.style2 > li:hover, .kopa-author .author-social-link .social-filter > div > a, .kopa-author .author-social-link .social-filter ul li, .panel-group .panel .panel-heading > .panel-title a .b-collapse{
			    background: %1$s;
			}
			a:hover, a:active, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .h1 a:hover, .widget-title.style2 a:hover, .h2 a:hover, .h3 a:hover, .h4 a:hover, .kopa-portfolio-widget .widget-title a:hover, .widget-title.style4 a:hover, .h5 a:hover, .h6 a:hover, .filters-options li a:hover, .filters-options2 li a:hover, .kopa-loadmore span a:hover, .txt-decoration-2, .column.active .pricing-row span, .column ul li.title-row, .column ul li.footer-row .pt-btn, .border-button, .color-button:hover, .social-links li a:hover, .search-box .search-form .search-submit:hover, .main-nav-mobile .main-menu-mobile > li > a:hover, .main-nav-mobile .main-menu-mobile > li .sub-menu li a:hover,
			.widget_categories > ul > li:hover:before, .widget_categories ul.menu > li:hover:before,
			    .widget_recent_entries > ul > li:hover:before,
			    .widget_recent_entries ul.menu > li:hover:before,
			    .widget_archive > ul > li:hover:before,
			    .widget_archive ul.menu > li:hover:before,
			    .widget_meta > ul > li:hover:before,
			    .widget_meta ul.menu > li:hover:before,
			    .widget_nav_menu > ul > li:hover:before,
			    .widget_nav_menu ul.menu > li:hover:before,
			    .widget_pages > ul > li:hover:before,
			    .widget_pages ul.menu > li:hover:before,
			    .widget_recent_comments > ul > li:hover:before,
			    .widget_recent_comments ul.menu > li:hover:before,
			    .widget_rss > ul > li:hover:before,
			    .widget_rss ul.menu > li:hover:before,
			    .widget_rss > ul > li a,
			    .post-date, .widget_calendar thead th, .widget_calendar tbody a, #bottom-sidebar a:hover,
			     #bottom-sidebar .widget_categories > ul > li:hover:before, #bottom-sidebar .widget_categories ul.menu > li:hover:before,
			    #bottom-sidebar .widget_recent_entries > ul > li:hover:before,
			    #bottom-sidebar .widget_recent_entries ul.menu > li:hover:before,
			    #bottom-sidebar .widget_archive > ul > li:hover:before,
			    #bottom-sidebar .widget_archive ul.menu > li:hover:before,
			    #bottom-sidebar .widget_meta > ul > li:hover:before,
			    #bottom-sidebar .widget_meta ul.menu > li:hover:before,
			    #bottom-sidebar .widget_nav_menu > ul > li:hover:before,
			    #bottom-sidebar .widget_nav_menu ul.menu > li:hover:before,
			    #bottom-sidebar .widget_pages > ul > li:hover:before,
			    #bottom-sidebar .widget_pages ul.menu > li:hover:before,
			    #bottom-sidebar .widget_recent_comments > ul > li:hover:before,
			    #bottom-sidebar .widget_recent_comments ul.menu > li:hover:before,
			    #bottom-sidebar .widget_rss > ul > li:hover:before,
			    #bottom-sidebar .widget_rss ul.menu > li:hover:before, 
			    #bottom-sidebar .widget_rss .menu-testing-menu-container > ul > li:hover:before ,
			    .home-slider-widget .kopa-home-slider .entry-item .slider-caption h2 a:hover, .home-slider-2-widget .kopa-home-slider .entry-item .slider-caption h2 a:hover, .kopa-home-slider-4-widget .kopa-home-slider .entry-item .slider-caption h2 a:hover,
			    .home-slider-2-widget .owl-theme .owl-controls .owl-buttons div, .home-slider-2-widget .owl-theme .owl-controls .owl-buttons div:hover, 
			    .kopa-testimonial-widget .item footer a, .kopa-tagline-widget .tagline-right a:hover, 
			    .kopa-portfolio-widget .author-info .social-links li:hover a, 
			    #bottom-sidebar .widget .textwidget > ul > li a:hover, .sv-icon:hover, 
			    .article-list-1 .entry-content > p span, .twitter-icon, 
			    .kopa-twitter-widget > ul > li .twitter-content span a, 
			    .kopa-twitter-widget .owl-carousel .item > ul > li .twitter-content span a, 
			    .kopa-blog-masonry-widget .ms-item1 .entry-item .entry-content .entry-title a:hover, 
			    .kopa-testimonial-2-widget .item > p:before, 
			    .kopa-testimonial-2-widget .item > p:after, .filters-options li.active, 
			    .filters-options li:hover, .filters-options2 li.active, .filters-options2 li:hover, 
			    .kopa-mission-list li span:first-child, 
			    .kopa-team-widget .owl-carousel-4 .entry-thumb .thumb-hover > ul > li a:hover, 
			    .more-link, .entry-author:hover, .entry-comments:hover, 
			    .entry-categories:hover, .entry-meta > span a:hover, .entry-meta > p a:hover, 
			    .slider-caption, #bottom-sidebar address a:hover, address p > i, .kopa-rating li, 
			    .product-info > ul > li > a:hover i, .product-info > ul > li.cl-border > a > i, 
			    .owl-carousel-9 .owl-controls .owl-buttons div:hover, 
			    .woocommerce ul.products > li .price, .woocommerce ul.products li.product .price, 
			    .woocommerce-page ul.products > li .price, .woocommerce-page ul.products li.product .price, 
			    .woocommerce a.button:before, .woocommerce button.button:before, .woocommerce input.button:before, .woocommerce input#submit:before, .woocommerce #content input.button:before, .woocommerce #respond input#submit:before, .woocommerce-page a.button:before, .woocommerce-page button.button:before, .woocommerce-page input.button:before, .woocommerce-page input#submit:before, .woocommerce-page #content input.button:before, .woocommerce-page #respond input#submit:before, .contact-box label.error, #respond label.error, .contact-button > span:hover input, .contact-button > span:hover:before, .social-links.style3 > li:hover > a, #comments .comments-list .comment .comment-wrap .media-body > header .comment-button .comment-reply-link, #comments .comments-list .comment .comment-wrap .media-body > header .comment-button .comment-edit-link, .error-404 .left-col p, .error-404 .right-col h1, .error-404 .right-col a:hover, #kopa-page-footer a:hover, .kopa-toggle-widget .panel-group .panel .panel-heading > .panel-title a .b-collapse   {
			    color: %1$s;
			}
			.column ul li.footer-row .pt-btn, .kopa-tab-2-widget .nav-tabs li > a:hover, .kopa-tab-2-widget .nav-tabs li.active > a, .kopa-tab-2-widget .nav-tabs li.active > a:hover, .kopa-tab-2-widget .nav-tabs li.active > a:focus, .progress.bar-danger, .color-button, .border-button:hover, .border-button, .color-button:hover, .span-button, .home-slider-2-widget .owl-theme .owl-controls, .owl-theme .owl-controls .owl-page span, .kopa-portfolio-widget .author-info .social-links li:hover, .sv-icon, .kopa-team-widget .owl-carousel-4 .owl-controls .owl-buttons div:hover, .kopa-event-widget .kopa-event-content .event-post-content > ul > li .entry-item > span.entry-icon:before, .pagination ul li .current, .kopa-pagination ul li:hover, .kopa-pagination ul li.current, .slider-link > a:hover, .kopa-social-link-widget .social-links li a:hover, .product-info > ul > li.cl-border, .kopa-brand-widget .brand-link:hover, .owl-carousel-9 .owl-controls .owl-buttons div:hover, .woocommerce nav.woocommerce-pagination ul li:hover a, .woocommerce nav.woocommerce-pagination ul li.current a, .woocommerce #content nav.woocommerce-pagination ul li:hover a, .woocommerce #content nav.woocommerce-pagination ul li.current a, .woocommerce-page nav.woocommerce-pagination ul li:hover a, .woocommerce-page nav.woocommerce-pagination ul li.current a, .woocommerce-page #content nav.woocommerce-pagination ul li:hover a, .woocommerce-page #content nav.woocommerce-pagination ul li.current a, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-message, .woocommerce-page .woocommerce-error, .woocommerce-page .woocommerce-info, .contact-box input:focus, .contact-box textarea:focus, #respond input:focus, #respond textarea:focus, .contact-button > span input {
			  border-color: %1$s;
			}
			.contact-button > span input{
			  border-color: %1$s !important; 
			}
			.contact-button > span:hover input{
			  color: %1$s !important;
			}
			.nav-tabs li > a:hover, .nav-tabs li.active > a, .nav-tabs li.active > a:hover, .nav-tabs li.active > a:focus, .kopa-header-bottom .wrapper .left-color-bg .triangle {
			  border-top-color: %1$s;
			}
			.kopa-tagline-widget .tagline-left .triangle{
			  border-left-color: %1$s;
			}
			.right-area:after{
			  border-right-color: %1$s;
			}


			/* ----------------------------------- */

			.b-line, .txt-decoration, body, .main-nav-mobile .main-menu-mobile > li .sub-menu li a, .widget_categories select, .widget_archive select, .widget_nav_menu select,
			.widget_pages select, .widget_recent_comments select, .widget_rss select, .textwidget select, .widget_calendar caption, .widget_calendar tbody td, .widget_calendar thead th, .widget_search form.search-form input, .widget_search form.search-form .search-submit, .kopa-twitter-widget > ul > li .twitter-content > a, .kopa-twitter-widget .owl-carousel .item > ul > li .twitter-content > a, .filters-options li, .filters-options2 li, .kopa-team-widget .owl-carousel-4 .owl-controls .owl-buttons div, .article-list-3 .entry-date > i, .entry-meta > span a, .entry-meta > p a, .kopa-breadcrumb .pull-right > span > a, .kopa-breadcrumb .pull-right .current-page span, .woocommerce-checkout .form-row .chosen-container-single .chosen-single, .input-label > span, .textarea-label > span, .social-links.style2 > li > a, .kopa-tag-box a, .social-links.style3 > li > a,
			.owl-carousel-8.owl-theme .owl-controls .owl-buttons div, .owl-theme.owl-carousel-9 .owl-controls .owl-buttons div, .kopa-related-post .portfolio-item > span.entry-date, .kopa-related-post .portfolio-item > span.entry-date > i, #comments .comments-list .comment .comment-wrap .media-body > header .pull-left span, .single-other-post .fa {
			    color: %2$s;
			}
			  .b-line span:first-child, .kopa-dropcap.dc3 {
			    background: %2$s;
			}
			#bottom-sidebar .widget_calendar, #bottom-sidebar .widget_calendar caption, #bottom-sidebar .widget_calendar tfoot, #bottom-sidebar .widget_calendar thead th, #bottom-sidebar .widget_calendar tfoot td a, #bottom-sidebar .widget_calendar tbody td, 
			#bottom-sidebar .widget_categories > ul > li, #bottom-sidebar .widget_categories ul.menu > li,
			  #bottom-sidebar .widget_recent_entries > ul > li,
			  #bottom-sidebar .widget_recent_entries ul.menu > li,
			  #bottom-sidebar .widget_archive > ul > li,
			  #bottom-sidebar .widget_archive ul.menu > li,
			  #bottom-sidebar .widget_meta > ul > li,
			  #bottom-sidebar .widget_meta ul.menu > li,
			  #bottom-sidebar .widget_nav_menu > ul > li,
			  #bottom-sidebar .widget_nav_menu ul.menu > li,
			  #bottom-sidebar .widget_pages > ul > li,
			  #bottom-sidebar .widget_pages ul.menu > li,
			  #bottom-sidebar .widget_recent_comments > ul > li,
			  #bottom-sidebar .widget_recent_comments ul.menu > li,
			  #bottom-sidebar .widget_rss > ul > li,
			  #bottom-sidebar .widget_rss ul.menu > li, 
			  #bottom-sidebar .widget_rss ul li, #bottom-sidebar .textwidget, #bottom-sidebar .textwidget p strong, #bottom-sidebar .textwidget > ul > li a,
			  #bottom-sidebar .tagcloud a, .kopa-home-slider-4-widget .slider .fraction-slider .prev, .kopa-home-slider-4-widget .slider .fraction-slider .next, .kopa-social-link-widget .social-links li a, .product-info > ul > li > a, .article-list-4 .entry-item .entry-content .entry-date > i, 
			  .woocommerce .upsells.products .products > li .price del, .woocommerce .upsells.products .products li.product .price del,
			      .woocommerce ul.products > li .price del,
			      .woocommerce ul.products li.product .price del, .woocommerce-page .upsells.products .products > li .price del, .woocommerce-page .upsells.products .products li.product .price del,
			      .woocommerce-page ul.products > li .price del,
			      .woocommerce-page ul.products li.product .price del,
			      .contact-box input, .contact-box textarea, #respond input, #respond textarea
			      {
			    border-color: %2$s;
			}


			/* ----------------------------------- */


			.kopa-testimonial-2-widget .item > p, .kopa-testimonial-2-widget .item .tes-author span{
			    color: %3$s;
			}


			/* ----------------------------------- */

			.kopa-event-widget .kopa-event-content .kopa-line {
			    background: %4$s; 
			}


			/* ----------------------------------- */

			.slide-link, .slide-intro, .slide-caption {
			  color: %5$s;
			}
			.slide-intro:before {
			    background: %5$s;
			}
			.slide-link {
			  border-color: %5$s;
			}


			/* ----------------------------------- */

			.kopa-testimonial-3-widget .item .tes-author > p {
			      color: %6$s; 
			}


			/* ----------------------------------- */

			.home-slider-2-widget .owl-theme .owl-controls {
			    box-shadow: 0px 1px 10px %7$s; 
			}


			/* ----------------------------------- */

			.entry-date.style1 > span.entry-month {
			    background: %8$s;
			}


			/* ----------------------------------- */

			.entry-date i {
			  color: %9$s; 
			}


			/* ----------------------------------- */

			.article-list-2 .entry-item .entry-date, .article-list-2 .entry-item .entry-date > i, #comments .comments-list .comment .comment-wrap .media-body > header .comment-button .comment-number {
			  color: %10$s; 
			}


			/* ----------------------------------- */


			.kopa-newsletter-widget .newsletter-form .input-email .email, .kopa-newsletter-widget .news-icon {
			    background: %11$s;
			}
			.kopa-newsletter-widget .newsletter-form .input-email .email {
			    border-color: %11$s;
			}


			/* ----------------------------------- */

			a, h1, h2, h3, h4, h5, h6, .h1, .widget-title.style2, .h2, .h3, .h4, .kopa-portfolio-widget .widget-title, .widget-title.style4, .h5, .h6, .filters-options li, .filters-options2 li, .kopa-loadmore span, .element-title, blockquote, .kopa-portfolio-widget .author-info .social-links li a, .kopa-twitter-widget > ul > li .twitter-content span, .kopa-twitter-widget .owl-carousel .item > ul > li .twitter-content span, .kopa-twitter-widget > ul > li .twitter-content span a:hover, .kopa-twitter-widget .owl-carousel .item > ul > li .twitter-content span a:hover, .kopa-mission-list li, .kopa-breadcrumb .pull-left span, address, .input-label p:first-child, .textarea-label, .porfolio-meta > p > span, .kopa-tag-box span, .kopa-share-post, .kopa-author .author-content > header .author-job, .kopa-author .author-social-link > div > span, 
			#comments .comments-list .comment .comment-wrap .media-body > header .comment-button .comment-reply-link:hover, #comments .comments-list .comment .comment-wrap .media-body > header .comment-button .comment-edit-link:hover, #comments .comments-list .comment .comment-wrap .media-body > p, .error-404 .right-col a, .c-title, .panel-group .panel .panel-heading > .panel-title a, .column ul li, .nav-tabs li > a, .nav-tabs li > a:hover, .kopa-dropcap.dc2, .main-nav-mobile .main-menu-mobile > li > a, 
			.widget_categories > ul > li, .widget_categories ul.menu > li,
			  .widget_recent_entries > ul > li,
			  .widget_recent_entries ul.menu > li,
			  .widget_archive > ul > li,
			  .widget_archive ul.menu > li,
			  .widget_meta > ul > li,
			  .widget_meta ul.menu > li,
			  .widget_nav_menu > ul > li,
			  .widget_nav_menu ul.menu > li,
			  .widget_pages > ul > li,
			  .widget_pages ul.menu > li,
			  .widget_recent_comments > ul > li,
			  .widget_recent_comments ul.menu > li,
			  .widget_rss > ul > li,
			  .widget_rss ul.menu > li, 
			  .widget_categories > ul > li:before, .widget_categories ul.menu > li:before,
			    .widget_recent_entries > ul > li:before,
			    .widget_recent_entries ul.menu > li:before,
			    .widget_archive > ul > li:before,
			    .widget_archive ul.menu > li:before,
			    .widget_meta > ul > li:before,
			    .widget_meta ul.menu > li:before,
			    .widget_nav_menu > ul > li:before,
			    .widget_nav_menu ul.menu > li:before,
			    .widget_pages > ul > li:before,
			    .widget_pages ul.menu > li:before,
			    .widget_recent_comments > ul > li:before,
			    .widget_recent_comments ul.menu > li:before,
			    .widget_rss > ul > li:before,
			    .widget_rss ul.menu > li:before, 
			    .tagcloud, .tagcloud a:hover, 
			    .kopa-portfolio-widget .author-info header strong, .kopa-portfolio-widget .author-info p, .kopa-portfolio-widget .author-info .social-links li a, 
			    .kopa-twitter-widget > ul > li .twitter-content span, .kopa-twitter-widget .owl-carousel .item > ul > li .twitter-content span, .txt-color {
			    color: %12$s; 
			}
			.nav-tabs li > a, .nav-tabs li > a:hover, .nav-tabs li.active > a, .nav-tabs li.active > a:hover, .nav-tabs li.active > a:focus  {
			    color: %12$s !important; 
			}
			.widget-title.style5:before, .kopa-author .author-social-link .social-filter > div > a:hover, .kopa-author .author-social-link .social-filter ul li:hover, .txt-highlight-2  {
			    background: %12$s; 
			}
			.tagcloud a:hover{
			    border-color: %12$s;
			}


			/* ----------------------------------- */

			blockquote, .panel-group, .column ul li, .nav-tabs li > a, .tab-content, .kopa-tab-2-widget .nav-tabs li > a, .kopa-divider, .main-menu > li ul li, 
			.widget_categories select, .widget_archive select, .widget_nav_menu select,
			.widget_pages select, .widget_recent_comments select, .widget_rss select, .textwidget select, .widget_search form.search-form .search-text, .widget_search form.search-form input, .widget_search form.search-form .search-submit, .kopa-testimonial-widget, .kopa-portfolio-widget .author-info .social-links li, .kopa-service-2-widget .entry-item, .article-list-1 > ul > li, .twitter-icon, .kopa-team-widget .owl-carousel-4 .owl-controls .owl-buttons div, .kopa-event-widget .kopa-event-content .event-post-content > ul > li .entry-item, .pagination ul li span, .kopa-author, .kopa-author .author-social-link .social-filter > div, .kopa-author .author-social-link .social-filter ul {
			    border-color: %13$s;
			}
			.kopa-toggle-widget .panel-group .panel .panel-body {
			      border-color: %13$s !important; 
			}
			.panel-group .panel .panel-heading, .main-nav-mobile .main-menu-mobile > li, .main-nav-mobile .main-menu-mobile > li .sub-menu li, .widget_calendar tfoot, .kopa-twitter-widget > ul > li, .kopa-twitter-widget .owl-carousel .item > ul > li, .kopa-loadmore span, .kopa-loadmore span:after, .pagination ul li a, .kopa-tag-box, #comments .kopa-pagination, .single-other-post {
			    border-top-color: %13$s;
			}
			.element-title, .column.active .pricing-row, 
			.widget_categories,
			.widget_recent_entries,
			.widget_archive,
			.widget_meta,
			.widget_nav_menu,
			.widget_pages,
			.widget_recent_comments,
			.widget_rss,
			.widget_calendar caption, .widget_calendar tbody td, .widget_calendar thead th, .article-list-0 ul li .entry-item , .kopa-service-widget .service-item, .widget-title.style4, .article-list-3 > ul > li, .kopa-entry-list > ul > li, .kopa-entry-post > ul > li, .kopa-tag-box, .kopa-author .author-content > header, .kopa-entry-post > article, .kopa-related-post, #comments .comments-list .children:before {
			    border-bottom-color: %13$s;
			}
			.kopa-event-widget .kopa-event-content .event-post-content > ul > li .entry-item > span.triggle{
			    border-left-color: %13$s;
			}
			.kopa-event-widget .kopa-event-content .event-post-content > ul > li.right-content .entry-item > span.triggle {
			    border-right-color: %13$s;
			}
			blockquote.style-2:before {
			    background: %13$s;
			}


			/* ----------------------------------- */

			#bottom-sidebar .widget_categories,
			#bottom-sidebar .widget_recent_entries,
			#bottom-sidebar .widget_archive,
			#bottom-sidebar .widget_meta,
			#bottom-sidebar .widget_nav_menu,
			#bottom-sidebar .widget_pages,
			#bottom-sidebar .widget_recent_comments,
			#bottom-sidebar .widget_rss {
			  border-bottom-color: %14$s; 
			}


			/* ----------------------------------- */

			.tagcloud a, .kopa-pagination ul li, .product-info > ul > li, .kopa-brand-widget .brand-link, .woocommerce .woocommerce-result-count select, .woocommerce .woocommerce-ordering select, .woocommerce-page .woocommerce-result-count select, .woocommerce-page .woocommerce-ordering select, 
			.woocommerce nav.woocommerce-pagination ul li:first-child, .woocommerce #content nav.woocommerce-pagination ul li:first-child, .woocommerce-page nav.woocommerce-pagination ul li:first-child, .woocommerce-page #content nav.woocommerce-pagination ul li:first-child, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span, .woocommerce #content nav.woocommerce-pagination ul li a, .woocommerce #content nav.woocommerce-pagination ul li span, .woocommerce-page nav.woocommerce-pagination ul li a, .woocommerce-page nav.woocommerce-pagination ul li span, .woocommerce-page #content nav.woocommerce-pagination ul li a, .woocommerce-page #content nav.woocommerce-pagination ul li span, 
			.woocommerce table.shop_table, .woocommerce-page table.shop_table, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th, .woocommerce-page table.shop_table tfoot td, .woocommerce-page table.shop_table tfoot th, .woocommerce-checkout input, .woocommerce-checkout textarea, .woocommerce-checkout .form-row .chosen-container-single .chosen-single, .contact-box input, .contact-box textarea, #respond input, #respond textarea, .social-links.style3 > li, .owl-carousel-8.owl-theme .owl-controls .owl-buttons div, .owl-theme.owl-carousel-9 .owl-controls .owl-buttons div, .single-other-post .fa {
			    border-color: %15$s;
			}


			/* ----------------------------------- */


			.kopa-header-top .wrapper .hotline-box {
			    border-right-color: %16$s; 
			}
			.kopa-header-top .wrapper .hotline-box .triangle-wrapper {
			    border-top-color: %16$s;
			}


			/* ----------------------------------- */

			body {
			    background: %17$s;
			}


			/* ----------------------------------- */

			.kopa-header-bottom, .bg-feature, .kopa-testimonial-widget .owl-controls .owl-buttons div, .kopa-testimonial-widget .owl-controls .owl-buttons div:hover, .kopa-tagline-widget .tagline-right, .left-area, .left-area:before, 
			.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce input#submit:hover, .woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover {
			    background: %18$s;
			}
			.left-area:after {
			    border-top-color: %18$s;
			}


			/* ----------------------------------- */

			#bottom-sidebar, .kopa-area-3 {
			    background: %19$s;
			}


			/* ----------------------------------- */

			#kopa-page-footer, #back-top a:hover {
			    background: %20$s;
			}


			/* ----------------------------------- */

			.kopa-header-top .wrapper .left-bg-color, .kopa-header-top .wrapper .hotline-box {
			    background: %21$s;
			}
			.kopa-header-top .wrapper .hotline-box .triangle {
			    border-top-color: %21$s;
			}


			/* ----------------------------------- */

			.search-box .search-form .search-text, 
			.main-nav-mobile .main-menu-mobile > li .sub-menu li:hover, 
			.kopa-area-2, .kopa-event-widget .kopa-event-content .kopa-line:before, 
			.kopa-event-widget .kopa-event-content .kopa-line:after, 
			.kopa-event-widget .kopa-event-content .event-post-content > ul > li .entry-item > span.entry-icon, .slider, .social-links.style2 > li, .kopa-author, .column, .column.active .pricing-row   {
			    background: %22$s;
			}
			.kopa-tagline-widget .tagline-right .triangle{
			    border-left-color: %22$s;
			}


			/* ----------------------------------- */

			.kopa-parallax .kopa-bg {
			    background: %23$s;
			}

			.kopa-social-link-widget .social-links li a:hover{
			    color: %11$s;
			}
			.kopa-tagline-widget .tagline-left p{
			    color: %2$s;
			}
			.entry-date.style1 > span.entry-day { %24$s;}

			.kopa-home-parallax .kopa-header-top .wrapper .left-bg-color,
			.kopa-home-parallax .kopa-header-top .wrapper .hotline-box {
			    background-color: %8$s;
			}
			.kopa-home-parallax .kopa-header-top .wrapper .hotline-box .triangle{
			    border-top-color: %8$s;
			}
			.kopa-tagline-2-widget .tagline-right{
			    background-color: %8$s;
			}
			.kopa-tagline-2-widget .tagline-left{
			    background-color: %1$s;
			}
			.kopa-tagline-2-widget .tagline-left > span .fa-comment{
			    color: %8$s;
			}
			.kopa-header-bottom.fixed{
			    background-color: %1$s !important;
			}
			.kopa-home-parallax .kopa-header-bottom .main-nav:before{
			    border-right-color: %1$s !important;
			}
			.kopa-home-parallax .kopa-header-bottom .main-nav:after{
			    background-color: %1$s !important;
			}
			.kopa-home-parallax .kopa-header-bottom .main-nav{
			    background-color: %1$s !important;
			}

			.home-slider-widget .kopa-home-slider .flex-direction-nav li, .home-slider-2-widget .kopa-home-slider .flex-direction-nav li, .kopa-home-slider-4-widget .kopa-home-slider .flex-direction-nav li {
			    background-color: %8$s;
			}

			@media screen and (max-width: 1160px){
			    .kopa-header-top .wrapper .hotline-box {
			        background: #f1f1f1;
			    }
			}
			@media screen and (max-width: 1160px){
			    .kopa-header-top .wrapper .hotline-box {
			        border-color: #d1d1d1;
			    }
			}
			@media screen and (max-width: 719px) {
			    .left-area:after {
			        background: #2a3342;
			    }
			    .kopa-area-3 {
			        background: #2a3342
			    }
			}
			@media screen and (max-width: 719px) {
			    .right-area:after {
			        background: %1$s;
			    }
			    .kopa-area-3:before {
			        background: %1$s;
			    }
			}
			@media screen and (max-width: 719px) {
			    .kopa-social-link-widget .social-links li a:hover {
			        color: #fff; 
			    }
			}
			.home-slider-2-widget .owl-theme .owl-controls{
				box-shadow: none;
			}
			.widget.home-slider-2-widget .owl-buttons .fa:hover{
				color: #FFF !important;
			}
			.pagination.kopa-comment-pagination .page-numbers {			    
			    border: 1px solid %4$s;
			}

		    .pagination.kopa-comment-pagination .page-numbers.current {
		    	background-color: %1$s;
		    	border-color:  %1$s;
		    }
			';    

		$primary_color   = kopa_get_option('color-primary', '#0088b2');
		$secondary_color = kopa_get_option('color-secondary', '#888888');

		$style = sprintf($style, 
			$primary_color, //'#008bc4',//  1 $color-hover
			$secondary_color, //'#888888',//  2 $color
			'#555555',//  3 $color2
			'#dadada',//  4 $color3
			'#3a4245',//  5 $color4
			'#c1c1c1',//  6 $color5
			'#045678',//  7 $color-hover2
			divine_adjust_color_lighten_darken($primary_color, 30), //'#0879a7',//  8 $color-hover3
			'#9ed3e9',//  9 $color-hover4
			divine_adjust_color_lighten_darken($secondary_color, 30), //'#7e95a8',//  10 $color-hover5
			divine_adjust_color_lighten_darken($primary_color, 30),   //'#1779a0',//  11 $color-hover6
			'#333333',//  12 $color-heading
			'#e8e8e8',//  13 $border-01
			'#3f3f3f',//  14 $border-02
			'#d0d0d0',//  15 $border-03
			'#d1d1d1',//  16 $border-04
			'#fafafa',//  17 $bg-01
			divine_adjust_color_lighten_darken($primary_color, 60), //'#1a3342',//  18 $bg-02
			'#28292d',//  19 $bg-03
			'#111111',//  20 $bg-04
			'#f1f1f1',//  21 $bg-05
			'#f6f6f6',//  22 $bg-06
			'#031f34',//  23 $bg-07,
			divine_get_text_shadow(40, divine_adjust_color_lighten_darken($primary_color, 30))
        );

		wp_add_inline_style(KOPA_PREFIX . 'style', $style);
	}
}

add_action('wp_enqueue_scripts', 'divine_customize_font_enqueue_scripts', 13);

function divine_customize_font_enqueue_scripts(){
	$fonts = divine_get_site_elements();
    
    $google_font_in_use = array();
    $custom_font_in_use = array();
    $css = array();

    
    $google_fonts = kopa_google_font_options();
    $custom_fonts = (array) get_theme_mod( 'custom_fonts' );

    foreach ($fonts as $key => $font) {
        if(1 == (int) kopa_get_option( "is-enable-custom-font-{$key}", 0 ) ){
            $tmp = kopa_get_option("{$key}_font");
            $tmp_css = array();                    

            if( !empty( $tmp['style'] ) ){
                switch ($tmp['style']) {
                    case '300italic':
                        $tmp_css[] = sprintf('font-weight: %s;', 300);
                        $tmp_css[] = sprintf('font-style: %s;', 'italic');
                        break;
                    case 'regular':
                        $tmp_css[] = sprintf('font-weight: %s;', 400);
                        $tmp_css[] = sprintf('font-style: %s;', 'normal');
                        break;
                    case 'italic':
                        $tmp_css[] = sprintf('font-weight: %s;', 400);
                        $tmp_css[] = sprintf('font-style: %s;', 'italic');
                        break;
                    case '600italic':
                        $tmp_css[] = sprintf('font-weight: %s;', 600);
                        $tmp_css[] = sprintf('font-style: %s;', 'italic');
                        break;
                    case '700italic':
                        $tmp_css[] = sprintf('font-weight: %s;', 700);
                        $tmp_css[] = sprintf('font-style: %s;', 'italic');
                        break;
                    case '800italic':
                        $tmp_css[] = sprintf('font-weight: %s;', 800);
                        $tmp_css[] = sprintf('font-style: %s;', 'italic');
                        break;
                    default:
                        $tmp_css[] = sprintf('font-weight: %s;', $tmp['style']);        
                        break;
                }    
            }

            if( !empty( $tmp['size'] ) && (int) $tmp['size'] > 0 ){
                $tmp_css[] = sprintf('font-size: %spx;', $tmp['size']);   
            }

            if( !empty( $tmp['color'] ) ){
                $tmp_css[] = sprintf('color: %s;', $tmp['color']);   
            }            

            if(!empty( $tmp['family'] ) &&  ( 'none' !== $tmp['family'] ) ){
                $tmp_css[] = sprintf('font-family: %s;', $tmp['family']);
                
                // check :  is google font
                if( isset($google_fonts[$tmp['family']]) ){
                    // if true
                    if( !isset( $google_font_in_use[$tmp['family']] ) ){
                        // add to list
                        $google_font_in_use[$tmp['family']] = array();                        
                    }                    

                    if( !empty( $tmp['style'] ) ){
                        $tmp['style'] = ('regular' == $tmp['style']) ? 400 : $tmp['style'];
                        array_push( $google_font_in_use[$tmp['family']], $tmp['style'] );    
                    }
                }else{
                    foreach($custom_fonts as $custom_font){
                        if( $tmp['family'] == $custom_font['name'] ){

                            if( !isset( $custom_font_in_use[$tmp['family']] ) ){
                                $custom_font_in_use[$tmp['family']] = $custom_font;
                            }                            
                        }
                    }                    
                }                                                            
            }   

            if(!empty( $tmp_css )){
                $css[] = sprintf('%s { %s }', $font['element'], implode(' ', $tmp_css) );
            }
                              
        }
    }

    if(!empty( $css )){
        wp_add_inline_style(KOPA_PREFIX . 'style', implode(' ', $css) );
    }
        
    // enqueue google font in use
    if( !empty($google_font_in_use) ){
        foreach($google_font_in_use as $font_family => $font_style){
            $font_family = str_replace(' ', '+', $font_family);

            $url = sprintf( 'http://fonts.googleapis.com/css?family=%s', $font_family);
            if( !empty($font_style) ){
                $url .= sprintf(':%s', implode(',', $font_style) );
            }
            wp_enqueue_style(KOPA_PREFIX . strtolower( $font_family ) , $url, array(), NULL);            
        }
    }    

    // enqueue custom font in use
    if( !empty($custom_font_in_use) ){
        
        foreach ( $custom_font_in_use as $font_family => $font_info ) {
            $src = array();
            foreach ($font_info as $file_ext => $file_url) {
                if( !empty($file_url) ){
                    switch ($file_ext) {
                        case 'eot':                        
                            $src[] = sprintf("url('%s?#iefix&v=1.0.0') format('embedded-opentype')", $file_url);
                            break;
                        case 'woff':
                            $src[] = sprintf("url('%s?v=1.0.0') format('woff')", $file_url);
                            break;
                        case 'ttf':
                            $src[] = sprintf("url('%s?v=1.0.0') format('truetype')", $file_url);
                            break;
                        case 'svg':
                            $src[] = sprintf("url('%s?v=1.0.0#%s') format('svg')", $file_url, $font_family);
                            break;
                    }
                }                
            }

            $tmp_inline_font = sprintf("@font-face { font-family: '%s'; src: %s; }", $font_family, implode(',', $src));

            wp_add_inline_style(KOPA_PREFIX . 'style', $tmp_inline_font );
        }        

    }  
}

add_action('wp_enqueue_scripts', 'divine_customize_logo_enqueue_scripts', 14);

function divine_customize_logo_enqueue_scripts(){
    $logo_css = '';
    $margins = array(
        'margin-left',
        'margin-right',
        'margin-top',
        'margin-bottom');

    foreach($margins as $margin){
        $tmp_key = "logo-{$margin}";
        $tmp_value = (int) kopa_get_option($tmp_key);
        if( $tmp_value ){
            $logo_css .= "{$margin} : {$tmp_value}px; ";
        }
    }

    if( !empty($logo_css) ){
        $logo_css = ".logo-box > a > img {{$logo_css}}";
        wp_add_inline_style(KOPA_PREFIX . 'style', $logo_css);
    }
}

add_action('wp_enqueue_scripts', 'divine_customize_css_enqueue_scripts', 15);

function divine_customize_css_enqueue_scripts(){
	if(2 == (int) kopa_get_option('style-social-and-newsletter', 1)){
		$social_and_newsletter_style = ".kopa-area-3 .right-area{ margin-top: 0px; }";
		wp_add_inline_style(KOPA_PREFIX . 'style', $social_and_newsletter_style);
	}


	if($style = kopa_get_option('custom-css')){
		wp_add_inline_style(KOPA_PREFIX . 'style', $style);
	}
}