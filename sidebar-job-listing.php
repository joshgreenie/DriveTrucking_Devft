<?php
/**
 * The sidebar for job listing single pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _scorch
 */
?>
<?php

$select_company = get_field('select_company');
if(is_page('company-jobs')){
	$company_slug = get_query_var('company-name');
	$cid = get_id_by_slug($company_slug,'company');
}
if( $select_company || $cid ) {
	if($cid){
		$select_company = $cid;
	}
	// override $post
	$post = $select_company;
	setup_postdata($post);

	include 'template-parts/sidebar/select-company.php';

	wp_reset_postdata();

}else{

	include 'template-parts/sidebar/select-company.php';

}

