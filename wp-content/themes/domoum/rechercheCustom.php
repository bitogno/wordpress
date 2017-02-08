<?php
/*
Template Name: alerte
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

// Required field names
$required = array('type', 'location', 'priceLow', 'priceHigh', 'surfaceLow', 'surfaceHigh', 'email');

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  if (!empty($_POST[$field])) {
    $error = true;
  }
}

if ($error) {
    $new_property = array(
		'post_author'=>get_current_user_id(),
		'post_title'=>"Alerte",
		'post_content' =>"Alert mail",
		'post_status'=>'',
		'comment_status'=>"closed",
		'post_name'=>"Alerte",
		'post_type'=>'mailAlert'
 	);
  	$post_id = wp_insert_post($new_property);

	foreach($required as $field) {
	  	if (!empty($_POST[$field])) {
	    	update_post_meta($post_id, $field, $_POST[$field]);
	  	}
	}
} else {
}

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

					<div id="menuPers" class="col-lg-3">
					<div id="space"></div>
						<h3>Espace personnel</h3>
						<?php 
						$args = array( 'menu' => 'Espace personnel');
							wp_nav_menu($args); ?>
					</div>

					<div class="col-lg-9" id="tablesFav">
					<h3 id="alertTitle">Créer une alerte mail</h3>
						<div class="form-group">
							<form action="" method="post">
								<div class=" col-lg-5">
		  							<div class="form-group">
									  <label for="sel1">Selectionnez le type d'annonce</label>
									  <select class="form-control" id="type" name="type">
									  	<option></option>
									    <option>Vente</option>
									    <option>Location</option>
									    <option>Colocation</option>
									    <option>Viager</option>
									    <option>Enchère</option>
									  </select>
									</div>
									<div class="form-group">
									  <label for="sel1">Indiquez le lieu</label>
									  <input name="location" id="location" type="text" class="form-control"  placeholder="Indiquez le lieu"/>
									</div>
									<div class="form-group">
									    <label for="exampleInputEmail1">Email</label>
									    <input type="email" name="email" class="form-control" id="emailAlert" placeholder="Email" required=""  oninvalid="this.setCustomValidity('Veuillez entrer un email valide')">
									</div>
									<button type="submit" class="btn btn-primary">Créer</button>
								</div>
								<div class=" col-lg-5 col-lg-offset-1">
									<div class="form-group row interv">
										<div class="row intervLabel">
											<label for="sel1">Prix</label>	
										</div>
										<div class="row">
											<div class="col-lg-6">
												<input name="priceLow" id="priceLow" type="text" class="form-control"  placeholder="Prix bas €"/>
											</div>
											
											<div class="col-lg-6">
												<input name="priceHigh" id="priceHigh" type="text" class="form-control"  placeholder="Prix haut €"/>
											</div>
										</div>
									</div>
									<div class="form-group row interv">
										<div class="row intervLabel">
											<label for="sel1">Surface</label>	
										</div>
										<div class="row">
											<div class="col-lg-6">
												<input name="surfaceLow" id="surfaceLow" type="text" class="form-control"  placeholder="Surface min"/>
											</div>
											
											<div class="col-lg-6">
												<input name="surfaceHigh" id="surfaceHigh" type="text" class="form-control"  placeholder="Surface max"/>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div><!-- #content -->
			</div><!-- #primary -->
			<?php get_sidebar( 'content' ); ?>
			
		</div><!-- #main-content -->
		
	</div>	
</section>
<?php

get_footer();