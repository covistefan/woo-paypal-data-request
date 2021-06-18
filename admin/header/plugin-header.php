<?php
// Exit if accessed directly
if (!defined('ABSPATH')) { exit; }

$plugin_name = WPDG_PLUGIN_NAME;
$plugin_version = WPDG_PLUGIN_VERSION;

// get data from database
$wpdg_general_setting = maybe_unserialize( get_option( 'wpdg_setting' ) );
$wpdg_active = ( isset($wpdg_general_setting['wpdg_status']) && !empty($wpdg_general_setting['wpdg_status']) ) ? true : false ;
$wpdg_dev = ( isset($wpdg_general_setting['wpdg_dev'])  && !empty($wpdg_general_setting['wpdg_status']) ) ? true : false ;
$wpdg_auth_user = ( isset( $wpdg_general_setting['wpdg_auth_user'] ) && !empty($wpdg_general_setting['wpdg_auth_user']) ? $wpdg_general_setting['wpdg_auth_user'] : '' );
$wpdg_auth_pass = ( isset( $wpdg_general_setting['wpdg_auth_pass'] ) && !empty($wpdg_general_setting['wpdg_auth_pass']) ? $wpdg_general_setting['wpdg_auth_pass'] : '' );
$wpdg_auth_sign = ( isset( $wpdg_general_setting['wpdg_auth_sign'] ) && !empty($wpdg_general_setting['wpdg_auth_sign']) ? $wpdg_general_setting['wpdg_auth_sign'] : '' );

if (isset($_POST['wpdg_status']) && sanitize_text_field( $_POST['wpdg_status'] )=='on') {
    $wpdg_active = true;
} else if (isset($_POST['wpdg_status']) && sanitize_text_field( $_POST['wpdg_status'] )!='on') {
    $wpdg_active = false;
}

if (isset($_POST['wpdg_dev']) && sanitize_text_field( $_POST['wpdg_dev'] )=='on') {
    $wpdg_dev = true;
} else if (isset($_POST['wpdg_dev']) && sanitize_text_field( $_POST['wpdg_dev'] )!='on') {
    $wpdg_dev = false;
}

