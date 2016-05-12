<section class="cpt" id="cpt" style="display:none;">
	  <form name="cpt-add-button" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
	  <input type="hidden" name="action" value="cpt_add_button" />
	    <div class="submit text-center">
          <input type="submit" name="Submit" class="button-primary" value="Add Custom Post Type" />
        </div>
	  </form>
	<form name="form3" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
	  <input type="hidden" name="action" value="pwd_cpt" />
	  <?php $args = array( 'post_type' => 'pwd_cpt', 'posts_per_page' => -1 );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post(); ?>
		  <div class="container">
		    <div class="row">
		    	<div class="twelve columns">
		    		
		    	</div>
		    </div>
		  </div>
	  <?php endwhile; ?> 
	</form>
</section>