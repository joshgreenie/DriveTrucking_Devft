<?php
/**
 *
 * Template Name: Home
 *
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
 */

get_header(); ?>

<?php
$page_header_background_image = get_field('page_header_background_image' , 'option');
$page_header_background_imageURL = $page_header_background_image['url'];

?>
    <div class="page-header"
        <?php if($page_header_background_image):
            echo "style='background-image:url($page_header_background_imageURL);'";
        endif; ?>
    >
        <div class="grid-container">
            <h1 class="page heading"><?php _e('Drive Trucking News', '_scorch')?></h1>
        </div>
    </div>



    <div id="content" class="site-content">

<?php //get_template_part('template-parts/content', 'page-header')?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">


            <?php
                while ( have_posts() ) : the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', get_post_format() );

                endwhile;

                the_posts_navigation();

            ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php get_sidebar('blog'); ?>
    </div><!-- #content -->

<?php
get_footer();

