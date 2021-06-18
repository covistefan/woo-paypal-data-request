<?php
/**
 * The admin-facing functionality of the plugin.
 *
 * @version     1.0
 * @package     Woo_Paypal_Data_Request
 * @subpackage  Woo_Paypal_Data_Request/admin
 */

defined( 'ABSPATH' ) || exit;

class Woo_Paypal_Data_Request_Admin {

    private  $plugin_name ;
    private  $version ;
    
    /* init class */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /* admin area css */
    public function enqueue_styles( $hook ) {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/woo-paypal-data-request-admin.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    /* admin area javascript */
    public function enqueue_scripts( $hook ) {
        wp_enqueue_script(
            $this->plugin_name . 'wpdg-admin-default-js',
            plugin_dir_url( __FILE__ ) . 'js/woo-paypal-data-request-admin.js',
            array( 'jquery', 'jquery-ui-dialog' ),
            $this->version,
            false,
            999
        );
    }
    
    /* describe things */
    public function wpdg_add_order_contactdata_column_header( $columns ) {
        
        $wpdg_array = maybe_unserialize( get_option( 'wpdg_setting' ) );
        // check for email-support
        if ( isset( $wpdg_array['wpdg_dataset_email'] ) && !empty($wpdg_array['wpdg_dataset_email']) ) $wpdg_dataset[] = 'email-address' ;
        if ( isset( $wpdg_array['wpdg_dataset_surname'] ) && !empty($wpdg_array['wpdg_dataset_surname']) ) $wpdg_dataset[] = 'surname' ;
        if ( isset( $wpdg_array['wpdg_dataset_name'] ) && !empty($wpdg_array['wpdg_dataset_name']) ) $wpdg_dataset[] = 'name' ;
        // wpdg_dataset_address
        // wpdg_dataset_zip
        // wpdg_dataset_city
        // wpdg_dataset_country
        
        $new_columns = array();
        foreach ( $columns as $column_name => $column_info ) {
            $new_columns[ $column_name ] = $column_info;
            if ( 'order_date' === $column_name ) {
                if ( count($wpdg_dataset) > 1 ) {
                    $new_columns['order_contactdata'] = __('PP contactdata', $this->plugin_name) ;
                } 
                else if ( count($wpdg_dataset) > 0 ) {
                    $new_columns['order_contactdata'] = __('PP '.$wpdg_dataset[0], $this->plugin_name) ;
                }
            }
        }
        return $new_columns;
        
    }
    
    // adds content coloumn for contact mail info -> and if no one exists, it gets mail from paypal (if transaction id exist)
    public function wpdg_add_order_contactdata_column_content( $column ) {
    
        global $post;
        
        // get settings from database 
        $wpdg_array = maybe_unserialize( get_option( 'wpdg_setting' ) );
        // connection settings
        $wpdg_auth_conn = ( isset( $wpdg_array['wpdg_connection_type'] ) && !empty($wpdg_array['wpdg_connection_type']) ? intval($wpdg_array['wpdg_connection_type']) : false );
        $wpdg_auth_user = ( isset( $wpdg_array['wpdg_auth_user'] ) && !empty($wpdg_array['wpdg_auth_user']) ? $wpdg_array['wpdg_auth_user'] : false );
        $wpdg_auth_pass = ( isset( $wpdg_array['wpdg_auth_pass'] ) && !empty($wpdg_array['wpdg_auth_pass']) ? $wpdg_array['wpdg_auth_pass'] : false );
        $wpdg_auth_sign = ( isset( $wpdg_array['wpdg_auth_sign'] ) && !empty($wpdg_array['wpdg_auth_sign']) ? $wpdg_array['wpdg_auth_sign'] : false );
        // display settings
        if ( isset( $wpdg_array['wpdg_dataset_email'] ) && !empty($wpdg_array['wpdg_dataset_email']) ) $wpdg_dataset[] = 'email-address' ;
        if ( isset( $wpdg_array['wpdg_dataset_surname'] ) && !empty($wpdg_array['wpdg_dataset_surname']) ) $wpdg_dataset[] = 'surname' ;
        if ( isset( $wpdg_array['wpdg_dataset_name'] ) && !empty($wpdg_array['wpdg_dataset_name']) ) $wpdg_dataset[] = 'name' ;
        
        if ( 'order_contactdata' === $column ) {
            $order = wc_get_order( $post->ID );
            if ($order->get_billing_email()!='') {
                echo '<span style="display: block; white-space: nowrap; overflow: hidden;">'.$order->get_billing_email().'</span>';
            }
            else if (strpos($order->get_payment_method(), 'paypal')!==false && $order->get_transaction_id()!='') {
                $resdata = $this->wpdg_do_pp_request( array($wpdg_auth_conn,$wpdg_auth_user,$wpdg_auth_pass,$wpdg_auth_sign) , $order->get_transaction_id());
                if (is_array($resdata) && (isset($resdata['EMAIL']) || isset($resdata['FIRSTNAME']) || isset($resdata['LASTNAME']) )) {
                    if (in_array('email-address', $wpdg_dataset) && trim($resdata['EMAIL'])!='') {
                        $order->set_billing_email($resdata['EMAIL']);
                        echo '<span style="display: block; white-space: nowrap; overflow: hidden;">'.((count($wpdg_dataset)>1)?__('PP email-address', $this->plugin_name).' ':'').'» '.$resdata['EMAIL'].'</span>';
                    }
                    if (in_array('surname', $wpdg_dataset) && trim($resdata['FIRSTNAME'])!='') {
                        $order->set_billing_first_name($resdata['FIRSTNAME']);
                        echo '<span style="display: block; white-space: nowrap; overflow: hidden;">'.((count($wpdg_dataset)>1)?__('PP surname', $this->plugin_name).' ':'').'» '.$resdata['FIRSTNAME'].'</span>';
                    }
                    if (in_array('name', $wpdg_dataset) && trim($resdata['EMAIL'])!='') {
                        $order->set_billing_last_name($resdata['LASTNAME']);
                        echo '<span style="display: block; white-space: nowrap; overflow: hidden;">'.((count($wpdg_dataset)>1)?__('PP name', $this->plugin_name).' ':'').'» '.$resdata['LASTNAME'].'</span>';
                    }
                    if (count($wpdg_dataset)>1) {
                        $order->save();
                    }
                }
                else {
                    echo __('PP did not serve data for transaction ID', $this->plugin_name).' <strong>'.trim($order->get_transaction_id()).'</strong>';
                    echo '<script> jQuery(\'#cb-select-'.$post->ID.'\').hide().remove(); </script>';
                }
            }
        }
    }
    
    // creates the paypal request and returns data
    public function wpdg_do_pp_request ( $authdata , $transactionid ) {
        if ( is_array($authdata) && count($authdata)==4 && trim($transactionid)!='' ) {
            
            $args = array();
            $args['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
            $args['headers']['Accept-Language'] = 'de_DE';
            $args['body'] = array(
                'USER' => trim($authdata[1]),
                'PWD' => trim($authdata[2]),
                'SIGNATURE' => trim($authdata[3]),
                'METHOD' => 'GetTransactionDetails',
                'VERSION' => '78', // warum auch immer
                'TransactionID' => $transactionid
            );
            
            if (intval($authdata[0])==1) {
                $response = wp_remote_post( 'https://api-3t.paypal.com/nvp' , $args );
            }
            else {
                $response = wp_remote_post( 'https://api-3t.sandbox.paypal.com/nvp' , $args );
            }
            parse_str(urldecode(wp_remote_retrieve_body($response)),$resdata);
            
            if (isset($resdata['L_ERRORCODE0']) && intval($resdata['L_ERRORCODE0'])==10004) {
                return ('ERRORCODE 10004 - false transaction ID ('.$transactionid.')');
            }
            else if (isset($resdata['L_ERRORCODE0']) && intval($resdata['L_ERRORCODE0'])==10002) {
                return ('ERRORCODE 10002 - security error');
            }
            else {
                return $resdata;
            }
        } 
        else {
            return false;
        }
    }
    
    /* create admin menu */
    public function wpdg_create_page() {
        add_submenu_page( 'woocommerce', 'Woo «» Paypal', __( 'Woo «» Paypal' ), 'manage_options', 'wpdg_settings', array( $this, 'wpdg_settings_page' ), 999 );
    }
    
    /* create admin page */
    public function wpdg_settings_page() {
        require_once plugin_dir_path( __FILE__ ) . 'header/plugin-header.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/general-settings.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/pp-connect.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/pp-test.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/dataset.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/embed-pref.php';
        require_once plugin_dir_path( __FILE__ ) . 'partials/helpdesc.php';
        require_once plugin_dir_path( __FILE__ ) . 'header/plugin-footer.php';
    }
    
}