<?php
/**
 * This is an example module that uses the TwentyTwenty jQuery plugin.
 *
 * @class SignatureServicesModule
 */
class ClicktoTweetModule extends FLBuilderModule {

	/**
	 * The module construct, we need to pass some basic info here.
	 */
	public function __construct() {

		parent::__construct(array(
			'name'            => __( 'Click to Tweet Module', 'fl-builder' ),
			'description'     => __( 'A custom module can be use anywhere.', 'fl-builder' ),
			'category'        => __( 'Custom Module', 'fl-builder' ),
			'dir'             => __DIR__,
			'partial_refresh' => true,
			'url'             => plugins_url( '', __FILE__ ),
		));

	}
}

/**
 * Register the module and its form settings.
 * We are using a very simple form here with only two options, photo_one and photo_two.
 */
FLBuilder::register_module( 'ClicktoTweetModule', array(
	'general' => array(
		'title' => __( 'General', 'fl-builder' ),
		'sections' => array(
			'general' => array(
				'title' => __( 'Box Content', 'fl-builder' ),
				'fields' => array(
					'button_text' => array(
						'type' => 'text',
						'label' => __( 'Button Text', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'text' => array(
						'type' => 'textarea',
						'label' => __( 'Text', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'hashtags' => array(
						'type' => 'textarea',
						'label' => __( 'Hashtags', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'border_left' => array(
						'type' => 'select',
						'label' => __( 'Border Left', 'fl-builder' ),
						'options' => array(
							'1px'   => _x( '1px', 'fl-builder' ),
							'2px'   => __( '2px', 'fl-builder' ),
							'3px' => __( '3px', 'fl-builder' ),
							'4px' => __( '4px', 'fl-builder' ),
							'5px' => __( '5px', 'fl-builder' ),
							'6px' => __( '6px', 'fl-builder' ),
							'7px' => __( '7px', 'fl-builder' ),
						),
						'preview' => array(
							'type' => 'none',
						),
					),
					'border_color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Border Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'refresh',
						),
					),
					'bg_color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'refresh',
						),
					),
					'text_color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Text Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'refresh',
						),
					),
				),
			),
		),
	),
));