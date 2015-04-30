<?php get_header(); ?>

<?php 
global $post;
$current_layout = Kopa_Page_Builder::get_current_layout($post->ID);	
$page_data = Kopa_Page_Builder::get_current_layout_data($post->ID);	
?>

<div class="bg-feature"><span></span></div>
<div id="main-content" class="clearfix">

	<?php 	
	if(!empty($page_data['row-1'])):			
		if(isset($page_data['row-1']['area-1'])){
			echo divine_print_before_section($current_layout, 'row-1');
			divine_dynamic_area($post->ID, $page_data['row-1']['area-1']);
			echo divine_print_after_section($current_layout, 'row-1');
		}		
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-2'])):	
		echo divine_print_before_section($current_layout, 'row-2');
		?>
		<div class="row">
			<div class="col-sm-3">
				<?php 
				if(isset($page_data['row-2']['area-2-1'])){
					divine_dynamic_area($post->ID, $page_data['row-2']['area-2-1']); 
				}
				?>
			</div>
			<div class="col-sm-3">
				<?php 
				if(isset($page_data['row-2']['area-2-2'])){
					divine_dynamic_area($post->ID, $page_data['row-2']['area-2-2']); 
				}
				?>
			</div>
			<div class="col-sm-3">
				<?php 
				if(isset($page_data['row-2']['area-2-3'])){
					divine_dynamic_area($post->ID, $page_data['row-2']['area-2-3']); 
				}
				?>
			</div>
			<div class="col-sm-3">
				<?php 
				if(isset($page_data['row-2']['area-2-4'])){
					divine_dynamic_area($post->ID, $page_data['row-2']['area-2-4']); 
				}
				?>
			</div>
		</div>
		<?php
		echo divine_print_after_section($current_layout, 'row-2');
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-3'])):
		if(isset($page_data['row-3']['area-3'])){
			echo divine_print_before_section($current_layout, 'row-3');
			divine_dynamic_area($post->ID, $page_data['row-3']['area-3']);
			echo divine_print_after_section($current_layout, 'row-3');
		}
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-4'])):	
		echo divine_print_before_section($current_layout, 'row-4');
		?>
		<div class="row">
			<div class="col-sm-4">
				<?php 
				if(isset($page_data['row-4']['area-4-1'])){
					divine_dynamic_area($post->ID, $page_data['row-4']['area-4-1']); 
				}
				?>
			</div>
			
			<div class="col-sm-4">
				<?php 
				if(isset($page_data['row-4']['area-4-2'])){
					divine_dynamic_area($post->ID, $page_data['row-4']['area-4-2']); 
				}
				?>
			</div>

			<div class="col-sm-4">
				<?php 
				if(isset($page_data['row-4']['area-4-3'])){
					divine_dynamic_area($post->ID, $page_data['row-4']['area-4-3']); 
				}
				?>
			</div>
		</div>
		<?php
		echo divine_print_after_section($current_layout, 'row-4');
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-5'])):	
		if(isset($page_data['row-5']['area-5'])){
			echo divine_print_before_section($current_layout, 'row-5');
			divine_dynamic_area($post->ID, $page_data['row-5']['area-5']);
			echo divine_print_after_section($current_layout, 'row-5');
		}
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

</div>

<?php 
get_footer();