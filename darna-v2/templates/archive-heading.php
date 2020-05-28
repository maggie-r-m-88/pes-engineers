<?php


/**


 * Created by PhpStorm.


 * User: Administrator


 * Date: 6/3/2015


 * Time: 9:16 AM


 */


global $g5plus_options;


$prefix = 'g5plus_';


$show_page_title = $g5plus_options['show_archive_title'];


if ($show_page_title == 0) {


    return;


}





$on_front = get_option('show_on_front');


$page_title = '';


if (!have_posts()) {


    $page_title = __("Nothing Found", 'g5plus-framework');


} elseif (is_home()) {


    if (($on_front == 'page' && get_queried_object_id() == get_post(get_option('page_for_posts'))->ID) || ($on_front == 'posts')) {


        $page_title = __("Blog", 'g5plus-framework');


    } else {


        $page_title = '';


    }


} elseif (is_category()) {


    $page_title = single_cat_title('', false);


} elseif (is_tag()) {


    $page_title = single_tag_title(__("Tags: ", 'g5plus-framework'), false);


} elseif (is_author()) {


    $page_title = sprintf(__('Author: %s', 'g5plus-framework'), get_the_author());


} elseif (is_day()) {


    $page_title = sprintf(__('Daily Archives: %s', 'g5plus-framework'), get_the_date());


} elseif (is_month()) {


    $page_title = sprintf(__('Monthly Archives: %s', 'g5plus-framework'), get_the_date(_x('F Y', 'monthly archives date format', 'g5plus-framework')));


} elseif (is_year()) {


    $page_title = sprintf(__('Yearly Archives: %s', 'g5plus-framework'), get_the_date(_x('Y', 'yearly archives date format', 'g5plus-framework')));


} elseif (is_search()) {


    $page_title = sprintf(__('Search Results for: %s', 'g5plus-framework'), get_search_query());


} elseif (is_tax('post_format', 'post-format-aside')) {


    $page_title = __('Asides', 'g5plus-framework');


} elseif (is_tax('post_format', 'post-format-gallery')) {


    $page_title = __('Galleries', 'g5plus-framework');


} elseif (is_tax('post_format', 'post-format-image')) {


    $page_title = __('Images', 'g5plus-framework');


} elseif (is_tax('post_format', 'post-format-video')) {


    $page_title = __('Videos', 'g5plus-framework');


} elseif (is_tax('post_format', 'post-format-quote')) {


    $page_title = __('Quotes', 'g5plus-framework');


} elseif (is_tax('post_format', 'post-format-link')) {


    $page_title = __('Links', 'g5plus-framework');


} elseif (is_tax('post_format', 'post-format-status')) {


    $page_title = __('Statuses', 'g5plus-framework');


} elseif (is_tax('post_format', 'post-format-audio')) {


    $page_title = __('Audios', 'g5plus-framework');


} elseif (is_tax('post_format', 'post-format-chat')) {


    $page_title = __("Chats", 'g5plus-framework');


} else {


    $page_title = __("Archives", 'g5plus-framework');


}








//archive


$page_title_bg_image = '';


$page_title_height = '';


$cat = get_queried_object();


if ($cat && property_exists( $cat, 'term_id' )) {


    $page_title_bg_image = get_tax_meta($cat,$prefix.'page_title_background');


    $page_title_height = get_tax_meta($cat,$prefix.'page_title_height');


}








if(!$page_title_bg_image || ($page_title_bg_image === '')) {


    $page_title_bg_image = $g5plus_options['archive_title_bg_image'];


}








if (isset($page_title_bg_image) && isset($page_title_bg_image['url'])) {


    $page_title_bg_image_url = $page_title_bg_image['url'];


}


if (($page_title_height === '')  || $page_title_height <= 0) {


    $page_title_height = $g5plus_options['archive_title_height']['height'];


}








$breadcrumbs_in_page_title = $g5plus_options['breadcrumbs_in_archive_title'];





$class = array();


$class[] = 'page-title-wrap';





$custom_styles = array();





if ($page_title_bg_image_url != '') {


    $class[] = 'page-title-wrap-bg';


    $custom_styles[] = 'background-image: url(' . $page_title_bg_image_url . ');';


}





if ( ($page_title_height != '') && ($page_title_height > 0)) {


    $custom_styles[] = 'height:' . $page_title_height . 'px';


}





$class_name = join(' ', $class);





$custom_style= '';


if ($custom_styles) {


    $custom_style = 'style="'. join(';',$custom_styles).'"';


}





/*if (!empty($page_title_bg_image_url)) {


    $custom_style.= ' data-stellar-background-ratio="0.5"';


}*/





?>





<section class="<?php echo esc_attr($class_name) ?>" <?php echo wp_kses_post($custom_style); ?>>


    <div class="page-title-overlay"></div>


    <div class="container">


        <div class="page-title-inner block-center">


            <div class="block-center-inner">


                <h1><?php echo esc_html($page_title); ?></h1>


                <?php if($breadcrumbs_in_page_title == 1) {


                    g5plus_the_breadcrumb();


                } ?>


            </div>


        </div>


    </div>


</section>