?>
<div id="cqmain">
    <div class="all-pad">
        <header class="cq-header"></header>
        <ul class="tablist">
            <li <?php echo (isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wpdg-general-settings')?'class="active"':''; ?>><a href="#wpdg-general-settings"><?php _e("General settings", WPDG_TEXT_DOMAIN); ?></a></li>
            <li <?php echo (isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wpdg-pp-connect')?'class="active status"':'class="status"'; echo ($wpdg_active)?'':'style="display: none;"'; ?>><a href="#wpdg-pp-connect"><?php _e("Paypal connect", WPDG_TEXT_DOMAIN); ?></a></li>
            <?php
            
            if ($wpdg_dev && $wpdg_auth_user!='' && $wpdg_auth_pass!='' && $wpdg_auth_sign!='') {
            
            ?>
            <li <?php echo (isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wpdg-pp-test')?'class="active status"':'class="status"'; echo ($wpdg_active)?'':'style="display: none;"'; ?>><a href="#wpdg-pp-test"><?php _e("Paypal Test Request", WPDG_TEXT_DOMAIN); ?></a></li>
            <?php
            
            }
            
            ?>
            <li <?php echo (isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wpdg-dataset')?'class="active status"':'class="status"'; echo ($wpdg_active)?'':'style="display: none;"'; ?>><a href="#wpdg-dataset"><?php _e("Paypal dataset", WPDG_TEXT_DOMAIN); ?></a></li>
            <li <?php echo (isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wpdg-embed-pref')?'class="active status"':'class="status"'; echo ($wpdg_active)?'':'style="display: none;"'; ?>><a href="#wpdg-embed-pref"><?php _e("Embedding preferences", WPDG_TEXT_DOMAIN); ?></a></li>
            <li <?php echo (isset($_POST['tablist']) && sanitize_text_field( $_POST['tablist'] )=='#wpdg-helpdesc')?'class="active"':''; ?>><a href="#wpdg-helpdesc"><?php _e("Helpdesc", WPDG_TEXT_DOMAIN); ?></a></li>
        </ul>
        <form method="POST" name="" action="">
            <input type="hidden" name="tablist" id="tablist-data" value="" />
            <?php
            
            wp_nonce_field( basename( __FILE__ ), WPDG_PLUGIN_NAME ); 
            
            global $woocommerce ;

            if ( isset( $_POST['submit_setting'] ) ) {

                // verify nonce

                if ( !isset( $_POST[str_replace(' ', '_', WPDG_PLUGIN_NAME)] ) || !wp_verify_nonce( sanitize_text_field( $_POST[str_replace(' ', '_', WPDG_PLUGIN_NAME)] ), basename( __FILE__ ) ) ) {
                    die( 'Failed security check' );
                } else {
                    
                    $data_post = array(
                        'tablist' => sanitize_text_field( $_POST['tablist'] ),
                        'wpdg_connection_type' => intval( $_POST['wpdg_connection_type'] ),
                        'wpdg_auth_user' => sanitize_text_field( $_POST['wpdg_auth_user'] ),
                        'wpdg_auth_pass' => sanitize_text_field( $_POST['wpdg_auth_pass'] ),
                        'wpdg_auth_sign' => sanitize_text_field( $_POST['wpdg_auth_sign'] ),
                        'wpdg_dataset_email' => sanitize_text_field( $_POST['wpdg_dataset_email'] ),
                        'wpdg_dataset_surname' => sanitize_text_field( $_POST['wpdg_dataset_surname'] ),
                        'wpdg_dataset_name' => sanitize_text_field( $_POST['wpdg_dataset_name'] ),
                        'wpdg_dataset_address' => sanitize_text_field( $_POST['wpdg_dataset_address'] ),
                        'wpdg_dataset_zip' => sanitize_text_field( $_POST['wpdg_dataset_zip'] ),
                        'wpdg_dataset_city' => sanitize_text_field( $_POST['wpdg_dataset_city'] ),
                        'wpdg_dataset_country' => sanitize_text_field( $_POST['wpdg_dataset_country'] )
                    );

                    if (isset($_POST['wpdg_status']) && sanitize_text_field( $_POST['wpdg_status'] )=='on') { $data_post['wpdg_status'] = sanitize_text_field( $_POST['wpdg_status'] ); }
                    if (isset($_POST['wpdg_disableaddress'])) $data_post['wpdg_disableaddress'] = sanitize_text_field( $_POST['wpdg_disableaddress'] );
                    if (isset($_POST['wpdg_dev'])) $data_post['wpdg_dev'] = sanitize_text_field( $_POST['wpdg_dev'] );

                    $general_setting_data = maybe_serialize( $data_post );
                    update_option( 'wpdg_setting', $general_setting_data );

                }
                
            }

            // get data from database
            $wpdg_general_setting = maybe_unserialize( get_option( 'wpdg_setting' ) );

            // generell prefs
            $wpdg_status = ( isset( $wpdg_general_setting['wpdg_status'] ) && !empty($wpdg_general_setting['wpdg_status']) ? 'checked' : '' );
            $wpdg_disableaddress = ( isset( $wpdg_general_setting['wpdg_disableaddress'] ) && !empty($wpdg_general_setting['wpdg_disableaddress']) ? 'checked' : '' );
            $wpdg_dev = ( isset( $wpdg_general_setting['wpdg_dev'] ) && !empty($wpdg_general_setting['wpdg_dev']) ? 'checked' : '' );

            // pp-connect
            $wpdg_connection_type = ( isset( $wpdg_general_setting['wpdg_connection_type'] ) && !empty($wpdg_general_setting['wpdg_connection_type']) ? intval($wpdg_general_setting['wpdg_connection_type']) : 0 );
            $wpdg_auth_user = ( isset( $wpdg_general_setting['wpdg_auth_user'] ) && !empty($wpdg_general_setting['wpdg_auth_user']) ? $wpdg_general_setting['wpdg_auth_user'] : '' );
            $wpdg_auth_pass = ( isset( $wpdg_general_setting['wpdg_auth_pass'] ) && !empty($wpdg_general_setting['wpdg_auth_pass']) ? $wpdg_general_setting['wpdg_auth_pass'] : '' );
            $wpdg_auth_sign = ( isset( $wpdg_general_setting['wpdg_auth_sign'] ) && !empty($wpdg_general_setting['wpdg_auth_sign']) ? $wpdg_general_setting['wpdg_auth_sign'] : '' );

            // dataset
            $wpdg_dataset_email = ( isset( $wpdg_general_setting['wpdg_dataset_email'] ) && !empty($wpdg_general_setting['wpdg_dataset_email']) ? 'checked' : '' );
            $wpdg_dataset_surname = ( isset( $wpdg_general_setting['wpdg_dataset_surname'] ) && !empty($wpdg_general_setting['wpdg_dataset_surname']) ? 'checked' : '' );
            $wpdg_dataset_name = ( isset( $wpdg_general_setting['wpdg_dataset_name'] ) && !empty($wpdg_general_setting['wpdg_dataset_name']) ? 'checked' : '' );
            $wpdg_dataset_address = ( isset( $wpdg_general_setting['wpdg_dataset_address'] ) && !empty($wpdg_general_setting['wpdg_dataset_address']) ? 'checked' : '' );
            $wpdg_dataset_zip = ( isset( $wpdg_general_setting['wpdg_dataset_zip'] ) && !empty($wpdg_general_setting['wpdg_dataset_zip']) ? 'checked' : '' );
            $wpdg_dataset_city = ( isset( $wpdg_general_setting['wpdg_dataset_city'] ) && !empty($wpdg_general_setting['wpdg_dataset_city']) ? 'checked' : '' );
            $wpdg_dataset_country = ( isset( $wpdg_general_setting['wpdg_dataset_country'] ) && !empty($wpdg_general_setting['wpdg_dataset_country']) ? 'checked' : '' );

            // embed-pref
            $wpdg_order_details = ( isset( $wpdg_general_setting['wpdg_order_details'] ) && !empty($wpdg_general_setting['wpdg_order_details']) ? 'checked' : '' );
            $wpdg_order_overview = ( isset( $wpdg_general_setting['wpdg_order_overview'] ) && !empty($wpdg_general_setting['wpdg_order_overview']) ? 'checked' : '' );
            $wpdg_admin_dashboard = ( isset( $wpdg_general_setting['wpdg_admin_dashboard'] ) && !empty($wpdg_general_setting['wpdg_admin_dashboard']) ? 'checked' : '' );
            $wpdg_request_always = ( isset( $wpdg_general_setting['wpdg_request_always'] ) && !empty($wpdg_general_setting['wpdg_request_always']) ? 'checked' : '' );
            
            // do a test run with paypal request
            if (isset($_POST['wpdg_transaction_test']) && trim($_POST['wpdg_transaction_test'])!='') {
                
                $pptestoutput = "<h2>".__("Request returned following data", WPDG_TEXT_DOMAIN)."</h2>";
                    
                $pp_test = new Woo_Paypal_Data_Request_Admin( WPDG_TEXT_DOMAIN , false );
                $pp_data = $pp_test->wpdg_do_pp_request( array($wpdg_connection_type , $wpdg_auth_user , $wpdg_auth_pass , $wpdg_auth_sign) , $_POST['wpdg_transaction_test'] );
                
                $pptestoutput.= '<pre class="pp-data">';
                $pptestoutput.= var_export($pp_data, true);
                $pptestoutput.= '</pre>';
                
            }
