<?php global $property; ?>
<div class="property-price">
	<?php if( $property->get_price() ): ?> 
		<span><?php echo  opalestate_price_format( $property->get_price() ); ?></span>

		<?php if( $property->get_sale_price() ): ?>
		<span class="property-saleprice">
			<?php echo  opalestate_price_format( $property->get_sale_price() ); ?>
		</span>
		<?php endif; ?>

		<?php if( $property->get_price_label() ): ?>
		<span class="property-price-label">
			/ <?php echo $property->get_price_label(); ?>
		</span>	
		<?php endif; ?>
	<?php else: ?>
	<?php _e( 'Contact Property', 'opalestate' ); ?>	
	<?php endif; ?>
</div>

