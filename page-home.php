<?php
/**
 *
 * Template Name: Home
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */

get_header(); ?>

<?php get_template_part('template-parts/content', 'page-header')?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <header class="page-header">
                <h2><?php _e('Find Trucking Jobs by State', '_scorch')?></h2>
            </header><!-- .page-header -->

            <?php
            while ( have_posts() ) : the_post();

                $list = '';
                $cats = get_categories( array(
                    'taxonomy' 		=> 'location',
                    'orderby' 		=> 'name',
                    'parent'  		=> 0,
                    'hide_empty'  	=> 0,
                ) );

                $groups = array();
                if( $cats && is_array( $cats ) ) {
                    foreach( $cats as $cat ) {
                        $first_letter = strtoupper( $cat->name[0] );
                        $groups[ $first_letter ][] = $cat;
                    }
                    if( !empty( $groups ) ) {
                        {

                            $list .= '<div class="states">';
                            $x=1;
                            foreach ($groups as $letter => $cats) {
                                if($x == 1 || $x == 5 || $x == 12){
                                    $list .= '<div class="one-third">';
                                }
                                $list .= '<div class="letter-wrapper"><h2>' . apply_filters('the_title', $letter) . '</h2>';
                                $list .= '<ul class="states-category">';
                                foreach ($cats as $cat) {

                                    $sub_categories = get_categories(array(
                                        'taxonomy' => 'location',
                                        'orderby' => 'name',
                                        'parent' => $cat->term_id,
                                        'hide_empty' => 0,
                                    ));

                                    //$url = esc_attr(get_category_link($cat->term_id));
                                    $name = apply_filters('the_title', $cat->name);
                                    $list .= '<li><a title="' . $name . '" href="/jobs/' . $cat->slug . '/">' . $name . '</a></li>';
                                    if (!empty($sub_categories)) {
                                        $list .= '<ul class="cities-categories">';
                                        foreach ($sub_categories as $sub_category) {
                                            $sub_url = esc_attr(get_category_link($sub_category->term_id));
                                            $sub_name = apply_filters('the_title', $sub_category->name);
                                            $list .= '<li><a title="' . $sub_name . '" href="/jobs/' . $sub_category->slug . '/">' . $sub_name . '</a></li>';
                                        }
                                        $list .= '</ul>';
                                    }

                                }
                                $list .= '</div>';
                                if($x == 4 || $x == 11 || $x == 19){
                                    $list .= '</div>';
                                }
                                $x++;
                            }
                            $list .= '</div>';
                        }
                    }
                }else {
                    $list .= '<p>Sorry, No Categories Found</p>';
                }
                ?>
                <?php print $list;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();

