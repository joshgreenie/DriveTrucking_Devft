<?php
/**
 * Template Name: Custom RSS Template - Feedname
 *
 * @query_vars:
 *      company: Pass the ID of the company you would like to filter job posting.
 *      feedname: pass the name of the feed
 *          options: blank (Indeed)
 *                  jobs2careers
 *                  oodle
 *                  zip
 *                  trovit
 *                  jooble
 *
 */
$postCount      = 5000; // The number of posts to show in the feed
$limit          = get_query_var('limit');
$paged          = (get_query_var('paged')) ? get_query_var('paged') : 1;
$company        = get_query_var( 'company' );
$feed           = get_query_var('feedname');


//Check if company is set
if($company){
    // args
    if($limit){
        $postCount = $limit;
    }
    if($feed === 'jobsintrucks') {
        $listings_args = array(
            'posts_per_page' => $postCount,
            'post_type'      => 'jobs',
            'paged'          => $paged,
            'orderby'        => 'date',
            //Set the meta query
            'meta_query'     => array(
                //comparison between the inner meta fields conditionals
                'relation' => 'AND',
                //meta field condition one
                array(
                    'key'     => 'select_company',
                    'value'   => $company,
                    'compare' => '=',
                ),
                //meta field condition one
                array(
                    'key'     => 'sponsor_on_jobs_and_trucks',
                    'value'   => 1,
                    'compare' => '=='
                )
            ),
        );
    }elseif($feed === 'trucks'){
        $listings_args = array(
            'posts_per_page'	=> $postCount,
            'post_type'		=> 'jobs',
            'paged'         => $paged,
            'orderby' => 'date',
            //Set the meta query
            'meta_query'       => array(
                //comparison between the inner meta fields conditionals
                'relation'    => 'AND',
                //meta field condition one
                array(
                    'key'          => 'select_company',
                    'value'        => $company,
                    'compare'      => '=',
                ),
                //meta field condition one
                array(
                    'key'          => 'show_in_all_trucks_jobs_feed',
                    'value'        => 1,
                    'compare'      => '=='
                )
            ),
        );
    }elseif($feed === 'jobs2careers'){
        $listings_args = array(
            'posts_per_page'	=> $postCount,
            'post_type'		=> 'jobs',
            'paged'         => $paged,
            'orderby' => 'date',
            //Set the meta query
            'meta_query'       => array(
                //comparison between the inner meta fields conditionals
                'relation'    => 'AND',
                //meta field condition one
                array(
                    'key'          => 'select_company',
                    'value'        => $company,
                    'compare'      => '=',
                ),
                //meta field condition one
                array(
                    'key'          => 'job2career_sponsored_job',
                    'value'        => 1,
                    'compare'      => '=='
                )
            ),
        );
    }elseif($feed === 'indeed'){
        $listings_args = array(
            'posts_per_page'	=> $postCount,
            'post_type'		=> 'jobs',
            'paged'         => $paged,
            'orderby' => 'date',
            //Set the meta query
            'meta_query'       => array(
                //comparison between the inner meta fields conditionals
                'relation'    => 'AND',
                //meta field condition one
                array(
                    'key'          => 'select_company',
                    'value'        => $company,
                    'compare'      => '=',
                ),
                //meta field condition one
                array(
                    'key'          => 'indeed_xml',
                    'value'        => 1,
                    'compare'      => '=='
                )
            ),
        );
    }else{
        $listings_args = array(
            'posts_per_page'	=> $postCount,
            'post_type'		=> 'jobs',
            'paged'         => $paged,
            'orderby' => 'date',
            //Set the meta query
            'meta_query'       => array(
                //comparison between the inner meta fields conditionals
                'relation'    => 'AND',
                //meta field condition one
                array(
                    'key'          => 'select_company',
                    'value'        => $company,
                    'compare'      => '=',
                ),
                //meta field condition one
                array(
                    'key'          => 'job_status',
                    'value'        => 'active',
                    'compare'      => '=='
                )
            ),
        );
    }

    // query
    $listings = new WP_Query( $listings_args );
}else{
    if($limit){
        $postCount = $limit;
    }
    // args
    $listings_args = array(
        'posts_per_page'	=> $postCount,
        'post_type'		=> 'jobs',
        'paged'         => $paged,
        'orderby' => 'date',
        'meta_query'       => array(
            //meta field condition one
            array(
                'key'          => 'job_status',
                'value'        => 'active',
                'compare'      => '=='
            )
        ),
    );
    $listings = new WP_Query( $listings_args );
}
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
if($feed == ''):
?>
<source>
<count><?php echo $listings->post_count;?></count>
<publisher><?php bloginfo_rss('name'); ?></publisher>
<publisherurl><?php self_link(); ?></publisherurl>
<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>

