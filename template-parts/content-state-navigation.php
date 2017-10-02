<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 9/7/2017
 * Time: 2:20 AM
 */

$taxonomy = get_query_var('taxonomy');
$termId = get_queried_object()->term_id;

// check if the repeater field has rows of data
$max_slider_height = get_field('max_slider_height', $taxonomy . '_' . $termId);

if (have_rows('navigation', $taxonomy . '_' . $termId)): ?>
    <nav id="secondary-navigation">
        <div class="grid-container">
            <ul class="state-sub-nav">
                <?php while (have_rows('navigation', $taxonomy . '_' . $termId)):the_row();
                    $link_text = get_sub_field('link_text');
                    $link_url = get_sub_field('link_url');
                    echo $link_url ? "<li class='nav-item'><a href='$link_url' target='_blank'>$link_text</a></li>" : "";
                endwhile; ?>
            </ul>
        </div>
    </nav>
<?php endif;