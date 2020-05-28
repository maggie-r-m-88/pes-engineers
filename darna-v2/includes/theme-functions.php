<?php
// GET CUSTOM CSS VARIABLE
//--------------------------------------------------
if (!function_exists('g5plus_custom_css_variable')) {
	function g5plus_custom_css_variable() {
		global $g5plus_options;
		$top_bar_bg_color = '#333';
		if (isset($g5plus_options['top_bar_bg_color']) && ! empty($g5plus_options['top_bar_bg_color'])) {
			if (isset($g5plus_options['top_bar_bg_color']['rgba'])) {
				$top_bar_bg_color = $g5plus_options['top_bar_bg_color']['rgba'];
			}
			elseif (isset($g5plus_options['top_bar_bg_color']['color'])) {
				$top_bar_bg_color = $g5plus_options['top_bar_bg_color']['color'];
			}
		}

		$top_bar_text_color = '#c5c5c5';
		if (isset($g5plus_options['top_bar_text_color']) && ! empty($g5plus_options['top_bar_text_color'])) {
			$top_bar_text_color = $g5plus_options['top_bar_text_color'];
		}

		$top_drawer_bg_color = '#2f2f2f';
		if (isset($g5plus_options['top_drawer_bg_color']) && ! empty($g5plus_options['top_drawer_bg_color'])) {
			$top_drawer_bg_color = $g5plus_options['top_drawer_bg_color'];
		}

		$top_drawer_text_color = '#c5c5c5';
		if (isset($g5plus_options['top_drawer_text_color']) && ! empty($g5plus_options['top_drawer_text_color'])) {
			$top_drawer_text_color = $g5plus_options['top_drawer_text_color'];
		}


		$primary_color = '#e8aa00';
		if (isset($g5plus_options['primary_color']) && ! empty($g5plus_options['primary_color'])) {
			$primary_color = $g5plus_options['primary_color'];
		}

		$secondary_color = '#fff';
		if (isset($g5plus_options['secondary_color']) && ! empty($g5plus_options['secondary_color'])) {
			$secondary_color = $g5plus_options['secondary_color'];
		}

		$text_color = '#888';
		if (isset($g5plus_options['text_color']) && ! empty($g5plus_options['text_color'])) {
			$text_color = $g5plus_options['text_color'];
		}

		$bold_color = '#222222';
		if (isset($g5plus_options['bold_color']) && ! empty($g5plus_options['bold_color'])) {
			$bold_color = $g5plus_options['bold_color'];
		}

        $heading_color = '#222222';
        if (isset($g5plus_options['heading_color']) && ! empty($g5plus_options['heading_color'])) {
            $heading_color = $g5plus_options['heading_color'];
        }

		$footer_bg_color = '#2F2F2F';
		if (isset($g5plus_options['footer_bg_color']) && ! empty($g5plus_options['footer_bg_color'])) {
			$footer_bg_color = $g5plus_options['footer_bg_color'];
		}

		$footer_text_color = '#afafaf';
		if (isset($g5plus_options['footer_text_color']) && ! empty($g5plus_options['footer_text_color'])) {
			$footer_text_color = $g5plus_options['footer_text_color'];
		}

		$footer_heading_text_color = '#fff';
		if (isset($g5plus_options['footer_heading_text_color']) && ! empty($g5plus_options['footer_heading_text_color'])) {
			$footer_heading_text_color = $g5plus_options['footer_heading_text_color'];
		}

		$bottom_bar_bg_color = '#292929';
		if (isset($g5plus_options['bottom_bar_bg_color']) && ! empty($g5plus_options['bottom_bar_bg_color'])) {
			$bottom_bar_bg_color = $g5plus_options['bottom_bar_bg_color'];
		}

		$bottom_bar_text_color = '#828282';
		if (isset($g5plus_options['bottom_bar_text_color']) && ! empty($g5plus_options['bottom_bar_text_color'])) {
			$bottom_bar_text_color = $g5plus_options['bottom_bar_text_color'];
		}

		$link_color = '#e8aa00';
		if (isset($g5plus_options['link_color']) && ! empty($g5plus_options['link_color']) && !empty($g5plus_options['link_color']['regular'])) {
			$link_color = $g5plus_options['link_color']['regular'];
		}

		$link_color_hover = '#e8aa00';
		if (isset($g5plus_options['link_color']) && ! empty($g5plus_options['link_color']) && !empty($g5plus_options['link_color']['hover'])) {
			$link_color_hover =  $g5plus_options['link_color']['hover'];
		}

		$link_color_active = '#e8aa00';
		if (isset($g5plus_options['link_color']) && ! empty($g5plus_options['link_color']) && !empty($g5plus_options['link_color']['active'])) {
			$link_color_active = $g5plus_options['link_color']['active'];
		}

		$menu_font = 'Arial';
		if (isset($g5plus_options['menu_font']) && ! empty($g5plus_options['menu_font']) && !empty($g5plus_options['menu_font']['font-family'])) {
			$menu_font = $g5plus_options['menu_font']['font-family'];
		}

        $primary_font = 'Arial';
		if (isset($g5plus_options['primary_font']) && ! empty($g5plus_options['primary_font']) && !empty($g5plus_options['primary_font']['font-family'])) {
            $primary_font = $g5plus_options['primary_font']['font-family'];
        }

		$secondary_font = 'Arial';
		if (isset($g5plus_options['secondary_font']) && ! empty($g5plus_options['secondary_font']) && !empty($g5plus_options['secondary_font']['font-family'])) {
			$secondary_font = $g5plus_options['secondary_font']['font-family'];
		}

		// Page Title
		//-------------------
		$page_title_text_color = '#fff';
		if (isset($g5plus_options['page_title_text_color']) && ! empty($g5plus_options['page_title_text_color'])) {
			$page_title_text_color = $g5plus_options['page_title_text_color'];
		}

		$page_title_bg_color = '#fff';
		if (isset($g5plus_options['page_title_bg_color']) && ! empty($g5plus_options['page_title_bg_color'])) {
			$page_title_bg_color = $g5plus_options['page_title_bg_color'];
		}



		$page_title_overlay_color = '#000';
		if (isset($g5plus_options['page_title_overlay_color']) && ! empty($g5plus_options['page_title_overlay_color'])) {
			$page_title_overlay_color = $g5plus_options['page_title_overlay_color'];
		}

		$page_title_overlay_opacity = '0.5';
		if (isset($g5plus_options['page_title_overlay_opacity']) && ! empty($g5plus_options['page_title_overlay_opacity'])) {
			$page_title_overlay_opacity = $g5plus_options['page_title_overlay_opacity']/100;
		}

		$page_title_overlay_color = '#000';
		if (isset($g5plus_options['page_title_overlay_color']) && ! empty($g5plus_options['page_title_overlay_color'])) {
			$page_title_overlay_color = $g5plus_options['page_title_overlay_color'];
		}

		$page_title_overlay_opacity = '0.5';
		if (isset($g5plus_options['page_title_overlay_opacity']) && ! empty($g5plus_options['page_title_overlay_opacity'])) {
			$page_title_overlay_opacity = $g5plus_options['page_title_overlay_opacity']/100;
		}

		// GET logo_max_height, logo_padding
		$g5plus_header_layout = rwmb_meta('g5plus_header_layout');
		if (($g5plus_header_layout === '') || ($g5plus_header_layout == '-1')) {
			$g5plus_header_layout = $g5plus_options['header_layout'];
		}

		$logo_max_height = '80px';
		$logo_padding = '10px';
		$main_menu_height = '100px';

		$logo_matrix = array(
			'header-1' => array(80, 10),
			'header-2' => array(80, 10),
			'header-2' => array(80, 10),
		);

		if (isset($logo_matrix[$g5plus_header_layout])) {
			$logo_max_height = $logo_matrix[$g5plus_header_layout][0] . 'px';
			$logo_padding = $logo_matrix[$g5plus_header_layout][1] . 'px';
			if (isset($logo_matrix[$g5plus_header_layout][2])) {
				$main_menu_height = $logo_matrix[$g5plus_header_layout][2] . 'px';
			}
			else {
				$main_menu_height = ($logo_matrix[$g5plus_header_layout][0] + $logo_matrix[$g5plus_header_layout][1] * 2) . 'px';
			}
		}

		if (isset($g5plus_options['logo_max_height']) && isset($g5plus_options['logo_max_height']['height']) && ! empty($g5plus_options['logo_max_height']['height'])) {
			$logo_max_height = $g5plus_options['logo_max_height']['height'] . 'px';
		}

		if (isset($g5plus_options['logo_padding']) && ! empty($g5plus_options['logo_padding'])) {
			$logo_padding = $g5plus_options['logo_padding'] . 'px';
		}


		$menu_text_color = '#191919';
		if (isset($g5plus_options['menu_text_color']) && ! empty($g5plus_options['menu_text_color'])) {
			$menu_text_color = $g5plus_options['menu_text_color'];
		}

		$menu_sub_bg_color = '#F8F8F8';
		if (isset($g5plus_options['menu_sub_bg_color']) && ! empty($g5plus_options['menu_sub_bg_color'])) {
			$menu_sub_bg_color = $g5plus_options['menu_sub_bg_color'];
		}

		$menu_sub_text_color = '#222';
		if (isset($g5plus_options['menu_sub_text_color']) && ! empty($g5plus_options['menu_sub_text_color'])) {
			$menu_sub_text_color = $g5plus_options['menu_sub_text_color'];
		}

		$logo_mobile_max_height = '42px';
		$logo_mobile_padding = '15px';
		$main_menu_mobile_height = '72px';

		$logo_mobile_matrix = array(
			'header-mobile-1' => array(42, 15),
			'header-mobile-2' => array(72, 25, 52),
			'header-mobile-3' => array(42, 15),
			'header-mobile-4' => array(42, 15),
		);


		// GET logo_max_height, logo_padding
		$mobile_header_layout = isset($g5plus_options['mobile_header_layout']) ? $g5plus_options['mobile_header_layout'] : 'header-mobile-2';

		if (isset($logo_mobile_matrix[$mobile_header_layout])) {
			$logo_mobile_max_height = $logo_mobile_matrix[$mobile_header_layout][0] . 'px';
			$logo_mobile_padding = $logo_mobile_matrix[$mobile_header_layout][1] . 'px';
			if (isset($logo_mobile_matrix[$mobile_header_layout][2])) {
				$main_menu_mobile_height = $logo_mobile_matrix[$mobile_header_layout][2] . 'px';
			}
			else {
				$main_menu_mobile_height = ($logo_mobile_matrix[$mobile_header_layout][0] + $logo_mobile_matrix[$mobile_header_layout][1] * 2) . 'px';
			}
		}

		if (isset($g5plus_options['logo_mobile_max_height']) && isset($g5plus_options['logo_mobile_max_height']['height']) && ! empty($g5plus_options['logo_mobile_max_height']['height'])) {
			$logo_mobile_max_height = $g5plus_options['logo_mobile_max_height']['height'] . 'px';
		}

		if (isset($g5plus_options['logo_mobile_padding']) && isset($g5plus_options['logo_mobile_padding']['height']) && ! empty($g5plus_options['logo_mobile_padding']['height'])) {
			$logo_mobile_padding = $g5plus_options['logo_mobile_padding']['height'] . 'px';
		}

		ob_start();

		echo "@top_drawer_bg_color:		$top_drawer_bg_color;", PHP_EOL;
		echo "@top_drawer_text_color:	$top_drawer_text_color;", PHP_EOL;
		echo "@top_bar_bg_color:		$top_bar_bg_color;", PHP_EOL;
		echo "@top_bar_text_color:		$top_bar_text_color;", PHP_EOL;
		echo "@primary_color:			$primary_color;", PHP_EOL;
		echo "@secondary_color:			$secondary_color;", PHP_EOL;
		echo "@text_color:				$text_color;", PHP_EOL;
        echo "@heading_color:			$heading_color;", PHP_EOL;
        echo "@bold_color:				$bold_color;", PHP_EOL;
		echo "@footer_bg_color:			$footer_bg_color;", PHP_EOL;
		echo "@footer_text_color:		$footer_text_color;", PHP_EOL;
		echo "@footer_heading_text_color:$footer_heading_text_color;", PHP_EOL;
		echo "@bottom_bar_bg_color:		$bottom_bar_bg_color;", PHP_EOL;
		echo "@bottom_bar_text_color:	$bottom_bar_text_color;", PHP_EOL;
		echo "@link_color:				$link_color;", PHP_EOL;
		echo "@link_color_hover:		$link_color_hover;", PHP_EOL;
		echo "@link_color_active:		$link_color_active;", PHP_EOL;
		echo "@menu_font:				'$menu_font';", PHP_EOL;
		echo "@secondary_font:				'$secondary_font';", PHP_EOL;
        echo "@primary_font:				'$primary_font';", PHP_EOL;

		echo "@page_title_text_color:	$page_title_text_color;", PHP_EOL;
		echo "@page_title_bg_color:		$page_title_bg_color;", PHP_EOL;
		echo "@page_title_overlay_color:	$page_title_overlay_color;", PHP_EOL;
		echo "@page_title_overlay_opacity:	$page_title_overlay_opacity;", PHP_EOL;

		echo "@logo_max_height:	$logo_max_height;", PHP_EOL;
		echo "@logo_padding:	$logo_padding;", PHP_EOL;
		echo "@main_menu_height:	$main_menu_height;", PHP_EOL;

		echo "@logo_mobile_max_height:	$logo_mobile_max_height;", PHP_EOL;
		echo "@logo_mobile_padding:	$logo_mobile_padding;", PHP_EOL;
		echo "@main_menu_mobile_height:	$main_menu_mobile_height;", PHP_EOL;

		echo "@menu_text_color:	$menu_text_color;", PHP_EOL;
		echo "@menu_sub_bg_color:	$menu_sub_bg_color;", PHP_EOL;
		echo "@menu_sub_text_color:	$menu_sub_text_color;", PHP_EOL;

		echo '@theme_url:"'. THEME_URL . '";', PHP_EOL;

		return ob_get_clean();
	}
}

