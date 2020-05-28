<?php
global $g5plus_options, $g5plus_header_layout;
$prefix = 'g5plus_';
$g5plus_header_layout = rwmb_meta($prefix . 'header_layout');
if (($g5plus_header_layout === '') || ($g5plus_header_layout == '-1')) {
	$g5plus_header_layout = $g5plus_options['header_layout'];
}

$enable_header_customize = rwmb_meta($prefix . 'enable_header_customize');

$header_search_box = '0';

if ($enable_header_customize == '1') {
	$page_header_customize = rwmb_meta($prefix . 'header_customize');
	if (isset($page_header_customize['enable']) && !empty($page_header_customize['enable'])) {
		$header_customize = explode('||', $page_header_customize['enable']);
	}
	if (in_array('search', $header_customize)) {
		$header_search_box = '1';
	}
}
else {
	if (isset($g5plus_options['header_customize']) && isset($g5plus_options['header_customize']['enabled']) && is_array($g5plus_options['header_customize']['enabled'])) {
		if (in_array('search', $g5plus_options['header_customize']['enabled'])) {
			$header_search_box = '1';
		}
	}
}

$mobile_header_search_box = $g5plus_options['mobile_header_search_box'];

// SHOW HEADER
$header_show_hide = rwmb_meta($prefix . 'header_show_hide');
if (($header_show_hide === '')) {
	$header_show_hide = '1';
}
?>
<?php if (($header_show_hide == '1')): ?>
	<?php g5plus_get_template('header/header-mobile-before'); ?>
	<?php g5plus_get_template('header/' . $g5plus_header_layout ); ?>
	<?php if (($header_search_box == '1') || ($mobile_header_search_box == '1')): ?>
		<?php g5plus_get_template('header/search','popup'); ?>
	<?php endif; ?>
	<?php g5plus_get_template('header/get-quote-popup'); ?>

<?php endif; ?>