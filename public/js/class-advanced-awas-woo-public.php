<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/faridmia/
 * @since      1.0.0
 *
 * @package    Advanced_Awas_Woo
 * @subpackage Advanced_Awas_Woo/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Advanced_Awas_Woo
 * @subpackage Advanced_Awas_Woo/public
 * @author     Farid Mia <mdfarid7830@gmail.com>
 */
class Advanced_Awas_Woo_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $awas_woo    The ID of this plugin.
	 */
	private $awas_woo;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $awas_woo       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $awas_woo, $version ) {

		$this->awas_woo = $awas_woo;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Advanced_Awas_Woo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Advanced_Awas_Woo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style('nouislider-min-css', AWAS_WOO_PUBLIC_URL . 'css/nouislider.min.css', array(), $this->version, 'all');
        wp_enqueue_style( $this->awas_woo, AWAS_WOO_PUBLIC_URL . 'css/advanced-awas-woo-public.css', array(), $this->version, 'all' );
        wp_enqueue_style('select2-min-css', AWAS_WOO_PUBLIC_URL . 'css/select2.min.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Advanced_Awas_Woo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Advanced_Awas_Woo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script('nouislider-min-js', AWAS_WOO_PUBLIC_URL . 'assets/js/nouislider.min.js', array('jquery'), $this->version, false);
        wp_enqueue_script('select2-full-js', AWAS_WOO_PUBLIC_URL . 'assets/js/select2.full.js', array('jquery'), $this->version, false);
        wp_enqueue_script( $this->awas_woo, AWAS_WOO_PUBLIC_URL . 'js/advanced-awas-woo-public.js', array( 'jquery' ), $this->version, false );

        $url = home_url();
        $asfw_home_url = esc_url($url);
        wp_localize_script($this->plugin_name, 'awas_woo_current_wp_home_url', array(
            'url' => $asfw_home_url,
            'ajax_url' => esc_url(admin_url('admin-ajax.php')),
            "select_placeholder"=> esc_html('Select option',"awas-woo"),
            )
        );

	}

}
