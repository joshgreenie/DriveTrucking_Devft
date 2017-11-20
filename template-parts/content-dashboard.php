<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', '_scorch'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->


    <div class="state-heading">
        <h2 class="heading big left"><?php single_term_title(); ?> Trucking Jobs</h2>
        <div id="isotope-select">
            <div class="isotope-filters">
                <h2 class="heading main">Job Filters</h2>
                <?php


                $termId = '54';
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


                $options = array(
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
                    $optionFull = "experience_range-" . $optionlower;
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

    <div id="isotope-container">

        <h2 class="heading main">No Results Found, Try Another Combination</h2>
        <?php

        $args = array(
            'post_type' => 'jobs',
            'post_status' => array('publish'),
            'post_per_page' => '-1',
        );
        // The Query
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            $count = $wp_query->post_count;
            while ($wp_query->have_posts()) : $wp_query->the_post();

                get_template_part('template-parts/content', 'listings-new');

            endwhile;

        else :

            get_template_part('template-parts/content', 'no-jobs');

        endif; ?>
    </div>


    <footer class="entry-footer">
        <?php
        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                esc_html__('Edit %s', '_scorch'),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ),
            '<span class="edit-link">',
            '</span>'
        );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->

