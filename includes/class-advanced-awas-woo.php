<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/Faridmia/advanced-woo-ajax-search
 * @since      1.0.0
 *
 * @package    Advanced_Awas_Woo
 * @subpackage Advanced_Awas_Woo/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Advanced_Awas_Woo
 * @subpackage Advanced_Awas_Woo/includes
 * @author     Farid Mia <mdfarid7830@gmail.com>
 */
class Advanced_Awas_Woo {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Advanced_Awas_Woo_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $awas_woo    The string used to uniquely identify this plugin.
	 */
	protected $awas_woo;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	public $widget_option = "";

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'AWAS_WOO_VERSION' ) ) {
			$this->version = AWAS_WOO_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		$this->awas_woo = 'advanced-awas-woo';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		$this->widget_option = $this->widget_include();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Advanced_Awas_Woo_Loader. Orchestrates the hooks of the plugin.
	 * - Advanced_Awas_Woo_i18n. Defines internationalization functionality.
	 * - Advanced_Awas_Woo_Admin. Defines all hooks for the admin area.
	 * - Advanced_Awas_Woo_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once AWAS_WOO_INCLUDES . 'class-advanced-awas-woo-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once AWAS_WOO_INCLUDES . 'class-advanced-awas-woo-i18n.php';

		require_once AWAS_WOO_INCLUDES . 'class-advanced-woo-hooks-function.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once AWAS_WOO_PATH . 'admin/class-advanced-awas-woo-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once AWAS_WOO_PATH . 'public/class-advanced-awas-woo-public.php';

		$this->loader = new Advanced_Awas_Woo_Loader();

		$hooks_function = new Advanced_Woo_Hooks_Function();
		$this->loader->add_action('wp_head', $hooks_function, 'advanced_add_custom_css_callback');

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Advanced_Awas_Woo_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Advanced_Awas_Woo_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Advanced_Awas_Woo_Admin( $this->get_awas_woo(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'awas_woo_enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'awas_woo_enqueue_scripts' );

	}

	function widget_include() {

		include_once('functions.php' );
		include_once('class-advanced-woo-search-widget.php' );

		new woolive_ajax_search_widget_class();
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Advanced_Awas_Woo_Public( $this->get_awas_woo(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_awas_woo() {
		return $this->awas_woo;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Advanced_Awas_Woo_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
