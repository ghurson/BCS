<?php get_header('parallax'); ?>

<?php 
global $post;
$current_layout = Kopa_Page_Builder::get_current_layout($post->ID);	
$page_data = Kopa_Page_Builder::get_current_layout_data($post->ID);	
?>
<div id="main-content" class="clearfix">	
	<?php 	
	if(!empty($page_data['row-3'])):	
		echo divine_print_before_section($current_layout, 'row-3');
		?>
		<div class="row">
			<div class="col-sm-3">
				<?php 
				if(isset($page_data['row-3']['area-3-1'])){
					divine_dynamic_area($post->ID, $page_data['row-3']['area-3-1']); 
				}
				?>
			</div>
			<div class="col-sm-3">
				<?php 
				if(isset($page_data['row-3']['area-3-2'])){
					divine_dynamic_area($post->ID, $page_data['row-3']['area-3-2']); 
				}
				?>
			</div>
			<div class="col-sm-3">
				<?php 
				if(isset($page_data['row-3']['area-3-3'])){
					divine_dynamic_area($post->ID, $page_data['row-3']['area-3-3']); 
				}
				?>
			</div>
			<div class="col-sm-3">
				<?php 
				if(isset($page_data['row-3']['area-3-4'])){
					divine_dynamic_area($post->ID, $page_data['row-3']['area-3-4']); 
				}
				?>
			</div>
		</div>
		<?php
		echo divine_print_after_section($current_layout, 'row-3');
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-4'])):	
		if(isset($page_data['row-4']['area-4'])){
			echo divine_print_before_section($current_layout, 'row-4');
			divine_dynamic_area($post->ID, $page_data['row-4']['area-4']);
			echo divine_print_after_section($current_layout, 'row-4');
		}
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-5'])):	
		echo divine_print_before_section($current_layout, 'row-5');
		?>
		<div class="row">
			<div class="col-sm-4">
				<?php 
				if(isset($page_data['row-5']['area-5-1'])){
					divine_dynamic_area($post->ID, $page_data['row-5']['area-5-1']); 
				}
				?>
			</div>
			
			<div class="col-sm-4">
				<?php 
				if(isset($page_data['row-5']['area-5-2'])){
					divine_dynamic_area($post->ID, $page_data['row-5']['area-5-2']); 
				}
				?>
			</div>

			<div class="col-sm-4">
				<?php 
				if(isset($page_data['row-5']['area-5-3'])){
					divine_dynamic_area($post->ID, $page_data['row-5']['area-5-3']); 
				}
				?>
			</div>
		</div>
		<?php
		echo divine_print_after_section($current_layout, 'row-5');
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-6'])):	
		if(isset($page_data['row-6']['area-6'])){
			echo divine_print_before_section($current_layout, 'row-6');
			divine_dynamic_area($post->ID, $page_data['row-6']['area-6']);
			echo divine_print_after_section($current_layout, 'row-6');
		}
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-7'])):	
		if(isset($page_data['row-7']['area-7'])){
			echo divine_print_before_section($current_layout, 'row-7');
			divine_dynamic_area($post->ID, $page_data['row-7']['area-7']);
			echo divine_print_after_section($current_layout, 'row-7');
		}
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-8'])):	
		if(isset($page_data['row-8']['area-8'])){
			echo divine_print_before_section($current_layout, 'row-8');
			divine_dynamic_area($post->ID, $page_data['row-8']['area-8']);
			echo divine_print_after_section($current_layout, 'row-8');
		}
	endif;			
	?>

</div>

<?php 
get_footer();