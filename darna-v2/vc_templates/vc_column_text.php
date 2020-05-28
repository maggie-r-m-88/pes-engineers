<?php
$delay=$duration=$output = $el_class = $css_animation = '';

extract( shortcode_atts( array(
	'el_class' => '',
    'css' => '',
    'css_animation' => '',
    'duration' => '',
    'delay' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_text_column wpb_content_element ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t" . '<div class="' . esc_attr( $css_class ). g5plus_get_css_animation($css_animation).'" '.g5plus_get_style_animation($duration,$delay).'>';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content, true );
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_text_column' );

echo !empty( $output ) ? $output : '';