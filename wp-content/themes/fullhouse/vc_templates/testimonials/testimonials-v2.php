<?php
    $link = get_post_meta( get_the_ID(), 'testimonial_link', true);
    $job = get_post_meta( get_the_ID(), 'testimonials_job', true);
?>
<div class="testimonials-left testimonials-v2">
	<div class="testimonials-body">
	    
	    <div class="testimonials-profile">
	        <div class="testimonials-avatar radius-x">
	              <?php the_post_thumbnail('widget', '', 'class="radius-x"');?>
	        </div> 
	        <h4 class="name"> <?php the_title(); ?></h4>
	        <?php if(!empty($job) ): ?>
	            <div class="job"><?php echo trim($job); ?></div>
	         <?php endif; ?>
	    </div>

	    <div class="testimonials-quote"><?php the_content() ?></div>
	                        
	</div>
</div>