<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
$layout = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if(empty($loop)) return;
$this->getLoop($loop);
$args = $this->loop_args;

if(is_front_page()){
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
else{
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}
$args['paged'] = $paged; 
$post_per_page = $args['posts_per_page']; 

$loop = new WP_Query($args);
?>

<section class="widget frontpage-posts frontpage-4 section-blog   widget-style  <?php echo (($el_class!='')?' '.$el_class:''); ?>">
	<?php
		if($title!=''){ ?>
			<h3 class="widget-title visual-title">
				<span><?php echo trim($title); ?></span>
			</h3>
		<?php }
	?>
	<div class="widget-content"> 
			 <?php
/**
 * $loop
 * $class_column
 *
 */

$_count =1;

$colums = '3';
$bscol = floor( 12/$colums );
$end = $loop->post_count; 
?>

<div class="frontpage frontpage-v2">
	<div  class="main-posts">
		<div class="row">
		<?php

			$i = 0;

			while($loop->have_posts()){
				$loop->the_post();
		 ?>
				
			
				<?php $thumbsize = isset($thumbsize)? $thumbsize : 'thumbnail';?>
				<div class="post col-sm-12">
					<article class="post">

						<div class="post-content">
							<div class="col-lg-6">
							<?php
							if ( has_post_thumbnail() ) {
								?>
									<figure class="entry-thumb">
										<a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
											<?php the_post_thumbnail( $thumbsize );?>
										</a>
										<!-- vote    -->
										<?php do_action('wpopal_show_rating') ?>
									</figure>
								<?php
							}
							?>
							</div>
							<div class="entry-content-wrapper col-lg-6">
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<?php
											if (get_the_title()) {
											?>
												<h4 class="entry-title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h4>
											<?php
										}
										?>

										<?php
											if (! has_excerpt()) { ?>
												<p class="entry-description"><?php echo substr(get_the_content(), 0, 500); ?></p>
												<?php
											} else {
												?>
													<p class="entry-description"><?php echo fullhouse_fnc_excerpt(100,'...'); ?></p>
												<?php
											}
										?>
									</div>
								</div>
							</div>
							
						</div>
						<!-- .post-content -->
						
					</article>
				</div>
			
			<?php  $i++; } ?>
		</div>
	</div>
   
</div>
	</div>
		<?php if( isset($show_pagination) && $show_pagination ): ?>
		<div class="w-pagination"><?php fullhouse_fnc_pagination_nav( $post_per_page,$loop->found_posts,$loop->max_num_pages ); ?></div>
		<?php endif ; ?>
</section>
<?php wp_reset_postdata(); ?>