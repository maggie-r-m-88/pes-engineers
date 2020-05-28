<?php
define( 'HOME_URL', trailingslashit( home_url() ) );
define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URL', trailingslashit( get_template_directory_uri() ) );



if (!function_exists('g5plus_include_theme_options')) {
	function g5plus_include_theme_options() {
		if (!class_exists( 'ReduxFramework' )) {
			require_once( THEME_DIR . 'g5plus-framework/options/framework.php' );
		}
		require_once( THEME_DIR . 'g5plus-framework/option-extensions/loader.php' );
		require_once( THEME_DIR . 'includes/options-config.php' );

		global $g5plus_darna_options, $g5plus_options;
		$g5plus_options = $g5plus_darna_options;
	}
	g5plus_include_theme_options();
}

function g5plus_check_vc_status() {
    include_once(ABSPATH.'wp-admin/includes/plugin.php');
    if(is_plugin_active('js_composer/js_composer.php')) {
        return true;
    }
    else{
        return false;
    }
}

if (!function_exists('g5plus_include_library')) {
	function g5plus_include_library() {
		$includes_files = array(
            'g5plus-framework/g5plus-framework.php',
			'includes/register-require-plugin.php',
			'includes/theme-setup.php',
			'includes/sidebar.php',
			'includes/meta-boxes.php',
			'includes/admin-enqueue.php',
			'includes/theme-functions.php',
			'includes/theme-action.php',
			'includes/theme-filter.php',
			'includes/frontend-enqueue.php',
			'includes/tax-meta.php',
		);

		foreach ( $includes_files as $file ) {
			if ( ! $filepath = locate_template( $file ) ) {
				trigger_error( sprintf( __( 'Error locating %s for inclusion', 'g5plus-framework' ), $file ), E_USER_ERROR );
			}
			require_once $filepath;
		}
		unset( $file, $filepath );

        if( g5plus_check_vc_status() == true) {
            require_once("includes/vc-functions.php");
        }
	}

	g5plus_include_library();
}