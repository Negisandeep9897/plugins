<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://creatotech.com/
 * @since             1.0.0
 * @package           Creatotech_Dynamic_News
 *
 * @wordpress-plugin
 * Plugin Name:       Creatotech Dynamic News
 * Plugin URI:        https://https://creatotech.com/
 * Description:       Get and process new dynamically
 * Version:           1.0.0
 * Author:            Creatotech
 * Author URI:        https://https://creatotech.com//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       creatotech-dynamic-news
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CREATOTECH_DYNAMIC_NEWS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-creatotech-dynamic-news-activator.php
 */
function activate_creatotech_dynamic_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-creatotech-dynamic-news-activator.php';
	Creatotech_Dynamic_News_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-creatotech-dynamic-news-deactivator.php
 */
function deactivate_creatotech_dynamic_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-creatotech-dynamic-news-deactivator.php';
	Creatotech_Dynamic_News_Deactivator::deactivate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-creatotech-dynamic-news-uninstall.php
 */
register_activation_hook( __FILE__, 'activate_creatotech_dynamic_news' );
register_deactivation_hook( __FILE__, 'deactivate_creatotech_dynamic_news' );

/**
 * simple_html_dom library include
 */
require plugin_dir_path( __FILE__ ) . 'scrapelibrary/simple_html_dom.php';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

require plugin_dir_path( __FILE__ ) . 'includes/class-creatotech-dynamic-news.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_creatotech_dynamic_news() {

	$plugin = new Creatotech_Dynamic_News();
	$plugin->run();

}
run_creatotech_dynamic_news();

