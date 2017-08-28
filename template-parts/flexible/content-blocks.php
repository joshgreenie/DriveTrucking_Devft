<?php
//Get Content Block Variables
$title              = get_sub_field('title');
$content_box        = get_sub_field('content_box');
$color              = get_sub_field('color');
$background_image   = get_sub_field('background_image');
$min_height         = get_sub_field('minimum_height');
$title_type         = get_sub_field('title_type');
$short_block        = get_sub_field('short_block');
$color_overlay      = get_sub_field('color_overlay');
?>
<div class="color-content-<?php echo $color;?><?php if($short_block):?>-short<?php endif;?>" style="
    <?php if($color_overlay == true):
        if($background_image):?>
            background-image: url('<?php echo get_template_directory_uri()?>/images/<?php echo $color;?>-bg-overlay.png'), url(<?php echo $background_image['url']?>);
        <?php endif;?>
    <?php else:?>
        <?php if($background_image):?>
            background-image: url(<?php echo $background_image['url']?>);
        <?php endif;?>
    <?php endif;?>

    <?php if($min_height):?> min-height:<?php echo $min_height;?>px <?php endif;?>">
    <div class="wrapper">
        <?php if($title):?>
        <<?php echo $title_type;?>><?php echo $title;?></<?php echo $title_type;?>>
    <?php endif;?>
    <?php echo $content_box;?>

    <?php
    $rows = get_sub_field('services');
    $row_count = count($rows);

    if( have_rows('services') ):
        // loop through the rows of data
        ?>
        <div class="grid-container">
            <?php
            while ( have_rows('services') ) : the_row();
                ?>
                <?php $showcase_image = get_sub_field('service');?>
                <div class="service <?php echo figuregrid('span', $row_count);?>">
                    <span class="icon-<?php the_sub_field('service')?>"></span>
                    <h3><?php the_sub_field('service')?></h3>
                </div>

                <?php
            endwhile;
            ?>
        </div>
        <?php
    endif;
    ?>
</div>
</div>