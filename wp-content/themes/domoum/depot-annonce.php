<?php
/*
Template Name: Annonce
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
		<div id="main-content" class="main-content col-xs-12 col-lg-12">
			<div id="primary" class="content-area titleAnnonce">
			<h3> Déposer une annonce </h3>
				<form class="form-inline col-lg-12" method="get" action="" id="formAnnonce">
					<div class="row">
					<div class="radio">
					  <label>
					    <input type="radio" name="choice" id="optionsRadios1" value="Vente">
					    Vente
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" name="choice" id="optionsRadios2" value="Location">
					    Location
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" name="choice" id="optionsRadios3" value="Colocation">
					    Colocation
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" name="choice" id="optionsRadios4" value="Viager">
					    Viager
					  </label>
					</div>
					<div class="radio">
					  <label>
					    <input type="radio" name="choice" id="optionsRadios5" value="Enchere">
					    Enchère / Crowfunding
					  </label>
					</div>
					</div>
					<div class="row">
					<button type="submit" class="btn btn-danger" id="submitAnnonce">Trouver</button>
					</div>
				</form>

					<?php 
						$querystr = "SELECT $wpdb->posts.* FROM $wpdb->posts WHERE $wpdb->posts.post_type = 'post-website'";
						$pageposts = $wpdb->get_results($querystr, OBJECT);

						foreach ($pageposts as $post){
							setup_postdata($post);
							$post_id = get_the_ID();
							$website_type = get_post_meta( $post_id, 'website_type', true);
							$website_url = get_post_meta( $post_id, 'website_url', true);
							
							if($website_type == $_GET['choice']){
								?>
								<div class="col-lg-4 siteresult">
									<a target="_blank" href="<?php echo $website_url ?>"><h3><?php the_title(); ?></h3></a>
								</div> <?php
							} else if(!empty($_GET['choice'])){
								 ?>
								<div id="noresult">
									<h3> Pas de résultats </h3>
								</div> <?php
							}
						} 
					?>

			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
			
		</div><!-- #main-content -->
		
	</div>	
</section>
<?php

get_footer();