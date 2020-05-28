<?php
/*
*
*	Meta Box Functions
*	------------------------------------------------
*	G5Plus Framework
* 	Copyright Swift Ideas 2015 - http://www.g5plus.net
*
*/
global $meta_boxes;

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function g5plus_register_meta_boxes()
{
	global $meta_boxes;
	$prefix = 'g5plus_';
	/* PAGE MENU */
	$menu_list = array();
	if ( function_exists( 'g5plus_get_menu_list' ) ) {
		$menu_list = g5plus_get_menu_list();
	}

// POST FORMAT: Image
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => __('Post Format: Image', 'g5plus-framework'),
		'id' => $prefix .'meta_box_post_format_image',
		'pages' => array('post'),
		'format' => 'post-format',
		'fields' => array(
			array(
				'name' => __('Image', 'g5plus-framework'),
				'id' => $prefix . 'post_format_image',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'desc' => __('Select a image for post','g5plus-framework')
			),
		),
	);

// POST FORMAT: Gallery
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => __('Post Format: Gallery', 'g5plus-framework'),
		'format' => 'post-format',
		'id' => $prefix . 'meta_box_post_format_gallery',
		'pages' => array('post'),
		'fields' => array(
			array(
				'name' => __('Images', 'g5plus-framework'),
				'id' => $prefix . 'post_format_gallery',
				'type' => 'image_advanced',
				'desc' => __('Select images gallery for post','g5plus-framework')
			),
		),
	);

// POST FORMAT: Video
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => __('Post Format: Video', 'g5plus-framework'),
		'format' => 'post-format',
		'id' => $prefix . 'meta_box_post_format_video',
		'pages' => array('post'),
		'fields' => array(
			array(
				'name' => __( 'Video URL or Embeded Code', 'g5plus-framework' ),
				'id'   => $prefix . 'post_format_video',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: Audio
//--------------------------------------------------
	$meta_boxes[] = array(
		'title' => __('Post Format: Audio', 'g5plus-framework'),
		'format' => 'post-format',
		'id' => $prefix . 'meta_box_post_format_audio',
		'pages' => array('post'),
		'fields' => array(
			array(
				'name' => __( 'Audio URL or Embeded Code', 'g5plus-framework' ),
				'id'   => $prefix . 'post_format_audio',
				'type' => 'textarea',
			),
		),
	);

// POST FORMAT: QUOTE
//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => __('Post Format: Quote', 'g5plus-framework'),
        'format' => 'post-format',
        'id' => $prefix . 'meta_box_post_format_quote',
        'pages' => array('post'),
        'fields' => array(
            array(
                'name' => __( 'Quote', 'g5plus-framework' ),
                'id'   => $prefix . 'post_format_quote',
                'type' => 'textarea',
            ),
            array(
                'name' => __( 'Author', 'g5plus-framework' ),
                'id'   => $prefix . 'post_format_quote_author',
                'type' => 'text',
            ),
            array(
                'name' => __( 'Author Url', 'g5plus-framework' ),
                'id'   => $prefix . 'post_format_quote_author_url',
                'type' => 'url',
            ),
        ),
    );
    // POST FORMAT: LINK
//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => __('Post Format: Link', 'g5plus-framework'),
        'format' => 'post-format',
        'id' => $prefix . 'meta_box_post_format_link',
        'pages' => array('post'),
        'fields' => array(
            array(
                'name' => __( 'Url', 'g5plus-framework' ),
                'id'   => $prefix . 'post_format_link_url',
                'type' => 'url',
            ),
            array(
                'name' => __( 'Text', 'g5plus-framework' ),
                'id'   => $prefix . 'post_format_link_text',
                'type' => 'text',
            ),
        ),
    );
//GALLERY
    $meta_boxes[] = array(
        'id' => $prefix . 'serives_gallery_meta_box',
        'title' => __('Gallery', 'g5plus-framework'),
        'pages' => array('services'),
        'fields' => array(
            array(
                'name' => __('Images', 'g5plus-framework'),
                'id' => $prefix . 'services_gallery',
                'type' => 'image_advanced',
                'desc' => __('Select images gallery for post','g5plus-framework')
            ),
        )
    );
