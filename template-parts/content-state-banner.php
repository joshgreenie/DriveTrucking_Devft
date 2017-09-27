<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 9/12/2017
 * Time: 10:05 PM
 */
?>


<div id="state-banner">
    <div class="grid-container desktop">
        <div class="flex-wrapper">
            <?php

            $taxonomy = get_query_var('taxonomy');
            $termId = get_queried_object()->term_id;

            $args = array(
                'post_type' => 'jobs',
                'posts_per_page' => 3,
                'meta_key' => 'featured_job',
                'meta_value' => '1',
                'tax_query' => array(
                    array( 'taxonomy' => 'location', 'terms' => array( $termId ) )
                )
            );

            // query
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()): ?>
                <div class="featured-post-wrapper post-wrapper bordered">
                    <div class="grid-container mobile">
                        <h2 class="heading big left">Featured Job Listings</h2>
                        <?php while ($the_query->have_posts()) : $the_query->the_post();
                            get_template_part('template-parts/content', 'listings-new');
                        endwhile; ?>
                    </div>
                </div>
            <?php endif;

            wp_reset_query();

            $state_default_banner_header = get_field('state_default_banner_header', 'option');
            $state_default_banner_text = get_field('state_default_banner_text', 'option');
            $state_default_banner_link = get_field('state_default_banner_link', 'option');
            $state_default_banner_link_text = get_field('state_default_banner_link_text', 'option');
            ?>

            <div class="banner-wrap">
                <div class="grid-container mobile">
                    <div class="job-flag-feed flag-border-double small">
                        <div class="flag-wrapper">
                            <div class="flag-inner-wrapper">
                                <?php if ($state_default_banner_header): ?>
                                    <h2 class="heading"><?= $state_default_banner_header; ?></h2>
                                <?php endif; ?>
                                <?php if ($state_default_banner_text):
                                    echo $state_default_banner_text;
                                endif; ?>
                                <?php if ($state_default_banner_link): ?>
                                    <a href="<?= $state_default_banner_link; ?>"
                                       class="blue-arrow"><?= $state_default_banner_link_text; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


