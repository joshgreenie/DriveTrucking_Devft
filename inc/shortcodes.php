<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 10/5/2017
 * Time: 2:34 AM
 */


add_shortcode('wp-profile-progress-bar', 'wp_profile_progress_bar');
function wp_profile_progress_bar(){
    if(is_user_logged_in()){
        global $user;

        $user_id = get_current_user_id();
        $userdata = get_userdata($user_id);

        $userdata = $userdata->data;
        $total_fields = count((array)$userdata);

        $usermeta = get_user_meta($user_id);
        $total_fields = $total_fields + count($usermeta);
//        var_dump($userdata);
//        echo "<h1>break</h1>";
//        var_dump($usermeta);
//        echo "<h1>break</h1>";
//        var_dump($total_fields);
        $filled_fields = 0;
        foreach ($userdata as $key => $value) {
            # code...
            if($value != ''){
                $filled_fields++;
            }
        }

        if(!empty($usermeta)){
            foreach ($usermeta as $key => $value) {
                # code...
                if(isset($value[0]) && $value[0] != ''){
                    $filled_fields++;
                }
            }
        }

        $profile_complete = (($filled_fields / $total_fields) * 100);
        $profile_complete = round($profile_complete);
        $complete = '';


        $message = '';

                if ( in_array( 'driver', (array) $user->roles ) ) {
                    $message = 'Finish filling out your profile <a href="/update-driver-profile/">here.</a>';
                }

                if ( in_array( 'recruiter', (array) $user->roles ) ) {
                    $message = 'Finish filling out your profile <a href="/recruiter-account">here.</a>';
                }


        if($profile_complete == 100):
            $complete = "complete";
            $message = "";
        endif;
        $style = '<style>
					.progress{border:1px solid #ebebeb; padding:3px; text-align: center; font-size:11px;}
					.progress-bar{background-color:#ebebeb;}
				</style>';

        return $style . '<div class="progress">
				  	<div class="progress-bar '.$complete.'" role="progressbar" aria-valuenow="'.$profile_complete.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$profile_complete.'%">
				    	'.$profile_complete.'%
				  	</div>
				</div>
				<div class="alert profile-message">'.$message.'</div>';
    }
    else{
        return 'Please login.';
    }
}
