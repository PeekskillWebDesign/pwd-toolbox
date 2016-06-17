<?php function pwd_maintenance_admin_action(){
    if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
if (!wp_verify_nonce($retrieved_nonce)){

    update_option('pwd_maintenance-mode-message', $_POST['message']);
    update_option('pwd_maintenance', $_POST['pwd_maintenance']);
    update_option('pwd_maintenance-mode-background', $_POST['background']);
    update_option('pwd_maintenance-mode-font', $_POST['font']);
    update_option('pwd_maintenance-mode-accent', $_POST['accent']);
    update_option('pwd_maintenance-mode-form', $_POST['form']);
    update_option('pwd_maintenance-mode-button', $_POST['button']);
    update_option('pwd_maintenance-mode-button-hover', $_POST['button-hover']);
    update_option('pwd_maintenance-mode-sizing', $_POST['image-size']);
  }
  wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=maintenance') );
 exit;
} 
add_filter( 'template_include', 'portfolio_page_template', 99 );

function pwd_maintenance_on_admin_action(){
if ( !current_user_can( 'manage_options' ) ) {
      wp_die( 'You are not allowed to be on this page.' );
   }
  if (!wp_verify_nonce($retrieved_nonce)){
  $new_page = array(
    'post_title' => 'Coming Soon',
    'post_name' => 'coming-soon',
    'post_status' => 'publish',
    'post_type' => 'page',
    'post_author' => $user_ID,
    'post_parent' => 0,
    'menu_order' => 0,
    'page_template' => 'page-maintenance-mode.php'
    );

    $maintenance_page = wp_insert_post( $new_page );
    //if we have created any new pages, then flush...
    if ( $newpages ) {
      wp_cache_delete( 'all_page_ids', 'pages' );
      $wp_rewrite->flush_rules();
    }
    update_option('pwd_maintenance-mode', 'on');
    update_option('maintenance-mode-page', $maintenance_page);
    
    wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=maintenance') );
  }
}
function pwd_maintenance_off_admin_action(){
  if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
  if (!wp_verify_nonce($retrieved_nonce)){
    wp_delete_post(get_option('maintenance-mode-page'), true);
    update_option('pwd_maintenance-mode', '');
    wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=maintenance') );
  }
}


function portfolio_page_template( $template ) {

	if ( is_page( get_option('maintenance-mode-page') )  ) {
		$new_template = plugin_dir_path(dirname(__FILE__)) . 'maintenance-view/page-maintenance-mode.php';
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}
add_action('wp_head', 'pwd_maintenance_styling');
function pwd_maintenance_styling() {

 if ( is_page('coming-soon') ) {
  wp_enqueue_style( 'pwd_maintenance_css' , plugin_dir_url(dirname(dirname(__FILE__))) . '/maintenance.css' );

echo '<style type="text/css">
		.pwd-maintenance{
			background-color:'.get_option('pwd_maintenance-mode-background').';
			color:'.get_option('pwd_maintenance-mode-font').' !important;
      font-size:14px;
		}
		.pwd-maintenance a{
			color:'.get_option('pwd_maintenance-mode-accent').' !important;
		}
		.pwd-maintenance .ninja-forms-req-symbol {
		  color:'.get_option('pwd_maintenance-mode-accent').' !important;
		}
		.pwd-maintenance .button-primary{
			background-color:'.get_option('pwd_maintenance-mode-button').' !important;
			border-color:'.get_option('pwd_maintenance-mode-button').' !important;
		}
		.pwd-maintenance .button-primary:hover{
			background-color:'.get_option('pwd_maintenance-mode-button-hover').' !important;
			border-color:'.get_option('pwd_maintenance-mode-button-hover').' !important;
		}
		.field-wrap:not(:last-child) input:focus {
		  outline: none;
		  border: 1px solid '.get_option('pwd_maintenance-mode-accent').';
		}
		.maintenance_image{
		  width:80vw ;
		  height:auto ;
		}
		@media(min-width:750px){
			  .maintenance_image{
			    width:'.get_option('pwd_maintenance-mode-sizing').';
			    height:auto;
			  }
		}
    body:before{
      max-height:0;
    }
    body:after{
      max-height:0;
    }

		</style>';
	}
}
if(get_option('pwd_maintenance-mode') == 'on'){
 add_action( 'template_redirect', 'pwd_redirect' );
 function pwd_redirect() {
   if ( !is_page('coming-soon') && !is_user_logged_in() && !is_page('wp_admin')) {
     wp_redirect( '/coming-soon' );
    exit;
  }
 }
}
?>