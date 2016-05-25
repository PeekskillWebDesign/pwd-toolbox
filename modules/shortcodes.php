<?php //----------SECTION--------------//
function section_shortcode($atts,$content,$tags) {
$value = shortcode_atts(array(
    'class' => ''
    ), $atts);
  return '<section class="'.$value['class'].'">'.do_shortcode($content).'</section>'; 
}
add_shortcode('section','section_shortcode');

//----------CONTAINER--------------//
function container_shortcode($atts,$content,$tags) {
$value = shortcode_atts(array(
		'class' => ''
		), $atts);
	return '<div class="container '.$value['class'].'">'.do_shortcode($content).'</div>'; 
}
add_shortcode('container','container_shortcode');

//-------------ROW-------------//
function row_shortcode($atts,$content,$tags) {
    $value = shortcode_atts(array(
    'class'=> '',
    ), $atts);
	return '<div class="row '.$value['class'].'">'.do_shortcode($content).'</div>'; 
}
add_shortcode('row','row_shortcode');

//--------------COLUMNS-------------//
function col_shortcode($atts,$content,$tags) {
	$value = shortcode_atts(array(
		'columns' => '',
		'offset' => '',
		'class'=> '',
		), $atts);

  if (!$value['offset'] == ''){
	$result = $value['columns']." offset-by-".$value['offset'];
}else {
  $result = $value['columns'];
}

	return '<div class="'.$result.' '.$value['class'].' columns">'.do_shortcode($content).'</div>';
}
add_shortcode('col','col_shortcode');

//-------------LINK-------------//
function link_shortcode($atts,$content,$tags) {
	$value = shortcode_atts(array(
		'class' => '',
		'link-to' => '',
		'content' => ''
		), $atts);
	return '<a href="'.$value['link-to'].'" class="'.$value['class'].'">'.do_shortcode($content).'</a>'; 
}
add_shortcode('link','link_shortcode'); 

//-------------Accordian-------------//
function pwd_acc_container_shortcode($atts,$content,$tags) {
	$value = shortcode_atts(array(
		'class' => ''
		), $atts);
	return '<div class="pwd-accordian-container '.$value['class'].'">'.do_shortcode($content).'</div>'; 
}
add_shortcode('acc-container','pwd_acc_container_shortcode'); 

function pwd_acc_title_shortcode($atts,$content,$tags) {
	$value = shortcode_atts(array(
		'class' => ''
		), $atts);
	return '<a href="#" class="pwd-list-div '.$value['class'].'">'.do_shortcode($content).'</a>'; 
}
add_shortcode('acc-title','pwd_acc_title_shortcode'); 

function pwd_acc_content_shortcode($atts,$content,$tags) {
	$value = shortcode_atts(array(
		'class' => ''
		), $atts);
	return '<div class="pwd-drop-list '.$value['class'].'">'.do_shortcode($content).'</div>'; 
}
add_shortcode('acc-content','pwd_acc_content_shortcode'); 

//ignore whitespace inside shortcode
	add_filter( 'the_content', 'tgm_io_shortcode_empty_paragraph_fix' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function tgm_io_shortcode_empty_paragraph_fix( $content ) {

	$array = array(
		'<p>['    => '[',
		']</p>'   => ']',
		']<br />' => ']'
		);
	return strtr( $content, $array );

}

//shortcode buttons
function pwd_enqueue_plugin_scripts($plugin_array)
{
    //enqueue TinyMCE plugin script with its ID.
    $plugin_array["shortcode_plugin"] =  plugin_dir_url(dirname(__FILE__)) . "js/Shortcodes_js.js";
    return $plugin_array;
}

add_filter("mce_external_plugins", "pwd_enqueue_plugin_scripts");
function pwd_register_buttons_editor($buttons)
{
    //add each button here and on js page
    array_push($buttons, "section_button", "container_button", "row_button", "column_button", "link_button");
    return $buttons;
}
add_filter("mce_buttons_3", "pwd_register_buttons_editor");
function pwd_accordian_buttons_editor($buttons)
{
    //add each button here and on js page
    array_push($buttons, "acc_contain_button", "acc_title_button", "acc_content_button" );
    return $buttons;
}

add_filter("mce_buttons_4", "pwd_accordian_buttons_editor");
?>