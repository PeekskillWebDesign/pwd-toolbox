<?php function pwd_login_css() { 
  $login_logo = get_option('login');
  if( $login_logo !== '#' ) {
    $logo_size = get_string_between($login_logo, 'x', '.png');
  ?>
    <style type="text/css">
        #login, .login {
          padding:0 !important;
        }
        #login h1, .login h1 {
          width:300px;
          margin:0;
          margin-top:50px;
              margin-left:10px;
        }
        

         #login h1 a, .login h1 a {
             background-image: url(<?php echo get_option('login'); ?>);
            padding-bottom: 30px;
            background-size: 100% auto;
            background-position: bottom center;
            width:300px;
            height:<?php echo $logo_size ?>px;
            min-height:100px;
            padding:0;
            margin:0;
            margin-bottom:10px;
         }
     </style>
 <?php 
  }
}
add_action( 'login_enqueue_scripts', 'pwd_login_css' );
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
} ?>