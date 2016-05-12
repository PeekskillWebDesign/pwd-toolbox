<?php 

function pwd_settings_admin_action() {
   if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
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


   wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox') );
 exit;
}
function pwd_images_admin_action() {
     if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
     //Loop through custom post types
    $types = get_post_types();
    $type_i = 0;
    foreach( $types as $type ) {
        update_option('pwd-'.$type.'-image-size', $_POST['pwd-'.$type.'-image']);
  }
     wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=image-sizes') );
 exit;
}
function pwd_css_admin_action() {
     if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
//custom-css
    update_option('pwd-custom-css', $_POST['custom-css-field']);

     wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=custom-css') );
 exit;
}

function cpt_add_button_admin_action() {
  if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   wp_insert_post(array(
      'post_title'    => 'new-cpt',
      'post_content' => ' ',
      'post_type'=>'pwd_cpt',
    ));
  wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=cpt') );
 exit;
}
function cpt_delete_button_admin_action() {
  if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }

    wp_delete_post( $_POST['the-id'], true);
    wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=cpt') );
 exit;
}
function pwd_cpt_admin_action() {
    if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
  global $post;
  $index = 0;
  $args = array( 'post_type' => 'pwd_cpt', 'posts_per_page' => -1 );
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post(); 

    if(isset($_POST['name'.$index])) {
      wp_update_post(array('ID' => get_the_id(), 'post_title' => $_POST['name'.$index]));
    }
  if(isset($_POST['plural'.$index])) {
    update_post_meta( get_the_id(), '_plural', sanitize_text_field( $_POST['plural'.$index] ) );
  }
  if(isset($_POST['single_cpt'.$index])) {
    update_post_meta( get_the_id(), '_single', sanitize_text_field( $_POST['single_cpt'.$index] ) );
  }
  if(isset($_POST['dashicon'.$index])) {
    update_post_meta( get_the_id(), '_dashicon', sanitize_text_field( $_POST['dashicon'.$index] ) );
  }
  $index++; endwhile;
     wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=cpt') );
 exit;
}


//printed html

function pwd_custom_css() {
  if(get_option('pwd-custom-css') !== '') {
    echo '<style type="text/css">'.get_option('pwd-custom-css').'</style>';
  }
}
add_action('wp_head', 'pwd_custom_css');

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


add_action( 'init', 'pwd_cpt_init' );
function pwd_cpt_init() {
  global $post;
  $args = array( 'post_type' => 'pwd_cpt', 'posts_per_page' => -1 );
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post();
  $plural_cpt = get_post_meta( $post->ID, '_plural', true );
  $single_cpt = get_post_meta( $post->ID, '_single', true );
  $dashicon_cpt = get_post_meta( $post->ID, '_dashicon', true ); 

    $labels = array(
      'name'               => ( get_the_title() ),
      'singular_name'      => ( $single_cpt ),
      'menu_name'          => ( $plural_cpt ),
    );

    $args = array(
      'labels'             => $labels,
      'public'             => true,
      'rewrite'            => array( 'slug' => 'book' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'menu_icon'          => $dashicon_cpt,
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( get_the_title(), $args );
  endwhile;
}

?>