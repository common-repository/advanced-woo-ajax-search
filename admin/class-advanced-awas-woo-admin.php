<?php
class Advanced_Awas_Woo_Admin
{

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->awas_woo_admin_setting_page_callback();
        $this->awas_setting_api = new Advanced_Awas_Woo_Setting_Option();
        $this->plugin_name = $plugin_name;

        $this->version = $version;
        
        add_action('delete_widget', array($this, 'awas_woo_action_delete_widget'), 10, 3);

        add_action('admin_init', array($this, 'live_asfw_admin_init'));
        add_action('admin_menu', array($this, 'awas_woo_add_menu'));
        
    }

    /**
     * Added setting page
     *
     * @since    1.0.0
     */
    public function awas_woo_admin_setting_page_callback()
    {
        include_once 'partials/advanced-awas-woo-admin-display.php';
    }

    public function live_asfw_admin_init()
    {
        
        //set the settings
        $this->awas_setting_api->set_sections($this->get_awas_settings_sections());
        $this->awas_setting_api->set_fields($this->get_awas_settings_fields());

        //initialize settings
        $this->awas_setting_api->admin_init();
    }

    public function get_awas_settings_sections()
    {
        $sections = array(
            array(
                'id'    => 'awas_woo_inf_basics',
                'title' => __('Basic Settings', 'awas-woo'),
            ),
            array(
                'id'    => 'awas_woo_inf_color',
                'title' => __('Advanced Settings', 'awas-woo'),
            ),
        );
        return $sections;
    }

     /**
         * Returns all the settings fields
         *
         * @return array settings fields
         */
        public function get_awas_settings_fields()
        {
            $tab_awas_settings_fields = array(
                'awas_woo_inf_basics' => array(
                    array(
                        'name'              => 'awas_woo_title_text_size',
                        'label'             => __('Heading Font Size', 'awas-woo'),
                        'default'           => __('30px', 'awas-woo'),
                        'type'              => 'text',
                        'size'              => '15px',
                        'sanitize_callback' => 'sanitize_text_field',
                    ),
                    array(
                        'name'              => 'awas_inner_text_size',
                        'label'             => __('Inner Title Font Size', 'awas-woo'),
                        'default'           => __('20px', 'awas-woo'),
                        'type'              => 'text',
                        'size'              => '15px',
                        'sanitize_callback' => 'sanitize_text_field',
                    ),
                    array(
                        'name'              => 'awas_search_field_padding',
                        'label'             => __('Field Padding', 'awas-woo'),
                        'default'           => __('', 'awas-woo'),
                        'type'              => 'text',
                        'size'              => '15px',
                        'sanitize_callback' => 'sanitize_text_field',
                    ),

                ),
                'awas_woo_inf_color'  => array(
                    array(
                        'name'  => 'title_color',
                        'label' => __('Heading Color', 'awas-woo'),
                        'desc'  => __('Heading Color Select', 'awas-woo'),
                        'type'  => 'color',
                    ),
                    array(
                        'name'  => 'awas_title_opt_bg',
                        'label' => __('Search Product BG Color', 'awas-woo'),
                        'desc'  => __('Product Title Bg color', 'awas-woo'),
                        'type'  => 'color',
                    ),
                    
                    array(
                        'name'  => 'search_pro_title_color',
                        'label' => __('Search Product Color', 'awas-woo'),
                        'type'  => 'color',
                    ),

                    array(
                        'name'  => 'awas_title_hover_opt_bg',
                        'label' => __('Search Product Hover BG Color', 'awas-woo'),
                        'desc'  => __('Product Title Bg color', 'awas-woo'),
                        'type'  => 'color',
                    ),
                    
                    array(
                        'name'  => 'search_pro_hover_title_color',
                        'label' => __('Search Product Hover Color', 'awas-woo'),
                        'type'  => 'color',
                    ),
                ),
            );

            return $tab_awas_settings_fields;
        }

    // define the delete_widget callback
    public function awas_woo_action_delete_widget($widget_id, $sidebar_id, $id_base)
    {
        if (strpos($widget_id, 'woolivetitlewidget') !== false) {
            global $wpdb;
            $option_query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}options WHERE option_name LIKE %s", '%' . $wpdb->esc_like( $widget_id ) . '%');

            $lasw_option_results = $wpdb->get_results( $option_query );

            foreach ($lasw_option_results as $lasw_option_result) {
                delete_option($lasw_option_result->option_name);
            }
        }
    }

    /**
     * add admin menu
     *
     * @since    1.0.0
     */
    public function awas_woo_add_menu()
    {

        add_menu_page(
            __('Advanced Woo Ajax Search', 'awas-woo'), 
            __('Advanced Woo Ajax Search', 'awas-woo'), 
            'manage_options', 
            'advanced-woo-option-setting', 
            array($this, 'awas_woo_menu_callback'), 
            'dashicons-layout', "100"
        );

    }

    public function awas_woo_menu_callback()
    { ?>
        <div class="cdt-wrap">
            <?php
            $this->awas_setting_api->awas_woo_show_navigation();
            $this->awas_setting_api->last_woo_show_forms();
            ?>

        </div>
    <?php }

    public function awas_woo_enqueue_styles()
    {
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style('admin-option-page', AWAS_WOO_ADMIN_URL . 'css/fontawesome.min.css', array('wp-color-picker'), $this->version, 'all');
        wp_enqueue_style($this->plugin_name, AWAS_WOO_ADMIN_URL . 'css/advanced-awas-woo-admin.css', array('wp-color-picker'), $this->version, 'all');
        wp_enqueue_style('select2-min-css', AWAS_WOO_ADMIN_URL . '/css/select2.min.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function awas_woo_enqueue_scripts()
    {

        wp_enqueue_script('wp-color-picker');
        wp_enqueue_media();
        wp_enqueue_script('select2-full-js', AWAS_WOO_ADMIN_URL . 'js/select2.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script($this->plugin_name, AWAS_WOO_ADMIN_URL . 'js/advanced-awas-woo-admin.js', array('jquery', 'wp-color-picker', 'select2-full-js'), $this->version, true);
        //passing home url to js
        $home_url = array('templateUrl' => home_url('/'),"select_placeholder"=> esc_html('Select option',"awas-woo"));
        //after wp_enqueue_script
        wp_localize_script($this->plugin_name, 'live_ajaxsearch_localize_obj', $home_url);
    }
}