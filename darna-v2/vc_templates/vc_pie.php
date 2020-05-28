<?php
$title = $el_class = $value = $label_value = $units = $layout_style=$icon_type=$image=$icon=$description='';
extract( shortcode_atts( array(
    'layout_style' => '',
    'icon_type'     => '',
    'icon' => '',
    'image'         => '',
	'title' => '',
    'description' => '',
	'el_class' => '',
	'value' => '50',
	'units' => '',
	'color' => 'turquoise',
	'label_value' => ''
), $atts ) );

wp_enqueue_script('g5plus_framework_vc_pie_chart', THEME_URL . 'assets/plugins/vc_chart/jquery.vc_chart.js', array(), false, true);
$pie_type=($layout_style=='style1'||$layout_style=='style2') ? 0: 1;
$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_pie_chart wpb_content_element' . $el_class, $this->settings['base'], $atts );
$output = '<div class="darna-pie-chart '. $layout_style. '">';
$output .=  "\n\t" . '<div class="darna-pie-chart-circle ' . $css_class . '" data-pie-value="' . $value . '" data-pie-label-value="' . $label_value . '" data-pie-units="' . $units . '" data-pie-color="' . htmlspecialchars( $color ) . '" data-pie-icon="'. esc_attr($pie_type) .'">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= "\n\t\t\t" . '<div class="vc_pie_wrapper">';
$output .= "\n\t\t\t" . '<span class="vc_pie_chart_back"></span>';
if($layout_style=='style1' || $layout_style=='style2')
{
    $output .= "\n\t\t\t" . '<span class="vc_pie_chart_value"></span>';
}
else
{
    $output .= "\n\t\t\t" . '<span class="vc_pie_chart_value">';
    if($icon_type=='font-icon')
    {
        $output .='<i class="'. esc_attr($icon) .'"></i>';
    }
    else
    {
        $img = wp_get_attachment_image_src( $image, 'large' );
        $output .='<img src="'. esc_attr($img[0]) .'"/>';
    }
    $output .='</span>';
}
$output .= "\n\t\t\t" . '<canvas width="101" height="101"></canvas>';
$output .= "\n\t\t\t" . '</div>';
$output .= "\n\t\t" . '</div>' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div>' . $this->endBlockComment( '.darna-pie-chart-circle' );
if ($title!='') {
    $output .= '<h6 class="pie-chart-title">'.esc_html($title).'</h6>';
}
if ($description!='') {
    $output .= '<p class="pie-chart-description">'.esc_html($description).'</p>';
}
$output .= '</div>'. $this->endBlockComment( '.darna-pie-chart' );
echo !empty( $output ) ? $output : '';