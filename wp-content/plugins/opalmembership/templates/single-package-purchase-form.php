<form id="membership-package-purchase-form" action="" method="post">
	<div class="membership-form-wrapper">
		<a class="membership-add-to-purchase btn btn-md btn-block <?php if($highlighted):?> btn-primary <?php else : ?>btn-default <?php endif; ?> radius-6x btn-3d" data-id="<?php the_ID(); ?>" data-action="membership_add_to_purchase">
			<span class="membership-label"><?php _e( 'Buy Now', 'opalmembership' ); ?></span>
		</a>	
	</div>	
</form>	