<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _scorch
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			$template_type = get_field('template_type');

			if($template_type){
				if($template_type == 'default'){
					get_template_part( 'template-parts/content', 'jobs' );
				}else{
					get_template_part( 'template-parts/content', $template_type );
				}
			}else{
				get_template_part( 'template-parts/content', 'jobs' );
			}

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar('job-listing');
get_footer();
