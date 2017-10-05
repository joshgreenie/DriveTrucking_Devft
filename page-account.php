<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 *
 * Template Name: Account pages
 *
 */

get_header();

get_sidebar('account');


//
//$user = wp_get_current_user();
//$user_id = $user->chargify_custid;
//$subscription_id = $user->subscription_id;
//$customer_reference = $user->customer_reference;

//
//$current_user = wp_get_current_user();
//$user_id = $current_user->ID;
//$chargify_custid = $current_user->chargify_custid;
//
//$usub = get_usermeta($user_id, 'chargify_level', true);
////echo var_dump($usub);
//
//echo "<br>$chargify_custid";
//if ($usub != NULL):
////    echo "<br>test";
////else :
////    echo '<br>other test';
//endif;
//
//


$user = wp_get_current_user();
?>


    <div id="primary" class="content-area">

        <main id="main" class="site-main" role="main">
            <?php
            while (have_posts()) : the_post();
//
//                if ( in_array( 'driver', (array) $user->roles ) ) {
//                    get_template_part('template-parts/account', 'driver');
//                }
//
//                if ( in_array( 'recruiter', (array) $user->roles ) ) {
//                    get_template_part('template-parts/account', 'recruiter');
//                }
//
//
//                if ( in_array( 'administrator', (array) $user->roles ) ) {
                    get_template_part('template-parts/content', 'page');
//                }


            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();

