<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 8/25/2017
 * Time: 1:53 PM
 */


$element_type = get_sub_field('element_type');
$title = get_sub_field('title');
$main_content = get_sub_field('content');
$background_image = get_sub_field('background_image');
$background_image_url = $background_image['url']; ?>

<div class="split-chevron" style="<?=$background_image?"background-image: url($background_image_url);":"";?>">
    <div class="grid-container">
        <div class="split-content-right">
            <?=$title ? "<$element_type class='heading'>$title</$element_type>" : "" ;?>
            <?=$main_content ? "$main_content" : "" ;?>
        </div>
    </div>
</div>

