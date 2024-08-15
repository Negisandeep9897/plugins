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

$class = array();
$clas = array();
 
if(!empty($settings->number)){
    $number = $settings->number;
}else{
    $number = '';
}

if(!empty($settings->bottom_space)){
    $class[] = 'margin-bottom:'.$settings->bottom_space;
}

if(!empty($settings->number_title)){
    $number_title = $settings->number_title;
}else{
    $number_title = '';
}

if(!empty($settings->bg_color)){
	$rgba =  mb_substr($settings->bg_color, 0, 4);
	if($rgba === 'rgba'){
		$bg_color = 'background:'.$settings->bg_color;
	}else{
		$bg_color = 'background:#'.$settings->bg_color;
	}
}

foreach($class as $classes){
	$clas[] = 'style="'.$classes.'"';
}
?>
<style>
	.<?php echo $parent_class;?> h3{
		<?php
		if(!empty($settings->letter_space)){
			echo 'letter-spacing:'.$settings->letter_space;
		}
		?>
	}
</style>
<div class="<?php echo $parent_class;?> Programs_head" <?php echo $clas[0];?>>
<div class="numberbox"><?php echo $number;?></div>
<h3><?php echo $number_title;?></h3>
</div>