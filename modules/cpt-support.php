<?php 
add_action( 'init', 'plugin_create_post_type' );
function plugin_create_post_type() {
  register_post_type( 'pwd_cpt',
    array(
      'labels' => array(
        'name' => __( 'cpt' ),
        'singular_name' => __( 'cpt' )
      ),
      'public' => false,
      'has_archive' => true,
      'supports' => array('title')
    )
  );
}

function pwd_cpt_add_meta_boxes( $post ){
	add_meta_box( 'food_meta_box', 'CPT Data', 'food_build_meta_box', 'pwd_cpt', 'normal', 'low' );
}
add_action( 'add_meta_boxes_pwd_cpt', 'pwd_cpt_add_meta_boxes' );
function food_build_meta_box( $post ){
wp_nonce_field( basename( __FILE__ ), 'pwd_cpt_box_nonce' );
$plural_cpt = get_post_meta( $post->ID, '_plural', true );
$single_cpt = get_post_meta( $post->ID, '_single', true );
$dashicon_cpt = get_post_meta( $post->ID, '_dashicon', true );
  ?>
  <div class='inside'>
    <input type="text" name="plural" value ="<?php echo $name_cpt ?>">
    <input type="text" name="single" value ="<?php echo $single_cpt ?>">
    <input type="text" name="dashicon" value ="<?php echo $dashicon_cpt ?>">
  </div>
<?php
}
function pwd_cpt_save_meta_boxes_data( $post_id ){
  if ( !isset( $_POST['pwd_cpt_box_nonce'] ) || !wp_verify_nonce( $_POST['pwd_cpt_box_nonce'], basename( __FILE__ ) ) ){
  return;
}
  // return if autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
    return;
  }
  // Check the user's permissions.
  if ( ! current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  if(isset($_POST['plural'])) {
    update_post_meta( $post_id, '_plural', sanitize_text_field( $_POST['plural'] ) );
  }
      if(isset($_POST['single'])) {
    update_post_meta( $post_id, '_single', sanitize_text_field( $_POST['single'] ) );
  }
    if(isset($_POST['dashicon'])) {
    update_post_meta( $post_id, '_dashicon', sanitize_text_field( $_POST['dashicon'] ) );
  }
}
add_action( 'save_post_pwd_cpt', 'pwd_cpt_save_meta_boxes_data', 10, 2 );
?>