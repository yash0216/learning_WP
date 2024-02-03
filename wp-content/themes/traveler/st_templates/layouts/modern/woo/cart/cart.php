<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.0.1
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
do_action('woocommerce_before_cart'); ?>
<div class="row st-woo-cartpage">
    <div class="col-md-8 col-left">
		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<h2 class="st-woo-heading"><?php echo __('Cart items', 'traveler'); ?></h2>
			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents booking-list booking-list-wishlist" cellspacing="0">
				<thead>
					<tr>
						<th class="product-remove"><span class="screen-reader-text"><?php esc_html_e( 'Remove item', 'traveler' ); ?></span></th>
						<th class="product-thumbnail"><span class="screen-reader-text"><?php esc_html_e( 'Thumbnail image', 'traveler' ); ?></span></th>
						<th class="product-name"><?php esc_html_e( 'Product', 'traveler' ); ?></th>
						<th class="product-price"><?php esc_html_e( 'Price', 'traveler' ); ?></th>
						<th class="product-quantity"><?php esc_html_e( 'Quantity', 'traveler' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						// Traveler
						$product_url = '';
						$product_title = '';
						$post_type = false;
						if (isset($cart_item['st_booking_data']) and !empty($cart_item['st_booking_data'])) {
							$st_booking_data = $cart_item['st_booking_data'] ?? array();

							$post_type = isset($st_booking_data['st_booking_post_type']) ? $st_booking_data['st_booking_post_type'] : false;

							$booking_id = isset($st_booking_data['st_booking_id']) ? $st_booking_data['st_booking_id'] : false;
							if ($booking_id) {

								$product_url = get_permalink($booking_id);
							}
						}
						$product_title = $_product->get_title();
						if (!empty($booking_id)){
							$product_title = get_the_title($booking_id);
						}


						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

								<td class="product-remove <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
									<?php
										do_action('st_before_cart_item_' . $post_type);
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" class="remove booking-item-wishlist-remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times"></i></a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												esc_html__( 'Remove this item', 'traveler' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											),
											$cart_item_key
										);
									?>
								</td>

								<td class="product-thumbnail">
									<?php
										if (isset($cart_item['st_booking_data']) and !empty($cart_item['st_booking_data'])) {
											$st_booking_data = $cart_item['st_booking_data'];
											$booking_id = isset($st_booking_data['st_booking_id']) ? $st_booking_data['st_booking_id'] : false;

											$hotel_alone_in_setting = st()->get_option('hotel_alone_assign_hotel', '');
											if(isset($st_booking_data['st_booking_post_type']) && $st_booking_data['st_booking_post_type'] == 'st_hotel' && $hotel_alone_in_setting == $booking_id){
												printf('<a href="%s" target="_blank">%s</a>', get_permalink($st_booking_data['room_id']), get_the_post_thumbnail($st_booking_data['room_id'], 'thumbnail', array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($st_booking_data['room_id'])))));
											}else{
												if($st_booking_data['st_booking_post_type'] === 'car_transfer'){
													printf('<a href="%s" target="_blank">%s</a>', '#', get_the_post_thumbnail($booking_id, 'thumbnail', array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($booking_id)))));
												} else {
													printf('<a href="%s" target="_blank">%s</a>', get_permalink($booking_id), get_the_post_thumbnail($booking_id, 'thumbnail', array('alt' => TravelHelper::get_alt_image(get_post_thumbnail_id($booking_id)))));
												}
											}



										} else {
											$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

											if (!$_product->is_visible()) {
												if(!empty($st_booking_data['st_booking_post_type']) && $st_booking_data['st_booking_post_type'] === 'car_transfer'){
													echo '<a href="#">'.$product_title.'</a>';
												} else {
													echo apply_filters('woocommerce_cart_item_name', $product_title, $cart_item, $cart_item_key) . '&nbsp;';
												}
											}else {
												if(!empty($st_booking_data['st_booking_post_type']) && $st_booking_data['st_booking_post_type'] === 'car_transfer'){
													echo '<a href="#">'.$product_title.'</a>';
												} else {
													echo apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" target="_blank">%s </a>', $product_url, $product_title), $cart_item, $cart_item_key);
												}
											}
										}

									?>
								</td>

								<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'traveler' ); ?>">
									<h5 class="booking-item-title">
										<?php
										if (!$_product->is_visible()) {
											echo apply_filters('woocommerce_cart_item_name', $product_title, $cart_item, $cart_item_key) . '&nbsp;';
										}else {
											if(!empty($st_booking_data['st_booking_post_type']) && $st_booking_data['st_booking_post_type'] === 'car_transfer'){
												echo '<a href="#">'.$product_title.'</a>';
											} else {
												echo apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" target="_blank">%s </a>', $product_url, $product_title), $cart_item, $cart_item_key);
											}

										}

										// Meta data
										echo wc_get_formatted_cart_item_data($cart_item);

										// Backorder notification
										if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity']))
											echo '<p class="backorder_notification">' . __('Available on backorder', 'traveler') . '</p>';
										?>
									</h5>
									<?php
									if (isset($cart_item['st_booking_data']) and !empty($cart_item['st_booking_data'])) {
										$st_booking_data = $cart_item['st_booking_data'];
										$st_booking_data['cart_item_key'] = $cart_item_key;

										$booking_id = isset($st_booking_data['st_booking_id']) ? $st_booking_data['st_booking_id'] : false;

										if ($post_type and $booking_id) {
											$address = get_post_meta($booking_id, 'address', true);
											if ($address) {
												echo '<p class="booking-item-address">' . TravelHelper::getNewIcon('Ico_maps', '#666666', '15px', '15px', true) . esc_html($address) . '</p>';
											}

											do_action('st_wc_cart_item_information_' . $post_type, $st_booking_data);
										}

									}

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

									// Meta data.
									echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

									// Backorder notification.
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'traveler' ) . '</p>', $product_id ) );
									}
									?>
								</td>

								<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'traveler' ); ?>">
									<span class="booking-item-price">
										<?php
										echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
										?>
									</span>
								</td>

								<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'traveler' ); ?>">
									<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
								</td>
							</tr>
							<?php
						}
					}
					?>

					<?php do_action( 'woocommerce_cart_contents' ); ?>

					<tr>
						<td colspan="6" class="actions">

							<?php if (wc_coupons_enabled()) { ?>
								<div class="coupon">
								<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'traveler' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'traveler' ); ?>" /> <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'traveler' ); ?>"><?php esc_attr_e( 'Apply coupon', 'traveler' ); ?></button>
									<?php do_action('woocommerce_cart_coupon'); ?>

								</div>
							<?php } ?>
							<button type="submit" class="button btn btn-primary<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'traveler' ); ?>"><?php esc_html_e( 'Update cart', 'traveler' ); ?></button>

							<?php do_action('woocommerce_cart_actions'); ?>

							<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
						</td>
					</tr>

					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>
    </div>
	<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
    <div class="col-md-4 col-right">
        <h2 class="st-woo-heading"><?php _e( 'Cart totals', 'traveler' ); ?></h2>
        <div class="cart-collaterals">
            <?php do_action('woocommerce_cart_collaterals'); ?>
        </div>
    </div>
</div>
<?php do_action('woocommerce_after_cart'); ?>
