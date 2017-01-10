<?php
/*
Template Name: propertyPartner
*/
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WpOpal
 * @subpackage fullhouse
 * @since fullhouse 1.0
 */
global $fullhouse_page_layouts; 
$fullhouse_page_layouts = apply_filters( 'fullhouse_fnc_get_page_sidebar_configs', null );

get_header( apply_filters( 'fullhouse_fnc_get_header_layout', null ) );
?>
<?php do_action( 'fullhouse_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('fullhouse_template_main_container_class','container');?> inner">
	<div class="row">
		<?php if( isset($fullhouse_page_layouts['sidebars']) && !empty($fullhouse_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>	
		<div id="main-content" class="main-content col-xs-12 <?php echo esc_attr($fullhouse_page_layouts['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
				<?php 
				$user_id = get_current_user_id();

				$querystr = "SELECT $wpdb->kanban_boards.* FROM $wpdb->kanban_boards WHERE $wpdb->kanban_boards.user_id_author = '".$user_id."'";
						$boards = $wpdb->get_results($querystr, OBJECT);

						foreach ($pageposts as $post){
							echo 
						}

				echo do_shortcode('[kanban id=""');
				?>
				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
			
		</div><!-- #main-content -->
		
	</div>	
</section><?php

get_footer();