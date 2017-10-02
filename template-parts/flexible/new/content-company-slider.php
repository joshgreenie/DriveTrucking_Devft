<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 8/31/2017
 * Time: 1:42 PM
 */


?>
<div class="company-slider">
    <div class="grid-container">
        <h2 class="heading">Companies Using Drive Trucking</h2>
        <div class="owl-carousel owl-carousel-content">

            <?php  $args = array(
                    'post_type' => 'company',
                    'post_status' => array('publish'),
                    'orderby' => 'date',
                    'posts_per_page' => -1,
                    'order' => 'desc',
                );

                // The Query
                $wp_query = new WP_Query($args);
                if ($wp_query->have_posts()) :
                    $count = $wp_query->post_count;
                    while ($wp_query->have_posts()) :
                        $wp_query->the_post();
                        $logo = get_the_post_thumbnail_url();
                        $link = get_permalink();
                        if($logo):
                        ?>
                        <div class="item">
                            <a href="<?=$link?>">
                                <div class="slide-item" style="background-image: url(<?=$logo;?>)"></div>
                            </a>
                        </div>
                        <?php
                        endif;
                    endwhile;
                wp_reset_query();
                endif; ?>
        </div>
    </div>
</div>

