<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @since       1.0.0
 * @package     Woo_Paypal_Data_Request
 * @subpackage  Woo_Paypal_Data_Request/public
 */

defined( 'ABSPATH' ) || exit;

class Woo_Paypal_Data_Request_Public {
    
    private  $plugin_name ;
    private  $version ;
    
    /* init class */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /* public area css */
    public function enqueue_styles() {}
    
    /* public area javascript */
    public function enqueue_scripts() {}    
    
}