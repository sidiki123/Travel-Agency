<?php

add_action( 'admin_menu', 'asvg_menu2' );
function asvg_menu2(){
    add_menu_page( __('Lottie Library', 'asvg-lottie'), __('Lottie Library', 'asvg-lottie'), 'read', 'asvg_menu_lottie', 'asvg_menu_page');
    add_submenu_page( 'asvg-lottie', __('Lottie Library', 'asvg-lottie'), __('New Menu', 'asvg-lottie'), 'read', 'asvg_menu_lottie', 'asvg_menu_page' );
    remove_menu_page('asvg_menu_lottie');
}


function asvg_menu_page() {
	
?>



	<iframe src="https://animated-svg.com/lottie-animation/plugin-menu-shortcode/" style="height:1150px; width:100%"> </iframe>
	

<?php

}
?>