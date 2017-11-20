<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 10/4/2017
 * Time: 12:51 PM
 *
 * Template Name: Login Page
 *

 */

get_header(); ?>

    <!-- section -->
    <section class="login-form">
        <?php
        global $user_login;

        // In case of a login error.
        if (isset($_GET['login']) && $_GET['login'] == 'failed') : ?>
            <div class="error">
                <p><?php _e('Login Failed: Please Check Your Credentials and Try again', 'drivetrucking'); ?></p>
            </div>
            <?php
        endif;


        $page_header_background_image = get_field('page_header_background_image', 'option');
        $page_header_background_imageURL = $page_header_background_image['url'];

        ?>
        <div class="page-header"
            <?php if ($page_header_background_image):
                echo "style='background-image:url($page_header_background_imageURL);'";
            endif; ?>
        >
            <div class="grid-container">
                <h1 class="page heading">Drive Trucking Login</h1>
            </div>
        </div>
        <?php
        // Login form arguments.
        $args = array(
            'echo' => true,
//            'redirect' => home_url('/dashboard/'),
            'form_id' => 'loginform',
            'label_username' => __('Username'),
            'label_password' => __('Password'),
            'label_remember' => __('Remember Me'),
            'label_log_in' => __('Log In'),
            'id_username' => 'user_login',
            'id_password' => 'user_pass',
            'id_remember' => 'rememberme',
            'id_submit' => 'wp-submit',
            'remember' => true,
            'value_username' => NULL,
            'value_remember' => true
        );

        // Calling the login form.
        echo "";
        wp_login_form($args);


        ?>

    </section>
    <!-- /section -->

<?php get_footer(); ?>