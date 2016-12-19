<?php
    $link = get_post_meta( get_the_ID(), 'testimonial_link', true);
    $job = get_post_meta( get_the_ID(), 'testimonials_job', true);
?>
<div class="testimonials-v6">
    <div class="testimonials-body">
        <p class="testimonials-description"><?php the_content() ?></p>                            
        <ul class="testimonials-avatar list-unstyled">
            <li class="active">
                 <div class="radius-x"><?php the_post_thumbnail('widget', '', 'class="radius-x"');?></div>
            </li>                       
        </ul>                        
        <h5 class="testimonials-name">
            <?php the_title(); ?>
        </h5>  
	<?php if(!empty($job) ): ?>
        	<p class="text-muted testimonials-position"><?php echo trim($job); ?></p>  
	<?php endif; ?>
    </div>                      
</div>