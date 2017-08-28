<?php
$form               = get_sub_field('form');
$color              = get_sub_field('background_color');
$form_title         = get_sub_field('form_title');
$title_type         = get_sub_field('title_type');
$form_description   = get_sub_field('form_description');
if( $form ):?>
    <?php if($first == false):?>
        <?php get_template_part('dividers/divider', $color);?>
    <?php  endif;?>
    <div class="color-content-<?php echo $color;?>">
        <div class="wrapper">
            <?php if($form_title):?><<?php echo $title_type;?>><?php echo $form_title;?></<?php echo $title_type;?>><?php endif;?>
            <?php if($form_description):?>
                <?php echo $form_description;?>
            <?php endif;?>
            <?php
            ?>
        </div>
    </div>
<?php endif;?>
