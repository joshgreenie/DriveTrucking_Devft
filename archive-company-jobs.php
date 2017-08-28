<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */
$detect = new Mobile_Detect;
get_header(); ?>

	<?php get_template_part('template-parts/content', 'page-header')?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			$company_name = get_query_var('company-job');
			echo $company_name;
			// args
			$listings_args = array(
				'post_type'		=> 'jobs',
				'meta_key'		=> 'select_company',
				'meta_value'	=> get_the_ID()
			);

			// query
			$listings_args = new WP_Query( $listings_args );
			if( $listings_args->have_posts() ):?>
				<section class="jobs">
					<h3 class="section-title"><?php _e('Latest Job Posts')?></h3>
					<?php while( $listings_args->have_posts() ) : $listings_args->the_post();?>
						<?php get_template_part( 'template-parts/content', 'listings' );?>
					<?php endwhile; ?>
				</section>
			<?php else:

				get_template_part( 'template-parts/content', 'no-jobs' );

			endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
