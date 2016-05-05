<?php
/*
Plugin Name: PWD Toolset
Description: A toolset for websites developed by Peekskill Web Design
Author:      Peekskill Web Design
Version: 0.3.0
GitHub Plugin URI: https://github.com/PeekskillWebDesign/pwd-toolbox
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

// 9. SHORTCODE BUTTONS

//10. SOCIAL WIDGET

//11. CUSTOM POST EXCERPTS

//12. LOGIN PAGE EDITS

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
add_menu_page( 'PWD Theme Options', 'PWD Theme Options', 'manage_options', 'pwdtoolbox', 'PWD_toolbox_options','dashicons-admin-tools');
}

// ********************** END REGISTER ADMIN MENU ********************** //

// ********************** 4. START ADMIN MENU ********************** //
add_action('admin_head', 'pwd_toolset_styling'); //enqueue styles

function pwd_toolset_styling($hook) {
  wp_enqueue_style( 'pwd_toolset_css' , plugin_dir_url( __FILE__) . '/style.css' );
}
function PWD_toolbox_options(){
  add_option('google_analytics', '');
  add_option('favicon', '#');
  add_option('login', '#');
    echo '<div class="wrap">';

    // settings form
    
    
    include( plugin_dir_path( __FILE__ ) . 'templates/admin-menu.php'); 


echo '</div>';
}
//enqueue menu scripts
function pwd_enqueue_admin_scripts($hook) {
  wp_enqueue_script( 'admin_menu_scripts', plugin_dir_url( __FILE__ ) . 'scripts/admin-menu.js');
}
add_action( 'admin_enqueue_scripts', 'pwd_enqueue_admin_scripts' );

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
   if(strpos($favicon_original, '32x32') == false) {
    $favicon = str_replace( '.png', '-32x32.png', $favicon_original);
  } else {
    $favicon = $favicon_original;
  }
   update_option('favicon', $favicon);
   update_option('login', $_POST['login']);
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

add_image_size('favicon-16', 16, 16, true);
add_image_size('favicon-32', 32, 32, true);
add_image_size('favicon-152', 152, 152, true);

function PWD_favicon_html(){
	$favicon_url = get_option('favicon');
		echo '<link rel="shortcut icon" href="'.$favicon_url.'">';
}
add_action('wp_head', 'PWD_favicon_html');
add_action( 'admin_head', 'PWD_favicon_html' );
// ********************** END PRINTED HTML ********************** //

// ********************** 7. START IMAGE UPLOADER FOR ADMIN ********************** //

function pwd_media_uploader($settings){
// jQuery
wp_enqueue_script('jquery');
// This will enqueue the Media Uploader script
wp_enqueue_media();
?>
    <div class="text-center">
    <input type="hidden" name="<?php echo $settings['id'] ?>" id="<?php echo $settings['id'] ?>-image_url" class="regular-text" value="<?php echo get_option($settings['id']) ?>">
    <img src="<?php echo get_option($settings['id']) ?>" id="<?php echo $settings['id'] ?>-image"><br><br>
    <div class="image-uploader-div">
      <input type="button" name="upload-btn" id="<?php echo $settings['id'] ?>-upload-btn" class="button-secondary" value="Upload Image">
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	if(jQuery('#<?php echo $settings['id'] ?>-image').attr('src') == '#'){
		jQuery('#<?php echo $settings['id'] ?>-image').hide();
	}
    jQuery('#<?php echo $settings['id'] ?>-upload-btn').click(function(e) {
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
            <?php if(isset($settings['image-size'])) : ?>
              var image_url = uploaded_image.toJSON().sizes.<?php echo $settings['image-size'] ?>.url;
            <?php else : ?>
              var image_url = uploaded_image.toJSON().url;
            <?php endif; ?>  
            jQuery('#<?php echo $settings['id'] ?>-image').attr('src', image_url);
            jQuery('#<?php echo $settings['id'] ?>-image_url').val(image_url);
            <?php echo $settings['added-scripts'] ?>
            jQuery('#<?php echo $settings['id'] ?>-image').show(); 
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


add_action( 'admin_init', 'pwd_handle_updates' );
function pwd_handle_updates(){
require_once( 'pwd-updater.php' );
if ( is_admin() ) {
    new BFIGitHubPluginUpdater( __FILE__, 'PeekskillWebDesign', "pwd-toolbox" );
}
}
// ********************** END PLUGIN UPDATER ********************** //

// ********************** 9. START SHORTCODE BUTTONS ********************** //

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
// ********************** 9. END SHORTCODE BUTTONS ********************** //

// ********************** 10. START SOCIAL WIDGET ********************** //

class Social_Widget extends WP_Widget {

  /**
   * Sets up the widgets name etc
   */
  public function __construct() {
    $widget_ops = array( 
      'classname' => 'social_widget',
      'description' => 'Social Link For Footer',
    );
    parent::__construct( 'social_widget', 'Social Widget', $widget_ops );
  }

  /**
   * Outputs the content of the widget
   *
   * @param array $args
   * @param array $instance
   */
 
  public function widget( $args, $instance ) {
    if(strpos($instance['social_site'], 'https://') == false && strpos($instance['social_site'], 'http://') == false){
      $instance['social_site'] = 'http://' . $instance['social_site'];
    }
    echo $args['before_widget'];
    if ( ! empty( $instance['social_site'] ) ) {
      echo $args['before_widget'] ?><a href="<?php echo $instance['social_site'] ?>" target="_blank"><i class="fa fa-<?php echo $instance['font_awesome'] ?>"></i></a><?php $args['after_widget'];
    }
  }


  /**
   * Outputs the options form on admin
   *
   * @param array $instance The widget options
   */
  public function form( $instance ) {
    $social_site = ! empty( $instance['social_site'] ) ? $instance['social_site'] : __( 'Social Website Address', 'text_domain' );
    $font_awesome = ! empty( $instance['font_awesome'] ) ? $instance['font_awesome'] : __( 'Font Awesome Name', 'text_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'social_site' ); ?>"><?php _e( 'Social Website Address (ex. www.instagram.com/yourusername):' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'social_site' ); ?>" name="<?php echo $this->get_field_name( 'social_site' ); ?>" type="text" value="<?php echo esc_attr( $social_site ); ?>">
    </p>
    <p>
    <label for="<?php echo $this->get_field_id( 'font_awesome' ); ?>"><?php _e( 'Social Media Logo:' ); ?></label> 
    <select class="widefat" id="<?php echo $this->get_field_id( 'font_awesome' ); ?>" name="<?php echo $this->get_field_name( 'font_awesome' ); ?>"  value="<?php echo esc_attr( $font_awesome ); ?>">
    
    <?php pwd_social_widget_option($font_awesome, 'instagram', 'Instagram'); ?>
    <?php pwd_social_widget_option($font_awesome, 'facebook', 'Facebook'); ?>
    <?php pwd_social_widget_option($font_awesome, 'facebook-square', 'Facebook Square Logo'); ?>
    <?php pwd_social_widget_option($font_awesome, 'pinterest', 'Pinterest'); ?>
    <?php pwd_social_widget_option($font_awesome, 'pinterest-square', 'Pinterest Square Logo'); ?>
    <?php pwd_social_widget_option($font_awesome, 'twitter', 'Twitter'); ?>
    <?php pwd_social_widget_option($font_awesome, 'twitter-square', 'Twitter Square Logo'); ?>
    <?php pwd_social_widget_option($font_awesome, 'youtube', 'YouTube'); ?>
          
    </select>
    </p>
    <?php 

  }

  /**
   * Processing widget options on save
   *
   * @param array $new_instance The new options
   * @param array $old_instance The previous options
   */
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['social_site'] = ( ! empty( $new_instance['social_site'] ) ) ? strip_tags( $new_instance['social_site'] ) : '';
    $instance['font_awesome'] = ( ! empty( $new_instance['font_awesome'] ) ) ? strip_tags( $new_instance['font_awesome'] ) : '';
    return $instance;
  }
}

