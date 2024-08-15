<?php
/**
 * This is an example module that uses the TwentyTwenty jQuery plugin.
 *
 * @class SignatureServicesModule
 */
class PullquoteModule extends FLBuilderModule {

	/**
	 * The module construct, we need to pass some basic info here.
	 */
	public function __construct() {

		parent::__construct(array(
			'name'            => __( 'Pull Quote Module', 'fl-builder' ),
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
FLBuilder::register_module( 'PullquoteModule', array(
	'general' => array(
		'title' => __( 'General', 'fl-builder' ),
		'sections' => array(
			'general' => array(
				'title' => __( 'Quote Content', 'fl-builder' ),
				'fields' => array(
					'text' => array(
						'type' => 'editor',
						'label' => __( 'Text', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
				),
			),
			'formatting' => array(
				'title' => __( 'Formatting', 'fl-builder' ),
				'fields' => array(
					'color'          => array(
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
					'border_width'          => array(
						'type'        => 'select',
						'label'       => __( 'Border Width', 'fl-builder' ),
						'default' => '1px',
						'options' => array(
							'1px' => '1px',
							'2px'  => '2px',
							'3px'  => '3px',
							'4px'  => '4px',
							'5px'  => '5px',
							'6px'  => '6px',
							'7px'  => '7px',
							'8px'  => '8px',
							'9px'  => '9px',
							'10px'  => '10px',
						),
					),
					'font_size'          => array(
						'type'        => 'text',
						'label'       => __( 'Font Size', 'fl-builder' ),
						'default'     => '',
						'preview'     => array(
							'type' => 'refresh',
						),
					),
					'width'          => array(
						'type'        => 'text',
						'label'       => __( 'Width', 'fl-builder' ),
						'default' => '100%',
					),
					'letter_spacing'          => array(
						'type'        => 'text',
						'label'       => __( 'Letter Spacing', 'fl-builder' ),
						'default' => '',
					),
					'top_spacing'          => array(
						'type'        => 'text',
						'label'       => __( 'Top Spacing', 'fl-builder' ),
						'default' => '',
					),
					'right_spacing'          => array(
						'type'        => 'text',
						'label'       => __( 'Right Spacing', 'fl-builder' ),
						'default' => '',
					),
					'bottom_spacing'          => array(
						'type'        => 'text',
						'label'       => __( 'Bottom Spacing', 'fl-builder' ),
						'default' => '',
					),
					'left_spacing'          => array(
						'type'        => 'text',
						'label'       => __( 'Left Spacing', 'fl-builder' ),
						'default' => '',
					),
					'text_align'          => array(
						'type'        => 'select',
						'label'       => __( 'Text Align', 'fl-builder' ),
						'default' => 'left',
						'options' => array(
							'left' => 'Left',
							'center'  => 'Center',
							'right'  => 'Right',
						),
					),
					'font_weight'          => array(
						'type'        => 'select',
						'label'       => __( 'Font Weight', 'fl-builder' ),
						'default' => '400',
						'options' => array(
							'100' => '100',
							'200'  => '200',
							'300'  => '300',
							'400'  => '400',
							'500'  => '500',
							'600'  => '600',
							'700'  => '700',
							'800'  => '800',
							'900'  => '900',
							'bold'  => 'Bold',
						),
					),
				),
			),
		),
	),
));
