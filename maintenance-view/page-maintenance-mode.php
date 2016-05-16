<?php 
/*
Template Name: Maintenance Mode
*/
include(plugin_dir_path(dirname(__FILE__)) . 'maintenance-view/header-coming-soon.php'); ?>

<section>
	<div class="container">
		<div class="row">
           <p><?php echo get_option('maintenance-mode-message'); ?></p>
		</div>
	</div>
</section>

<?php include(plugin_dir_path(dirname(__FILE__)) . 'maintenance-view/footer-coming-soon.php'); ?>

