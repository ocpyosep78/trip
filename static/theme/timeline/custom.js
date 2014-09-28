//----------------------------------------------------------------------------------------------------------------------------
//
//	Custom.js
// 	Here we have all the JS functions for the theme.
//	Be extremely carefull when editing this file.
//	When shit hits the fan, it usually hits the fan big time.
//
//	When you do decide to start editing, make sure you have back-up!
//
//
//
//	Lets roll!
//
//----------------------------------------------------------------------------------------------------------------------------


//----------------------------------------------------------------------------------------------------------------------------
//
//	Load JS functions on document ready
//
//----------------------------------------------------------------------------------------------------------------------------


//----------------------------------------------------------------------------------------------------------------------------
//	Header
//----------------------------------------------------------------------------------------------------------------------------
	function tva_header() {
		var $header		= $( '#header-wrap' );
		var $navigation	= $( '#mobile-navigation-wrap' );

		$(window).scroll( function() {

			if( $header.offset().top > 0 ) {

				$header.addClass( 'stick-it' );
				$navigation.addClass( 'stick-it' );

			} else {

				$header.removeClass( 'stick-it' );
				$navigation.removeClass( 'stick-it' );

			}

		});

	}
	tva_header();

//--------------------------------------------------------------
//	Navigation dropdown with Superfish
//--------------------------------------------------------------
	function tva_superfish() {
		var $menu = $( '#navigation ul.sf-menu' )

		$menu.superfish({
			delay: 500,
			animation: { opacity: 'show', height: 'auto' },
			speed: 400,
			dropShadows: false,
			autoArrows: false
		});

	}
	tva_superfish();

//--------------------------------------------------------------
//	Mobile navigation
//--------------------------------------------------------------	
	// Trigger
	function tva_mobilenav_trigger() {
		var $trigger = $( 'a.navigation-trigger' );
		
		if( $(window).width() < 1023 ) {

			$trigger.show();

		} else  {

			$trigger.hide();

		}

	}
	tva_mobilenav_trigger();

	// Menu
	function tva_mobilenav_menu() {
		var $menu = $( '#mobile-navigation-wrap' );
		
		if( $(window).width() < 1023 ) {

			$menu.hide();

		} else  {

			$menu.hide();

		}

	}
	tva_mobilenav_menu();

	// Event
	function tva_mobilenav() {
		var $trigger = $( 'a.navigation-trigger' );
		var $menu	 = $( '#mobile-navigation-wrap' );

		$trigger.click( function(e) {

			$menu.slideToggle( 500 );

			e.preventDefault();

		});

	}
	tva_mobilenav();
	
//----------------------------------------------------------------------------------------------------------------------------
//	Biography
//----------------------------------------------------------------------------------------------------------------------------
	function tva_bio() {
		var $bio	= $( '#biography' );
		var $logo 	= $( '#logo-wrap' );
		var $avatar = $( '#logo img' );

		if( $(window).width() > 1023 ) {

		$avatar.hover( function() {

			$logo.css( 'z-index', '1010' );
			$bio.css( 'z-index', '1009' );
			$bio.fadeIn( 500 );

		}, function() {

			$logo.css( 'z-index', '1002' );
			$bio.css( 'z-index', '1001' );
			$bio.fadeOut( 500 );

		});
		
		}

	}
	tva_bio();

//--------------------------------------------------------------
//	Subheader Widgets
//--------------------------------------------------------------	
	function tva_subheaderWidgets() {
		var $trigger 			= $( '.subheader-widgets-trigger' );
		var $subheader_widgets 	= $( '#subheader-widgets' );

		$trigger.click( function(e) {

			if( $(this).hasClass( 'active' )) {
	
				$(this).removeClass( 'active' );
	
			} else {
	
				$(this).addClass( 'active' );
	
			}	
	
			$subheader_widgets.slideToggle( 500 );
	
			e.preventDefault();
	
		});

	}
	tva_subheaderWidgets();

//--------------------------------------------------------------
//	Styles drop-down
//--------------------------------------------------------------	
	//-------------------------------
	// Alert
	//-------------------------------
	$( '.alert .closealert' ).click( function(e) {
		$(this).parent('.alert').fadeTo(400, 0).slideUp();

		e.preventDefault();

	});

	//-------------------------------
	// Toggle
	//-------------------------------
	$( '.tva-toggle-trigger' ).click( function(e) {
		// Add 'active' class for active toggle
		if( $(this).hasClass( 'active' )) {
			$(this).removeClass( 'active' );
		} else {
			$(this).addClass( 'active' );
		}

		// Make sure we can have multiple toggles on one page
		$(this).parent().nextAll( '.tva-toggle-content' ).first().slideToggle( 'slow' );

		e.preventDefault();
	});

//--------------------------------------------------------------
//	Validate forms
//--------------------------------------------------------------	
	if( $().validate ) {
		$( '#contactform' ).validate();
		$( '#commentform' ).validate();
	}

