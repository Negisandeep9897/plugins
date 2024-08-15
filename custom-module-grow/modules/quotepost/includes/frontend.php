<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 */

$id = 'pullquote_'.$module->node;

if(!empty($settings->text)){
	$text = $settings->text;
}

if(!empty($settings->color)){
	$color = $settings->color;
}else{
    $color = '#1B79CF';
}
?>
<style>
.<?php echo $id;?>.summery-quote {
    border-left: 2px solid <?php echo $color;?>;
}
</style>
<div class="<?php echo $id;?> summery-quote">
	<div class="quote-inner">	
		<h4 style="color: <?php echo $color;?>"><?php echo $text;?></h4>
	</div>
</div>