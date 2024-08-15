<?php
/**
 * This is an example module that uses the beaver builder plugin.
 *
 * @class BackgroundHoverEffectWithTextImage
 */
class JohnyJohnyCustomModule extends FLBuilderModule {

	/**
	 * The module construct, we need to pass some basic info here.
	 */
	public function __construct() {

		parent::__construct(array(
			'name'            => __( 'Hover effect with text/image', 'fl-builder' ),
			'description'     => __( 'An custom module can use anywhere.', 'fl-builder' ),
			'category'        => __( 'Custom Module', 'fl-builder' ),
			'dir'             => __DIR__,
			'partial_refresh' => true,
			'url'             => plugins_url( '', __FILE__ ),
		));

	}
}

/**
 * Register the module and its form settings.
 * We are using here background image overlay effects that you can use very easily.
 */
FLBuilder::register_module( 'JohnyJohnyCustomModule', array(
	'general' => array(
		'title' => __( 'General', 'fl-builder' ),
		'sections' => array(
			'general' => array(
				'title' => __( 'Section Title', 'fl-builder' ),
				'fields' => array(
					'photo_one' => array(
						'type' => 'photo',
						'label' => __( 'Background Image', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'hover_settings' => array(
						'type' => 'select',
						'label' => __( 'Enabled/Disabled', 'fl-builder' ),
						'options' => array(
							'enabled'     => __( 'Enabled', 'fl-builder' ),
							'disabled' => __( 'Disabled', 'fl-builder' ),
						),
					),
					'text_with_image' => array(
						'type' => 'editor',
						'label' => __( 'Text', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'text_line_height' => array(
						'type' => 'text',
						'label' => __( 'Text Line Height example: 24px', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'text_spacing' => array(
						'type' => 'text',
						'label' => __( 'Spacing example: 1px', 'fl-builder' ),
					),
					'description' => array(
						'type' => 'editor',
						'label' => __( 'Description', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'button_link' => array(
						'type' => 'link',
						'label' => __( 'Button Link', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'bg_color_overlay'  => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Overlay Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'refresh',
						),
					),
					'padding_top' => array(
						'type' => 'text',
						'label' => __( 'Top', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'padding_right' => array(
						'type' => 'text',
						'label' => __( 'Right', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'padding_bottom' => array(
						'type' => 'text',
						'label' => __( 'Bottom', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'padding_left' => array(
						'type' => 'text',
						'label' => __( 'Left', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),

					'vertical_alignment' => array(
						'type' => 'select',
						'label' => __( 'Vertical Alignment', 'fl-builder' ),
						'default'       => 'middle',
						'options' => array(
							'top'     => __( 'Top', 'fl-builder' ),
							'middle' => __( 'Middle', 'fl-builder' ),
							'bottom' => __( 'Bottom', 'fl-builder' ),
						),
					),
				),
			),
		),
	),
));