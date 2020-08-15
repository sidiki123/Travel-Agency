/*
*	Elementor Parallax Addon main script
*	Based on enllax jQuery plugin https://github.com/mmkjony/enllax.js
*/

jQuery(document).ready(function($) {
	var winHeight = $(window).height();
	$(window).on('scroll', function(){
		$('.elementor-parallax .layer').each(function(e, layer) {
			var ratio = $(layer).attr('data-enllax-ratio');
			var dir = $(layer).attr('data-enllax-direction');
			if($(layer).attr('data-enllax-direction') === undefined) dir = 'vertical';

			var height = $(layer).outerHeight();
			var offset = $(layer).offset().top;
			var scrolling = $(window).scrollTop();
			bgY = Math.round((offset - scrolling) * ratio);
			transform = Math.round(((offset - (winHeight / 2) + height) - scrolling) * ratio);

			if(dir == 'vertical') {
				$(layer).css({'background-position': 'center ' + -bgY + 'px'});
			}
			else if(dir == 'horizontal') {
				$(layer).css({'background-position': -bgY + 'px' + ' center'});
			}
			else if(dir == 'diagonal-br') {
				$(layer).css({'background-position': -bgY + 'px ' + -bgY + 'px'});
			}
			else if(dir == 'diagonal-bl') {
				$(layer).css({'background-position': bgY + 'px ' + -bgY + 'px'});
			}
			else if(dir == 'diagonal-tr') {
				$(layer).css({'background-position': -bgY + 'px ' + bgY + 'px'});
			}
			else if(dir == 'diagonal-tl') {
				$(layer).css({'background-position': bgY + 'px ' + bgY + 'px'});
			}
		});
	});
	
	$(window).trigger('scroll');
});