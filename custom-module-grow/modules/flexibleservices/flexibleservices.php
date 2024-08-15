<?php
/**
 * This is an example module that uses the TwentyTwenty jQuery plugin.
 *
 * @class SignatureServicesModule
 */
class FlexibleServicesModule extends FLBuilderModule {

	/**
	 * The module construct, we need to pass some basic info here.
	 */
	public function __construct() {

		parent::__construct(array(
			'name'            => __( 'Flexible Services', 'fl-builder' ),
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
FLBuilder::register_module( 'FlexibleServicesModule', array(
	'general' => array(
		'title' => __( 'General', 'fl-builder' ),
		'sections' => array(
			'general' => array(
				'title' => __( 'Box Content', 'fl-builder' ),
				'fields' => array(
					'number' => array(
						'type' => 'text',
						'label' => __( 'Number', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'number_bg_color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Number Background Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'refresh',
						),
					),
					'title' => array(
						'type' => 'text',
						'label' => __( 'Title', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'bg_title' => array(
						'type' => 'text',
						'label' => __( 'Background Title', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'bg_color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Sub Title Background Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'refresh',
						),
					),
					'text' => array(
						'type' => 'editor',
						'label' => __( 'Text', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
				),
			),
		),
	),
));
