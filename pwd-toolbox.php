<?php
/*
Plugin Name: PWD Toolset
Description: A toolset for websites developed by Peekskill Web Design
Author:      Peekskill Web Design
Version: 0.6.3
GitHub Plugin URI: https://github.com/PeekskillWebDesign/pwd-toolbox
*/

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
