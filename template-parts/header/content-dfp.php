<script type='text/javascript'>
    (function() {
        var useSSL = 'https:' == document.location.protocol;
        var src = (useSSL ? 'https:' : 'http:') +
            '//www.googletagservices.com/tag/js/gpt.js';
        document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
    })();
</script>
<script type='text/javascript'>
    googletag.cmd.push(function() {
        googletag.defineSlot('/104636738/button_ad_1', [125, 125], 'div-gpt-ad-1463521288188-0').addService(googletag.pubads());
        googletag.defineSlot('/104636738/Button_ad_2', [125, 125], 'div-gpt-ad-1463521288188-1').addService(googletag.pubads());
        googletag.defineSlot('/104636738/Button_ad_3', [125, 125], 'div-gpt-ad-1463521288188-2').addService(googletag.pubads());
        googletag.defineSlot('/104636738/button_ad_4', [125, 125], 'div-gpt-ad-1463521288188-3').addService(googletag.pubads());
        googletag.defineSlot('/104636738/button_ad_5', [125, 125], 'div-gpt-ad-1463521288188-4').addService(googletag.pubads());
        googletag.defineSlot('/104636738/button_ad_6', [125, 125], 'div-gpt-ad-1463521288188-5').addService(googletag.pubads());
        googletag.defineSlot('/104636738/second_square_ad', [[336, 280], [300, 250]], 'div-gpt-ad-1463521288188-6').addService(googletag.pubads());
        googletag.defineSlot('/104636738/third_square_ad', [[336, 280], [300, 250]], 'div-gpt-ad-1463521288188-7').addService(googletag.pubads());
        googletag.defineSlot('/104636738/top_square_ad', [[336, 280], [300, 250], [300, 600]], 'div-gpt-ad-1463521288188-8').addService(googletag.pubads());
        googletag.defineSlot('/104636738/listings_leader_board', [[468, 60], [728, 90], [970, 90]], 'div-gpt-ad-1464280269192-0').addService(googletag.pubads());
        googletag.defineSlot('/104636738/mobile_leader_board', [320, 50], 'div-gpt-ad-1463684262279-1').addService(googletag.pubads());
        <?php /*if( 'jobs' == get_post_type() ): ?>
         googletag.pubads().setTargeting('State', '<?php
                 global $post;
                    $location =""; $i = 1;
                    foreach((get_the_terms( $post->ID, 'location' )) as $location_category) {
                        if ($location_category->parent == 0) {
                            $state .= $location_category->slug;
                            if($i == 1)
                                break;
                        }
                    }
                    echo $state;
                    ?>');
         <?php endif;*/?>
        googletag.pubads().enableSingleRequest();
        googletag.pubads().collapseEmptyDivs();
        googletag.enableServices();
    });
</script>