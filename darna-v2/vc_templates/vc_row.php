<?php


/** @var $this WPBakeryShortCode_VC_Row */


$video_link=$css_animation = $duration = $delay=$output = $style_css = $layout = $parallax_style = $parallax_scroll_effect = $parallax_speed = $overlay_set = $overlay_color = $overlay_image = $overlay_opacity = $el_id = $el_class = $bg_image = $bg_color = $bg_image_repeat = $pos = $font_color = $padding = $margin_bottom = $css = '';


extract( shortcode_atts( array(


    'el_class'        => '',


    'el_id'           => '',


    'bg_image'        => '',


    'bg_color'        => '',


    'bg_image_repeat' => '',


    'font_color'      => '',


    'padding'         => '',


    'margin_bottom'   => '',


    'css'             => '',


    'layout'          => '',


    'parallax_style'  => 'none',


    'video_link'      => '',


    'parallax_scroll_effect'  => '',


    'parallax_speed'  => '',


    'overlay_set'     => 'hide_overlay',


    'overlay_color'   => '',


    'overlay_image'   => '',


    'overlay_opacity' => '',


    'css_animation'   => '',


    'duration'        => '',


    'delay'           => ''


), $atts ) );





// wp_enqueue_style( 'js_composer_front' );


wp_enqueue_script( 'wpb_composer_front_js' );


// wp_enqueue_style('js_composer_custom_css');





$el_class = $this->getExtraClass( $el_class );





$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );





$style = $this->buildStyle( $bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom );


$str_el_id='';


$css_overlay_video='';


if($el_id!='')


{


    $str_el_id='id="'.esc_attr($el_id).'"';


}


if ( $layout == 'boxed' ) {


    $style_css='container';


} elseif ( $layout == 'container-fluid' ) {


    $style_css='container-fluid';


}else


{


    $style_css='fullwidth';


}


$output .= '<div '.$str_el_id.' class="'.$style_css . g5plus_get_css_animation($css_animation) .'" '.g5plus_get_style_animation($duration,$delay).'>';


if ($parallax_style != 'none' && $parallax_style != 'video-background') {


    if($overlay_set!='hide_overlay'){


        $css_overlay_video=' overlay-wapper';


    }


    $output .= '<div data-parallax_speed="'.(esc_attr($parallax_speed)/100) .'" data-scroll_effect="'.esc_attr($parallax_scroll_effect).'" class="' . esc_attr($css_class) .  ' '.esc_attr($parallax_style).$css_overlay_video.'"' . $style .'>';


}


else


{


    if($overlay_set!='hide_overlay'){


        $css_overlay_video=' overlay-wapper';


    }


    if ($parallax_style == 'video-background') {


        $css_overlay_video.=' video-background-wapper';


    }


    $output .= '<div class="' . esc_attr($css_class) . $css_overlay_video.'"' . $style .'>';


}


if ($parallax_style == 'video-background') {


    $output .= '<video muted="muted" loop="loop" autoplay="true" preload="auto">


                    <source src="' . esc_url($video_link) . '">


                </video>';


}


if($overlay_set!='hide_overlay'){


    $overlay_id='overlay-'.uniqid();


    if($overlay_set=='show_overlay_color'){


        $overlay_color = g5plus_convert_hex_to_rgba(esc_attr($overlay_color),(esc_attr($overlay_opacity)/100));


        $style_css=' data-overlay_color= '.esc_attr($overlay_color);


    }


    else if($overlay_set=='show_overlay_image'){


        $image_attributes = wp_get_attachment_image_src( $overlay_image,'full' );


        $style_css=' data-overlay_image= '.$image_attributes[0].' data-overlay_opacity='.(esc_attr($overlay_opacity)/100);


    }


    $output .= '<div id="'.$overlay_id.'" class="overlay" '.$style_css.'></div>';


}


$output .= wpb_js_remove_wpautop( $content );


$output .= '</div></div>';


echo !empty( $output ) ? $output : '';


