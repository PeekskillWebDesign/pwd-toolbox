<?php function pwd_images_admin_action() {
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
function pwd_featured_image_setup($post_type, $pwd_text) {
  add_meta_box('postimagediv', __('Featured Image'), 'pwd_featured_meta_box', $post_type, 'side', 'default', array('text'=>$pwd_text ));

}
function pwd_featured_meta_box($post, $metabox) {
      $thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true );
    echo _wp_post_thumbnail_html( $thumbnail_id, $post->ID );
    echo '<p><b>'.$metabox['args']['text'].'</b><br> is the optimal size for this image. Any images larger than this will be cropped to this size at the center.</p>';
}

 //Loop through custom post types
function pwd_featured_image() {
  $types = get_post_types();
  $type_i = 0;
  foreach( $types as $type ) {
    if(!get_option('pwd-'.$type.'-image-size') == '') {
    $dont_show=['attachment', 'revision', 'nav_menu_item', 'acf', 'pwd_cpt', 'newcpt', 'nf_sub'];
      if(!in_array($type, $dont_show)) {
        pwd_featured_image_setup($type, get_option('pwd-'.$type.'-image-size'));
      } 
    }
  }
}
add_action('do_meta_boxes', 'pwd_featured_image');?>