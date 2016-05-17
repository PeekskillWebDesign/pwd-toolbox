<section class="cpt" id="cpt" style="display:none;">
	  <form name="cpt-add-button" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
	  <input type="hidden" name="action" value="cpt_add_button" />
	  <?php wp_nonce_field()?>
	    <div class="submit text-center">
          <input type="submit" name="Submit" class="button-primary" value="Add Custom Post Type" />
        </div>
	  </form>
	
		    		<form name="cpt_form_<?php echo $index ?>" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
	  					<input type="hidden" name="action" value="pwd_cpt" />
	  						<?php wp_nonce_field()?>
		  <div class="container">
		  <?php 
		  	$index = 0;
		  	$args = array( 'post_type' => 'pwd_cpt', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'ID' );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); 
					$plural_cpt = get_post_meta( get_the_id(), '_plural', true );
					$single_cpt = get_post_meta( get_the_id(), '_single', true );
					$dashicon_cpt = get_post_meta( get_the_id(), '_dashicon', true );
					$public_cpt = get_post_meta( get_the_id(), '_public', true );
					$hierarchial_cpt = get_post_meta( get_the_id(), '_hierarchial', true );
					$archive_cpt = get_post_meta( get_the_id(), '_archive', true );
					$title_cpt = get_post_meta( get_the_id(), '_title', true );
					$editor_cpt = get_post_meta( get_the_id(), '_editor', true );
					$author_cpt = get_post_meta( get_the_id(), '_author', true );
					$thumbnail_cpt = get_post_meta( get_the_id(), '_thumbnail', true );
					$excerpt_cpt = get_post_meta( get_the_id(), '_excerpt', true );
					$comments_cpt = get_post_meta( get_the_id(), '_comments', true );
					?>
			<?php if($index % 4 == 0) :?>
		    	<div class="row">
		    <?php endif;?>
		    <div class="four columns pwd_admin-card">
		    	<div class="six columns">
				    		<div class="cpt_input">
					    		<label for="name<?php echo $index ?>">Slug</label>
					    		<input type="text" name="name<?php echo $index ?>" value="<?php the_title(); ?>" />
				    		</div>
				    		<div class="cpt_input">
					    		<label for="plural<?php echo $index ?>">Plural Name</label>
					    		<input type="text" name="plural<?php echo $index ?>" value="<?php echo $plural_cpt ?>" />
				    		</div>

				    		<div class="cpt_input">
					    		<label for="single<?php echo $index ?>">Singular Name</label>
					    		<input type="text" name="single<?php echo $index ?>" value="<?php echo $single_cpt ?>" />
				    		</div>

				    		<div class="cpt_input">
					    		<label for="dashicon<?php echo $index ?>">Dashicon</label>
					    		<input type="text" name="dashicon<?php echo $index ?>" value="<?php echo $dashicon_cpt ?>" />
				    		</div>
				    </div>		
				   <div class="six columns">
				    		<div>
				    			<label>&nbsp;</label>
					    		<input type="checkbox" name="public<?php echo $index ?>" value="yes" <?php echo $public_cpt ?> />
					    		<label for="public<?php echo $index ?>"  class="checkbox_label" >Public?</label>
				    		</div>

				    		<div>
					    		<input type="checkbox" name="archive<?php echo $index ?>" value="yes" <?php echo $archive_cpt ?>  />
					    		<label for="archive<?php echo $index ?>"  class="checkbox_label">Has Archive?</label>
				    		</div>

				    		<div >
					    		<input type="checkbox" name="hierarchial<?php echo $index ?>" value="yes" <?php echo $hierarchial_cpt ?> />
					    		<label for="hierarchial<?php echo $index ?>"  class="checkbox_label">Is Hierarchial?</label>
				    		</div>
				    		<div class="cpt_input cpt_supports">
				    			<h6 style="margin:0; margin-top:20px;">Supports</h6>
					    		<input type="checkbox" name="title<?php echo $index ?>" value="yes" <?php echo $title_cpt ?>/>
					    		<label for="title<?php echo $index ?>" class="checkbox_label">Title</label><br>
					    		<input type="checkbox" name="editor<?php echo $index ?>" value="yes" <?php echo $editor_cpt ?>/>
					    		<label for="editor<?php echo $index ?>" class="checkbox_label">Editor</label><br>
					    		<input type="checkbox" name="author<?php echo $index ?>" value="yes" <?php echo $author_cpt ?>/>
					    		<label for="author<?php echo $index ?>" class="checkbox_label">Author</label><br>
					    		<input type="checkbox" name="thumbnail<?php echo $index ?>" value="yes" <?php echo $thumbnail_cpt ?>/>
					    		<label for="thumbnail<?php echo $index ?>" class="checkbox_label">Thubmnail</label><br>
					    		<input type="checkbox" name="excerpt<?php echo $index ?>" value="yes" <?php echo $excerpt_cpt ?>/>
					    		<label for="excerpt<?php echo $index ?>" class="checkbox_label">Excerpt</label><br>
					    		<input type="checkbox" name="comments<?php echo $index ?>" value="yes" <?php echo $comments_cpt ?>/>
					    		<label for="comments<?php echo $index ?>" class="checkbox_label">Comments</label><br>
				    		</div>
		    		</div>
				    		<div class="text-center submit">
					          <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
					        </div>
		    	</div>
		    	<?php if($index % 4 == 4) :?>
		    	</div>
		    <?php endif;?>
	  <?php $index++; endwhile; ?> 
		</form>
  </div>

		    <?php 
					$index = 0;
					$args = array( 'post_type' => 'pwd_cpt', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'ID' );
					$loop = new WP_Query( $args ); 
					if($loop->have_posts()) :
					?>

 <div class="container">
	  <div class="row">
	  	<div class="twelve columns">
	  		<form name="cpt-delete-button" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
			  <input type="hidden" name="action" value="cpt_delete_button" />
			  <?php wp_nonce_field()?>
			    <div class="text-center" style="margin-top:30px;">
			    	<h6 style="display:inline;">Delete the </h6>
			    <select name="the-id" >
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<option value="<?php echo get_the_id() ?>"><?php echo get_the_title(); ?></option>
						<?php $index++; endwhile; ?> 
			    </select>
			    <h6 style="display:inline;"> custom post type</h6><br><br>
		          <input type="submit" name="Submit" class="button-warn" value="Delete" />
		        </div>
			  </form>
		  </div>
		</div>
	</div>

<?php endif; ?>
</section>