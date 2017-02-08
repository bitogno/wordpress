<?php
/*
Template Name: fav
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
		<div id="main-content" class="main-content col-xs-12">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

				<?php 
				wp_enqueue_style( "dataTablesCss", '/wp-content/themes/domoum/editor/css/jquery.dataTables.min.css');
				wp_enqueue_style( "editorCss", '/wp-content/themes/domoum/editor/css/editor.dataTables.css');
				?>
				<div id="space"></div>
				<div id="menuPers" class="col-lg-3">
					<h3>Espace personnel</h3>
					<?php 
					$args = array( 'menu' => 'Espace personnel');
						wp_nav_menu($args); ?>
				</div>

				<div class="col-lg-9" id="tablesFav">
					<h2>Coups de coeur</h2>
					<div class="columnCoups">
						<p>Ajouter / Enlever colonne : 
						<a class="toggle-vis" data-column="2">Url</a> - 
						<a class="toggle-vis" data-column="3">Coordonnées</a> - 
						<a class="toggle-vis" data-column="4">Email envoyé</a> - 
						<a class="toggle-vis" data-column="5">Réponse</a> - 
						<a class="toggle-vis" data-column="6">Appel fait</a> - 
						<a class="toggle-vis" data-column="7">Réponse</a> - 
						<a class="toggle-vis" data-column="8">Visite</a> - 
						<a class="toggle-vis" data-column="9">Commentaire</a>
					</div>

					<table id="coups" class="display" cellspacing="0" width="100%">
				        <thead>
				            <tr>
				           		<th>Id</th>
				                <th>Bien</th>
				                <th>Url</th>
				                <th>Coordonnées</th>
				                <th>Email envoyé</th>
				                <th>Réponse</th>
				                <th>Appel fait</th>
				                <th>Réponse</th>
				                <th>Visite</th>
				                <th>Commentaire</th>
				            </tr>
				        </thead>
				    </table>

				    <h2 id="favTitle">Favoris</h2>
					<div class="columnCoups">
						<p>Ajouter / Enlever colonne : 
						<a class="toggle-vis-fav" data-column="2">Url</a> - 
						<a class="toggle-vis-fav" data-column="3">Coordonnées</a> - 
						<a class="toggle-vis-fav" data-column="4">Email envoyé</a> - 
						<a class="toggle-vis-fav" data-column="5">Réponse</a> - 
						<a class="toggle-vis-fav" data-column="6">Appel fait</a> - 
						<a class="toggle-vis-fav" data-column="7">Réponse</a> - 
						<a class="toggle-vis-fav" data-column="8">Visite</a> - 
						<a class="toggle-vis-fav" data-column="9">Commentaire</a>
					</div>

					<table id="favs" class="display" cellspacing="0" width="100%">
				        <thead>
				            <tr>
				           		<th>Id</th>
				                <th>Bien</th>
				                <th>Url</th>
				                <th>Coordonnées</th>
				                <th>Email envoyé</th>
				                <th>Réponse</th>
				                <th>Appel fait</th>
				                <th>Réponse</th>
				                <th>Visite</th>
				                <th>Commentaire</th>
				            </tr>
				        </thead>
				    </table>
				</div>

<?php

				wp_enqueue_script( 'jQueryJs', '/wp-content/themes/domoum/editor/js/jquery.js');
				wp_enqueue_script( 'dataTablesJs', '/wp-content/themes/domoum/editor/js/jquery.dataTables.min.js');
				wp_enqueue_script( 'editorJs', '/wp-content/themes/domoum/editor/js/dataTables.editor.js');
				wp_enqueue_script( 'buttonsJs', '/wp-content/themes/domoum/editor/js/dataTables.buttons.min.js');
				wp_enqueue_script( 'selectJs', '/wp-content/themes/domoum/editor/js/dataTables.select.min.js');
				wp_enqueue_script( 'Favjs', '/wp-content/themes/domoum/datatablesFav.js');
				wp_enqueue_script( 'Ccjs', '/wp-content/themes/domoum/datatablesCc.js');



				// echo do_shortcode('[events_calendar long_events=1 full=1]');
				// $user_id = get_current_user_id();

				// $board_id = $wpdb->get_var("SELECT id FROM wp_kanban_boards WHERE user_id_author = '".$user_id."'");
				// echo do_shortcode('[kanban id="'.$board_id.'"]');
				?>


				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
			
		</div><!-- #main-content -->
		
	</div>	
</section>
<?php

get_footer();