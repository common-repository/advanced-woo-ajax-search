<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/Faridmia/advanced-woo-ajax-search
 * @since      1.0.0
 *
 * @package    Advanced_Awas_Woo
 * @subpackage Advanced_Awas_Woo/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Advanced_Awas_Woo
 * @subpackage Advanced_Awas_Woo/includes
 * @author     Farid Mia <mdfarid7830@gmail.com>
 */
class Advanced_Awas_Woo_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'awas-woo',
			false,
			AWAS_WOO_BASENAME . '/languages/'
		);

	}



}
