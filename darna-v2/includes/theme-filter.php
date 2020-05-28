<?php
/*---------------------------------------------------
/* COMMENT FIELDS
/*---------------------------------------------------*/
if (!function_exists('g5plus_comment_fields')) {
    function g5plus_comment_fields($fields) {

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $html5 = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';;

        $fields = array(
            'author' => '<div class="form-group col-md-6">' .
                '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" placeholder="'.__('Name*','g5plus-framework').'" ' . $aria_req . '>' .
                '</div>',
            'email' => '<div class="form-group col-md-6">' .
                '<input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="'.__('Email*','g5plus-framework').'" ' . $aria_req . '>' .
                '</div>'
        );

        return $fields;

    }
    add_filter('g5plus_comment_fields','g5plus_comment_fields');
}

/*---------------------------------------------------
/* COMMENT FORMS ARGS
/*---------------------------------------------------*/
if (!function_exists('g5plus_comment_form_args')) {
    function g5plus_comment_form_args($comment_form_args) {
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $html5 = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';;

        $comment_form_args['comment_field'] = '<div class="form-group col-md-12">' .
            '<textarea rows="6" id="comment" name="comment"  value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="'.__('Message*','g5plus-framework') .'" '. $aria_req .'></textarea>' .
            '</div>';

        $comment_form_args['class_submit'] = 'darna-button style3 size-md';
        $comment_form_args['label_submit'] = __('Add Comment', 'g5plus-framework');
        return $comment_form_args;
    }
    add_filter('g5plus_comment_form_args','g5plus_comment_form_args');
}

/*---------------------------------------------------
/* SET ONE PAGE MENU
/*---------------------------------------------------*/
if (!function_exists('g5plus_main_menu_one_page_filter')) {
	function g5plus_main_menu_one_page_filter($args) {
		if (isset($args['theme_location']) && ($args['theme_location'] != 'primary')) {
			return $args;
		}
		$prefix = 'g5plus_';
		$is_one_page = rwmb_meta($prefix . 'is_one_page');
		if ($is_one_page == '1') {
			$args['menu_class'] .= ' menu-one-page';
		}
		return $args;
	}
	add_filter('wp_nav_menu_args','g5plus_main_menu_one_page_filter', 20);
}

/*---------------------------------------------------
/* HEADER CUSTOMIZE
/*---------------------------------------------------*/
if (!function_exists('g5plus_header_customize_filter')) {
	add_filter('g5plus_header_customize_filter','g5plus_header_customize_filter');
	function g5plus_header_customize_filter($args) {
		global $g5plus_options;

		$prefix = 'g5plus_';

		$enable_header_customize = rwmb_meta($prefix . 'enable_header_customize');

		$header_customize = array();
		if ($enable_header_customize == '1') {
			$page_header_customize = rwmb_meta($prefix . 'header_customize');
			if (isset($page_header_customize['enable']) && !empty($page_header_customize['enable'])) {
				$header_customize = explode('||', $page_header_customize['enable']);
			}
		}
		else {
			if (isset($g5plus_options['header_customize']) && isset($g5plus_options['header_customize']['enabled']) && is_array($g5plus_options['header_customize']['enabled'])) {
				foreach ($g5plus_options['header_customize']['enabled'] as $key => $value) {
					$header_customize[] = $key;
				}
			}
		}

		ob_start();
		if (count($header_customize) > 0) {
			?>
			<div class="header-customize">
				<?php foreach ($header_customize as $key){
					switch ($key) {
						case 'search':
							g5plus_get_template('header/search-button');
							break;
						case 'shopping-cart':
							if (class_exists( 'WooCommerce' )) {
								g5plus_get_template('header/mini-cart');
							}
							break;
						case 'get-a-quote':
							g5plus_get_template('header/get-a-quote');
							break;
						case 'custom-text':
							g5plus_get_template('header/custom-text');
							break;
					}
				} ?>
			</div>
		<?php
		}

		return ob_get_clean();
	}
}

/*---------------------------------------------------
/* AFTER MAIN MENU (for header 3)
/*---------------------------------------------------*/
if (!function_exists('g5plus_after_main_menu_filter')) {
	add_filter('g5plus_after_main_menu_filter','g5plus_after_main_menu_filter');
	function g5plus_after_main_menu_filter($args) {
		global $g5plus_options;

		$main_menu_after_customize = isset($g5plus_options['main_menu_after_customize']) ?
			$g5plus_options['main_menu_after_customize'] : '';
		ob_start();
		if (!empty($main_menu_after_customize)):
			$main_menu_after_customize = apply_filters('g5plus_do_shortcode', $main_menu_after_customize);
		?>
			<div class="main-menu-custom-text">
				<?php echo wp_kses_post($main_menu_after_customize); ?>
			</div>
		<?php
		endif;
		return ob_get_clean();
	}
}

/*---------------------------------------------------
/* CUSTOM TOP DRAWER
/*---------------------------------------------------*/
if (!function_exists('g5plus_dynamic_sidebar_params')) {
	function g5plus_dynamic_sidebar_params($params) {
		global $g5plus_options, $g5plus_top_drawer_widget_count;
		if (!isset($g5plus_top_drawer_widget_count)) {
			$g5plus_top_drawer_widget_count = 0;
		}
		$top_drawer_sidebar = $g5plus_options['top_drawer_sidebar'];
		$top_drawer_layout = $g5plus_options['top_drawer_layout'];

		$widget_class = '';

		$widget_setting = array(
			'top-drawer-1' => array('g5plus-col-3','g5plus-col-3','g5plus-col-3','g5plus-col-3'),
			'top-drawer-2' => array('g5plus-col-6','g5plus-col-3','g5plus-col-3'),
			'top-drawer-3' => array('g5plus-col-3','g5plus-col-3','g5plus-col-6'),
			'top-drawer-4' => array('g5plus-col-6','g5plus-col-6'),
			'top-drawer-5' => array('g5plus-col-4','g5plus-col-4','g5plus-col-4'),
			'top-drawer-6' => array('g5plus-col-8','g5plus-col-4'),
			'top-drawer-7' => array('g5plus-col-4','g5plus-col-8'),
			'top-drawer-8' => array('g5plus-col-3','g5plus-col-6','g5plus-col-3'),
			'top-drawer-9' => array('g5plus-col-12'),
		);

		if (isset($widget_setting[$top_drawer_layout])) {
			$widget_class = $widget_setting[$top_drawer_layout][$g5plus_top_drawer_widget_count % count($widget_setting[$top_drawer_layout])];
		}
		$g5plus_top_drawer_widget_count += 1;

		foreach ($params as $key => $value) {
			if (isset($value['id'])) {
				if ($value['id'] == $top_drawer_sidebar) {
					$params[$key]['before_widget'] = str_replace(' class="',' class="' . esc_attr($widget_class) . ' ',$params[$key]['before_widget']);
				}
			}
		}

		return $params;
	}
	add_filter('dynamic_sidebar_params','g5plus_dynamic_sidebar_params');
}

/*---------------------------------------------------
/* ADD SEARCH FORM TO BEFORE X-MENU
/*---------------------------------------------------*/
if (!function_exists('g5plus_search_form_before_xmenu')) {
	function g5plus_search_form_before_xmenu($params) {
		ob_start();
		?>
		<li class="menu-fly-search">
			<form  method="get" action="<?php echo esc_url(site_url()); ?>">
				<input type="text" name="s" placeholder="<?php _e('Search...','g5plus-framework'); ?>">
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</li>
		<?php
		$params .= ob_get_clean();

		return $params;
	}
	add_filter('xmenu_filter_before','g5plus_search_form_before_xmenu', 10);
}