<?php
add_shortcode('contact_form', 'dvt_shortcode_contact');

function dvt_shortcode_contact($atts, $content = null) {    
   
    ob_start();

	$mail             = kopa_get_option('contact-email');
	$phone            = kopa_get_option('contact-phone');
	$fax              = kopa_get_option('contact-fax');
	$address          = kopa_get_option('contact-address');	
	$latitude         = kopa_get_option('contact-latitude');	
	$longitude        = kopa_get_option('contact-longitude');	
	$info_caption     = kopa_get_option('contact-info-caption');
	$info_description = kopa_get_option('contact-info-description');	
	$form_caption     = kopa_get_option('contact-form-caption');	
    ?>
    <div class="kopa-contact-wrapper">
	    <div class="row">
	        <?php
	        if (!empty($latitude) && !empty($longitude)):	            
                ?>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="kopa-map-wrapper">
                        <div id="kopa-map" class="kopa-map" data-place="<?php echo strip_tags($address); ?>" data-latitude="<?php echo $latitude; ?>" data-longitude="<?php echo $longitude; ?>"></div>
                    </div>
                </div>
                <?php	          
	        endif;
	        ?>
	        <div class="col-md-6 col-sm-6 col-xs-6">
	            <h3 class="contact-title widget-title style3"><?php echo $info_caption; ?></h3>

	            <address>
	                <?php if($address): ?>
	                    <p><?php echo strip_tags($address); ?></p>  
	                <?php endif;?>    

	                <?php if($phone): ?>
	                    <p><?php _e('Telephone:', 'divine-toolkit'); ?> <?php echo strip_tags($phone); ?></p>
	                <?php endif;?>

	                <?php if($mail): ?>
	                    <p><?php _e('Email:', 'divine-toolkit'); ?> <a href="mailto:<?php echo strip_tags($mail); ?>"><?php echo strip_tags($mail); ?></a></p>
	                <?php endif;?>
	            </address>

	            <p><?php echo $info_description; ?></p>
	        </div>
	    </div>                                              
	</div>
	<div class="contact-box">
	    <h4 class="contact-title widget-title style3"><?php echo $form_caption; ?></h4>
	    <form id="contact-form" class="contact-form clearfix" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" novalidate="novalidate">
	        <div class="row">
	            <div class="col-md-4 col-sm-4 col-xs-4">
	                <p class="input-block">
	                    <input type="text" value="" id="contact_name" name="contact_name" class="valid" autocomplete="off">
	                </p>
	            </div>
	            <div class="col-md-8 col-sm-8 col-xs-8">
	                <div class="input-label">
	                    <p><?php _e('Name', 'divine-toolkit'); ?> <span>(*)</span></p>
	                    <p><?php _e('Your full name please.', 'divine-toolkit'); ?></p>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-md-4 col-sm-4 col-xs-4">
	                <p class="input-block">
	                    <input type="text" value="" id="contact_email" name="contact_email" class="valid" autocomplete="off">
	                </p>
	            </div>
	            <div class="col-md-8 col-sm-8 col-xs-8">
	                <div class="input-label">
	                    <p><?php _e('Email', 'divine-toolkit'); ?> <span>(*)</span></p>
	                    <p><?php _e('Your email address.', 'divine-toolkit'); ?></p>
	                </div>
	            </div>
	        </div>

	        <div class="row">
	            <div class="col-md-4 col-sm-4 col-xs-4">
	                <p class="input-block">
	                    <input type="text" value="" id="contact_url" name="contact_url" class="valid" autocomplete="off">
	                </p>
	            </div>
	            <div class="col-md-8 col-sm-8 col-xs-8">
	                <div class="input-label">
	                    <p><?php _e('URL', 'divine-toolkit'); ?></p>
	                    <p><?php _e('Your website url.', 'divine-toolkit'); ?></p>
	                </div>
	            </div>
	        </div>

	        <div class="row">
	            <div class="col-md-12 col-sm-12 col-xs-12">
	                <p class="textarea-label"><?php _e('Your Message', 'divine-toolkit'); ?> <span>(*):</span></p>
	                <p class="textarea-block">  
	                    <textarea name="contact_message" id="contact_message" cols="88" rows="10"></textarea>
	                </p>
	            </div>
	        </div>
	        
	        <div class="row">
	            <div class="col-md-12 col-sm-12 col-xs-12">
	                <p class="contact-button clearfix">    
	                    <input type="hidden" name="action" value="kopa_send_contact">
	                    <?php wp_nonce_field('kopa_send_contact', 'ajax_nonce_kopa_send_contact'); ?>
	                    <span><input type="submit" value="<?php _e('Send Message', 'divine-toolkit'); ?>" id="submit-contact"></span>
	                </p>
	            </div>
	        </div>
	        
	    </form>

	    <div id="contact_response"></div>

	</div>
    <?php   

    $html = ob_get_clean();
    
    return apply_filters('dvt_shortcode_contact', $html, $atts, $content);    
}