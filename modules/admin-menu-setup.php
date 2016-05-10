<?php 
add_action( 'admin_menu', 'PWD_toolbox_menu' );
add_action( 'admin_action_PWD', 'PWD_admin_action' );
function PWD_toolbox_menu() {
add_menu_page( 'PWD Theme Options', 'PWD Theme Options', 'manage_options', 'pwdtoolbox', 'PWD_toolbox_options','dashicons-admin-tools');
}
?>