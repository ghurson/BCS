jQuery(document).ready ->
	Divine_Toolkit.init_field_datetime()
	Divine_Toolkit.init_field_gallery()
	return	

jQuery(document).ajaxSuccess ->
	Divine_Toolkit.init_field_datetime()
	Divine_Toolkit.init_field_gallery()	
	return


dvt_icon_field = ''
dvt_gallery = ''
dvt_gallery_button = ''

Divine_Toolkit =
	init_field_gallery: () ->
		jQuery('.dvt-ui-gallery-wrap').on 'click', '.dvt-ui-gallery-button', (event)->
			event.preventDefault()

			dvt_gallery_button = jQuery this

			if dvt_gallery
	            dvt_gallery.open()
	            return
	            
			dvt_gallery = wp.media.frames.dvt_gallery = wp.media
	            title: 'Gallery config'
	            button:
	            	text: 'Use'
	            library:
	            	type: 'image'            	
	            multiple: true
	        
			dvt_gallery.on 'open', () ->
				ids = dvt_gallery_button.parents('.dvt-ui-gallery-wrap').find('input.dvt-ui-gallery').val()					
				if '' != ids
					selection = dvt_gallery.state().get 'selection'
					ids       = ids.split ','				

					jQuery(ids).each (index, element) ->
						attachment = wp.media.attachment element
						attachment.fetch()
						selection.add  if attachment then [attachment] else []
						return 

				return

			dvt_gallery.on 'select', ()->
	            result = []
	            selection = dvt_gallery.state().get 'selection'
	            selection.map (attachment) ->
	                attachment = attachment.toJSON()
	                result.push attachment.id	                
	            
	            if result.length > 0
	                result = result.join (',')
	                dvt_gallery_button.parents('.dvt-ui-gallery-wrap').find('input.dvt-ui-gallery').val result
	            return

			dvt_gallery.open()
		
			return

		return

	select_icon: (event, obj, icon) ->
		event.preventDefault()
		dvt_icon_field.val(icon)		
		window.tb_remove()
		return

	open_icons: (event, obj) ->
		event.preventDefault()
		window.tb_show obj.attr('title'), obj.attr('href'), ''
		dvt_icon_field = obj.parent().find('.dvt-icon')
		return

	filter_icons: (event, obj) ->
		event.preventDefault()

		filter = obj.val()

		if !filter
			jQuery("#dvt-list-icon .dvt-ui-icon-item").show()
			return false  

		regex = new RegExp(filter, "i")

		jQuery("#dvt-list-icon .dvt-ui-icon-item span").each (index, element) ->
			if jQuery(this).text().search(regex) < 0
                jQuery(this).parents('.dvt-ui-icon-item').hide()
            else
                jQuery(this).parents('.dvt-ui-icon-item').show()           	
           	return 			           

		return

	remove_icon: (event, obj) ->
		event.preventDefault()
		obj.parent().find('.dvt-icon').val ''
		return

	init_field_datetime: () ->
		if jQuery('.dvt-datetime').length > 0
			jQuery('.dvt-datetime').each (index, element) ->
				jQuery(element).datetimepicker
					lang: 'en'							
					timepicker: jQuery(element).data 'timepicker'
					datepicker: jQuery(element).data 'datepicker'
					format: jQuery(element).data 'format'
					i18n:
						en:
							months:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
							dayOfWeek:["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]		

				return

		return