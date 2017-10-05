<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 10/5/2017
 * Time: 1:29 AM
 */


//function app_output_buffer() {
//    ob_start();
//} // soi_output_buffer
//add_action('init', 'app_output_buffer');
//


//function redirect_users() {
//    global $post;
//    $url = home_url();



function my_function(){
    $url = '';
    if (is_page('Apply Now') && is_user_logged_in()):
        $url = '/dashboard';
    endif;


    if (is_page('Login') && is_user_logged_in()):
        $url = '/dashboard';
    endif;

    if(!is_user_logged_in() && is_page_template( 'page-account.php' )):
        $url = '/login';
    endif;

    wp_safe_redirect($url);

}
add_action( "template_redirect", "my_function" );

//    if(!is_user_logged_in()):
//        echo "<script type='text/javascript'>
//    window.location.href = '/login'
//</script>";
//    endif;


//    wp_redirect($url);
//    exit;
//}
//add_action('template_redirect', 'redirect_users');