<?php while($listings->have_posts()) : $listings->the_post();
$locations			        = get_field('location');
$freight_type		        = get_field('freight_type');
$driver_type		        = get_field('driver_type');
$run_type			        = get_field('run_type');
$enticement_notice	        = get_field('enticement_notice');
$job_description	        = get_field('job_description');
$company                    = get_field('company');
$sponsor_on_indeed          = get_field('sponsor_on_indeed');
$job_status                 = get_field('job_status');
//Check if the job is active if active display in the feed, if not, exclude from feed.
if( $job_status != 'inactive'):
?>
<job>
    <title><![CDATA[<?php the_title_rss(); ?>]]></title>
    <?php if($sponsor_on_indeed == 'true'):?><ind>1</ind><?php endif;?>
    <date><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></date>
    <referencenumber><![CDATA[<?php the_ID();?>]]></referencenumber>
    <url><![CDATA[<?php the_permalink_rss(); ?>]]></url>
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
    <description><![CDATA[
        <?php echo wp_strip_all_tags($job_description);?>
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
        <?php endif;?>
        ]]></description>
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
</job>
    <?php endif;?>
<?php endwhile; ?>
</source>
<?php elseif($feed == 'jobsintrucks'):?>
 <JOBS>
     <count><?php echo $listings->post_count;?></count>
    <publisher><?php bloginfo_rss('name'); ?></publisher>
    <publisherurl><?php self_link(); ?></publisherurl>
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
    <?php while($listings->have_posts()) : $listings->the_post();
        $locations			        = get_field('location');
        $enticement_notice	        = get_field('enticement_notice');
        $job_description	        = get_field('job_description');
        $company                    = get_field('company');
        $sponsor_on_indeed          = get_field('sponsor_on_indeed');
        $job_status                 = get_field('job_status');
        $sponsor_on_jobs_and_trucks = get_field('sponsor_on_jobs_and_trucks');
        //Check if the job is active if active display in the feed, if not, exclude from feed.
        if( $job_status != 'inactive' && $sponsor_on_jobs_and_trucks == 'Yes'): ?>
            <JOB>
                <JobTitle><![CDATA[<?php the_title_rss(); ?>]]></JobTitle>
                <JobDate><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></JobDate>
                <JobID><![CDATA[<?php the_ID();?>]]></JobID>
                <?php
                $locations = get_the_terms( get_the_ID(), 'location' );
                foreach ($locations as $location) :
                    if($location->parent == 0):?>
                        <JobState><![CDATA[<?php echo convert_state($location->name,'abbr');?>]]></JobState>
                    <?php endif;?>
                    <?php if ( $location->parent != 0 ):?>
                    <JobCity><![CDATA[<?php echo $location->name;?>]]></JobCity>
                <?php endif;?>
                <?php endforeach; ?>
                <JobCountry><![CDATA[US]]></JobCountry>
                <JobDescription><![CDATA[<?php echo $job_description;?>
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
                    <?php endif;?>]]></JobDescription>
                <JobUrl><![CDATA[<?php the_permalink_rss(); ?>]]></JobUrl>
                <?php if($company === "Associate Company"):?>
                    <JobCompany ><![CDATA[<?php
                        $select_company = get_field('select_company');
                        if( $select_company ):
                            // override $post
                            $post = $select_company;
                            setup_postdata( $post );

                            $company_name = get_the_title(); ?>
                            <?php echo $company_name;?>
                            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                        <?php endif; ?>
                        ]]></JobCompany>
                <?php endif;?>
            </JOB>
        <?php endif;?>
    <?php endwhile; ?>
