<?php
//Get Content Block Variables
$title              = get_sub_field('title');
$title_type         = get_sub_field('title_type');
$icon               = get_sub_field('icon');
$color              = get_sub_field('background_color');
$number_of_post     = get_sub_field('number_of_post_to_show');
$post_type_to_get   = get_sub_field('post_type');
?>
<div class="color-content-<?php echo $color;?>">
    <div class="wrapper">
        <?php if($title):?>
        <div class="dashed-title">
            <<?php echo $title_type;?>><?php echo $title;?></<?php echo $title_type;?>>
        </div>
    <?php endif;?>

    <?php
    if($post_type_to_get!="event"):
        $posts = get_posts(array(
            'posts_per_page'	=> $number_of_post,
            'post_type'			=> $post_type_to_get
        ));
        if( $posts ): ?>
            <div class="grid-container post-view">
                <?php foreach( $posts as $post ):
                    setup_postdata( $post )
                    ?>
                    <div class="<?php echo figuregrid('grid', $number_of_post);?> ta-left post">
                        <?php get_template_part( 'template-parts/content', 'posts' ); ?>
                    </div>
                <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    <?php else:?>
        <div class="grid-container post-view">
        <?php
        // Retrieve upcoming events
        global $post;
        $date = date('Y-m-d H:i:s');
        $events = tribe_get_events( array(
            'posts_per_page' => 2,
            'start_time' => $date
        ) );
        $event_count = count($events);
        if($event_count==0){
            $number_of_post = 1;
        }
        if($event_count ==1){
            $number_of_post=2;
        }
        // Loop through the events: set up each one as
        // the current post then use template tags to
        // display the title and content
        foreach ( $events as $post ) {
            setup_postdata( $post );

            // This time, let's throw in an event-specific
            // template tag to show the date after the title!
           ?>
            <div class="<?php echo figuregrid('grid', $number_of_post);?> ta-left post">
                <?php get_template_part( 'template-parts/content', 'events' ); ?>
            </div>
            <?php
        }

        ?>
        <?php wp_reset_postdata(); ?>

            <div class="<?php echo figuregrid('grid', $number_of_post);?> ta-left post">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h3 class="entry-title"><a href="/schedule-an-event/"><?php if($number_of_post!=1): _e("Schedule an Event"); else:  _e("No Upcoming Events, Schedule an Event"); endif;?></a></h3>
                        <div class="entry-meta">
                            <?php _e("Event Date: ")?><?php _e('TBA')?>
                            <br>
                            <?php _e("Event Location: ")?><?php _e('TBA')?>

                        </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php _e('Would you like sponsor an event and have the JSRI come and present on Joseph Smith?  Contact us about setting up an event.');?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <p class="read-more">
                            <a href="/schedule-an-event/" class="button-gold"><?php _e("Sponsor an Event")?> </a>
                        </p>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-## -->
            </div>
        </div>
    <?php endif; ?>
</div>
</div>