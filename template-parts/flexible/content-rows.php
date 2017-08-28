<?php
//Get Content Block Variables
$rows               = get_sub_field('row');
$background_image   = get_sub_field('background_image');
$text_align         = get_sub_field('text_align');
$color              = get_sub_field('background_color');
?>
<div class="color-content-<?php echo $color;?>" <?php if($background_image):?>style="background-image: url('<?php echo get_template_directory_uri()?>/images/<?php echo $color;?>-bg-overlay.png'), url(<?php echo $background_image['url']?>);" <?php endif;?> >
<?php if( have_rows('row') ):
    // loop through the rows of data
    while ( have_rows('row') ) : the_row();?>
        <div class="grid-container">
        <?php
            if(have_rows('content_columns')):
            // loop through the rows of data
            $rows_content_columns = get_sub_field('content_columns');
            $row_count = count($rows_content_columns);
            while( have_rows('content_columns')) : the_row();
                $icon                           = get_sub_field('icon');
                $header                         = get_sub_field('title');
                $header_type                    = get_sub_field('title_type');
                $content                        = get_sub_field('content');
                $content_color                  = get_sub_field('content_color');
                $content_background_image       = get_sub_field('content_background_image');
                ?>
                <div class="<?php echo figuregrid('grid', $row_count); echo " ".$text_align;?>">
                    <?php if($icon || $icon!='none'):?><div class="icon-<?php echo $icon;?>"></div><?php endif;?>
                    <?php if($header):?><<?php echo $header_type;?>><?php echo $header;?></<?php echo $header_type;?>><?php endif;?>
                    <?php if($content):?><p><?php echo $content;?></p><?php endif;?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

    <?php endwhile;
endif;?>
</div>