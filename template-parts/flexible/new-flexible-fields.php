<?php
/**
 * Flexible template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */
$contentOptions = array(
    //Layout name   => stub-{type}.php
    'form_header'            => 'form-header',
    'split_chevron_content'  => 'split-chevron',
    'jobs_in_your_area'      => 'jobs',
    'page_header'            => 'page-header',
    'form_shelf'             => 'form-shelf',
    'click_a_state'          => 'click-state',
    'company_slider'         => 'company-slider',
    'content'                => 'content',
    'collapsable_table'      => 'table',

);
// check if the flexible content field has rows of data
if( have_rows('flexible_fields') ):
    // loop through the rows of data
    while ( have_rows('flexible_fields') ) : the_row();
        // Identify the selected layout
        $rowLayout = get_row_layout();
        // If a layout is selected
        if ($rowLayout) :
            foreach ($contentOptions as $key => $value) {
                if ($rowLayout == $key){
                    get_template_part('template-parts/flexible/new/content', $value);
                    break;
                }
            }
        else :
        endif;
    endwhile;
else :
    the_content();
endif;