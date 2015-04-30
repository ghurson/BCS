define('jquery', [], function() {
    return jQuery;
});

require.config({
    baseUrl: kopa_variable.url.template_directory_uri + 'js/',
    paths: {
        imagesloaded: 'imagesloaded',        
        wookmark: 'wookmark', 
        magnific: 'jquery.magnific-popup',
        waypoints: 'waypoints',
        waypoints_sticky: 'waypoints-sticky'
    }
});


jQuery(document).ready(function($){
    "use strict";

    var blog_masonry = jQuery('.kopa-blog-masonry-widget > ul');

    if(blog_masonry.length > 0){
        require(['imagesloaded'], function(imagesLoaded) {                    
            blog_masonry.imagesLoaded(function() {
                blog_masonry.masonry({
                    columnWidth: 1,
                    itemSelector: '.ms-item1'
                });
                blog_masonry.masonry('bindResize');
            });

        }, function(err) {
            console.log('failed on load:');
            console.log(err.requireModules && err.requireModules[0]);
            console.log(err);
        });                   
    }

    if(1 === parseInt(kopa_variable.option.is_enable_sticky_menu) && jQuery('#main-nav').length > 0){
        require(['waypoints', 'waypoints_sticky'], function(imagesLoaded) {   
            jQuery('.kopa-header-bottom').waypoint('sticky',{
                offset: -1 // how far from top
            });
        });        
    }
});



jQuery(window).load(function() {
    "use strict";

    if (jQuery('ul.portfolio-list-item').length > 0) {
        require(['imagesloaded', 'wookmark'], function(imagesLoaded, wookmark) {
            jQuery('.portfolio-list-item').imagesLoaded(function() {
                var handler = jQuery('.portfolio-list-item li');
                handler.wookmark({
                    autoResize: true,
                    container: jQuery('.portfolio-container'),
                    offset: 0,
                    fillEmptySpace: true
                });

                var filters = jQuery('.filters-options li');

                var onClickFilter = function(event) {
                    var item = jQuery(event.currentTarget);
                    var activeFilters = [];

                    if (!item.hasClass('active')) {
                        filters.removeClass('active');
                    }
                    item.toggleClass('active');

                    if (item.hasClass('active')) {
                        activeFilters.push(item.data('filter'));
                    }

                    handler.wookmarkInstance.filter(activeFilters);
                };

                filters.click(onClickFilter);

            });
        }, function(err) {
            console.log('failed on load:');
            console.log(err.requireModules && err.requireModules[0]);
            console.log(err);
        });
    }


    var button_loadmore_portfolio = jQuery('#kopa-loadmore-portfolio');
    if (button_loadmore_portfolio.length > 0) {
        
        var $tiles = jQuery('#tiles');
        var $handler = $tiles.find('>li');
        var options = {
            autoResize: true,
            container: jQuery('.portfolio-container2'),
            offset: 0,
            fillEmptySpace: true
        };

        require(['imagesloaded', 'wookmark', 'magnific'], function(imagesLoaded, wookmark) {
            $tiles.imagesLoaded(function() {
                $handler.wookmark(options);

                var filters = jQuery('.filters-options2 li');
                var onClickFilter = function(event) {
                    var item = jQuery(event.currentTarget);
                    var activeFilters = [];

                    if (!item.hasClass('active'))
                        filters.removeClass('active');

                    item.toggleClass('active');

                    if (item.hasClass('active'))
                        activeFilters.push(item.data('filter'));

                    $handler.wookmarkInstance.filter(activeFilters);
                };
                filters.click(onClickFilter);
            });

            button_loadmore_portfolio.click(function(event) {
                var url = jQuery(this).data('url');
                var page = parseInt(jQuery(this).data('paged'));

                if(!button_loadmore_portfolio.hasClass('in-process')){                    
                    jQuery.ajax({
                        type: 'POST',
                        url: url + page,
                        dataType: 'html',
                        data: {},
                        beforeSend: function() {
                            button_loadmore_portfolio.addClass('in-process');
                            button_loadmore_portfolio.find('.fa-spinner').addClass('fa-spin');
                        },
                        success: function(data) {
                            var newItems = jQuery(data).find('.row.portfolio-list > li');
                           
                            if (newItems.length > 0) {
                                newItems.imagesLoaded(function() {
                                    if ($handler.wookmarkInstance) {
                                        $handler.wookmarkInstance.clear();
                                    }

                                    jQuery.each(newItems, function() {
                                        $tiles.append(jQuery(this));
                                    });

                                    $handler = jQuery('#tiles > li');
                                    $handler.wookmark(options);

                                    button_loadmore_portfolio.data('paged', page + 1);


                                    jQuery('.portfolio-list').each(function() {
                                        jQuery(this).magnificPopup({
                                            delegate: 'a.group1, a.group2',
                                            type: 'image',
                                            gallery: {
                                              enabled:true
                                            }
                                        });
                                    }); 
                                    
                                    console.log(1);

                                    button_loadmore_portfolio.parents('.kopa-portfolio-widget').find('.filters-options2 > li').first().click();
                                    button_loadmore_portfolio.removeClass('in-process');
                                });
                           
                            }
                        },
                        complete: function() {   
                            button_loadmore_portfolio.find('.fa-spinner').removeClass('fa-spin');                         
                        },
                        error: function() {
                            button_loadmore_portfolio.parents('.row').first().remove();
                        }
                    });

                }

            });
        }, function(err) {
            console.log('failed on load:');
            console.log(err.requireModules && err.requireModules[0]);
            console.log(err);
        });
    }

});
