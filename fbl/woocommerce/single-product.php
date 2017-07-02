<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	<div id="recent-views">
		<h2>Recent Views</h2>
		<?php echo do_shortcode('[woocommerce_recently_viewed_products per_page="5"]');?>
	</div>
	<div id="recent-views">
		<h2>Recent Products</h2>
		<?php echo do_shortcode('[recent_products per_page="12" columns="4" orderby="date" order="desc"]');?>
	</div>
	<div id="recent-views">
		<h2>Sale Products</h2>
		<?php echo do_shortcode('[sale_products]');?>
	</div>
	<div id="recent-views">
		<h2>Featured Products</h2>
		<?php echo do_shortcode('[featured_products per_page="12" columns="4" orderby="date" order="desc"]');?>
	</div>
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>