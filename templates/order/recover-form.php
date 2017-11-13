<?php
/**
 * Created by PhpStorm.
 * User: tu
 * Date: 10/10/17
 * Time: 9:31 AM
 */

$order_key = isset( $order ) && is_a( $order, 'LP_Order' ) ? $order->get_order_key() : '';
?>
<div class="order-recover">
    <input type="text" name="order-key" value="<?php echo $order_key; ?>"
           placeholder="<?php _e( 'Order key', 'learnpress' ); ?>">
    <input type="hidden" name="recover-order-nonce" value="<?php echo wp_create_nonce( 'recover-order' ); ?>">
    <input type="hidden" name="lp-ajax" value="recover-order">
    <button type="button" class="button-recover-order"><?php _e( 'Recover', 'learnpress' ); ?></button>
</div>
