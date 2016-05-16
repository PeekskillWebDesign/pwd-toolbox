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
      		<?php echo get_option('maintenance-mode-message'); ?>
        <?php endwhile; endif; ?>
 			</div>
  	</div>
	</div>
</div>


<?php include(plugin_dir_path(dirname(__FILE__)) . 'maintenance-view/footer-coming-soon.php'); ?>

