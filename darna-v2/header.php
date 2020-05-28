<!DOCTYPE html>


<!-- Open Html -->


<html <?php language_attributes(); ?>>


	<!-- Open Head -->


	<head>


		<?php


		global $g5plus_options;


		$body_class = array();


        $prefix = 'g5plus_';





        $body_class[] = 'footer-static';


		if ($g5plus_options['home_preloader'] != 'none' && !empty($g5plus_options['home_preloader'])) {


			$body_class[] = 'site-loading';


		}





        $layout_style = rwmb_meta($prefix . 'layout_style');


        if (($layout_style == '') || ($layout_style == "-1")) {


            $layout_style = $g5plus_options['layout_style'];


        }


        if ($layout_style == 'boxed') {


            $body_class[] =  'boxed';


        }





        $prefix = 'g5plus_';


        $page_class_extra =  rwmb_meta($prefix.'page_class_extra','type=text',get_the_ID());





        if (!empty($page_class_extra)) {


            $body_class[] = $page_class_extra;


        }








		$header_layout = rwmb_meta($prefix . 'header_layout');


		if (($header_layout === '') || ($header_layout == '-1')) {


			$header_layout = $g5plus_options['header_layout'];


		}





		$body_class[] = $header_layout;





        $body_class = apply_filters('g5plus_body_class_filter',$body_class);


		?>


		<?php wp_head(); ?>


	</head>


	<!-- Close Head -->


	<body <?php body_class( $body_class ); ?>>


		<?php


			/**


			 * @hooked  - g5plus_site_loading - 5


			 **/


			do_action('g5plus_before_page_wrapper');


		?>





		<!-- Open Wrapper -->


		<div id="wrapper">





		<?php


		/**


		 * @hooked - g5plus_page_above_header - 5


		 * @hooked - g5plus_page_top_bar - 10


		 * @hooked - g5plus_page_header - 15


		 **/


		do_action('g5plus_before_page_wrapper_content');


		?>





			<!-- Open Wrapper Content -->


			<div id="wrapper-content" class="clearfix">





			<?php


			/**


			 **/


			do_action('g5plus_main_wrapper_content_start');


			?>


