<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WpOpal
 * @subpackage fullhouse
 * @since fullhouse 1.0
 */
$footer_profile =  apply_filters( 'fullhouse_fnc_get_footer_profile', 'default' ); 
?>

		</section><!-- #main -->
		<?php do_action( 'fullhouse_template_main_after' ); ?>
		
		<div class="footer-wrapper">
			
			<?php get_template_part( 'page-templates/parts/footer-bg' ); ?>
					
			<footer id="pbr-footer" class="pbr-footer" role="contentinfo">

			</footer><!-- #colophon -->
			<div class="pbr-copyright">
				<div class="container">
					<a href="#" class="scrollup"><span class="fa fa-angle-up"></span></a>
					<div class="site-info">
						<a href="<?php echo get_page_link(12514); ?>">Mentions légales</a>  -  
						<a href="<?php echo get_page_link(12530); ?>">Conditions générales d'utilisation</a>  -  
						<a href="<?php echo get_page_link(9515); ?>">Contactez nous</a>
						<p>Copyright "SAS Domoum"</p>
						<?php do_action( 'fullhouse_fnc_credits' ); ?>
					</div><!-- .site-info -->
				</div>	
			</div>

		</div>
		<!-- .footer-wrapper -->
		
	
		<?php do_action( 'fullhouse_template_footer_after' ); ?>
		<?php get_sidebar( 'offcanvas' );  ?>
	</div>
</div>
	<!-- #page -->

<?php wp_footer(); ?>
</body>
</html>