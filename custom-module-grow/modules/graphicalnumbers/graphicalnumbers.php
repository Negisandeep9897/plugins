<?php
/**
 * This is an example module that uses the TwentyTwenty jQuery plugin.
 *
 * @class TwentyTwentyExampleModule
 */
class GraphicalNumbersModule extends FLBuilderModule {

	/**
	 * The module construct, we need to pass some basic info here.
	 */
	public function __construct() {

		parent::__construct(array(
			'name'            => __( 'Graphical Numbers', 'fl-builder' ),
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
 * We are using a very simple form here with only two options, photo_one and photo_two.
 */
FLBuilder::register_module( 'GraphicalNumbersModule', array(
	'general' => array(
		'title' => __( 'General', 'fl-builder' ),
		'sections' => array(
			'general' => array(
				'title' => __( 'Section Title', 'fl-builder' ),
				'fields' => array(
					'number' => array(
						'type' => 'text',
						'label' => __( 'Number', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'number_title' => array(
						'type' => 'text',
						'label' => __( 'Title', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
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
					'bottom_space' => array(
						'type' => 'text',
						'label' => __( 'Bottom Space', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'letter_space' => array(
						'type' => 'text',
						'label' => __( 'Letter Space', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
				),
			),
		),
	),
));
