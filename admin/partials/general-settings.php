<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<div id="wpdg-general-settings" class="tabcontent">
    <h2><?php esc_html_e( 'Settings', WPDG_TEXT_DOMAIN ); ?></h2>
    <table class="form-table wpdg-table-outer product-fee-table">
        <tbody>
            <tr valign="top">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'API usage', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td>
                    <label class="switch">
                        <input type="hidden" name="wpdg_status" value="off" />
                        <input type="checkbox" name="wpdg_status" id="wpdg_status" value="on" <?php echo  esc_attr( $wpdg_status ) ; ?>>
                    </label>
                </td>
                <td class="forminp mdtooltip">
                    <p class="wpdg_tooltip_desc description">
                        <?php esc_html_e( 'Enable or disable Paypal data request API', WPDG_TEXT_DOMAIN ); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'Disable address form', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td>
                    <label class="switch">
                        <input type="checkbox" name="wpdg_disableaddress" id="wpdg_disableaddress" value="on" <?php echo  esc_attr( $wpdg_disableaddress ) ; echo ( $wpdg_active )?'':' disabled="disabled" '; ?>>
                    </label>
                </td>
                <td class="forminp mdtooltip">
                    <p class="wpdg_tooltip_desc description">
                        <?php esc_html_e( 'Disable checkout address form.', WPDG_TEXT_DOMAIN ); ?>
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'DEV Mode', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td>
                    <label class="switch">
                        <input type="hidden" name="wpdg_dev" value="" />
                        <input type="checkbox" name="wpdg_dev" id="wpdg_dev" value="on" <?php echo  esc_attr( $wpdg_dev ) ; echo ( $wpdg_active )?'':' disabled="disabled" '; ?>>
                    </label>
                </td>
                <td class="forminp mdtooltip">
                    <p class="wpdg_tooltip_desc description">
                        <?php esc_html_e( 'Enable or disable development mode. Development mode will show some more information about Paypal communication.', WPDG_TEXT_DOMAIN ); ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php 
