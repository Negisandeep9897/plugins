<?php
/**
 * Plugin Name: Beaver Builder Johnny Module
 * Plugin URI: https://johnnygrow.com/
 * Description: A drag and drop frontend WordPress page builder how to create a simple module.
 * Version: 1.0
 * Author: The Beaver Builder Team
 * Author URI: https://johnnygrow.com/
 */
class JohnyCustomBuilder {

	public static function init() {

		if( class_exists( 'FLBuilder' ) ) {
			require_once 'modules/johnybuilder/johnybuilder.php';
			require_once 'modules/texticongrid/texticongrid.php';
			require_once 'modules/signatureservices/signatureservices.php';
			require_once 'modules/quotepost/quotepost.php';
			require_once 'modules/clicktotweet/clicktotweet.php';
			require_once 'modules/graphicalnumbers/graphicalnumbers.php';
			require_once 'modules/flexibleservices/flexibleservices.php';
			require_once 'modules/contactform/contactform.php';
			require_once 'modules/pullquote/pullquote.php';
		}
	}
}
add_action( 'init', array( 'JohnyCustomBuilder', 'init' ) );

function custom_module_scripts() {
	wp_enqueue_style( 'custom_module_scripts-css', home_url() . '/wp-content/plugins/custom-module-grow/assets/custom.css?jonhy='.microtime(), true );
}
add_action( 'wp_enqueue_scripts', 'custom_module_scripts' );