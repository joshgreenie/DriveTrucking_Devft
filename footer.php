<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _scorch
 */

?>

<?php

$add_base_flexible_fields = get_field('add_base_flexible_fields');
if(!$add_base_flexible_fields && !is_tax('location')  && !is_page_template('page-login-template.php')):
?>
    </div><!-- #content -->
    <?php endif;?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="footer-links">
		<?php
		if(is_active_sidebar('footer-1')){
			dynamic_sidebar('footer-1');
		}
		if(is_active_sidebar('footer-2')){
			dynamic_sidebar('footer-2');
		}
		if(is_active_sidebar('footer-3')){
			dynamic_sidebar('footer-3');
		}
		if(is_active_sidebar('footer-4')){
			dynamic_sidebar('footer-4');
		}
		if(is_active_sidebar('footer-5')){
			dynamic_sidebar('footer-5');
		}
		?>
	</div>
	<div class="footer-links">
		<div class="site-info">
		<?php echo '<span>'; printf( __( '&copy; Copyright  %1$s %2$s  %3$s', 'dot' ), date("Y"), bloginfo('name').' |  All rights reserved.', '<a href="/terms-conditions/">Terms and Conditions</a> | <a href="/privacy-policy/">Privacy Policy</a></span><span><a href="http://driveteks.com">Truck Driver Recruiting</a> by DriveTeks - a division of <a href="http://firetoss.com">Firetoss</a></span>' ); ?>
		</div>
			<?php if( have_rows('social_links', 'option') ): ?>
		<div class="social">
				<?php while( have_rows('social_links', 'option') ): the_row(); ?>
					<a href="<?php the_sub_field('social_link')?>" <?php if(get_sub_field('social_icon')=="gplus"):?>rel="publisher"<?php endif;?>><span class="icon-<?php the_sub_field('social_icon')?>"></span></a>
				<?php endwhile; ?>

		</div><!-- .social -->
			<?php endif; ?>
	</div>
	<?php echo get_field('footer_message', 'option');?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
