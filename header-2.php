<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _scorch
 */
//Extra Scripts
$header_scripts = get_field('header_scripts', 'option');
$after_body_scripts = get_field('after_body_scripts', 'option');
//Logo
$use_logo = get_field('use_logo', 'option');
$icon_font_html = get_field('icon_font_html', 'option');
$upload_logo = get_field('upload_logo', 'option');
$svg_logo = get_field('svg', 'option');
$adspace = get_field('adspace', 'option');
$login_url = get_field('login_url', 'option');
$login_text = get_field('login_text', 'option');
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
    <?php // if ($header_scripts): echo $header_scripts; endif; ?>
    <?php // get_template_part('template-parts/header/content', 'dfp'); ?>
</head>

<body <?php body_class(); ?>>
<?php /*Put After Body Scripts from settings here.*/ ?>
<?php //if ($after_body_scripts): echo $after_body_scripts; endif; ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', '_scorch'); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <?php /*get_template_part('template-parts/header/sub', 'header')*/ ?>
        <!--        <div id="main-header">-->
        <div id="new-header">
            <div class="top-header">
                <div class="grid-container">
                    <section id="brand" class="site-brand">

                        <?php
                        if (is_tax('location')):

                            $taxonomy = get_query_var('taxonomy');
                            $termId = get_queried_object()->term_id;

                            $phone = get_field('phone', $taxonomy . '_' . $termId);
                            $owner = get_field('owner', $taxonomy . '_' . $termId);
                            $ownerLogo = get_field('association_logo', 'user_'.$owner['ID']);
                            $website_url = get_field('website_url', 'user_'.$owner['ID']);
                            $title = get_the_title();
                            if ($ownerLogo):
                                ?>
                                <div class="company-header state">
                                    <?=$website_url?"<a href='$website_url' target='_blank'>":"";?>
                                    <img src="<?= $ownerLogo['url']; ?>" alt="<?= $title ?> Trucking Association">
                                    <?=$website_url?"</a>":"";?>
                                </div>
                            <?php endif;
                        else:
                            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                            $thumbnail = $thumbnail[0];
                            $title = get_the_title();
                            if ($thumbnail):
                                ?>
                                <div class="company-header">
                                    <img src="<?= $thumbnail['0']; ?>" alt="<?= $title ?>">
                                </div>
                            <?php endif;

                        endif;


                            if ($use_logo == "html"): ?>
                            <h2 class="site-logo"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
                                                     class=""><?php echo $icon_font_html; ?></a></h2>
                        <?php elseif ($use_logo == "upload") : ?>
                            <div class='site-logo'>
                                <a href='<?php echo esc_url(home_url('/')); ?>'
                                   title='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>' rel='home'><img
                                            src='<?php echo $upload_logo['url']; ?>'
                                            alt='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>'></a>
                            </div>
                        <?php elseif ($use_logo == "svg") : ?>
                            <div class='site-logo'>
                                <a href='<?php echo esc_url(home_url('/')); ?>'
                                   title='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>' rel='home'><img
                                            src='<?php echo $svg_logo['url']; ?>' alt=''></a>
                            </div>
                        <?php else: ?>
                            <h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                      rel="home"><?php bloginfo('name'); ?></a></h2>
                            <h3 class="site-description"><?php bloginfo('description'); ?></h3>
                        <?php endif; ?>
                    </section>

                    <?php if ($adspace): ?>
                        <div class="drive-trucking-adspace company-profile">
                            <?= $adspace; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($login_url): ?>
                        <div class="drive-trucking-login">
                            <a href="<?= $login_url; ?>"><?= $login_text; ?></a>
                        </div>
                    <?php endif; ?>
                </div>

            </div>


            <nav id="site-navigation" class="main-navigation close" role="navigation">
                <?php wp_nav_menu(array('menu' => 'new-menu')); ?>
            </nav><!-- #site-navigation -->
        </div>
        <div id="mobile-trigger">
            <div id="hamburgler"><span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
            </div>
        </div>
    </header><!-- #masthead -->
    <?php

    $add_base_flexible_fields = get_field('add_base_flexible_fields');
    if (!$add_base_flexible_fields):
        ?>
    <?php endif; ?>
