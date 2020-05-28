<?php


/**


 * Created by PhpStorm.


 * User: Administrator


 * Date: 6/2/2015


 * Time: 2:54 PM


 */


global $g5plus_options;


global $post;


$prefix = 'g5plus_';


$show_page_title =  rwmb_meta($prefix.'show_page_title');


if (($show_page_title == -1) || ($show_page_title === '')) {





    $show_page_title = $g5plus_options['show_page_title'];





    if (is_singular('product')) {


        $show_page_title = $g5plus_options['show_single_product_title'];


    }





    else if (is_singular('portfolio')) {


        $show_page_title = $g5plus_options['show_portfolio_title'];


    }





    else if (is_singular('post')) {


        $show_page_title = $g5plus_options['show_single_blog_title'];


    }





}





if ($show_page_title == 0) {


	return;


}





$page_title = rwmb_meta($prefix.'page_title_custom','type=text',get_the_ID());


if ($page_title === '') {


	$page_title = get_the_title();


}





$page_title_text_color = rwmb_meta($prefix.'page_title_text_color','type=color',get_the_ID());








$page_title_bg_color = rwmb_meta($prefix.'page_title_bg_color','type=color',get_the_ID());








$page_title_bg_images = rwmb_meta($prefix.'page_title_bg_image','type=image&size=full',get_the_ID());


if (!$page_title_bg_images) {


	$page_title_bg_image = $g5plus_options['page_title_bg_image'];





    if (is_singular('product')) {


        $page_title_bg_image = $g5plus_options['single_product_title_bg_image'];


    }





    else if (is_singular('portfolio')) {


        $page_title_bg_image = $g5plus_options['portfolio_title_bg_image'];


    }








    else if (is_singular('post')) {


        $page_title_bg_image = $g5plus_options['single_blog_title_bg_image'];


    }








} else {


    $page_title_bg_image_id = g5plus_get_post_meta(get_the_ID(),$prefix.'page_title_bg_image',true);


	$page_title_bg_image = $page_title_bg_images[$page_title_bg_image_id];


}





if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {


	$page_title_bg_image_url = $page_title_bg_image['url'];


}





$page_title_overlay_color = rwmb_meta($prefix.'page_title_overlay_color','type=color',get_the_ID());


$page_title_overlay_opacity = '';


$enable_custom_overlay_opacity = rwmb_meta($prefix.'enable_custom_overlay_opacity','type=checkbox',get_the_ID());


if ($enable_custom_overlay_opacity == 1) {


    $page_title_overlay_opacity = rwmb_meta($prefix.'page_title_overlay_opacity','type=slider',get_the_ID()) / 100;


}





$page_title_height = rwmb_meta($prefix.'page_title_height','type=number',get_the_ID());


if ($page_title_height === '') {


	$page_title_height = $g5plus_options['page_title_height']['height'];








    if (is_singular('product')) {


        $page_title_height = $g5plus_options['single_product_title_height']['height'];


    }





    else if (is_singular('portfolio')) {


        $page_title_height = $g5plus_options['portfolio_title_height']['height'];


    }








    else if (is_singular('post')) {


        $page_title_height = $g5plus_options['single_blog_title_height']['height'];


    }





}





$breadcrumbs_in_page_title = rwmb_meta($prefix.'breadcrumbs_in_page_title');


if (($breadcrumbs_in_page_title == -1) || ($breadcrumbs_in_page_title === '')  ) {


	$breadcrumbs_in_page_title = $g5plus_options['breadcrumbs_in_page_title'];





    if (is_singular('product')) {


        $breadcrumbs_in_page_title = $g5plus_options['breadcrumbs_in_single_product_title'];





    }





    else if (is_singular('portfolio')) {


        $breadcrumbs_in_page_title = $g5plus_options['breadcrumbs_in_portfolio_title'];


    }





    else if (is_singular('post')) {


        $breadcrumbs_in_page_title = $g5plus_options['breadcrumbs_in_single_blog_title'];


    }


}





$class = array();


$class[] = 'page-title-wrap';





$custom_styles = array();





if ($page_title_bg_image_url != '') {


	$class[] = 'page-title-wrap-bg';


    $custom_styles[] = 'background-image: url(' . $page_title_bg_image_url . ');';


}





if ($page_title_bg_color != '') {


    $custom_styles[] = 'background-color:' . $page_title_bg_color;


}





$custom_text_color_styles = array();


if($page_title_text_color != '') {


    $custom_text_color_styles[] = 'color:' . $page_title_text_color;


}








if (($page_title_height != '') && ($page_title_height > 0)) {


    $custom_styles[] = 'height:' . $page_title_height . 'px';


}





$page_title_remove_margin_bottom = rwmb_meta($prefix.'page_title_remove_margin_bottom','type=checkbox',get_the_ID());


if ($page_title_remove_margin_bottom) {


    $class[] = 'page-title-no-margin-bottom';


}








$class_name = join(' ', $class);





$custom_style= '';


if ($custom_styles) {


    $custom_style = 'style="'. join(';',$custom_styles).'"';


}





/*if (!empty($page_title_bg_image_url)) {


    $custom_style.= ' data-stellar-background-ratio="0.5"';


}*/





$custom_overlay_styles = array();


if ($page_title_overlay_color != '') {


    $custom_overlay_styles[] = 'background-color:' . $page_title_overlay_color;


}





if ($page_title_overlay_opacity != '') {


    $custom_overlay_styles[] = 'opacity:' . $page_title_overlay_opacity;


}


$custom_overlay_style= '';


if ($custom_overlay_styles) {


    $custom_overlay_style = 'style="'. join(';',$custom_overlay_styles).'"';


}





$custom_text_color_style = '';


if ($custom_text_color_styles) {


    $custom_text_color_style = 'style="'. join(';',$custom_text_color_styles).'"';


}





?>


<section  class="<?php echo esc_attr($class_name) ?>" <?php echo wp_kses_post($custom_style); ?>>


    <div class="page-title-overlay" <?php echo wp_kses_post($custom_overlay_style);?>></div>


    <div class="container">


        <div class="page-title-inner block-center">


            <div class="block-center-inner">


                <h1 <?php echo wp_kses_post($custom_text_color_style); ?>><?php echo esc_html($page_title); ?></h1>


                <?php if($breadcrumbs_in_page_title == 1) {


                    g5plus_the_breadcrumb();


                } ?>


            </div>


        </div>


    </div>


</section>