</JOBS>
<?php elseif($feed == 'drivernetwork'):?>
<jobPosts>
    <count><?php echo $listings->post_count;?></count>
    <?php while($listings->have_posts()) : $listings->the_post();
        $locations			        = get_field('location');
        $enticement_notice	        = get_field('enticement_notice');
        $job_description	        = get_field('job_description');
        $job_status                 = get_field('job_status');
        //Check if the job is active if active display in the feed, if not, exclude from feed.
        ?>
            <post>
                <adiitionalInfo>
                    <salary>
                        <from null="true" />
                        <to null="true" />
                    </salary>
                    <licenseTypes>
                        <element>A</element>
                    </licenseTypes>
                <?php
                // check if the repeater field has rows of data
                    if( have_rows('benefits') ):?>
                    <benefits>
                        <?php
                        // loop through the rows of data
                        while ( have_rows('benefits') ) : the_row();?>

                        <element><![CDATA[<?php the_sub_field('benefit');?>]]></element>

                        <?php endwhile;?>
                    </benefits>
                    <?php endif;?>
                    <?php
                    // check if the repeater field has rows of data
                    if( have_rows('job_requirements') ):?>
                    <experience>
                        <?php
                        // loop through the rows of data
                        while ( have_rows('job_requirements') ) : the_row();?>

                            <element><![CDATA[<?php the_sub_field('job_requirement');?>]]></element>

                        <?php endwhile;?>
                    </experience>
                    <?php endif;?>
                </adiitionalInfo>

                <hiringCriteria>
                     <?php
                    $drivertypes = get_the_terms( get_the_ID(), 'driver_type' );?>
                    <?php if($drivertypes):?>
                    <driverTypes>
                    <?php foreach ($drivertypes as $drivertype) :?>
                        <?php if ($drivertype->name == 'Company') {?>
                            <element><?php echo 'Company Driver'; ?></element>
                        <?php }else{ ?>
                            <element><?php echo $drivertype->name; ?></element>
                        <?php }?>
                    <?php endforeach;?>
                    </driverTypes>
                    <?php endif;?>
                    <?php if( have_rows('endorsements') ):?>
                    <endorsements>
                    <?php while ( have_rows('endorsements') ) : the_row();?>
                        <element><![CDATA[<?php the_sub_field('endorsement');?>]]></element>
                        <?php endwhile;?>
                    </endorsements>
                    <?php endif; ?>
                    <freightTypes>
                    <?php
                    $freight_types = get_the_terms( get_the_ID(), 'freight_type' );
                    foreach ($freight_types as $freight_type):?>
                        <element><?php echo $freight_type->name; ?></element>
                    <?php endforeach;?>
                    </freightTypes>
                    <licenseTypes>
                        <element>A</element>
                    </licenseTypes>
                    <?php $min_age = get_field('$min_age');
                    if($min_age): ?>
                    <minimunAge><?php get_field('min_age'); ?></minimunAge>
                    <?php endif; ?>
                </hiringCriteria>
                <mainInfo>
                    <title><![CDATA[<?php the_title_rss(); ?>]]></title>
                    <description><![CDATA[<?php echo wp_strip_all_tags($job_description);?>]]></description>
                    <externalURL><?php the_permalink_rss(); ?></externalURL>

                    <?php
                    $locations = get_the_terms( get_the_ID(), 'location' );
                    foreach ($locations as $location) :
                        if($location->parent == 0):?>
                            <targetStates>
                                <state><![CDATA[<?php echo convert_state($location->name,'abbr');?>]]></state>
                            </targetStates>
                        <?php endif;?>
                        <?php if ( $location->parent != 0 ):?>
                        <targetCities>
                            <city><![CDATA[<?php echo $location->name;?>]]></city>
                        </targetCities>
                    <?php endif;?>
                    <?php endforeach; ?>
                    <?php
                    if( $company ):
                        // override $post
                        $post = $company;
                        setup_postdata( $post );

                        $company_phone = get_field('phone'); ?>
                        <phone><?php echo $company_phone;?></phone>
                        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                    <?php endif; ?>
                </mainInfo>
            </post>
    <?php endwhile; ?>
