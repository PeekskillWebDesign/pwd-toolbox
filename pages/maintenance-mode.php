<section class="maintenance" id="maintenance" style="display:none;">
	<form name="form1" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
		<input type="hidden" name="action" value="pwd_maintenance" />
		<div class="container">
			<div class="row">
				<div class="twelve columns pwd_admin-card">
					<div class="text-center">

          	
						<input type="checkbox" name="switch" <?php get_option('maintenance-mode'); ?>> <label style="display:inline;">Enable Maintenance Mode</label><br><br>
						<?php $settings = array (
                'id' => 'maintenance',
                'image-size' => "large"
                ); ?>
          	<?php pwd_media_uploader($settings); ?>	<br><br>
						<label for="message">Maintenance Mode Message<?php get_option('maintenance-mode'); ?></label>
						<textarea name="message"><?php get_option('maintenance-mode-message'); ?></textarea>
						<label for="ninja-form">Ninja Form ID</label>
						<input type="ninja-form">

					</div>
					<div class="submit text-center">
		    			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		    	</div>
				</div>
			</div>
		</div>
	</form>
</section>