// PAGE TITLE
//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_title_meta_box',
		'title' => __('Page Title', 'g5plus-framework'),
		'pages' => array('post', 'page', 'portfolio', 'services'),
		'fields' => array(
			array(
				'name'  => __( 'Show/Hide Page Title?', 'g5plus-framework' ),
				'id'    => $prefix . 'show_page_title',
				'type'  => 'button_set',
				'std'	=> '-1',
				'options' => array(
					'-1'	=> __('Default','g5plus-framework'),
					'1'	=> __('Show Page Title','g5plus-framework'),
					'0'	=> __('Hide Page Title','g5plus-framework'),
				)

			),

			// PAGE TITLE LINE 1
			array(
				'name' => __('Custom Page Title', 'g5plus-framework'),
				'id' => $prefix . 'page_title_custom',
				'desc' => __("Enter a custom page title if you'd like.", 'g5plus-framework'),
				'type'  => 'text',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE TEXT COLOR
			array(
				'name' => __('Page Title Text Color', 'g5plus-framework'),
				'id' => $prefix . 'page_title_text_color',
				'desc' => __("Optionally set a text color for the page title.", 'g5plus-framework'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE BACKGROUND COLOR
			array(
				'name' => __('Page Title Background Color', 'g5plus-framework'),
				'id' => $prefix . 'page_title_bg_color',
				'desc' => __("Optionally set a background color for the page title.", 'g5plus-framework'),
				'type'  => 'color',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// BACKGROUND IMAGE
			array(
				'id'    => $prefix.  'page_title_bg_image',
				'name'  => __('Background Image', 'g5plus-framework'),
				'desc'  => __('Background Image for page title.', 'g5plus-framework'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			// PAGE TITLE OVERLAY COLOR
			array(
				'id'   => $prefix. 'page_title_overlay_color',
				'name' => __( 'Page Title Overlay Color', 'g5plus-framework' ),
				'desc' => __( "Set an overlay color for page title image.", 'g5plus-framework' ),
				'type' => 'color',
				'std'  => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),

			array(
				'name'  => __( 'Custom Overlay Opacity?', 'g5plus-framework' ),
				'id'    => $prefix . 'enable_custom_overlay_opacity',
				'type'  => 'checkbox',
				'std'	=> 0,
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),


			// Overlay Opacity Value
			array(
				'name'       => __( 'Overlay Opacity', 'g5plus-framework' ),
				'id'         => $prefix .'page_title_overlay_opacity',
				'desc'       => __( 'Set the opacity level of the overlay. This will lighten or darken the image depening on the color selected.', 'g5plus-framework' ),
				'clone'      => false,
				'type'       => 'slider',
				'prefix'     => '',
				'js_options' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'required-field' => array($prefix . 'enable_custom_overlay_opacity','=','1'),
			),

			// PAGE TITLE Height
			array(
				'name' => __('Page Title Height', 'g5plus-framework'),
				'id' => $prefix . 'page_title_height',
				'desc' => __("Enter a page title height value (not include unit).", 'g5plus-framework'),
				'type'  => 'number',
				'std' => '',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),
			// Breadcrumbs in Page Title
			array(
				'name' => __('Breadcrumbs in Page Title', 'g5plus-framework'),
				'id' => $prefix . 'breadcrumbs_in_page_title',
				'desc' => __("Show/Hide Breadcrumbs in Page Title", 'g5plus-framework'),
				'type'  => 'button_set',
				'options'	=> array(
					'-1' => __('Default','g5plus-framework'),
					'1' => __('Show Breadcrumbs','g5plus-framework'),
					'0' => __('Hide Breadcrumbs','g5plus-framework'),
				),
				'std' => '-1',
                'required-field' => array($prefix . 'show_page_title','<>','0'),
			),
            array(
                'name'  => __( 'Remove Margin Bottom', 'g5plus-framework' ),
                'id'    => $prefix . 'page_title_remove_margin_bottom',
                'type'  => 'checkbox',
                'std'	=> 0,
                'required-field' => array($prefix . 'show_page_title','<>','0')
            ),
		)
	);

// PAGE HEADER
//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_header_meta_box',
		'title' => __('Page Header', 'g5plus-framework'),
		'pages' => array('post', 'page', 'portfolio', 'services'),
		'fields' => array(
			array(
				'name'  => __( 'Page Menu', 'g5plus-framework' ),
				'id'    => $prefix . 'page_menu',
				'type'  => 'select_advanced',
				'options' => $menu_list,
				'placeholder' => __('Select Menu','g5plus-framework'),
				'std'	=> '',
				'multiple' => false,
				'desc' => __('Optionally you can choose to override the menu that is used on the page', 'g5plus-framework'),
			),

			array(
				'name'  => __( 'Is One Page', 'g5plus-framework' ),
				'id'    => $prefix . 'is_one_page',
				'type'  => 'checkbox',
				'std'	=> 0,
				'desc' => __('Set page style is One Page', 'g5plus-framework'),
			),

			array (
				'name' 	=> __('Above Header Sidebar', 'g5plus-framework'),
				'id' 	=> $prefix . 'above_header_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','g5plus-framework'),
				'std' 	=> ''
			),

			array (
				'name' 	=> __('Show/Hide Top Bar', 'g5plus-framework'),
				'id' 	=> $prefix . 'top_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','g5plus-framework'),
					'1' => __('Show Top Bar','g5plus-framework'),
					'0' => __('Hide Top Bar','g5plus-framework')
				),
				'desc' => __('Show Hide Top Bar.', 'g5plus-framework'),
			),

			array (
				'name' 	=> __('Top Bar Layout', 'g5plus-framework'),
				'id' 	=> $prefix . 'top_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'top-bar-1' => THEME_URL.'/assets/images/theme-options/top-bar-layout-1.jpg',
					'top-bar-2' => THEME_URL.'/assets/images/theme-options/top-bar-layout-2.jpg',
					'top-bar-3' => THEME_URL.'/assets/images/theme-options/top-bar-layout-3.jpg',
					'top-bar-4' => THEME_URL.'/assets/images/theme-options/top-bar-layout-4.jpg',
				),
				'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> __('Top Left Sidebar', 'g5plus-framework'),
				'id' 	=> $prefix . 'top_left_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => __('Select Sidebar','g5plus-framework'),
                'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> __('Top Right Sidebar', 'g5plus-framework'),
				'id' 	=> $prefix . 'top_right_sidebar',
				'type' 	=> 'sidebars',
				'std' 	=> '',
				'placeholder' => __('Select Sidebar','g5plus-framework'),
                'required-field' => array($prefix . 'top_bar','<>','0'),
			),

			array (
				'name' 	=> __('Show/Hide Header', 'g5plus-framework'),
				'id' 	=> $prefix . 'header_show_hide',
				'type' 	=> 'button_set',
				'std' 	=> '1',
				'options' => array(
					'1' => __('Show Header','g5plus-framework'),
					'0' => __('Hide Header','g5plus-framework')
				),
				'desc' => __('Show/hide header', 'g5plus-framework'),
			),

			array (
				'name' 	=> __('Header Layout', 'g5plus-framework'),
				'id' 	=> $prefix . 'header_layout',
				'type'  => 'image_set',
				'allowClear' => true,
				'std'	=> '',
				'options' => array(
					'header-1'	    => THEME_URL.'/assets/images/theme-options/header-1.jpg',
					'header-2'	    => THEME_URL.'/assets/images/theme-options/header-2.jpg',
					'header-3'	    => THEME_URL.'/assets/images/theme-options/header-3.jpg',
				),
			),

			array(
				'name'  => __( 'Set header customize?', 'g5plus-framework' ),
				'id'    => $prefix . 'enable_header_customize',
				'type'  => 'checkbox',
				'std'	=> 0,
			),

			array (
				'name' 	=> __('Header Customize', 'g5plus-framework'),
				'id' 	=> $prefix . 'header_customize',
				'type' 	=> 'sorter',
				'std' 	=> '',
				'desc'  => __('Select element for header customize. Drag to change element order', 'g5plus-framework'),
				'options' => array(
					'get-a-quote' => 'Get a quote',
					'shopping-cart'   => 'Shopping Cart',
					'search' => 'Search Box',
					'custom-text' => 'Custom Text',
				),
				'required-field' => array($prefix . 'enable_header_customize','=','1'),
			),

			array(
				'name'  => __( 'Custom text content?', 'g5plus-framework' ),
				'id'    => $prefix . 'header_customize_text',
				'type'  => 'textarea',
				'std'	=> '',
				'required-field' => array($prefix . 'enable_header_customize','=','1'),
			),

			array (
				'name' 	=> __('Header Sticky', 'g5plus-framework'),
				'id' 	=> $prefix . 'header_sticky',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','g5plus-framework'),
					'1' => __('Enable Header Sticky','g5plus-framework'),
					'0' => __('Disable Header Sticky','g5plus-framework'),
				),
			),

			array (
				'name' 	=> __('Mobile Header Search Box', 'g5plus-framework'),
				'id' 	=> $prefix . 'mobile_header_search_box',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','g5plus-framework'),
					'1' => __('Show','g5plus-framework'),
					'0' => __('Hide','g5plus-framework')
				),
			),

			array (
				'name' 	=> __('Mobile Header Shopping Cart', 'g5plus-framework'),
				'id' 	=> $prefix . 'mobile_header_shopping_cart',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => __('Default','g5plus-framework'),
					'1' => __('Show','g5plus-framework'),
					'0' => __('Hide','g5plus-framework')
				),
			),

			array(
				'id'    => $prefix.  'custom_logo',
				'name'  => __('Custom Logo', 'g5plus-framework'),
				'desc'  => __('Upload custom logo in header.', 'g5plus-framework'),
				'type'  => 'image_advanced',
				'max_file_uploads' => 1,
			),

		)
	);


