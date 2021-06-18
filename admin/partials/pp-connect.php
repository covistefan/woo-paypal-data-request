<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<div id="wpdg-pp-connect" class="tabcontent">
    <h2><?php esc_html_e( 'Connect with Paypal', WPDG_TEXT_DOMAIN ); ?></h2>
    <p><?php esc_html_e( 'Select the environment to work with. It should match the WooCommerce environment you selected.', WPDG_TEXT_DOMAIN ); ?></p>
    <table class="form-table wpdg-table-outer product-fee-table">
        <tbody>
            <tr valign="top">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'Connection type', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td><?php 

                    $wpdg_auth = array(
                        "0" => __('Sandbox', WPDG_TEXT_DOMAIN),
                        "1" => __('Live', WPDG_TEXT_DOMAIN),
                    );
                    echo  '<select name = "wpdg_connection_type" class="multiselect2">' ;
                    foreach ( $wpdg_auth as $wpdg_field_key => $wpdg_field ) {
                        $selectedVal = ( !empty($wpdg_connection_type) && $wpdg_field_key==$wpdg_connection_type ) ? 'selected=selected' : '' ;
                        $selectedAuth = ( !empty($wpdg_connection_type) ) ? intval($wpdg_connection_type) : 0 ;
                        echo  '<option value="' . esc_attr( $wpdg_field_key ) . '" ' . esc_attr( $selectedVal ) . '>' . esc_html__( $wpdg_field, WPDG_TEXT_DOMAIN ) . '</option>' ;
                    }
                    echo  '</select>' ;
                    
                    ?>
                </td>
                <td class="forminp mdtooltip">
                    <p class="wpdg_tooltip_desc description"></p>
                </td>
            </tr>
            <tr class="auth_data">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'Paypal client ID', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="forminp mdtooltip">
                    <label>
                        <input type="text" name="wpdg_auth_user" style="min-width: 20em;" value="<?php echo esc_attr( $wpdg_auth_user ); ?>" />
                    </label>
                </td>
                <td class="forminp mdtooltip"></td>  
            </tr>
            <tr class="auth_data">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'Paypal client secret', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="forminp mdtooltip">
                    <label>
                        <input type="text" name="wpdg_auth_pass" style="min-width: 20em;" value="<?php echo esc_attr( $wpdg_auth_pass ); ?>" />
                    </label>
                </td>
                <td class="forminp mdtooltip"></td>    
            </tr>
            <tr class="auth_data">
                <th class="titledesc" scope="row">
                    <label><?php esc_html_e( 'Paypal client signature', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="forminp mdtooltip">
                    <label>
                        <input type="text" name="wpdg_auth_sign" style="min-width: 20em;" value="<?php echo esc_attr( $wpdg_auth_sign ); ?>" />
                    </label>
                </td>
                <td class="forminp mdtooltip"></td>    
            </tr>
        </tbody>
    </table>
</div>
<?php 
