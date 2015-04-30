<?php

add_filter('kopa_widget_form_field_gallery', 'dvt_widget_form_field_gallery', 10, 5);

function dvt_widget_form_field_gallery($html, $wrap_start, $wrap_end, $field, $value){
	ob_start();

	$wrap_start = '<p class="dvt-ui-gallery-wrap">';
	$wrap_end = '</p>';

	echo $wrap_start;
	
	?>	
		<label for="<?php echo $field['id']; ?>"><?php echo esc_html( $field['label'] ); ?></label>
		<br/>
		<input class="dvt-util-medium-text dvt-ui-gallery widefat" 
			id="<?php echo $field['id']; ?>" 
			name="<?php echo $field['name']; ?>" 
			type="text" 
			autocomplete="off"
			readonly="readonly"
			value="<?php echo esc_attr( $value ); ?>" />	

		<a title="" href="#" 
			class="dvt-ui-gallery-button button button-secondary"><?php _e('Config', 'divine-toolkit'); ?></a>  	
	<?php
	
	echo $wrap_end;

	$html = ob_get_clean();

	return $html;
}