<?php
/**
 * Template part for displaying header search
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<?php if( !travelbiz_get_option( 'disable_search_icon' ) ): ?>
	<div class="header-search-icon">
		<button class="header-search-icon non-style-btn" id="show-header-search">
			<span class="kfi kfi-search" aria-hidden="true"></span>
		</button>
	</div>
<?php endif; ?>