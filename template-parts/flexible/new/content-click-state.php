<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 8/30/2017
 * Time: 3:27 PM
 */

?>
<div class="click-a-state">
    <div class="grid-container">
        <div class="map-wrapper">
            <h2 class="shelf-header">Click a State to Get Started</h2>
            <div id="vmap"></div>
            <script>
                (function ($) {
                    $(document).ready(function () {
                        $('#vmap').vectorMap({
                            map: 'usa_en',
                            backgroundColor: 'transparent',
                            borderColor: '#fff',
                            borderWidth: 2,
                            color: '#124b7b',
                            hoverColor: '#F4911D',
                            enableZoom: false,
                            selectedRegions: null,
                            showTooltip: true,
                            onRegionClick: function (element, code, region) {
                                var regionTrim = region.replace(/\s+/g, '-').toLowerCase(),
                                    urlBase = window.location.protocol + "//" + window.location.host + "/",
                                    url = [location.protocol, '//', location.host, location.pathname].join('');
                                window.location.replace(url + '/?location=' + regionTrim +'#flex');
                            }
                        });
                    });
                })(jQuery);

            </script>
        </div>
        <div class="job-flag-feed flag-border-double">
            <div class="flag-wrapper">
                <div class="flag-inner-wrapper">
                <?php
                $location = get_terms('location', array('hide_empty' => true, 'fields' => 'all'));
                $loc_query = array(array('relation' => 'AND'));
                $location_get = '';
                if(isset($_GET['location'])) {
                    $location_get = $_GET['location'];
                $location_string = preg_replace("/[\-]/", " ", $location_get);
                $location_capital_string = ucwords($location_string);

                }
                if ($location_get != ''):
                    echo "<h2 class='heading'>$location_capital_string</h2>";
                else:
                    echo "<h2 class='heading'>Recent Job Postings</h2>";
                endif;
                if (isset($_GET['location']) && $_GET['location']) {
                    $loc_area_query = array('taxonomy' => 'location', 'field' => 'slug', 'terms' => $_GET['location'], 'operator' => 'IN',);
                    $loc_query[] = $loc_area_query;
                }
                $args = array(
                    'post_type' => 'jobs',
                    'post_status' => array('publish'),
                    'orderby' => 'date',
                    'posts_per_page' => 3,
                    'order' => 'desc',
                    'tax_query' => $loc_query,
                );
                // The Query
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) :
                    $count = $wp_query->post_count;

                    while ($wp_query->have_posts()) : $wp_query->the_post();
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
                        $company = get_field('company');
                        $select_company = get_field('select_company');
                        $select_company_post = get_post($select_company);
                        $custom_company_name = get_field('custom_company_name');
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
                                <?php if ($select_company):
                                    echo "<span class='attributes'><b>Company:</b>$select_company_post->post_title</span>";
                                elseif ($company == 'Custom Name'):
                                    echo "<span class='attributes'><b>Company:</b>$custom_company_name</span>";
                                endif; ?>
                            </div>

                            <div class="side-wage">
                                <?php if ($salary_range): ?>
                                    <span class="rate"><?= $salary_range; ?></span>
                                <?php endif; ?>
                                <?php if ($enticement_notice): ?>
                                    <span class="bonus"><?= $enticement_notice; ?></span>
                                <?php endif; ?>
                            </div>

                            <?php if ($short_description):
                                echo "<div class='short-description'>$short_description</div>";
                            endif; ?>
                            <div class="post-footer">
                                <div class="footer-image"
                                    <?php if ($enticement_image): ?>
                                     style="background-image:url(<?= $enticement_imageURL; ?>);"
                                     <?php endif; ?>
                                             ></div>
                                <?php if ($enticement_image_mobile): ?>
                                    <style type="text/css">
                                        .footer-image[style*="background-image:url(<?=$enticement_imageURL;?>)"] {
                                            background-image: <?=$enticement_image_mobileURL;?>;
                                        }
                                    </style>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php

                    endwhile;
                    if (isset($_GET['location']) && $_GET['location']) : ?>
                        <a href="/location/<?= $location_get; ?>" class="blue-arrow">See All</a>
                    <?php else: ?>
                        <a href="/jobs/" class="blue-arrow">See All</a>
                    <?php endif;
                else:
                    echo "<h1>No jobs found in this state</h1>";
                endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

