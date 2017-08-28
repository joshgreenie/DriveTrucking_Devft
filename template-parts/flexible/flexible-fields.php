<?php
/**
 * Flexible template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */
//Layout name   => stub-{type}.php
$contentOptions = array(
    'content_block'         => 'blocks',
    'content_boxes'         => 'boxes',
    'slider'                => 'slider',
    'gallery'               => 'gallery',
    'content_rows'          => 'rows',
    'content_slider'        => 'content-slider',
    'video'                 => 'map',
    'add_a_form'            => 'form',
    'download'              => 'download',
    'pricing_box'           => 'price-box',
);
// check if the flexible content field has rows of data
if( have_rows('content') ):
    // loop through the rows of data
    while ( have_rows('content') ) : the_row();
        // Identify the selected layout
        $rowLayout = get_row_layout();
        // If a layout is selected
        if ($rowLayout) :
            foreach ($contentOptions as $key => $value) {
                if ($rowLayout == $key){
                    get_template_part('template-parts/flexible/content', $value);
                    break;
                }
            }
        else :
            // No layout selected
        endif;
    endwhile;
    the_content();
else :
    // no layouts found
endif;