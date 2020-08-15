<?php
/**
 * Template part for displaying those pages which have no content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<section class="wrap-detail-page error-404">
	<div class="container">
		<div class="inner-page-content">
			<div class="row">
				<div class="col-12 col-md-8 offset-md-2">
					<div class="content">
						<h1 class="section-title">
							<?php
								if( is_404() ){

									esc_html_e( 'Page Not Found', 'travelbiz' ); 
								}else{

									esc_html_e( 'Nothing Found', 'travelbiz' ); 
								}
							?>
						</h1>
						<span class="sub-title">
							<?php
								if( is_404() ){

									esc_html_e( 'It looks like nothing was found. Want to try another by search?', 'travelbiz' ); 
								}else{

									esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps another searching can help.', 'travelbiz' ); 
								}
							?>
						</span>
						<div class="content">
							<?php 
								get_search_form();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>