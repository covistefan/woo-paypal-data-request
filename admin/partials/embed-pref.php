<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<div id="wpdg-embed-pref" class="tabcontent">
    <h2><?php esc_html_e( 'Embedding preferences', WPDG_TEXT_DOMAIN ); ?></h2>
    <p><?php esc_html_e( 'Where should  data be requested from Paypal.', WPDG_TEXT_DOMAIN ); ?></p>
    <table class="form-table wpdg-table-outer product-fee-table">
        <tbody>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'Order details page', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wpdg_order_details" id="wpdg_order_details" value="on" <?php echo  esc_attr( $wpdg_order_details ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'Order overview page', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wpdg_order_overview" id="wpdg_order_overview" value="on" <?php echo  esc_attr( $wpdg_order_overview ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'Admin Dashboard', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wpdg_admin_dashboard" id="wpdg_admin_dashboard" value="on" <?php echo  esc_attr( $wpdg_admin_dashboard ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'Always', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wpdg_request_always" id="wpdg_request_always" value="on" <?php echo  esc_attr( $wpdg_request_always ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php 
