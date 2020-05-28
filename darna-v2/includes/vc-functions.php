<?php


add_action( 'vc_before_init', 'g5plus_vcSetAsTheme' );


function g5plus_vcSetAsTheme() {


    vc_set_as_theme();


}





function g5plus_vc_remove_frontend_links() {


    vc_disable_frontend();


}


add_action( 'vc_after_init', 'g5plus_vc_remove_frontend_links' );





function g5plus_number_settings_field($settings, $value) {


    $dependency = vc_generate_dependencies_attributes($settings);


    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';


    $type = isset($settings['type']) ? $settings['type'] : '';


    $min = isset($settings['min']) ? $settings['min'] : '';


    $max = isset($settings['max']) ? $settings['max'] : '';


    $suffix = isset($settings['suffix']) ? $settings['suffix'] : '';


    $class = isset($settings['class']) ? $settings['class'] : '';


    $output = '<input type="number" min="'.esc_attr($min).'" max="'.esc_attr($max).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="'.esc_attr($value).'" style="max-width:100px; margin-right: 10px;" />'.esc_attr($suffix);


    return $output;


}





function g5plus_icon_text_settings_field($settings, $value) {


    $dependency = vc_generate_dependencies_attributes( $settings );


    return '<div class="vc-text-icon">'


    .'<input  name="'.$settings['param_name'] .'" style="width:80%;" class="wpb_vc_param_value wpb-textinput widefat input-icon ' .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" value="' .esc_attr($value).'" ' . $dependency . '/>'


    .'<input title="'.__('Click to browse icon','g5plus-framework').'" style="width:20%; height:34px;" class="browse-icon button-secondary" type="button" value="'. __('Browse Icon','g5plus-framework') .'" >'


    .'<span class="icon-preview"><i class="'. esc_attr($value).'"></i></span>'


    .'</div>';


}





function g5plus_multi_select_settings_field_shortcode_param($settings, $value) {


    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';


    $param_option     =  isset( $settings['options'] ) ? $settings['options'] : '';


    $dependency = vc_generate_dependencies_attributes( $settings );


    $output     = '<input type="hidden" name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . '" value="' . $value . '"  ' . $dependency . ' />';


    $output .= '<select multiple id="' . $param_name . '_select2" name="' . $param_name . '_select2" class="multi-select">';


    if ( $param_option != '' && is_array( $param_option ) ) {


        foreach ( $param_option as $text_val => $val ) {


            if ( is_numeric( $text_val ) && ( is_string( $val ) || is_numeric( $val ) ) ) {


                $text_val = $val;


            }


            $output .= '<option id="' . $val.'" value="' . $val . '">' . htmlspecialchars( $text_val ) . '</option>';


        }


    }





    $output .= '</select><input type="checkbox" id="' . $param_name . '_select_all" >'.__('Select All','g5plus-framework');


    $output.='<script type="text/javascript">


		        jQuery(document).ready(function($){





					$("#'.$param_name.'_select2").select2();





					var order = $("#'.$param_name.'").val()


					if (order != "") {


						order = order.split(",");


						var choices = [];


						for (var i = 0; i < order.length; i++) {


							var option = $("#'.$param_name.'_select2 option[value="+ order[i]  + "]");


							choices[i] = {id:order[i], text:option[0].label, element: option};


						}


						$("#'.$param_name.'_select2").select2("data", choices);





					}





			        $("#'.$param_name.'_select2").on("select2-selecting", function(e) {


			            var ids = $("#'.$param_name.'").val();


			            if (ids != "") {


			                ids +=",";


			            }


			            ids += e.val;


			            $("#'.$param_name.'").val(ids);


                    }).on("select2-removed", function(e) {


				          var ids = $("#'.$param_name.'").val();


				          var arr_ids = ids.split(",");


				          var newIds = "";


				          for(var i = 0 ; i < arr_ids.length; i++) {


				            if (arr_ids[i] != e.val){


				                if (newIds != "") {


			                        newIds +=",";


					            }


					            newIds += arr_ids[i];


				            }


				          }


				          $("#'.$param_name.'").val(newIds);


		             });





		            $("#' . $param_name . '_select_all").click(function(){


		                if($("#'.$param_name.'_select_all").is(":checked") ){


		                    $("#'.$param_name.'_select2 > option").prop("selected","selected");


		                    $("#'.$param_name.'_select2").trigger("change");


		                    var arr_ids =  $("#'.$param_name.'_select2").select2("val");


		                    var ids = "";


                            for (var i = 0; i < arr_ids.length; i++ ) {


                                if (ids != "") {


                                    ids +=",";


                                }


                                ids += arr_ids[i];


                            }


                            $("#'.$param_name.'").val(ids);





		                }else{


		                    $("#'.$param_name.'_select2 > option").removeAttr("selected");


		                    $("#'.$param_name.'_select2").trigger("change");


		                    $("#'.$param_name.'").val("");


		                }


		            });


		        });


		        </script>


		        <style>


		            .multi-select


		            {


		              width: 100%;


		            }


		            .select2-drop


		            {


		                z-index: 100000;


		            }


		        </style>';


    return $output;


}





