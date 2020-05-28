<?php


/**


 * Created by PhpStorm.


 * User: Administrator


 * Date: 5/28/2015


 * Time: 5:44 PM


 */


if (!class_exists('g5plusFramework_Shortcodes')) {


	class g5plusFramework_Shortcodes


	{





		private static $instance;





		public static function init()


		{


			if (!isset(self::$instance)) {


				self::$instance = new g5plusFramework_Shortcodes;


				add_action('init', array(self::$instance, 'includes'), 0);


				add_action('init', array(self::$instance, 'register_vc_map'), 10);


			}


			return self::$instance;


		}





		public function includes()


		{


			include_once(ABSPATH . 'wp-admin/includes/plugin.php');


			if (!is_plugin_active('js_composer/js_composer.php')) {


				return;


			}


			global $g5plus_options;


			$cpt_disable = $g5plus_options['cpt-disable'];


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/slider-container/slider-container.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/heading/heading.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/button/button.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/icon-box/icon-box.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/partner-carousel/partner-carousel.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/post/post.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/feature/feature.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/testimonial/testimonial.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/services/services.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/counter/counter.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/process/process.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/video-bg/video-bg.php');





			if (!isset($cpt_disable) || $cpt_disable['ourteam'] == '0' || $cpt_disable['ourteam'] == '') {


				include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/ourteam/ourteam.php');


			}


			if (!isset($cpt_disable) || $cpt_disable['portfolio'] == '0' || $cpt_disable['portfolio'] == '') {


				include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/portfolio/portfolio.php');


			}


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/product/product.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/product/product-categories.php');


			include_once(PLUGIN_G5PLUS_FRAMEWORK_DIR . 'includes/shortcodes/countdown/countdown.php');


		}





		public static function g5plus_get_css_animation($css_animation)


		{


			$output = '';


			if ($css_animation != '') {


				wp_enqueue_script('waypoints');


				$output = ' wpb_animate_when_almost_visible g5plus-css-animation ' . $css_animation;


			}


			return $output;


		}





		public static function g5plus_get_style_animation($duration, $delay)


		{


			$styles = array();


			if ($duration != '0' && !empty($duration)) {


				$duration = (float)trim($duration, "\n\ts");


				$styles[] = "-webkit-animation-duration: {$duration}s";


				$styles[] = "-moz-animation-duration: {$duration}s";


				$styles[] = "-ms-animation-duration: {$duration}s";


				$styles[] = "-o-animation-duration: {$duration}s";


				$styles[] = "animation-duration: {$duration}s";


			}


			if ($delay != '0' && !empty($delay)) {


				$delay = (float)trim($delay, "\n\ts");


				$styles[] = "opacity: 0";


				$styles[] = "-webkit-animation-delay: {$delay}s";


				$styles[] = "-moz-animation-delay: {$delay}s";


				$styles[] = "-ms-animation-delay: {$delay}s";


				$styles[] = "-o-animation-delay: {$delay}s";


				$styles[] = "animation-delay: {$delay}s";


			}


			if (count($styles) > 1) {


				return 'style="' . implode(';', $styles) . '"';


			}


			return implode(';', $styles);


		}





		public static function  g5plus_convert_hex_to_rgba($hex, $opacity = 1)


		{


			$hex = str_replace("#", "", $hex);


			if (strlen($hex) == 3) {


				$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));


				$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));


				$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));


			} else {


				$r = hexdec(substr($hex, 0, 2));


				$g = hexdec(substr($hex, 2, 2));


				$b = hexdec(substr($hex, 4, 2));


			}


			$rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';


			return $rgba;


		}





		public static function  substr($str, $txt_len, $end_txt = '...')


		{


			if (empty($str)) return '';


			if (strlen($str) <= $txt_len) return $str;





			$i = $txt_len;


			while ($str[$i] != ' ') {


				$i--;


				if ($i == -1) break;


			}


			while ($str[$i] == ' ') {


				$i--;


				if ($i == -1) break;


			}





			return substr($str, 0, $i + 1) . $end_txt;


		}








		public function register_vc_map()


		{


			global $g5plus_options;


			$cpt_disable = $g5plus_options['cpt-disable'];





			if (function_exists('vc_map')) {


				$add_css_animation = array(


					'type' => 'dropdown',


					'heading' => __('CSS Animation', 'g5plus-framework'),


					'param_name' => 'css_animation',


					'value' => array(__('No', 'g5plus-framework') => '', __('Fade In', 'g5plus-framework') => 'wpb_fadeIn', __('Fade Top to Bottom', 'g5plus-framework') => 'wpb_fadeInDown', __('Fade Bottom to Top', 'g5plus-framework') => 'wpb_fadeInUp', __('Fade Left to Right', 'g5plus-framework') => 'wpb_fadeInLeft', __('Fade Right to Left', 'g5plus-framework') => 'wpb_fadeInRight', __('Bounce In', 'g5plus-framework') => 'wpb_bounceIn', __('Bounce Top to Bottom', 'g5plus-framework') => 'wpb_bounceInDown', __('Bounce Bottom to Top', 'g5plus-framework') => 'wpb_bounceInUp', __('Bounce Left to Right', 'g5plus-framework') => 'wpb_bounceInLeft', __('Bounce Right to Left', 'g5plus-framework') => 'wpb_bounceInRight', __('Zoom In', 'g5plus-framework') => 'wpb_zoomIn', __('Flip Vertical', 'g5plus-framework') => 'wpb_flipInX', __('Flip Horizontal', 'g5plus-framework') => 'wpb_flipInY', __('Bounce', 'g5plus-framework') => 'wpb_bounce', __('Flash', 'g5plus-framework') => 'wpb_flash', __('Shake', 'g5plus-framework') => 'wpb_shake', __('Pulse', 'g5plus-framework') => 'wpb_pulse', __('Swing', 'g5plus-framework') => 'wpb_swing', __('Rubber band', 'g5plus-framework') => 'wpb_rubberBand', __('Wobble', 'g5plus-framework') => 'wpb_wobble', __('Tada', 'g5plus-framework') => 'wpb_tada'),


					'description' => __('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'g5plus-framework'),


					'group' => __('Animation Settings', 'g5plus-framework')


				);





				$add_duration_animation = array(


					'type' => 'textfield',


					'heading' => __('Animation Duration', 'g5plus-framework'),


					'param_name' => 'duration',


					'value' => '',


					'description' => __('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'g5plus-framework'),


					'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),


					'group' => __('Animation Settings', 'g5plus-framework')


				);





				$add_delay_animation = array(


					'type' => 'textfield',


					'heading' => __('Animation Delay', 'g5plus-framework'),


					'param_name' => 'delay',


					'value' => '',


					'description' => __('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'g5plus-framework'),


					'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),


					'group' => __('Animation Settings', 'g5plus-framework')


				);





				$add_el_class = array(


					'type' => 'textfield',


					'heading' => __('Extra class name', 'g5plus-framework'),


					'param_name' => 'el_class',


					'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'g5plus-framework'),


				);





				$target_arr = array(


					__('Same window', 'g5plus-framework') => '_self',


					__('New window', 'g5plus-framework') => '_blank'


				);


				$colors_arr = array(


					__('Darna Color', 'g5plus-framework') => 'darna_color',


					__('Grey', 'g5plus-framework') => 'wpb_button',


					__('Blue', 'g5plus-framework') => 'btn-primary',


					__('Turquoise', 'g5plus-framework') => 'btn-info',


					__('Green', 'g5plus-framework') => 'btn-success',


					__('Orange', 'g5plus-framework') => 'btn-warning',


					__('Red', 'g5plus-framework') => 'btn-danger',


					__('Black', 'g5plus-framework') => "btn-inverse"


				);


				vc_map(array(


					'name' => __('Slider Container', 'g5plus-framework'),


					'base' => 'darna_slider_container',


					'class' => '',


					'icon' => 'fa fa-ellipsis-h',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'as_parent' => array('except' => 'darna_slider_container'),


					'content_element' => true,


					'show_settings_on_create' => true,


					'params' => array(


						array(


							'type' => 'checkbox',


							'heading' => __('Navigation', 'g5plus-framework'),


							'param_name' => 'navigation',


							'description' => __('Show navigation.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Pagination', 'g5plus-framework'),


							'param_name' => 'pagination',


							'description' => __('Show pagination.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'std' => 'yes',


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Single Item', 'g5plus-framework'),


							'param_name' => 'singleitem',


							'description' => __('Display only one item.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Stop On Hover', 'g5plus-framework'),


							'param_name' => 'stoponhover',


							'description' => __('Stop autoplay on mouse hover.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Auto Play', 'g5plus-framework'),


							'param_name' => 'autoplay',


							'description' => __('Change to any integer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds.', 'g5plus-framework'),


							'value' => '',


							'std' => '5000'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items', 'g5plus-framework'),


							'param_name' => 'items',


							'description' => __('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width', 'g5plus-framework'),


							'value' => '',


							'std' => 4


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Desktop', 'g5plus-framework'),


							'param_name' => 'itemsdesktop',


							'description' => __('This allows you to preset the number of slides visible with a particular browser width. The format is [x,y] whereby x=browser width and y=number of slides displayed. For example [1199,4] means that if(window<=1199){ show 4 slides per page} Alternatively use itemsDesktop: false to override these settings.', 'g5plus-framework'),


							'value' => '',


							'std' => '1199,4'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Desktop Small', 'g5plus-framework'),


							'param_name' => 'itemsdesktopsmall',


							'value' => '',


							'std' => '979,4'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Tablet', 'g5plus-framework'),


							'param_name' => 'itemstablet',


							'value' => '',


							'std' => '768,2'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Tablet Small', 'g5plus-framework'),


							'param_name' => 'itemstabletsmall',


							'value' => '',


							'std' => 'false'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Mobile', 'g5plus-framework'),


							'param_name' => 'itemsmobile',


							'value' => '',


							'std' => '479,1'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Items Scale Up', 'g5plus-framework'),


							'param_name' => 'itemsscaleup',


							'description' => __('Option to not stretch items when it is less than the supplied items.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Auto Height', 'g5plus-framework'),


							'param_name' => 'autoheight',


							'description' => __('You can use different heights on slides.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Slide Speed', 'g5plus-framework'),


							'param_name' => 'slidespeed',


							'description' => __('Slide speed in milliseconds. Ex 200', 'g5plus-framework'),


							'value' => '',


							'std' => '200',


						),


						array(


							'type' => 'textfield',


							'heading' => __('Pagination Speed', 'g5plus-framework'),


							'param_name' => 'paginationspeed',


							'description' => __('Pagination speed in milliseconds. Ex 800', 'g5plus-framework'),


							'value' => '',


							'std' => '800',


						),


						array(


							'type' => 'textfield',


							'heading' => __('Rewind Speed', 'g5plus-framework'),


							'param_name' => 'rewindspeed',


							'description' => __('Rewind speed in milliseconds. Ex 1000', 'g5plus-framework'),


							'value' => '',


							'std' => '1000',


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					),


					'js_view' => 'VcColumnView'


				));


				vc_map(array(


					'name' => __('Testimonials', 'g5plus-framework'),


					'base' => 'darna_testimonial_ctn',


					'class' => '',


					'icon' => 'fa fa-quote-left',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'as_parent' => array('only' => 'darna_testimonial_sc'),


					'content_element' => true,


					'show_settings_on_create' => true,


					'params' => array(


						array(


							'type' => 'dropdown',


							'heading' => __('Layout Style', 'g5plus-framework'),


							'param_name' => 'layout_style',


							'admin_label' => true,


							'value' => array(__('style 1', 'g5plus-framework') => 'style1', __('style 2', 'g5plus-framework') => 'style2', __('style 3', 'g5plus-framework') => 'style3'),


							'description' => __('Select Layout Style.', 'g5plus-framework')


						),


						array(


							'type' => 'textfield',


							'heading' => __('Auto Play', 'g5plus-framework'),


							'param_name' => 'autoplay',


							'description' => __('Change to any integer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds.', 'g5plus-framework'),


							'value' => '',


							'std' => '5000'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Stop On Hover', 'g5plus-framework'),


							'param_name' => 'stoponhover',


							'description' => __('Stop autoplay on mouse hover.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Auto Height', 'g5plus-framework'),


							'param_name' => 'autoheight',


							'description' => __('You can use different heights on slides.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Slide Speed', 'g5plus-framework'),


							'param_name' => 'slidespeed',


							'description' => __('Slide speed in milliseconds. Ex 200', 'g5plus-framework'),


							'value' => '',


							'std' => '200',


						),


						array(


							'type' => 'textfield',


							'heading' => __('Pagination Speed', 'g5plus-framework'),


							'param_name' => 'paginationspeed',


							'description' => __('Pagination speed in milliseconds. Ex 800', 'g5plus-framework'),


							'value' => '',


							'std' => '800',


						),


						array(


							'type' => 'textfield',


							'heading' => __('Rewind Speed', 'g5plus-framework'),


							'param_name' => 'rewindspeed',


							'description' => __('Rewind speed in milliseconds. Ex 1000', 'g5plus-framework'),


							'value' => '',


							'std' => '1000',


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					),


					'js_view' => 'VcColumnView'


				));


				vc_map(array(


					'name' => __('Testimonial', 'g5plus-framework'),


					'base' => 'darna_testimonial_sc',


					'class' => '',


					'icon' => 'fa fa-user',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'as_child' => array('only' => 'darna_testimonial_ctn', 'darna_slider_container'),


					'params' => array(


						array(


							'type' => 'textfield',


							'heading' => __('Author name', 'g5plus-framework'),


							'param_name' => 'author',


							'admin_label' => true,


							'description' => __('Enter Author name.', 'g5plus-framework')


						),


						array(


							'type' => 'textfield',


							'heading' => __('Author information', 'g5plus-framework'),


							'param_name' => 'author_info',


							'description' => __('Enter author information.', 'g5plus-framework')


						),


						array(


							'type' => 'textarea',


							'heading' => __('Quote from author', 'g5plus-framework'),


							'param_name' => 'content',


							'value' => ''


						)


					)


				));


				vc_map(array(


					'name' => __('Services', 'g5plus-framework'),


					'base' => 'darna_services_ctn',


					'class' => '',


					'icon' => 'fa fa-bars',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'as_parent' => array('only' => 'darna_services_sc'),


					'content_element' => true,


					'show_settings_on_create' => true,


					'params' => array(


						array(


							'type' => 'checkbox',


							'heading' => __('Navigation', 'g5plus-framework'),


							'param_name' => 'navigation',


							'description' => __('Show navigation.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'std' => 'yes',


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Pagination', 'g5plus-framework'),


							'param_name' => 'pagination',


							'description' => __('Show pagination.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Single Item', 'g5plus-framework'),


							'param_name' => 'singleitem',


							'description' => __('Display only one item.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Stop On Hover', 'g5plus-framework'),


							'param_name' => 'stoponhover',


							'description' => __('Stop autoplay on mouse hover.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Auto Play', 'g5plus-framework'),


							'param_name' => 'autoplay',


							'description' => __('Change to any integer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds.', 'g5plus-framework'),


							'value' => '',


							'std' => '5000'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items', 'g5plus-framework'),


							'param_name' => 'items',


							'description' => __('This variable allows you to set the maximum amount of items displayed at a time with the widest browser width', 'g5plus-framework'),


							'value' => '',


							'std' => 4


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Desktop', 'g5plus-framework'),


							'param_name' => 'itemsdesktop',


							'description' => __('This allows you to preset the number of slides visible with a particular browser width. The format is [x,y] whereby x=browser width and y=number of slides displayed. For example [1199,4] means that if(window<=1199){ show 4 slides per page} Alternatively use itemsDesktop: false to override these settings.', 'g5plus-framework'),


							'value' => '',


							'std' => '1199,4'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Desktop Small', 'g5plus-framework'),


							'param_name' => 'itemsdesktopsmall',


							'value' => '',


							'std' => '979,4'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Tablet', 'g5plus-framework'),


							'param_name' => 'itemstablet',


							'value' => '',


							'std' => '768,2'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Tablet Small', 'g5plus-framework'),


							'param_name' => 'itemstabletsmall',


							'value' => '',


							'std' => 'false'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Items Mobile', 'g5plus-framework'),


							'param_name' => 'itemsmobile',


							'value' => '',


							'std' => '479,1'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Items Scale Up', 'g5plus-framework'),


							'param_name' => 'itemsscaleup',


							'description' => __('Option to not stretch items when it is less than the supplied items.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Auto Height', 'g5plus-framework'),


							'param_name' => 'autoheight',


							'description' => __('You can use different heights on slides.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes'),


							'edit_field_class' => 'vc_col-sm-6 vc_column'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Slide Speed', 'g5plus-framework'),


							'param_name' => 'slidespeed',


							'description' => __('Slide speed in milliseconds. Ex 200', 'g5plus-framework'),


							'value' => '',


							'std' => '200',


						),


						array(


							'type' => 'textfield',


							'heading' => __('Pagination Speed', 'g5plus-framework'),


							'param_name' => 'paginationspeed',


							'description' => __('Pagination speed in milliseconds. Ex 800', 'g5plus-framework'),


							'value' => '',


							'std' => '800',


						),


						array(


							'type' => 'textfield',


							'heading' => __('Rewind Speed', 'g5plus-framework'),


							'param_name' => 'rewindspeed',


							'description' => __('Rewind speed in milliseconds. Ex 1000', 'g5plus-framework'),


							'value' => '',


							'std' => '1000',


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					),


					'js_view' => 'VcColumnView'


				));


				vc_map(array(


					'name' => __('Service', 'g5plus-framework'),


					'base' => 'darna_services_sc',


					'class' => '',


					'icon' => 'fa fa-minus',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'as_child' => array('only' => 'darna_services_ctn', 'darna_slider_container'),


					'params' => array(


						array(


							'type' => 'icon_text',


							'heading' => __('Select Icon:', 'g5plus-framework'),


							'param_name' => 'icon',


							'value' => '',


							'description' => __('Select the icon from the list.', 'g5plus-framework'),


						),


						array(


							'type' => 'attach_image',


							'heading' => __('Image:', 'g5plus-framework'),


							'param_name' => 'image',


							'value' => '',


							'description' => __('Select image background.', 'g5plus-framework'),


						),


						array(


							'type' => 'textfield',


							'heading' => __('Title', 'g5plus-framework'),


							'param_name' => 'title',


							'value' => '',


							'description' => __('Provide the title for this icon box.', 'g5plus-framework'),


						),


						array(


							'type' => 'textarea',


							'heading' => __('Description', 'g5plus-framework'),


							'param_name' => 'description',


							'value' => '',


							'description' => __('Provide the description for this icon box.', 'g5plus-framework'),


						),


						array(


							'type' => 'vc_link',


							'heading' => __('Link (url)', 'g5plus-framework'),


							'param_name' => 'link',


							'value' => '',


						)


					)


				));


				vc_map(array(


					'name' => __('Video Background', 'g5plus-framework'),


					'base' => 'darna_video_bg',


					'class' => '',


					'icon' => 'fa fa-video-camera',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'params' => array(


						array(


							'type' => 'dropdown',


							'heading' => __('Layout Style', 'g5plus-framework'),


							'param_name' => 'layout_style',


							'admin_label' => true,


							'value' => array(__('style 1', 'g5plus-framework') => 'style1'),


							'description' => __('Select Layout Style.', 'g5plus-framework')


						),


						array(


							'type' => 'textarea',


							'heading' => __('Link Video (.mp4 or .ogg)', 'g5plus-framework'),


							'param_name' => 'video_link',


							'value' => '',


						),


						array(


							'type' => 'attach_image',


							'heading' => __('Upload Image:', 'g5plus-framework'),


							'param_name' => 'image',


							'value' => '',


							'description' => __('Image show on mobile device and when not autoplay mode.', 'g5plus-framework'),


						),


						array(


							'type' => 'textfield',


							'heading' => __('Title', 'g5plus-framework'),


							'param_name' => 'title',


							'value' => '',


						),


						array(


							'type' => 'textarea',


							'heading' => __('Description', 'g5plus-framework'),


							'param_name' => 'description',


							'value' => '',


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Video Autoplay', 'g5plus-framework'),


							'param_name' => 'autoplay',


							'description' => __('Enables autoplay mode.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes')


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					)


				));


				vc_map(array(


					'name' => __('Counter', 'g5plus-framework'),


					'base' => 'darna_counter',


					'class' => '',


					'icon' => 'fa fa-tachometer',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'params' => array(


						array(


							'type' => 'textfield',


							'heading' => __('Value', 'g5plus-framework'),


							'param_name' => 'value',


							'value' => '',


						),


						array(


							'type' => 'colorpicker',


							'heading' => __('Color', 'g5plus-framework'),


							'param_name' => 'value_color',


							'description' => __('Select custom color for your element.', 'g5plus-framework'),


						),


						array(


							'type' => 'textfield',


							'heading' => __('Title', 'g5plus-framework'),


							'param_name' => 'title',


							'value' => '',


							'admin_label' => true,


						),


						array(


							'type' => 'colorpicker',


							'heading' => __('Color', 'g5plus-framework'),


							'param_name' => 'title_color',


							'description' => __('Select custom color for your element.', 'g5plus-framework'),


						),


						$add_el_class


					)


				));





				if (!isset($cpt_disable) || $cpt_disable['portfolio'] == '0' || $cpt_disable['portfolio'] == '') {


					$portfolio_categories = get_terms(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY, array('hide_empty' => 0, 'orderby' => 'ASC'));


					$portfolio_cat = array();


					if (is_array($portfolio_categories)) {


						foreach ($portfolio_categories as $cat) {


							$portfolio_cat[$cat->name] = $cat->slug;


						}


					}


					vc_map(array(


						'name' => __('Portfolio', 'g5plus-framework'),


						'base' => 'g5plusframework_portfolio',


						'class' => '',


						'icon' => 'fa fa-th-large',


						'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


						'params' => array(


							array(


								'type' => 'dropdown',


								'heading' => __('Style', 'g5plus-framework'),


								'param_name' => 'style',


								'admin_label' => true,


								'value' => array(__('Light', 'g5plus-framework') => '', __('Dark', 'g5plus-framework') => 'style_2')


							),


							array(


								'type' => 'multi-select',


								'heading' => __('Portfolio Category', 'g5plus-framework'),


								'param_name' => 'category',


								'options' => $portfolio_cat


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Show Category', 'g5plus-framework'),


								'param_name' => 'show_category',


								'admin_label' => true,


								'value' => array(


									__('None', 'g5plus-framework') => '',


									__('Show in left', 'g5plus-framework') => 'left',


									__('Show in center', 'g5plus-framework') => 'center',


									__('Show in right', 'g5plus-framework') => 'right')


							),


							array(





								'type' => 'dropdown',


								'heading' => __('Category Style', 'g5plus-framework'),


								'param_name' => 'category_style',


								'admin_label' => true,


								'value' => array(__('Normal', 'g5plus-framework') => 'cat-style-normal',


									__('Magic line', 'g5plus-framework') => 'magic-line-container',


									__('Has background', 'g5plus-framework') => 'background-cat')


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Number of column', 'g5plus-framework'),


								'param_name' => 'column',


								'value' => array('2' => '2', '3' => '3', '4' => '4')


							),


							array(


								'type' => 'textfield',


								'heading' => __('Number of item (or number of item per page if choose show paging)', 'g5plus-framework'),


								'param_name' => 'item',


								'value' => ''


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Order Post Date By', 'g5plus-framework'),


								'param_name' => 'order',


								'value' => array(__('Descending', 'g5plus-framework') => 'DESC', __('Ascending', 'g5plus-framework') => 'ASC')


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Show Paging', 'g5plus-framework'),


								'param_name' => 'show_pagging',


								'value' => array('None' => '', __('Load more', 'g5plus-framework') => '1', __('Slider', 'g5plus-framework') => '2')


							),


							array(


								'type' => 'vc_link',


								'heading' => __('View all project', 'g5plus-framework'),


								'param_name' => 'view_all_link',


								'description' => __('Add link to button.', 'g5plus-framework'),


								'dependency' => array(


									'element' => 'show_pagging',


									'value' => '2',


								)


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Padding', 'g5plus-framework'),


								'param_name' => 'padding',


								'value' => array(__('No padding', 'g5plus-framework') => '', '10 px' => 'col-padding-10', '15 px' => 'col-padding-15', '20 px' => 'col-padding-20', '40 px' => 'col-padding-40')


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Overlay Style', 'g5plus-framework'),


								'param_name' => 'overlay_style',


								'admin_label' => true,


								'value' => array(__('Title & category float top', 'g5plus-framework') => 'title-float', __('Title & Category', 'g5plus-framework') => 'title',


                                    __('Title & category float style 2', 'g5plus-framework') => 'title-float-style-2'


								)


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Background Title Float', 'g5plus-framework'),


								'param_name' => 'bg_title_float_style',


								'admin_label' => true,


								'value' => array(__('Light', 'g5plus-framework') => '', __('Dark', 'g5plus-framework') => 'dark',


								),


								'dependency' => array(


									'element' => 'overlay_style',


									'value' => 'title-float',


								)


							),


                            array(


                                'type'        => 'dropdown',


                                'heading'     => __( 'Show link to detail', 'g5plus-framework' ),


                                'param_name'  => 'show_link_to_detail',


                                'value'       => array( __( 'Yes' ) => '',__( 'No', 'g5plus-framework' ) => 'no')


                            ),


							$add_el_class,


							$add_css_animation,


							$add_duration_animation,


							$add_delay_animation





						)


					));


				}





				if (!isset($cpt_disable) || $cpt_disable['ourteam'] == '0' || $cpt_disable['ourteam'] == '') {


					$ourteam_cat = array();


					$ourteam_categories = get_terms('ourteam_category', array('hide_empty' => 0, 'orderby' => 'ASC'));


					if (is_array($ourteam_categories)) {


						foreach ($ourteam_categories as $cat) {


							$ourteam_cat[$cat->name] = $cat->slug;


						}


					}


					vc_map(array(


						'name' => __('Our Team', 'g5plus-framework'),


						'base' => 'darna_ourteam',


						'class' => '',


						'icon' => 'fa fa-users',


						'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


						'params' => array(


							array(


								'type' => 'dropdown',


								'heading' => __('Layout Style', 'g5plus-framework'),


								'param_name' => 'layout_style',


								'admin_label' => true,


								'value' => array(__('style 1', 'g5plus-framework') => 'style1'),


								'description' => __('Select Layout Style.', 'g5plus-framework')


							),


							array(


								'type' => 'textfield',


								'heading' => __('Item Amount', 'g5plus-framework'),


								'param_name' => 'item_amount',


								'value' => '8'


							),


							array(


								'type' => 'textfield',


								'heading' => __('Column', 'g5plus-framework'),


								'param_name' => 'column',


								'value' => '4'


							),


							array(


								'type' => 'checkbox',


								'heading' => __('Slider Style', 'g5plus-framework'),


								'param_name' => 'is_slider',


								'admin_label' => false,


								'value' => array(__('Yes, please', 'g5plus-framework') => 'yes')


							),


							array(


								'type' => 'multi-select',


								'heading' => __('Category', 'g5plus-framework'),


								'param_name' => 'category',


								'options' => $ourteam_cat


							),


							$add_el_class,


							$add_css_animation,


							$add_duration_animation,


							$add_delay_animation


						)


					));


				}





				vc_map(array(


					'name' => __('Button', 'g5plus-framework'),


					'base' => 'darna_button',


					'class' => '',


					'icon' => 'fa fa-bold',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'params' => array(


						array(


							'type' => 'dropdown',


							'heading' => __('Layout Style', 'g5plus-framework'),


							'param_name' => 'layout_style',


							'admin_label' => true,


							'value' => array(


								__('style 1', 'g5plus-framework') => 'style1',


								__('style 2', 'g5plus-framework') => 'style2',


								__('style 3', 'g5plus-framework') => 'style3',


								__('style 4', 'g5plus-framework') => 'style4'


							),


							'description' => __('Select Layout Style.', 'g5plus-framework')


						),


						array(


							'type' => 'vc_link',


							'heading' => __('URL (Link)', 'g5plus-framework'),


							'param_name' => 'link',


							'description' => __('Add link to button.', 'g5plus-framework'),


						),


						array(


							'type' => 'dropdown',


							'heading' => __('Size', 'g5plus-framework'),


							'param_name' => 'size',


							'description' => __('Select button display size.', 'g5plus-framework'),


							'std' => 'md',


							'value' => array(


								__('Mini', 'g5plus-framework') => 'xs',


								__('Small', 'g5plus-framework') => 'sm',


								__('Medium', 'g5plus-framework') => 'md',


								__('Large', 'g5plus-framework') => 'lg',


							)


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Add icon?', 'g5plus-framework'),


							'param_name' => 'add_icon',


						),


						array(


							'type' => 'icon_text',


							'heading' => __('Select Icon:', 'g5plus-framework'),


							'param_name' => 'icon',


							'value' => '',


							'description' => __('Select the icon from the list.', 'g5plus-framework'),


							'dependency' => array(


								'element' => 'add_icon',


								'value' => 'true',


							),


						),


						array(


							'type' => 'dropdown',


							'heading' => __('Icon Alignment', 'g5plus-framework'),


							'description' => __('Select icon alignment.', 'g5plus-framework'),


							'param_name' => 'i_align',


							'value' => array(


								__('Left', 'g5plus-framework') => 'left',


								__('Right', 'g5plus-framework') => 'right',


							),


							'dependency' => array(


								'element' => 'add_icon',


								'value' => 'true',


							),


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					)


				));


				vc_map(array(


					'name' => __('Process', 'g5plus-framework'),


					'base' => 'darna_process',


					'class' => '',


					'icon' => 'fa fa-long-arrow-right',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'params' => array(


						array(


							'type' => 'dropdown',


							'heading' => __('Layout Style', 'g5plus-framework'),


							'param_name' => 'layout_style',


							'admin_label' => true,


							'value' => array(__('style 1', 'g5plus-framework') => 'style1', __('style 2', 'g5plus-framework') => 'style2'),


							'description' => __('Select Layout Style.', 'g5plus-framework')


						),


						array(


							'type' => 'textfield',


							'heading' => __('Step Number', 'g5plus-framework'),


							'param_name' => 'step',


							'value' => '',


						),


						array(


							'type' => 'textfield',


							'heading' => __('Title', 'g5plus-framework'),


							'param_name' => 'title',


							'value' => '',


						),


						array(


							'type' => 'textarea',


							'heading' => __('Description', 'g5plus-framework'),


							'param_name' => 'description',


							'value' => '',


						),


						array(


							'type' => 'vc_link',


							'heading' => __('Link (url)', 'g5plus-framework'),


							'param_name' => 'link',


							'value' => '',


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Last Step ?', 'g5plus-framework'),


							'param_name' => 'last_step',


							'value' => array(__('Yes', 'g5plus-framework') => 'yes'),


							'dependency' => Array('element' => 'layout_style', 'value' => array('style1'))


						),


						array(


							'type' => 'icon_text',


							'heading' => __('Select Icon:', 'g5plus-framework'),


							'param_name' => 'icon',


							'value' => '',


							'description' => __('Select the icon from the list.', 'g5plus-framework'),


							'dependency' => Array('element' => 'layout_style', 'value' => array('style2'))


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					)


				));


				vc_map(array(


					'name' => __('Feature Box', 'g5plus-framework'),


					'base' => 'darna_feature',


					'class' => '',


					'icon' => 'fa fa-th-list',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'params' => array(


						array(


							'type' => 'dropdown',


							'heading' => __('Layout Style', 'g5plus-framework'),


							'param_name' => 'layout_style',


							'admin_label' => true,


							'value' => array(__('style 1', 'g5plus-framework') => 'style1'),


							'description' => __('Select Layout Style.', 'g5plus-framework')


						),


						array(


							'type' => 'attach_image',


							'heading' => __('Image:', 'g5plus-framework'),


							'param_name' => 'image',


							'value' => '',


						),


						array(


							'type' => 'textfield',


							'heading' => __('Video Url', 'g5plus-framework'),


							'param_name' => 'video_url',


							'value' => '',


						),


						array(


							'type' => 'textfield',


							'heading' => __('Title', 'g5plus-framework'),


							'param_name' => 'title',


							'value' => '',


						),


						array(


							'type' => 'icon_text',


							'heading' => __('Select Icon:', 'g5plus-framework'),


							'param_name' => 'icon',


							'value' => '',


							'description' => __('Select the icon from the list.', 'g5plus-framework'),


						),


						array(


							'type' => 'textarea',


							'heading' => __('Description', 'g5plus-framework'),


							'param_name' => 'description',


							'value' => '',


						),


						array(


							'type' => 'vc_link',


							'heading' => __('Link (url)', 'g5plus-framework'),


							'param_name' => 'link',


							'value' => '',


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					)


				));


				vc_map(array(


					'name' => __('Posts', 'g5plus-framework'),


					'base' => 'darna_post',


					'icon' => 'fa fa-file-text-o',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'description' => __('Posts', 'g5plus-framework'),


					'params' => array(


						array(


							'type' => 'dropdown',


							'heading' => __('Display', 'g5plus-framework'),


							'param_name' => 'display',


							'admin_label' => true,


							'value' => array(__('Random', '') => 'random', __('Popular', 'g5plus-framework') => 'popular', __('Recent', 'g5plus-framework') => 'recent', __('Oldest', 'g5plus-framework') => 'oldest'),


							'description' => __('Select Orderby.', 'g5plus-framework'),


							'std' => 'recent'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Item Amount', 'g5plus-framework'),


							'param_name' => 'item_amount',


							'value' => '10'


						),


						array(


							'type' => 'textfield',


							'heading' => __('Column', 'g5plus-framework'),


							'param_name' => 'column',


							'value' => '3'


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Slider Style', 'g5plus-framework'),


							'param_name' => 'is_slider',


							'admin_label' => false,


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes')


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					)


				));


				vc_map(array(


					'name' => __('Partner Carousel', 'g5plus-framework'),


					'base' => 'darna_partner_carousel',


					'icon' => 'fa fa-user-plus',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'description' => __('Animated carousel with images', 'g5plus-framework'),


					'params' => array(


						array(


							'type' => 'attach_images',


							'heading' => __('Images', 'g5plus-framework'),


							'param_name' => 'images',


							'value' => '',


							'description' => __('Select images from media library.', 'g5plus-framework')


						),


						array(


							'type' => 'textfield',


							'heading' => __('Image size', 'g5plus-framework'),


							'param_name' => 'img_size',


							'description' => __('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'g5plus-framework')


						),


						array(


							'type' => 'dropdown',


							'heading' => __('Image Opacity', 'g5plus-framework'),


							'param_name' => 'opacity',


							'value' => array(


								__('10%', 'g5plus-framework') => '10',


								__('20%', 'g5plus-framework') => '20',


								__('30%', 'g5plus-framework') => '30',


								__('40%', 'g5plus-framework') => '40',


								__('50%', 'g5plus-framework') => '50',


								__('60%', 'g5plus-framework') => '60',


								__('70%', 'g5plus-framework') => '70',


								__('80%', 'g5plus-framework') => '80',


								__('90%', 'g5plus-framework') => '90',


								__('100%', 'g5plus-framework') => '100'


							),


							'std' => '80'


						),


						array(


							'type' => 'exploded_textarea',


							'heading' => __('Custom links', 'g5plus-framework'),


							'param_name' => 'custom_links',


							'description' => __('Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'g5plus-framework'),


						),


						array(


							'type' => 'dropdown',


							'heading' => __('Custom link target', 'g5plus-framework'),


							'param_name' => 'custom_links_target',


							'description' => __('Select where to open  custom links.', 'g5plus-framework'),


							'value' => $target_arr


						),


						array(


							'type' => 'textfield',


							'heading' => __('Slides per view', 'g5plus-framework'),


							'param_name' => 'column',


							'value' => '5',


							'description' => __('Set numbers of slides you want to display', 'g5plus-framework')


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Slider autoplay', 'g5plus-framework'),


							'param_name' => 'autoplay',


							'description' => __('Enables autoplay mode.', 'g5plus-framework'),


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes')


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Show pagination control', 'g5plus-framework'),


							'param_name' => 'pagination',


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes')


						),


						array(


							'type' => 'checkbox',


							'heading' => __('Show navigation control', 'g5plus-framework'),


							'param_name' => 'navigation',


							'value' => array(__('Yes, please', 'g5plus-framework') => 'yes')


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					)


				));


				vc_map(array(


					'name' => __('Headings', 'g5plus-framework'),


					'base' => 'darna_heading',


					'icon' => 'fa fa-header',


					'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


					'params' => array(


						array(


							'type' => 'dropdown',


							'heading' => __('Layout Style', 'g5plus-framework'),


							'param_name' => 'layout_style',


							'admin_label' => true,


							'value' => array(__('style 1', 'g5plus-framework') => 'style1', __('style 2', 'g5plus-framework') => 'style2'),


							'description' => __('Select Layout Style.', 'g5plus-framework')


						),


						array(


							'type' => 'textfield',


							'heading' => __('Title', 'g5plus-framework'),


							'param_name' => 'title',


							'value' => '',


							'admin_label' => true


						),


						array(


							'type' => 'textfield',


							'heading' => __('Sub Title', 'g5plus-framework'),


							'param_name' => 'sub_title',


							'value' => '',


						),


						$add_el_class,


						$add_css_animation,


						$add_duration_animation,


						$add_delay_animation


					)


				));


				vc_map(


					array(


						'name' => __('Icon Box', 'g5plus-framework'),


						'base' => 'darna_icon_box',


						'icon' => 'fa fa-diamond',


						'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


						'description' => 'Adds icon box with font icons',


						'params' => array(


							array(


								'type' => 'dropdown',


								'heading' => __('Layout Style', 'g5plus-framework'),


								'param_name' => 'layout_style',


								'admin_label' => true,


								'value' => array(__('style 1', 'g5plus-framework') => 'style1', __('style 2', 'g5plus-framework') => 'style2', __('style 3', 'g5plus-framework') => 'style3', __('style 4', 'g5plus-framework') => 'style4', __('style 5', 'g5plus-framework') => 'style5', __('style 6', 'g5plus-framework') => 'style6'),


								'description' => __('Select Layout Style.', 'g5plus-framework')


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Icon to display:', 'g5plus-framework'),


								'param_name' => 'icon_type',


								'value' => array(


									__('Font Icon', 'g5plus-framework') => 'font-icon',


									__('Custom Image Icon', 'g5plus-framework') => 'custom',


								),


								'description' => __('Select which icon you would like to use', 'g5plus-framework')


							),


							// Play with icon selector


							array(


								'type' => 'icon_text',


								'heading' => __('Select Icon:', 'g5plus-framework'),


								'param_name' => 'icon',


								'value' => '',


								'description' => __('Select the icon from the list.', 'g5plus-framework'),


								'dependency' => Array('element' => 'icon_type', 'value' => array('font-icon')),


							),





							// Play with icon selector


							array(


								'type' => 'attach_image',


								'heading' => __('Upload Image Icon:', 'g5plus-framework'),


								'param_name' => 'image',


								'value' => '',


								'description' => __('Upload the custom image icon.', 'g5plus-framework'),


								'dependency' => Array('element' => 'icon_type', 'value' => array('custom')),


							),


							array(


								'type' => 'vc_link',


								'heading' => __('Link (url)', 'g5plus-framework'),


								'param_name' => 'link',


								'value' => '',


							),


							array(


								'type' => 'textfield',


								'heading' => __('Title', 'g5plus-framework'),


								'param_name' => 'title',


								'value' => '',


								'description' => __('Provide the title for this icon box.', 'g5plus-framework'),


							),


							array(


								'type' => 'textarea',


								'heading' => __('Description', 'g5plus-framework'),


								'param_name' => 'description',


								'value' => '',


								'description' => __('Provide the description for this icon box.', 'g5plus-framework'),


							),


							$add_el_class,


							$add_css_animation,


							$add_duration_animation,


							$add_delay_animation


						)


					)


				);





				$product_cat = array();


				if (class_exists('WooCommerce')) {


					$args = array(


						'number' => '',


					);


					$product_categories = get_terms('product_cat', $args);


					if (is_array($product_categories)) {


						foreach ($product_categories as $cat) {


							$product_cat[$cat->name] = $cat->slug;


						}


					}








					vc_map(


						array(


							'name' => __('Product', 'g5plus-framework'),


							'base' => 'darna_product',


							'icon' => 'fa fa-shopping-cart',


							'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


							'params' => array(


								array(


									"type" => "textfield",


									"heading" => __("Title", 'g5plus-framework'),


									"param_name" => "title",


									"admin_label" => true,


									"value" => ''


								),


								array(


									'type' => 'dropdown',


									'heading' => __('Select product source', 'g5plus-framework'),


									'param_name' => 'source',


									'value' => array(__('From feature', 'g5plus-framework') => 'feature',


										__('From category', 'g5plus-framework') => 'category',


									),


								),


								array(


									'type' => 'dropdown',


									'heading' => __('Feature', 'g5plus-framework'),


									'param_name' => 'filter',


									'value' => array(__('Sale Off', 'g5plus-framework') => 'sale',


										__('New In', 'g5plus-framework') => 'new-in',


										__('Featured', 'g5plus-framework') => 'featured',


										__('Top rated', 'g5plus-framework') => 'top-rated',


										__('Recent review', 'g5plus-framework') => 'recent-review',


										__('Best Selling', 'g5plus-framework') => 'best-selling'


									),


									'dependency' => Array('element' => 'source', 'value' => array('feature'))





								),


								array(


									'type' => 'multi-select',


									'heading' => __('Category', 'g5plus-framework'),


									'param_name' => 'category',


									'options' => $product_cat,


									'dependency' => Array('element' => 'source', 'value' => array('category'))


								),


								array(


									"type" => "textfield",


									"heading" => __("Per Page", 'g5plus-framework'),


									"param_name" => "per_page",


									"admin_label" => true,


									"value" => '8',


									"description" => __('How much items per page to show', 'g5plus-framework')


								),


								array(


									"type" => "textfield",


									"heading" => __("Columns", 'g5plus-framework'),


									"param_name" => "columns",


									"value" => '4',


									"description" => __("How much columns grid", 'g5plus-framework'),


								),


								array(


									'type' => 'dropdown',


									'heading' => __('Display Slider', 'g5plus-framework'),


									'param_name' => 'slider',


									'value' => array(__('No', 'g5plus-framework') => '', __('Yes', 'g5plus-framework') => 'slider'),


								),








								array(


									'type' => 'dropdown',


									'heading' => __('Order by', 'g5plus-framework'),


									'param_name' => 'orderby',


									'value' => array(__('Date', 'g5plus-framework') => 'date', __('ID', 'g5plus-framework') => 'ID',


										__('Author', 'g5plus-framework') => 'author', __('Modified', 'g5plus-framework') => 'modified',


										__('Random', 'g5plus-framework') => 'rand', __('Comment count', 'g5plus-framework') => 'comment_count',


										__('Menu Order', 'g5plus-framework') => 'menu_order'


									),


									'description' => __('Select how to sort retrieved products.', 'g5plus-framework'),


								),


								array(


									'type' => 'dropdown',


									'heading' => __('Order way', 'g5plus-framework'),


									'param_name' => 'order',


									'value' => array(__('Descending', 'g5plus-framework') => 'DESC', __('Ascending', 'g5plus-framework') => 'ASC'),


									'description' => __('Designates the ascending or descending order.', 'g5plus-framework'),


								),


								$add_el_class,


								$add_css_animation,


								$add_duration_animation,


								$add_delay_animation


							)


						)


					);





					vc_map(array(


						'name' => __('Product Categories', 'g5plus-framework'),


						'base' => 'darna_product_categories',


						'class' => '',


						'icon' => 'fa fa-cart-plus',


						'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,


						'params' => array(


							array(


								"type" => "textfield",


								"heading" => __("Title", 'g5plus-framework'),


								"param_name" => "title",


								"admin_label" => true,


								"value" => ''


							),


							array(


								'type' => 'multi-select',


								'heading' => __('Product Category', 'g5plus-framework'),


								'param_name' => 'category',


								'options' => $product_cat


							),


							array(


								"type" => "textfield",


								"heading" => __("Columns", 'g5plus-framework'),


								"param_name" => "columns",


								"value" => '4',


								"description" => __("How much columns grid", 'g5plus-framework'),


							),





							array(


								'type' => 'dropdown',


								'heading' => __('Slider', 'g5plus-framework'),


								'param_name' => 'slider',


								'value' => array(__('No', 'g5plus-framework') => '',


									__('Yes', 'g5plus-framework') => 'slider'


								),


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Hide empty', 'g5plus-framework'),


								'param_name' => 'hide_empty',


								'value' => array(__('No', 'g5plus-framework') => '0',


									__('Yes', 'g5plus-framework') => '1'


								),


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Order by', 'g5plus-framework'),


								'param_name' => 'orderby',


								'value' => array(__('Date', 'g5plus-framework') => 'date', __('ID', 'g5plus-framework') => 'ID',


									__('Author', 'g5plus-framework') => 'author', __('Modified', 'g5plus-framework') => 'modified',


									__('Random', 'g5plus-framework') => 'rand', __('Comment count', 'g5plus-framework') => 'comment_count',


									__('Menu Order', 'g5plus-framework') => 'menu_order'


								),


								'description' => __('Select how to sort retrieved products.', 'g5plus-framework')


							),


							array(


								'type' => 'dropdown',


								'heading' => __('Order way', 'g5plus-framework'),


								'param_name' => 'order',


								'value' => array(__('Descending', 'g5plus-framework') => 'DESC', __('Ascending', 'g5plus-framework') => 'ASC'),


								'description' => __('Designates the ascending or descending orde.', 'g5plus-framework')


							),


							$add_el_class,


							$add_css_animation,


							$add_duration_animation,


							$add_delay_animation


						)


					));


				}


			}


		}





	}





	if (!function_exists('init_g5plus_framework_shortcodes')) {


		function init_g5plus_framework_shortcodes()


		{


			return g5plusFramework_Shortcodes::init();


		}





		init_g5plus_framework_shortcodes();


	}


}


