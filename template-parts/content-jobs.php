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
$salary_range	    = get_field('salary_range');
$employment_type	    = get_field('employment_type');
$jobtitle			= get_the_title();
$jobdate			= get_the_date();
$state 				='';
$city				='';
$enticement_image   = get_field('enticement_image');
$enticement_image_mobile   = get_field('enticement_image_mobile');
$user_form                  = get_field('user_form');
$job_type                  = get_field('job_type');
$base_salary                  = get_field('base_salary');
$work_hours                  = get_field('work_hours');

$detect = new Mobile_Detect;

if($company == 'Select Company'):
   $jsonCompany = $select_company->name;
else:
    $jsonCompany = $company;
endif;


$salary_range_strip = strip_tags($salary_range);
$jobdate_strip = strip_tags($jobdate);
$job_description_strip = strip_tags($job_description);
$employment_type_strip = strip_tags($employment_type);
$enticement_notice_strip = strip_tags($enticement_notice);
$city_strip = strip_tags($city);
$state_strip = strip_tags($state);
$jobtitle_strip = strip_tags($jobtitle);

$locations = get_the_terms( get_the_ID(), 'location' );
foreach ($locations as $location) :
    if($location->parent == 0):
        $state_strip = $location->name;
endif;
if ( $location->parent != 0 ):
    $city_strip = $location->name;
endif;
endforeach;

?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "JobPosting",
  "baseSalary": "<?=$base_salary;?>",
  "jobBenefits": "<?php if( have_rows("benefits") ): while ( have_rows("benefits") ) : the_row();  echo strip_tags(the_sub_field("benefit"));  echo ", ";endwhile; endif;?>",
  "datePosted": "<?=$jobdate_strip;?>",
  "description": "<?=$job_description_strip;?>",
  "educationRequirements": "<?php if( have_rows("education_requirements") ):while ( have_rows("education_requirements") ) : the_row();         echo strip_tags(the_sub_field("education_requirements")); echo ", "; endwhile; endif;?>",
  "employmentType": "<?=$job_type;?>",
  "experienceRequirements": "<?php if( have_rows("job_requirements") ):while ( have_rows("job_requirements") ) : the_row(); the_sub_field("job_requirement"); echo ", "; endwhile; endif;?>",
  "incentiveCompensation": "<?=$enticement_notice_strip;?>",
  "hiringOrganization": "<?=$jsonCompany;?>",
  "industry": "Truck Driving",
  "jobLocation": {
    "@type": "Place",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "<?=$city_strip;?>",
      "addressRegion": "<?=$state_strip;?>"
    }
  },
  "occupationalCategory": "53-3032 Heavy and Tractor-Trailer Truck Drivers",
  "qualifications": "<?php if( have_rows("endorsements") ):while ( have_rows("endorsements") ) : the_row();         echo strip_tags(the_sub_field("endorsement"));        echo ", "; endwhile; endif;?>",
  "responsibilities": "<?php if( have_rows("responsibilities") ):while ( have_rows("responsibilities") ) : the_row();         echo strip_tags(the_sub_field("responsibilities"));        echo ", "; endwhile; endif;?>",
  "salaryCurrency": "USD",
  "skills": "<?php if( have_rows("skills") ):while ( have_rows("skills") ) : the_row();         echo strip_tags(the_sub_field("skills"));        echo ", "; endwhile; endif;?>",
  "specialCommitments": "<?php if( have_rows("special_commitments") ):while ( have_rows("special_commitments") ) : the_row();         echo strip_tags(the_sub_field("special_commitments"));        echo ", "; endwhile; endif;?>",
  "title": "<?=$jobtitle;?>",
  "workHours": "<?=$work_hours;?>"
}
</script>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <!--itemscope itemtype="http://schema.org/JobPosting" -->
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" itemprop="title">', '</h1>' ); ?>
		<div class="entry-image">
			<?php if($detect->isMobile()):?>
				<?php if($enticement_image):?>
					<img src="<?php echo $enticement_image_mobile['url'];?>" alt="<?php echo $enticement_image_mobile['alt'];?>">
				<?php endif;?>
			<?php else:?>
				<?php if($enticement_image):?>
					<img src="<?php echo $enticement_image['url'];?>" alt="<?php echo $enticement_image['alt'];?>">
				<?php endif;?>
			<?php endif;?>
		</div>
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
					<span> <!-- itemprop="occupationalCategory" --> <?php echo $freight_type->name;?></span>
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

	<div class="apply">
			<a href="#" class="button-blue" id="top-apply"><?php _e('Quick Apply');?></a>
		<?php

			// override $post
			$post = $select_company;
			setup_postdata($post);

			$phone   = get_field('phone');

			if(isset( $_GET['utm_source'])) {
                $source = $_GET['utm_source'];
            }
			$the_company = get_the_title();

			?>
			<div class="call">
				or Call
				<br>
				<h3><a href="tel:<?php echo $phone;?>"><?php echo $phone;?></a></h3>
			</div>
			<?php
			wp_reset_postdata();

		?>
	</div><!-- .apply-->

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
	</div><!-- .entry-content -->

	<div class="apply">
		<a href="#" class="button-blue" id="bottom-apply"><?php _e('Quick Apply');?></a>
		<?php

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

		?>
	</div><!-- .apply-->

	<footer class="entry-footer">
		<?php _scorch__simple_posted_on();?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<div class="apply-application">
	<div class="app-wrapper">
		<div class="application">
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

				<h3 class="apply-title">Apply for <?php echo $jobtitle;?></h3>
				<h5><?php echo $company_name?></h5>
				<div class="company-logo">
					<?php the_post_thumbnail('company-logo');?>
				</div>
				<?php
				if($user_form):
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
			<h5><?php echo $company_name?></h5>
			<div class="enticement-content">
				<h5><?php echo $driver_type->name;?></h5>
				<?php if($enticement_notice):?>
					<span class="enticement"><?php echo $enticement_notice;?></span>
				<?php endif;?>
			</div>
			<?php
			if($user_form):
				gravity_form( $user_form['id'], $display_title = false, $display_description = false, $display_inactive = false, $field_values = $populate, $ajax = true, 10);
			else:
				gravity_form( 1, $display_title = false, $display_description = false, $display_inactive = false, $field_values = $populate, $ajax = true, 10);
			endif;?>

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
		<a href="#" class="close-button"></a>
	</div>
</div>

<script>
	(function($){

		var source = getUrlParameter('utm_source');

		<?php

		if( $detect->isMobile() ):?>
		var ismobile = true;
		<?php else:?>
		var ismobile = false;
		<?php endif;?>

		if(source){
			if(source === 'Truck Driving Jobs' || source === 'JobsInTrucks' || source === 'ZipRecruiter' ||  source === 'Jobs2Careers' || source === 'jobs2careers'){
				$(".apply-application").height( $(document).height() );
				$(".apply-application").fadeToggle();
				$('body').animate({scrollTop:$('.apply-application').offset().top},500);
			}
		}

	})( jQuery );
</script>