<?php
/**
 * Template part for displaying Page Header with page search.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */
global $wp_query, $wp;

?>

<header class="top-page-header" id="title-search">
    <div class="wrapper">
        <h1>
            <?php
            if( is_front_page() ):
                _e('Find Your Next Trucking Job');
            else:
                _e('Trucking Jobs ');
            endif;
            if (isset($wp_query->query_vars['location'])){
                $selected_location = $wp_query->query_vars['location'];
                $location = str_replace("-", " ", $wp_query->query_vars['location']);
                _e('in '.ucwords( $location ) );
            }else{
                $selected_location = 0;
            }
            if( isset( $wp_query->query_vars['driver_type'] ) ){
                $selected_driver = $wp_query->query_vars['driver_type'];
            }else{
                $selected_driver = 0;
            }
            if( isset( $wp_query->query_vars['freight_type'] ) ){

                $selected_freight = $wp_query->query_vars['freight_type'];
            }else{
                $selected_freight = 0;
            }
            ?>
        </h1>
        <h3><?php _e('Search for your next trucking job here')?></h3>
        <?php
        the_archive_description( '<div class="taxonomy-description">', '</div>' );
        ?>
        <form id="category-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
            <input type="hidden" name="post_type" value="jobs">
            <?php wp_dropdown_categories( array(
                'show_option_none'  => __( 'Select Location', '_scorch' ),
                'taxonomy'          => 'location',
                'hierarchical'      => true,
                'id'                => 'select-location',
                'class'             => 'custom-select',
                'name'              => 'location',
                'value_field'       => 'slug',
                'hide_empty'        => false,
                'selected'          => $selected_location,
            ) ); ?>
            <?php wp_dropdown_categories( array(
                'show_option_none'  => __( 'Select Type', '_scorch' ),
                'taxonomy'          => 'freight_type',
                'id'                => 'select-freight',
                'class'             => 'custom-select',
                'name'              => 'freight_type',
                'value_field'       => 'slug',
                'hide_empty'        => false,
                'selected'          => $selected_freight,
            ) ); ?>
            <?php wp_dropdown_categories( array(
                'show_option_none'  => __( 'Select Driver Type', '_scorch' ),
                'taxonomy'          => 'driver_type',
                'hierarchical'      => true,
                'id'                => 'select-driver',
                'class'             => 'custom-select',
                'name'              => 'driver_type',
                'value_field'       => 'slug',
                'hide_empty'        => false,
                'selected'          => $selected_driver,
            ) ); ?>

            <a href="#" id="submit-job-sort" class="button-blue">Find</a>
        </form>
    </div>
</header><!-- .top-page-header -->