<?php
/**
 * Show options for ordering
 *
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

?>
<form class="woocommerce-ordering" method="get">
	<?php
	$orderby_id = 'orderby_' . uniqid(); // ID único para accesibilidad.
	?>

	<label for="<?php echo esc_attr( $orderby_id ); ?>" class="screen-reader-text">
		<?php esc_html_e( 'Sort products', 'woocommerce' ); ?>
	</label>

	<select
		name="orderby"
		id="<?php echo esc_attr( $orderby_id ); ?>"
		class="js_orderby form-select"
		aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>"
	>
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>>
				<?php echo esc_html( $name ); ?>
			</option>
		<?php endforeach; ?>
	</select>

	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ), '', true ); ?>
</form>
