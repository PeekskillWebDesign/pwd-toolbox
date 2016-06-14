<?php 
add_action( 'admin_menu', 'PWD_toolbox_menu' );
add_action( 'admin_action_pwd_settings', 'pwd_settings_admin_action' );
add_action( 'admin_action_pwd_images', 'pwd_images_admin_action' );
add_action( 'admin_action_pwd_css', 'pwd_css_admin_action' );
add_action( 'admin_action_cpt_add_button', 'cpt_add_button_admin_action' );
add_action( 'admin_action_pwd_cpt', 'pwd_cpt_admin_action' );
add_action( 'admin_action_cpt_delete_button', 'cpt_delete_button_admin_action' );
add_action( 'admin_action_pwd_maintenance', 'pwd_maintenance_admin_action' );

function PWD_toolbox_menu() {
add_menu_page( 'PWD Theme Options', 'PWD Theme Options', 'manage_options', 'pwdtoolbox', 'PWD_toolbox_options',plugin_dir_url(dirname(__FILE__)) . 'images/PWD-Logo.png');
}
?>