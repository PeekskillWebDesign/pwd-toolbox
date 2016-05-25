<?php 

function pwd_settings_admin_action() {
   if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   if (!wp_verify_nonce($retrieved_nonce)){
     print_r($_POST);
    //set analytics
     update_option('google_analytics', $_POST['google_analytics']);


     //set favicon
     $favicon_original = $_POST['favicon'];
     if(strpos($favicon_original, '32x32') == false) {
      $favicon = str_replace( '.png', '-32x32.png', $favicon_original);
    } else {
      $favicon = $favicon_original;
    }
     update_option('favicon', $favicon);

     //login image
     update_option('login', $_POST['login']);
  }


   wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox') );
 exit;
}
function pwd_images_admin_action() {
     if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   if (!wp_verify_nonce($retrieved_nonce)){
     //Loop through custom post types
      $types = get_post_types();
      $type_i = 0;
      foreach( $types as $type ) {
          update_option('pwd-'.$type.'-image-size', $_POST['pwd-'.$type.'-image']);
      }
    }
     wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=image-sizes') );
 exit;
}

include( dirname(__FILE__) . '/custom-css-functions.php');
include( dirname(__FILE__) . '/cpt-functions.php');


function pwd_maintenance_admin_action(){
    if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
if (!wp_verify_nonce($retrieved_nonce)){

  if(get_option('maintenance-mode') == '' && $_POST['switch'] == 'on'){
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
    update_option('maintenance-mode', 'on');
    update_option('maintenance-mode-page', $maintenance_page);
  } elseif(get_option('maintenance-mode') == 'on' && $_POST['switch'] == '') {
    wp_delete_post(get_option('maintenance-mode-page'), true);
    update_option('maintenance-mode', '');
  } elseif(get_option('maintenance-mode') == 'on' && $_POST['switch'] == 'on') {
  }
    update_option('maintenance-mode-message', $_POST['message']);
    update_option('maintenance', $_POST['maintenance']);
    update_option('maintenance-mode-background', $_POST['background']);
    update_option('maintenance-mode-font', $_POST['font']);
    update_option('maintenance-mode-accent', $_POST['accent']);
    update_option('maintenance-mode-form', $_POST['form']);
    update_option('maintenance-mode-button', $_POST['button']);
    update_option('maintenance-mode-button-hover', $_POST['button-hover']);
    update_option('maintenance-mode-sizing', $_POST['image-size']);
  }
  wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=maintenance') );
 exit;
}

//printed html


function PWD_anaylitics_html(){
  $google_analytics = get_option('google_analytics');


  if(isset($google_analytics)){
    echo "<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create','".$google_analytics."', 'auto');
      ga('send', 'pageview');

    </script>";
    }
  }
add_action('wp_head', 'PWD_anaylitics_html');

add_image_size('favicon-16', 16, 16, true);
add_image_size('favicon-32', 32, 32, true);
add_image_size('favicon-152', 152, 152, true);

function PWD_favicon_html(){
  $favicon_url = get_option('favicon');
    echo '<link rel="shortcut icon" href="'.$favicon_url.'">';
}
add_action('wp_head', 'PWD_favicon_html');
add_action( 'admin_head', 'PWD_favicon_html' );




?>