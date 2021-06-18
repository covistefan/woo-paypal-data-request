<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>
<div id="wpdg-dataset" class="tabcontent">
    <h2><?php esc_html_e( 'Dataset preferences', WPDG_TEXT_DOMAIN ); ?></h2>
    <p><?php esc_html_e( 'What data should be requested from Paypal.', WPDG_TEXT_DOMAIN ); ?> <?php esc_html_e( 'Some data is not avaiable outside US.', WPDG_TEXT_DOMAIN ); ?></p>
    <table class="form-table wpdg-table-outer product-fee-table">
        <tbody>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'PP email-address', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wpdg_dataset_email" value="on" <?php echo  esc_attr( $wpdg_dataset_email ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'PP surname', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wpdg_dataset_surname" value="on" <?php echo  esc_attr( $wpdg_dataset_surname ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'PP name', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" name="wpdg_dataset_name" value="on" <?php echo  esc_attr( $wpdg_dataset_name ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'PP address', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" disabled name="wpdg_dataset_address" value="on" <?php echo  esc_attr( $wpdg_dataset_address ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'PP zipcode', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" disabled name="wpdg_dataset_zip" value="on" <?php echo  esc_attr( $wpdg_dataset_zip ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'PP city', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" disabled name="wpdg_dataset_city" value="on" <?php echo  esc_attr( $wpdg_dataset_city ) ; ?>>
                    </label>
                </td>
                <td>
                    <p></p>
                </td>
            </tr>
            <tr>
                <th class="titledesc">
                    <label><?php esc_html_e( 'PP country', WPDG_TEXT_DOMAIN ); ?></label>
                </th>
                <td class="checkbox">
                    <label>
                        <input type="checkbox" disabled name="wpdg_dataset_country" value="on" <?php echo  esc_attr( $wpdg_dataset_country ) ; ?>>
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
