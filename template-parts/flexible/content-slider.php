<div class="rslides_container">
<ul class="rslides" id="slider">
    <?php
    // check if the repeater field has rows of data
    $max_slider_height = get_sub_field('max_slider_height');
    $animate = get_sub_field('animate');
    if (have_rows('slider')):

    // loop through the rows of data
    while (have_rows('slider')) :
    the_row();
    $image_or_video = get_sub_field('image_or_video');

    $image = get_sub_field('image');
    $mobile_image = get_sub_field('mobile_image');
    $video = get_sub_field('video');
    $content_alignment = get_sub_field('content_alignment');
    $title = get_sub_field('title');
    $title_type = get_sub_field('title_type');
    $description = get_sub_field('description');
    $mp4 = get_sub_field('mpg4');
    $ogv = get_sub_field('ogv');
    $webm = get_sub_field('webm');
    $poster = get_sub_field('poster');
    $show_external = get_sub_field('show_external');
    $external_link = get_sub_field('external_link');
    $link = get_sub_field('link');
    $call_to_action_button = get_sub_field('call_to_action_button');
    $call_to_action_text = get_sub_field('call_to_action_text');
    $button_color = get_sub_field('button_color');
    $content_alignment = get_sub_field('content_alignment');
    $max_content_width = get_sub_field('max_content_width');
    $max_width_content_wrapper = get_sub_field('max_width_content_wrapper');
    $detect = new Mobile_Detect;
    ?>


    <li>

        <?php if ($image_or_video == 'Image'): ?>
        <div class="image">
            <?php if($mobile_image):?>
                <?php if($detect->isMobile()):?>
                    <img src="<?php echo $mobile_image['url']; ?>" title="<?php echo $mobile_image['title']; ?>">
                <?php else:?>
                    <img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
                <?php endif;?>
            <?php else:?>
                    <img src="<?php echo $image['url']; ?>" title="<?php echo $image['title']; ?>">
            <?php endif;?>
            <div class="content-wrapper" style="max-width: <?php echo $max_width_content_wrapper; ?>px">
                <div class="box-<?php echo $content_alignment; ?>"
                     style="max-width: <?php echo $max_content_width; ?>px">
                    <?php if ($title): ?>
                    <div class="slider-content">
                        <?php if ($title): ?>
                        <?php if ($title_type): ?>
                            <<?php echo $title_type; ?>>
                        <?php endif; ?>
                        <?php echo $title; ?>
                        <?php if ($title_type): ?>
                    </<?php echo $title_type;?>>
                    <?php endif;?>
                    <?php endif;?>
                    <?php if($description):?>
                    <?php echo $description;?>
                    <?php endif ?>
                    <?php if($call_to_action_button == true):?>
                    <?php if( $link || $external_link ): ?>
                    <a href="<?php if ($link): echo $link; endif;
                    if ($external_link): echo $external_link; endif; ?>">
                        <?php endif; ?>
                        <div class="button-<?php echo $button_color; ?>"><?php echo $call_to_action_text; ?></div>
                        <?php if ($link || $external_link): ?>
                    </a>
                    <?php endif; ?>
                    <?php endif ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
</div>
<?php elseif($image_or_video == 'HTML5 Background Video'):?>
    <div class="video-container">
        <div class="box-<?php echo $content_alignment;?>" style="max-width: <?php echo $max_content_width;?>px">
        <?php if ($title): ?>
            <div class="slider-content">
            <?php if($title):?>
                <?php if($title_type):?>
                    <<?php echo $title_type;?>>
                <?php endif;?>
                <?php echo $title;?>
                <?php if($title_type):?>
                                                                </<?php echo $title_type;?>>
                                                            <?php endif;?>
            <?php endif;?>
            <?php if($description):?>
                <?php echo $description;?>
            <?php endif ?>
            <?php if($call_to_action_button == true):?>
                <?php if( $link || $external_link ): ?>
                    <a href="<?php if($link): echo $link; endif; if($external_link): echo $external_link; endif; ?>">
                <?php endif;?>
                <div class="<?php echo $button_color;?>"><?php echo $call_to_action_text;?></div>
                <?php if( $link || $external_link): ?>
                    </a>
                <?php endif; ?>
            <?php endif ?>
            </div>
            <?php endif;?>
        </div>
        <video class="video" poster="<?php echo $poster['url'];?>" controls="false" autoplay loop>
            <?php if($mp4):?><source src="<?php echo $mp4['url'];?>" type="video/mp4"><?php endif; ?>
                <?php if($ogv):?><source src="<?php echo $ogv['url'];?>" type="video/ogg"><?php endif;?>
                <?php if($webm):?><source src="<?php echo $webm['url'];?>" type="video/webm"><?php endif;?>
            Your browser does not support the video tag.
        </video>
    </div>
    <style>
        video::-webkit-media-controls {
            display:none !important;
        }
    </style>
    <script>
        (function($) {
            thevideo = $('.video');
            thevideo.get(0).pause();
            thevideo.get(0).load();
            thevideo.get(0).play();
            windowwidth = $(window).width();
            if(windowwidth > 767){
                $('.rslides li').css('height', (windowwidth*9/16));
            }else{
                $('.video-container').css({'background':'url(<?php echo $poster['url'];?>)'});
                $('.video').css({'display':'none'});
            }
        })( jQuery );
    </script>
