<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */

$detect = new Mobile_Detect;
get_header('2');

$term = get_queried_object();

//
//$term = get_term_by( 'slug', get_query_var( 'term' ) );
//if($term->parent > 0):
//    get_template_part('template-parts/content', 'page-header');
//    else:

get_template_part('template-parts/content', 'state-slider');
get_template_part('template-parts/content', 'state-navigation');
get_template_part('template-parts/content', 'state-banner');
//    endif;

$url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
$parts = parse_url($escaped_url);
$path_parts = explode('/', $parts['path']);
$selected_location = $path_parts[2];

$tax = $wp_query->get_queried_object();


$taxonomy = get_query_var('taxonomy');
$termId = get_queried_object()->term_id;

$top_content = get_field('top_content', $taxonomy . '_' . $termId);

?>
    <div class="split-chevron"
         style="background-image: url(http://www.drivetrucking.devft.com/wp-content/uploads/2017/08/bg-pic-2.jpg);">
        <div class="grid-container">
            <div class="split-content-right">
                <div class="state-heading">
                    <h2 class="heading big left"><?php single_term_title(); ?> Trucking Jobs</h2>
                    <?php if ($top_content):
                        echo $top_content;
                    endif; ?>
                    <div id="isotope-select">
                        <div class="isotope-filters">
                            <h2 class="heading main">Job Filters</h2>
                            <?php


                            $prefix = 'location-';




                            $taxonomy_name = 'location';
                            $termchildren = get_term_children($termId, $taxonomy_name);

                            echo '<select  name="location" class="custom-select select2" data-filter-group="select_location">';
                            echo '<option  value="-1" data-filter-value="">Select a City</option>';
                            foreach ($termchildren as $child) {
                                $term = get_term_by('id', $child, $taxonomy_name);
                                echo '<option value="' . $term->slug . '"  data-filter-value=".location_' . $term->slug . '">' . $term->name . '</option>';
                            }
                            echo '</select>';


                            wp_dropdown_categories(array(
                                'show_option_none' => __('Select Driver Type', '_scorch'),
                                'taxonomy' => 'driver_type',
                                'hierarchical' => true,
                                'id' => 'select-driver',
                                'class' => 'custom-select select2',
                                'name' => 'driver_type',
                                'value_field' => 'slug',
                                'hide_empty' => true
                            ));


                            $options =  array(
                                'Student',
                                '0-6 months',
                                '6 months - 1 year',
                                '1-2 years',
                                '2-5 years',
                                '5-7 years',
                                '7-10 years',
                                '10-12 years',
                            );

                            echo '<select  name="experience_range" class="custom-select select2" data-filter-group="select_salary">';
                            echo '<option  value="-1" data-filter-value="">Select an Experience Level</option>';
                            foreach ($options as $option) {
                                $optionlower = preg_replace('/\s*/', '', $option);
                                $optionlower = strtolower($optionlower);
                                $optionFull = "experience_range-".$optionlower;
                                echo '<option value="' . $optionlower . '"  data-filter-value=".' . $optionFull . '">' . $option . '</option>';
                            }
                            echo '</select>';



                            ?>

                            <?php
                            $args = array(
                                'taxonomy' => 'freight_type',
                                'parent' => 0, // get top level categories
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hierarchical' => 1,
                                'hide_empty' => 1,
                                'pad_counts' => 0
                            );

                            $categories = get_categories($args);

                            echo '<ul class="custom-check">';
                            echo '<h4>Freight Types</h4>';
                            foreach ($categories as $category) {

                                echo '<li><input type="checkbox" value="' . $category->slug . '" data-filter-group=".freight_type" data-filter-value=".freight_type-' . $category->slug . '"><label>' . $category->name . '</label></li>';
                            }
                            echo '</ul>'; ?>
                            <?php
                            $args = array(
                                'taxonomy' => 'run_types',
                                'parent' => 0, // get top level categories
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hierarchical' => 1,
                                'hide_empty' => 1,
                                'pad_counts' => 0
                            );

                            $categories = get_categories($args);

                            echo '<ul class="custom-check">';
                            echo '<h4>Run Types</h4>';
                            foreach ($categories as $category) {

                                echo '<li><input type="checkbox" value="' . $category->slug . '" data-filter-group=".run_types" data-filter-value=".run_types-' . $category->slug . '"><label>' . $category->name . '</label></li>';
                            }
                            echo '</ul>';
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="main-content-tax">
    <div class="grid-container">
        <!--    --><?php //echo $top_content ? "$top_content":""; ?>
        <div class="width-set"></div>
        <?php get_sidebar('state'); ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">


                <div id="isotope-container">

                    <h2 class="heading main">No Results Found, Try Another Combination</h2>
                    <?php
                    if (have_posts()) : ?>

                        <?php
                        $i = 1;

                        while (have_posts()) : the_post();

                            get_template_part('template-parts/content', 'listings-new');

                            if ($i == 8 || $i == 16 || $i == 24 || $i == 32) {
                                if ($detect->isMobile() && !$detect->isTablet()) {
                                    ?>
                                    <!--                            <article id="post-info">-->
                                    <!--                                <!-- /104636738/mobile_leader_board -->
                                    <!--                                <div id='div-gpt-ad-1463684262279-1' style='height:50px; width:320px;'>-->
                                    <!--                                    <script type='text/javascript'>-->
                                    <!--                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463684262279-1'); });-->
                                    <!--                                    </script>-->
                                    <!--                                </div>-->
                                    <!--                            </article>-->
                                <?php } else {
                                    ?>

                                    <!--                            <article id="post-info">-->
                                    <!--                                <!-- /104636738/listings_leader_board -->
                                    <!--                                <div id='div-gpt-ad-1464280269192-0'>-->
                                    <!--                                    <script type='text/javascript'>-->
                                    <!--                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1464280269192-0'); });-->
                                    <!--                                    </script>-->
                                    <!--                                </div>-->
                                    <!--                            </article>-->
                                    <?php
                                }
                            }
                            $i++;

                        endwhile;

//                _scorch_pagination();

                    else :

                        get_template_part('template-parts/content', 'no-jobs');

                    endif; ?>
                </div>

            </main><!-- #main -->
        </div><!-- #primary -->

    </div>
</div>
<?php get_footer();
