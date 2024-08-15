<?php
/**
 * This is an example module that uses the TwentyTwenty jQuery plugin.
 *
 * @class SignatureServicesModule
 */
class SignatureServicesModule extends FLBuilderModule {

	/**
	 * The module construct, we need to pass some basic info here.
	 */
	public function __construct() {

		parent::__construct(array(
			'name'            => __( 'Signature Services', 'fl-builder' ),
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
FLBuilder::register_module( 'SignatureServicesModule', array(
	'general' => array(
		'title' => __( 'General', 'fl-builder' ),
		'sections' => array(
			'general' => array(
				'title' => __( 'Box Content', 'fl-builder' ),
				'fields' => array(
					'icon' => array(
						'type' => 'photo',
						'label' => __( 'Grid Icon', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'title' => array(
						'type' => 'text',
						'label' => __( 'Title', 'fl-builder' ),
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
					'button_text' => array(
						'type' => 'text',
						'label' => __( 'Button Text', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'button_link' => array(
						'type' => 'link',
						'label' => __( 'Button Link', 'fl-builder' ),
						'show_target'   => true,
    					'show_nofollow' => true,
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
					'bg_hover_image' => array(
						'type' => 'photo',
						'label' => __( 'Background Hover Image', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'bg_hover_color'          => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'label'       => __( 'Background Hover Color', 'fl-builder' ),
						'default'     => '',
						'show_reset'  => true,
						'show_alpha'  => true,
						'preview'     => array(
							'type' => 'refresh',
						),
					),
					'title_spacing' => array(
						'type' => 'text',
						'label' => __( 'Title Spacing', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'icon_width' => array(
						'type' => 'text',
						'label' => __( 'Icon Width', 'fl-builder' ),
						'preview' => array(
							'type' => 'none',
						),
					),
					'column_alighment' => array(
						'type' => 'select',
						'label' => __( 'Vertical Alignment', 'fl-builder' ),
						'options'       => array(
					        ''      => __( 'Slect Option', 'fl-builder' ),
					        'start'      => __( 'Top', 'fl-builder' ),
					        'center'   => __( 'Middle', 'fl-builder' ),
					        'end'   => __( 'Bottom', 'fl-builder' ),
					    )
					),
				),
			),
		),
	),
));