</jobPosts>
<?php elseif($feed == 'trucks'):?>
<source>
    <count><?php echo $listings->post_count;?></count>
    <?php while($listings->have_posts()) : $listings->the_post();
        $locations			        = get_field('location');
        $enticement_notice	        = get_field('enticement_notice');
        $job_description	        = get_field('job_description');
        $company                    = get_field('company');
        $sponsor_on_indeed          = get_field('sponsor_on_indeed');
        $job_status                 = get_field('job_status');
        //Check if the job is active if active display in the feed, if not, exclude from feed.
        if( $job_status != 'inactive'): ?>
            <job>
                <title><![CDATA[<?php the_title_rss(); ?>]]></title>
                <date><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></date>
                <referencenumber><![CDATA[<?php the_ID();?>]]></referencenumber>
                <url><![CDATA[<?php the_permalink_rss(); ?>]]></url>
                <?php
                $locations = get_the_terms( get_the_ID(), 'location' );
                foreach ($locations as $location) :
                    if($location->parent == 0):?>
                        <state><![CDATA[<?php echo convert_state($location->name,'abbr');?>]]></state>
                    <?php endif;?>
                    <?php if ( $location->parent != 0 ):?>
                    <city><![CDATA[<?php echo $location->name;?>]]></city>
                <?php endif;?>
                <?php endforeach; ?>
                <country><![CDATA[US]]></country>
                <freighttype><![CDATA[<?php
                    $freight_types = get_the_terms( get_the_ID(), 'freight_type' );
                    foreach ($freight_types as $freight_type):?>
                       <?php echo $freight_type->name; ?>
                    <?php endforeach;?>]]></freighttype>
                <drivertype><![CDATA[<?php
                    $drivertypes = get_the_terms( get_the_ID(), 'driver_type' );
                    foreach ($drivertypes as $drivertype) :?>
                        <?php if ($drivertype->name == 'Company') {
                            echo 'Company Driver';
                        }elseif($drivertype->name == 'Team'){
                            echo 'Company Driver Team';
                        }else{
                            echo $drivertype->name;
                        }?>
                    <?php endforeach;?>]]></drivertype>
                <requirements><![CDATA[<?php
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
                    <?php endif;?>]]></requirements>
                <description><![CDATA[
                    <?php echo wp_strip_all_tags($job_description);?>
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
                    ]]></description>
            </job>
        <?php endif;?>
    <?php endwhile; ?>
</source>
<?php elseif($feed == 'findatrucker'):?>
<source>
<count><?php echo $listings->post_count;?></count>
<?php while($listings->have_posts()) : $listings->the_post();
    $locations			        = get_field('location');
    $enticement_notice	        = get_field('enticement_notice');
    $job_description	        = get_field('job_description');
    $company                    = get_field('company');
    $sponsor_on_indeed          = get_field('sponsor_on_indeed');
    $job_status                 = get_field('job_status');
    //Check if the job is active if active display in the feed, if not, exclude from feed.
    if( $job_status != 'inactive'): ?>
        <job>
            <title><![CDATA[<?php the_title_rss(); ?>]]></title>
            <posted_on><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></posted_on>
            <reference_id><![CDATA[<?php the_ID();?>]]></reference_id>
            <apply_url><![CDATA[<?php the_permalink_rss(); ?>]]></apply_url>
            <?php
            $locations = get_the_terms( get_the_ID(), 'location' );
            foreach ($locations as $location) :
                if($location->parent == 0):?>
                    <state><![CDATA[<?php echo convert_state($location->name,'abbr');?>]]></state>
                <?php endif;?>
                <?php if ( $location->parent != 0 ):?>
                <city><![CDATA[<?php echo $location->name;?>]]></city>
            <?php endif;?>
            <?php endforeach; ?>
            <description><![CDATA[
                <?php echo wp_strip_all_tags($job_description);?>
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
                ]]></description>
        </job>
    <?php endif;?>
