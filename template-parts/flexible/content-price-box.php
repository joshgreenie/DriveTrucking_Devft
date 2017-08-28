<?php
$title          = get_sub_field('title');
$description    = get_sub_field('description');
$title_type     = get_sub_field('title_type');
$color          = get_sub_field('color');
?>
<div class="color-content-<?php echo $color;?>">
    <div class="wrapper">
        <<?php echo $title_type;?>><?php echo $title;?></<?php echo $title_type;?>>
    <?php echo $description;?>

    <?php
    $pricebox = get_sub_field('price_box');
    $row_count = count($pricebox);

    if( have_rows('price_box') ):
        while ( have_rows('price_box') ) : the_row();
            // loop through the rows of data
            $title                  = get_sub_field('title');
            $highlight_color        = get_sub_field('highlight_color');
            $highlighted            = get_sub_field('highlighted');
            $product_price          = get_sub_field('product_price');
            $price                  = get_sub_field('price');
            $wooproduct_variation_id= get_sub_field('woo_product_variation_id');
            $woocommerce_product_id = get_sub_field('woocommerce_product_id');
            $price_period           = get_sub_field('price_period');
            $pricebox_description   = get_sub_field('pricebox_description');
            $link                   = get_sub_field('link');
            $link_text              = get_sub_field('link_text');
            ?>
            <div class="price-box-wrapper <?php echo figuregrid('grid', $row_count);?> <?php if($highlighted):?>highlighted<?php endif;?>">
                <h3 class="<?php echo $highlight_color;?>"><?php echo $title;?></h3>
                <?php if($product_price == "type"):?>
                    <div class="price <?php echo $highlight_color;?>">
                        $<?php echo $price;?>
                        <p>per <?php echo $price_period;?></p>
                    </div>
                <?php elseif($product_price == "woo_variable"):?>
                    <?php $variable_product = get_product_variation_price( $wooproduct_variation_id );?>
                    <div class="price <?php echo $highlight_color;?>">
                        $<?php echo $variable_product;;?>
                        <p>per <?php echo $price_period;?></p>
                    </div>
                <?php elseif($product_price == "woo_product"):?>
                    <?php $get_product_product = get_product_price( $woocommerce_product_id );?>
                    <div class="price <?php echo $highlight_color;?>">
                        $<?php echo $get_product_product;;?>
                        <p>per <?php echo $price_period;?></p>
                    </div>
                <?php elseif($product_price == "free"):?>
                    <div class="price <?php echo $highlight_color;?>">
                        <?php _e("Free");?>
                        <p><?php _e('Membership')?></p>
                    </div>
                <?php elseif($product_price == "no-pricing"):?>
                    <div class="price <?php echo $highlight_color;?>">
                        <?php _e("Contact Us");?>
                        <p><?php _e('to donate to JSRI')?></p>
                    </div>
                <?php endif;?>
                <?php if($pricebox_description):?>
                    <div class="description">
                        <?php echo $pricebox_description;?>
                    </div>
                <?php endif;?>

                <?php if( have_rows('list') ):?>
                    <div class="list">
                        <ul>
                            <?php while ( have_rows('list') ) : the_row(); ?>
                                <li><?php the_sub_field('list_item');?></li>
                            <?php endwhile;?>
                        </ul>
                    </div>
                <?php endif;?>
                <a class="button-blue" href="<?php echo $link;?>">
                    <?php echo $link_text;?>
                </a>
            </div>
        <?php endwhile;?>
    <?php endif; ?>
</div>
</div>