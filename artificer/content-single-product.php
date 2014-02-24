<div class="main_content">

	<?php
		/**
		 * The template for displaying product content in the single-product.php template
		 *
		 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
		 *
		 * @author 		WooThemes
		 * @package 	WooCommerce/Templates
		 * @version     1.6.4
		 */

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	?>

	<h1 class="page_title">
	<?php
		the_title();
	?>
	</h1>

	<?php
		/**
		 * woocommerce_before_single_product hook
		 *
		 * @hooked woocommerce_show_messages - 10
		 */
		 //do_action( 'woocommerce_before_single_product' );
	?>

	<div class="product_image">
		<div id="big_image_container">
			<?php 
				if ( has_post_thumbnail() ) {

				$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
				$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title' => $image_title
					) );
				$attachment_count   = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

				} else {

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

				}
			?>
		</div>
	</div>

		<?php
			/**
			 * woocommerce_show_product_images hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			//do_action( 'woocommerce_before_single_product_summary' );
		?>

		
	<div class="product_information"> 			

		<?php
			global $product;
			$in_stock = $product->is_in_stock();
			printf('<div class="%s"><span>%s</span></div>', $in_stock ? 'product_status in_stock' : 'product_status not_available', $in_stock ? 'verfügbar' : 'ausverkauft');
		?>
		<div class="row end">&nbsp;</div>
		
		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
			
			woocommerce_template_single_excerpt();
		?>
			
		<div class="product_options">
			<?php				
				woocommerce_template_single_price();
				woocommerce_template_single_add_to_cart();
				/*do_action( 'woocommerce_single_product_summary' );
				woocommerce_template_single_rating();
				woocommerce_template_single_sharing();*/				
			?>
			
			<p>
				<?php
					global $product;
					echo $product->get_tax_class();
					$_tax = new WC_Tax();//looking for appropriate vat for specific product
					$rates = array_shift($_tax->get_rates( $product->get_tax_class() ));
					if (isset($rates['rate'])) {	//vat found
						if ($rates['rate'] == 0) {	//if 0% vat
							$prima_tax_rate="mehrwertsteuerbefreit";
						} else {
							$prima_tax_rate="inkl. ".round($rates['rate'])."% MwSt. ";
						}
					} else {//FailSafe: just in case
						$prima_tax_rate="failsafe";
					}
					echo $prima_tax_rate;
					echo '</br>';				
					echo 'zzgl. <a href="http://buegelland.de/?p=22">Versand</a> <br/>';
					
					// Lieferzeit 
					if( class_exists( 'WGM_Template' ) ) {
						echo WGM_Template::add_template_loop_shop();
					}

					echo $product->_lieferzeit;
				?>
			</p>
			
		</div>

	</div><!-- .summary -->

	<h2 class="page_subtitle no_margins">Das könnte Sie auch interessieren...</h2>
	<div class="products_list">
		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_output_related_products - 20
			 */
			//do_action( 'woocommerce_after_single_product_summary' );
			woocommerce_output_related_products();
		?>

	</div><!-- #product-<?php the_ID(); ?> -->

	<?php //do_action( 'woocommerce_after_single_product' ); ?>

</div>
