jQuery(window).load ->
	DVT_Twitter.load_tweets()
	DVT_Twitter.load_tweets_carousel()
	
	return

DVT_Twitter =	

	load_tweets: () ->
		widgets = jQuery '.widget.kopa-twitter-widget-single'
		
		if widgets.length > 0
			widgets.each (index, element) ->
				widget = jQuery element

				jQuery.ajax
					error: (jqXHR, textStatus, errorThrown) ->
						console.log textStatus
						return
					beforeSend: (jqXHR) ->				
						
						return 
					success: (data, textStatus, jqXHR) ->
						loading = widget.find('.dvt-tweets-loading').first()
						jQuery(data).insertAfter(loading)
						loading.remove()
						jQuery('.tweets-data').remove()
						return
					url: dvt_tweets.ajax.url
					dataType: "html"
					type: 'POST'
					async: true
					data:						
						action: 'dvt_load_tweets'
						security: widget.find('[name=security]').val()
						widget_id: widget.attr('id')
						post_id: dvt_tweets.ajax.post_id
					
				return

		return

	load_tweets_carousel: () ->
		widgets = jQuery '.widget.kopa-twitter-widget-carousel'
		
		if widgets.length > 0
			widgets.each (index, element) ->
				widget = jQuery element

				jQuery.ajax
					error: (jqXHR, textStatus, errorThrown) ->
						console.log textStatus
						return
					beforeSend: (jqXHR) ->				
						
						return 
					success: (data, textStatus, jqXHR) ->
						loading = widget.find('.dvt-tweets-loading').first()
						jQuery(data).insertAfter(loading)
						loading.remove()
						jQuery('.tweets-data').remove()

						Modernizr.load [
							load: [ kopa_variable.url.template_directory_uri + "js/owl.carousel.js" ]
							complete: ->
								owl5 = jQuery(".owl-carousel-5")
								owl5.owlCarousel
									singleItem: true
									pagination: true
									slideSpeed: 1000
									transitionStyle: "backSlide"
									navigation: false
								return
						]				
						return
					url: dvt_tweets.ajax.url
					dataType: "html"
					type: 'POST'
					async: true
					data:
						action: 'dvt_load_tweets_carousel'						
						security: widget.find('[name=security]').val()
						widget_id: widget.attr('id')
						post_id: dvt_tweets.ajax.post_id
				return

		return		