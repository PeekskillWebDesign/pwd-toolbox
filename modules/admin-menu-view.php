<?php function PWD_toolbox_options(){
  add_option('google_analytics', '');
  add_option('favicon', '#');
  add_option('login', 'images/wordpress-logo.svg?ver=20131107');
  add_option('pwd-custom-css', '');
  add_option('maintenance-mode', '');
  add_option('maintenance-mode-message', 'COMPANY NAME is currently under construction! If your have any questions, please feel free to contact us via phone at (xxx)xxx-xxxx. Also, be sure to sign up for our mailing list.'); 
  add_option('maintenance-mode-page', '');
  add_option('maintenance', '');
  add_option('maintenance-mode-font', '#222');
  add_option('maintenance-mode-accent', '#007acc');
  add_option('maintenance-mode-background', '#fff');
  add_option('maintenance-mode-form', '');
  add_option('maintenance-mode-button', '#007acc');
  add_option('maintenance-mode-button-hover', '#007acc');
  add_option('maintenance-mode-sizing', '35vw');

  //Loop through custom post types
    $types = get_post_types();
    $type_i = 0;
    $dont_show=['attachment', 'revision', 'nav_menu_item', 'acf', 'pwd_cpt', 'newcpt', 'nf_sub'];
      foreach( $types as $type ) {
      if(!in_array($type, $dont_show)) {
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
      </div>
    </div>
  </div>
</section>

<?php

    //PAGES
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/settings.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/videos.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/image-sizes.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/custom-css.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/cpt.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/maintenance-mode.php');

    //FOOTER

?>
<section id="admin-menu">
  <div class="container">
    <div class="row">
      <div class="twelve columns pwd_toolset_admin_nav">
        <p>For developer use only: &nbsp;
        <a href="#" class="menu-link" name="image-sizes">Image Sizes</a>
        <a href="#" class="menu-link" name="custom-css">Custom CSS</a>
        <a href="#" class="menu-link" name="cpt">Custom Post Types</a>
        <a href="#" class="menu-link" name="maintenance">Maintenance Mode</a>
      </div>
    </div>
  </div>
</section>
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
add_action('admin_head', 'pwd_toolset_styling');

function pwd_toolset_styling($hook) {
  wp_enqueue_style( 'pwd_toolset_css' , plugin_dir_url(dirname(__FILE__)) . '/style.css' );
}?>
