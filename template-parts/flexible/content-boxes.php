<?php
//Get Content Block Variables
$color              = get_sub_field('color');
$background_image   = get_sub_field('background_image');
$min_height         = get_sub_field('minimum_height');
$max_per_row        = get_sub_field('max_per_row');
$grid_or_span       = get_sub_field('grid_or_span');
?>
<div class="color-content-<?php echo $color;?>" style="<?php if($background_image):?>background-image: url('<?php echo get_template_directory_uri()?>/images/<?php echo $color;?>-bg-overlay.png'), url(<?php echo $background_image['url']?>);<?php endif;?><?php if($min_height):?> min-height:<?php echo $min_height;?>px <?php endif;?>">
    <div class="wrapper">
    <?php if( have_rows('boxes') ):
        // loop through the rows of data
        ?>
            <?php
            $rows = get_sub_field('boxes');
            $row_count = count($rows);
            while ( have_rows('boxes') ) : the_row();
                $title                  = get_sub_field('title');
                $title_type             = get_sub_field('title_type');
                $alignment              = get_sub_field('text_align');
                $content_box            = get_sub_field('content_box');
                $box_color              = get_sub_field('box_color');
                $box_background_image   = get_sub_field('box_background_image');
                ?>
                <div class="boxes <?php echo figuregrid($grid_or_span, $max_per_row);?> color-content-<?php echo $box_color;?> ta-<?php echo $alignment;?>" style="<?php if($box_background_image):?>background-image: url('<?php echo get_template_directory_uri()?>/images/<?php echo $box_color;?>-bg-overlay.png'), url(<?php echo $box_background_image['url']?>);<?php endif;?>">
                    <<?php echo $title_type;?>><?php echo $title?></<?php echo $title_type;?>>
                    <?php echo $content_box;?>
                </div>
                <?php
            endwhile;
            ?>
        <?php
    endif;
    ?>
    </div>
</div>