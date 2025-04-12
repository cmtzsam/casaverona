<?php
/**
 * The template for displaying product search form
 *
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

$search_index = isset( $index ) ? absint( $index ) : 0;
?>

<form role="search" method="get" class="woocommerce-product-search d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo $search_index; ?>">
		<?php esc_html_e( 'Search for:', 'woocommerce' ); ?>
	</label>
	<input
		type="search"
		id="woocommerce-product-search-field-<?php echo $search_index; ?>"
		class="search-field form-control form-control-sm"
		placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'woocommerce' ); ?>"
		value="<?php echo get_search_query(); ?>"
		name="s"
		autocomplete="off"
	/>
	<button type="submit" class="btn btn-primary">
		<?php echo esc_html_x( 'Search', 'submit button', 'woocommerce' ); ?>
	</button>
	<input type="hidden" name="post_type" value="product" />
</form>
