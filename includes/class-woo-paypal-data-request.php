<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0
 * @package    Woo_Paypal_Data_Request
 * @subpackage Woo_Paypal_Data_Request/includes
 */

defined( 'ABSPATH' ) || exit;

class Woo_Paypal_Data_Request {
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0
     * @access   protected
     * @var      Woo_Paypal_Data_Request_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected  $loader ;
    protected  $plugin_name ;
    protected  $version ;
    
    /* define the core functionality of the plugin.
     *
     * det the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     */
    public function __construct() {
        $this->plugin_name = WPDG_TEXT_DOMAIN;
        $this->version = '1.0';
        $this->load_dependencies();
        $this->define_public_hooks();
        $this->define_admin_hooks();
        $this->set_locale();
    }
    
    /**
     * Load the required dependencies for this plugin.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0
     * @access   private
     */
    private function load_dependencies() {
        /* The class responsible for orchestrating the actions and filters of the core plugin. */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-covi-loader.php';
        /* The class responsible for defining internationalization functionality of the plugin. */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-covi-i18n.php';
        /* The class responsible for defining all actions that occur in the public-facing side of the site. */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woo-paypal-data-request-public.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woo-paypal-data-request-admin.php';
        $this->loader = new COVI_Loader();
    }
    
    /* define the locale for this plugin for internationalization. */
    private function set_locale() {
        $plugin_i18n = new COVI_i18n();
        $plugin_i18n->set_slug( $this->get_plugin_name() );
        $this->loader->add_action( 'init', $plugin_i18n, 'load_plugin_textdomain' );
    }
    
    /* Register all of the hooks related to the public-facing functionality of the plugin. */
    private function define_public_hooks() {
        $plugin_public = new Woo_Paypal_Data_Request_Public( $this->get_plugin_name(), $this->get_version() );
        $wpdg_array = maybe_unserialize( get_option( 'wpdg_setting' ) );
        $wpdg_status = ( isset( $wpdg_array['wpdg_status'] ) ? $wpdg_array['wpdg_status'] : '' );
        
    }
    
    /* Register all of the hooks related to the admin-facing functionality of the plugin. */
    private function define_admin_hooks() {
        $plugin_admin = new Woo_Paypal_Data_Request_Admin( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        // get backend data from plugin
        $wpdg_array = maybe_unserialize( get_option( 'wpdg_setting' ) );
        // check for email-support
        $wpdg_status = ( isset( $wpdg_array['wpdg_status'] ) ? $wpdg_array['wpdg_status'] : '' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'wpdg_create_page' );
        if (!empty($wpdg_status) && is_admin()) {
            // if status is active, add table row to woo commerce table
            $this->loader->add_filter( 'manage_edit-shop_order_columns', $plugin_admin, 'wpdg_add_order_contactdata_column_header' );
            $this->loader->add_action( 'manage_shop_order_posts_custom_column', $plugin_admin, 'wpdg_add_order_contactdata_column_content' );
        }
    }
        
    /* Retrieve the plugin name. */
    public function get_plugin_name() { return $this->plugin_name; }
    
    /* Retrieve the version number of the plugin. */
    public function get_version() { return $this->version; }

    /* The reference to the class that orchestrates the hooks with the plugin. */
    public function get_loader() { return $this->loader; }

    /* Run the loader to execute all of the hooks with WordPress. */
    public function run() { $this->loader->run(); }
    
}