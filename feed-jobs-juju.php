<?php
/**
 * Template Name: Custom RSS Template - Feedname
 */
$postCount = 100; // The number of posts to show in the feed
$posts = query_posts('post_type=jobs&showposts=' . $postCount);
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>
<positionfeed xmlns="http://www.juju.com/employers/positionfeed-namespace/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.juju.com/employers/positionfeed-namespace/ http://www.juju.com/employers/positionfeed.xsd" version="2006-04">
    <source><?php bloginfo_rss('name'); ?></source>
    <sourceurl><?php self_link(); ?></sourceurl>
    <feeddate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></feeddate>
<?php while(have_posts()) : the_post();
    $locations			= get_field('location');
    $freight_type		= get_field('freight_type');
    $driver_type		= get_field('driver_type');
    $run_type			= get_field('run_type');
    $enticement_notice	= get_field('enticement_notice');
    $job_description	= get_field('job_description');
    ?>
    <job id="<?php the_ID();?>">
        <employer>ExampleCompany</employer>
        <title><![CDATA[<<?php the_title_rss(); ?>]]></title>
        <description><![CDATA[<?php echo $job_description;?>]]></description>
        <postingdate><?php the_date('yyyy-MM-dd', '<![CDATA[', ']]>'); ?></postingdate>
        <joburl><![CDATA[<?php the_permalink_rss(); ?>]]></joburl>
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
            <nation>US</nation>
        </location>
    </job>
<?php endwhile; ?>
</positionfeed>