function g5plus_tags_settings_field_shortcode_param($settings, $value) {


    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';


    $dependency = vc_generate_dependencies_attributes( $settings );


    $output = '<input  name="' . $settings['param_name']


        . '" class="wpb_vc_param_value wpb-textinput '


        . $settings['param_name'] . ' ' . $settings['type']


        . '" type="hidden" value="' . $value . '"/>';


    $output .= '<input type="text" name="'.$param_name.'_tagsinput" id="'.$param_name.'_tagsinput" value="'.$value.'" data-role="tagsinput" '.$dependency.' />';


    $output .= '<script type="text/javascript">


							jQuery(document).ready(function($){


								$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();





								$("#'. $param_name .'_tagsinput").on("itemAdded", function(event) {


		                             $("input[name='.$param_name.']").val($(this).val());


								});





								$("#'. $param_name .'_tagsinput").on("itemRemoved", function(event) {


		                             $("input[name='.$param_name.']").val($(this).val());


								});


							});


						</script>';


    return $output;


}





if ( function_exists('vc_add_shortcode_param'))


{


    vc_add_shortcode_param('number' , 'g5plus_number_settings_field' );


    vc_add_shortcode_param('icon_text' , 'g5plus_icon_text_settings_field' );


    vc_add_shortcode_param('multi-select', 'g5plus_multi_select_settings_field_shortcode_param');


    vc_add_shortcode_param('tags', 'g5plus_tags_settings_field_shortcode_param');


}





