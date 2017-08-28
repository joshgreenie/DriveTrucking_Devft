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

<aside id="secondary" class="widget-area" role="complementary">
	<section id="filter-jobs" class="widget widget_categories">
		<h2 class="widget-title">Filter Jobs by Type</h2>
		<div class="one-half">
			<h3><?php _e('By Driver Type')?></h3>
			<ul>
				<?php
				global $wp_query;
				if (isset($wp_query->query_vars['location'])){
					$selected_location = $wp_query->query_vars['location'];
				}
				$freights = get_categories( array(
					'taxonomy' 		=> 'driver_type',
					'orderby' 		=> 'name',
					'parent'  		=> 0
				) );
				foreach ( $freights as $freight ) :?>
					<li><a href="/jobs/<?php if(!empty($selected_location)):?>location/<?php echo $selected_location.'/'; endif;?>driver_type/<?php echo $freight->slug;?>/"><?php echo $freight->name;?></a></li>
				<?php endforeach; ?>
			</ul>
			<h3><?php _e('By Freight Type')?></h3>
			<ul>
				<?php
				global $wp_query;
				if (isset($wp_query->query_vars['location'])){
					$selected_location = $wp_query->query_vars['location'];
				}
				$freights = get_categories( array(
					'taxonomy' 		=> 'freight_type',
					'orderby' 		=> 'name',
					'parent'  		=> 0
				) );
				foreach ( $freights as $freight ) :?>
					<li><a href="/jobs/<?php if(!empty($selected_location)):?>location/<?php echo $selected_location.'/'; endif;?>freight_type/<?php echo $freight->slug;?>/"><?php echo $freight->name;?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="one-half">
			<h3><?php _e('By Run Type')?></h3>
			<ul>
				<?php
				global $wp_query;
				if (isset($wp_query->query_vars['location'])){
					$selected_location = $wp_query->query_vars['location'];
				}
				$freights = get_categories( array(
					'taxonomy' 		=> 'run_types',
					'orderby' 		=> 'name',
					'parent'  		=> 0
				) );
				foreach ( $freights as $freight ) :?>
					<li><a href="/jobs/<?php if(!empty($selected_location)):?>location/<?php echo $selected_location.'/'; endif;?>run_types/<?php echo $freight->slug;?>/"><?php echo $freight->name;?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<section class="advert">
		<!-- /104636738/top_square_ad -->
		<div id='div-gpt-ad-1463521288188-8'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-8'); });
			</script>
		</div>

		<!-- /104636738/second_square_ad -->
		<div id='div-gpt-ad-1463521288188-6'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-6'); });
			</script>
		</div>

		<!-- /104636738/third_square_ad -->
		<div id='div-gpt-ad-1463521288188-7'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-7'); });
			</script>
		</div>

		<!-- /104636738/button_ad_1 -->
		<div id='div-gpt-ad-1463521288188-0' style='height:125px; width:125px; display: inline-flex;'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-0'); });
			</script>
		</div>

		<!-- /104636738/Button_ad_2 -->
		<div id='div-gpt-ad-1463521288188-1' style='height:125px; width:125px; display: inline-flex;'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-1'); });
			</script>
		</div>

		<!-- /104636738/Button_ad_3 -->
		<div id='div-gpt-ad-1463521288188-2' style='height:125px; width:125px; display: inline-flex;'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-2'); });
			</script>
		</div>

		<!-- /104636738/button_ad_4 -->
		<div id='div-gpt-ad-1463521288188-3' style='height:125px; width:125px; display: inline-flex;'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-3'); });
			</script>
		</div>

		<!-- /104636738/button_ad_5 -->
		<div id='div-gpt-ad-1463521288188-4' style='height:125px; width:125px; display: inline-flex;'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-4'); });
			</script>
		</div>

		<!-- /104636738/button_ad_6 -->
		<div id='div-gpt-ad-1463521288188-5' style='height:125px; width:125px; display: inline-flex;'>
			<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1463521288188-5'); });
			</script>
		</div>

	</section>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
