<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 8/28/2017
 * Time: 2:08 AM
 */


$background_image = get_sub_field('background_image');
$background_imageURL = $background_image['url'];
$heading = get_sub_field('heading');
$sub_heading = get_sub_field('sub_heading');
$form = get_sub_field('form');

?>

<div class="form-shelf">
    <div class="grid-container">
        <div class="form-shelf-wrapper">
            <div class="form-shelf-header blue-chevron-faded"
                <?php if ($background_image):
                    echo "style='background-image:url($background_imageURL);'";
                endif; ?>>
                <div class="heading-wrap">
                    <?= $heading ? "<h2 class='heading'>$heading</h2>" : ""; ?>
                    <?= $sub_heading ? "<p class='sub-heading'>$sub_heading</p>" : ""; ?>
                </div>
            </div>
            <div class="form-content">
                <?= $form; ?>
            </div>
        </div>
        <div class="form-section-footer">
            <div class="form-inner-footer"></div>
        </div>
    </div>
</div>
