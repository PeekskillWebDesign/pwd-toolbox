<section class="cpt" id="cpt" style="display:none;">
	  <form name="cpt-add-button" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
	  <input type="hidden" name="action" value="cpt_add_button" />
	    <div class="submit text-center">
          <input type="submit" name="Submit" class="button-primary" value="Add Custom Post Type" />
        </div>
	  </form>
	
		  <div class="container">
		  <?php 
		  	$index = 0;
		  	$args = array( 'post_type' => 'pwd_cpt', 'posts_per_page' => -1 );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); 
			$plural_cpt = get_post_meta( get_the_id(), '_plural', true );
			$single_cpt = get_post_meta( get_the_id(), '_single', true );
			$dashicon_cpt = get_post_meta( get_the_id(), '_dashicon', true );
			?>
			<?php if($index % 4 == 0) :?>
		    	<div class="row">
		    <?php endif;?>
		    	<div class="three columns pwd_admin-card">
		    		<form name="cpt_form_<?php echo $index ?>" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
	  					<input type="hidden" name="action" value="pwd_cpt" />
				    		<div class="cpt_input">
					    		<label for="name<?php echo $index ?>">Slug</label>
					    		<input type="text" name="name<?php echo $index ?>" value="<?php the_title(); ?>" />
				    		</div>
				    		<div class="cpt_input">
					    		<label for="plural<?php echo $index ?>">Plural Name</label>
					    		<input type="text" name="plural<?php echo $index ?>" value="<?php echo $plural_cpt ?>" />
				    		</div>

				    		<div class="cpt_input">
					    		<label for="single_cpt<?php echo $index ?>">Singular Name</label>
					    		<input type="text" name="single_cpt<?php echo $index ?>" value="<?php echo $single_cpt ?>" />
				    		</div>

				    		<div class="cpt_input">
					    		<label for="dashicon<?php echo $index ?>">Dashicon</label>
					    		<input type="text" name="dashicon<?php echo $index ?>" value="<?php echo $dashicon_cpt ?>" />
				    		</div>

				    		<div>
					    		<input type="checkbox" name="public<?php echo $index ?>" />
					    		<label for="public<?php echo $index ?>"  class="checkbox_label">Public?</label>
				    		</div>

				    		<div>
					    		<input type="checkbox" name="archive<?php echo $index ?>" />
					    		<label for="archive<?php echo $index ?>"  class="checkbox_label">Has Archive?</label>
				    		</div>

				    		<div >
					    		<input type="checkbox" name="hierarchial<?php echo $index ?>"/>
					    		<label for="hierarchial<?php echo $index ?>"  class="checkbox_label">Is Hierarchial?</label>
				    		</div>
				    		<div class="cpt_input cpt_supports">
				    			<h6 style="margin:0; margin-top:20px;">Supports</h6>
					    		<input type="checkbox" name="title<?php echo $index ?>" />
					    		<label for="title<?php echo $index ?>" class="checkbox_label">Title</label><br>
					    		<input type="checkbox" name="editor<?php echo $index ?>" />
					    		<label for="editor<?php echo $index ?><?php echo $index ?>" class="checkbox_label">Editor</label><br>
					    		<input type="checkbox" name="author<?php echo $index ?>" />
					    		<label for="author<?php echo $index ?>" class="checkbox_label">Author</label><br>
					    		<input type="checkbox" name="thumbnail<?php echo $index ?>" />
					    		<label for="thumbnail<?php echo $index ?>" class="checkbox_label">Thubmnail</label><br>
					    		<input type="checkbox" name="excerpt<?php echo $index ?>" />
					    		<label for="excerpt<?php echo $index ?>" class="checkbox_label">Excerpt</label><br>
					    		<input type="checkbox" name="comments<?php echo $index ?>" />
					    		<label for="comments<?php echo $index ?>" class="checkbox_label">Comments</label><br>
				    		</div>
				    		<div class="text-center" >
					          <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
					        </div>
				    	</form>
				    		<form name="cpt-delete-button" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
							  <input type="hidden" name="action" value="cpt_delete_button" />
							    <div class="text-center" style="margin-top:30px;">
						          <input type="submit" name="Submit" class="button-warn" value="Delete" />
						          	<input type="hidden" name="the-id" value="<?php echo get_the_id(); ?>" />
						        </div>
							  </form>
		    		</div>
		    	<?php if($index % 4 == 4) :?>
		    	</div>
		    <?php endif;?>
	  <?php $index++; endwhile; ?> 
		  </div>
	</form>
</section>