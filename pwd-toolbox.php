<?php
/*
Plugin Name: PWD Toolset
Description: A toolset for websites developed by Peekskill Web Design
Author:      Peekskill Web Design
Version: 0.7.3
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

include_once('updater/updater.php');
    if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
        $config = array(
            'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
            'proper_folder_name' => 'pwd-toolbox', // this is the name of the folder your plugin lives in
            'api_url' => 'https://api.github.com/repos/PeekskillWebDesign/pwd-toolbox', // the GitHub API url of your GitHub repo
            'raw_url' => 'https://raw.github.com/PeekskillWebDesign/pwd-toolbox/master', // the GitHub raw url of your GitHub repo
            'github_url' => 'https://github.com/PeekskillWebDesign/pwd-toolbox', // the GitHub url of your GitHub repo
            'zip_url' => 'https://github.com/PeekskillWebDesign/pwd-toolbox/zipball/master', // the zip url of the GitHub repo
            'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
            'requires' => '4.0', // which version of WordPress does your plugin require?
            'tested' => '4.5.2', // which version of WordPress is your plugin tested up to?
            'readme' => 'ReadMe.md', // which file to use as the readme for the version number
            'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
        );
        new WP_GitHub_Updater($config);
    }

?>
