<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( ! $post->post_excerpt ) return;
?>

	<?php $excerpt = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	$excerpt = str_replace('<p>','<p class="description">',$excerpt);
	echo $excerpt;
	?>