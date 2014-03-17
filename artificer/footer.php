<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;

	$total = 4;
	if ( isset( $woo_options['woo_footer_sidebars'] ) && ( $woo_options['woo_footer_sidebars'] != '' ) ) {
		$total = $woo_options['woo_footer_sidebars'];
	}

	if ( ( woo_active_sidebar( 'footer-1' ) ||
		   woo_active_sidebar( 'footer-2' ) ||
		   woo_active_sidebar( 'footer-3' ) ||
		   woo_active_sidebar( 'footer-4' ) ) && $total > 0 ) {

?>
	
	<?php woo_footer_before(); ?>
		
	<section id="footer-widgets" class="col-full col-<?php echo $total; ?> fix">
	
		<?php $i = 0; while ( $i < $total ) { $i++; ?>
			<?php if ( woo_active_sidebar( 'footer-' . $i ) ) { ?>

		<div class="block footer-widget-<?php echo $i; ?>">
        	<?php woo_sidebar( 'footer-' . $i ); ?>
		</div>

	        <?php } ?>
		<?php } // End WHILE Loop ?>

	</section><!-- /#footer-widgets  -->
<?php } // End IF Statement ?>
	</div> <!-- Closes content clearfix -->
	<footer id="footer" class="col-full">
	
	<div class="footer">

		<ul class="clearfix">
			<?php
				$my_pages = wp_list_pages('echo=0&title_li=&include=28,25,23,26,21,24');
				$var1 = '><a';
				$var2 = '>| <a';
				$my_pages = str_replace($var1, $var2, $my_pages);
				echo $my_pages;
			?>
		</ul>
		
		<script type="text/javascript">
			$('.page_item').each(function() {
				if(this.className.indexOf("28") != -1) {
					this.innerHTML = this.innerHTML.substring(1);
				}
			});
		</script>
	
		<!--
		<div id="copyright" class="col-left">
		<?php if( isset( $woo_options['woo_footer_left'] ) && $woo_options['woo_footer_left'] == 'true' ) {

				echo stripslashes( $woo_options['woo_footer_left_text'] );

		} else { ?>
			<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ); ?></p>
		<?php } ?>
		</div>
		-->

		<div id="credit" class="col-right">
        <?php if( isset( $woo_options['woo_footer_right'] ) && $woo_options['woo_footer_right'] == 'true' ) {

        	echo stripslashes( $woo_options['woo_footer_right_text'] );

		} else { ?>
			<p><?php _e( 'Powered by', 'woothemes' ); ?> <a href="http://www.wordpress.org">WordPress</a> | Designed by <a href="<?php echo ( isset( $woo_options['woo_footer_aff_link'] ) && ! empty( $woo_options['woo_footer_aff_link'] ) ? esc_url( $woo_options['woo_footer_aff_link'] ) : 'http://themeforest.net/user/webtunes' ); ?>"> WebTunes </a> | Adjustments by David von Kiedrowski | <?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ); ?></p>
		<?php } ?>
		</div>
		
	</div>

	</footer><!-- /#footer  -->

</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
</body>
</html>