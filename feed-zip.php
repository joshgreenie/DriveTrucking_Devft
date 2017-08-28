<?php
/**
 * Template Name: Custom RSS Template - Feedname
 */
$postCount = 1000; // The number of posts to show in the feed
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$company = get_query_var( 'company' );
if($company){
    // args
    $listings_args = array(
        'posts_per_page'	=> $postCount,
        'post_type'		=> 'jobs',
        'meta_key'		=> 'select_company',
        'meta_value'	=> $company,
        'paged'         => $paged,
    );

    // query
    $listings = new WP_Query( $listings_args );
}else{
    // args
    $listings_args = array(
        'posts_per_page'	=> $postCount,
        'post_type'		=> 'jobs',
        'paged'         => $paged,
    );
    $listings = new WP_Query( $listings_args );
}
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="UTF-8">';
?>
<source>
    <publisher><?php bloginfo_rss('name'); ?></publisher>
    <publisherurl><?php self_link(); ?></publisherurl>
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
    <?php while($listings->have_posts()) : $listings->the_post();
    $locations			= get_field('location');
    $freight_type		= get_field('freight_type');
    $driver_type		= get_field('driver_type');
    $run_type			= get_field('run_type');
    $enticement_notice	= get_field('enticement_notice');
    $job_description	= get_field('job_description');
    $company            = get_field('company');
    ?>
    <job>
    <title><![CDATA[<?php the_title_rss(); ?>]]></title>
    <date><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></date>
    <referencenumber><![CDATA[<?php the_ID();?>]]></referencenumber>
    <?php
    $locations = get_the_terms( get_the_ID(), 'location' );
    foreach ($locations as $location) :
        if($location->parent == 0):?>
            <state><![CDATA[<?php echo $location->name?>]]></state>
        <?php endif;?>
        <?php if ( $location->parent != 0 ):?>
        <city><![CDATA[<?php echo $location->name;?>]]></city>
    <?php endif;?>
    <?php endforeach; ?>
    <country><![CDATA[US]]></country>
    <description><![CDATA[<?php echo $job_description;?>
        <?php
        // check if the repeater field has rows of data
        if( have_rows('benefits') ):?>
            <strong>Benefits</strong>
            <ul>
                <?php
                // loop through the rows of data
                while ( have_rows('benefits') ) : the_row();?>

                    <li><?php the_sub_field('benefit');?></li>

                <?php endwhile;?>
            </ul>
        <?php endif;?>
        <?php
        // check if the repeater field has rows of data
        if( have_rows('job_requirements') ):?>
            <strong>Job requirements</strong>
            <ul>
                <?php
                // loop through the rows of data
                while ( have_rows('job_requirements') ) : the_row();?>

                    <li><?php the_sub_field('job_requirement');?></li>

                <?php endwhile;?>
            </ul>
        <?php endif;?>]]></description>
    <category><![CDATA[Construction/Skilled Trade]]></category>
    <url><![CDATA[<?php the_permalink_rss(); ?>]]></url>
    <?php if($company === "Associate Company"):?>
        <company ><![CDATA[<?php
            $select_company = get_field('select_company');
            if( $select_company ):
                // override $post
                $post = $select_company;
                setup_postdata( $post );

                $company_name = get_the_title(); ?>
                <?php echo $company_name;?>
                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endif; ?>
            ]]></company>
    <?php endif;?>
    </job><?php endwhile; ?>
</source>