function g5plus_add_vc_param() {


    if(function_exists('vc_remove_param')){


        vc_remove_param('vc_column_text', 'css_animation' );


        vc_remove_param('vc_single_image','css_animation' );


        vc_remove_param('vc_row','full_width');


        vc_remove_param('vc_row', 'parallax' );


        vc_remove_param('vc_row', 'parallax_image');


    }


    if(function_exists('vc_add_param')){


        $colors_arr = array(


            __( 'Grey', 'g5plus-framework' ) => 'wpb_button',


            __( 'Blue', 'g5plus-framework' ) => 'btn-primary',


            __( 'Turquoise', 'g5plus-framework' ) => 'btn-info',


            __( 'Green', 'g5plus-framework' ) => 'btn-success',


            __( 'Orange', 'g5plus-framework' ) => 'btn-warning',


            __( 'Red', 'g5plus-framework' ) => 'btn-danger',


            __( 'Black', 'g5plus-framework' ) => "btn-inverse"


        );





        $add_css_animation = array(


            'type' => 'dropdown',


            'heading' => __('CSS Animation', 'g5plus-framework'),


            'param_name' => 'css_animation',


            'value' => array(__('No','g5plus-framework') => '',__('Fade In','g5plus-framework') => 'wpb_fadeIn',__('Fade Top to Bottom','g5plus-framework') => 'wpb_fadeInDown', __('Fade Bottom to Top','g5plus-framework') => 'wpb_fadeInUp', __('Fade Left to Right','g5plus-framework') => 'wpb_fadeInLeft', __('Fade Right to Left','g5plus-framework') => 'wpb_fadeInRight', __('Bounce In','g5plus-framework') => 'wpb_bounceIn',__('Bounce Top to Bottom','g5plus-framework') => 'wpb_bounceInDown',__('Bounce Bottom to Top','g5plus-framework') => 'wpb_bounceInUp', __('Bounce Left to Right','g5plus-framework') => 'wpb_bounceInLeft', __('Bounce Right to Left','g5plus-framework') => 'wpb_bounceInRight', __('Zoom In','g5plus-framework') => 'wpb_zoomIn', __('Flip Vertical','g5plus-framework') => 'wpb_flipInX',__('Flip Horizontal','g5plus-framework') => 'wpb_flipInY', __('Bounce','g5plus-framework') => 'wpb_bounce', __('Flash','g5plus-framework') => 'wpb_flash',__('Shake','g5plus-framework') => 'wpb_shake',__( 'Pulse','g5plus-framework') => 'wpb_pulse',__( 'Swing','g5plus-framework') => 'wpb_swing', __('Rubber band','g5plus-framework') => 'wpb_rubberBand', __('Wobble','g5plus-framework') => 'wpb_wobble', __('Tada','g5plus-framework') => 'wpb_tada'),


            'description' => __('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'g5plus-framework'),


            'group' => __( 'Animation Settings', 'g5plus-framework' )


        );





        $add_duration_animation = array(


            'type' => 'textfield',


            'heading' => __('Animation Duration', 'g5plus-framework'),


            'param_name' => 'duration',


            'value' => '',


            'description' => __('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'g5plus-framework'),


            'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown','wpb_fadeInUp','wpb_fadeInLeft','wpb_fadeInRight','wpb_bounceIn','wpb_bounceInDown','wpb_bounceInUp','wpb_bounceInLeft','wpb_bounceInRight','wpb_zoomIn','wpb_flipInX','wpb_flipInY','wpb_bounce', 'wpb_flash', 'wpb_shake','wpb_pulse','wpb_swing','wpb_rubberBand','wpb_wobble','wpb_tada')),


            'group' => __( 'Animation Settings', 'g5plus-framework' )


        );





        $add_delay_animation = array(


            'type' => 'textfield',


            'heading' => __('Animation Delay', 'g5plus-framework'),


            'param_name' => 'delay',


            'value' => '',


            'description' => __('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'g5plus-framework'),


            'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown','wpb_fadeInUp','wpb_fadeInLeft','wpb_fadeInRight','wpb_bounceIn','wpb_bounceInDown','wpb_bounceInUp','wpb_bounceInLeft','wpb_bounceInRight','wpb_zoomIn','wpb_flipInX','wpb_flipInY','wpb_bounce', 'wpb_flash', 'wpb_shake','wpb_pulse','wpb_swing','wpb_rubberBand','wpb_wobble','wpb_tada')),


            'group' => __( 'Animation Settings', 'g5plus-framework' )


        );





        vc_add_param('vc_row',


            array(


                'type'       => 'dropdown',


                'heading'    => __( 'Layout', 'wpb' ),


                'param_name' => 'layout',


                'value'      => array(


                    __( 'Full Width', 'wpb' )  => 'wide',


                    __( 'Container', 'wpb' ) => 'boxed',


                    __( 'Container Fluid', 'wpb' ) => 'container-fluid',


                ),


            )


        );


        vc_add_param('vc_row',


            array(


                'type' => 'dropdown',


                'heading' => __('Parallax Type','g5plus-framework'),


                'param_name' => 'parallax_style',


                'value' => array(


                    __('None','g5plus-framework') => 'none',


                    __('Vertical Parallax On Scroll','g5plus-framework') => 'vertical-parallax',


                    __('Horizontal Parallax On Scroll','g5plus-framework') => 'horizontal-parallax',


                    __('Video Background','g5plus-framework') => 'video-background',


                ),


                'description' => __('Select the kind of style you like for the background image of this row.','g5plus-framework'),


            )


        );


        vc_add_param('vc_row',


            array(


                'type'       => 'textarea',


                'heading'    => __( 'Link Video (.mp4 or .ogg)', 'g5plus-framework' ),


                'param_name' => 'video_link',


                'value'      => '',


                'dependency' => Array('element' => 'parallax_style','value' => array('video-background')),


            )


        );


        vc_add_param('vc_row',


            array(


                'type' => 'dropdown',


                'heading' => __('Scroll effect', 'g5plus-framework'),


                'param_name' => 'parallax_scroll_effect',


                'value' => array(


                    __('Fixed at its position', 'g5plus-framework') => 'fixed',


                    __('Move with the content', 'g5plus-framework') => 'scroll',


                ),


                'description' => __('Options to set whether a background image is fixed or scroll with the rest of the page.', 'g5plus-framework'),


                'dependency' => Array('element' => 'parallax_style','value' => array('vertical-parallax','horizontal-parallax')),


            )


        );


        vc_add_param('vc_row',


            array(


                'type' => 'number',


                'heading' => __('Parallax speed', 'g5plus-framework'),


                'param_name' => 'parallax_speed',


                'value' =>'0',


                'min'=>'0',


                'max'=>'100',


                'description' => __('Control speed of parallax. Enter value between 0 to 100', 'g5plus-framework'),


                'dependency' => Array('element' => 'parallax_style','value' => array('vertical-parallax','horizontal-parallax')),


            )


        );


        vc_add_param('vc_row',


            array(


                'type' => 'dropdown',


                'heading' => __( 'Show background overlay', 'g5plus-framework' ),


                'param_name' => 'overlay_set',


                'description' => __( 'Hide or Show overlay on background images.', 'g5plus-framework' ),


                'value' => array(


                    __( 'Hide, please', 'g5plus-framework' ) =>'hide_overlay',


                    __( 'Show Overlay Color', 'g5plus-framework' ) =>'show_overlay_color',


                    __( 'Show Overlay Image', 'g5plus-framework' ) =>'show_overlay_image',


                )


            )


        );


        vc_add_param('vc_row',


            array(


                'type'        => 'attach_image',


                'heading'     => __( 'Upload image:', 'g5plus-framework' ),


                'param_name'  => 'overlay_image',


                'value'       => '',


                'description' => __( 'Upload image overlay.', 'g5plus-framework' ),


                'dependency'  => Array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image' ) ),


            )


        );


        vc_add_param('vc_row',


            array(


                'type' => 'colorpicker',


                'heading' => __( 'Overlay color', 'g5plus-framework' ),


                'param_name' => 'overlay_color',


                'description' => __( 'Select color for background overlay.', 'g5plus-framework' ),


                'value' => '',


                'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color')),


            )


        );


        vc_add_param('vc_row',array(


                'type' => 'number',


                'class' => '',


                'heading' => __( 'Overlay opacity', 'g5plus-framework' ),


                'param_name' => 'overlay_opacity',


                'value' =>'50',


                'min'=>'1',


                'max'=>'100',


                'suffix'=>'%',


                'description' => __( 'Select opacity for overlay.', 'g5plus-framework' ),


                'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color','show_overlay_image')),


            )


        );


        vc_add_param('vc_row',$add_css_animation);





        vc_add_param('vc_row',$add_duration_animation);





        vc_add_param('vc_row',$add_delay_animation);





        vc_add_param('vc_row_inner',


            array(


                'type'       => 'dropdown',


                'heading'    => __( 'Layout', 'wpb' ),


                'param_name' => 'layout',


                'value'      => array(


                    __( 'Full Width', 'wpb' )  => 'wide',


                    __( 'Container', 'wpb' ) => 'boxed',


                    __( 'Container Fluid', 'wpb' ) => 'container-fluid',


                ),


            )


        );


        vc_add_param('vc_row_inner',


            array(


                'type' => 'dropdown',


                'heading' => __('Parallax Type','g5plus-framework'),


                'param_name' => 'parallax_style',


                'value' => array(


                    __('None','g5plus-framework') => 'none',


                    __('Vertical Parallax On Scroll','g5plus-framework') => 'vertical-parallax',


                    __('Horizontal Parallax On Scroll','g5plus-framework') => 'horizontal-parallax',


                    __('Video Background','g5plus-framework') => 'video-background',


                ),


                'description' => __('Select the kind of style you like for the background image of this row.','g5plus-framework'),


            )


        );


        vc_add_param('vc_row_inner',


            array(


                'type'       => 'textarea',


                'heading'    => __( 'Link Video (.mp4 or .ogg)', 'g5plus-framework' ),


                'param_name' => 'video_link',


                'value'      => '',


                'dependency' => Array('element' => 'parallax_style','value' => array('video-background')),


            )


        );


        vc_add_param('vc_row_inner',


            array(


                'type' => 'dropdown',


                'heading' => __('Scroll effect', 'g5plus-framework'),


                'param_name' => 'parallax_scroll_effect',


                'value' => array(


                    __('Fixed at its position', 'g5plus-framework') => 'fixed',


                    __('Move with the content', 'g5plus-framework') => 'scroll',


                ),


                'description' => __('Options to set whether a background image is fixed or scroll with the rest of the page.', 'g5plus-framework'),


                'dependency' => Array('element' => 'parallax_style','value' => array('vertical-parallax','horizontal-parallax')),


            )


        );


        vc_add_param('vc_row_inner',


            array(


                'type' => 'number',


                'heading' => __('Parallax speed', 'g5plus-framework'),


                'param_name' => 'parallax_speed',


                'value' =>'100',


                'min'=>'1',


                'max'=>'100',


                'description' => __('Control speed of parallax. Enter value between 1 to 100', 'g5plus-framework'),


                'dependency' => Array('element' => 'parallax_style','value' => array('vertical-parallax','horizontal-parallax')),


            )


        );


        vc_add_param('vc_row_inner',


            array(


                'type' => 'dropdown',


                'heading' => __( 'Show background overlay', 'g5plus-framework' ),


                'param_name' => 'overlay_set',


                'description' => __( 'Hide or Show overlay on background images.', 'g5plus-framework' ),


                'value' => array(


                    __( 'Hide, please', 'g5plus-framework' ) =>'hide_overlay',


                    __( 'Show Overlay Color', 'g5plus-framework' ) =>'show_overlay_color',


                    __( 'Show Overlay Image', 'g5plus-framework' ) =>'show_overlay_image',


                )


            )


        );


        vc_add_param('vc_row_inner',


            array(


                'type'        => 'attach_image',


                'heading'     => __( 'Upload image:', 'g5plus-framework' ),


                'param_name'  => 'overlay_image',


                'value'       => '',


                'description' => __( 'Upload image overlay.', 'g5plus-framework' ),


                'dependency'  => Array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image' ) ),


            )


        );


        vc_add_param('vc_row_inner',


            array(


                'type' => 'colorpicker',


                'heading' => __( 'Overlay color', 'g5plus-framework' ),


                'param_name' => 'overlay_color',


                'description' => __( 'Select color for background overlay.', 'g5plus-framework' ),


                'value' => '',


                'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color')),


            )


        );


        vc_add_param('vc_row_inner',array(


                'type' => 'number',


                'class' => '',


                'heading' => __( 'Overlay opacity', 'g5plus-framework' ),


                'param_name' => 'overlay_opacity',


                'value' =>'50',


                'min'=>'1',


                'max'=>'100',


                'suffix'=>'%',


                'description' => __( 'Select opacity for overlay.', 'g5plus-framework' ),


                'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color','show_overlay_image')),


            )


        );


        vc_add_param('vc_row_inner',$add_css_animation);





        vc_add_param('vc_row_inner',$add_duration_animation);





        vc_add_param('vc_row_inner',$add_delay_animation);





        vc_add_param('vc_accordion',array(


                'type'        => 'dropdown',


                'heading'     => __( 'Layout Style', 'g5plus-framework' ),


                'param_name'  => 'layout_style',


                'admin_label' => true,


                'value'       => array( __( 'style 1', 'g5plus-framework' ) => 'style1', __( 'style 2', 'g5plus-framework' ) => 'style2', __( 'style 3', 'g5plus-framework' ) => 'style3', __( 'style 4', 'g5plus-framework' ) => 'style4'),


                'description' => __( 'Select Layout Style.', 'g5plus-framework' ),


                'weight' => 1


            )


        );


        vc_add_param('vc_accordion_tab',array(


                'type'        => 'icon_text',


                'heading'     => __( 'Select Icon:', 'g5plus-framework' ),


                'param_name'  => 'icon',


                'value'       => '',


                'description' => __( 'Select the icon from the list.', 'g5plus-framework' ),


            )


        );


        vc_add_param('vc_tab',array(


                'type'        => 'icon_text',


                'heading'     => __( 'Select Icon:', 'g5plus-framework' ),


                'param_name'  => 'icon',


                'value'       => '',


                'description' => __( 'Select the icon from the list.', 'g5plus-framework' ),


            )


        );


        vc_add_param('vc_tabs',array(


                'type'        => 'dropdown',


                'heading'     => __( 'Layout Style', 'g5plus-framework' ),


                'param_name'  => 'layout_style',


                'admin_label' => true,


                'value'       => array( __( 'style 1', 'g5plus-framework' ) => 'style1', __( 'style 2', 'g5plus-framework' ) => 'style2'),


                'description' => __( 'Select Layout Style.', 'g5plus-framework' ),


                'weight' => 2


            )


        );


        vc_add_param('vc_tabs',array(


                'type'        => 'dropdown',


                'heading'     => __( 'Type', 'g5plus-framework' ),


                'param_name'  => 'type',


                'admin_label' => true,


                'value'       => array( __( 'Left', 'g5plus-framework' ) => 'left', __( 'Right', 'g5plus-framework' ) => 'right'),


                'weight' => 1


            )


        );


        vc_add_param('vc_single_image',$add_css_animation);





        vc_add_param('vc_single_image',$add_duration_animation);





        vc_add_param('vc_single_image',$add_delay_animation);





        vc_add_param('vc_column_text',$add_css_animation);





        vc_add_param('vc_column_text',$add_duration_animation);





        vc_add_param('vc_column_text',$add_delay_animation);





        vc_add_param('vc_progress_bar',array(


                'type'        => 'dropdown',


                'heading'     => __( 'Layout Style', 'g5plus-framework' ),


                'param_name'  => 'layout_style',


                'admin_label' => true,


                'value'       => array( __( 'style 1', 'g5plus-framework' ) => 'style1', __( 'style 2', 'g5plus-framework' ) => 'style2', __( 'style 3', 'g5plus-framework' ) => 'style3'),


                'description' => __( 'Select Layout Style.', 'g5plus-framework' ),


                'weight' => 1


            )


        );


        $settings_vc_map = array (


            'category' => __( 'Darna Shortcodes', 'g5plus-framework' )


        );


        vc_map_update( 'vc_tabs', $settings_vc_map );


        vc_map_update( 'vc_accordion', $settings_vc_map );


        vc_map_update( 'vc_progress_bar', $settings_vc_map );


        vc_map_update( 'vc_pie', $settings_vc_map );


        vc_add_param('vc_pie',array(


                'type'        => 'dropdown',


                'heading'     => __( 'Layout Style', 'g5plus-framework' ),


                'param_name'  => 'layout_style',


                'admin_label' => true,


                'value'       => array( __( 'style 1', 'g5plus-framework' ) => 'style1', __( 'style 2', 'g5plus-framework' ) => 'style2', __( 'style 3', 'g5plus-framework' ) => 'style3', __( 'style 4', 'g5plus-framework' ) => 'style4'),


                'description' => __( 'Select Layout Style.', 'g5plus-framework' ),


                'weight' => 8


            )


        );


        vc_add_param('vc_pie',array(


                'type'        => 'dropdown',


                'heading'     => __( 'Layout Style', 'g5plus-framework' ),


                'param_name'  => 'layout_style',


                'admin_label' => true,


                'value'       => array( __( 'style 1', 'g5plus-framework' ) => 'style1', __( 'style 2', 'g5plus-framework' ) => 'style2', __( 'style 3', 'g5plus-framework' ) => 'style3', __( 'style 4', 'g5plus-framework' ) => 'style4'),


                'description' => __( 'Select Layout Style.', 'g5plus-framework' ),


                'weight' => 7


            )


        );


        vc_add_param('vc_pie',array(


                'type'        => 'dropdown',


                'heading'     => __( 'Icon to display:', 'g5plus-framework' ),


                'param_name'  => 'icon_type',


                'value'       => array(


                    __( 'Font Icon', 'g5plus-framework' ) => 'font-icon',


                    __( 'Custom Image Icon', 'g5plus-framework' ) => 'custom',


                ),


                'description' => __( 'Select which icon you would like to use', 'g5plus-framework' ),


                'dependency'  => Array( 'element' => 'layout_style', 'value' => array( 'style3','style4' ) ),


                'weight' => 6


            )


        );


        vc_add_param('vc_pie',array(


                'type'        => 'icon_text',


                'heading'     => __( 'Select Icon:', 'g5plus-framework' ),


                'param_name'  => 'icon',


                'value'       => '',


                'description' => __( 'Select the icon from the list.', 'g5plus-framework' ),


                'dependency'  => Array( 'element' => 'icon_type', 'value' => array( 'font-icon' ) ),


                'weight' => 5


            )


        );


        vc_add_param('vc_pie',array(


                'type'        => 'attach_image',


                'heading'     => __( 'Upload Image Icon:', 'g5plus-framework' ),


                'param_name'  => 'image',


                'value'       => '',


                'description' => __( 'Upload the custom image icon.', 'g5plus-framework' ),


                'dependency'  => Array( 'element' => 'icon_type', 'value' => array( 'custom' ) ),


                'weight' => 4


            )


        );


        vc_add_param('vc_pie',array(


                'type' => 'textfield',


                'heading' => __('Title', 'g5plus-framework'),


                'param_name' => 'title',


                'value' => '',


                'weight' => 3


            )


        );


        vc_add_param('vc_pie',array(


                'type' => 'textarea',


                'heading' => __('Description', 'g5plus-framework'),


                'param_name' => 'description',


                'value' => '',


                'weight' => 2


            )


        );


        vc_add_param('vc_pie',array(


                'type' => 'colorpicker',


                'heading' => __( 'Color', 'js_composer' ),


                'param_name' => 'color',


                'value' => '', //$pie_colors,


                'description' => __( 'Select pie chart color.', 'js_composer' ),


                'weight' => 1


            )


        );


    }


}


g5plus_add_vc_param();





function g5plus_get_css_animation($css_animation){


    $output = '';


    if ($css_animation != '') {


        wp_enqueue_script('waypoints');


        $output = ' wpb_animate_when_almost_visible g5plus-css-animation ' . $css_animation;


    }


    return $output;


}





function g5plus_get_style_animation($duration, $delay) {


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





function  g5plus_convert_hex_to_rgba($hex,$opacity=1) {


    $hex = str_replace("#", "", $hex);


    if(strlen($hex) == 3) {


        $r = hexdec(substr($hex,0,1).substr($hex,0,1));


        $g = hexdec(substr($hex,1,1).substr($hex,1,1));


        $b = hexdec(substr($hex,2,1).substr($hex,2,1));


    }


    else {


        $r = hexdec(substr($hex,0,2));


        $g = hexdec(substr($hex,2,2));


        $b = hexdec(substr($hex,4,2));


    }


    $rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';


    return $rgba;


}


