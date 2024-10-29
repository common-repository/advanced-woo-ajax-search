<?php
/**
 * Fired during plugin activation
 *
 * @link       https://github.com/Faridmia/advanced-woo-ajax-search
 * @since      1.0.0
 *
 * @package    Advanced_Awas_Woo
 * @subpackage Advanced_Awas_Woo/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Advanced_Awas_Woo
 * @subpackage Advanced_Awas_Woo/includes
 * @author     Farid Mia <mdfarid7830@gmail.com>
 */
class Advanced_Awas_Woo_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        if ( !class_exists( 'WooCommerce' ) ) {
            return false;
        }
    }

}
