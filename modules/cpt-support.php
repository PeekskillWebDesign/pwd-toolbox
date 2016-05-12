<?php 
add_action( 'init', 'plugin_create_post_type' );
function plugin_create_post_type() {
  register_post_type( 'pwd_cpt',
    array(
      'labels' => array(
        'name' => __( 'cpt' ),
        'singular_name' => __( 'cpt' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array('title')
    )
  );
}


?>