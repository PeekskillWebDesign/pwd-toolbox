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
        <a href="#" class="menu-link" name="image-sizes">Image Sizes</a>
      </div>
    </div>
  </div>
</section>

  <form name="form1" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
    <input type="hidden" name="action" value="PWD" />
<section class="settings is-visible" id="settings">
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
        <div class="four columns text-center pwd_admin-card login-logo-card">
          <h5>Login Page Logo</h5>
          <p>Upload an image to be used as the logo in the login page</p> 
          <?php $login_settings = array (
                'id' => 'login',
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
                'id' => 'favicon'
                ); ?>
          <?php pwd_media_uploader($favicon_settings); ?>
          <div class="submit text-center">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
          </div>
        </div>
      </div>
    </div>
</section>
<section class="videos" id="videos" style="display:none;">
  <div class="container">
    <div class="row">
      <a href="https://www.youtube.com/channel/UCa8ia60opNBDobNCcnQi7SQ" class="text-center" style="margin-bottom:0;"><p>Check Out Our Youtube Channel</p></a>
    </div>
  </div>
  <div class="container">
  <?php 
//Get youtube feed
$uri = 'https://www.youtube.com/feeds/videos.xml?channel_id=UCa8ia60opNBDobNCcnQi7SQ';
$feed = fetch_feed( $uri );
 
if ( is_wp_error( $feed ) ) {
    return false;
} else {
    $maxitems = $feed->get_item_quantity( 99 );
    $rss_items = $feed->get_items( 0, $maxitems );
 
    if ( $maxitems == 0 ) :
        return false;
    else :
        if ( is_array( $rss_items ) ) : 
        function pwd_get_yt_ID( $uri ) {
 
        // how long YT ID's are
        $id_len = 11;
     
        // where to start looking
        $id_begin = strpos( $uri, '?v=' );
        // if the id isn't at the beginning of the uri for some reason
        if( $id_begin === FALSE )
            $id_begin = strpos( $uri, "&v=" );
        // all else fails
        if( $id_begin === FALSE )
            wp_die( 'YouTube video ID not found. Please double-check your URL.' );
        // now go to the proper start
        $id_begin +=3;
     
        // get the ID
        $yt_ID = substr( $uri, $id_begin, $id_len);
     
        return $yt_ID;
      } 

    $i = 0;

    foreach ( array_reverse($rss_items) as $item ) :
        $id = pwd_get_yt_ID( $item->get_permalink() );
    ?>
    <?php if($i % 2 == 0) : ?>
      <div class="row">
    <?php endif; ?>
  <?php $video = $id; 
  include(plugin_dir_path(dirname(__FILE__)) .'/partials/video-partial.php'); ?>
      <?php if($i % 2 == 2) : ?>
      </div>
    <?php endif; ?>
<?php $i++; endforeach; ?>
<?php endif;
    endif;
} ?>
  </div>
</section>
<section class='image-sizes' id="image-sizes" style="display:none;">
  <div class="container">
    <?php $types = get_post_types();
    $type_i = 0;
      foreach( $types as $type ) :
      if($type != 'attachment' && $type != 'revision' && $type != 'nav_menu_item' && $type != 'acf') :
     ?>
     <?php if($type_i % 3 == 0) : ?>
      <div class="row">
    <?php endif; ?>
      <div class="four columns text-center pwd_admin-card image-size-card">
        <h5 style="margin-bottom:5px;">Featured Image</h5>
        <h6><?php echo $type ?></h6>
        <p>Enter the optimal image size for this post to be displayed on the featured image metabox</p>
        <input type="text" name="pwd-<?php echo $type;?>-image" value="<?php echo get_option('pwd-'.$type.'-image-size') ?>" placeholder="500px x 500px">
        <div class="submit text-center">
          <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
        </div>
      </div>
    <?php if($type_i % 3 == 3) : ?>
      </div>
    <?php endif; ?>
  <?php $type_i++; endif; endforeach; ?>
  </div>
</section>
</form>
</div><!--pwd_toolset_wrap-->