<?php
/**
 * Template part for displaying company content and details in single-company.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */
global $post;
$company_history                = get_field('company_history');
$company_profile                = get_field('company_profile');
$company_name 					= get_the_title();
$companyID						= get_the_ID();
$company_slug					= $post->post_name;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		// args
		$args = array(
			'numberposts'	=> -1,
			'post_type'		=> 'reviews',
			'meta_key'		=> 'company',
			'meta_value'	=> get_the_ID()
		);

		// query
		$ratings_query = new WP_Query( $args );
		if( $ratings_query->have_posts() ):?>
			<section class="reviews">
				<h3 class="section-title"><?php echo $ratings_query->found_posts.' '.plural($ratings_query->found_posts, 'Review', 'Reviews').' for '.$company_name?></h3>
				<?php while( $ratings_query->have_posts() ) : $ratings_query->the_post();?>
					<?php get_template_part( 'template-parts/content', 'review-listing' );?>
				<?php endwhile; ?>
				<a href="#" class="button-small-blue write-review">Write a review for <?php echo $company_name;?></a>
			</section>
		<?php else:?>
			<section class="reviews">
				<h3><?php _e('No Reviews')?></h3>
				<a href="#" class="button-small-blue write-review" >Write a review for <?php echo $company_name;?></a>
			</section> <!--No Reviews-->
		<?php endif; ?>

		<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>


	</div>
</article><!-- #secondary -->
<!-- #post-## -->
<div class="apply-application">
	<div class="app-wrapper">
		<?php
			$populate = array('company_id' => $companyID);
			?>
			<h3><?php _e('Write a review for ','_scorch'); echo $company_name;?></h3>
			<?php gravity_form( 3, $display_title = false, $display_description = false, $display_inactive = false, $field_values = $populate, $ajax = true, 10);?>
		<a href="#" class="close-button"></a>
	</div>
</div>