<?php endwhile; ?>
</source>
<?php elseif($feed == 'classadrivers'):?>
<FeedData>
    <count><?php echo $listings->post_count;?></count>
    <publisher><?php bloginfo_rss('name'); ?></publisher>
    <publisherurl><?php self_link(); ?></publisherurl>
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
    <CompanyName><?php
        if( $company ):
            // override $post
            $post = $company;
            setup_postdata( $post );

            $company_name = get_the_title(); ?>
            <?php echo $company_name;?>
            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        <?php endif; ?>
    </CompanyName>
    <Jobs>
    <?php while($listings->have_posts()) : $listings->the_post();
        $locations			        = get_field('location');
        $freight_type		        = get_field('freight_type');
        $driver_type		        = get_field('driver_type');
        $run_type			        = get_field('run_type');
        $enticement_notice	        = get_field('enticement_notice');
        $job_description	        = get_field('job_description');
        $company                    = get_field('company');
        $years_of_experience        = get_field('years_of_experience');
        $sponsor_on_indeed          = get_field('sponsor_on_indeed');
        $job_status                 = get_field('job_status');
        $job2career_sponsored_job   = get_field('job2career_sponsored_job');
        $sponsor_job_cpc            = get_field('sponsor_job_cpc');
        $select_company             = get_field('select_company');
        $drivertypes                = get_the_terms( get_the_ID(), 'driver_type' );
        //Check if the job is active if active display in the feed, if not, exclude from feed.
        if( $job_status != 'inactive'):
            ?>
            <Job>
                <JobTitle><![CDATA[<?php the_title(); ?>]]></JobTitle>
                <FeedJobID><![CDATA[<?php the_ID();?>]]></FeedJobID>
                <JobURL><![CDATA[<?php the_permalink(); ?>]]></JobURL>
                <?php
                $locations = get_the_terms( get_the_ID(), 'location' );
                foreach ($locations as $location) :
                    if($location->parent == 0):?>
                        <states><![CDATA[<?php echo $location->name?>]]></states>
                    <?php endif;?>
                <?php endforeach; ?>
                <Description><![CDATA[
                    <?php echo wp_strip_all_tags($job_description);?>
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
                    <?php endif;?>
                    ]]></Description>
                <?php if( !empty($sponsor_job_cpc) && $job2career_sponsored_job == 'true'):?>
                    <cpc><?php echo $sponsor_job_cpc;?></cpc>
                <?php endif;?>
                <OTRExperience><![CDATA[<?php
                    if($select_company == 178){
                        echo '6';
                    }else{
                        echo '12';
                    }
                ?>]]></OTRExperience>
                <EmploymentType>Company Driver Van</EmploymentType>
            </Job>
        <?php endif;?>
    <?php endwhile; ?>

    </Jobs>
</FeedData>
<?php elseif($feed == 'indeed'):?>
    <source>
    <count><?php echo $listings->post_count;?></count>
    <publisher><?php bloginfo_rss('name'); ?></publisher>
    <publisherurl><?php self_link(); ?></publisherurl>
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>

    <?php while($listings->have_posts()) : $listings->the_post();
        $locations			        = get_field('location');
        $freight_type		        = get_field('freight_type');
        $driver_type		        = get_field('driver_type');
        $run_type			        = get_field('run_type');
        $enticement_notice	        = get_field('enticement_notice');
        $job_description	        = get_field('job_description');
        $company                    = get_field('company');
        $years_of_experience        = get_field('years_of_experience');
        $sponsor_on_indeed          = get_field('sponsor_on_indeed');
        $sponsor_job_cpc            = get_field('sponsor_job_cpc');
        ?>
        <job>
            <title><![CDATA[<?php the_title_rss(); ?>]]></title>
            <?php if($sponsor_on_indeed == 'true'):?><ind>1</ind><?php endif;?>
            <date><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></date>
            <referencenumber><![CDATA[<?php the_ID();?>]]></referencenumber>
            <status><![CDATA[<?php echo $job_status;?>]]></status>
            <url><![CDATA[<?php the_permalink_rss(); ?>]]></url>
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
            <description><![CDATA[
                <?php echo wp_strip_all_tags($job_description);?>
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
                <?php endif;?>
                ]]></description>
            <experience><![CDATA[<?php echo $years_of_experience;?>]]></experience>
            <jobtype><![CDATA[Full Time]]></jobtype>
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
        </job>
    <?php endwhile; ?>
