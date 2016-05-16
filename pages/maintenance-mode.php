<section class="maintenance" id="maintenance" style="display:none;">
	<form name="form1" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
		<input type="hidden" name="action" value="pwd_maintenance" />
		<?php wp_nonce_field()?>
		<div class="container">
			<div class="row">
				<div class="twelve columns pwd_admin-card">
					<div class="text-center">
						<?php
						if(get_option('maintenance-mode') == 'on') {
							$checked = 'checked';
						} else {
							$checked = '';
						} ?>
          	
						<input type="checkbox" name="switch" <?php echo $checked ?>> <label style="display:inline;">Enable Maintenance Mode</label><br><br>
						<?php $settings = array (
                'id' => 'maintenance',
                'image-size' => "large"
                ); ?>
          	<?php pwd_media_uploader($settings); ?>	<br><br>
						<label for="message">Maintenance Mode Message</label>
						<textarea name="message"><?php echo get_option('maintenance-mode-message'); ?></textarea>
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