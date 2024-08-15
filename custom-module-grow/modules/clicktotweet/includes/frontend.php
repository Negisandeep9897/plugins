<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 */


if(!empty($settings->text)){
	$text = $settings->text;
}

if(!empty($settings->hashtags)){
	$hashtags = '&hashtags='.$settings->hashtags;
}

if(!empty($settings->border_color)){
	$border_color = $settings->border_color;
}else{
	$border_color = '#000';
}

if(!empty($settings->border_left)){
	$border_left = 'border-left:'.$settings->border_left.' solid #' .$border_color;
}

if(!empty($settings->button_text)){
	$button_text = $settings->button_text;
}

if(!empty($settings->bg_color)){
	$rgba =  mb_substr($settings->bg_color, 0, 4);
	if($rgba === 'rgba'){
		$bg_color = 'background:'.$settings->bg_color;
	}else{
		$bg_color = 'background-color: #'.$settings->bg_color;
	}
}

if(!empty($settings->text_color)){
	$text_rgba =  mb_substr($settings->text_color, 0, 4);
	if($text_rgba === 'rgba'){
		$text_color = $settings->text_color;
	}else{
		$text_color = '#'.$settings->text_color;
	}
}
global $wp;
$url = home_url( $wp->request );
$button_link = 'https://twitter.com/intent/tweet?url='.$url.'&text='.urlencode($text).'.'.$hashtags;
?>

<div class="tweet-wrapper" style="<?php echo $bg_color.' '.$border_left; ?>">							
	<p style="color:<?php echo $text_color; ?>"><?php echo $text;?></p>
	<a href="<?php echo $button_link;?>" target="_blank"> <?php echo $button_text;?> <i class="fa-brands fa-twitter"></i></a>
</div>