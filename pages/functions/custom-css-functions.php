<?php 
function pwd_css_admin_action() {
     if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   if (!wp_verify_nonce($retrieved_nonce)){
    //custom-css
    update_option('pwd-custom-css', $_POST['custom-css-field']);
  }
  wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=custom-css') );

 exit;
} 

function pwd_custom_css() {
  if(get_option('pwd-custom-css') !== '') {
    echo '<style type="text/css">/*pwd-toolbox*/'.get_option('pwd-custom-css').'</style>';
  }
}
add_action('wp_head', 'pwd_custom_css');

?>