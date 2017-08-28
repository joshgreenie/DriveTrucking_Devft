<?php
// Set Variables
$video_type = get_sub_field('video_type');
$background_color = get_sub_field('background_color');
$video_title = get_sub_field('video_title');
$title_type = get_sub_field('title_type');
$video_description = get_sub_field('video_description');

if( $video_type == 'embed' ):

// Set Variables
$video_embed = get_sub_field('video_embed');
?>
<div class="color-content-<?php echo $background_color;?>">
    <div class="wrapper">
        <?php if($video_title):?><<?php echo $title_type;?>><?php echo $video_title;?></<?php echo $title_type;?>><?php endif;?>
        <?php if($video_description):?>
            <?php echo $video_description;?>
        <?php endif;?>
        <?php echo $video_embed;?>
    </div>
</div>
<?php elseif( $video_type == 'background_video' ):

//Set Varialbes
$mp4_video = get_sub_field('mp4_video');
$ovg_video = get_sub_field('ovg_video');
$webm_video = get_sub_field('webm_video');
$video_poster = get_sub_field('video_poster');
$title_type = get_sub_field('title_type');
?>
<div class="color-content-<?php echo $background_color;?>">
    <?php if($video_title):?><<?php echo $title_type;?>><?php echo $video_title;?></<?php echo $title_type;?>><?php endif;?>
    <?php if($video_description):?>
        <?php echo $video_description;?>
    <?php endif;?>
    <?php echo $form;?>
    <div class="video-container">
        <video class="video" poster="<?php echo $video_poster;?>" autoplay loop>
            <?php if($mp4_video):?><source src="<?php echo $mp4_video;?>" type="video/mp4"><?php endif; ?>
            <?php if($ovg_video):?><source src="<?php echo $ovg_video;?>" type="video/ogg"><?php endif;?>
            <?php if($webm_video):?><source src="<?php echo $webm_video;?>" type="video/webm"><?php endif;?>
            Your browser does not support the video tag.
        </video>
    </div>
</div>
<?php endif;?>