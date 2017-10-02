<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _scorch
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area account-sidebar" role="complementary">
	<?php dynamic_sidebar( 'account' ); ?>
</aside><!-- #secondary -->
