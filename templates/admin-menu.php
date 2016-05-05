<div class ="pwd_toolset_wrap">
  <div class="container">
    <div class="row">
      <div class="twelve columns text-center">
        <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . '/images/PWD-theme-options.png' ?>">
      </div>
    </div>
  </div>
<section id="menu">
  <div class="container">
    <div class="row">
      <div class="text-center pwd_toolset_navbar">
        <a href="#" class="menu-link is-active" name="settings">Settings</a>
        <a href="#" class="menu-link" name="videos">Instructional Videos</a>
      </div>
    </div>
  </div>
</section>
<section class="settings is-visible" id="settings">
  <form name="form1" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
    <input type="hidden" name="action" value="PWD" />
    <div class="container">
      <div class="row">
        <div class="four columns text-center pwd_admin-card">
          <h5>Google Analytics</h5>
          <p>Google Analytics can help you track who is visiting your site and how they are interacting with your site. Learn more about Google Analytics <a href="http://www.google.com/analytics/">here</a>.</p><br><br><br>
          <p>Enter your Google Analytics ID here</p>
          <p><input type="text" name="google_analytics" placeholder="UA-********-*" value="<?php echo get_option('google_analytics'); ?>"></p>
          <div class="submit text-center">
          <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
          </div>
        </div>
        <div class="four columns text-center pwd_admin-card">
          <h5>Login Page Logo</h5>
          <p>Upload an image to be used as the logo in the login page</p> 
          <?php $login_settings = array (
                'id' => 'login',
                'added-scripts' => "",
                'image-size' => "medium"
                ); ?>
          <?php pwd_media_uploader($login_settings); ?>
          <div class="submit text-center">
          <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
          </div>
        </div>
        <div class="four columns text-center pwd_admin-card">
          <h5>Favicon</h5>
          <p>A favicon is a small image that appears next to your website name in browser tabs</p>
          <p>Upload an image to be used as a favicon. The image must be a <b>PNG</b> file and it will be resized to 32px x 32px</p> 
          <?php $favicon_settings = array (
                'id' => 'favicon',
                'added-scripts' => "

                    var favicon_url = image_url.replace('.png', '-32x32.png')
                      // If the Image is a png use it. If not flash warning
                      if(image_url.indexOf('png') < 0 ) {
                        jQuery('#png-warning').show();
                      } else {
                        jQuery('#png-warning').hide();
                        jQuery('#image_url').val(image_url);
                        jQuery('#favicon-image').attr('src', favicon_url);
                        jQuery('#favicon-image').show(); 
                      }"
                ); ?>
          <?php pwd_media_uploader($favicon_settings); ?>
          <div class="submit text-center">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
          </div>
        </div>
      </div>
    </div>
  </form>
</section>
<section class="videos" id="videos" style="display:none;">
  <div class="container">
    <div class="row">
      <a href="https://www.youtube.com/channel/UCa8ia60opNBDobNCcnQi7SQ" class="text-center" style="margin-bottom:0;"><h6>Check Out Our Youtube Channel</h6></a>
    </div>
  </div>
  <?php $video = 'aVDryrdY7Tw'; 
  include(plugin_dir_path(dirname(__FILE__)) .'/partials/video-partial.php'); ?>

  <?php $video = 'dpU9FSAFxkk'; 
  include(plugin_dir_path(dirname(__FILE__)) .'/partials/video-partial.php'); ?>

  <?php $video = 'K8bVDGULfK0'; 
  include(plugin_dir_path(dirname(__FILE__)) .'/partials/video-partial.php'); ?>

  <?php $video = '6abtSV8tEXA'; 
  include(plugin_dir_path(dirname(__FILE__)) .'/partials/video-partial.php'); ?>

  <?php $video = 'y9fR1n0927k'; 
  include(plugin_dir_path(dirname(__FILE__)) .'/partials/video-partial.php'); ?>

  <?php $video = 'NjDBOJ-RvVU'; 
  include(plugin_dir_path(dirname(__FILE__)) .'/partials/video-partial.php'); ?>

</section>

</div><!--pwd_toolset_wrap-->