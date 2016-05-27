<?php 
function pwd_toolbox_activate() {
 add_option('pwd_google_analytics', '');
 add_option('pwd_favicon', '#');
 add_option('pwd_login', 'images/wordpress-logo.svg?ver=20131107');
 add_option('pwd-custom-css', '');
 add_option('pwd_maintenance-mode', '');
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
}
register_activation_hook( __FILE__, 'pwd_toolbox_activate' );
?>