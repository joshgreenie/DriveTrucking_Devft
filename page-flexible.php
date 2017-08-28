<?php
/**
 * The template for displaying Flexible Content.
 *
 * @uses Advanced Custom Fields
 *
 * This is the template that will pull in different template parts
 * Based on the flexible field selected in the page builder
 *
 * @package _scorch
 *
 * Template Name: Flexible Content
 *
 */

get_header();

$add_base_flexible_fields = get_field('add_base_flexible_fields');
?>


<?php if ($add_base_flexible_fields != 'yes1'): ?>
    <div id="flex" class="flex-content">
        <?php get_template_part('template-parts/flexible/new-flexible', 'fields'); ?>
    </div><!-- #flex -->
<? endif; ?>
<?php if ($add_base_flexible_fields != 'no'): ?>
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php while (have_posts()) : the_post();

                    get_template_part('template-parts/flexible/flexible', 'fields');

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;


                endwhile; // End of the loop. ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- #content -->

    <?php
    if ($add_base_flexible_fields == 'yes1'):?>
        <div id="flex" class="flex-content">
            <?php get_template_part('template-parts/flexible/new-flexible', 'fields'); ?>
        </div><!-- #flex -->
    <? endif; ?>
<? endif; ?>


<?php get_footer(); ?>
