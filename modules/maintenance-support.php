<?php 
add_filter( 'template_include', 'portfolio_page_template', 99 );

function portfolio_page_template( $template ) {

	if ( is_page( get_option('maintenance-mode-page') )  ) {
		$new_template = plugin_dir_path(dirname(__FILE__)) . '/maintenance-view/page-maintenance-mode.php';
		if ( '' != $new_template ) {
			return $new_template ;
		}
	}

	return $template;
}
add_action('wp_head', 'pwd_maintenance_styling');
function pwd_maintenance_styling() {

 if ( is_page('coming-soon') ) {
  wp_enqueue_style( 'pwd_maintenance_css' , plugin_dir_url(dirname(__FILE__)) . '/maintenance.css' );

echo '<style type="text/css">
		.pwd-maintenance.landing{
			background-color:'.get_option('maintenance-mode-background').';
			color:'.get_option('maintenance-mode-font').' !important;
		}
		.pwd-maintenance a{
			color:'.get_option('maintenance-mode-accent').' !important;
		}
		.pwd-maintenance .ninja-forms-req-symbol {
		  color:'.get_option('maintenance-mode-accent').' !important;
		}
		.pwd-maintenance .button-primary{
			background-color:'.get_option('maintenance-mode-button').' !important;
			border-color:'.get_option('maintenance-mode-button').' !important;
		}
		.pwd-maintenance .button-primary:hover{
			background-color:'.get_option('maintenance-mode-button-hover').' !important;
			border-color:'.get_option('maintenance-mode-button-hover').' !important;
		}
		</style>';
	}
}
?>