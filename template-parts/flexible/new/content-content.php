<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 9/22/2017
 * Time: 10:25 AM
 */

$column_count = get_sub_field('column_count');
?>
<div class="flex-content section">
    <div class="grid-container">
        <div class="coulmn-wrapper column-<?= $column_count; ?>">
            <?php if (have_rows('content_fields')):
                while (have_rows('content_fields')): the_row();
                    $content = get_sub_field('content'); ?>
                    <div class="flex-content-wrapper">
                        <?= $content ? "$content" : ""; ?>
                    </div>
                <?php endwhile;
            endif; ?>
        </div>
    </div>
</div>
