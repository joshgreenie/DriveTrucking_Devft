<?php

/**
 * Register indeed RSS template.
 */
function jobs_rss() {
    add_feed( 'jobs', 'jobs_rss_render' );
}
add_action( 'after_setup_theme', 'jobs_rss' );
/**
 * Indeed RSS template callback.
 */
function jobs_rss_render() {
    get_template_part( 'feed', 'jobs' );
}