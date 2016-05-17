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

function cpt_add_button_admin_action() {
  if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
  if (!wp_verify_nonce($retrieved_nonce)){
    $args = array(
      'post_title'    => 'new-cpt',
      'post_content' => ' ',
      'post_type'=>'pwd_cpt',
    );
   $pwd_new_post = wp_insert_post($args);

    update_post_meta( $pwd_new_post, '_plural', 'New Cpts', true );
    update_post_meta( $pwd_new_post, '_single', 'New Cpt', true );
    update_post_meta( $pwd_new_post, '_dashicon', 'dashicons-admin-post', true );

 }
  wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=cpt') );
 exit;
}
function cpt_delete_button_admin_action() {
  if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
  }
  if (!wp_verify_nonce($retrieved_nonce)){
    wp_delete_post( $_POST['the-id'], true);
  }
  wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=cpt') );

 exit;
}
function pwd_cpt_admin_action() {
    if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   if (!wp_verify_nonce($retrieved_nonce)){
      function pwd_cpt_action_checkbox($item, $index) {
        if($_POST[$item.$index] == 'yes') {
          update_post_meta( get_the_id(), '_'.$item, 'checked' );
        } else {
          update_post_meta( get_the_id(), '_'.$item, ' ' );
        }
       }
      function pwd_cpt_action_text_field($item, $index) {
        if(isset($_POST[$item.$index])) {
          update_post_meta( get_the_id(), '_'.$item, sanitize_text_field( $_POST[$item.$index] ) );
        }
      }
      global $post;
      $index = 0;
      $args = array( 'post_type' => 'pwd_cpt', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'ID' );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post(); 

      if(isset($_POST['name'.$index])) {
          wp_update_post(array('ID' => get_the_id(), 'post_title' => $_POST['name'.$index]));
        }

      pwd_cpt_action_text_field('plural', $index);
      pwd_cpt_action_text_field('single', $index);
      pwd_cpt_action_text_field('dashicon', $index);
      pwd_cpt_action_text_field('plural', $index);

      pwd_cpt_action_checkbox('public', $index);
      pwd_cpt_action_checkbox('hierarchial', $index);
      pwd_cpt_action_checkbox('archive', $index);
      pwd_cpt_action_checkbox('title', $index);
      pwd_cpt_action_checkbox('editor', $index);
      pwd_cpt_action_checkbox('author', $index);
      pwd_cpt_action_checkbox('thumbnail', $index);
      pwd_cpt_action_checkbox('excerpt', $index);
      pwd_cpt_action_checkbox('comments', $index);
      $index++; endwhile;
  }
  wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=cpt') );
 exit;
}
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
  }
  wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox&loc=maintenance') );
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
  function pwd_cpt_checkbox($id, $item) {
    if(get_post_meta( $id, '_'.$item, true ) == 'checked'){
      return true;
    } else {
      return false;
    }
  }
  function pwd_cpt_supports($id, $item) {
    if(get_post_meta( $id, '_'.$item, true ) == 'checked'){
      return $item;
    } else {
      return '';
    }
  }
  global $post;
  $args = array( 'post_type' => 'pwd_cpt', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'ID' );
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) : $loop->the_post();
  $plural_cpt = get_post_meta( $post->ID, '_plural', true );
  $single_cpt = get_post_meta( $post->ID, '_single', true );
  $dashicon_cpt = get_post_meta( $post->ID, '_dashicon', true );
  $public_cpt = pwd_cpt_checkbox($post->ID,'public');
  $hierarchial_cpt = pwd_cpt_checkbox($post->ID,'hierarchial');
  $archive_cpt = pwd_cpt_checkbox($post->ID,'archive');
  $title_cpt = pwd_cpt_supports($post->ID, 'title');
  $author_cpt = pwd_cpt_supports($post->ID, 'author');
  $thumbnail_cpt = pwd_cpt_supports($post->ID, 'thumbnail');
  $excerpt_cpt = pwd_cpt_supports($post->ID, 'excerpt');
  $editor_cpt = pwd_cpt_supports($post->ID, 'editor');
  $comments_cpt = pwd_cpt_supports($post->ID, 'comments');

  if(get_the_title() !== 'new-cpt'){

    $labels = array(
      'name'               => ( get_the_title() ),
      'singular_name'      => ( $single_cpt ),
      'menu_name'          => ( $plural_cpt ),
    );

    $args = array(
      'labels'             => $labels,
      'public'             => $public_cpt,
      'rewrite'            => array( 'slug' => get_the_title() ),
      'capability_type'    => 'post',
      'has_archive'        => $archive_cpt,
      'hierarchical'       => $hierarchial_cpt,
      'menu_position'      => null,
      'menu_icon'          => $dashicon_cpt,
      'supports'           => array( $title_cpt, $editor_cpt, $author_cpt, $thumbnail_cpt, $excerpt_cpt, $comments_cpt )
    );

    register_post_type( get_the_title(), $args );
  }
  endwhile;
}

?>