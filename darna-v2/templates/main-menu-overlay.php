<?php
global $g5plus_options;
if (isset($g5plus_options['mobile_header_menu_drop']) && ($g5plus_options['mobile_header_menu_drop'] == 'fly')):
?>
<div class="main-menu-overlay"></div>
<?php
endif;