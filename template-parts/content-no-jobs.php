<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php
			if (isset($wp_query->query_vars['location'])){
				$selected_location = $wp_query->query_vars['location'];
				$location = str_replace("-", " ", $wp_query->query_vars['location']);
				esc_html_e( 'Sorry, No Jobs found in', '_scorch' ); echo ' '._e( ' '.ucwords( $location ) );
			}else{
				esc_html_e( 'Sorry, No Jobs found', '_scorch' );
			}
			?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<h3><?php _e('Search another location for your next trucking job.')?></h3>
		<?php
		the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
		<form id="category-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<input type="hidden" name="post_type" value="jobs">
			<?php wp_dropdown_categories( array(
				'show_option_none'  => __( 'Select Location', '_scorch' ),
				'taxonomy'          => 'location',
				'hierarchical'      => true,
				'id'                => 'select-location',
				'class'             => 'custom-select',
				'name'              => 'location',
				'value_field'       => 'slug',
				'hide_empty'        => false,
			) ); ?>
			<?php wp_dropdown_categories( array(
				'show_option_none'  => __( 'Select Type', '_scorch' ),
				'taxonomy'          => 'freight_type',
				'id'                => 'select-freight',
				'class'             => 'custom-select',
				'name'              => 'freight_type',
				'value_field'       => 'slug',
				'hide_empty'        => false,
			) ); ?>
			<?php wp_dropdown_categories( array(
				'show_option_none'  => __( 'Select Driver Type', '_scorch' ),
				'taxonomy'          => 'driver_type',
				'hierarchical'      => true,
				'id'                => 'select-driver',
				'class'             => 'custom-select',
				'name'              => 'driver_type',
				'value_field'       => 'slug',
				'hide_empty'        => false,
			) ); ?>

			<a href="#" id="submit-job-sort" class="button-blue">Find</a>
		</form>
	</div><!-- .page-content -->
</section><!-- .no-results -->
