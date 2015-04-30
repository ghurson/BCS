jQuery(window).load(function($) {
    var button = jQuery('#divine-loadmore-events');
    if (0 < button.length) {

        button.on('click', function(event) {
            var widget = button.parents('.widget.kopa-event-widget');
            var current_paged = parseInt(button.data('paged'));
            var post_id = parseInt(button.data('post-id'));

            if (!button.hasClass('ajax_processing')) {
                jQuery.ajax({
                    type: 'POST',
                    url: kopa_variable.url.ajax,
                    dataType: 'html',
                    data: {
                        action: "kopa_load_events",
                        ajax_nonce: jQuery('#kopa_load_events_ajax_nonce').val(),
                        widget_id: widget.attr('id'),
                        paged: current_paged + 1,
                        post_id: post_id
                    },
                    beforeSend: function() {
                        button.addClass('ajax_processing');
                        button.find('i').addClass('fa-spin');
                    },
                    success: function(data) {
                        if (data) {
                            widget.find('ul.event-list').append(data);
                            button.data('paged', current_paged + 1);
                        }else{
                            button.remove();
                        }
                    },
                    complete: function(data) {
                        button.removeClass('ajax_processing');  
                        button.find('i').removeClass('fa-spin');
                    },
                    error: function(errorThrown) {

                    }
                });
            }
        });


    }

});