<div id="sub-head" class="top-header">
    <section class="sub-head-container">
        <div id="social-header" class="span-one-half">
            <?php if( have_rows('social_links', 'option') ): ?>
                <?php while( have_rows('social_links', 'option') ): the_row(); ?>
                    <a href="<?php the_sub_field('social_link')?>" <?php if(get_sub_field('social_icon')=="gplus"):?>rel="publisher"<?php endif;?>><span class="icon-<?php the_sub_field('social_icon')?>"></span></a>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php if( get_field('header_message', 'option') ): ?>
                <span class="message">
                    <p>&nbsp;&nbsp;|&nbsp;&nbsp;</p><?php echo get_field('header_message', 'option');?>
                </span>
            <?php endif;?>
        </div>
    </section>
</div>