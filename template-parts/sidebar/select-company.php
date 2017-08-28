<?php
// Setup Variables
$company_address                = get_field('company_address');
$phone                          = get_field('phone');
$website                        = get_field('website');
$number_of_employees            = get_field('number_of_employees');
$number_of_trucks               = get_field('number_of_trucks');
$social_links                   = get_field('social_links');
$company_video                  = get_field('company_video');
$working_area                   = get_field('working_area');
$average_trip_duration          = get_field('average_trip_duration');
$route_types                    = get_field('route_types');
$driver_types                   = get_field('driver_types');
$freight_types                  = get_field('freight_types');
$paid_orientation               = get_field('paid_orientation');
$compensation_levels            = get_field('compensation_levels');
$bonuses                        = get_field('bonuses');
$medical                        = get_field('medical');
$dental                         = get_field('dental');
$vision                         = get_field('vision');
$retirement                     = get_field('retirement');
$additional_benefits            = get_field('additional_benefits');
$company_link                   = get_permalink();
$company_slug                   = the_slug(false);
$company_name                   = get_the_title();
?>
<aside id="secondary" class="widget-area" role="complementary">
    <section id="company-info" class="company-aside">
        <div class="company-logo">
            <a href="<?php echo get_permalink();?>"><?php the_post_thumbnail('company-logo');?></a>
            <br>
            <a href="<?php echo get_permalink();?>"><?php _e('See Full Company Profile')?></a>
        </div>
        <h3 class="widget-title"><?php _e('Company Info', '_scorch')?></h3>
        <dl itemprop="hiringOrganization" itemscope itemtype="http://schema.org/Organization">
            <dt><?php _e('Company', '_scorch')?></dt>
            <dd id="company-name" itemprop="name"><?php the_title();?></dd>

            <?php if($phone):?>
                <dt><?php _e('Phone', '_scorch')?></dt>
                <dd id="company-phone" itemprop="telephone"><?php echo $phone;?></dd>
            <?php endif;?>

            <?php if($company_address):?>
                <dt><?php _e('Location', '_scorch')?></dt>
                <dd><?php echo $company_address;?></dd>
            <?php endif;?>

            <?php if($website):?>
                <dt><?php _e('Website', '_scorch')?></dt>
                <dd><a href="<?php echo $website;?>"><?php echo $website;?></a></dd>
            <?php endif;?>

            <?php if($number_of_employees):?>
                <dt><?php _e('Number of Employees', '_scorch')?></dt>
                <dd><?php echo $number_of_employees;?></dd>
            <?php endif;?>

            <?php if($number_of_employees):?>
                <dt><?php _e('Number of Trucks', '_scorch')?></dt>
                <dd><?php echo $number_of_trucks;?></dd>
            <?php endif;?>
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
                <dt><?php _e('Company Reviews');?></dt>
                <dd class="reviews">
                    <a href="<?php echo $company_link?>"><?php echo $ratings_query->found_posts.' '.plural($ratings_query->found_posts, 'Review', 'Reviews')?></a>
                </dd>
            <?php endif; ?>
        </dl>
        <div class="company-list-link">
        </div>
    </section>
    <?php if(!is_singular('company')):?>
    <section class="hiring-map company-aside">
        <h3 class="widget-title"><?php _e('Hiring Area Map')?></h3>
        <div id="vmap" style="height: 200px;"></div>
        <ul class="state-list">
            <?php
            $labels = array();
            $field = get_field_object('working_area');
            $states = get_field('working_area');
            foreach ($states as $state) {
                $labels[] = $field['choices'][ $state ];
            }
            foreach ($labels as $label) {
                echo '<li class="state">'.$label.'</li>';
            }
            ?>
        </ul>
        <script>
            (function($) {
                $(document).ready(function () {
                    $('#vmap').vectorMap({
                        map: 'usa_en',
                        backgroundColor: '#FFFFFF',
                        borderColor: '#999999',
                        borderOpacity: 0.15,
                        borderWidth: 2,
                        color: '#f4f3f0',
                        hoverColor: null,
                        enableZoom: false,
                        selectedRegions: null,
                        showTooltip: true,
                        colors: {
                            <?php
                            foreach ($states as $state){
                                echo strtolower($state).": '#00497f',";
                            }
                            ?>
                        }
                    });
                });
            })( jQuery );
        </script>
    </section>
    <?php endif;?>
    <section id="general-info" class="company-aside">
        <h3 class="widget-title"><?php _e('General Info', '_scorch')?></h3>
        <dl>
            <?php if($route_types):?>
                <dt><?php _e('Run Types', '_scorch')?></dt>
                <dd><?php
                    if( $route_types ): ?>
                        <?php foreach( $route_types as $route_type ): ?>
                            <span class="routes-types"><?php echo $route_type->name; ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </dd>
            <?php endif;?>
            <?php if($driver_types):?>
                <dt><?php _e('Driver Types', '_scorch')?></dt>
                <dd><?php

                    if( $driver_types ): ?>
                        <?php foreach( $driver_types as $driver_type ): ?>
                            <span class="routes-types"><?php echo $driver_type->name; ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </dd>
            <?php endif;?>
            <?php if($freight_types):?>
                <dt><?php _e('Freight Types', '_scorch')?></dt>
                <dd><?php

                    if( $freight_types ): ?>
                        <?php foreach( $freight_types as $freight_type ): ?>
                            <span class="routes-types"><?php echo $freight_type->name; ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </dd>
            <?php endif;?>
        </dl>
    </section>
    <section id="compensation-info" class="company-aside">
        <h3 class="widget-title"><?php _e('Compensation', '_scorch')?></h3>
        <dl>
            <?php if($paid_orientation == 'Yes'):?>
                <dt><?php _e('Paid Orientation', '_scorch');?></dt>
                <dd><?php echo $paid_orientation; ?>
                </dd>
            <?php endif;?>
            <?php
            if( have_rows('compensation_levels') ):
                // loop through the rows of data
                while ( have_rows('compensation_levels') ) : the_row();?>
                    <dt>
                        <?php the_sub_field('experience');?>
                    </dt>
                    <dd>
                        <?php the_sub_field('amount');?>
                    </dd>
                <?php endwhile;
            endif;
            ?>
        </dl>
    </section>
    <section id="benefits-info" class="company-aside">
        <h3 class="widget-title"><?php _e('Benefits', '_scorch')?></h3>
        <dl>
            <?php if($medical == 'Yes'):?>
                <dt><?php _e('Medical', '_scorch');?></dt>
                <dd><?php echo $medical; ?>
                </dd>
            <?php endif;?>
            <?php if($dental == 'Yes'):?>
                <dt><?php _e('Dental', '_scorch');?></dt>
                <dd><?php echo $dental;?>
                </dd>
            <?php endif;?>
            <?php if($vision == 'Yes'):?>
                <dt><?php _e('Vision', '_scorch')?></dt>
                <dd><?php echo $vision; ?>
                </dd>
            <?php endif;?>
            <?php if($retirement == 'Yes'):?>
                <dt><?php _e('Retirement', '_scorch')?></dt>
                <dd><?php echo $retirement; ?>
                </dd>
            <?php endif;?>
            <?php
            if( have_rows('additional_benefits') ):
                // loop through the rows of data
                while ( have_rows('additional_benefits') ) : the_row();?>
                    <dt>
                        <?php the_sub_field('benefit_name');?>
                    </dt>
                    <dd>
                        <?php _e('Yes', '_scorch');?>
                    </dd>
                <?php endwhile;
            endif;
            ?>
        </dl>
    </section>
    <section id="bonuses-info" class="company-aside">
        <h3 class="widget-title"><?php _e('Bonuses', '_scorch')?></h3>
        <dl>
            <?php
            if( have_rows('bonuses') ):
                // loop through the rows of data
                while ( have_rows('bonuses') ) : the_row();?>
                    <dt>
                        <?php the_sub_field('bonus_name');?>
                    </dt>
                    <dd>
                        <?php _e('Yes', '_scorch');?>
                    </dd>
                <?php endwhile;
            endif;
            ?>
        </dl>
    </section>

    <?php
    // args
    $listings_args = array(
        'orderby'       => 'rand',
        'posts_per_page'	=> 3,
        'post_type'		=> 'jobs',
        'meta_key'		=> 'select_company',
        'meta_value'	=> get_the_ID(),
    );

    // query
    $listings_args = new WP_Query( $listings_args );
    if( $listings_args->have_posts() ):?>
        <section id="other-jobs" class="company-aside">
            <h3 class="widget-title"><?php _e('Other '); echo $company_name; _e(' Jobs'); ?></h3>
            <ul>
                <?php while( $listings_args->have_posts() ) : $listings_args->the_post();?>
                    <li>
                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </section>
    <?php endif; wp_reset_postdata();?>
    <section class="advert">
        <!-- /104636738/top_square_ad -->
        <div id='div-gpt-ad-1463521288188-8'>
            <script type='text/javascript'>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-8'); });
            </script>
        </div>
        <!-- /104636738/button_ad_1 -->
        <div id='div-gpt-ad-1463521288188-0' style='height:125px; width:125px; display: inline-flex;'>
            <script type='text/javascript'>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-0'); });
            </script>
        </div>
        <!-- /104636738/Button_ad_2 -->
        <div id='div-gpt-ad-1463521288188-1' style='height:125px; width:125px; display: inline-flex;'>
            <script type='text/javascript'>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-1'); });
            </script>
        </div>
    </section>
</aside><!-- #secondary -->