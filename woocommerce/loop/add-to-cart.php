<?php
/**
 * Loop Add to Cart
 *
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product || ! $product->is_purchasable() ) {
	return;
}

$args['class'] = ( $args['class'] ?? 'button' ) . ' ' . ( $args['btn_class'] ?? '' );

$defaults = array(
	'quantity'   => 1,
	'class'      => 'button',
	'attributes' => array(
		'aria-label' => $product->get_name(),
		'rel'        => 'nofollow',
	),
);

$args = wp_parse_args( $args, $defaults );

echo apply_filters(
	'woocommerce_loop_add_to_cart_link',
	sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s><span class="default_txt">%s</span><span class="loading_txt">%s</span><span class="added_to_cart_txt">%s</span></a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $args['quantity'] ),
		esc_attr( $args['class'] ),
		wc_implode_html_attributes( $args['attributes'] ),
		esc_html( $product->add_to_cart_text() ),
		esc_html__( 'Loading...', 'starter' ),
		esc_html__( 'Agregado', 'starter' )
	),
	$product,
	$args
);
