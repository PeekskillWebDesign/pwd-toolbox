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
?>