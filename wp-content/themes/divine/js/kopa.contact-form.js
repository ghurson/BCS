jQuery(document).ready(function($) {
    "use strict";
    
    if (jQuery("#contact-form").length > 0) {
        Modernizr.load([
            {
                load: [kopa_variable.url.template_directory_uri + 'js/jquery.validate.js'],
                complete: function() {
                    var i18n = kopa_variable.i18n.validate;
                    jQuery('#contact-form').validate({
                        rules: {
                            contact_name: {
                                required: true,
                                minlength: 2
                            },
                            contact_email: {
                                required: true,
                                email: true
                            },
                            contact_message: {
                                required: true,
                                minlength: 10
                            }
                        },
                        messages: {
                            contact_name: {
                                required: i18n.name.REQUIRED,
                                minlength: jQuery.format(i18n.name.MINLENGTH)
                            },
                            contact_email: {
                                required: i18n.email.REQUIRED,
                                email: i18n.email.EMAIL
                            },
                            contact_message: {
                                required: i18n.message.REQUIRED,
                                minlength: jQuery.format(i18n.message.MINLENGTH)
                            }
                        },
                        submitHandler: function(form) {
                            jQuery(form).ajaxSubmit({
                                success: function(responseText, statusText, xhr, $form) {
                                    jQuery("#submit-contact").attr("value", i18n.form.SENDING).attr('disabled', 'disabled');
                                    jQuery("#contact_response").html(responseText).hide().slideDown("fast");
                                    jQuery("#submit-contact").attr("value", i18n.form.SUBMIT);
                                    
                                    jQuery(form).find('[name=contact_name]').val('');
                                    jQuery(form).find('[name=contact_email]').val('');
                                    jQuery(form).find('[name=contact_url]').val('');
                                    jQuery(form).find('[name=contact_message]').val('');
                                    
                                    jQuery("#submit-contact").val(i18n.form.SUBMIT).removeAttr('disabled');
                                }
                            });

                            return false;
                        }
                    });

                }
            }
        ]);
    }
});