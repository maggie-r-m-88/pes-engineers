<?php
global $g5plus_options;
$logo_url = THEME_URL . 'assets/images/theme-options/logo.svg';

if (isset($g5plus_options['mobile_header_logo']['url']) && !empty($g5plus_options['mobile_header_logo']['url'])) {
	$logo_url = $g5plus_options['mobile_header_logo']['url'];
}
else if (isset($g5plus_options['logo']['url']) && !empty($g5plus_options['logo']['url'])) {
	$logo_url = $g5plus_options['logo']['url'];
}

$mobile_header_layout = 'header-mobile-1';
if (isset($g5plus_options['mobile_header_layout']) && !empty($g5plus_options['mobile_header_layout'])) {
	$mobile_header_layout = $g5plus_options['mobile_header_layout'];
}

?>
<?php if ($mobile_header_layout == 'header-mobile-2'): ?>
	<div class="header-mobile-before">
		<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
			<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
		</a>
	</div>
<?php endif;?>