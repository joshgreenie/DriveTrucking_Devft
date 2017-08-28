<?php
/**
 * Template part for displaying jobs.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */

$locations 			= get_the_terms( get_the_ID(), 'location' );
$freight_type		= get_field('freight_type');
$driver_type		= get_field('driver_type');
$run_type			= get_field('run_type');
$enticement_notice	= get_field('enticement_notice');
$job_description	= get_field('job_description');
$company			= get_field('company');
$select_company	    = get_field('select_company');
$jobtitle			= get_the_title();
$state 				='';
$city				='';
$user_form          = get_field('user_form');

$strings = array(
	'Apply For This Job',
	'Quick Apply',
);
$key = array_rand($strings);
$apply_button_text = $strings[$key];

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('job-lander-1'); ?> itemscope itemtype="http://schema.org/JobPosting">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" itemprop="title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php if($locations):?>
				<div class="location" itemprop="jobLocation" itemscope itemtype="http://schema.org/Place">
					<h4><?php _e('Location: ', '_scorch');?></h4>
					<?php
					$locations = get_the_terms( get_the_ID(), 'location' );
					foreach ($locations as $location) :
						if($location->parent == 0):?>
							<div><strong><?php _e('State: ')?></strong><span itemprop="addressRegion"><?php echo $location->name;?></span></div>
							<?php $state = $location->name;?>
						<?php endif;?>
						<?php if ( $location->parent != 0 ):?>
							<div><strong><?php _e('City: ', '_scorch')?></strong><span itemprop="addressLocality"><?php echo $location->name;?></span></div>
							<?php $city = $location->name;?>
					<?php endif;?>
					<?php endforeach; ?>
				</div>
			<?php endif;?>
			<?php if($freight_type):?>
				<div class="freight-type">
					<h4><?php _e('Freight Type: ', '_scorch');?></h4>
					<span itemprop="occupationalCategory"><?php echo $freight_type->name;?></span>
				</div><!-- .freight-type -->
			<?php endif;?>
			<?php if($driver_type):?>
				<div class="driver-type">
					<h4><?php _e('Driver Type: ', '_scorch');?></h4>
					<span><?php echo $driver_type->name;?></span>
				</div><!-- .driver-type -->
			<?php endif;?>
			<?php if($run_type):?>
				<div class="run-type">
					<h4><?php _e('Run Type: ', '_scorch');?></h4>
					<span><?php echo $run_type->name; ?></span>
				</div><!-- .run-type -->
			<?php endif;?>
		</div><!-- .entry-meta -->

		<div class="enticement-content">
			<h5><?php echo $driver_type->name;?></h5>
			<?php if($enticement_notice):?>
			<span class="enticement"><?php echo $enticement_notice;?></span>
			<?php endif;?>
		</div><!--.enticement-content-->

	</header><!-- .entry-header -->
	<div class="apply-button">
		<a href="#" class="button-blue">Apply</a>
		<?php
		if( $select_company == 178 ) {

			// override $post
			$post = $select_company;
			setup_postdata($post);

			$phone   = get_field('phone');

			$source = $_GET['utm_source'];
			$the_company = get_the_title();

			?>
			<div class="call">
				or Call
				<br>
				<h3><a href="tel:<?php echo $phone;?>"><?php echo $phone;?></a></h3>
			</div>
			<?php
			wp_reset_postdata();
		}
		?>
	</div>
	<div class="entry-content">
		<div class="description-benefits">
			<h2 class="section-title"><?php _e('Job Description', '_scorch')?></h2>
			<div class="description" itemprop="description">
				<?php echo $job_description;?>
			</div>
			<h2 class="section-title"><?php _e('Benefits', '_scorch')?></h2>
			<div>
				<?php
				// check if the repeater field has rows of data
				if( have_rows('benefits') ):?>
					<ul itemprop="jobBenefits">
						<?php
						// loop through the rows of data
						while ( have_rows('benefits') ) : the_row();?>

							<li><?php the_sub_field('benefit');?></li>

						<?php endwhile;?>
					</ul>
				<?php endif;?>
			</div>
		</div>
		<div class="apply-button">
			<a href="#" class="button-blue">Apply</a>
			<?php
			if( $select_company == 178 ) {

				// override $post
				$post = $select_company;
				setup_postdata($post);

				$phone   = get_field('phone');

				$source = $_GET['utm_source'];
				?>
				<div class="call">
					or Call
					<br>
					<h3><a href="tel:<?php echo $phone;?>"><?php echo $phone;?></a></h3>
				</div>
				<?php
				wp_reset_postdata();
			}
			?>
		</div>
	</div><!-- .entry-content -->

	<div class="application">
		<div class="wrapper">
			<?php
			$location_info = 'City: '.$city.', State: '.$state;
			//$job_type_info = 'Driver Type: '.$driver_type;
			if($company === "Associate Company"):
				$post_object = get_field('select_company');

				if( $post_object ):
					// override $post
					$post = $post_object;
					setup_postdata( $post );

					$company_name 		= get_the_title();
					$company_phone 		= get_field('phone');
					$tenstreet_id 		= get_field('tenstreet_id');
					$populate = array('company_name' => $company_name, 'company_phone' => $company_phone, 'tid'=> $tenstreet_id, 'job_title' => $jobtitle, 'job_location' => $location_info, 'referer' => wp_get_original_referer() );
					?>

					<h3 class="apply-title">Fill out this simple form to apply</h3>

					<?php
					if( $select_company == 178 ) {

						// override $post
						$post = $select_company;
						setup_postdata($post);

						$phone   = get_field('phone');

						$source = $_GET['utm_source'];
						$the_company = get_the_title();
						if($source == 'jobs2careers' && $the_company == 'Andrus Transportation'){
							$phone = ' 1-888-489-1314';
						}

						?>
						<div class="call">
							or Call
							<br>
							<h3><a href="tel:<?php echo $phone;?>"><?php echo $phone;?></a></h3>
						</div>
						<?php
						wp_reset_postdata();
					}
					?>

					<?php if($user_form):
                        gravity_form( $user_form['id'], $display_title = false, $display_description = false, $display_inactive = false, $field_values = $populate, $ajax = true, 10);
                    else:
                        gravity_form( 1, $display_title = false, $display_description = false, $display_inactive = false, $field_values = $populate, $ajax = true, 10);
                    endif;

					wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>
			<?php elseif($company === 'Custom Name'):?>
				<?php
				$company_name 	= get_field('custom_company_name');
				$populate = array('company_name' => $company_name, 'referer' => wp_get_original_referer());
				?>

				<h3>Apply for <?php echo $jobtitle;?></h3>
				<div class="enticement-content">
					<h5><?php echo $driver_type->name;?></h5>
					<?php if($enticement_notice):?>
						<span class="enticement"><?php echo $enticement_notice;?></span>
					<?php endif;?>
				</div>
				<?php gravity_form( 1, $display_title = false, $display_description = false, $display_inactive = false, $field_values = $populate, $ajax = true, 10);?>

			<?php else:?>
				<?php
				$populate = array('referer' => wp_get_original_referer() );
				?>
				<h3>Apply for <?php echo $jobtitle;?></h3>
				<div class="enticement-content">
					<h5><?php echo $driver_type->name;?></h5>
					<?php if($enticement_notice):?>
						<span class="enticement"><?php echo $enticement_notice;?></span>
					<?php endif;?>
				</div>
				<?php if($user_form):
					gravity_form( $user_form['id'], $display_title = false, $display_description = false, $display_inactive = false, $field_values = $populate, $ajax = true, 10);
				else:
					gravity_form( 1, $display_title = false, $display_description = false, $display_inactive = false, $field_values = $populate, $ajax = true, 10);
				endif;?>

			<?php endif; ?>
		</div>
			<div class="requirements">
				<h2 class="section-title"><?php _e('Job Requirements', '_scorch')?></h2>
				<?php
				// check if the repeater field has rows of data
				if( have_rows('job_requirements') ):?>
					<ul itemprop="qualifications">
						<?php
						// loop through the rows of data
						while ( have_rows('job_requirements') ) : the_row();?>

							<li><?php the_sub_field('job_requirement');?></li>

						<?php endwhile;?>
					</ul>
				<?php endif;?>
			</div>

	</div><!-- .apply-->

	<footer class="entry-footer">
		<?php _scorch__simple_posted_on();?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<div class="apply-button">
	<a href="#" class="button-blue">Apply</a>
</div>
<?php
// args
$company_id = get_field('select_company');
if($company_id){
	$args = array(
		'numberposts'	=> -1,
		'post_type'		=> 'reviews',
		'meta_key'		=> 'company',
		'meta_value'	=> $company_id
	);

	// query
	$ratings_query = new WP_Query( $args );
	if( $ratings_query->have_posts() ):?>
		<section class="reviews">
			<h3 class="section-title"><?php echo $ratings_query->found_posts.' '.plural($ratings_query->found_posts, 'Review', 'Reviews').' for '.$company_name?></h3>
			<?php while( $ratings_query->have_posts() ) : $ratings_query->the_post();?>
				<?php get_template_part( 'template-parts/content', 'review-listing' );?>
			<?php endwhile; ?>
		</section>
	<?php endif; ?>
	<div class="apply-button">
		<a href="#" class="button-blue">Apply</a>
	</div>
	<?php wp_reset_query();	 // Restore global post data stomped by the_post().
}?>
<script>
(function($) {
	$(".apply-button a").click(function (event) {
		$('html, body').animate({
			scrollTop: $(".application").offset().top-60
		}, 300);
	});

})( jQuery );
</script>