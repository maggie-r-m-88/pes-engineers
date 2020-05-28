<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/6/2015
 * Time: 9:36 AM
 */

/*================================================
FILTER SEARCH FORM
================================================== */
if (!function_exists('g5plus_search_form')) {
    function g5plus_search_form($form)
    {
        $form = '<form role="search" class="search-form" method="get" id="searchform" action="' . home_url('/') . '">
                <input type="text" value="' . get_search_query() . '" name="s" id="s"  placeholder="' . __("Search Here...", 'g5plus-framework') . '">
                <button type="submit"><i class="fa fa-search"></i></button>
     		</form>';
        return $form;
    }
    add_filter('get_search_form', 'g5plus_search_form');
}

/*================================================
FILTER TAG FORMAT
================================================== */
if (!function_exists('g5plus_tag_cloud')) {
    function g5plus_tag_cloud($tag_string) {
        return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
    }
    add_filter('wp_generate_tag_cloud', 'g5plus_tag_cloud', 10, 3);
}

/* CUSTOM PAGE TEMPLATE
    ================================================== */
if (!function_exists('g5plus_page_template_custom')) {
	function g5plus_page_template_custom($template ){
		if (isset($_REQUEST['custom-page']) && !empty($_REQUEST['custom-page'])) {
			do_action('custom-page/'.$_REQUEST['custom-page']);
			return;
		}
		return $template;

	}
	add_filter( "page_template", "g5plus_page_template_custom" );
}