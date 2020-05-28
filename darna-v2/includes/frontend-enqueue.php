<?php


/**


 * Created by PhpStorm.


 * User: Administrator


 * Date: 6/1/2015


 * Time: 6:16 PM


 */


/*================================================


LOAD STYLESHEETS


================================================== */


if (!function_exists('g5plus_enqueue_styles')) {


	function g5plus_enqueue_styles() {


		global $g5plus_options;


		$min_suffix = (isset($g5plus_options['enable_minifile_css']) && $g5plus_options['enable_minifile_css'] == 1) ? '.min' :  '';





		/*font-awesome*/


		$url_font_awesome = THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css';


		if (isset($g5plus_options['cdn_font_awesome']) && !empty($g5plus_options['cdn_font_awesome'])) {


			$url_font_awesome = $g5plus_options['cdn_font_awesome'];


		}


		wp_enqueue_style('g5plus_framework_font_awesome', $url_font_awesome, array());


		wp_enqueue_style('g5plus_framework_font_awesome_animation', THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome-animation.min.css', array());





		/*bootstrap*/


		$url_bootstrap = THEME_URL . 'assets/plugins/bootstrap/css/bootstrap.min.css';


		if (isset($g5plus_options['cdn_bootstrap_css']) && !empty($g5plus_options['cdn_bootstrap_css'])) {


			$url_bootstrap = $g5plus_options['cdn_bootstrap_css'];


		}


		wp_enqueue_style('g5plus_framework_bootstrap', $url_bootstrap, array());





		/*flat-icon*/


		wp_enqueue_style('g5plus_framework_flat_icon', THEME_URL . 'assets/plugins/flaticon/css/flaticon.css', array());





		/*owl-carousel*/


		wp_enqueue_style('g5plus_framework_owl_carousel', THEME_URL . 'assets/plugins/owl-carousel/owl.carousel.min.css', array());


		wp_enqueue_style('g5plus_framework_owl_carousel_theme', THEME_URL . 'assets/plugins/owl-carousel/owl.theme.min.css', array());


		wp_enqueue_style('g5plus_framework_owl_carousel_transitions', THEME_URL . 'assets/plugins/owl-carousel/owl.transitions.css', array());





		/*prettyPhoto*/


		wp_enqueue_style('g5plus_framework_prettyPhoto', THEME_URL . 'assets/plugins/prettyPhoto/css/prettyPhoto.css', array());





		/*peffect_scrollbar*/


		wp_enqueue_style('g5plus_framework_peffect_scrollbar', THEME_URL . 'assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css', array());





		if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {


			wp_enqueue_style('g5plus_framework_style', THEME_URL . 'style'.$min_suffix.'.css');


		}


        wp_enqueue_style('g5plus_framework_vc_customize_css', THEME_URL . 'assets/css/vc-customize'.$min_suffix.'.css');





		$enable_rtl_mode = '0';


		if (isset($g5plus_options['enable_rtl_mode'])) {


			$enable_rtl_mode =  $g5plus_options['enable_rtl_mode'];


		}





		if (is_rtl() || $enable_rtl_mode == '1' || isset($_GET['RTL'])) {


			wp_enqueue_style('g5plus_framework_rtl', THEME_URL . 'assets/css/rtl'.$min_suffix.'.css');


		}





	}


	add_action('wp_enqueue_scripts', 'g5plus_enqueue_styles',11);


}





/*================================================


LOAD SCRIPTS


================================================== */


if (!function_exists('g5plus_enqueue_script')) {


	function g5plus_enqueue_script() {


		global $g5plus_options;


		$min_suffix = (isset($g5plus_options['enable_minifile_js']) && $g5plus_options['enable_minifile_js'] == 1) ? '.min' :  '';





		/*bootstrap*/


		$url_bootstrap = THEME_URL . 'assets/plugins/bootstrap/js/bootstrap.min.js';


		if (isset($g5plus_options['cdn_bootstrap_js']) && !empty($g5plus_options['cdn_bootstrap_js'])) {


			$url_bootstrap = $g5plus_options['cdn_bootstrap_js'];


		}


		wp_enqueue_script('g5plus_framework_bootstrap', $url_bootstrap, array('jquery'), false, true);





		if (is_single()) {


			wp_enqueue_script('comment-reply');


		}





		/*plugins*/


		wp_enqueue_script('g5plus_framework_plugins', THEME_URL . 'assets/js/plugin'.$min_suffix.'.js', array(), false, true);





		/*smooth-scroll*/


		if ( isset($g5plus_options['smooth_scroll']) && ($g5plus_options['smooth_scroll'] == 1)) {


			wp_enqueue_script('g5plus_framework_smooth_scroll', THEME_URL . 'assets/plugins/smoothscroll/SmoothScroll' . $min_suffix . '.js', array(), false, true);


		}





		/*panel-selector*/


		if ( isset($g5plus_options['panel_selector']) && ($g5plus_options['panel_selector'] == 1)) {


			wp_enqueue_script('g5plus_framework_panel_selector', THEME_URL . 'assets/js/panel-style-selector' . $min_suffix . '.js', array(), false, true);


		}





		wp_enqueue_script('g5plus_framework_app', THEME_URL . 'assets/js/app' . $min_suffix . '.js', array(), false, true);





		// Localize the script with new data


		$translation_array = array(


			'product_compare' => __('Compare', 'g5plus-framework'),


			'product_wishList' => __('WishList', 'g5plus-framework')


		);


		wp_localize_script('g5plus_framework_app', 'g5plus_framework_constant', $translation_array);





		wp_localize_script('g5plus_framework_app', 'g5plus_framework_ajax_url', get_site_url() . '/wp-admin/admin-ajax.php?activate-multi=true');


		wp_localize_script('g5plus_framework_app', 'g5plus_framework_theme_url', THEME_URL);


		wp_localize_script('g5plus_framework_app', 'g5plus_framework_site_url', site_url());





	}


	add_action('wp_enqueue_scripts', 'g5plus_enqueue_script');


}





/* CUSTOM CSS OUTPUT


	================================================== */


if(!function_exists('g5plus_enqueue_custom_css')){


    function g5plus_enqueue_custom_css() {


        global $g5plus_options;


        $custom_css = $g5plus_options['custom_css'];


        if ( $custom_css ) {


            echo sprintf('<style type="text/css">%s %s</style>',"\n",$custom_css);


        }


    }


    add_action( 'wp_head', 'g5plus_enqueue_custom_css' );


}





/* CUSTOM JS OUTPUT


	================================================== */


if(!function_exists('g5plus_enqueue_custom_script')){


    function g5plus_enqueue_custom_script() {


        global $g5plus_options;


        $custom_js = $g5plus_options['custom_js'];


        if ( $custom_js ) {


            echo sprintf('<script type="text/javascript">%s</script>',$custom_js);


        }


    }


    add_action( 'wp_footer', 'g5plus_enqueue_custom_script' );


}


