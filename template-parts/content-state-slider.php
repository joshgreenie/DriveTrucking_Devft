<?php
$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;

$content = get_field('content', $queried_object);
?>

<div class="iframe-state">
    <?php if($content):
    echo $content;
    else: ?>
        <iframe width="1200" height="260"
                src="https://datastudio.google.com/embed/reporting/0B3e6X_7_uUMpeGhTOE90eERrMGc/page/jAAI" frameborder="0"
                style="border:0" allowfullscreen></iframe>
    <?php endif;?>

</div>
