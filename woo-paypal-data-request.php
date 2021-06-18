<?php

/**
 * Plugin Name:       Paypal Data Request for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/woo-paypal-data-request/
 * Description:       Get user data like email or address from Paypal transaction data 
 * Version:           1.0
 * Author:            appleuser for cyquest.net
 * Author URI:        https://profiles.wordpress.org/appleuser
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-paypal-data-request
 * Domain Path:       /languages
 *
 * WC requires at least: 3.8
 * WC tested up to: 4.1
 */

defined( 'ABSPATH' ) || exit;

add_action( 'plugins_loaded', 'wpdg_initialize_plugin' );
$wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );

if ( true === $wc_active ) {
        
    if ( !defined( 'WPDG_TEXT_DOMAIN' ) ) {
        define( 'WPDG_TEXT_DOMAIN', 'woo-paypal-data-request' );
    }
    if ( !defined( 'WPDG_PLUGIN_URL' ) ) {
        define( 'WPDG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }
    if ( !defined( 'WPDG_PLUGIN_VERSION' ) ) {
        define( 'WPDG_PLUGIN_VERSION', '1.0' );
    }
    if ( !function_exists( 'wp_get_current_user' ) ) {
        include ABSPATH . "wp-includes/pluggable.php";
    }
    if ( !defined( 'WPDG_PLUGIN_NAME' ) ) {
        define( 'WPDG_PLUGIN_NAME', 'Paypal Data Request for WooCommerce' );
    }
    
    /* core plugin class */
    require plugin_dir_path( __FILE__ ) . 'includes/class-woo-paypal-data-request.php';
    
    /* execute plugin */
    function run_woo_paypal_data_request() {
        $plugin = new Woo_Paypal_Data_Request();
        $plugin->run();
    }

}

/* check initialize plugin in case WooCommerce is missing */
function wpdg_initialize_plugin() {
    $wc_active = in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ), true );
    if ( current_user_can( 'activate_plugins' ) && $wc_active !== true || $wc_active !== true ) {
        add_action( 'admin_notices', 'wpdg_plugin_admin_notice' );
    } else {
        run_woo_paypal_data_request();
    }
}

/* show admin notice in case WooCommerce is missing */
function wpdg_plugin_admin_notice() {
    $wpdg_plugin = esc_html__( 'Paypal Data Request for WooCommerce', WPDG_TEXT_DOMAIN );
    $wc_plugin = esc_html__( 'WooCommerce', WPDG_TEXT_DOMAIN );
    ?>
    <div class="error">
        <p>
            <?php 
    echo  sprintf( esc_html__( '%1$s is ineffective as it requires %2$s to be installed and active.', WPDG_TEXT_DOMAIN ), '<strong>' . esc_html( $wpdg_plugin ) . '</strong>', '<strong>' . esc_html( $wc_plugin ) . '</strong>' ) ;
    ?>
        </p>
    </div>
    <?php 
}
