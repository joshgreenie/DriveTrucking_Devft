<?php
//Get Gallery Varialbe
$color = get_sub_field('background_color');
?>
<div class="color-background-<?php echo $color;?>" <?php if($background_image):?>style="background-image: url('<?php echo get_template_directory_uri()?>/images/<?php echo $color;?>-bg-overlay.png'), url(<?php echo $background_image['url']?>);" <?php endif;?>>
    <?php
    // Check for Project Gallery, if there is a gallery, echo out the images
    if( have_rows('images') ):
    $rows = get_sub_field('images');
    $row_count = count($rows);
    if($row_count== 1):
        ?>
        <div class="gallery">
            <?php
            // loop through the rows of data
            $w=1;
            while ( have_rows('images') ) : the_row();
                $image = get_sub_field('image');
                ?>
                <?php if($w == 1 || $w == 5 || $w == 6 || $w == 7):?>
                    <div class="gallery-holder">
                <?php endif;?>

                <div class="gallery-image<?php if($w == 5 || $w == 6):?>-full<?php endif;?>" style="background-image: url(<?php echo $image['url'];?>)">
                    <?php if(get_sub_field('title')):?>
                        <div class="info">
                            <h2><?php the_sub_field('title');?></h2>
                        </div>
                    <?php endif;?>
                </div>

                <?php if($w == 4 || $w == 5 || $w == 6 || $w == 10):?>
                    </div><!--End Gallery Section-->
                <?php endif; ?>
                <?php
                $w++;
                if($w == 11): $w = 1; endif;
            endwhile;
            ?>
        </div>
    <?php else:?>
        <div class="gallery">
            <?php
            // loop through the rows of data
            $w=1;
            while ( have_rows('images') ) : the_row();
                $image = get_sub_field('image');
                ?>
                <?php if($w == 1 || $w == 5 || $w == 6 || $w == 7):?>
                    <div class="gallery-holder">
                <?php endif;?>

                <div class="gallery-image<?php if($w == 5 || $w == 6):?>-full<?php endif;?>" style="background-image: url(<?php echo $image['url'];?>)">
                    <?php if(get_sub_field('title')):?>
                        <div class="info">
                            <h2><?php the_sub_field('title');?></h2>
                        </div>
                    <?php endif;?>
                </div>

                <?php if($w == 4 || $w == 5 || $w == 6 || $w == 10):?>
                    </div><!--End Gallery Section-->
                <?php endif; ?>
                <?php
                $w++;
                if($w == 11): $w = 1; endif;
            endwhile;
            ?>
        </div>
    <?php endif;?>
</div>