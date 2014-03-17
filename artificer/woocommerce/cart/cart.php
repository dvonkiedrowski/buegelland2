<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<h1 class="page_title"> <?php the_title(); ?> </h1>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
		?>
				<div class="clearfix basket_list">

					<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $_product->is_visible() )
							echo $thumbnail;
						else
							printf( '<a class="product_img" href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
					?>
					
					<div class="cart_wrapper">
						<div class="cart_item_left_col">
							<?php
								if ( ! $_product->is_visible() )
									echo sprintf('<h2><a href="%s">%s</a></h2>', $_product->get_permalink(), $_product->get_title() );
								else
									echo sprintf('<h2><a href="%s">%s</a></h2>', $_product->get_permalink(), $_product->get_title() );
							?>
							
							<span class="price">
								<?php
									printf('Preis: <strong>%s</strong>', WC()->cart->get_product_price( $_product ));
								?>
							</span>
						
							<?php 
								$in_stock = $_product->is_in_stock();
								printf('<span class="%s"><span style="margin-left: 5px;">%s</span></span>', $in_stock ? 'product_status in_stock' : 'product_status not_available', $in_stock ? 'verfügbar' : 'ausverkauft'); 
							?>	
						</div>
						
						<div class="cart_item_middle_col">
							<?php
								// Meta data
								echo WC()->cart->get_item_data( $cart_item );

								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
									echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
							?>
						</div>											
					</div>
						
					<div class="quantity_options clearfix">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
								), $_product, false );
							}
							echo '<label>Menge</label>';
							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
						<input type="submit" class="silver_btn save_btn" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" /> <input type="submit" class="checkout-button button alt wc-forward" name="proceed" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?>" />
							
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" title="%s"><input type="button" value="entfernen" class="silver_btn remove_btn"></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
						?>
					</div>
					
				</div>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		
		<tr>
			<td colspan="6" class="actions">

				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>

				<input type="submit" class="silver_btn" style="float: right;" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" /> <input type="submit" class="checkout-button button alt wc-forward" name="proceed" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?>" />

				<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	<?php woocommerce_cart_totals(); ?>

	<?php woocommerce_shipping_calculator(); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>