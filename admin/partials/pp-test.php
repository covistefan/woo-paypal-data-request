<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>
<div id="wpdg-pp-test" class="tabcontent">
    <?php
    
    echo (isset($pptestoutput) && trim($pptestoutput)!='') ? $pptestoutput : '';
    
    ?>
    <h2><?php esc_html_e( 'Test Paypal Request', WPDG_TEXT_DOMAIN ); ?></h2>
    <p><?php 

        $wpdg_auth = array(
            "0" => __('Sandbox', WPDG_TEXT_DOMAIN),
            "1" => __('Live', WPDG_TEXT_DOMAIN),
        );
        
        esc_html_e( 'This will access Paypal '.$wpdg_auth[$wpdg_connection_type].' to check, what data is avaiable for a desired transaction ID.', WPDG_TEXT_DOMAIN );
                    
        ?></p>
    <table class="form-table wpdg-table-outer product-fee-table">
        <tbody>
            <tr>
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'Paypal transaction ID', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="forminp mdtooltip">
                    <label>
                        <input type="text" name="wpdg_transaction_test" style="min-width: 20em;" value="" placeholder="<?php _e( 'Paypal transaction ID', WPDG_TEXT_DOMAIN ); ?>" />
                    </label>
                </td>
                <td class="forminp mdtooltip"><?php esc_html_e( 'Fill in a transaction ID (take a look at your order details page to find one) and hit submit to request data from Paypal.', WPDG_TEXT_DOMAIN ); ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php 