</source>
<?php elseif($feed == 'jobs2careers'):?>
<source>
    <count><?php echo $listings->post_count;?></count>
    <publisher><?php bloginfo_rss('name'); ?></publisher>
    <publisherurl><?php self_link(); ?></publisherurl>
    <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>

    <?php while($listings->have_posts()) : $listings->the_post();
        $locations			        = get_field('location');
        $freight_type		        = get_field('freight_type');
        $driver_type		        = get_field('driver_type');
        $run_type			        = get_field('run_type');
        $enticement_notice	        = get_field('enticement_notice');
        $job_description	        = get_field('job_description');
        $company                    = get_field('company');
        $years_of_experience        = get_field('years_of_experience');
        $sponsor_on_indeed          = get_field('sponsor_on_indeed');
        $sponsor_job_cpc            = get_field('sponsor_job_cpc');
        //Check if the job is active if active display in the feed, if not, exclude from feed.
            ?>
            <job>
                <title><![CDATA[<?php the_title_rss(); ?>]]></title>
                <date><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></date>
                <referencenumber><![CDATA[<?php the_ID();?>]]></referencenumber>
                <status><![CDATA[<?php echo $job_status;?>]]></status>
                <url><![CDATA[<?php the_permalink_rss(); ?>]]></url>
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
                <description><![CDATA[
                    <?php echo wp_strip_all_tags($job_description);?>
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
                    <?php endif;?>
                    ]]></description>
                <experience><![CDATA[<?php echo $years_of_experience;?>]]></experience>
                <jobtype><![CDATA[Full Time]]></jobtype>
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
            </job>
    <?php endwhile; ?>
    </source>
<?php elseif($feed == 'oodle'):?>
<listings><?php while($listings->have_posts()) : $listings->the_post();
        $locations			= get_field('location');
        $freight_type		= get_field('freight_type');
        $driver_type		= get_field('driver_type');
        $run_type			= get_field('run_type');
        $enticement_notice	= get_field('enticement_notice');
        $job_description	= get_field('job_description');
        $company            = get_field('company');
        $job_status                 = get_field('job_status');

        if( $job_status != 'inactive'):
        ?>
        <count><?php echo $listings->post_count;?></count>
        <listing>
            <seller_name><?php bloginfo_rss('name'); ?></seller_name>
            <seller_url><?php self_link(); ?></seller_url>
            <category><![CDATA[Transportation, Travel & Logistics Jobs]]></category>
            <title><![CDATA[<?php the_title_rss(); ?>]]></title>
            <create_time><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></create_time>
            <id><![CDATA[<?php the_ID();?>]]></id>
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
            <industry><![CDATA[trucking]]></industry>
            <description><![CDATA[<?php echo $job_description;?>]]></description>
            <?php
            // check if the repeater field has rows of data
            if( have_rows('benefits') ):?>
            <benefits><![CDATA[<?php
                // loop through the rows of data
                while ( have_rows('benefits') ) : the_row();?>
                    <?php the_sub_field('benefit');?><?php echo '|';?>
                <?php endwhile;?>]]></benefits>
            <?php endif;?>
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
        </listing>
        <?php endif;?>
    <?php endwhile; ?>
</listings>
<?php elseif($feed == 'zip'):?>
    <source>
    <count><?php echo $listings->post_count;?></count>
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
            <email>trucking@firetoss.com</email>
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
        </job>
    <?php endwhile; ?>
    </source>
<?php elseif($feed == 'topusajobs'):?>
    <JOBS>
    <count><?php echo $listings->post_count;?></count>
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
        <JOB>
        <JobTitle><![CDATA[<?php the_title_rss(); ?>]]></JobTitle>
        <JobDate><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></JobDate>
        <JobID><![CDATA[<?php the_ID();?>]]></JobID>
        <?php
        $locations = get_the_terms( get_the_ID(), 'location' );
        foreach ($locations as $location) :
            if($location->parent == 0):?>
                <JobState><![CDATA[<?php echo convert_state($location->name,'abbr');?>]]></JobState>
            <?php endif;?>
            <?php if ( $location->parent != 0 ):?>
            <JobCity><![CDATA[<?php echo $location->name;?>]]></JobCity>
        <?php endif;?>
        <?php endforeach; ?>
        <JobCountry><![CDATA[US]]></JobCountry>
        <JobDescription><![CDATA[<?php echo $job_description;?>
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
            <?php endif;?>]]></JobDescription>
            <JobUrl><![CDATA[<?php the_permalink_rss(); ?>]]></JobUrl>
        <?php if($company === "Associate Company"):?>
            <JobCompany ><![CDATA[<?php
                $select_company = get_field('select_company');
                if( $select_company ):
                    // override $post
                    $post = $select_company;
                    setup_postdata( $post );

                    $company_name = get_the_title(); ?>
                    <?php echo $company_name;?>
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                <?php endif; ?>
                ]]></JobCompany>
        <?php endif;?>
        </JOB>
    <?php endwhile; ?>
    </JOBS>
