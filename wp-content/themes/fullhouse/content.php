<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WpOpal
 * @subpackage fullhouse
 * @since fullhouse 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-content-wrapper">

 		<div class="row">
 			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
 				<div class="post-sub-content">
 					<div class="entry-date">
		                <span><?php the_time( 'd' ); ?></span>&nbsp;<?php the_time( 'M' ); ?>
		            </div>
		            <footer class="clearfix">
		            	<div class="entry-category pull-left">
			                <?php esc_html_e('in', 'fullhouse'); the_category(); ?>
			            </div>
						<span class="meta-sep pull-left"> | </span>
						<div class="entry-comment pull-left">	                                    
	                        <ul class="list-inline">
	                            <li class="comment-count">
	                                <?php comments_popup_link(esc_html__(' 0 ', 'fullhouse'), esc_html__(' 1 ', 'fullhouse'), esc_html__(' % ', 'fullhouse')); ?>
	                            </li>
	                            <li><?php esc_html_e('Comments', 'fullhouse'); ?></li>
	                        </ul>
	                    </div>
		            </footer>
 				</div> 				
 			</div>

 			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && fullhouse_fnc_categorized_blog() ) : ?>
	 			<?php
					endif;

					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					endif;
				?>
 			</div>

 		</div>
		
	</header><!-- .entry-header -->

 	<div class="post-preview">
		<?php fullhouse_fnc_post_thumbnail(); ?>
	</div>		
	
	<?php if( is_single() ): ?>

		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					wp_kses_post( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'fullhouse' ) ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'fullhouse' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<div class="clearfix">
				<?php the_tags( '<div class="tags-container"><span class="tag-links">', '', '</span></div><hr>' ); ?>

				<div class="share-container">
					<?php
						if ( fullhouse_fnc_theme_options( 'blog-show-share-post', 1 ) ) {
							get_template_part( 'page-templates/parts/sharebox' );
						}
					?>
				</div>
			</div>		
		</footer>

	<?php else : ?>
		<div class="entry-content"> <?php the_excerpt();?> </div>
	<?php endif ; ?>

</article><!-- #post-## -->
