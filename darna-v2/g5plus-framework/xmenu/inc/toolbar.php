<?php


add_action( 'admin_bar_menu', 'xmenu_add_toolbar_items', 100 );


function xmenu_get_toolbar_icon($icon_name) {


	return '<i class="fa fa-'. esc_attr($icon_name) . '"></i>';


}


function xmenu_add_toolbar_items($admin_bar) {


	if( !current_user_can( 'manage_options' ) ) return;





	$admin_bar->add_node( array(


		'id'    => 'xmenutoolbar',


		'title' => '<span class="ab-icon"></span><span>' . __('XMEMU','g5plus-framework') . '</span>',


		'href'  => admin_url( 'themes.php?page=xmenu-settings' ),


		'meta'  => array(


			'title' => __( 'XMenu' , 'g5plus-framework' ),


		),


	));





	$admin_bar->add_node( array(


		'id'    => 'xmenu_settings',


		'parent' => 'xmenutoolbar',


		'title' => __( 'XMENU Settings' , 'g5plus-framework' ),


		'href'  => admin_url( 'themes.php?page=xmenu-settings' )


	));





	$admin_bar->add_node( array(


		'id'    => 'xmenu_menu_edit',


		'parent' => 'xmenutoolbar',


		'title' => __( 'Edit Menus' , 'g5plus-framework' ),


		'href'  => admin_url( 'nav-menus.php' )


	));


	$menus = wp_get_nav_menus( array('orderby' => 'name') );


	foreach( $menus as $menu ){


		$admin_bar->add_node( array(


			'id'    	=> 'xmenu_menu_edit_'.$menu->slug,


			'parent' 	=> 'xmenu_menu_edit',


			'title' 	=> $menu->name,


			'href'  	=> admin_url( 'nav-menus.php?action=edit&menu='.$menu->term_id ),


			'meta'  	=> array(


				'title' => __('Configure' , 'g5plus-framework' ) . ' '. $menu->name,


				'target' => '_blank',


				'class' => ''


			),


		));


	}





	$admin_bar->add_node( array(


		'id'    => 'xmenu_menu_assign',


		'parent' => 'xmenutoolbar',


		'title' => __( 'Assign Menus' , 'g5plus-framework' ),


		'href'  => admin_url( 'nav-menus.php?action=locations' )


	));


}