//----------------------------------------------------------------------------------------------------------------------------
//	Resize
//----------------------------------------------------------------------------------------------------------------------------
    $(window).resize(function() {
	    tva_mobilenav_trigger();
	    if( $(window).width() > 1023 ) {
			tva_mobilenav_menu();
		}
    });


//----------------------------------------------------------------------------------------------------------------------------
//
//	Load JS functions on window load
//
//----------------------------------------------------------------------------------------------------------------------------


//----------------------------------------------------------------------------------------------------------------------------
//	Read more
//----------------------------------------------------------------------------------------------------------------------------

	function tva_read_more() {

		var $hoverItem = $( '.post' );

		if( $(window).width() > 1023 ) {

			$hoverItem.hover( function() {
	
				var $readmore = $(this).find( '.read-more' );
	
				$readmore.fadeIn( 500 );
	
			}, function() {
	
				var $readmore = $(this).find( '.read-more' );	
	
				$readmore.fadeOut( 500 );
	
			});
		
		}

	}

	//tva_read_more();



//--------------------------------------------------------------
// Post Like
//--------------------------------------------------------------

	function tva_postlike() {

		var $post_like = $( '.post-like a' );

		$post_like.click( function(e) {

			heart = $(this);
			post_id = heart.data( "post_id" );

			$.ajax({
				type: "post",
				url: ajax_var.url,
				data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
				success: function(count) {
					if( count != "already" ) {
						heart.addClass( "voted" );
						heart.children( '.nolikeyet' ).remove();
						heart.siblings( ".count" ).text(count);
					}
				}
			});

			e.preventDefault();
			
		});

	}

	//tva_postlike();



//--------------------------------------------------------------
//	Make embedded YouTube and Vimeo videos play nice!
//--------------------------------------------------------------	

	function tva_fitVids() {

		var $video = $( '.entry-video' )

		$video.fitVids();
	
	}

	//tva_fitVids();



//--------------------------------------------------------------
//	prettyPhoto
//--------------------------------------------------------------	

	function tva_prettyPhoto() {

		$( "a[data-gal^='prettyPhoto']" ).prettyPhoto({
			animationSpeed: 'fast',
			autoplay_slideshow: false,
			opacity: 0.90,
			show_title: true,
			allow_resize: true,
			hideflash: true,
			autoplay: false,
			overlay_gallery: false,
			theme: 'pp_default',
			social_tools: false
		});
	
	}

	//tva_prettyPhoto();



//----------------------------------------------------------------------------------------------------------------------------
//	Flexslider
//----------------------------------------------------------------------------------------------------------------------------

	function tva_flexslider() {

		var $post = $( '.post' );

		$post.each(function() {
		
		$currentSlider = $(this);
		
			$currentSlider.find( '.flexslider' ).each(function(){
		
				$(this).flexslider({

					animation: $(this).data( 'animation' ),
					animationSpeed: 1500,
					slideshow: $(this).data( 'slideshow' ),
					slideshowSpeed: 5000,
					animationLoop: true,
					controlNav: false,
					directionNav: true,
					touch: true,
					smoothHeight: true,
					start: function(slider) {
						$( '#slider-'+$(this).data( 'id' ) ).removeClass( 'loading' );
					}

				});
			
			});
		
		});
		
	}

	//tva_flexslider();



//----------------------------------------------------------------------------------------------------------------------------
//	Audio Player
//----------------------------------------------------------------------------------------------------------------------------

	function tva_audio() {

		$( '.post' ).each( function() {

			$currentAudio = $(this);
			$currentAudio.find( '.jp-jplayer-audio' ).each( function() {

				$(this).jPlayer( {
					ready: function () {

						$(this).jPlayer( "setMedia", {
							m4a: $(this).data( 'src-mp3' ),
							oga: $(this).data( 'src-ogg' )
						});

					},
					swfPath: tva_theme_uri + "/js/jplayer",
					cssSelectorAncestor: "#jp_container_" + $(this).data( 'id' ),
					supplied: "m4a, oga",
					wmode: "window"

				});

			});

		});

	}

	//tva_audio();



//----------------------------------------------------------------------------------------------------------------------------
//	Video Player
//----------------------------------------------------------------------------------------------------------------------------

	function tva_video() {

		$( '.post' ).each(function() {

			$currentVideo = $(this);
			$currentVideo.find( '.jp-jplayer-video' ).each( function() {

				$(this).jPlayer({
					ready: function () {

						$(this).jPlayer( "setMedia", {
							m4v: $(this).data( 'src-m4v' ),
							ogv: $(this).data( 'src-ogv' ),
							poster: $(this).data( 'poster' )
						});

					},						
					size: {

						width: '100%',
						height: 'auto'

					},			
					swfPath: tva_theme_uri + "/js/jplayer",
					cssSelectorAncestor: "#jp_container_" + $(this).data( 'id' ),
					supplied: "m4v, ogv"
				});

			});

		});

	}

	//tva_video();



