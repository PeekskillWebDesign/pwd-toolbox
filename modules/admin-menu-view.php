<?php function PWD_toolbox_options(){
  add_option('google_analytics', '');
  add_option('favicon', '#');
  add_option('login', '#');
  //Loop through custom post types
    $types = get_post_types();
    $type_i = 0;
    foreach( $types as $type ) {
      if($type != 'attachment' && $type != 'revision' && $type != 'nav_menu_item' && $type != 'acf') {
        add_option('pwd-'.$type.'-image-size');
      }
    }

    // HEADER

    ?>
<div class="wrap">
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
<?php

    //PAGES  
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/settings.php'); 
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/videos.php'); 
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/image-sizes.php'); 

    //FOOTER

?>
</form>
</div><!--pwd_toolset_wrap--> 
</div>
<?php
}
//enqueue menu scripts
function pwd_enqueue_admin_scripts($hook) {
      if ( 'toplevel_page_pwdtoolbox' != $hook ) {
        return;
    }

  wp_enqueue_script( 'admin_menu_scripts', plugin_dir_url(dirname(__FILE__)) . '/scripts/admin-menu.js');
}
add_action( 'admin_enqueue_scripts', 'pwd_enqueue_admin_scripts' );

//enqueue menu css
add_action('admin_head', 'pwd_toolset_styling'); //enqueue styles

function pwd_toolset_styling($hook) {
  wp_enqueue_style( 'pwd_toolset_css' , plugin_dir_url(dirname(__FILE__)) . '/style.css' );
} ?>
