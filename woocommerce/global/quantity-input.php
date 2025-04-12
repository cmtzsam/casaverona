<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */

defined( 'ABSPATH' ) || exit;

if ( isset( $max_value ) && isset( $min_value ) && $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input
			type="hidden"
			id="<?php echo esc_attr( $input_id ); ?>"
			class="qty"
			name="<?php echo esc_attr( $input_name ); ?>"
			value="<?php echo esc_attr( $min_value ); ?>"
		/>
	</div>
	<?php
} else {
	/* translators: %s: Product name */
	$label = ! empty( $args['product_name'] )
		? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) )
		: esc_html__( 'Quantity', 'woocommerce' );
	?>
	<div class="quantity btn-group">
		<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>

		<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>">
			<?php echo esc_html( $label ); ?>
		</label>

		<input
			type="<?php echo esc_attr( $type ); ?>"
			id="<?php echo esc_attr( $input_id ); ?>"
			class="form-control form-control-lg qty <?php echo esc_attr( implode( ' ', (array) $classes ) ); ?>"
			name="<?php echo esc_attr( $input_name ); ?>"
			value="<?php echo esc_attr( $input_value ); ?>"
			title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"
			placeholder="<?php echo esc_attr( $placeholder ); ?>"
			min="<?php echo esc_attr( $min_value ); ?>"
			<?php if ( $max_value > 0 ) : ?>
				max="<?php echo esc_attr( $max_value ); ?>"
			<?php endif; ?>
			step="<?php echo esc_attr( $step ); ?>"
			inputmode="<?php echo esc_attr( $inputmode ); ?>"
			autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
			<?php if ( $readonly ) : ?>readonly<?php endif; ?>
		/>

		<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
	</div>
	<?php
}
