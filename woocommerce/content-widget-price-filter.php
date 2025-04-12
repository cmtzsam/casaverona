<?php
/**
 * The template for displaying product price filter widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-price-filter.php
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

?>
<?php do_action( 'woocommerce_widget_price_filter_start', $args ); ?>

<form method="get" action="<?php echo esc_url( $form_action ); ?>" class="js_wrap_price_filter">
	<div class="price_slider_wrapper">
		<div class="price_slider"></div>

		<div class="price_slider_amount row" data-step="<?php echo esc_attr( $step ); ?>">
			<div class="col-6">
				<input type="text" 
					   id="min_price" 
					   name="min_price" 
					   class="form-control" 
					   value="<?php echo esc_attr( $current_min_price ); ?>" 
					   data-min="<?php echo esc_attr( $min_price ); ?>" 
					   placeholder="<?php echo esc_attr__( 'Min price', 'woocommerce' ); ?>" 
					   aria-label="<?php esc_attr_e( 'Minimum price filter', 'woocommerce' ); ?>">
			</div>
			<div class="col-6">
				<input type="text" 
					   id="max_price" 
					   name="max_price" 
					   class="form-control" 
					   value="<?php echo esc_attr( $current_max_price ); ?>" 
					   data-max="<?php echo esc_attr( $max_price ); ?>" 
					   placeholder="<?php echo esc_attr__( 'Max price', 'woocommerce' ); ?>" 
					   aria-label="<?php esc_attr_e( 'Maximum price filter', 'woocommerce' ); ?>">
			</div>

			<div class="col-12 pt-2">
				<button type="submit" class="btn btn-primary price_filter_btn">
					<?php echo esc_html__( 'Filter', 'woocommerce' ); ?>
				</button>
			</div>

			<div class="price_label" style="display:none;">
				<?php echo esc_html__( 'Price:', 'woocommerce' ); ?> 
				<span class="from"></span> &mdash; <span class="to"></span>
			</div>

			<?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
		</div>
	</div>

	<input type="hidden" class="js_price_slider_file" value="<?php echo esc_url( includes_url( 'js/price-slider.min.js' ) ); ?>">
</form>

<?php do_action( 'woocommerce_widget_price_filter_end', $args ); ?>
