<section class="maintenance" id="maintenance" style="display:none;">
	<form name="form1" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
		<input type="hidden" name="action" value="pwd_maintenance" />
		<?php wp_nonce_field()?>
		<div class="container">
			<div class="row">
				<div class="twelve columns pwd_admin-card">
					<div class="text-center">
						<?php
						if(get_option('pwd_maintenance-mode') == 'on') {
							$checked = 'checked';
							echo '<div class="text-center">
		    				<a href="/coming-soon" target="_blank">Go To Page</a>
		    			</div>';
						} else {
							$checked = '';
						} ?>
          	
						<input type="checkbox" name="switch" <?php echo $checked ?>> <label style="display:inline;">Enable Maintenance Mode</label><br><br>
						<?php $settings = array (
                'id' => 'pwd_maintenance',
                'image-size' => "full"
                ); ?>
          	<?php pwd_media_uploader($settings); ?>	<br><br>
          	<label for="image-size">Image Size</label>
						<input type="text" name="image-size" value="<?php echo get_option('pwd_maintenance-mode-sizing') ?>">
							<label for="message">Maintenance Mode Message</label>
							<textarea name="message"><?php echo get_option('pwd_maintenance-mode-message'); ?></textarea><br><br>
						<div class="row">
							<div class="four columns">
								<label for="form">Ninja Form ID</label>
								<input type="text" name="form" value="<?php echo get_option('pwd_maintenance-mode-form') ?>">
							</div>
							<div class="four columns">
								<label for="background">Background Color</label>
								<input type="text" name="background" value="<?php echo get_option('pwd_maintenance-mode-background') ?>">
							</div>
							<div class="four columns">
								<label for="font">Font Color</label>
								<input type="text" name="font" value="<?php echo get_option('pwd_maintenance-mode-font') ?>">
							</div>
						</div><br><br>
						<div class="row">
							<div class="four columns">
								<label for="button">Button Color</label>
								<input type="text" name="button" value="<?php echo get_option('pwd_maintenance-mode-button') ?>">
							</div>
							<div class="four columns">
								<label for="button-hover">Button Hover Color</label>
								<input type="text" name="button-hover" value="<?php echo get_option('pwd_maintenance-mode-button-hover') ?>">
							</div>
							<div class="four columns">
								<label for="accent">Accent Color</label>
								<input type="text" name="accent" value="<?php echo get_option('pwd_maintenance-mode-accent') ?>">
							</div>
						</div>
					</div>
					<div class="submit text-center">
		    			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		    	</div>
				</div>
			</div>
		</div>
	</form>
</section>