// PAGE FOOTER
//--------------------------------------------------
	$meta_boxes[] = array(
		'id' => $prefix . 'page_footer_meta_box',
		'title' => __('Page Footer', 'g5plus-framework'),
		'pages' => array('post', 'page', 'portfolio', 'services'),
		'fields' => array(
			array (
				'name' 	=> __('Show/Hide Footer', 'g5plus-framework'),
				'id' 	=> $prefix . 'footer_show_hide',
				'type' 	=> 'button_set',
				'std' 	=> '1',
				'options' => array(
					'1' => __('Show Footer','g5plus-framework'),
					'0' => __('Hide Footer','g5plus-framework')
				),
				'desc' => __('Show/hide footer', 'g5plus-framework'),
			),

			array (
				'name' 	=> __('Footer Layout', 'g5plus-framework'),
				'id' 	=> $prefix . 'footer_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'footer-1' => THEME_URL.'/assets/images/theme-options/footer-layout-1.jpg',
					'footer-2' => THEME_URL.'/assets/images/theme-options/footer-layout-2.jpg',
					'footer-3' => THEME_URL.'/assets/images/theme-options/footer-layout-3.jpg',
					'footer-4' => THEME_URL.'/assets/images/theme-options/footer-layout-4.jpg',
					'footer-5' => THEME_URL.'/assets/images/theme-options/footer-layout-5.jpg',
					'footer-6' => THEME_URL.'/assets/images/theme-options/footer-layout-6.jpg',
					'footer-7' => THEME_URL.'/assets/images/theme-options/footer-layout-7.jpg',
					'footer-8' => THEME_URL.'/assets/images/theme-options/footer-layout-8.jpg',
					'footer-9' => THEME_URL.'/assets/images/theme-options/footer-layout-9.jpg',
				),
				'desc' => __('Select Footer Layout (Not set to default).', 'g5plus-framework'),
			),

			array (
				'name' 	=> __('Show/Hide Bottom Bar', 'g5plus-framework'),
				'id' 	=> $prefix . 'bottom_bar',
				'type' 	=> 'button_set',
				'std' 	=> '-1',
				'options' => array(
					'-1' => 'Default',
					'1' => 'Show Bottom Bar',
					'0' => 'Hide Bottom Bar'
				),
				'desc' => __('Show Hide Bottom Bar.', 'g5plus-framework'),
			),

			array (
				'name' 	=> __('Bottom Bar Layout', 'g5plus-framework'),
				'id' 	=> $prefix . 'bottom_bar_layout',
				'type' 	=> 'image_set',
				'allowClear' => true,
				'width' => '80px',
				'std' 	=> '',
				'options' => array(
					'bottom-bar-1' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-1.jpg',
					'bottom-bar-2' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-2.jpg',
					'bottom-bar-3' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-3.jpg',
					'bottom-bar-4' => THEME_URL.'/assets/images/theme-options/bottom-bar-layout-4.jpg',
				),
				'desc' => __('Bottom bar layout.', 'g5plus-framework'),
				'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> __('Bottom Bar Left Sidebar', 'g5plus-framework'),
				'id' 	=> $prefix . 'bottom_bar_left_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','g5plus-framework'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

			array (
				'name' 	=> __('Bottom Bar Right Sidebar', 'g5plus-framework'),
				'id' 	=> $prefix . 'bottom_bar_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','g5plus-framework'),
				'std' 	=> '',
                'required-field' => array($prefix . 'bottom_bar','<>','0'),
			),

		)
	);

