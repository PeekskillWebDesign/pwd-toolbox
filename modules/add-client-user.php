<?php
add_action('init', 'pwd_add_client');
function pwd_add_client(){
	add_role('client', __( 'Client' ), array('read => true'));

	if(current_user_can('client')){
		show_admin_bar(false);
	}
}


?>