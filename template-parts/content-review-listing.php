<?php
/**
 * Template part for displaying a reviews.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _scorch
 */

//Get the custom fields data
$rating = get_field('rating');?>
<div id="review-<?php the_ID();?>" class="review" itemprop="review" itemscope itemtype="http://schema.org/Review">
    <header class="entry-header">
        <?php the_title('<h4 class="entry-title" itemprop="name">','</h4>', true); ?>
        <div class="entry-meta">
            <?php if($rating):?>
                <meta itemprop="datePublished" content="<?php echo get_the_date('Y-m-d'); ?>">
                <meta itemprop="worstRating" content="1"/>
                <meta itemprop="ratingValue" content="<?php echo $rating;?>"/>
                <meta itemprop="bestRating" content="5"/>
                <?php _e('Rating: ','_scorch');?>
                <ul class="star-rating">
                    <?php for($rating_num = 1; $rating_num <= $rating; $rating_num++):?>
                        <li><span class="rated-star">&starf;</span></li>
                    <?php endfor; ?>
                    <? if ($rating < 5):
                        $blankstars = 5 - $rating;
                        ?>
                        <?php for($rating_blanks = 1; $rating_blanks <= $blankstars; $rating_blanks++):?>
                        <li><span class="blank-star">&star;</span></li>
                    <?php endfor; ?>
                    <? endif ?>
                </ul>
            <?php endif; ?>
            <span><?php _e('Posted by: ', '_scorch');?><?php the_field('employment_status');?></span>
        </div>
    </header><!-- .entry-header -->
    <div class="entry-content" itemprop="description">
        <?php
        the_content( sprintf(
        /* translators: %s: Name of current post. */
            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', '_scorch' ), array( 'span' => array( 'class' => array() ) ) ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ) );
        ?>
    </div><!-- .entry-content -->
</div>