// PAGE LAYOUT
	$meta_boxes[] = array(
		'id' => $prefix . 'page_layout_meta_box',
		'title' => __('Page Layout', 'g5plus-framework'),
		'pages' => array('post', 'page',  'services'),
		'fields' => array(
			array(
				'name'  => __( 'Layout Style', 'g5plus-framework' ),
				'id'    => $prefix . 'layout_style',
				'type'  => 'button_set',
				'options' => array(
					'-1' => __('Default','g5plus-framework'),
					'boxed'	  => __('Boxed','g5plus-framework'),
					'wide'	  => __('Wide','g5plus-framework')
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => __( 'Page Layout', 'g5plus-framework' ),
				'id'    => $prefix . 'page_layout',
				'type'  => 'button_set',
				'options' => array(
					'-1' => __('Default','g5plus-framework'),
					'full'	  => __('Full Width','g5plus-framework'),
					'container'	  => __('Container','g5plus-framework'),
					'container-fluid'	  => __('Container Fluid','g5plus-framework'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),
			array(
				'name'  => __( 'Page Sidebar', 'g5plus-framework' ),
				'id'    => $prefix . 'page_sidebar',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'none'	  => THEME_URL.'/assets/images/theme-options/sidebar-none.png',
					'left'	  => THEME_URL.'/assets/images/theme-options/sidebar-left.png',
					'right'	  => THEME_URL.'/assets/images/theme-options/sidebar-right.png',
					'both'	  => THEME_URL.'/assets/images/theme-options/sidebar-both.png'
				),
				'std'	=> '',
				'multiple' => false,

			),
			array (
				'name' 	=> __('Left Sidebar', 'g5plus-framework'),
				'id' 	=> $prefix . 'page_left_sidebar',
				'placeholder' => __('Select Sidebar','g5plus-framework'),
				'type' 	=> 'sidebars',
				'std' 	=> '',
                'required-field' => array($prefix . 'page_sidebar','=',array('','left','both')),
			),

			array (
				'name' 	=> __('Right Sidebar', 'g5plus-framework'),
				'id' 	=> $prefix . 'page_right_sidebar',
				'type' 	=> 'sidebars',
				'placeholder' => __('Select Sidebar','g5plus-framework'),
				'std' 	=> '',
                'required-field' => array($prefix . 'page_sidebar','=',array('','right','both')),
			),

			array(
				'name'  => __( 'Sidebar Width', 'g5plus-framework' ),
				'id'    => $prefix . 'sidebar_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'		=> __('Default','g5plus-framework'),
					'small'		=> __('Small (1/4)','g5plus-framework'),
					'larger'	=> __('Large (1/3)','g5plus-framework')
				),
				'std'	=> '-1',
				'multiple' => false,
                'required-field' => array($prefix . 'page_sidebar','<>','none'),
			),

			array (
				'name' 	=> __('Page Class Extra', 'g5plus-framework'),
				'id' 	=> $prefix . 'page_class_extra',
				'type' 	=> 'text',
				'std' 	=> ''
			),
		)
	);

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if (class_exists('RW_Meta_Box')) {
		foreach ($meta_boxes as $meta_box) {
			new RW_Meta_Box($meta_box);
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action('admin_init', 'g5plus_register_meta_boxes');