// GET CUSTOM CSS
//--------------------------------------------------
if (!function_exists('g5plus_custom_css')) {
	function g5plus_custom_css() {
		$g5plus_options = get_option('g5plus_darna_options');

        $custom_css = '';
        $background_image_css = '';

        $layout_style = $g5plus_options['layout_style'];
        if ($layout_style == 'boxed') {
            $body_background_mode = $g5plus_options['body_background_mode'];
            if ($body_background_mode == 'background') {
                $background_image_url = isset($g5plus_options['body_background']['background-image']) ? $g5plus_options['body_background']['background-image'] : '';
                $background_color = isset($g5plus_options['body_background']['background-color']) ? $g5plus_options['body_background']['background-color'] : '';

                if (!empty($background_color)) {
                    $background_image_css .= 'background-color:' . $background_color . ';';
                }

                if (!empty($background_image_url)) {
                    $background_repeat = isset($g5plus_options['body_background']['background-repeat']) ? $g5plus_options['body_background']['background-repeat'] : '';
                    $background_position = isset($g5plus_options['body_background']['background-position']) ? $g5plus_options['body_background']['background-position'] : '';
                    $background_size = isset($g5plus_options['body_background']['background-size']) ? $g5plus_options['body_background']['background-size'] : '';
                    $background_attachment = isset($g5plus_options['body_background']['background-attachment']) ? $g5plus_options['body_background']['background-attachment'] : '';

                    $background_image_css .= 'background-image: url("'. $background_image_url .'");';


                    if (!empty($background_repeat)) {
                        $background_image_css .= 'background-repeat: '. $background_repeat .';';
                    }

                    if (!empty($background_position)) {
                        $background_image_css .= 'background-position: '. $background_position .';';
                    }

                    if (!empty($background_size)) {
                        $background_image_css .= 'background-size: '. $background_size .';';
                    }

                    if (!empty($background_attachment)) {
                        $background_image_css .= 'background-attachment: '. $background_attachment .';';
                    }
                }

            }

            if ($body_background_mode == 'pattern') {
                $background_image_url = THEME_URL . 'assets/images/theme-options/' . $g5plus_options['body_background_pattern'];
                $background_image_css .= 'background-image: url("'. $background_image_url .'");';
                $background_image_css .= 'background-repeat: repeat;';
                $background_image_css .= 'background-position: center center;';
                $background_image_css .= 'background-size: auto;';
                $background_image_css .= 'background-attachment: scroll;';
            }
        }

        if (!empty($background_image_css)) {
            $custom_css.= 'body.boxed{'.$background_image_css.'}';
        }



		if (isset($g5plus_options['custom_css'])) {
            $custom_css .=  $g5plus_options['custom_css'];
		}

        $custom_scroll = isset($g5plus_options['custom_scroll']) ? $g5plus_options['custom_scroll'] : 0;
        if ($custom_scroll == 1) {
            $custom_scroll_width = isset($g5plus_options['custom_scroll_width']) ? $g5plus_options['custom_scroll_width'] : '10';
            $custom_scroll_color = isset($g5plus_options['custom_scroll_color']) ? $g5plus_options['custom_scroll_color'] : '#333333';
            $custom_scroll_thumb_color = isset($g5plus_options['custom_scroll_thumb_color']) ? $g5plus_options['custom_scroll_thumb_color'] : '#e8aa00';

            $custom_css .= 'body::-webkit-scrollbar {width: '.$custom_scroll_width.'px;background-color: '.$custom_scroll_color .';}';
            $custom_css .= 'body::-webkit-scrollbar-thumb{background-color: '.$custom_scroll_thumb_color .';}';
        }

		$footer_bg_image = isset($g5plus_options['footer_bg_image']) && isset($g5plus_options['footer_bg_image']['url']) ?
			$g5plus_options['footer_bg_image']['url'] : '';

		if (!empty($footer_bg_image)) {
			$footer_bg_css = 'background-image:url(' . $footer_bg_image . ');';
			$footer_bg_css .= '-webkit-background-size: cover;';
			$footer_bg_css .= '-moz-background-size: cover;';
			$footer_bg_css .= '-o-background-size: cover;';
			$footer_bg_css .= 'background-size: cover;';
			$footer_bg_css .= 'background-attachment: fixed;';
			$custom_css .= 'footer.main-footer-wrapper {' . $footer_bg_css . '}';
		}


        $custom_css = str_replace( "\r\n", '', $custom_css );
        $custom_css = str_replace( "\n", '', $custom_css );
        $custom_css = str_replace( "\t", '', $custom_css );
		return $custom_css;
	}
}

// UNREGISTER CUSTOM POST TYPES
//--------------------------------------------------
if (!function_exists('g5plus_unregister_post_type')) {
	function g5plus_unregister_post_type( $post_type, $slug = '' ) {
		global $g5plus_options, $wp_post_types;
		if ( isset( $g5plus_options['cpt-disable'] ) ) {
			$cpt_disable = $g5plus_options['cpt-disable'];
			if ( ! empty( $cpt_disable ) ) {
				foreach ( $cpt_disable as $post_type => $cpt ) {
					if ( $cpt == 1 && isset( $wp_post_types[ $post_type ] ) ) {
						unset( $wp_post_types[ $post_type ] );
					}
				}
			}
		}
	}
	add_action( 'init', 'g5plus_unregister_post_type', 20 );
}

