<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', '80cpmgmo9pspi70ck31cwaapn47s7f6dh' );

// WooFramework init
require_once ( get_template_directory() . '/functions/admin-init.php' );

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php',			// Theme widgets
				'includes/theme-install.php'			// Theme installation
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );

foreach ( $includes as $i ) {
	locate_template( $i, true );
}

if ( is_woocommerce_activated() ) {
	locate_template( 'includes/theme-woocommerce.php', true );
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

/*add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_address_2']['label'] = 'Adresszusatz';
     $fields['shipping']['shipping_address_2']['label'] = 'Adresszusatz';
     return $fields;
}*/

add_filter( 'woocommerce_billing_fields', 'wc_npr_filter_phone', 10, 1 );
add_filter( 'woocommerce_shipping_fields', 'wc_addr2_label', 10, 1 );
add_filter( 'woocommerce_checkout_process', 'send_order_details', 10, 1 );
 
function send_order_details ( $order ) {
	$order_details = "Test!";
	
	echo "<script text='type/javascript'>alert('{$order_details}')</script>";
}
 
function wc_addr2_label ( $address_fields ) {
	$address_fields['shipping_address_2']['label'] = 'Adresszusatz';
	return $address_fields;
}
 
function wc_npr_filter_phone( $address_fields ) {
	$address_fields['billing_address_2']['label'] = 'Adresszusatz';
	$address_fields['billing_phone']['required'] = false;
	return $address_fields;
}

/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>