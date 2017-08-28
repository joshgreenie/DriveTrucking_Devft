<?php
$file                   = get_sub_field('file');
$button_color           = get_sub_field('button_color');
$download_link_text     = get_sub_field('download_link_text');
$color                  = get_sub_field('color');
$title                  = get_sub_field('title');
$title_type             = get_sub_field('title_type');
$description            = get_sub_field('description');
$background_image       = get_sub_field('background_image');
$min_height             = get_sub_field('min_height');
?>
<div class="color-content-<?php echo $color;?>" style="<?php if($background_image):?>background-image: url('<?php echo get_template_directory_uri()?>/images/<?php echo $color;?>-bg-overlay.png'), url(<?php echo $background_image['url']?>);<?php endif;?><?php if($min_height):?> min-height:<?php echo $min_height;?>px <?php endif;?>">
    <div class="wrapper">
        <?php if($title):?><<?php echo $title_type;?>><?php echo $title;?></<?php echo $title_type;?>><?php endif;?>
    <?php if($description):?>
        <?php echo $description;?>
    <?php endif;?>
    <?php if($file):?>
        <a href="<?php echo $file;?>" class="button-<?php echo $button_color;?>"><?php echo $download_link_text;?></a>
    <?php endif;?>
    </div>
</div>
