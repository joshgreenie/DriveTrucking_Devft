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
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>
<jobs>
<?php while($listings->have_posts()) : $listings->the_post();
$locations			= get_field('location');
$freight_type		= get_field('freight_type');
$driver_type		= get_field('driver_type');
$run_type			= get_field('run_type');
$enticement_notice	= get_field('enticement_notice');
$job_description	= get_field('job_description');
?>
    <job>
        <title><?php bloginfo_rss('name'); ?> Job Feed</title>
        <job-board-name><?php bloginfo_rss('name'); ?></job-board-name>
        <job-board-url><?php self_link(); ?></job-board-url>
        <job-code><![CDATA[<?php the_ID();?>]]></job-code>
        <detail-url><![CDATA[<?php the_permalink_rss(); ?>]]></detail-url>
        <apply-url><![CDATA[<?php the_permalink_rss(); ?>]]></apply-url>
        <job-category>Truck Driver</job-category>
        <description>
            <summary>
                <![CDATA[<?php echo $job_description;?>]]>
            </summary>
            <?php
            // check if the repeater field has rows of data
            if( have_rows('job_requirements') ):?>
                <?php
                // loop through the rows of data
                $job_requirements = "";
                while ( have_rows('job_requirements') ) : the_row();?>
                    <?php $job_requirements .= '* '.get_sub_field('job_requirement');?>
                <?php endwhile;?>
                <required-skills><![CDATA[<?php echo $job_requirements;?>]]></required-skills>
            <?php endif;?>
        </description>
        <posted-date><?php the_date('yyyy/MM/dd', '<![CDATA[', ']]>'); ?></posted-date>
        <location>
            <?php if($locations):?>
                <?php $loc_count = count($locations);
                if($loc_count == 1):?>
                    <state><![CDATA[<?php echo $location->name ?>]]></state>
                <?php elseif($loc_count >= 2):?>
                    <?php foreach ($locations as $location):?>
                        <?php if ( $location->parent == 0 ):?>
                            <state><![CDATA[<?php echo $location->name?>]]></state>
                        <?php endif;?>
                        <?php if ( $location->parent != 0 ):?>
                            <city><![CDATA[<?php echo $location->name;?>]]></city>
                        <?php endif;?>
                    <?php endforeach;?>
                <?php endif; ?>
            <?php endif;?>
            <country>US</country>
        </location>
        <company>
            <name>Test Company</name>
            <?php /*<description><![CDATA[We run a virtual environment . As a result, some of our employers work remotely .]]></description >
             <industry > Manufacturing</industry >
             <url > http://www.samplejobboardurl.com</url>*/ ?>
        </company>
    </job>
<?php endwhile; ?>
</jobs>
