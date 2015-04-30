var Divine_Toolkit, dvt_gallery, dvt_gallery_button, dvt_icon_field;

jQuery(document).ready(function() {
  Divine_Toolkit.init_field_datetime();
  Divine_Toolkit.init_field_gallery();
});

jQuery(document).ajaxSuccess(function() {
  Divine_Toolkit.init_field_datetime();
  Divine_Toolkit.init_field_gallery();
});

dvt_icon_field = '';

dvt_gallery = '';

dvt_gallery_button = '';

Divine_Toolkit = {
  init_field_gallery: function() {
    jQuery('.dvt-ui-gallery-wrap').on('click', '.dvt-ui-gallery-button', function(event) {
      event.preventDefault();
      dvt_gallery_button = jQuery(this);
      if (dvt_gallery) {
        dvt_gallery.open();
        return;
      }
      dvt_gallery = wp.media.frames.dvt_gallery = wp.media({
        title: 'Gallery config',
        button: {
          text: 'Use'
        },
        library: {
          type: 'image'
        },
        multiple: true
      });
      dvt_gallery.on('open', function() {
        var ids, selection;
        ids = dvt_gallery_button.parents('.dvt-ui-gallery-wrap').find('input.dvt-ui-gallery').val();
        if ('' !== ids) {
          selection = dvt_gallery.state().get('selection');
          ids = ids.split(',');
          jQuery(ids).each(function(index, element) {
            var attachment;
            attachment = wp.media.attachment(element);
            attachment.fetch();
            selection.add(attachment ? [attachment] : []);
          });
        }
      });
      dvt_gallery.on('select', function() {
        var result, selection;
        result = [];
        selection = dvt_gallery.state().get('selection');
        selection.map(function(attachment) {
          attachment = attachment.toJSON();
          return result.push(attachment.id);
        });
        if (result.length > 0) {
          result = result.join(',');
          dvt_gallery_button.parents('.dvt-ui-gallery-wrap').find('input.dvt-ui-gallery').val(result);
        }
      });
      dvt_gallery.open();
    });
  },
  select_icon: function(event, obj, icon) {
    event.preventDefault();
    dvt_icon_field.val(icon);
    window.tb_remove();
  },
  open_icons: function(event, obj) {
    event.preventDefault();
    window.tb_show(obj.attr('title'), obj.attr('href'), '');
    dvt_icon_field = obj.parent().find('.dvt-icon');
  },
  filter_icons: function(event, obj) {
    var filter, regex;
    event.preventDefault();
    filter = obj.val();
    if (!filter) {
      jQuery("#dvt-list-icon .dvt-ui-icon-item").show();
      return false;
    }
    regex = new RegExp(filter, "i");
    jQuery("#dvt-list-icon .dvt-ui-icon-item span").each(function(index, element) {
      if (jQuery(this).text().search(regex) < 0) {
        jQuery(this).parents('.dvt-ui-icon-item').hide();
      } else {
        jQuery(this).parents('.dvt-ui-icon-item').show();
      }
    });
  },
  remove_icon: function(event, obj) {
    event.preventDefault();
    obj.parent().find('.dvt-icon').val('');
  },
  init_field_datetime: function() {
    if (jQuery('.dvt-datetime').length > 0) {
      jQuery('.dvt-datetime').each(function(index, element) {
        jQuery(element).datetimepicker({
          lang: 'en',
          timepicker: jQuery(element).data('timepicker'),
          datepicker: jQuery(element).data('datepicker'),
          format: jQuery(element).data('format'),
          i18n: {
            en: {
              months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
              dayOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
            }
          }
        });
      });
    }
  }
};
