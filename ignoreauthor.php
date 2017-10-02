<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _scorch
 */

get_header(); ?>

    <div id="primary" class="content-area test">
        <main id="main" class="site-main" role="main">
            <?php

            $author = get_queried_object();
            $allowed = array('state_association');
            $roles = array_intersect($author->roles,$allowed);
            if (!empty($roles)) {
//                include (TEMPLATEPATH . '/author_1.php');
//                echo "<h1>Test</h1>";
                get_template_part( 'template-parts/content', 'state-association' );
            } else {
//                include (TEMPLATEPATH .'/author_2.php');
                get_template_part( 'template-parts/content', get_post_format() );
            }


            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content', get_post_format() );

                the_post_navigation();

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
