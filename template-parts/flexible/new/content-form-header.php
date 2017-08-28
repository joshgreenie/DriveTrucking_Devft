<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 8/24/2017
 * Time: 1:04 AM
 */


$form_shortcode = get_sub_field('form_shortcode');
$element_type = get_sub_field('element_type');
$map = get_sub_field('map');
$title = get_sub_field('title');
$main_content = get_sub_field('main_content');
$background_image = get_sub_field('background_image');
$background_image_url = $background_image['url'];

?>

<div class="form-header" style="<?php echo $background_image ? "background-image:url($background_image_url)" : ""; ?>">
    <div class="grid-container">
        <?php if ($main_content || $title || $map): ?>
        <div class="primary-content">
            <div class="grid-container">
                <<?= $element_type; ?> class="shelf-header"><?= $title; ?></<?= $element_type; ?>>
            <?php if ($map) { ?>
                <div id="vmap"></div>
                <script>
                    (function ($) {
                        $(document).ready(function () {
                            $('#vmap').vectorMap({
                                map: 'usa_en',
                                backgroundColor: 'transparent',
                                borderColor: '#fff',
                                borderWidth: 2,
                                color: '#124b7b',
                                hoverColor: '#F4911D',
                                enableZoom: false,
                                selectedRegions: null,
                                showTooltip: true,
                            });
                        });
                    })(jQuery);

                </script>
            <?php } elseif ($main_content) {
                echo "$main_content";
            } ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($form_shortcode): ?>
            <div class="grid-container mobile-form-wrap">
                <div class="form-content">
                    <div class="form-wrapper">
                        <?= $form_shortcode; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

