<?php
/*
Require  all lib files , functions
*/
 require_once(plugin_dir_path( __FILE__ ).'/lib/cpt.php' );
 require_once(plugin_dir_path( __FILE__ ).'/public/teamview.php' );
 // Add the metabox class (CMB2)
 if ( file_exists( dirname( __FILE__ ) . '/lib/metaboxes/init.php' ) ) {
     require_once dirname( __FILE__ ) . '/lib/metaboxes/init.php';
 } elseif ( file_exists( dirname( __FILE__ ) . '/lib/metaboxes/init.php' ) ) {
     require_once dirname( __FILE__ ) . '/lib/metaboxes/init.php';
 }
 // Create the metabox class (CMB2)
 require_once('lib/functions/metaboxes.php');
 // Enqueue admin styles
 require_once('lib/functions/customcolumn.php');

add_action('admin_menu', 'tc_teammember_menu_init');
  function tc_teammember_menu_help(){
    include('lib/tc-teammember-help-docs.php');
  }

  function tc_teammember_menu_init()
    {
      add_submenu_page('edit.php?post_type=tcmembers', __('Help & Docs','tc-tcmembers'), __('Help & Docs','tc-tcmembers'), 'manage_options', 'tc_teammember_menu_help', 'tc_teammember_menu_help');
    }

    function tc_team_enqueue_scripts() {
    		//Plugin Main CSS File.
     wp_enqueue_style('tc-team-members', plugins_url('assets/css/tc-team.css', __FILE__ ) );
     wp_enqueue_style('tc-font-awesome', plugins_url('vendors/font-awesome/css/font-awesome.css', __FILE__ ) );
     // POP upplugin
      wp_enqueue_style('popup', plugins_url('vendors/popup/magnific-popup.css', __FILE__ ));
      wp_enqueue_script('popup-js', plugins_url('vendors/popup/jquery.magnific-popup.js', __FILE__ ), array('jquery'), 1.0, true);
      wp_enqueue_script('main-js', plugins_url('assets/js/main.js', __FILE__ ));
     }
    //This hook ensures our scripts and styles are only loaded in the admin.
    add_action( 'wp_enqueue_scripts', 'tc_team_enqueue_scripts' );

    if ( function_exists( 'add_theme_support' ) ) {
        add_theme_support( 'post-thumbnails' );
    }

    add_action( 'admin_enqueue_scripts', 'tc_team_admin_style' );

    function tc_team_admin_style() {

     wp_enqueue_style( 'tc_team_admin_style', plugins_url('assets/css/tc-team-admin.css',__FILE__ ));

    }

 ?>
