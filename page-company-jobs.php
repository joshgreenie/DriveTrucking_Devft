<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 *
 * Template Name: Company Jobs
 *
 */
$detect = new Mobile_Detect;
get_header(); ?>

	<?php get_template_part('template-parts/content', 'page-header')?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			$company_slug = get_query_var('company-name');
			$cid = get_id_by_slug($company_slug,'company');
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$listings_args = array(
				'post_per_page' => 15,
				'post_type'		=> 'jobs',
				'meta_key'		=> 'select_company',
				'meta_value'	=> $cid,
				'paged'			=> $paged,
			);

			// query
			$listings = new WP_Query( $listings_args );
            if ( $listings->have_posts() ) : ?>

				<?php
				$i=1;

				while ( $listings->have_posts() ) : $listings->the_post();

					get_template_part( 'template-parts/content', 'listings' );


					if($i == 8 || $i == 16 || $i == 24 || $i == 32){
						if( $detect->isMobile() && !$detect->isTablet() ) {
							?>
							<article id="post-info">
								<!-- /104636738/mobile_leader_board -->
								<div id='div-gpt-ad-1463684262279-1' style='height:50px; width:320px;'>
									<script type='text/javascript'>
										googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463684262279-1'); });
									</script>
								</div>
							</article>
						<?php }else{?>

							<article id="post-info">
								<!-- /104636738/listings_leader_board -->
								<div id='div-gpt-ad-1464280269192-0'>
									<script type='text/javascript'>
										googletag.cmd.push(function() { googletag.display('div-gpt-ad-1464280269192-0'); });
									</script>
								</div>
							</article>
							<?php
						}
					}
					$i++;
				endwhile;

				if ($listings->max_num_pages > 1) : // check if the max number of pages is greater than 1  ?>
					<?php _scorch_pagination($listings->max_num_pages, 2 ); ?>
				<?php endif;

			else :

				get_template_part( 'template-parts/content', 'no-jobs' );

			endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar('job-listing');
get_footer();
