<?php
/**
 * Related Products
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! $related_products ) {
	return;
}
?>

<section class="pt-5 mt-5">
	<div class="container">
		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2 class="title_section"><span><?php echo esc_html( $heading ); ?></span></h2>
		<?php endif; ?>
	</div>

	<div class="container">
		<div class="position-relative product_carousel js_product_carousel">
			<div class="swiper">
				<div class="swiper-wrapper">

					<?php foreach ( $related_products as $related_product ) : ?>
						<?php
						$post_object = get_post( $related_product->get_id() );
						setup_postdata( $GLOBALS['post'] = $post_object );

						echo "<div class='wraper_product swiper-slide js_product'>";
						$starter_img_sizes = '(max-width: 575px) calc(50vw - 10px), (max-width: 767px) 260px, (max-width: 991px) 220px, (max-width: 1199px) 220px, (max-width: 1399px) 208px, 244px';
						require get_stylesheet_directory() . '/woocommerce-custom/global/product-item.php';
						echo '</div>';
						?>
					<?php endforeach; ?>

				</div>
			</div>

			<button type="button" class="btn carousel_control_prev" aria-label="Carousel scroll previous">
				<?php echo starter_get_svg( array( 'icon' => 'bi-chevron-left' ) ); ?>
			</button>
			<button type="button" class="btn carousel_control_next" aria-label="Carousel scroll next">
				<?php echo starter_get_svg( array( 'icon' => 'bi-chevron-right' ) ); ?>
			</button>
		</div>
	</div>
</section>

<?php
wp_reset_postdata();
