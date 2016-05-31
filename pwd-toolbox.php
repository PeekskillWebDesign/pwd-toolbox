<?php
/*
Plugin Name: PWD Toolset
Description: A toolset for websites developed by Peekskill Web Design
Author:      Peekskill Web Design
Version: 0.6.4
GitHub Plugin URI: https://github.com/PeekskillWebDesign/pwd-toolbox
*/

function pwd_toolbox_activate() {
 add_option('pwd_google_analytics', '');
 add_option('pwd_favicon', '#');
 add_option('pwd_login', 'images/wordpress-logo.svg?ver=20131107');
 add_option('pwd-custom-css', '');
 add_option('pwd_maintenance-mode', '');
 add_option('pwd_maintenance-mode-message', 'COMPANY NAME is currently under construction! If your have any questions, please feel free to contact us via phone at (xxx)xxx-xxxx. Also, be sure to sign up for our mailing list.'); 
 add_option('maintenance-mode-page', '');
 add_option('pwd_maintenance', '');
 add_option('pwd_maintenance-mode-font', '#222');
 add_option('pwd_maintenance-mode-accent', '#007acc');
 add_option('pwd_maintenance-mode-background', '#fff');
 add_option('pwd_maintenance-mode-form', '');
 add_option('pwd_maintenance-mode-button', '#007acc');
 add_option('pwd_maintenance-mode-button-hover', '#007acc');
 add_option('pwd_maintenance-mode-sizing', '35vw');

  //Loop through custom post types
    $types = get_post_types();
    $type_i = 0;
    $dont_show=['attachment', 'revision', 'nav_menu_item', 'acf', 'pwd_cpt', 'newcpt', 'nf_sub'];
      foreach( $types as $type ) {
      if(!in_array($type, $dont_show)) {
        add_option('pwd-'.$type.'-image-size');
      }
    }
}
register_activation_hook( __FILE__, 'pwd_toolbox_activate' );
// ********************** SHORTCODES ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/shortcodes.php');

// ********************** REGISTER ADMIN MENU ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/admin-menu-setup.php');

// ********************** ADMIN MENU ********************** //

include( plugin_dir_path( __FILE__ ) . 'pages/admin-menu-main.php');

include( plugin_dir_path( __FILE__ ) . 'pages/functions/functions-main.php');

include( plugin_dir_path( __FILE__ ) . 'modules/admin-menu-image-uploader.php');

// ********************** SOCIAL WIDGET ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/social-widget.php');

// ********************** CUSTOM POST EXCERPTS ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/custom-excerpt.php');

// ********************** CLIENT USER ROLE ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/add-client-user.php');

// ********************** PLUGIN UPDATER ********************** //


add_action( 'admin_init', 'pwd_handle_updates' );
function pwd_handle_updates(){
require_once( 'modules/pwd-updater.php' );
  if ( is_admin() ) {
      new BFIGitHubPluginUpdater( __FILE__, 'PeekskillWebDesign', "pwd-toolbox" );
  }
}
?>
