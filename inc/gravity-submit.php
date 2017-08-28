<?php
add_action( 'gform_after_submission_1', 'post_to_third_party', 10, 2 );
function post_to_third_party( $entry, $form ){

    $first_name         = rgar($entry, '3.3');
    $last_name          = rgar($entry, '3.6');
    $email              = rgar($entry, '4');
    $phone              = rgar($entry, '5');
    $state              = rgar($entry, '8');
    $city               = rgar($entry, '12');
    $zip                = rgar($entry, '9');
    $cdl                = rgar($entry, '1');
    $experience         = rgar($entry, '2');
    $company            = rgar($entry, '7');
    $tid                = rgar($entry, '10');
    $entryid            = rgar($entry, 'id');
    $job_title          = rgar($entry, '13');
    $job_location       = rgar($entry, '14');
    $source             = 'Firetoss';
    $utm_source         = rgar($entry, '16');
    $moving_violations  = rgar($entry, '17');
    $accidents          = rgar($entry, '18');
    $best_reach         = rgar($entry, '23');
    $phone_type         = rgar($entry, '20');
    // Set Affilate ID
    $afid = '406574';
    if($tid == '' || empty($tid)){
        $tid = '007';
    }

        if ($utm_source == 'Indeed' || $utm_source == 'indeed'|| $utm_source == 'indeed.com') {
       	    if($company == 'Cox Trucking'){
                $campaignID = '371800';
            }else{
                $campaignID = '333797';
            }
        } elseif ($utm_source == 'AndrusIndeed_CPC') {
            $campaignID = '373609';
        } elseif ($utm_source == 'Truck Driving Jobs' || $utm_source == 'Truck%20Driving%20Jobs' ) {
           $campaignID = '338578';
        } elseif ($utm_source == 'Jobs In Trucks' || $utm_source == 'Jobs In Trucks' || $utm_source == 'JobsInTrucks') {
           $campaignID = '337146';
        } elseif ($utm_source == 'Top USA Jobs' || $utm_source == 'Top%20USA%20Jobs') {
           $campaignID = '337145';
        } elseif ($utm_source == 'Jobs2Careers' || $utm_source == 'jobs2careers') {
            $campaignID = '333767';
        } elseif ($utm_source == 'ClassADrivers' || $utm_source == 'Class A Drivers' || $utm_source == 'Class%20A%20Drivers' || $utm_source == 'classadrivers' ) {
            $campaignID = '337394';
        } elseif ($utm_source == 'Craigslist' ) {
            $campaignID = '354368';
        } elseif ($utm_source == 'Facebook' ) {
	       $campaignID = '356527';
        } else {
            $campaignID = '333799';
        }
        $xml =
        "<lead>"
           ."<AFID>".$afid."</AFID>"
           ."<FirstName>".$first_name."</FirstName>"
           ."<LastName>".$last_name."</LastName>"
           ."<email>".$email."</email>"
           ."<phone>".$phone."</phone>"
           ."<city>".$city."</city>"
           ."<state>".$state."</state>"
           ."<zip>".$zip."</zip>"
           ."<cdl>".$cdl."</cdl>"
           ."<driver_type>".$cdl."</driver_type>"
           ."<experience>".$experience."</experience>"
           ."<tid>".$tid."</tid>"
           ."<company>".$company."</company>"
           ."<jobLocation>".$job_location."</jobLocation>"
           ."<MovingViolations>".$moving_violations."</MovingViolations>"
           ."<accidents>".$accidents."</accidents>"
           ."<best_way_to_contact>".$best_reach."</best_way_to_contact>"
           ."<phone_type>".$phone_type."</phone_type>"
           ."<job_title>".$job_title."</job_title>"
        ."</lead>";
        $linktrust = curl_init();
        curl_setopt($linktrust, CURLOPT_URL, 'http://FireToss.linktrustleadgen.com/Lead/'.$campaignID.'/SimplePost');
        curl_setopt($linktrust, CURLOPT_VERBOSE, 1);
        curl_setopt($linktrust, CURLOPT_RETURNTRANSFER, 1); // return into a variable
        curl_setopt($linktrust, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf- 8'));
        curl_setopt($linktrust, CURLOPT_POST, true);
        curl_setopt($linktrust, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($linktrust, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($linktrust, CURLOPT_POSTFIELDS, $xml); // add POST fields

        $response_xml = curl_exec($linktrust); // run the whole process
        curl_close($linktrust); // Always close the connection


    if($tid == '2607' && $cdl == 'Yes') {
        //Indeed pixel tracking for Andrus
        echo'<img height="1" width="1" border="0" src="https://conv.indeed.com/pagead/conv/5876009260614870/?script=0">';
	    if($experience != 'Less than 6 months' || $experience != '6 Months - 11 Months'){
            echo '<img src="//www.jobs2careers.com/conversion2.php?p=2419" width="1" height="1" />';
	    }
    }
    if($tid == '40981' && $cdl == 'Yes') {
	    if($experience != 'Less than 6 months' || $experience != '6 Months - 11 Months'){
		    echo '<img src="//www.jobs2careers.com/conversion2.php?p=3117" width="1" height="1" />';
	    }
    }
    if($company == 'Phoenix Transportation' && $cdl == 'Yes') {
	    if($experience != 'Less than 6 months' || $experience != '6 Months - 11 Months'){
		    echo '<img src="//www.jobs2careers.com/conversion2.php?p=3458" width="1" height="1" />';
	    }
    }
    if($company == 'Meyers Bros Trucking' ){
        echo '<img src="//www.jobs2careers.com/conversion2.php?p=3632" width="1" height="1" />';
    }
    if($company == 'Nagle Companies' ){
        echo '<img src="//www.jobs2careers.com/conversion2.php?p=3763" width="1" height="1" />';
    }
    if($company == 'Truck Service Inc.' ){
        echo '<img src="//www.jobs2careers.com/conversion2.php?p=3583" width="1" height="1" />';
    }
    if($company == 'EMH Transportation' ){
        echo '<img src="//www.jobs2careers.com/conversion2.php?p=3815" width="1" height="1" />';
    }
	    //Zip Tracking Pixel Fire
	    echo '<img src="https://track.ziprecruiter.com/conversion?board=firetoss_cpc" width="1" height="1" />';

}

add_action( 'gform_after_submission_6', 'post_6_to_link_trust', 10, 2 );
function post_6_to_link_trust( $entry, $form ){

	$first_name         = rgar($entry, '3.3');
	$last_name          = rgar($entry, '3.6');
	$email              = rgar($entry, '4');
	$phone              = rgar($entry, '5');
	$state              = rgar($entry, '8');
	$city               = rgar($entry, '12');
	$zip                = rgar($entry, '9');
	$cdl                = rgar($entry, '1');
	$experience         = rgar($entry, '2');
	$company            = 'Andrus Transportation';
	$tid                = rgar($entry, '10');
	$entryid            = rgar($entry, 'id');
	$job_title          = rgar($entry, '13');
	$job_location       = rgar($entry, '14');
	$source             = 'Firetoss';
	$utm_source         = rgar($entry, '16');
	$moving_violations  = rgar($entry, '17');
	$accidents          = rgar($entry, '18');
	$best_reach         = rgar($entry, '23');
	$phone_type         = rgar($entry, '20');
	// Set Affilate ID
	$afid = '406574';

	if ($utm_source == 'Indeed' || $utm_source == 'indeed'|| $utm_source == 'indeed.com') {
		$campaignID = '333797';
	} elseif ($utm_source == 'AndrusIndeed_CPC') {
		$campaignID = '373609';
	} elseif ($utm_source == 'Truck Driving Jobs' || $utm_source == 'Truck%20Driving%20Jobs' ) {
		$campaignID = '338578';
	} elseif ($utm_source == 'Jobs In Trucks' || $utm_source == 'Jobs In Trucks' || $utm_source == 'JobsInTrucks') {
		$campaignID = '337146';
	} elseif ($utm_source == 'Top USA Jobs' || $utm_source == 'Top%20USA%20Jobs') {
		$campaignID = '337145';
	} elseif ($utm_source == 'Jobs2Careers' || $utm_source == 'jobs2careers') {
		$campaignID = '333767';
	} elseif ($utm_source == 'ClassADrivers' || $utm_source == 'Class A Drivers' || $utm_source == 'Class%20A%20Drivers' || $utm_source == 'classadrivers' ) {
		$campaignID = '337394';
	} elseif ($utm_source == 'Craigslist' ) {
		$campaignID = '354368';
	} elseif ($utm_source == 'Facebook' ) {
		$campaignID = '356527';
	} else {
		$campaignID = '333799';
	}
	$xml =
		"<lead>"
		."<AFID>".$afid."</AFID>"
		."<FirstName>".$first_name."</FirstName>"
		."<LastName>".$last_name."</LastName>"
		."<email>".$email."</email>"
		."<phone>".$phone."</phone>"
		."<city>".$city."</city>"
		."<state>".$state."</state>"
		."<zip>".$zip."</zip>"
		."<cdl>".$cdl."</cdl>"
		."<driver_type>".$cdl."</driver_type>"
		."<experience>".$experience."</experience>"
		."<tid>".$tid."</tid>"
		."<company>".$company."</company>"
		."<jobLocation>".$job_location."</jobLocation>"
		."<MovingViolations>".$moving_violations."</MovingViolations>"
		."<accidents>".$accidents."</accidents>"
		."<best_way_to_contact>".$best_reach."</best_way_to_contact>"
		."<phone_type>".$phone_type."</phone_type>"
		."<job_title>".$job_title."</job_title>"
		."</lead>";
	$linktrust = curl_init();
	curl_setopt($linktrust, CURLOPT_URL, 'http://FireToss.linktrustleadgen.com/Lead/'.$campaignID.'/SimplePost');
	curl_setopt($linktrust, CURLOPT_VERBOSE, 1);
	curl_setopt($linktrust, CURLOPT_RETURNTRANSFER, 1); // return into a variable
	curl_setopt($linktrust, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf- 8'));
	curl_setopt($linktrust, CURLOPT_POST, true);
	curl_setopt($linktrust, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($linktrust, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($linktrust, CURLOPT_POSTFIELDS, $xml); // add POST fields

	$response_xml = curl_exec($linktrust); // run the whole process
	curl_close($linktrust); // Always close the connection

	if($tid == '2607' && $cdl == 'Yes') {
		//Indeed pixel tracking for Andrus
		echo'<img height="1" width="1" border="0" src="https://conv.indeed.com/pagead/conv/5876009260614870/?script=0">';
		echo '<img src="//www.jobs2careers.com/conversion2.php?p=2419" width="1" height="1" />';
	}

}

add_action( 'gform_after_submission_9', 'post_9_to_link_trust', 10, 2 );
function post_9_to_link_trust( $entry, $form ){

	$first_name         = rgar($entry, '3.3');
	$last_name          = rgar($entry, '3.6');
	$email              = rgar($entry, '4');
	$phone              = rgar($entry, '5');
	$state              = rgar($entry, '8');
	$city               = rgar($entry, '12');
	$zip                = rgar($entry, '9');
	$cdl                = rgar($entry, '1');
	$experience         = rgar($entry, '2');
	$company            = rgar($entry, '7');;
	$tid                = rgar($entry, '10');
	$entryid            = rgar($entry, 'id');
	$job_title          = rgar($entry, '13');
	$job_location       = rgar($entry, '14');
	$source             = 'Firetoss';
	$utm_source         = rgar($entry, '16');
	$moving_violations  = rgar($entry, '17');
	$accidents          = rgar($entry, '18');
	$best_reach         = rgar($entry, '23');
	//$phone_type         = rgar($entry, '20');
	$location           = rgar($entry, '19');
	$freight_type       = rgar($entry, '21');
	if($route_type == "Dry Van"){
		$route_type         = rgar($entry, '20');
	}elseif($route_type =='Flatbed Conestoga'){
		$route_type         = 'Regional';
	}
	// Set Affilate ID
	$afid = '406574';

	if ($utm_source == 'Indeed' || $utm_source == 'indeed'|| $utm_source == 'indeed.com') {
		$campaignID = '333797';
	} elseif ($utm_source == 'Jobs2Careers' || $utm_source == 'jobs2careers') {
		$campaignID = '333767';
	} elseif ($utm_source == 'email' || $utm_source == "Craigslist") {
		$campaignID = '377869';
	} else {
		$campaignID = '333799';
	}
	$xml =
		"<lead>"
		."<AFID>".$afid."</AFID>"
		."<FirstName>".$first_name."</FirstName>"
		."<LastName>".$last_name."</LastName>"
		."<email>".$email."</email>"
		."<phone>".$phone."</phone>"
		."<city>".$city."</city>"
		."<state>".$state."</state>"
		."<zip>".$zip."</zip>"
		."<cdl>".$cdl."</cdl>"
		."<driver_type>".$cdl."</driver_type>"
		."<experience>".$experience."</experience>"
		."<tid>".$tid."</tid>"
		."<company>".$company."</company>"
		."<jobLocation>".$job_location."</jobLocation>"
		."<violations>".$moving_violations."</violations>"
		."<accidents>".$accidents."</accidents>"
		."<best_way_to_contact>".$best_reach."</best_way_to_contact>"
		."<phone_type>".$phone_type."</phone_type>"
		."<job_title>".$job_title."</job_title>"
		."<applying_for_location>".$location."</applying_for_location>"
		."<freight_type_applying_for>".$freight_type."</freight_type_applying_for>"
		."<which_route_type_would_you_like_to_drive>".$route_type."</which_route_type_would_you_like_to_drive>"
		."</lead>";
	$linktrust = curl_init();
	curl_setopt($linktrust, CURLOPT_URL, 'http://FireToss.linktrustleadgen.com/Lead/'.$campaignID.'/SimplePost');
	curl_setopt($linktrust, CURLOPT_VERBOSE, 1);
	curl_setopt($linktrust, CURLOPT_RETURNTRANSFER, 1); // return into a variable
	curl_setopt($linktrust, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf- 8'));
	curl_setopt($linktrust, CURLOPT_POST, true);
	curl_setopt($linktrust, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($linktrust, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($linktrust, CURLOPT_POSTFIELDS, $xml); // add POST fields

	$response_xml = curl_exec($linktrust); // run the whole process
	curl_close($linktrust); // Always close the connection

	if($tid == '2607' && $cdl == 'Yes') {
		//Indeed pixel tracking for Andrus
		echo'<img height="1" width="1" border="0" src="https://conv.indeed.com/pagead/conv/5876009260614870/?script=0">';
		echo '<img src="//www.jobs2careers.com/conversion2.php?p=2419" width="1" height="1" />';
	}

}

add_action( 'gform_after_submission_7', 'kold_trans_landing_page', 10, 2 );
function kold_trans_landing_page( $entry, $form ){

    $first_name         = rgar($entry, '3.3');
    $last_name          = rgar($entry, '3.6');
    $email              = rgar($entry, '4');
    $phone              = rgar($entry, '5');
    $state              = rgar($entry, '8');
    $city               = rgar($entry, '12');
    $zip                = rgar($entry, '9');
    $cdl                = rgar($entry, '1');
    $experience         = rgar($entry, '2');
    $company            = 'Kold Trans';
    $tid                = rgar($entry, '10');
    $entryid            = rgar($entry, 'id');
    $job_title          = rgar($entry, '13');
    $job_location       = rgar($entry, '14');
    $source             = 'Firetoss';
    $utm_source         = rgar($entry, '16');
    $moving_violations  = rgar($entry, '17');
    $accidents          = rgar($entry, '18');
    $best_reach         = rgar($entry, '23');
    $phone_type         = rgar($entry, '20');
    // Set Affilate ID
    $afid = '406574';

    $xml =
        "<lead>"
        ."<AFID>".$afid."</AFID>"
        ."<FirstName>".$first_name."</FirstName>"
        ."<LastName>".$last_name."</LastName>"
        ."<email>".$email."</email>"
        ."<phone>".$phone."</phone>"
        ."<city>".$city."</city>"
        ."<state>".$state."</state>"
        ."<zip>".$zip."</zip>"
        ."<cdl>".$cdl."</cdl>"
        ."<driver_type>".$cdl."</driver_type>"
        ."<experience>".$experience."</experience>"
        ."<tid>".$tid."</tid>"
        ."<company>".$company."</company>"
        ."<jobLocation>".$job_location."</jobLocation>"
        ."<violations>".$moving_violations."</violations>"
        ."<accidents>".$accidents."</accidents>"
        ."<best_way_to_contact>".$best_reach."</best_way_to_contact>"
        ."<phone_type>".$phone_type."</phone_type>"
        ."<job_title>".$job_title."</job_title>"
        ."</lead>";
    $linktrust = curl_init();
    curl_setopt($linktrust, CURLOPT_URL, 'http://FireToss.linktrustleadgen.com/Lead/351831/SimplePost');
    curl_setopt($linktrust, CURLOPT_VERBOSE, 1);
    curl_setopt($linktrust, CURLOPT_RETURNTRANSFER, 1); // return into a variable
    curl_setopt($linktrust, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf- 8'));
    curl_setopt($linktrust, CURLOPT_POST, true);
    curl_setopt($linktrust, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($linktrust, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($linktrust, CURLOPT_POSTFIELDS, $xml); // add POST fields

    $response_xml = curl_exec($linktrust); // run the whole process

    curl_close($linktrust); // Always close the connection

}


add_action( 'gform_after_submission_5', 'get_qualified_jobs', 10, 2 );

function get_qualified_jobs( $entry, $form ){
    $cdl            = rgar($entry, '7');
    $experience     = rgar($entry, '8');
    $where          = rgar($entry, '20');
    $first_name     = rgar($entry, '1.3');
    $last_name      = rgar($entry, '1.6');
    $email          = rgar($entry, '2');
    $phone          = rgar($entry, '3');
    $address        = rgar($entry, '21.1');
    $address2       = rgar($entry, '21.2');
    $city           = rgar($entry, '21.3');
    $state          = rgar($entry, '21.4');
    $zip            = rgar($entry, '21.5');
    $entryid        = rgar($entry, 'id');
    $adid           = rgar($entry, 'adid');
    $sudid          = rgar($entry, 'sudid');
    $referer        = rgar($entry, 'referer');
    $utm_source     = rgar($entry, '16');
    $source         = 'Firetoss';
    if($experience != "No Experience" || $experience != "6 Months - 1 Year" || $experience != "Less than 6 months" ){
        if($cdl == 'Yes'){
            // args
            $listings_args = array(
                'posts_per_page'	=> 3,
                'post_type'		=> 'company',
                'meta_key'		=> 'hiring_area',
                'meta_value'	=>  $where
            );

            // query
            $listings_args = new WP_Query( $listings_args );
            if( $listings_args->have_posts() ):?>
                <script type="text/javascript" src="https://www.drivetrucking.com/wp-includes/js/jquery/jquery.js?ver=1.12.4"></script>
                    <?php while( $listings_args->have_posts() ) : $listings_args->the_post();?>
                    <?php $tid = get_field('tenstreet_id')?>
                    <article>
                    <header class="entry-header">
                        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                    </header><!-- .entry-header -->
                    <div class="entry-content">
                        You meet the qualifications to work at <?php the_title();?>. Send your info onto <?php the_title();?> now. Simply click the Apply button below. One of their hiring consultants will contact you soon.
                        <form action="https://FireToss.linktrustleadgen.com/Lead/333799/SimplePost" id="company-<?php the_ID(); ?>">
                            <input type="hidden" id="FirstName" name="FirstName" value="<?php echo $first_name;?>">
                            <input type="hidden" id="LastName"name="LastName" value="<?php echo $last_name;?>">
                            <input type="hidden" id="email" name="email" value="<?php echo $email;?>">
                            <input type="hidden" id="phone" name="phone" value="<?php echo $phone;?>">
                            <input type="hidden" id="address" name="address" value="<?php echo $address;?>">
                            <input type="hidden" id="address2" name="address2" value="<?php echo $address2;?>">
                            <input type="hidden" id="city" name="city" value="<?php echo $city;?>">
                            <input type="hidden" id="state" name="state" value="<?php echo $state;?>">
                            <input type="hidden" id="zip" name="zip" value="<?php echo $zip;?>">
                            <input type="hidden" id="entryid" name="entryid" value="<?php echo $entryid;?>">
                            <input type="hidden" id="ADID" name="ADID" value="<?php echo $adid;?>">
                            <input type="hidden" id="SID" name="SID" value="<?php echo $sudid;?>">
                            <input type="hidden" id="referer" name="referer" value="<?php echo $referer;?>">
                            <input type="hidden" id="utm_source" name="utm_source" value="<?php echo $utm_source;?>">
                            <input type="hidden" id="source" name="source" value="<?php echo $source;?>">
                            <input type="hidden" id="cdl" name="cdl" value="<?php echo $cdl;?>">
                            <input type="hidden" id="experience" name="experience" value="<?php echo $experience;?>">
                            <input type="hidden" name="action" value="handleApply"/>
                            <input type="hidden" name="company" value="<?php the_title();?>"/>
                            <input type="hidden" name="tid" value="<?php echo $tid;?>"/>
                            <?php wp_nonce_field( 'apply_to_company', 'company_nonce_submit' ); ?>
                            <div class="apply">
                                <a href="#" class="button-blue"><?php _e('Apply');?></a>
                            </div>
                        </form>
                        <script>
                            (function($) {
                                $("#company-<?php the_ID(); ?> .button-blue").click(function(event) {

                                    // Prevent default posting of form
                                    event.preventDefault();

                                    var $form = $("#company-<?php the_ID(); ?>");
                                    // Serialize the data in the form
                                    var data = {};
                                    $("#company-<?php the_ID(); ?>").serializeArray().map(function(x){data[x.name] = x.value;});

                                    console.log(data);

                                    var $inputs = $form.find("input, select, button, textarea");

                                    //$inputs.prop("disabled", true);

                                    // Fire off the request to
                                    request = $.ajax({
                                        url: "/wp-admin/admin-ajax.php",
                                        type: "post",
                                        data: data
                                    });

                                    // Callback handler that will be called on success
                                    request.done(function (response, textStatus, jqXHR){
                                        // Log a message to the console
                                        console.log("Hooray, it worked! "+ response +" "+ textStatus +" " + jqXHR);
                                    });

                                    // Callback handler that will be called on failure
                                    request.fail(function (jqXHR, textStatus, errorThrown){
                                        // Log the error to the console
                                        console.error(
                                            "The following error occurred: "+
                                            textStatus, errorThrown
                                        );
                                    });

                                    // Callback handler that will be called regardless
                                    // if the request failed or succeeded
                                    request.always(function () {
                                        // Reenable the inputs
                                        $inputs.prop("disabled", false);
                                    });


                                });
                            })( jQuery );
                        </script>
                    </div>
                    </article>
                    <?php endwhile; ?>
            <?php endif; ?>
    <?php }else{
            echo 'The companies hiring in your area, are looking for someone with a Valid CDL Class A drivers license.';
        }
    }else{
        echo 'Thank you, but you do not have enough experience, the companies that are currently hiring in your area are looking for a minimum 1 year experience.';
    }
}

function handleApply(){

    if ( ! isset( $_POST['company_nonce_submit'] ) || ! wp_verify_nonce( $_POST['company_nonce_submit'], 'apply_to_company')) {
        exit( 'The form is not valid' );
    }
    $company        =  $_POST['company'];
    $cdl            =  $_POST['cdl'];
    $experience     =  $_POST['experience'];
    $first_name     =  $_POST['FirstName'];
    $last_name      =  $_POST['LastName'];
    $email          =  $_POST['email'];
    $phone          =  $_POST['phone'];
    $address        =  $_POST['address'];
    $address2       =  $_POST['address2'];
    $city           =  $_POST['city'];
    $state          =  $_POST['state'];
    $zip            =  $_POST['zip'];
    $entryid        =  $_POST['entryid'];
    $adid           =  $_POST['ADID'];
    if($adid==''){
        $adid='406574';
    }
    $sudid          =  $_POST['SID'];
    $referer        =  $_POST['referer'];
    $utm_source     =  $_POST['utm_source'];
    $tid            =  $_POST['tid'];
    $source         = 'Firetoss';
    if ($utm_source == 'Indeed' || $utm_source == 'indeed'|| $utm_source == 'indeed.com') {
        $campaignID = '333797';
    } elseif ($utm_source == 'AndrusIndeed_CPC') {
	    $campaignID = '373609';
    } elseif ($utm_source == 'Truck Driving Jobs' || $utm_source == 'Truck%20Driving%20Jobs' ) {
        $campaignID = '338578';
    } elseif ($utm_source == 'Jobs In Trucks' || $utm_source == 'Jobs%20In%20Trucks' || $utm_source == 'JobsInTrucks') {
        $campaignID = '337146';
    } elseif ($utm_source == 'Top USA Jobs' || $utm_source == 'Top%20USA%20Jobs') {
        $campaignID = '337145';
    } elseif ($utm_source == 'Jobs2Careers' || $utm_source == 'jobs2careers') {
        $campaignID = '333767';
    } elseif ($utm_source == 'ClassADrivers' || $utm_source == 'Class A Drivers' || $utm_source == 'Class%20A%20Drivers' || $utm_source == 'classadrivers' ) {
        $campaignID = '337394';
    } elseif ($utm_source == 'Craigslist' ) {
        $campaignID = '354368';
    } else {
        $campaignID = '333799';
    }
    $xml =
        "<lead>"
        ."<ClickID></ClickID>"
        ."<AFID>".$adid."</AFID>"
        ."<SID>".$sudid."</SID>"
        ."<referer>".$referer."</referer>"
        ."<FirstName>".$first_name."</FirstName>"
        ."<LastName>".$last_name."</LastName>"
        ."<email>".$email."</email>"
        ."<phone>".$phone."</phone>"
        ."<address>".$address."</address>"
        ."<address2>".$address2."</address2>"
        ."<city>".$city."</city>"
        ."<state>".$state."</state>"
        ."<zip>".$zip."</zip>"
        ."<cdl>".$cdl."</cdl>"
        ."<experience>".$experience."</experience>"
        ."<tid>".$tid."</tid>"
        ."<company>".$company."</company>"
        ."<entryID>".$entryid."</entryID>"
        ."</lead>";
    $linktrust = curl_init();
    curl_setopt($linktrust, CURLOPT_URL, 'http://FireToss.linktrustleadgen.com/Lead/'.$campaignID.'/SimplePost');
    curl_setopt($linktrust, CURLOPT_VERBOSE, 1);
    curl_setopt($linktrust, CURLOPT_RETURNTRANSFER, 1); // return into a variable
    curl_setopt($linktrust, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf- 8'));
    curl_setopt($linktrust, CURLOPT_POST, true);
    curl_setopt($linktrust, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($linktrust, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($linktrust, CURLOPT_POSTFIELDS, $xml); // add POST fields
    curl_close($linktrust); // Always close the connection
    echo $response_xml = curl_exec($linktrust); // run the whole process
    die();
}
add_action('wp_ajax_myFunction', 'handleApply');
add_action('wp_ajax_nopriv_myFunction', 'handleApply');


/*Tensteet XML Curl Code*/
/*if ($email != 'test@test.com') {
    if ($tid) {
        $post_address = 'https://dashboard.tenstreet.com/post/';
        $xml_data =
            "<TenstreetData>"
            . "<Authentication>"
            . "<ClientId>130</ClientId>"
            . "<Password>Yz66Kxf8j2Lc88k8b!1il</Password>"
            . "<Service>subject_upload</Service>"
            . "</Authentication>"
            . "<Mode>PROD</Mode>"
            . "<Source>" . $source . "</Source>"
            . "<CompanyId>" . $tid . "</CompanyId>"
            . "<CompanyName>" . $company . "</CompanyName>"
            . "<DriverId>" . $entryid . "</DriverId>"
            . "<PersonalData>"
            . "<PersonName>"
            . "<Prefix />"
            . "<GivenName>" . $first_name . "</GivenName>"
            . "<FamilyName>" . $last_name . "</FamilyName>"
            . "</PersonName>"
            . "<PostalAddress>"
            . "<CountryCode>US</CountryCode>"
            . "<Municipality>" . $city . "</Municipality>"
            . "<Region>" . $state . "</Region>"
            . "<PostalCode>" . $zip . "</PostalCode>"
            . "</PostalAddress>"
            . "<ContactData PreferredMethod=\"PrimaryPhone\">"
            . "<InternetEmailAddress>" . $email . "</InternetEmailAddress>"
            . "<PrimaryPhone>" . $phone . "</PrimaryPhone>"
            . "</ContactData>"
            . "</PersonalData>"
            . "<ApplicationData>"
            . "<AppReferrer>Short Form</AppReferrer>"
            . "<DisplayFields>"
            . "<DisplayField>"
            . "<DisplayPrompt>Experience Level</DisplayPrompt>"
            . "<DisplayValue>" . $experience . "</DisplayValue>"
            . "</DisplayField>"
            . "<DisplayField>"
            . "<DisplayPrompt>Has CDL-A?</DisplayPrompt>"
            . "<DisplayValue>" . $cdl . "</DisplayValue>"
            . "</DisplayField>"
            . "<DisplayField>"
            . "<DisplayPrompt>Applying for job in</DisplayPrompt>"
            . "<DisplayValue>" . $job_location . "</DisplayValue>"
            . "</DisplayField>"
            . "</DisplayFields>"
            . "</ApplicationData>"
            . "</TenstreetData>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $post_address);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf- 8'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data); // add POST fields
        $response_xml = curl_exec($ch); // run the whole process
        curl_close($ch); // Always close the connection
        //echo $xml_data;
        //echo $response_xml;
    }
}*/