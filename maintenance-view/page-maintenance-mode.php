<?php 
/*
Template Name: Maintenance Mode
*/
include(plugin_dir_path(dirname(__FILE__)) . 'maintenance-view/header-coming-soon.php'); ?>
<div class="landing-content">
	<div class="container">
		<div class="row">
 			 <div class="eight offset-by-two columns text-center">
 			 	<?php if ( have_posts() ) : ?> <?php while ( have_posts() ) : the_post(); ?>
 			  	<img src="<?php echo get_option('maintenance-mode-image'); ?>">
      		<p><?php echo get_option('maintenance-mode-message'); ?></p>
        <?php endwhile; endif; ?>
 			</div>
  	</div>
	</div>
</div>Annapolis Area Doulas is currently under construction! If your have any questions, please feel free to contact us via phone at (443)333-9820. Also, be sure to sign up for our mailing list.




<?php include(plugin_dir_path(dirname(__FILE__)) . 'maintenance-view/footer-coming-soon.php'); ?>

