<?php
/*
Plugin Name: PWD Toolset
Description: A toolset for websites developed by Peekskill Web Design
Author:      Peekskill Web Design
Version: 0.5.1
GitHub Plugin URI: https://github.com/PeekskillWebDesign/pwd-toolbox
*/

// ********************** SHORTCODES ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/shortcodes.php');

// ********************** REGISTER ADMIN MENU ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/admin-menu-setup.php');

// ********************** ADMIN MENU ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/admin-menu-view.php');

include( plugin_dir_path( __FILE__ ) . 'modules/admin-menu-functions.php');

include( plugin_dir_path( __FILE__ ) . 'modules/admin-menu-image-uploader.php');

// ********************** SOCIAL WIDGET ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/social-widget.php');

// ********************** CUSTOM POST EXCERPTS ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/custom-excerpt.php');

// ********************** LOGIN PAGE EDITS ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/login-page.php');

// ********************** IMAGE SIZE HELPERS ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/image-size-helpers.php');

// ********************** CUSTOM POST TYPES ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/cpt-support.php');


// ********************** MAINTENANCE MODE ********************** //

include( plugin_dir_path( __FILE__ ) . 'modules/maintenance-support.php');

// ********************** PLUGIN UPDATER ********************** //


add_action( 'admin_init', 'pwd_handle_updates' );
function pwd_handle_updates(){
require_once( 'modules/pwd-updater.php' );
  if ( is_admin() ) {
      new BFIGitHubPluginUpdater( __FILE__, 'PeekskillWebDesign', "pwd-toolbox" );
  }
}
?>
