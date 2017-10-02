<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 9/22/2017
 * Time: 10:58 AM
 */

$table_title = get_sub_field('table_title');
$default_open = get_sub_field('default_open');
$add_table = get_sub_field('add_table');
?>
<div class="flex-content section small">
    <div class="grid-container">
        <div class="table-wrapper <?=$default_open?"open":"closed";?>">
            <?= $table_title ? "<h3 class='table-title'>$table_title <i class='dt-chevron'></i> </h3>" : ""; ?>
            <?= $add_table ? "<div class='table-content'>$add_table</div>" : ""; ?>
        </div>
    </div>
</div>

