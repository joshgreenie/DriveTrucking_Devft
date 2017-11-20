<?php

$locations = get_the_terms(get_the_ID(), 'location');
$freight_type = get_field('freight_type');
$driver_type = get_field('driver_type');
$run_type = get_field('run_type');
$enticement_notice = get_field('enticement_notice');
$job_description = get_field('job_description');
$company = get_field('company');
$select_company = get_field('select_company');
$salary_range = get_field('salary_range');
$employment_type = get_field('employment_type');
$jobtitle = get_the_title();
$jobdate = get_the_date();
$state = '';
$city = '';
$enticement_image = get_field('enticement_image');
$enticement_image_mobile = get_field('enticement_image_mobile');
$user_form = get_field('user_form');
$job_type = get_field('job_type');
$base_salary = get_field('base_salary');
$work_hours = get_field('work_hours');
$job_type = get_field('job_type');

$detect = new Mobile_Detect;

if ($company == 'Select Company'):
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

$locations = get_the_terms(get_the_ID(), 'location');
foreach ($locations as $location) :
    if ($location->parent == 0):
        $state_strip = $location->name;
    endif;
    if ($location->parent != 0):
        $city_strip = $location->name;
    endif;
endforeach;
?>


<div class="job-flag-feed single-job flag-border-double">
    <div class="flag-wrapper">
        <div class="flag-inner-wrapper">
            <div class="entry-meta">
                <?php if ($locations): ?>
                    <div class="location" itemprop="jobLocation" itemscope itemtype="http://schema.org/Place">
                        <h4><?php _e('Location', '_scorch'); ?></h4>
                        <div>
                            <?php
                            $locations = get_the_terms(get_the_ID(), 'location');
                            foreach ($locations as $location) :
                                if ($location->parent == 0):?>
                                    <div><strong><?php _e('State: ') ?></strong><span
                                                itemprop="addressRegion"><?php echo $location->name; ?></span></div>
                                    <?php $state = $location->name; ?>
                                <?php endif; ?>
                                <?php if ($location->parent != 0): ?>
                                <div><strong><?php _e('City: ', '_scorch') ?></strong><span
                                            itemprop="addressLocality"><?php echo $location->name; ?></span></div>
                                <?php $city = $location->name; ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($freight_type): ?>
                    <div class="freight-type">
                        <h4><?php _e('Freight Type: ', '_scorch'); ?></h4>
                        <span> <!-- itemprop="occupationalCategory" --> <?php echo $freight_type->name; ?></span>
                    </div><!-- .freight-type -->
                <?php endif; ?>
                <?php if ($driver_type): ?>
                    <div class="driver-type">
                        <h4><?php _e('Driver Type: ', '_scorch'); ?></h4>
                        <span><?php echo $driver_type->name; ?></span>
                    </div><!-- .driver-type -->
                <?php endif; ?>
                <?php if ($run_type): ?>
                    <div class="run-type">
                        <h4><?php _e('Run Type: ', '_scorch'); ?></h4>
                        <span><?php echo $run_type->name; ?></span>
                    </div><!-- .run-type -->
                <?php endif; ?>
                <?php if ($job_type): ?>
                    <div class="run-type">
                        <h4><?php _e('Job Type: ', '_scorch'); ?></h4>
                        <span><?php echo $job_type; ?></span>
                    </div><!-- .run-type -->
                <?php endif; ?>
            </div><!-- .entry-meta -->

            <div class="enticement-content">
                <?php if ($enticement_notice): ?>
                    <span class="enticement"><?php echo $enticement_notice; ?></span>
                <?php endif; ?>
            </div><!--.enticement-content-->

            <div class="education repeater-sidebar-block">
                <h4><?php _e('Education Requirements:', '_scorch') ?></h4>
                <?php if (have_rows('education_requirements')): ?>
                    <ul itemprop="education_requirements">
                        <?php while (have_rows('education_requirements')) : the_row(); ?>
                            <li><span><?php the_sub_field('education_requirements'); ?></span></li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="endorsements repeater-sidebar-block">
                <h4><?php _e('Endorsements:', '_scorch') ?></h4>
                <?php if (have_rows('endorsements')): ?>
                    <ul itemprop="endorsements">
                        <?php while (have_rows('endorsements')) : the_row(); ?>
                            <li><span><?php the_sub_field('endorsement'); ?></span></li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="apply">
                <?php
                // override $post
                $post = $select_company;
                setup_postdata($post);

                $phone = get_field('phone');
                if (isset($_GET['utm_source'])) {
                    $source = $_GET['utm_source'];
                }
                $the_company = get_the_title();
                ?>
                <div class="call">
                    <h3><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></h3>
                </div>
                <?php
                wp_reset_postdata();


                ?>
                <a href="#" class="blue-arrow" id="bottom-apply"><?php _e('Quick Apply'); ?></a>
            </div><!-- .apply-->
        </div>
    </div>
</div>
