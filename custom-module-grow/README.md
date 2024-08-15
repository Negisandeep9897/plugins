# Introduction
In this tutorial I'm going to show you how to create a module plugin for Beaver Builder using a 3rd party jQuery plugin.

The jQuery plugin we are using will compare two images with a sliding bar, this could be useful where you need to compare two images with similar dimensions.

![Module Demo](assets/module-demo.gif?raw=true)

# Creating the plugin.
Navigate to your WP plugins folder, typically `wp-content/plugins/` and create a new folder `fl-module-johny.php`.

For WP to recognise the plugin correctly we need a main plugin file with the WP plugin headers.

Create a file called `fl-module-johny.php` in your new plugin folder with the following:

```
<?php
/**
 * Plugin Name: Beaver Builder Johnny Module.
 * Plugin URI: https://johnnygrow.com
 * Description: An example plugin thats demonstrates how to create a simple module for Beaver Builder Johnny Module using a jQuery plugin.
 * Version: 1.0
 * Author: The Beaver Builder Team
 * Author URI: https://johnnygrow.com
 */
```

This is the information WP uses on the plugins admin screen to show the name, description and version information.

Underneath this we will add the main plugin class which will load the module file.

```
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
		}
	}
}
add_action( 'init', array( 'JohnyCustomBuilder', 'init' ) );