//----------------------------------------------------------------------------------------------------------------------------
//	Indicators
//----------------------------------------------------------------------------------------------------------------------------

	function tva_indicator() {

		var post = $( '#content #isotope' ).find( '.post' );

		$.each( post, function( i,obj ) {
		
			var posLeft = $( obj ).css( 'left' );
			
			if( posLeft == '0px' ) {

				$(obj).addClass( 'item-left' );

			} else {

				$(obj).addClass( 'item-right' );

			}

		});

	}

	//tva_indicator();



//----------------------------------------------------------------------------------------------------------------------------
//	Isotope Grid
//----------------------------------------------------------------------------------------------------------------------------

	function tva_isotope() {

		$( function() {

			var $container = $( '#content .isotope' );
			$( '#content .isotope' ).isotope({ itemSelector: '.post', transformsEnabled: false, animationEngine: 'jquery', animationOptions: { duration: 300, easing: 'swing', queue: false } }, function() { tva_indicator(); });

		});
	
	}

	$( '#loading' ).fadeOut( 'slow' );

	tva_read_more();
	tva_postlike();
	tva_fitVids();
	tva_prettyPhoto();
	tva_flexslider();
	tva_audio();
	tva_video();
	tva_isotope();



//----------------------------------------------------------------------------------------------------------------------------
//	Load more
//----------------------------------------------------------------------------------------------------------------------------

function tva_getposts( pageNum, max, nextLink, count ) {
	if (typeof(tva_loadmore) == 'undefined') {
		return;
	}
	
	if( !pageNum ) {
		var pageNum = parseInt(tva_loadmore.startPage) + 1;
	}

	if( !max ) {
		var max = parseInt(tva_loadmore.maxPages);
	}

	if( !nextLink ) {
		var nextLink = tva_loadmore.nextLink;
	}

	if( !count ) {
		var count = parseInt( $( '.count' ).text());
	}

	var $isotope 		= $( '#content .isotope' );
	var $isotope_new	= $( '#content .isotope-new' );
	var $post			= $( '.post' );
	var $button_load 	= $( '#load-posts a.load-more' );
	var $button_top 	= $( '#load-posts a.to-the-top' );
	var $pagination		= $( '#content #page-navigation' );
	var $loading 		= $( '#loading-isotope' );
	

	if( pageNum <= max ) {

		$pagination.addClass( 'inactive' );

	} else {
		
		$button_load.css( 'display', 'none' );
		$button_top.css( 'display', 'block' );
		
	}

	$button_load.click( function(e) {

		$(this).unbind( 'click', tva_getposts() );
			
		if( pageNum <= max ) {

			$loading.fadeIn( 'slow' );

			$isotope_new.load( nextLink + ' .post', function() {

				var $newEls = $( '#content .isotope-new .post' );

				$newEls.imagesLoaded( function() {

					$isotope.append( $newEls ).isotope( 'appended', $newEls, function() {

						var $scroll = $post.last().next( $post );

						pageNum++;
						nextLink = nextLink.replace( /\/page\/[0-9]?/, '/page/' + pageNum );

						$( 'html, body' ).animate({
			                scrollTop: $scroll.offset().top -100
			            }, 500);

						if( pageNum <= max ) {

							$loading.fadeOut( 200, function () {
		
								$button_load.bind( 'click', tva_getposts( pageNum, max, nextLink, count) );
								$loading.fadeOut( 200 );
												
							});

						} else {
									
							$loading.fadeOut( 200, function () {
		
								$button_load.bind( 'click', tva_getposts( pageNum, max, nextLink, count ) );
								$loading.fadeOut( 200 );

								$button_top.css( 'display', 'block' );

							});

						}

					});

					// After append
					tva_read_more();
					tva_postlike();
					tva_indicator();
					tva_fitVids();
					tva_prettyPhoto();
					tva_audio();
					tva_video();
					tva_flexslider();
					tva_isotope();

				});

			});

		}

		e.preventDefault();

	});

}
	
tva_getposts();



//----------------------------------------------------------------------------------------------------------------------------
//	Scroll to the top
//----------------------------------------------------------------------------------------------------------------------------

function tva_scrolltop() {}

	var $link = $( 'a[href="#top"]' );
	var $body = $( 'html, body' );

	$link.click( function(e) {

		$body.animate( { scrollTop: 0 }, 1000 );

		e.preventDefault();

	});

tva_scrolltop();



//----------------------------------------------------------------------------------------------------------------------------
//	Resize
//----------------------------------------------------------------------------------------------------------------------------

    $(window).resize( function() {

	   // tva_read_more();
		tva_postlike();
		tva_fitVids();
		tva_prettyPhoto();
		tva_flexslider();
		tva_audio();
		tva_video();
		tva_indicator();
		tva_isotope();
		//tva_getposts();

    });


//----------------------------------------------------------------------------------------------------------------------------
//	That's all folks! (We can stop rollin now)
//----------------------------------------------------------------------------------------------------------------------------
