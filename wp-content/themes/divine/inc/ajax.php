<?php

if (!function_exists('kopa_send_contact')) {
    add_action('wp_ajax_kopa_send_contact', 'kopa_send_contact');
    add_action('wp_ajax_nopriv_kopa_send_contact', 'kopa_send_contact');

    function kopa_send_contact() {
        check_ajax_referer('kopa_send_contact', 'ajax_nonce_kopa_send_contact');
        
        foreach ($_POST as $key => $value) {
            if (ini_get('magic_quotes_gpc')) {
                $_POST[$key] = stripslashes($_POST[$key]);
            }
            $_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
        }

        $name          = $_POST["contact_name"];
        $email         = $_POST["contact_email"];
        $message       = $_POST["contact_message"];
        $url           = $_POST["contact_url"];
        
        $mail_template = html_entity_decode(stripcslashes(kopa_get_option('contact-reply-template', '<p>Aloha!</p><p>You have a new message from  [contact_name] ([contact_email] : [contact_url])</p><div>[contact_message]</div><p>Thanks!</p>')));
        
        $body          = str_replace('[contact_name]', $name, $mail_template);
        $body          = str_replace('[contact_email]', $email, $body);
        $body          = str_replace('[contact_message]', $message, $body);
        $body          = str_replace('[contact_url]', $url, $body);
        
        $to            = kopa_get_option('contact-email', get_bloginfo('admin_email'));
        $subject       = __("Contact Form:", kopa_get_domain()) . " $name";
        $headers       = 'MIME-Version: 1.0' . "\r\n";
        $headers       .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";        
        $headers       .= sprintf('From: %1$s', $email) . "\r\n";
        $headers       .= sprintf('Cc: %1$s', $email) . "\r\n";
        $result        = do_shortcode('[alert class="kopa-alert alert-danger alert-dismissable"]' . __('Oops! errors occured. Please try again..', kopa_get_domain()) . '[/alert]');
        
        if (wp_mail($to, $subject, $body, $headers)) {
            $result = do_shortcode('[alert class="kopa-alert alert-success alert-dismissable"]' . __('Success! Your email address has been sent', kopa_get_domain()) . '[/alert]');
        }

        echo $result;
        exit();
    }

}