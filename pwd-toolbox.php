<?php
/*
Plugin Name: PWD Toolset
Description: A toolset for websites developed by Peekskill Web Design
Author:      Peekskill Web Design
Version:0.2
*/


// ********************** TABLE OF CONTENTS ********************** //

// 1. SHORTCODES

// 2. IGNORE WHITESPACE BETWEEN SHORTCODE AND CONTENT

// 3. REGISTER ADMIN MENU

// 4. ADMIN MENU

// 5. ADMIN MENU FUNCTIONS

// 6. PRINTED HTML FROM ADMIN

// 7. IMAGE UPLOADER FOR ADMIN

// 8. PLUGIN UPDATER

// ********************** TABLE OF CONTENTS ********************** //





// ********************** 1. START SHORTCODES ********************** //

//----------SECTION--------------//
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
	return '<div class="row'.$value['class'].'">'.do_shortcode($content).'</div>'; 
}
add_shortcode('row','row_shortcode');

//--------------COLUMNS-------------//
function col_shortcode($atts,$content,$tags) {
	$value = shortcode_atts(array(
		'columns' => '',
		'offset' => '',
		'class'=> '',
		), $atts);

	$result = $value['columns']." offset-by-".$value['offset'];

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
	return '<a href="'.$value['link-to'].'" class="'.$value['class'].'">'.$value['content'].'</a>'; 
}
add_shortcode('link','link_shortcode');

// ********************** END SHORTCODES ********************** //

// ********************** 2. START IGNORE WHITESPACE BETWEEN SHORTCODE AND CONTENT **********************//



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

// ********************** END IGNORE WHITESPACE BETWEEN SHORTCODE AND CONTENT **********************//


// ********************** 3. START REGISTER ADMIN MENU ********************** //

add_action( 'admin_menu', 'PWD_toolbox_menu' );
add_action( 'admin_action_PWD', 'PWD_admin_action' );
function PWD_toolbox_menu() {
add_menu_page( 'PWD Toolbox', 'PWD Toolbox', 'manage_options', 'pwdtoolbox', 'PWD_toolbox_options','dashicons-admin-tools');
}

// ********************** END REGISTER ADMIN MENU ********************** //

// ********************** 4. START ADMIN MENU ********************** //

function PWD_toolbox_options(){
  add_option('google_analytics', '');
  add_option('favicon', '#');

    echo '<div class="wrap">';

    // header

    echo "<h2>PWD Toolbox Options</h2>";

    // settings form
    
    ?>
<p>Welcome to the Peekskill Web Design toolbox. <br>Here you can update options such as your favicon and google analytics code.</p>
<form name="form1" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
<input type="hidden" name="action" value="PWD" />

<h3><b>Google Analytics Code</b></h3>
<p>Enter your Google Analytics ID here</p>
<p><input type="text" name="google_analytics" placeholder="UA-********-*" value="<?php echo get_option('google_analytics'); ?>"></p>

<?php pwd_media_uploader(); ?>
<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
</p>
</form>
</div>
<?php
}
// ********************** END ADMIN MENU ********************** //

// ********************** 5. START ADMIN MENU FUNCTIONS ********************** //
function PWD_admin_action() {
   if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   print_r($_POST);
  //set analytics
   update_option('google_analytics', $_POST['google_analytics']);
   wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox') );

   //set favicon
   $favicon_original = $_POST['favicon'];
   $favicon = str_replace( '.png', '-32x32.png', $favicon_original);
   update_option('favicon', $favicon);
 exit;
}

// ********************** END ADMIN MENU FUNCTIONS ********************** //

// ********************** 6. START PRINTED HTML FROM ADMIN ********************** //

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
function PWD_favicon_html(){
	$favicon_url = get_option('favicon');
		echo '<link rel="shortcut icon" href="'.$favicon_url.'">';
}
add_action('wp_head', 'PWD_favicon_html');
add_action( 'admin_head', 'PWD_favicon_html' );
// ********************** END PRINTED HTML ********************** //

// ********************** 7. START IMAGE UPLOADER FOR ADMIN ********************** //
add_image_size('favicon-16', 16, 16, true);
add_image_size('favicon-32', 32, 32, true);
add_image_size('favicon-152', 152, 152, true);
function pwd_media_uploader(){
// jQuery
wp_enqueue_script('jquery');
// This will enqueue the Media Uploader script
wp_enqueue_media();
?>
    <div>
    <label for="image_url"><h3><b>Favicon</b></h3></label>
    <p>Upload an image to be used as a favicon. The image must be a <b>PNG</b> file and it will be resized to 16px x 16px</p> 
    <input type="hidden" name="favicon" id="image_url" class="regular-text">
    <img src="<?php echo get_option('favicon') ?>" id="favicon-image"><br><br>
    <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
    <p id="png-warning" style="color:red; display:none;">The image must be a PNG!</p>

</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	if(jQuery('#favicon-image').attr('src') == '#'){
		jQuery('#favicon-image').hide();
	}
    jQuery('#upload-btn').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            var favicon_url = image_url.replace('.png', '-32x32.png')
            // If the Image is a png use it. If not flash warning
            if(image_url.indexOf("png") < 0 ) {
            	jQuery('#png-warning').show();
            } else {
            	jQuery('#png-warning').hide();
            	jQuery('#image_url').val(image_url);
            	jQuery('#favicon-image').attr('src', favicon_url);
            	jQuery('#favicon-image').show(); 
            }
        });
    });
});
</script> <?php
}
function pwd_load_wp_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'pwd_load_wp_media_files' );
// ********************** END IMAGE UPLOADER FOR ADMIN********************** //

// ********************** 8. START PLUGIN UPDATER ********************** //

require_once( 'pwd-updater.php' );
if ( is_admin() ) {
    new BFIGitHubPluginUpdater( __FILE__, 'PeekskillWebDesign', "pwd-toolbox" );
}

// ********************** END PLUGIN UPDATER ********************** //

// ********************** 9. START SHORTCODES DROPDOWN ********************** //

function pwd_enqueue_plugin_scripts($plugin_array)
{
    //enqueue TinyMCE plugin script with its ID.
    $plugin_array["shortcode_plugin"] =  plugin_dir_url( __FILE__) . "js/Shortcodes_js.js";
    return $plugin_array;
}

add_filter("mce_external_plugins", "pwd_enqueue_plugin_scripts");
function pwd_register_buttons_editor($buttons)
{
    //add each button here and on js page
    array_push($buttons, "section_button", "container_button", "row_button", "column_button", "link_button" );
    return $buttons;
}

add_filter("mce_buttons_3", "pwd_register_buttons_editor");
// ********************** 9. END SHORTCODES DROPDOWN ********************** //

?>
