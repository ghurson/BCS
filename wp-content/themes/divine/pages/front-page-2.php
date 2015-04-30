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
		if(isset($page_data['row-2']['area-2'])){
			echo divine_print_before_section($current_layout, 'row-2');
			divine_dynamic_area($post->ID, $page_data['row-2']['area-2']);
			echo divine_print_after_section($current_layout, 'row-2');
		}		
	endif;			
	?>

	<?php 	
	if(!empty($page_data['row-3'])):	
		echo divine_print_before_section($current_layout, 'row-3');
		?>
		<div class="row">
			<div class="col-sm-9">
				<div class="row">
					<div class="col-sm-12">
						<?php 
						if(isset($page_data['row-3']['area-3-1-1'])){
							divine_dynamic_area($post->ID, $page_data['row-3']['area-3-1-1']); 
						}
						?>
					</div>	
				</div>

				<div class="row">
					<div class="col-sm-4">
						<?php 
						if(isset($page_data['row-3']['area-3-1-2'])){
							divine_dynamic_area($post->ID, $page_data['row-3']['area-3-1-2']); 
						}
						?>
					</div>	
					<div class="col-sm-4">
						<?php 
						if(isset($page_data['row-3']['area-3-1-3'])){
							divine_dynamic_area($post->ID, $page_data['row-3']['area-3-1-3']); 
						}
						?>
					</div>
					<div class="col-sm-4">
						<?php 
						if(isset($page_data['row-3']['area-3-1-4'])){
							divine_dynamic_area($post->ID, $page_data['row-3']['area-3-1-4']); 
						}
						?>
					</div>
				</div>				
			</div>
			
			<div class="col-sm-3">
				<?php 
				if(isset($page_data['row-3']['area-3-2'])){
					divine_dynamic_area($post->ID, $page_data['row-3']['area-3-2']); 
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
			<div class="col-sm-3">
				<?php 
					if(isset($page_data['row-5']['area-5-1'])){
						divine_dynamic_area($post->ID, $page_data['row-5']['area-5-1']); 
					}
				?>
			</div>
			<div class="col-sm-9">
				<?php 
				if(isset($page_data['row-5']['area-5-2'])){
					divine_dynamic_area($post->ID, $page_data['row-5']['area-5-2']); 
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

</div>

<?php 
get_footer();