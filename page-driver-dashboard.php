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
 * Template Name: Driver Dashboard page
 *
 */

get_header();


$user = wp_get_current_user();
//dt_user_role_redirect($user);

?>
<!--    <div id="content" class="site-content">-->



<?php   get_sidebar('account'); ?>

    <div id="primary" class="content-area">

        <main id="main" class="site-main" role="main">
            <?php
            while (have_posts()) : the_post();

                    get_template_part('template-parts/content', 'dashboard');


            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<!--    </div><!-- #content -->

<?php
get_footer();

