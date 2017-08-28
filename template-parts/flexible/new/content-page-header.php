<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 8/28/2017
 * Time: 1:53 AM
 */

$page_header_background_image = get_field('page_header_background_image' , 'option');
$page_header_background_imageURL = $page_header_background_image['url'];
$heading = get_sub_field('heading');
?>
<div class="page-header"
<?php if($page_header_background_image):
echo "style='background-image:url($page_header_background_imageURL);'";
endif; ?>
>
    <div class="grid-container">
        <h1 class="page heading"><?=$heading;?></h1>
    </div>
</div>
