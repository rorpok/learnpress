<?php
/**
 * Template for displaying order details
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! isset( $order ) ) {
	echo __( 'Invalid order', 'learnpress' );

	return;
}

?>
<h3><?php _e( 'Order Details', 'learnpress' ); ?></h3>

<table class="lp-list-table order-table-details">
    <thead>
    <tr>
        <th class="course-name"><?php _e( 'Course', 'learnpress' ); ?></th>
        <th class="course-total"><?php _e( 'Total', 'learnpress' ); ?></th>
    </tr>
    </thead>
    <tbody>
	<?php
	if ( $items = $order->get_items() ) {
		$currency_symbol = learn_press_get_currency_symbol( $order->get_currency() );

		foreach ( $items as $item_id => $item ) {
			if ( apply_filters( 'learn-press/order/item-visible', true, $item ) ) {
				$course = learn_press_get_course( $item['course_id'] );
				if ( ! $course->exists() ) {
					continue;
				}
				?>
                <tr class="<?php echo esc_attr( apply_filters( 'learn-press/order/item-class', 'order-item', $item, $order ) ); ?>">
                    <td class="course-name">
						<?php
						echo apply_filters( 'learn-press/order/item-name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['course_id'] ), $item['name'] ), $item );
						?>
                    </td>
                    <td class="course-total">
						<?php
						if ( $price = $course->get_price_html() ) {
							$origin_price = $course->get_origin_price_html();
							if ( $course->has_sale_price() ) {
								echo '<span class="course-origin-price">' . $origin_price . '</span>';
							}
							echo '<span class="course-price">' . $price . '</span>';
						}
						?>
                    </td>
                </tr>
				<?php
			}
		}
	}

	// @deprecated
	do_action( 'learn_press_order_items_table', $order );

	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/order/items-table', $order );

	?>
    </tbody>
    <tfoot>
    <tr>
        <th scope="row"><?php _e( 'Subtotal', 'learnpress' ); ?></th>
        <td><?php echo $order->get_formatted_order_subtotal(); ?></td>
    </tr>
    <tr>
        <th scope="row"><?php _e( 'Total', 'learnpress' ); ?></th>
        <td><?php echo $order->get_formatted_order_total(); ?></td>
    </tr>
    </tfoot>
</table>

<?php

do_action( 'learn-press/order/after-table-details', $order );
?>
