<?php
/**
 * Sidebar
 *
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 1.6.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

?>

<aside class="woocommerce-sidebar" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
