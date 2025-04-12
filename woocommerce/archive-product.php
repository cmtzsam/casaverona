<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
global $wp_query;
$starter_all_count_item = $wp_query->found_posts;

/* filters - get canonical URL */
global $wp;
if ( '' === get_option( 'permalink_structure' ) ) {
	$starter_archive_url = remove_query_arg( array( 'page', 'paged', 'product-page' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
} else {
	$starter_archive_url = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
}
?>
<input class="js_archive_url" type="hidden" value="<?php echo esc_url( $starter_archive_url ); ?>">

<div class="content_wrapper container pt-5 pb-5 archive_product js_wrap_archive" role="main">

	<?php
		/**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

	<!-- breadcrumb -->
	<?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
		<div class="yoast_breadcrumb"><?php yoast_breadcrumb(); ?></div>
	<?php endif; ?>
	<!-- END breadcrumb -->

	<h1 class="mb-0 text-center">
		<?php
		if ( is_product_taxonomy() ) {
			woocommerce_page_title();
		} elseif ( is_search() ) {
			printf( 'Search Results for: “%s”', '<span>' . get_search_query() . '</span>' );
		} else {
			esc_html_e( 'All products', 'starter' );
		}
		?>
	</h1>
	<h2 class="mb-5 text-center text-muted"><small>(<?php echo esc_html( $starter_all_count_item ); ?><?php esc_html_e( ' products', 'starter' ); ?>)</small></h2>

	<div class="row">

		<!-- filters layout -->
		<div class="col-lg-3 col-md-4 d-flex justify-content-between d-md-block js_wrap_filters">
			<div class="filter_block">
				<span class="widget-title border-0"><?php esc_html_e( 'Sort by', 'starter' ); ?></span>
				<?php do_action( 'woocommerce_before_shop_loop' ); ?>
			</div>

			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
				<div class="filter_block all_filters offcanvas offcanvas-start js_filter_section" aria-labelledby="filtersSectionLabel">
					<div class="offcanvas-header d-md-none">
						<h5 class="offcanvas-title" id="filtersSectionLabel">Filters</h5>
						<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<?php do_action( 'woocommerce_sidebar' ); ?>
						<a href="<?php echo esc_url( $starter_archive_url ); ?>" class="btn btn-outline-primary btn-sm d-none filter_reset_btn js_reset_filters"><?php esc_html_e( 'Reset', 'starter' ); ?></a>
					</div>
				</div>
				<a href="#" class="filter_block mobile_filters_btn" data-bs-target=".js_filter_section" data-bs-toggle="offcanvas"><?php esc_html_e( 'Filters', 'starter' ); ?><span class="ml-1 notifications_text badge rounded-pill bg-dark js_all_selected_filter"></span></a>
			<?php endif; ?>
		</div>
		<!-- END filters layout -->

		<!-- products layout -->
		<div class="col-lg-9 col-md-8"><div class="row">

		<?php if ( woocommerce_product_loop() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<div class='wraper_product col-xl-3 col-lg-4 col-md-6 col-6'>
					<?php
						// Puedes seguir usando tu template personalizado si está bien estructurado.
						$starter_img_sizes = '(max-width: 575px) calc(50vw - 26px), (max-width: 767px) 244px, (max-width: 991px) 214px, (max-width: 1199px) 214px, (max-width: 1399px) 188px, 222px';
						require get_stylesheet_directory() . '/woocommerce-custom/global/product-item.php';
					?>
				</div>
			<?php endwhile; ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php do_action( 'woocommerce_after_shop_loop' ); ?>

		<?php else : ?>
			<?php do_action( 'woocommerce_no_products_found' ); ?>
		<?php endif; ?>

		</div></div>
		<!-- END products layout -->

	</div><!-- .row -->

	<?php
		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

</div><!-- .content_wrapper -->

<?php
get_footer();
