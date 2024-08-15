<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 */

$parent_class = 'prob_'.$module->parent;

if(!empty($settings->grid_text)){
    $text = $settings->grid_text;
}else{
    $text = '';
}

$style_class = array();

if(!empty($settings->grid_bgcolor)){
	$rgba =  mb_substr($settings->grid_bgcolor, 0, 4);
	if($rgba === 'rgba'){
		$style_class[] = 'background:'.$settings->grid_bgcolor;
	}else{
		$style_class[] = 'background: #'.$settings->grid_bgcolor;
	}
}

if(!empty($settings->grid_bg_hover_color)){
	$rgba_hover =  mb_substr($settings->grid_bg_hover_color, 0, 4);
	if($rgba_hover === 'rgba'){
		$grid_bg_hover_color = 'background:'.$settings->grid_bg_hover_color.' !important; border-bottom: 0px;';

	}else{
		$grid_bg_hover_color = 'background: #'.$settings->grid_bg_hover_color.' !important; border-bottom: 0px;';
	}
}

if(!empty($settings->hover_text_color)){
	$rgba_hover =  mb_substr($settings->hover_text_color, 0, 4);
	if($rgba_hover === 'rgba'){
		$hover_text_color = 'color:'.$settings->hover_text_color.' !important;';

	}else{
		$hover_text_color = 'color: #'.$settings->hover_text_color.' !important;';
	}
}

if(!empty($settings->border_bottom_color)){
	$border_color =  mb_substr($settings->border_bottom_color, 0, 4);
	if($border_color === 'rgba'){
		$style_class[] = 'border-bottom-color:'.$settings->border_bottom_color;
	}else{
		$style_class[] = 'border-bottom-color: #'.$settings->border_bottom_color;
	}
}

/*if(!empty($settings->grid_content_height)){ 
	$style_class[] = 'min-height:'.$settings->grid_content_height;
}*/

$colors = array();
foreach ($style_class as $value) {
	$colors[]	= $value;
}

if(!empty($grid_bg_hover_color)):?>
	<style>
		<?php echo '.'.$parent_class;?>.prb-box:hover{
			<?php echo $grid_bg_hover_color;?>
		}
	</style>
<?php endif;

if(!empty($hover_text_color)):?>
	<style>
		<?php echo '.'.$parent_class;?>.prb-box:hover p {
		    <?php echo $hover_text_color;?>
		}
	</style>
<?php endif;?>

<div class="<?php echo $parent_class;?> prb-box" style="<?php echo implode(';', $colors);?>">
   <div class="prb-content">
		<?php if(!empty($text)):?>
			<p><?php echo $text;?></p>
		<?php endif;?>
		<?php if(!empty($settings->grid_link)): ?>
			<a href="<?php echo $settings->grid_link;?>" class="circle-icon-link"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/read-link-circle.svg" alt="image"></a>
		<?php endif;?>
   </div>
</div>