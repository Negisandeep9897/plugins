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

$button_link_nofollow = $settings->button_link_nofollow;

if($settings->button_link_nofollow === 'yes'){
	$nofollow = 'rel="nofollow"';
}

if($settings->button_link_target === '_blank'){
	$link_target = 'target='.$settings->button_link_target;
}

if(!empty($settings->bg_color)){
	$rgba =  mb_substr($settings->bg_color, 0, 4);
	if($rgba === 'rgba'){
		$bg_color = $settings->bg_color;
	}else{
		$bg_color = '#'.$settings->bg_color;
	}
	echo '<style>
		.sig-service-card .service-content{
		    background-color: '.$bg_color.';
		}
		</style>
	';
}

if(!empty($settings->bg_hover_color)){
	$rgba_hover =  mb_substr($settings->bg_hover_color, 0, 4);
	if($rgba_hover === 'rgba'){
		$bg_color_hover = $settings->bg_color;
	}else{
		$bg_color_hover = '#'.$settings->bg_color;
	}
	echo '<style>
		.sig-service-card:hover .service-content {
		    background-color: '.$bg_color_hover.';
		}
		</style>
	';
}

if(!empty($settings->button_text)){
	$button_text = $settings->button_text;
}else{
	$button_text = 'Learn More';
}

if(!empty($settings->min_height)):
	$height_class = $settings->bg_hover_image;
endif;

if(!empty($settings->title_spacing)): ?>
	<style>
	.sig-service-card.hi_<?php echo $parent_class;?> h3{
		letter-spacing: <?php echo $settings->title_spacing;?>;
	}
	</style>
<?php endif;

if(!empty($settings->column_alighment)){
	if($settings->column_alighment === 'start'){
		$padding_top = 'padding-top: 20px;';
	}else{
		$padding_top = '';
	}
	echo '<style>.sig-service-card.hi_'.$parent_class.' .service-content{ justify-content: '.$settings->column_alighment.'; '.$padding_top.'}</style>';
}
?>

<div class="sig-service-card dark text-center signature_build hi_<?php echo $parent_class;?>">
	<div class="image-zoom-wrapper">
		<?php if(!empty($settings->bg_hover_image)):
			$bg_hover_image = wp_get_attachment_url( $settings->bg_hover_image );?>
			<img src="<?php echo $bg_hover_image;?>" alt="image">
		<?php endif;?>
	</div>
	<div class="service-content">
		<div class="icon-box">
			<?php if(!empty($settings->icon)):
				$icon = wp_get_attachment_url( $settings->icon );?>
				<img src="<?php echo $icon;?>" alt="image" <?php echo $icon_width;?>>
			<?php endif;?>
		</div>
		<div class="text-box">
			<?php if(!empty($settings->title)):?>
				<h3><?php echo $settings->title;?></h3>
			<?php endif;?>
			<?php if(!empty($settings->text)):?>
				<p><?php echo $settings->text;?></p>
			<?php endif;?>
			<?php if(!empty($settings->button_link)):?>
				<a class="read-more-cta" href="<?php echo $settings->button_link;?>" <?php echo $link_target.' '.$nofollow; ?>><?php echo $button_text;?>&nbsp;<i class="fa-solid fa-angles-right"></i></a>
			<?php endif;?>
		</div>
	</div>
</div>