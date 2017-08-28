<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 8/27/2017
 * Time: 11:11 PM
 */


$element_type = get_sub_field('element_type');
$heading = get_sub_field('heading');
$number_of_jobs = get_sub_field('number_of_jobs');
$pagination = get_sub_field('pagination');
$link_text = get_sub_field('link_text');
$link_url = get_sub_field('link_url');
$link_class = get_sub_field('link_class');
?>
<div class="job-feed section">
    <div class="grid-container">
        <div class="feed-content">
            <?= $heading ? "<$element_type class='heading'>$heading</$element_type>" : ""; ?>
            <?php if ($number_of_jobs):
                if ($pagination):
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                else:
                    $paged = false;
                endif;
                $args = array(
                    'post_type' => 'jobs',
                    'post_status' => array('publish'),
                    'orderby' => 'date',
                    'posts_per_page' => "$number_of_jobs",
                    'order' => 'desc',
                    'paged' => $paged,
                );

                // The Query
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) :
                    $count = $wp_query->post_count;
                    while ($wp_query->have_posts()) :
                        $wp_query->the_post();
                        $thumbnail = get_the_post_thumbnail_url();
                        $date = get_the_date();
                        $author = get_the_author_posts_link();


                        $display_attributes = get_sub_field('display_attributes');
                        $enticement_image = get_field('enticement_image');
                        $enticement_imageURL = $enticement_image['url'];
                        $enticement_image_mobile = get_field('enticement_image_mobile');
                        $enticement_image_mobileURL = $enticement_image_mobile['url'];
                        $enticement_notice = get_field('enticement_notice');
                        $salary_range = get_field('salary_range');
                        $short_description = get_field('short_description');

                        //            $type = get_field('type');
                        $freight_type = get_field('freight_type');
                        $locations = get_field('location');
                        //            $i =1;

                        $new = "new";

                        ?>

                        <div class="post-content <?= $new; ?>">
                            <div class="post-meta">
                                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <?php if ($freight_type):
                                    echo "<span class='attributes'><b>Type:</b>$freight_type->name</span>";
                                endif; ?>
                                <?php if ($locations):
                                    echo "<span class='locations'><b>Locations:</b>";
                                    foreach ($locations as $location):
                                        echo "<span class='location'>$location->name</span>";
                                    endforeach;
                                    echo "</span>";
                                endif; ?>
                            </div>

                            <?php if ($short_description):
                                echo "<div class='short-description'>$short_description</div>";
                            endif; ?>
                            <div class="post-footer">
                                <div class="footer-image"
                                    <?php if ($enticement_image): ?>
                                     style="background-image:url(<?= $enticement_imageURL; ?>);
                                     <?php endif; ?>
                                             "></div>
                                <?php if ($enticement_image_mobile): ?>
                                    <style type="text/css">
                                        .footer-image[style*="background-image:url(<?=$enticement_imageURL;?>)"] {
                                            background-image: <?=$enticement_image_mobileURL;?>;
                                        }
                                    </style>
                                <?php endif; ?>
                                <div class="footer-wage">
                                    <?php if ($salary_range): ?>
                                        <span class="rate"><?= $salary_range; ?></span>
                                    <?php endif; ?>
                                    <?php if ($enticement_notice): ?>
                                        <span class="bonus"><?= $enticement_notice; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php

                    endwhile;
                endif;

                if ($pagination):
                    wp_pagenavi();
                endif;
                wp_reset_query();

            endif; ?>
            <?= $link_url ? "<a href='$link_url' class='$link_class'>$link_text</a>" : ""; ?>
        </div>
    </div>
</div>
