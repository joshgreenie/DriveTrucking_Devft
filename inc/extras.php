<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _scorch
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _scorch_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', '_scorch_body_classes' );

//Add Support for SVG Uploads for Media
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/**
 * Remove Admin Sidebar Categories on Jobs Post Types from displaying on Create a Jobs Listing edit page.
 */
function remove_team_member_meta() {
	remove_meta_box( 'driver_typediv', 'jobs', 'side' );
	remove_meta_box( 'freight_typediv', 'jobs', 'side' );
	remove_meta_box( 'run_typesdiv', 'jobs', 'side' );
	remove_meta_box( 'locationdiv', 'jobs', 'side' );
}
add_action( 'admin_menu' , 'remove_team_member_meta' );

/**
 * Grid Switch
 */
function figuregrid($type = 'grid', $count ){
	if($type=='grid'){
		switch ($count) {
			case 1:
				return "one";
				break;
			case 2:
				return "one-half";
				break;
			case 3:
				return "one-third";
				break;
			case 4:
				return "one-fourth";
				break;
			case 5:
				return "one-fifth";
				break;
			case 6:
				return "one-sixth";
				break;
			case 7:
				return "one-seventh";
				break;
			case 8:
				return "one-eighth";
				break;
			case 9:
				return "one-ninth";
				break;
			case 10:
				return "one-tenth";
				break;
		}
	}elseif($type == 'span'){
		switch ($count) {
			case 1:
				return "span-one";
				break;
			case 2:
				return "span-one-half";
				break;
			case 3:
				return "span-one-third";
				break;
			case 4:
				return "span-one-fourth";
				break;
			case 5:
				return "span-one-fifth";
				break;
			case 6:
				return "span-one-sixth";
				break;
			case 7:
				return "span-one-seventh";
				break;
			case 8:
				return "span-one-eighth";
				break;
			case 9:
				return "span-one-ninth";
				break;
			case 10:
				return "span-one-tenth";
				break;
		}
	}
}

/**
 * Get a shorten snippet of words from a string.
 */
function get_snippet( $str, $wordCount = 10 ) {
	return implode(
		'',
		array_slice(
			preg_split(
				'/([\s,\.;\?\!]+)/',
				$str,
				$wordCount*2+1,
				PREG_SPLIT_DELIM_CAPTURE
			),
			0,
			$wordCount*2-1
		)
	);
}


/**
 * Plural or no plural
 *
 * @return string
 *
 * 
 */
function plural( $amount, $singular = '', $plural = 's' ) {
	if ( $amount == 1 )
		return $singular;
	else
		return $plural;
}

function get_id_by_slug($page_slug, $type) {
	$page = get_page_by_path($page_slug, $output = OBJECT, $post_type = $type );
	if ($page) {
		return $page->ID;
	} else {
		return 0;
	}
}

function the_slug($echo=true){
	$slug = basename(get_permalink());
	do_action('before_slug', $slug);
	$slug = apply_filters('slug_filter', $slug);
	if( $echo ) echo $slug;
	do_action('after_slug', $slug);
	return $slug;
}

function add_custom_query_vars_filter($vars) {
	$vars[] = 'feedname';
	return $vars;
}
add_filter( 'query_vars', 'add_custom_query_vars_filter' );

function add_limit_query_vars_filter($vars) {
	$vars[] = 'limit';
	return $vars;
}
add_filter( 'query_vars', 'add_limit_query_vars_filter' );


function slugify($text){
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, '-');

	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;
}

function convert_state($name, $to='name') {
$states = array(
	array('name'=>'Alabama', 'abbr'=>'AL'),
	array('name'=>'Alaska', 'abbr'=>'AK'),
	array('name'=>'Arizona', 'abbr'=>'AZ'),
	array('name'=>'Arkansas', 'abbr'=>'AR'),
	array('name'=>'California', 'abbr'=>'CA'),
	array('name'=>'Colorado', 'abbr'=>'CO'),
	array('name'=>'Connecticut', 'abbr'=>'CT'),
	array('name'=>'Delaware', 'abbr'=>'DE'),
	array('name'=>'Florida', 'abbr'=>'FL'),
	array('name'=>'Georgia', 'abbr'=>'GA'),
	array('name'=>'Hawaii', 'abbr'=>'HI'),
	array('name'=>'Idaho', 'abbr'=>'ID'),
	array('name'=>'Illinois', 'abbr'=>'IL'),
	array('name'=>'Indiana', 'abbr'=>'IN'),
	array('name'=>'Iowa', 'abbr'=>'IA'),
	array('name'=>'Kansas', 'abbr'=>'KS'),
	array('name'=>'Kentucky', 'abbr'=>'KY'),
	array('name'=>'Louisiana', 'abbr'=>'LA'),
	array('name'=>'Maine', 'abbr'=>'ME'),
	array('name'=>'Maryland', 'abbr'=>'MD'),
	array('name'=>'Massachusetts', 'abbr'=>'MA'),
	array('name'=>'Michigan', 'abbr'=>'MI'),
	array('name'=>'Minnesota', 'abbr'=>'MN'),
	array('name'=>'Mississippi', 'abbr'=>'MS'),
	array('name'=>'Missouri', 'abbr'=>'MO'),
	array('name'=>'Montana', 'abbr'=>'MT'),
	array('name'=>'Nebraska', 'abbr'=>'NE'),
	array('name'=>'Nevada', 'abbr'=>'NV'),
	array('name'=>'New Hampshire', 'abbr'=>'NH'),
	array('name'=>'New Jersey', 'abbr'=>'NJ'),
	array('name'=>'New Mexico', 'abbr'=>'NM'),
	array('name'=>'New York', 'abbr'=>'NY'),
	array('name'=>'North Carolina', 'abbr'=>'NC'),
	array('name'=>'North Dakota', 'abbr'=>'ND'),
	array('name'=>'Ohio', 'abbr'=>'OH'),
	array('name'=>'Oklahoma', 'abbr'=>'OK'),
	array('name'=>'Oregon', 'abbr'=>'OR'),
	array('name'=>'Pennsylvania', 'abbr'=>'PA'),
	array('name'=>'Rhode Island', 'abbr'=>'RI'),
	array('name'=>'South Carolina', 'abbr'=>'SC'),
	array('name'=>'South Dakota', 'abbr'=>'SD'),
	array('name'=>'Tennessee', 'abbr'=>'TN'),
	array('name'=>'Texas', 'abbr'=>'TX'),
	array('name'=>'Utah', 'abbr'=>'UT'),
	array('name'=>'Vermont', 'abbr'=>'VT'),
	array('name'=>'Virginia', 'abbr'=>'VA'),
	array('name'=>'Washington', 'abbr'=>'WA'),
	array('name'=>'West Virginia', 'abbr'=>'WV'),
	array('name'=>'Wisconsin', 'abbr'=>'WI'),
	array('name'=>'Wyoming', 'abbr'=>'WY')
);

	$return = false;
	foreach ($states as $state) {
		if ($to == 'name') {
			if (strtolower($state['abbr']) == strtolower($name)){
				$return = $state['name'];
				break;
			}
		} else if ($to == 'abbr') {
			if (strtolower($state['name']) == strtolower($name)){
				$return = strtoupper($state['abbr']);
				break;
			}
		}
	}
	return $return;
}

function set_posts_per_page_for_locations( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_tax( 'location' ) ) {
        $query->set( 'posts_per_page', '-1' );
    }
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_locations' );


function admin_style() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

// Gravity form bits


add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

add_filter( 'gform_enable_password_field', '__return_true' );
