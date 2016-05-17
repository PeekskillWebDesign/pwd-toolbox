<?php 
/*
Template Name: Maintenance Mode
*/

include(plugin_dir_path(dirname(__FILE__)) . 'maintenance-view/header-coming-soon.php'); ?>
<div class="landing-content">
	<div class="container">
		<div class="row">
 			 <div class="four offset-by-four columns text-center">
 			  	<img class="maintenance_image" src="<?php echo get_option('maintenance'); ?>">
      			<div class="text-center">
      				<p class="maintenance_message"><?php echo get_option('maintenance-mode-message'); ?></p>
 				</div>
 				<?php if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form(get_option('maintenance-mode-form')); } ?>
 			</div>
  		</div>
	</div>
</div>




<?php include(plugin_dir_path(dirname(__FILE__)) . 'maintenance-view/footer-coming-soon.php'); ?>

