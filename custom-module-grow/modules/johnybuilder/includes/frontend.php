<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 * Hover effect with text/image
 */

$parent_class = 'prob_'.$module->parent;

$hover_settings = $settings->hover_settings;
$text_line_height = $settings->text_line_height;


$image_id = $settings->photo_one;

if(!empty($settings->photo_one_src)){
	$attachment_image = $settings->photo_one_src;
}

if(!empty($image_id)){
	$parent_class_css = '.parent_'.$image_id;
	//$parent_class = 'parent_'.$image_id;
}

if(!empty($settings->text_with_image)){
    $text_with_image = $settings->text_with_image;
}else{
    $text_with_image = '';
}

//echo wp_get_attachment_url( $settings->photo_one );

if(!empty($settings->bg_color_overlay)){
	$rgba =  mb_substr($settings->bg_color_overlay, 0, 4);
	if($rgba === 'rgba'){
		$bg_color_overlay = $settings->bg_color_overlay;
	}else{
		$bg_color_overlay = '#'.$settings->bg_color_overlay;
	}
}

if(!empty($bg_color_overlay)):
?>
<style>
	<?php echo '.'.$parent_class;?> .hover-box .image-wrapper:before{
		background-color: <?php echo $bg_color_overlay;?>
	}
</style>
<?php 
endif;

$padding_top = $settings->padding_top;
$padding_right = $settings->padding_right;
$padding_bottom = $settings->padding_bottom;
$padding_left = $settings->padding_left;

$style_class = array();

$vertical_alignment = $settings->vertical_alignment;
if($vertical_alignment == 'top'){
	$vertical_alignment = 'align-items:flex-start';
}else if($vertical_alignment == 'middle'){
	$vertical_alignment = 'align-items:center';
}else if($vertical_alignment == 'bottom'){
	$vertical_alignment = 'align-items:flex-end';
}

if(!empty($padding_top) || !empty($padding_right) || !empty($padding_bottom) || !empty($padding_left)){
	if(!empty($padding_top)){
		$padding_top = $settings->padding_top;
	}else{
		$padding_top = '0px';
	}
	
	if(!empty($padding_right)){
		$padding_right = $settings->padding_right;
	}else{
		$padding_right = '0px';
	}

	if(!empty($padding_bottom)){
		$padding_bottom = $settings->padding_bottom;
	}else{
		$padding_bottom = '0px';
	}

	if(!empty($padding_left)){
		$padding_left = $settings->padding_left;
	}else{
		$padding_left = '0px';
	}
	?>
	<style>
	.image_zooms .hover-box {
		padding: 0px;
	}
	</style>
	<?php
	$style_class[] = 'padding: '.$padding_top.' '.$padding_right.' '.$padding_bottom.' '.$padding_left;
	$style_class[] = $vertical_alignment;
}
$class = array();
foreach ($style_class as $value) {
	$class[]	= $value;
}
if($hover_settings == 'disabled'){
	?>
	<style>
	<?php echo '.'.$parent_class;?> .hover-box:hover .image-wrapper img {
	    transform: inherit;
	}
	</style>
<?php 
}
?>
	<style>
		<?php echo '.'.$parent_class;?> .box-content p {
			<?php
			if(!empty($text_line_height)){
			?>
		    	line-height: <?php echo $text_line_height;?>;
		    <?php
			}
		    if(!empty($settings->text_spacing)){
		    ?>
		     	letter-spacing: <?php echo $settings->text_spacing;?>;
		   	<?php
			}
			?>
		}
	</style>
<div class="fl-custom-builder image_zooms <?php echo $parent_class; ?>">
    <div class="hover-box image-card-box">
        <?php if(!empty($settings->photo_one)):?>
            <div class="image-wrapper">
                <img src="<?php echo $attachment_image; ?>" alt="image">
            </div>
        <?php endif;?>
        <div class="box-content" style="<?php echo implode(';', $class);?>">
            <div class="top-content">
                <?php echo $text_with_image; ?>
            </div>
            <?php if(!empty($settings->button_link)):?>
                <div class="bottom-content text-right">
                    <a href="<?php echo $settings->button_link; ?>" class="read-more-cta">Read More <i class="fa-solid fa-angles-right"></i></a>
                </div>
            <?php endif;?>
        </div>
    </div>
    <?php if(!empty($settings->description)):?>
	    <div class="description_content">
	    	<?php echo $settings->description;?>
	    </div>
	<?php endif;?>
</div>