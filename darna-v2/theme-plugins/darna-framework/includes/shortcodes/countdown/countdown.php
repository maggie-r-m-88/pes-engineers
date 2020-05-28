<?php


if ( ! defined( 'ABSPATH' ) ) die( '-1' );


if(!class_exists('Darna_Countdown')){


    class Darna_Countdown {


        function __construct() {


            add_action( 'init', array($this, 'register_post_types' ), 6 );


            add_shortcode('darna_countdown_shortcode', array($this, 'darna_countdown_shortcode' ));


            add_filter( 'rwmb_meta_boxes', array($this,'darna_register_meta_boxes' ));


        }





        function register_post_types() {


            if ( post_type_exists('countdown') ) {


                return;


            }


            register_post_type('countdown',


                array(


                    'label' => __('Countdown','g5plus-framework'),


                    'description' => __( 'Countdown Description', 'g5plus-framework' ),


                    'labels' => array(


                        'name'					=>'Countdown',


                        'singular_name' 		=> 'Countdown',


                        'menu_name'    			=> __( 'Countdown', 'g5plus-framework' ),


                        'parent_item_colon'  	=> __( 'Parent Item:', 'g5plus-framework' ),


                        'all_items'          	=> __( 'All Countdown', 'g5plus-framework' ),


                        'view_item'          	=> __( 'View Item', 'g5plus-framework' ),


                        'add_new_item'       	=> __( 'Add New Countdown', 'g5plus-framework' ),


                        'add_new'            	=> __( 'Add New', 'g5plus-framework' ),


                        'edit_item'          	=> __( 'Edit Item', 'g5plus-framework' ),


                        'update_item'        	=> __( 'Update Item', 'g5plus-framework' ),


                        'search_items'       	=> __( 'Search Item', 'g5plus-framework' ),


                        'not_found'          	=> __( 'Not found', 'g5plus-framework' ),


                        'not_found_in_trash' 	=> __( 'Not found in Trash', 'g5plus-framework' ),


                    ),


                    'supports'    => array( 'title', 'editor', 'comments', 'thumbnail'),


                    'public'      => true,


                    'has_archive' => true


                )


            );


        }





        function darna_countdown_shortcode($atts){


            $type = $css = '';


            extract( shortcode_atts( array(


                'type'     => '',


                'css'      => ''


            ), $atts ) );





            $plugin_path =  untrailingslashit( plugin_dir_path( __FILE__ ) );


            $template_path = $plugin_path . '/templates/'.$type.'.php';


            ob_start();


            include($template_path);


            $ret = ob_get_contents();


            ob_end_clean();


            return $ret;


        }





        function darna_register_meta_boxes($meta_boxes){


            $meta_boxes[] = array(


                'title'  => __( 'Countdown Option', 'g5plus-framework' ),


                'id'     => 'darna-meta-box-countdown-opening',


                'pages'  => array( 'countdown' ),


                'fields' => array(


                    array(


                        'name' => __( 'Opening hours', 'g5plus-framework' ),


                        'id'   => 'countdown-opening',


                        'type' => 'datetime',


                    ),


                     array(


                         'name' => __( 'Type', 'g5plus-framework' ),


                         'id'   => 'countdown-type',


                         'type' => 'select',


                         'options'  => array(


                             'comming-soon' => __('Coming Soon','g5plus-framework'),


                             'under-construction' => __('Under Construction','g5plus-framework')


                         )


                     ),


                    array(


                        'name' => __( 'Url redirect (after countdown completed)', 'g5plus-framework' ),


                        'id'   => 'countdown-url',


                        'type' => 'textarea',


                    ),


                    array(


                        'name' => __('Footer text', 'g5plus-framework'),


                        'id' => 'footer_text',


                        'type' => 'textarea',


                    )


                )


            );


            return $meta_boxes;


        }


    }


    new Darna_Countdown();


}