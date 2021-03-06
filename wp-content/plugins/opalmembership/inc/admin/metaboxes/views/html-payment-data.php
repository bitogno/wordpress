<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
global $post;
$fields = OpalMembership()->address()->get_fields( );
?>
<div class="panel-payment-data">

	<div class="membership-payment-info">
		<h4><?php _e( 'Payment Information', 'opalmembership' ); ?></h4>
		<table>
			<tr>
				<td><?php _e( 'Gateway', 'opalmembership' ); ?>:</td><td> <?php echo opalmembership_get_gateways_by_key( $thepayment->get_gateway() ); ?> </td>
			<tr>
				<td><?php _e( 'Key', 'opalmembership' ); ?>:</td><td><?php echo $thepayment->get_meta( 'purchase_key' ); ?></td>
			</tr>
			<?php if( $thepayment->get_meta( 'transaction_id' ) ) {  ?>
			<tr>
				<td><?php _e( 'Transaction ID', 'opalmembership' ); ?>:</td><td><?php echo $thepayment->get_meta( 'transaction_id' ); ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td><?php _e( 'IP Client', 'opalmembership' ); ?></td><td><?php echo $thepayment->get_meta( 'user_ip' ); ?></td>
			</tr>
		</table>
	</div>

	<div class="membership-payment-address">
		 <h4><?php _e( 'Billing Address', 'opalmembership' ); ?></h4>
		 <?php foreach ( $fields as $key => $field ) : ?>
			<?php opalmembership_form_field( 'billing['.$key.']', $field, isset($thepayment->billing[$key])?$thepayment->billing[$key]:"" ); ?>
		<?php endforeach; ?>

	</div>
</div>
<?php wp_nonce_field( 'opalmembership-payment-data-nonce', 'opalmembership_payment_data_nonce', true, true ); ?>