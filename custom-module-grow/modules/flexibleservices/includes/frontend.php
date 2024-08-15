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

if(!empty($settings->title)){
	$title = $settings->title;
}

$number = $settings->number;
$bg_title = $settings->bg_title;
$text = $settings->text;

if(!empty($settings->bg_color)){
	$rgba =  mb_substr($settings->bg_color, 0, 4);
	if($rgba === 'rgba'){
		$bg_color = $settings->bg_color;
	}else{
		$bg_color = '#'.$settings->bg_color;
	}
	echo '<style>
		.'.$parent_class.' .fl-rbn{
		    background-color: '.$bg_color.';
		}
		</style>
	';
}

if(!empty($settings->number_bg_color)){
	$rgba =  mb_substr($settings->number_bg_color, 0, 4);
	if($rgba === 'rgba'){
		$number_bg_color = $settings->number_bg_color;
	}else{
		$number_bg_color = '#'.$settings->number_bg_color;
	}
	echo '<style>
		.'.$parent_class.' .fl-service-head .count-num{
		    background-color: '.$number_bg_color.';
		}
		</style>
	';
}
?>

<div class="fl-service-card-wrapper <?php echo $parent_class;?>">
	<div class="fl-service-head">
		<div class="count-num"><?php echo $number;?></div>
		<h3 class="service-title"><?php echo $title;?></h3>
	</div>
	<div class="fl-rbn"><?php echo $bg_title;?></div>
	<div class="fl-service-content">
		<?php echo $text;?>
	</div>
</div>