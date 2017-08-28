<?php
/**
 * Template part for displaying jobs.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */

/**
 * Get Jobs Data from Custom Fields
 *
 * @uses	Advanced Custom Fields
 * @uses		get_field
 *
 * @since	1.0
 * @author	(E)2 Interactive
 *
 */
$locations			= get_field('location');
$freight_type		= get_field('freight_type');
$driver_type		= get_field('driver_type');
$run_type			= get_field('run_type');
$enticement_notice	= get_field('enticement_notice');
$job_description	= get_field('job_description');
$short_description	= get_field('short_description');
$company			= get_field('company');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/JobPosting">

	<header class="entry-header">

		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<div class="entry-meta">
			<?php if($driver_type):?>
				<div class="freight-type">
					<strong> <?php _e('Type: ', '_scorch');?></strong>
					<span><?php echo $freight_type->name;?></span>
				</div><!-- .driver-type -->
			<?php endif;?>
			<?php if($locations):?>
				<div class="location" itemprop="jobLocation" itemscope itemtype="http://schema.org/Place">
					<?php
					$locations = get_the_terms( get_the_ID(), 'location' );
					foreach ($locations as $location) :
						if($location->parent == 0):?>
							<strong><?php _e(' State: ', '_scorch');?></strong><span itemprop="addressRegion"><?php echo $location->name;?></span>
						<?php endif;?>
						<?php if ( $location->parent != 0 ):?>
						<span><strong><?php _e(' City: ')?></strong><span itemprop="addressRegion"><?php echo $location->name;?></span></span>
					<?php endif;?>
					<?php endforeach; ?>
				</div>
			<?php endif;?>
			<?php
			if($company === "Associate Company"):
				$select_company = get_field('select_company');

				if( $select_company ):
				// override $post
				$post = $select_company;
				setup_postdata( $post );

				$company_name = get_the_title(); ?>
				<div class="company-name" itemprop="hiringOrganization" itemscope itemtype="http://schema.org/Organization">
					<span>
						<strong><?php _e(' Company: ')?></strong><span itemprop="name"><?php echo $company_name;?></span>
					</span>
				</div>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>
			<?php endif;?>


		</div><!-- .entry-meta -->

		<div class="enticement-content">
			<?php
			if( strtotime($post->post_date) > strtotime('-2 day') ) {
				echo '<h5 class="new">NEW</h5>';
			}
			?>
			<h5><?php echo $driver_type->name;?></h5>
			<?php if($enticement_notice):?>
			<span class="enticement"><?php echo $enticement_notice;?></span>
			<?php endif;?>
		</div><!--.enticement-content-->

	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="description">
			<div class="description" itemprop="description">
				<?php if( $short_description ):
					echo $short_description;
				else:
					echo get_snippet($job_description, 20);
				endif;?>
			</div>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