<?php elseif($feed == 'trovit'):?>
    <trovit>
    <?php while($listings->have_posts()) : $listings->the_post();
        $locations			= get_field('location');
        $freight_type		= get_field('freight_type');
        $driver_type		= get_field('driver_type');
        $run_type			= get_field('run_type');
        $enticement_notice	= get_field('enticement_notice');
        $job_description	= get_field('job_description');
        $company            = get_field('company');
        $years_of_experience= get_field('years_of_experience');
        $salary_range       = get_field('salary_range');
        $job_type           = get_field('job_type');
        ?>
        <ad>
            <id><![CDATA[<?php the_ID();?>]]></id>
            <url><![CDATA[<?php the_permalink_rss(); ?>]]></url>
            <mobile_url><![CDATA[<?php the_permalink_rss(); ?>]]></mobile_url>
            <title><![CDATA[<?php bloginfo_rss('name'); ?>]]></title>
            <content><![CDATA[
                <?php echo wp_strip_all_tags($job_description);?>
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
                <?php endif;?>]]></content>
            <?php
            // check if the repeater field has rows of data
            if( have_rows('job_requirements') ):?>

                <requirements><![CDATA[
                    <ul>
                    <?php
                    // loop through the rows of data
                    while ( have_rows('job_requirements') ) : the_row();?>

                        <li><?php the_sub_field('job_requirement');?></li>

                    <?php endwhile;?>
                    </ul>]]>
                </requirements>
            <?php endif;?>
            <experience><![CDATA[<?php echo $years_of_experience;?>]]></experience>
            <category><![CDATA[Trucking]]></category>
            <working_hours><![CDATA[<?php echo $job_type;?>]]></working_hours>
            <?php if(!empty($salary_range)):?><salary><![CDATA[<?php echo $salary_range;?>]]></salary><?php endif;?>
            <?php
            $locations = get_the_terms( get_the_ID(), 'location' );
            foreach ($locations as $location) :
                if($location->parent == 0):?>
                    <region><![CDATA[<?php echo $location->name?>]]></region>
                <?php endif;?>
                <?php if ( $location->parent != 0 ):?>
                <city><![CDATA[<?php echo $location->name;?>]]></city>
            <?php endif;?>
            <?php endforeach; ?>
            <date><![CDATA[<?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?>]]></date>
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
        </ad>
    <?php endwhile; ?>
    </trovit>
<?php elseif($feed == 'jooble'):?>
<jobs>
    <count><?php echo $listings->post_count;?></count>
    <publisher><?php bloginfo_rss('name'); ?></publisher>
    <publisherurl><?php self_link(); ?></publisherurl>
    <?php while($listings->have_posts()) : $listings->the_post();
        $locations			= get_field('location');
        $freight_type		= get_field('freight_type');
        $driver_type		= get_field('driver_type');
        $run_type			= get_field('run_type');
        $enticement_notice	= get_field('enticement_notice');
        $job_description	= get_field('job_description');
        $company            = get_field('company');
        $sponsor_on_indeed  = get_field('sponsor_on_indeed');
        ?>
        <job id="<?php the_ID();?>">
            <name><![CDATA[<?php the_title_rss(); ?>]]></name>
            <pubdate><![CDATA[<?php echo get_post_time('d.m.Y'); ?>]]></pubdate>
            <updated><![CDATA[<?php the_modified_date('d.m.Y'); ?>]]></updated>
            <link><![CDATA[<?php the_permalink_rss(); ?>]]></link>
            <region><![CDATA[
                <?php
                $locations = get_the_terms( get_the_ID(), 'location' );
                foreach ($locations as $location) :?>
                    <?php if ( $location->parent != 0 ):?>
                        <?php echo $location->name;?>,
                    <?php endif;?>
                    <?php if($location->parent == 0):?>
                        <?php echo $location->name?>
                    <?php endif;?>
                <?php endforeach; ?>
                ]]></region>
            <jobtype><![CDATA[Full-Time]]></jobtype>
            <country><![CDATA[US]]></country>
            <description><![CDATA[
                <?php echo wp_strip_all_tags($job_description);?>
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
                <?php endif;?>
                ]]></description>
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
        </job>
    <?php endwhile; ?>
</jobs>
<?php endif ?>