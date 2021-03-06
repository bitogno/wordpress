<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  

get_header( apply_filters( 'opalestate_fnc_get_header_layout', null ) ); ?>
<div class="wpo-breadcrumb single-office-breadcrumb">
	<?php do_action( 'fullhouse_template_main_before' ); ?>
</div>
	<section id="main-container" class="site-main container" role="main">
		<main id="primary" class="content content-area">
			<?php if ( have_posts() ) : ?>
				<div class="single-opalestate-container">
					<?php while ( have_posts() ) : the_post(); ?>
	                    <?php echo Opalestate_Template_Loader::get_template_part( 'content-single-office' ); ?>
					<?php endwhile; ?>
				</div>
				<?php the_posts_pagination( array(
					'prev_text'          => __( 'Previous page', 'opalestate' ),
					'next_text'          => __( 'Next page', 'opalestate' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'opalestate' ) . ' </span>',
				) ); ?>
				
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>