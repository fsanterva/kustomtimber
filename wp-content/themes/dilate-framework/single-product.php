<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>


<div class="page-width">

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

    <div style="clear:both;"></div>
</div>


<style>

    form.cart .quantity, .form.cart .button {
        float: none !important;
    }

    form.cart .quantity {
        margin-bottom: 10px !important;
    }

    .single_add_to_cart_button {
        max-width: 400px;
        border: 1px solid #3a3a3a !important;
        background: #f7f7f7 !important;
        color: #3a3a3a !important;
        border-radius: 0 !important;
        text-transform: uppercase;
        width:100%;
        font-style: normal;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        white-space: normal;
        font-size: 13px;

        display: block;
        line-height: 1.4;
        padding-left: 5px;
        padding-right: 5px;
        white-space: normal;
        margin-top: 0;
        margin-bottom: 10px;
        min-height: 44px;

    }

    span.qty-label {
        margin-bottom: 10px;
        display: block;
    }

    .input-text.qty {
        padding:10px 18px !important;
        max-width: 5rem !important;
        min-height: 44px !important;
        border:1px solid #d1cdcd !important;
        width:5rem !important;
        background:#f7f7f7 !important;
        margin-bottom: 10px;
    }

    h1.product_title.entry-title {
        font-size: 2.33333em !important;
        letter-spacing: 1px;
        text-align: left !important;
    }

    .short-description ul {
        margin: 20px 0;
    }

    .short-description p {
        padding-bottom: 25px;
    }

    .related.products > h2 {
        font-size: 1.33333em;
        letter-spacing: 1px;
        text-align: center;
        margin-bottom: 50px;
    }

    .products h2 {
        letter-spacing: 1px;       
    }

    .related.products ul.products {
        background: #fff;
        padding: 30px;
    }

    .add_to_cart_button {
        display: none !important;
    }

    span.woocommerce-Price-amount.amount {
        font-weight: bold;
        color: #000;
        margin-top: 20px;
        margin-bottom: 50px;
        display: block;
    }

    .product-info .flex-control-nav {
        margin-top: 20px !important;
    }

    section.related.products {
        padding-top: 50px !important;
    }

    @media(max-width:722px) {
        .page-width {
            margin: 0 50px;
        }
    }
    
</style>


<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */