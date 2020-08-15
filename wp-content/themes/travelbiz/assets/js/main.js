;(function( $ ){
/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

jQuery.fn.scrollTo = function( offset ){

	jQuery( document ).on( 'click', this.selector, function( e ){
		e.preventDefault();
		var target = jQuery( this ).attr( 'href' );
		if( 'undefined' != typeof target ){
			if( !offset ){
				offset = 0;
			}
			var pos = jQuery( target ).offset().top - offset;
			jQuery("html, body").animate({ scrollTop: pos }, 800);
		}
	});

	return this;
};

function scrollToTop ( param ){

	this.markup   = null,
	this.selector = null;
	this.fixed    = true;
	this.visible  = false;

	this.init = function(){

		if( this.valid() ){

			if( typeof param != 'undefined' && typeof param.fixed != 'undefined' ){
				this.fixed = param.fixed;
			}

			this.selector = ( param && param.selector ) ? param.selector : '#go-top';

			this.getMarkup();
			var that = this;

			jQuery( 'body' ).append( this.markup );

			if( this.fixed ){

				jQuery( this.selector ).hide();

				var windowHeight = jQuery( window ).height();

				jQuery( window ).scroll(function(){

					var scrollPos = jQuery( window ).scrollTop();

					if(  ( scrollPos > ( windowHeight - 100 ) ) ){

						if( false == that.visible ){
							jQuery( that.selector ).fadeIn();
							that.visible = true;
						}
						
					}else{

						if( true == that.visible ){
							jQuery( that.selector ).fadeOut();
							that.visible = false;
						}
					}
				});

				jQuery( this.selector ).scrollTo();
			}
		}
	}

	this.getMarkup = function(){

		var position = this.fixed ? 'fixed':'absolute';

		var wrapperStyle = 'style="position: '+position+'; z-index:999999; bottom: 20px; right: 20px;"';

		var buttonStyle  = 'style="cursor:pointer;display: inline-block;padding: 10px 20px;background: #f15151;color: #fff;border-radius: 2px;"';

		var markup = '<div ' + wrapperStyle + ' id="go-top"><span '+buttonStyle+'>Scroll To Top</span></div>';

		this.markup   = ( param && param.markup ) ? param.markup : markup;
	}

	this.valid = function(){

		if( param && param.markup && !param.selector ){
			alert( 'Please provide selector. eg. { markup: "<div id=\'scroll-top\'></div>", selector: "#scroll-top"}' );
			return false;
		}

		return true;
	}
};

/**
* Setting up functionality for alternative menu
* @since Travelbiz 1.0.0
*/
function wpMenuAccordion( selector ){

	var $ele = selector + ' .menu-item-has-children > a';
	$( $ele ).each( function(){
		var text = $( this ).text();
		text = text + '<span class="kfi kfi-arrow-carrot-down-alt2 triangle"></span>';
		$( this ).html( text );
	});

	$( document ).on( 'click', $ele + ' span.triangle', function( e ){
		e.preventDefault();
		e.stopPropagation();

		$parentLi = $( this ).parent().parent( 'li' );
		$childLi = $parentLi.find( 'li' );

		if( $parentLi.hasClass( 'open' ) ){
			/**
			* Closing all the ul inside and 
			* removing open class for all the li's
			*/
			$parentLi.removeClass( 'open' );
			$childLi.removeClass( 'open' );

			$( this ).parent( 'a' ).next().slideUp();
			$( this ).parent( 'a' ).next().find( 'ul' ).slideUp();
		}else{

			$parentLi.addClass( 'open' );
			$( this ).parent( 'a' ).next().slideDown();
		}
	});
};

/**
* Fire for fixed header
* @since Travelbiz 1.0.0
*/

function primaryHeader(){
	var width = $( window ).width();
	if( TRAVELBIZ.is_admin_bar_showing && width >= 782 ){
		$( '.site-header, #offcanvas-menu' ).css({
			top : 32
		});
	}else if( TRAVELBIZ.is_admin_bar_showing && width <= 781 ){
		$( '.site-header, #offcanvas-menu' ).css({
			top : 46
		});
	};
	var h,
	bodyClass = 'fixed-nav-active',
	addClass = function(){
		if( TRAVELBIZ.fixed_nav && !$( 'body' ).hasClass( bodyClass ) ){
			$( 'body' ).addClass( bodyClass );
		}
	},
	removeClass = function(){
		if( TRAVELBIZ.fixed_nav && $( 'body' ).hasClass( bodyClass ) ){
			$( 'body' ).removeClass( bodyClass );
		}
	},
	setPosition = function( top ){
		$( '.header-group-wrap' ).css( {
			'top' : top
		});
	},
	init = function(){
		h = 0;
		if( TRAVELBIZ.is_admin_bar_showing && $( window ).width() <= 781 ){
			h = 46;
		}
		setPosition( h );
	},
	onScroll = function(){
		var scroll = jQuery(document).scrollTop(),
			pos = 0,
			height = h,
			width = $( window ).width();

		if( width <= 767 ){
			return;
		}

		if( TRAVELBIZ.is_admin_bar_showing && width >= 782 ){
			scroll = scroll+32;
		}

		if( height ){
			if( height >= scroll ){
				pos = height-jQuery(document).scrollTop();
				removeClass();
			}else if( TRAVELBIZ.is_admin_bar_showing && width >= 782 ){
				pos = 32;
				addClass()
			}else{
				addClass();
			}

		}else{

			var mh = $( '#masthead' ).outerHeight(),
				scroll = jQuery(document).scrollTop();
			if( mh >= scroll ){
				if( TRAVELBIZ.is_admin_bar_showing && width >= 782 ){
					pos = 32-scroll;
				}else{

					pos = -scroll;
				}
				removeClass();
			}else{
				
				if( TRAVELBIZ.is_admin_bar_showing && width >= 782 ){
					pos = 32;
				}else{
					pos = 0;
				}
				addClass();
			}
		}
		
		setPosition( pos );
	};
	
	$( window ).resize(function(){
		init();
		onScroll();
	});

	init();
	onScroll();
	
	$( window ).scroll( onScroll );

	jQuery( window ).load( function(){
		init();
		onScroll();
	});
}
jQuery( document ).ready( function(){
	primaryHeader();
});

/**
* theiaStickySidebar
* @since Travelbiz 1.0.0
*/

$('#primary, #secondary').theiaStickySidebar({
// Settings
	additionalMarginTop: 30
});

/**
* Show or Hide Search field on clicking search icon
* @since Travelbiz 1.0.0
*/
jQuery( document ).on( 'click', '.header-search-icon', function(e){
	e.preventDefault();
	jQuery( '.header-search-wrap' ).addClass( 'search-slide' );
	jQuery("#header-search-form input").focus();
});

jQuery( document ).on( 'click', '.header-search-wrap button.header-search-close', function(e){
	e.preventDefault();
    jQuery( '.header-search-wrap' ).removeClass( 'search-slide' );
    jQuery(".header-search-icon").focus();
});

/**
* Animate contact form fields when they are focused
* @since Travelbiz 1.0.0
*/
jQuery( '.kt-contact-form-area input, .kt-contact-form-area textarea' ).on( 'focus',function(){
	var target = jQuery( this ).attr( 'id' );
	jQuery('label[for="'+target+'"]').addClass( 'move' );
});

jQuery( '.kt-contact-form-area input, .kt-contact-form-area textarea' ).on( 'blur',function(){
	var target = jQuery( this ).attr( 'id' );
	jQuery('label[for="'+target+'"]').removeClass( 'move' );
});

/** Front Page **/

/**
* Fire slider for front page
* @link https://owlcarousel2.github.io/OwlCarousel2/docs/started-welcome.html
* @since Travelbiz 1.0.0
*/

function homeSlider(){
	var item_count = parseInt(jQuery( '.section-slider .slide-item').length);
	jQuery(".home-slider").owlCarousel({
		items: 1,
		autoHeight: false,
		autoHeightClass: 'name',
		animateOut: 'fadeOut',
    	navContainer: '.section-slider .controls',
    	dotsContainer: '#slide-pager',
    	autoplay : TRAVELBIZ.home_slider.autoplay,
    	autoplayTimeout : parseInt( TRAVELBIZ.home_slider.timeout ),
    	loop : false,
    	rtl: ( TRAVELBIZ.is_rtl == '1' ) ? true : false,
    	nav: true,
    	responsive:{
    	    768:{
    	        items: 1,
    	    }
    	},
	});
};

/**
* Fire testimonial for front page
* @link https://owlcarousel2.github.io/OwlCarousel2/docs/started-welcome.html
* @since Travelbiz 1.0.0
*/
function testimonialSlider(){
	jQuery(".testimonial-carousel").owlCarousel({
		items: 1,
		animateOut: 'fadeOut',
		nav: true,
		navContainer: '.section-testimonial .controls',
		dotsContainer: '#testimonial-pager',
		responsiveClass: true,
		margin: 30,
		responsive:{
	        768:{
	        	items: 2,
	        	nav: true
	        },
	    },
	    rtl: ( TRAVELBIZ.is_rtl == '1' ) ? true : false ,
		loop : false,
		dots: true
	});	
};

/**
* Fire Slider for Client
* @link https://owlcarousel2.github.io/OwlCarousel2/docs/started-welcome.html
* @since Travelbiz 1.0.0
*/

function clientSlider(){
	jQuery(".clients-carousel").owlCarousel({
		items: 2,
		animateOut: 'fadeOut',
		nav: true,
		navContainer: '.section-clients .controls',
		responsiveClass: true,
		margin: 25,
	    responsive:{
	    	576:{
	            items: 2,
	            nav: true
	        },
	        767:{
	            items: 4,
	            nav: true
	        },
	        992:{
	        	items: 4,
	        	nav: true
	        }
	    },
	    rtl: ( TRAVELBIZ.is_rtl == '1' ) ? true : false,
		loop : false,
		dots: false
	});
};

masthead         = jQuery( '#masthead' );
siteNavigation   = masthead.find( '#site-navigation' );
socialNavigation = masthead.find( '#social-navigation' );

/** Fire after document ready **/
jQuery( document ).ready( function(){
	homeSlider();
	testimonialSlider();
	clientSlider();

	$( '.scroll-to' ).scrollTo();

	/**
	* Initializing scroll top js
	*/
	new scrollToTop({
		markup   : '<a href="#page" class="scroll-to '+ ( TRAVELBIZ.enable_scroll_top == 0 ? "d-none" : "" )+'" id="go-top"><span class="kfi kfi-arrow-up"></span></a>',
		selector : '#go-top'
	}).init();
	wpMenuAccordion( '#offcanvas-menu' );
	
	$( document ).on( 'click', '.offcanvas-menu-toggler', function( e ){
		e.preventDefault();
		$( 'body' ).addClass( 'offcanvas-menu-open' );
		$('#offcanvas-menu').focus();
		
	});

	$( document ).on( 'click', '.close-offcanvas-menu button', function( e ){
		e.preventDefault();
		$( 'body' ).removeClass( 'offcanvas-menu-open' );
		$('.offcanvas-menu-toggler').focus();
	});

	jQuery( 'body' ).append( '<div class="kt-offcanvas-overlay"></div>' );

    /**
    * Modify default search placeholder
    */
    $( '#masthead #s' ).attr( 'placeholder', TRAVELBIZ.search_placeholder );
    $( '#searchform #s' ).attr( 'placeholder', TRAVELBIZ.search_default_placeholder );

    /**
    * Make One Page Layout
    */
    // handle links with @href started with '#' only
    jQuery(document).on('click', 'a[href^="#after-slider"], a[href^="#block-"]', function(e) {
        // target element id
        var id = $(this).attr('href');
        
        // target element
        var $id = $(id);
        if ($id.length === 0) {
            return;
        }
        
        // prevent standard hash navigation (avoid blinking in IE)
        e.preventDefault();
        
        // top position relative to the document
        var pos = $id.offset().top;
        
        // animated top scrolling
        $('body, html').animate({scrollTop: pos});
    });

});

jQuery( window ).resize(function(){

});
jQuery( window ).load( function(){
	/**
	* Site loader
	*/
	jQuery( '#site-loader' ).fadeOut( 500 );

    /**
    * Blog Section Masonry
    */
	jQuery( '.masonry-wrapper' ).masonry({
		itemSelector: '.grid-post',
		isAnimated: true,
	});	
});

})( jQuery );