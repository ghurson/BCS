var DVT_Twitter;

jQuery(window).load(function() {
  DVT_Twitter.load_tweets();
  DVT_Twitter.load_tweets_carousel();
});

DVT_Twitter = {
  load_tweets: function() {
    var widgets;
    widgets = jQuery('.widget.kopa-twitter-widget-single');
    if (widgets.length > 0) {
      widgets.each(function(index, element) {
        var widget;
        widget = jQuery(element);
        jQuery.ajax({
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
          },
          beforeSend: function(jqXHR) {},
          success: function(data, textStatus, jqXHR) {
            var loading;
            loading = widget.find('.dvt-tweets-loading').first();
            jQuery(data).insertAfter(loading);
            loading.remove();
            jQuery('.tweets-data').remove();
          },
          url: dvt_tweets.ajax.url,
          dataType: "html",
          type: 'POST',
          async: true,
          data: {
            action: 'dvt_load_tweets',
            security: widget.find('[name=security]').val(),
            widget_id: widget.attr('id'),
            post_id: dvt_tweets.ajax.post_id
          }
        });
      });
    }
  },
  load_tweets_carousel: function() {
    var widgets;
    widgets = jQuery('.widget.kopa-twitter-widget-carousel');
    if (widgets.length > 0) {
      widgets.each(function(index, element) {
        var widget;
        widget = jQuery(element);
        jQuery.ajax({
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
          },
          beforeSend: function(jqXHR) {},
          success: function(data, textStatus, jqXHR) {
            var loading;
            loading = widget.find('.dvt-tweets-loading').first();
            jQuery(data).insertAfter(loading);
            loading.remove();
            jQuery('.tweets-data').remove();
            Modernizr.load([
              {
                load: [kopa_variable.url.template_directory_uri + "js/owl.carousel.js"],
                complete: function() {
                  var owl5;
                  owl5 = jQuery(".owl-carousel-5");
                  owl5.owlCarousel({
                    singleItem: true,
                    pagination: true,
                    slideSpeed: 1000,
                    transitionStyle: "backSlide",
                    navigation: false
                  });
                }
              }
            ]);
          },
          url: dvt_tweets.ajax.url,
          dataType: "html",
          type: 'POST',
          async: true,
          data: {
            action: 'dvt_load_tweets_carousel',
            security: widget.find('[name=security]').val(),
            widget_id: widget.attr('id'),
            post_id: dvt_tweets.ajax.post_id
          }
        });
      });
    }
  }
};
