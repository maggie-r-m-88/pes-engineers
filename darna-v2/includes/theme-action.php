<?php
/*---------------------------------------------------
/* THEME URL REWRITE
/*---------------------------------------------------*/
if (!function_exists('g5plus_less_css_url_rewrite')) {
	function g5plus_less_css_url_rewrite() {
		//if (defined( 'G5PLUS_SCRIPT_DEBUG' ) && G5PLUS_SCRIPT_DEBUG) {
		add_rewrite_rule( 'wp-content/themes/darna/g5plus-less-css', 'index.php', 'top' );
		flush_rewrite_rules();
		//}
	}
	add_action( 'init', 'g5plus_less_css_url_rewrite');
}

/*---------------------------------------------------
/* REMOVE ACTION
/*---------------------------------------------------*/
remove_action('g5plus_after_single_post_content','g5plus_share',15);
remove_action('g5plus_after_single_post_content','g5plus_post_tags',10);
remove_action('woocommerce_after_shop_loop_item_title','g5plus_woocommerce_template_loop_category',1);

remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',16);

