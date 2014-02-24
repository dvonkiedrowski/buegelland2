<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */

 global $woocommerce;
 update_option('woo_store_email_address','info@buegelland.de');
 update_option('woo_store_phone_number','0123 987654');
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php woo_title(''); ?></title>

<link href="/wp-content/themes/classicorange/css/style.css" rel="stylesheet" type="text/css" />
<link href="/wp-content/themes/classicorange/css/nav-menus.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/wp-content/themes/classicorange/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/wp-content/themes/classicorange/js/stuHover.js"></script>
<script type="text/javascript" src="/wp-content/themes/classicorange/js/jquery.flow.1.2.auto.js"></script>
<?php
	wp_head();
	//woo_head();
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#myController").jFlow({
		slides: "#slides",
		controller: ".jFlowControl", // must be class, use . sign
		slideWrapper : "#jFlowSlide", // must be id, use # sign
		selectedWrapper: "jFlowSelected",  // just pure text, no sign
		auto: true,		//auto change slide, default true
		width: "554px",
		height: "228px",
		duration: 600,
		prev: ".jFlowPrev", // must be class, use . sign
		next: ".jFlowNext" // must be class, use . sign
	});
});
</script>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

</head>

<body>

<div class="wrap" id="three_columns">
	
		<div id="head">
			<h1 class="logo">Buegelland</h1>
			<div class="basket"><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><img src="/wp-content/themes/classicorange/images/shopping-basket_bg.png" text="Basket" /><span>Warenkorb</span></a>
				<p>Anzahl: <strong><?php echo $woocommerce->cart->cart_contents_count; ?> </strong>
					<span> <?php echo $woocommerce->cart->get_cart_total(); ?></span></p>
			</div>
			<div class="top_banner">
				<p>Servicenummer: <?php echo get_option('woo_store_phone_number');?></p>
			</div>
			<div id="search">
				<form id="searchform" name="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
					<input name="s" type="text" value="Geben Sie einen Suchbegriff ein..."  onblur="this.value = this.value || this.defaultValue;" onfocus="this.value = '';" />
					<input type="submit" value="" name="search" class="button"/>
					<input type="hidden" name="post_type" value="product" />
				</form>
			</div>
		</div>
		
		<div id="main_nav">		
			<div class="user_nav"><a href="<?php echo get_page_link(8);?>">Mein Konto</a> <a href="<?php echo get_page_link(13);?>">Logout</a></div>
			<?php
			if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
				wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav', 'theme_location' => 'primary-menu' ) );
			} else {
			?>
	        <ul id="nav">
				<?php if ( is_page() ) $highlight = 'page_item'; else $highlight = 'page_item current_page_item'; ?>
				<li class="top"><a class="top_link" href="<?php echo home_url( '/' ); ?>"><span><?php _e( 'Startseite', 'woothemes' ); ?></span></a></li>
				<?php
					$my_pages = wp_list_pages('echo=0&title_li=&include=28,25,23,26,21,24');
					$var1 = '<a';
					$var2 = '<a class="top_link"';
					$var3 = '<li';
					$var4 = '<li class="top"';
					$var5 = '">';
					$var6 = '"><span>';
					$var7 = '</a';
					$var8 = '</span></a';
					$my_pages = str_replace($var1, $var2, $my_pages);
					$my_pages = str_replace($var3, $var4, $my_pages);
					$my_pages = str_replace($var5, $var6, $my_pages);
					$my_pages = str_replace($var7, $var8, $my_pages);
					echo $my_pages;
				?>
			</ul>
	        <?php } ?>	
		</div>
		
		<div class="content clearfix">
			<div class="left_column">
				<div class="product_menu"> 
					<h2>Kategorien</h2>
					<ul id="prod_nav" class="clearfix"> 
					<?php
						$terms = get_terms('product_cat');
						foreach ($terms as $term) {
							//Always check if it's an error before continuing. get_term_link() can be finicky sometimes
							$term_link = get_term_link( $term, 'species' );
							if( is_wp_error( $term_link ) )
								continue;
							//We successfully got a link. Print it out.
							echo '<li class="top"><a href="' . $term_link . '" class="top_link"><span>' . $term->name . '</span></a></li>';
						}
					?>
					</ul>
				</div>
				<div class="box newsletter_box"> 
					<h2>Newsletter</h2>
					<p> Melden Sie sich hier an, um mit dem Newsletter die neusten Informationen zu Produkten und Angeboten zu bekommen. </p>
					<?php 
						if( function_exists( 'mc4wp_form' ) ) {
							mc4wp_form();
						}
					?>
					<!--<form action="02-Orange-01-Home-Page.html">
						<input name="email" type="text" tabindex="1" onblur="if (this.value==''){this.value='E-Mail-Addresse'};" onfocus="if(this.value=='E-Mail-Addresse'){this.value=''};" value="E-Mail-Addresse" />
						<div align="right">
							<input name="subscribe" type="submit" value="Abonnieren" class="button" />
						</div>
					</form>-->
				</div>
			</div>