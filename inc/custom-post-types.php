<?php
class Custom_Posts {

    function __construct($init) {

        $this->settings = $init;

        add_action( 'init', array(&$this, 'create_custom_post_type') );

    }

    function create_custom_post_type() {

        if( !empty( $this->settings['custom_slug'] ) ){
            $slug = $this->settings['custom_slug'];
        }else{
            $slug = $this->settings['slug'];
        }
        if($this->settings['has_archive']){
            $has_archive = $this->settings['slug'];
        }else{
            $has_archive = false;
        }
        $labels = array(
            'name'                      => _x( $this->settings['singular_name'], 'Post Type General Name', '_scorch' ),
            'singular_name'             => _x( $this->settings['singular_name'], 'Post Type Singular Name', '_scorch' ),
            'menu_name'                 => __( $this->settings['plural_name'], '_scorch' ),
            'name_admin_bar'            => __( $this->settings['singular_name'], '_scorch' ),
            'archives'                  => __( $this->settings['singular_name'].' Archives', '_scorch' ),
            'parent_item_colon'         => __( 'Parent '.$this->settings['singular_name'].':', '_scorch' ),
            'all_items'                 => __( 'All '.$this->settings['plural_name'], '_scorch' ),
            'add_new_item'              => __( 'Add New '.$this->settings['singular_name'], '_scorch' ),
            'add_new'                   => __( 'Add New '.$this->settings['singular_name'], '_scorch' ),
            'new_item'                  => __( 'New '.$this->settings['singular_name'], '_scorch' ),
            'edit_item'                 => __( 'Edit '.$this->settings['singular_name'], '_scorch' ),
            'update_item'               => __( 'Update '.$this->settings['singular_name'], '_scorch' ),
            'view_item'                 => __( 'View '.$this->settings['singular_name'], '_scorch' ),
            'search_items'              => __( 'Search '.$this->settings['singular_name'], '_scorch' ),
            'not_found'                 => __( 'Not found', '_scorch' ),
            'not_found_in_trash'        => __( 'Not found in Trash', '_scorch' ),
            'featured_image'            => __( $this->settings['featured_image'], '_scorch' ),
            'set_featured_image'        => __( $this->settings['set_featured_image'], '_scorch' ),
            'remove_featured_image'     => __( 'Remove featured image', '_scorch' ),
            'use_featured_image'        => __( 'Use as featured image', '_scorch' ),
            'insert_into_item'          => __( 'Insert into '.$this->settings['singular_name'], '_scorch' ),
            'uploaded_to_this_item'     => __( 'Uploaded to this '.$this->settings['singular_name'], '_scorch' ),
            'items_list'                => __( $this->settings['plural_name'].' list', '_scorch' ),
            'items_list_navigation'     => __( $this->settings['plural_name'].' list navigation', '_scorch' ),
            'filter_items_list'         => __( 'Filter '.$this->settings['plural_name'].' list', '_scorch' ),
        );
        $args = array(
            'label'                     => __( $this->settings['singular_name'], '_scorch' ),
            'description'               => __( 'Create a '.$this->settings['singular_name'].' Listing', '_scorch' ),
            'labels'                    => $labels,
            'supports'                  => $this->settings['supports'],
            'taxonomies'                => $this->settings['taxonomies'],
            'hierarchical'              => $this->settings['hierarchical'],
            'public'                    => $this->settings['is_public'],
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'menu_position'             => intval($this->settings['menu_position']),
            'menu_icon'                 => $this->settings['dashboard_icon'],
            'show_in_admin_bar'         => true,
            'show_in_nav_menus'         => true,
            'can_export'                => true,
            'has_archive'               => $has_archive,
            'exclude_from_search'       => false,
            'publicly_queryable'        => true,
            'capability_type'           => $this->settings['capability_type'],
            'show_in_rest'              => $this->settings['show_in_rest'],
            'rest_base'                 => $this->settings['singular_name'],
            'rest_controller_class'     => 'WP_REST_Posts_Controller',
        );
        register_post_type( $this->settings['slug'], $args );
        if($this->settings['custom_taxonomy']){
            $length = count($this->settings['custom_taxonomies']);
            for ($i = 0; $i < $length; $i++){

                if( !empty( $this->settings['add_tax_custom_slug'] ) ){
                    $tax_slug = $this->settings['add_tax_custom_slug'];
                }else{
                    $tax_slug = $this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['slug'];
                }

                $labels = array(
                    'name'                       => _x( $this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['name'], 'Taxonomy General Name', 'text_domain' ),
                    'singular_name'              => _x( $this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'], 'Taxonomy Singular Name', 'text_domain' ),
                    'menu_name'                  => __( $this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['name'], 'text_domain' ),
                    'all_items'                  => __( 'All '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'], 'text_domain' ),
                    'parent_item'                => __( 'Parent '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'], 'text_domain' ),
                    'parent_item_colon'          => __( 'Parent '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'].':', 'text_domain' ),
                    'new_item_name'              => __( 'New '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'], 'text_domain' ),
                    'add_new_item'               => __( 'Add New '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'], 'text_domain' ),
                    'edit_item'                  => __( 'Edit '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'], 'text_domain' ),
                    'update_item'                => __( 'Update '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'], 'text_domain' ),
                    'view_item'                  => __( 'View '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'], 'text_domain' ),
                    'separate_items_with_commas' => __( 'Separate '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['plural_name'].' with commas', 'text_domain' ),
                    'add_or_remove_items'        => __( 'Add or remove'.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['singular_name'], 'text_domain' ),
                    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
                    'popular_items'              => __( 'Popular '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['plural_name'], 'text_domain' ),
                    'search_items'               => __( 'Search '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['plural_name'], 'text_domain' ),
                    'not_found'                  => __( 'Not Found', 'text_domain' ),
                    'no_terms'                   => __( 'No '.$this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['plural_name'], 'text_domain' ),
                    'items_list'                 => __( $this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['plural_name'].' list', 'text_domain' ),
                    'items_list_navigation'      => __( $this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['plural_name'].' list navigation', 'text_domain' ),
                );
                $args = array(
                    'labels'                     => $labels,
                    'hierarchical'               => $this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['hierarchical'],
                    'public'                     => true,
                    'show_ui'                    => true,
                    'show_admin_column'          => true,
                    'show_in_nav_menus'          => true,
                    'show_tagcloud'              => $this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['tag_cloud'],
                );
                register_taxonomy( $this->settings['custom_taxonomies'][$i]['taxonomy_'.$i]['slug'], array( $this->settings['slug'] ), $args );
            }
        }
    }
}


if(class_exists('acf')) :
    if( have_rows('create_custom_field', 'option') ):
        while( have_rows('create_custom_field','option') ): the_row();
            //Set Variable for options
            $name                   = get_sub_field('name');
            $post_type_key          = get_sub_field('post_type_key');
            $post_type              = get_sub_field('post_type');
            $singular_name          = get_sub_field('singular_name');
            $plural_name            = get_sub_field('plural_name');
            $is_public              = get_sub_field('plural_name');
            $featured_image_name    = get_sub_field('featured_image_name');
            $has_archives           = get_sub_field('has_archives');
            $supports               = get_sub_field('supports');
            $show_in_admin_bar      = get_sub_field('show_in_admin_bar');
            $dashboard_icon         = get_sub_field('dashboard_icon');
            $menu_position          = get_sub_field('menu_position');
            $hierarchical           = get_sub_field('hierarchical');
            $show_in_rest           = get_sub_field('show_in_rest');
            $taxonomies             = get_sub_field('taxonomies');
            $taxonomy_type          = get_sub_field('taxonomy_type');
            $custom_taxonomy        = get_sub_field('custom_taxonomy');


            //Check if has archives is TRUE/FALSE
            if($has_archives){
                $archive = $post_type_key;
            }else{
                $archive = false;
            }

            if($taxonomy_type == 'default'){
                $customtaxonomy = false;
                $taxonomy_types = array('category', 'post_tag');
            }else{
                $customtaxonomy = true;
                $taxonomy_types = array();
                $taxonomy_list = array();

                $x = 0;
                if( have_rows('custom_taxonomy') ):
                    while( have_rows('custom_taxonomy') ): the_row();
                        $taxonomy_key           = get_sub_field('taxonomy_key');
                        $name_singular          = get_sub_field('name_singular');
                        $name_plural            = get_sub_field('name_plural');
                        $hierarchical           = get_sub_field('hierarchical');
                        $tag_cloud              = get_sub_field('tag_cloud');

                        //Set Temporary Array
                        $temp_tax_array = array('taxonomy_'.$x => array(
                                "slug" => $taxonomy_key,
                                "name" => $name_plural,
                                "singular_name" => $name_singular,
                                "plural_name" => $name_plural,
                                "hierarchical" => $hierarchical,
                                "tag_cloud" => $tag_cloud,
                            ),
                        );
                        //array_push($taxonomy_types, $taxonomy_key );
                        array_push($taxonomy_list, $temp_tax_array);
                        $x++;
                    endwhile;
                    //print_r($taxonomy_list);
                endif;
            }

            $custom_posts_settings = array(
                "slug" => $post_type_key,
                "name" => $name,
                "singular_name" => $singular_name,
                "plural_name" => $plural_name,
                "featured_image" => $featured_image_name,
                "set_featured_image" => "Set ".$featured_image_name,
                "is_public" => $is_public,
                "has_archive" => $archive,       //Set to false or use slug name for archive name
                "supports" => $supports,
                "dashboard_icon" => $dashboard_icon,
                "menu_position" => $menu_position,
                "show_in_admin_bar" => $show_in_admin_bar,
                "hierarchical" => $hierarchical,
                "capability_type" => $post_type,
                "show_in_rest" => $show_in_rest,
                "taxonomies" => $taxonomy_types,
                "custom_taxonomy" => $custom_taxonomy,
            );
        //Create that custom post type
        $var = new Custom_Posts ($custom_posts_settings);
        endwhile;
    endif;
endif;

if ( ! function_exists('jobs') ) {

// Register Custom Post Type
    function jobs() {

        $labels = array(
            'name'                  => _x( 'Jobs', 'Post Type General Name', '_scorch' ),
            'singular_name'         => _x( 'Job', 'Post Type Singular Name', '_scorch' ),
            'menu_name'             => __( 'Jobs Listings', '_scorch' ),
            'name_admin_bar'        => __( 'Jobs Listings', '_scorch' ),
            'archives'              => __( 'Job Archives', '_scorch' ),
            'parent_item_colon'     => __( 'Parent Job:', '_scorch' ),
            'all_items'             => __( 'All Jobs', '_scorch' ),
            'add_new_item'          => __( 'Add New Job', '_scorch' ),
            'add_new'               => __( 'Add New', '_scorch' ),
            'new_item'              => __( 'New Job', '_scorch' ),
            'edit_item'             => __( 'Edit Job', '_scorch' ),
            'update_item'           => __( 'Update Job', '_scorch' ),
            'view_item'             => __( 'View Job', '_scorch' ),
            'search_items'          => __( 'Search Job', '_scorch' ),
            'not_found'             => __( 'Not found', '_scorch' ),
            'not_found_in_trash'    => __( 'Not found in Trash', '_scorch' ),
            'featured_image'        => __( 'Company Logo', '_scorch' ),
            'set_featured_image'    => __( 'Set Company Logo', '_scorch' ),
            'remove_featured_image' => __( 'Remove Company Logo', '_scorch' ),
            'use_featured_image'    => __( 'Use as Company Logo', '_scorch' ),
            'insert_into_item'      => __( 'Insert into job', '_scorch' ),
            'uploaded_to_this_item' => __( 'Uploaded to this job', '_scorch' ),
            'items_list'            => __( 'Jobs list', '_scorch' ),
            'items_list_navigation' => __( 'Jobs list navigation', '_scorch' ),
            'filter_items_list'     => __( 'Filter jobs list', '_scorch' ),
        );
        $args = array(
            'label'                 => __( 'Job', '_scorch' ),
            'description'           => __( 'Jobs Listings', '_scorch' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
            'taxonomies'            => array( 'location', 'driver_type', 'freight_type', 'run_type' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 1,
            'menu_icon'             => 'dashicons-editor-ul',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => array('slug' => 'jobs/%location%', 'with_front' => true, 'hierarchical' => true, 'pages' => true ),
            'capability_type'       => 'post',
            'rest_base'             => true,
            'rest_controller_class' => 'WP_REST_Posts_Controller',
        );
        register_post_type( 'jobs', $args );

    }
    add_action( 'init', 'jobs', 0 );

}

// Register Custom Taxonomy
function location() {

    $labels = array(
        'name'                       => _x( 'Location', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Location', 'text_domain' ),
        'all_items'                  => __( 'All Location', 'text_domain' ),
        'parent_item'                => __( 'Parent Location', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Location:', 'text_domain' ),
        'new_item_name'              => __( 'New Location Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Location', 'text_domain' ),
        'edit_item'                  => __( 'Edit Location', 'text_domain' ),
        'update_item'                => __( 'Update Location', 'text_domain' ),
        'view_item'                  => __( 'View Location', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate Locations with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or Remove Locations', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Locations', 'text_domain' ),
        'search_items'               => __( 'Search Locations', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No Locations', 'text_domain' ),
        'items_list'                 => __( 'Locations list', 'text_domain' ),
        'items_list_navigation'      => __( 'Locations list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'location', array( 'jobs' ), $args );

}
add_action( 'init', 'location', 0 );


// Register Custom Taxonomy
function driver_type() {

    $labels = array(
        'name'                       => _x( 'Driver Types', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Driver Type', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Driver Type', 'text_domain' ),
        'all_items'                  => __( 'All Driver Types', 'text_domain' ),
        'parent_item'                => __( 'Parent Driver Type', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Driver Type:', 'text_domain' ),
        'new_item_name'              => __( 'New Driver Type Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Driver Type', 'text_domain' ),
        'edit_item'                  => __( 'Edit Driver Type', 'text_domain' ),
        'update_item'                => __( 'Update Driver Type', 'text_domain' ),
        'view_item'                  => __( 'View Driver Type', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate Driver Types with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove Driver Types', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Driver Types', 'text_domain' ),
        'search_items'               => __( 'Search Driver Types', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No Driver Types', 'text_domain' ),
        'items_list'                 => __( 'Driver Types list', 'text_domain' ),
        'items_list_navigation'      => __( 'Driver Types list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'driver_type', array( 'jobs' ), $args );

}
add_action( 'init', 'driver_type', 0 );

// Register Custom Taxonomy
function freight_type() {

    $labels = array(
        'name'                       => _x( 'Freight Types', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Freight Type', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Freight Type', 'text_domain' ),
        'all_items'                  => __( 'All Freight Types', 'text_domain' ),
        'parent_item'                => __( 'Parent Freight Type', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Freight Type:', 'text_domain' ),
        'new_item_name'              => __( 'New Freight Type Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Freight Type', 'text_domain' ),
        'edit_item'                  => __( 'Edit Freight Type', 'text_domain' ),
        'update_item'                => __( 'Update Freight Type', 'text_domain' ),
        'view_item'                  => __( 'View Freight Type', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate Freight Types with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove Freight Types', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Freight Types', 'text_domain' ),
        'search_items'               => __( 'Search Freight Types', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No Freight Types', 'text_domain' ),
        'items_list'                 => __( 'Freight Types list', 'text_domain' ),
        'items_list_navigation'      => __( 'Freight Types list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'freight_type', array( 'jobs' ), $args );

}
add_action( 'init', 'freight_type', 0 );

// Register Custom Taxonomy
function run_types() {

    $labels = array(
        'name'                       => _x( 'Run Type', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Run Type', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Run Type', 'text_domain' ),
        'all_items'                  => __( 'All Run Types', 'text_domain' ),
        'parent_item'                => __( 'Parent Run Type', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Run Type:', 'text_domain' ),
        'new_item_name'              => __( 'New Run Type Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Run Type', 'text_domain' ),
        'edit_item'                  => __( 'Edit Run Type', 'text_domain' ),
        'update_item'                => __( 'Update Run Type', 'text_domain' ),
        'view_item'                  => __( 'View Run Type', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate Run Types with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or Remove Run Type', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Run Types', 'text_domain' ),
        'search_items'               => __( 'Search Run Types', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No Run Types', 'text_domain' ),
        'items_list'                 => __( 'Run Types list', 'text_domain' ),
        'items_list_navigation'      => __( 'Run Types list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'run_types', array( 'jobs' ), $args );

}
add_action( 'init', 'run_types', 0 );


function thumbnail_column($columns) {
    $new = array();
    foreach($columns as $key => $title) {
        if ($key=='date') // Put the Thumbnail column before the Author column
            $new['company'] = 'Company';
        $new[$key] = $title;
    }
    return $new;
}
add_filter('manage_jobs_posts_columns', 'thumbnail_column');

function status_column($columns) {
    $new = array();
    foreach($columns as $key => $title) {
        if ($key=='date') // Put the Thumbnail column before the Author column
            $new['status'] = 'Status';
        $new[$key] = $title;
    }
    return $new;
}
add_filter('manage_jobs_posts_columns', 'status_column');


/**
 * Add columns to jobs post list
 */
function jobs_custom_column ( $column, $post_id ) {
    switch ( $column ) {
        case 'company':
            $companyID = get_post_meta ( $post_id, 'select_company', true );
            if( $companyID ) {
                $company = get_post( $companyID );
                echo $company->post_title;
            }
            break;
        case 'status':
            $status = get_post_meta ( $post_id, 'job_status', true );
            if( $status ) {
                echo $status;
            }
            break;
    }
}
add_action ( 'manage_jobs_posts_custom_column', 'jobs_custom_column', 10, 2 );

add_filter('post_type_link', 'filter_post_type_link', 10, 2);
function filter_post_type_link( $post_link, $id = 0, $leavename = FALSE ) {
    if ( strpos('%location%', $post_link) === 'FALSE' ) {
        return $post_link;
    }
    $post = get_post($id);
    if ( !is_object($post) || $post->post_type != 'jobs' ) {
        return $post_link;
    }
    $terms = wp_get_object_terms($post->ID, 'location');
    if ( !$terms ) {
        return str_replace('jobs/%location%/', '', $post_link);
    }
    return str_replace('%location%', $terms[0]->slug, $post_link);
}
add_filter( 'rewrite_rules_array','my_insert_rewrite_rules' );
add_action( 'wp_loaded','my_flush_rules' );
function my_flush_rules(){
    $rules = get_option( 'rewrite_rules' );
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

// Adding a new rule
function my_insert_rewrite_rules( $rules ){
    $newrules = array();
    $newrules['jobs/?$'] = 'index.php?post_type=jobs';
    $newrules['jobs/page/?([0-9]{1,})/?$'] = 'index.php?post_type=jobs&paged=$matches[1]';
    $newrules['jobs/(.+?)/page/?([0-9]{1,})/?$'] = 'index.php?post_type=jobs&location=$matches[1]&paged=$matches[2]';
    $newrules['jobs/(location|driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/?$'] = 'index.php?post_type=jobs&$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]';
    $newrules['jobs/(location|driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/?$'] = 'index.php?post_type=jobs&$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]';
    $newrules['jobs/(location|driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/?$'] = 'index.php?post_type=jobs&$matches[1]=$matches[2]&$matches[3]=$matches[4]';
    $newrules['jobs/(driver_type|run_types|freight_type)/(.+?)/?$'] = 'index.php?post_type=jobs&$matches[1]=$matches[2]';
    $newrules['jobs/(location|driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/page/?([0-9]{1,})/?$'] = 'index.php?post_type=jobs&$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]&paged=$matches[9]';
    $newrules['jobs/(location|driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/page/?([0-9]{1,})/?$'] = 'index.php?post_type=jobs&$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&paged=$matches[7]';
    $newrules['jobs/(location|driver_type|run_types|freight_type)/(.+?)/(driver_type|run_types|freight_type)/(.+?)/page/?([0-9]{1,})/?$'] = 'index.php?post_type=jobs&$matches[1]=$matches[2]&$matches[3]=$matches[4]&paged=$matches[5]';
    $newrules['jobs/(driver_type|run_types|freight_type)/(.+?)/page/?([0-9]{1,})/?$'] = 'index.php?post_type=jobs&$matches[1]=$matches[2]&paged=$matches[3]';
    ;
    //print_r($rules);
    return $newrules + $rules;
}

/*function _scorch_add_rewrite_rules() {
    global $wp_rewrite;


    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action( 'generate_rewrite_rules', '_scorch_add_rewrite_rules' );*/


function _scorch_enqueue_based_on_page() {
    if (   is_singular( 'company' ) || is_singular('jobs') || is_page('company-jobs') || is_front_page() ) {
        wp_enqueue_script( 'vmap-js', get_stylesheet_directory_uri() . '/js/jquery.vmap.min.js', array('jquery'), '1.5.1', false );
        wp_enqueue_script( 'vmap-usa-js', get_stylesheet_directory_uri() . '/js/maps/jquery.vmap.usa.js', array('jquery'), '1.5.1', false );

    }
}
add_action( 'wp_enqueue_scripts', '_scorch_enqueue_based_on_page' );

function custom_query_vars_filter($vars) {
    $vars[] = 'company-name';
    return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );

function company_jobs_rewrite_action() {
    add_rewrite_rule(
        '^company-jobs/([^/]+)$',
        'index.php?pagename=company-jobs&company-name=$matches[1]',
        'top');
    add_rewrite_rule(
        '^company-jobs/([^/]+)/page/([^/]+)$',
        'index.php?pagename=company-jobs&company-name=$matches[1]&paged=$matches[2]',
        'top');
}
add_action( 'init', 'company_jobs_rewrite_action' );


add_action( 'restrict_manage_posts', '_scorch_job_admin_posts_filter_restrict_manage_posts' );
/**
 * First create the dropdown
 * make sure to change POST_TYPE to the name of your custom post type
 *
 * @author Ohad Raz
 *
 * @return void
 */
function _scorch_job_admin_posts_filter_restrict_manage_posts(){
    $type = 'jobs';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    //only add filter to post type you want
    if ('jobs' == $type){
        //change this to the list of values you want to show
        //in 'label' => 'value' format
        $values = array(
            'Active' => 'job_status',
            'Featured Jobs' => 'featured_job',
            'Sponsored on Indeed' => 'sponsor_on_indeed',
        );
        ?>
        <select name="admin_filter">
            <option value=""><?php _e('Filter Job By ', '_scorch'); ?></option>
            <?php
            $current_v = isset($_GET['admin_filter'])? $_GET['admin_filter']:'';
            foreach ($values as $label => $value) {
                printf
                (
                    '<option value="%s"%s>%s</option>',
                    $value,
                    $value == $current_v? ' selected="selected"':'',
                    $label
                );
            }
            ?>
        </select>
        <?php
    }
}

add_filter( 'parse_query', '_scorch_job_posts_filter' );
/**
 * if submitted filter by post meta
 *
 * make sure to change META_KEY to the actual meta key
 * and POST_TYPE to the name of your custom post type
 * @author Ohad Raz
 * @param  (wp_query object) $query
 *
 * @return Void
 */
function _scorch_job_posts_filter( $query ){
    global $pagenow;
    $type = 'jobs';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if( $_GET['admin_filter'] == 'job_status'){ $metavalue = 'active';}
    if( $_GET['admin_filter'] == 'sponsor_on_indeed'){ $metavalue = 'true';}
    if( $_GET['admin_filter'] == 'featured_job'){ $metavalue = 1;}
    if ( 'jobs' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['admin_filter']) && $_GET['admin_filter'] != '') {
        $query->query_vars['meta_key'] = $_GET['admin_filter'];
        $query->query_vars['meta_value'] = $metavalue;
    }
}

add_action( 'restrict_manage_posts', '_scorch_job_admin_company_filter' );
/**
 * First create the dropdown
 * make sure to change POST_TYPE to the name of your custom post type
 *
 * @return void
 */
function _scorch_job_admin_company_filter(){
    $type = 'jobs';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    //only add filter to post type you want
    if ('jobs' == $type){
        //change this to the list of values you want to show
        //in 'label' => 'value' format
        $company_args = array(
            'posts_per_page'	=> -1,
            'post_type'		=> 'company',
            'post_status'	=> 'publish',
        );
        $query_company = new WP_Query( $company_args );
        $values = array();
        if($query_company->have_posts()){
            while( $query_company->have_posts() ) { $query_company->the_post();
                $thetitle = get_the_title();
                $the_id = get_the_ID();
                $values[$thetitle] = $the_id;
            }
        }

        ?>
        <select name="company_filter">
            <option value=""><?php _e('Filter By Company ', '_scorch'); ?></option>
            <?php
            $current_value = isset($_GET['company_filter'])? $_GET['company_filter']:'';
            foreach ($values as $label => $value) {
                printf
                (
                    '<option value="%s"%s>%s</option>',
                    $value,
                    $value == $current_value ? ' selected="selected"':'',
                    $label
                );
            }
            ?>
        </select>
        <?php
    }
}

add_filter( 'parse_query', '_scorch_job_company_posts_filter' );
/**
 * if submitted filter by post meta
 *
 * @param  (wp_query object) $query
 *
 * @return Void
 */
function _scorch_job_company_posts_filter( $query ){
    global $pagenow;
    $type = 'jobs';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'jobs' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['company_filter']) && $_GET['company_filter'] != '') {
        $query->query_vars['meta_key'] = 'select_company';
        $query->query_vars['meta_value'] = $_GET['company_filter'];
    }
}