function register_social_widget() {
    register_widget( 'social_widget' );
}
add_action( 'widgets_init', 'register_social_widget' );
function pwd_social_widget_option($font_awesome, $input, $display_name){

if ($font_awesome == $input) : ?>
      <option value="<?php echo $input?>" selected><?php echo $display_name ?></option>
    <?php else : ?>
      <option value="<?php echo $input ?>"><?php echo $display_name ?></option>
    <?php endif; 

}
// ********************** 10. END SOCIAL WIDGET ********************** //

// ********************** 11. START CUSTOM POST EXCERPTS ********************** //

function pwd_excerpt($excerpt_length = 55, $id = false, $echo = true) {
    
    $text = '';
    
    if($id) {
      $the_post = & get_post( $my_id = $id );
      $text = ($the_post->post_excerpt) ? $the_post->post_excerpt : $the_post->post_content;
    } else {
      global $post;
      $text = ($post->post_excerpt) ? $post->post_excerpt : get_the_content('');
    }
    
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
  
    $excerpt_more = ' ';
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
      array_pop($words);
      $text = implode(' ', $words);
      $text = $text . $excerpt_more;
    } else {
      $text = implode(' ', $words);
    }
  if($echo)
  echo apply_filters('the_content', $text.'...');
  else
  return $text;
}

function get_pwd_excerpt($excerpt_length = 55, $id = false, $echo = false) {
 return pwd_excerpt($excerpt_length, $id, $echo);
}
// ********************** 11. END CUSTOM POST EXCERPTS ********************** //

// ********************** 12. START LOGIN PAGE EDITS ********************** //
function pwd_login_css() { 
  $login_logo = get_option('login-logo');
  if( $login_logo !== '#' ) {
  ?>
    <style type="text/css">
        #login, .login {
          padding:0 !important;
        }
        #login h1, .login h1 {
          width:300px;
          margin:0;
              margin-left:10px;
        }
        

         #login h1 a, .login h1 a {
             background-image: url(<?php echo get_option('login'); ?>);
            padding-bottom: 30px;
            background-size: 100% auto;
            background-position: bottom center;
            width:300px;
            height:300px;
            padding:0;
            margin:0;
            margin-bottom:10px;
         }
     </style>
 <?php 
  }
}
add_action( 'login_enqueue_scripts', 'pwd_login_css' );
// ********************** 12. START LOGIN PAGE EDITS ********************** //


?>
