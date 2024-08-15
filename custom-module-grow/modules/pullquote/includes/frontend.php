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

echo '<style>';
	?>
		.<?php echo $id;?> pullquote .quote-inner p, .<?php echo $id;?> pullquote .quote-inner{
			<?php if($settings->font_size){ ?>
				font-size: <?php echo $settings->font_size;?>;
			<?php
			}
			if(!empty($settings->color)){
				$rgba =  mb_substr($settings->color, 0, 4);
				if($rgba === 'rgba'){
					echo 'color: '.$settings->color;
				}else{
					echo 'color:#'.$settings->color;
				}
			}
			?>
		}
	<?php
	
	if(!empty($settings->width)){ ?>
		.<?php echo $id;?> pullquote{
			width: <?php echo $settings->width;?>;
		}
	<?php
	}
	
	if($settings->text_align == 'left'){ ?>
		.<?php echo $id;?> pullquote{
			text-align: left;
		}
	<?php	
	}elseif($settings->text_align == 'center'){ ?>
		.<?php echo $id;?> pullquote .quote-inner{
			text-align: center; 
		}
	<?php	
	}elseif($settings->text_align == 'right'){ ?>
		.<?php echo $id;?> pullquote .quote-inner{
			text-align: 'right';
		}
	<?php	
	}
	
	if($settings->font_weight){ ?>
		.<?php echo $id;?> pullquote .quote-inner{
			font-weight: <?php echo $settings->font_weight?>;
		}
	<?php
	}
	
	if($settings->letter_spacing){ ?>
		.<?php echo $id;?> pullquote .quote-inner{
			letter-spacing: <?php echo $settings->letter_spacing?>;
		}
	<?php
	}
	
	if(!empty($settings->border_color)){
		$rgba =  mb_substr($settings->border_color, 0, 4);
		if($rgba === 'rgba'){
			$border_color = $settings->border_color;
		}else{
			$border_color = '#'.$settings->border_color;
		}
	}
	if($settings->top_spacing){
		$top = $settings->top_spacing;
	}else{
		$top = '60px';
	}
	if($settings->right_spacing){
		$right = $settings->right_spacing;
	}else{
		$right = '10px';
	}
	if($settings->bottom_spacing){
		$bottom = $settings->bottom_spacing;
	}else{
		$bottom = '60px';
	}
	if($settings->left_spacing){
		$left = $settings->left_spacing;
	}else{
		$left = '10px';
	}
	if($settings->border_width){
		$border = $settings->border_width;
	}
	
	echo '.'.$id;?> pullquote {
		padding: <?php echo $top.' '.$right.' '.$bottom.' '.$left;?>;
		display: block;
		border-top: <?php echo $border;?> solid <?php echo $border_color;?>;
		border-bottom: <?php echo $border;?> solid <?php echo $border_color;?>;
		margin: 0 auto;
	}
	
	<?php
echo '</style>';

if(!empty($settings->text)){
	$text = $settings->text;
}
?>
<div class="pullquote_sec <?php echo $id;?>">
	<pullquote>
		<div class="quote-inner">	
			<?php echo $text;?>
		</div>
	</pullquote>
</div>