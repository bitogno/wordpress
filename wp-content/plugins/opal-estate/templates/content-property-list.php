<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$property = opalesetate_property( get_the_ID() );

global $property, $post;

$meta   = $property->get_meta_shortinfo();
 
?>
<article itemscope itemtype="http://schema.org/Property" <?php post_class(); ?>><div class="property-list-style-v2">
	</br>
	<div class="property-list container-cols-3">
		<header>
			<div class="property-group-label">
				<?php do_action( 'opalestate_before_property_loop_item' ); ?>
			</div>
			<div class="col-lg-11">
				<!-- <img src=<?php echo get_the_excerpt(get_the_id())?> class="attachment-large size-large wp-post-image" alt=""> -->
				<?php opalestate_get_loop_thumbnail( opalestate_get_option('loop_image_size','large') ); ?> 
				<?php opalestate_get_loop_short_meta(); ?>
			</div>
			<div class="col-lg-1" id="favicons">
				<div class="col-xs-4 col-xs-offset-1" id="iconheart">
					<?php do_shortcode('[opalestate_favorite_button property_id='.get_the_ID() .']'); ?>
				</div>
				<div class="col-xs-4" id="iconfav">
					<?php do_shortcode('[opalestate_favorite_button property_id='.get_the_ID() .']'); ?>
				</div>
				<div class="col-xs-3">
					<?php do_shortcode('[opalestate_favorite_button property_id='.get_the_ID() .']'); ?>
				</div>
			</div>
		</header>

		<div class="abs-col-item">
			<div class="entry-content">
				<div class="col-lg-9 col-lg-offset-1">
					<?php the_title( '<h4 class="entry-title"><a href="' . get_the_guid(get_the_id()) . '">', '</a></h4>' ); ?>
						
				  	<div class="property-address">
						<?php echo $property->get_address(); ?>
					</div>

					 
	                <?php opalestate_property_loop_price(); ?>
	            </div>
			</div><!-- .entry-content -->
		</div> 
		
		<div class="entry-summary">
			<div class="col-lg-9">
				<h5><?php echo __( 'Description', 'opalestate' ); ?></h5>
				<?php echo substr(get_the_content(), 0, 200); ?>
			</div>
			<div class="col-lg-3">
				<div class="pull-left" style="padding-top: 100%;"><?php echo $property->render_author_link(); ?></div>
			</div>
		</div><!-- .entry-summary -->
	</div>	
	
	<?php do_action( 'opalestate_after_property_loop_item' ); ?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div></article><!-- #post-## -->