<?php endif; ?>


</li>
<?php
endwhile;

endif;
?>
</ul>
</div>
<?php if ($max_slider_height): ?>
<style>
    .rslides li {
        height: <?php echo $max_slider_height;?>px;
    }

    @media screen and (max-width: 960px) {
        .rslides li {
            height: <?php echo $max_slider_height;?>px;
        }
    }
</style>
<?php endif; ?>
<script>
<?php ?>
(function ($) {
    // Slideshow
    $("#slider").responsiveSlides({
        auto: <?php the_sub_field('auto'); ?>,                          // Boolean: Animate automatically, true or false
        speed: <?php the_sub_field('speed'); ?>,                        // Integer: Speed of the transition, in milliseconds
        timeout: <?php the_sub_field('timeout'); ?>,                    // Integer: Time between slide transitions, in milliseconds
        pager: <?php the_sub_field('show_nav'); ?>,               // Boolean: Show pager, true or false
        nav: <?php the_sub_field('show_prev_next'); ?>,                       // Boolean: Show navigation, true or false
        pause: <?php the_sub_field('pause_on_hover'); ?>,               // Boolean: Pause on hover, true or false
        pauseControls: <?php the_sub_field('pause_on_hover'); ?>,     // String: Text for the "next" button
        random: <?php the_sub_field('random'); ?>,                      // Boolean: Randomize the order of the slides, true or false
        prevText: "Previous",                                           // String: Text for the "previous" button
        nextText: "Next",                                               // String: Text for the "next" button
        maxwidth: "<?php the_sub_field('max'); ?>",                     // Integer: Max-width of the slideshow, in pixels
        namespace: "centered-btns",
        before: function (Luke) {
            animateText(Luke);

        }
    });
    //define variables
    var slideText, pagerBtn;
    slideText = $('.slide-content');
    pagerBtn = $('.centered-btns');
    function hidetext() {
        animationtypte = '<?php echo $animate;?>';

    }

    var firstslide = true;

    function animateText(skywalker) {
        animationtype = '<?php echo $animate;?>';
        if (firstslide == true) {
            slidetoanimate = $('#centered-btns1_s0 .slider-content');
            firstslide = false;
        } else {
            slidetoanimate = $('#centered-btns1_s' + skywalker + ' .slider-content');
        }
        if (animationtype != "none") {
            slidetoanimate.addClass('animated ' + animationtype);
            window.setTimeout(function () {
                slidetoanimate.removeClass('animated ' + animationtype);
            }, 2000);
        }
    }

    //run animation function on page load
    animateText();

    //run animation function on pager click
    pagerBtn.click(function () {
        animateText();
    });

    // Next Slide on Swipe
    var slides = $('.rslides'),
        i = 0;
    slides
        .on('swipeleft', function (e) {
            $('.centered-btns_nav.next').click();
            $(".rslides").mouseenter();
            setTimeout(function () {
                $(".rslides").mouseleave();
            }, 2000); // Delay automatic sliding for 2seconds after swiping
        })
        .on('swiperight', function (e) {
            $('.centered-btns_nav.prev').click();
            $(".rslides").mouseenter();
            setTimeout(function () {
                $(".rslides").mouseleave();
            }, 2000); // Delay automatic sliding for 2seconds after swiping
        });

    // If the movestart is heading off in an upwards or downwards direction, prevent it so that the browser scrolls normally.
    $('.rslides')
        .on('movestart', function (e) {
            if ((e.distX > e.distY && e.distX < -e.distY) ||
                (e.distX < e.distY && e.distX > -e.distY)) {
                e.preventDefault();
            }
        });

})(jQuery);
<?php ?>
</script>