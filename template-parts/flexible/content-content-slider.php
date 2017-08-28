<?php $color = get_sub_field('color') ?>
<div class="color-content-<?php echo $color;?> rslides_container cslides_container">
    <div class="wrapper">
    <?php
    echo $content_type = get_sub_field('content_type');
    if (have_rows('content_slide')):
    // loop through the rows of data
    while (have_rows('content_slide')) : the_row();
    $title = get_sub_field('content_title');
    if($content_type!= 'custom_content'):?>
        <div class="dashed-title"><h2><?php echo $title;?></h2></div>
    <?php endif; ?>
    <?php
        endwhile;
        endif;
    ?>
<ul class="contentslides" id="content-slider">
    <?php
    // check if the repeater field has rows of data
    $max_slider_height = get_sub_field('max_slider_height');
    $animate = get_sub_field('animate');
    if (have_rows('content_slide')):

    // loop through the rows of data
    while (have_rows('content_slide')) : the_row();
        //Variables
        $content_type = get_sub_field('content_type');
        $content_alignment = get_sub_field('content_alignment');
        $title = get_sub_field('content_title');
        $description = get_sub_field('content');
        $number_of_posts = get_sub_field('number_of_posts');
        $show_external = get_sub_field('show_external');
        $external_link = get_sub_field('url');
        $link = get_sub_field('link');
        $call_to_action_button = get_sub_field('call_to_action_button');
        $call_to_action_text = get_sub_field('button_text');
        $button_color = get_sub_field('button_color');
        $content_alignment = get_sub_field('content_alignment');
        $max_content_width = get_sub_field('max_content_width');
        $max_width_content_wrapper = get_sub_field('max_width_of_content_wrapper');
    ?>



        <?php if ($content_type == 'custom_content'): ?>
        <li>
        <div class="content">
            <div class="content-wrapper" style="max-width: <?php echo $max_width_content_wrapper; ?>px">
                <div class="box-<?php echo $content_alignment; ?>" style="max-width: <?php echo $max_content_width; ?>px">
                    <?php if ($title): ?>
                    <div class="slider-content">
                        <h2><?php echo $title;?></h2>
                        <p><?php echo $description;?></p>
                        <?php if( $link || $external_link ): ?>
                        <a href="<?php if ($link): echo $link; endif; if ($external_link): echo $external_link; endif; ?>">
                            <?php endif; ?>
                            <div class="button-<?php echo $button_color; ?>"><?php echo $call_to_action_text; ?></div>
                        <?php if ($link || $external_link): ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        </li>
        <?php elseif($content_type == 'publication' || 'testimonials' || 'team' || 'posts' || 'product'):?>

        <?php
        $posts = get_posts(array(
            'posts_per_page'	=> $number_of_posts,
            'post_type'			=> $content_type
        ));
        if( $posts ): ?>
        <?php foreach( $posts as $post ): setup_postdata( $post )?>
        <li>
            <div class="content">
                <div class="content-wrapper" style="max-width: <?php echo $max_width_content_wrapper; ?>px">
                    <div class="box-<?php echo $content_alignment; ?>" style="max-width: <?php echo $max_content_width; ?>px">
                        <div class="grid-container post-view">
                            <div class="<?php echo figuregrid('grid', $number_of_post);?> ta-<?php echo $content_alignment; ?> post">
                                <?php get_template_part( 'template-parts/content', 'posts' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <?php  endif; ?>

<?php endwhile;
endif; ?>
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
    $("#content-slider").responsiveSlides({
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