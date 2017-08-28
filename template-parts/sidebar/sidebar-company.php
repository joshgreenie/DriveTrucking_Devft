<?php
/**
 * The sidebar for to display Company profiles and details in the sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _scorch
 */
/**
 * Get Company Post Type Variables
*/
$company_address                = get_field('company_address');
$phone                          = get_field('phone');
$website                        = get_field('website');
$number_of_employees            = get_field('number_of_employees');
$number_of_trucks               = get_field('number_of_trucks');
$social_links                   = get_field('social_links');
$company_video                  = get_field('company_video');
$company_video                  = get_field('company_video');
$working_area                   = get_field('working_area');
$average_trip_duration          = get_field('average_trip_duration');
$route_types                    = get_field('route_types');
$route_types                    = get_field('driver_types');
$freight_types                  = get_field('freight_types');
$paid_orientation               = get_field('paid_orientation');
$compensation_levels            = get_field('compensation_levels');
$bonuses                        = get_field('bonuses');
$medical                        = get_field('medical');
$dental                         = get_field('dental');
$vision                         = get_field('vision');
$retirement                     = get_field('retirement');
$additional_benefits            = get_field('additional_benefits');

?>
<aside id="secondary" class="widget-area" role="complementary">
    <section id="filter-jobs" class="widget widget_categories">
        <div class="company-logo">
            <?php the_post_thumbnail('company-logo');?>
        </div>
        <h2 class="widget-title"><?php _e('Company Info', '_scorch')?></h2>
        <dl>
            <dt><?php _e('Company', '_scorch')?></dt>
            <dd><?php the_title();?></dd>

            <?php if($phone):?>
            <dt><?php _e('Phone', '_scorch')?></dt>
            <dd><?php echo $phone;?></dd>
            <?php endif;?>

            <?php if($company_address):?>
            <dt><?php _e('Location', '_scorch')?></dt>
            <dd><?php echo $company_address;?></dd>
            <?php endif;?>

            <?php if($website):?>
            <dt><?php _e('Website', '_scorch')?></dt>
            <dd><?php echo $website;?></dd>
            <?php endif;?>

            <?php if($number_of_employees):?>
            <dt><?php _e('Number of Employees', '_scorch')?></dt>
            <dd><?php echo $number_of_employees;?></dd>
            <?php endif;?>

            <?php if($number_of_employees):?>
            <dt><?php _e('Number of Trucks', '_scorch')?></dt>
            <dd><?php echo $number_of_trucks;?></dd>
            <?php endif;?>

        </dl>

    </section>
    <section>

    </section>

</aside><!-- #secondary -->

