/**
	* @package Blitz
	* @subpackage Blitz HTML
	* @since Blitz HTML 1.0
	* 
	* Template Scripts
	* Created by dan_fisher

	Custom JS
	
	1. Main Navigation
	2. Flexslider
	3. Tabs (Tabbed Content)
	4. Accordion
	5. Flickr
	6. Isotope
	7. Magnific Popup
	-- Misc
	8. Carousel
*/

jQuery(function($){

	/* ----------------------------------------------------------- */
	/*  1. Main Navigation
	/* ----------------------------------------------------------- */

	$('ul.sf-menu').superfish({
		cssArrows:    false,
		delay			: 800,
		animation	: {opacity:'show', height:'show'},
		speed			: 'fast'
	});

	/* Mobile Menu */
	$('nav.primary .sf-menu').mobileMenu({
		defaultText: 'Navigate to...'
	});


	/* ----------------------------------------------------------- */
	/*  2. Flexslider
	/* ----------------------------------------------------------- */

	$('.flexslider__nav-on').flexslider({
		animation: "fade",
		directionNav: true,
		prevText: "<i class='icon-chevron-left'></i>",
    	nextText: "<i class='icon-chevron-right'></i>",
		slideshowSpeed: 6000,
		start: function(slider){
			jQuery('.flexslider__nav-on').removeClass('loading');
		}
	});


	/* ----------------------------------------------------------- */
	/*  3. Tabs (Tabbed Content)
	/* ----------------------------------------------------------- */

	$(".tabs").each(function(){

		$(this).find(".tab").hide();
		$(this).find(".tab-menu li:first a").addClass("active").show();
		$(this).find(".tab:first").show();

	});

	$(".tabs").each(function(){

		$(this).find(".tab-menu a").click(function() {

			$(this).parent().parent().find("a").removeClass("active");
			$(this).addClass("active");
			$(this).parent().parent().parent().parent().find(".tab").hide();
			var activeTab = $(this).attr("href");
			$(activeTab).fadeIn();
			return false;

		});

	});


	/* ----------------------------------------------------------- */
	/*  4. Accordion (Toggle)
	/* ----------------------------------------------------------- */

	(function() {
		var $container = $('.acc-body'),
			$acc_head   = $('.acc-head');

		$container.hide();
		$acc_head.first().addClass('active').next().show();
		$acc_head.last().addClass('last');
		
		$acc_head.on('click', function(e) {
			if( $(this).next().is(':hidden') ) {
				$acc_head.removeClass('active').next().slideUp(300);
				$(this).toggleClass('active').next().slideDown(300);
			}
			e.preventDefault();
		});

	})();


	/* ----------------------------------------------------------- */
	/*  5. Flickr
	/* ----------------------------------------------------------- */
	
	$('#flickr').jflickrfeed({
		limit: 6,
		qstrings: {
			id: '52617155@N08'
		},
		itemTemplate: '<li><a class="flickr-widget_thumb_holder" href="{{link}}" target="_blank"><img src="{{image_s}}" alt="{{title}}" width="59" height="59" /></a></li>'
	}, 
	function(data) {
		$("#flickr li:nth-child(3n)").addClass("nomargin");
	});


	/* ----------------------------------------------------------- */
	/*  6. Isotope
	/* ----------------------------------------------------------- */

    (function() {

        // modified Isotope methods for gutters in masonry
        $.Isotope.prototype._getMasonryGutterColumns = function() {
            var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
                containerWidth = this.element.width();
          
            this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth ||
                        // or use the size of the first item
                        this.$filteredAtoms.outerWidth(true) ||
                        // if there's no items, use size of container
                        containerWidth;

            this.masonry.columnWidth += gutter;

            this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
            this.masonry.cols = Math.max( this.masonry.cols, 1 );
        };

        $.Isotope.prototype._masonryReset = function() {
            // layout-specific props
            this.masonry = {};
            // FIXME shouldn't have to call this again
            this._getMasonryGutterColumns();
            var i = this.masonry.cols;
            this.masonry.colYs = [];
            while (i--) {
                this.masonry.colYs.push( 0 );
            }
        };

        $.Isotope.prototype._masonryResizeChanged = function() {
            var prevSegments = this.masonry.cols;
            // update cols/rows
            this._getMasonryGutterColumns();
            // return if updated cols/rows is not equal to previous
            return ( this.masonry.cols !== prevSegments );
        };


        // Set Gutter width
        var gutterSize;

        function getWindowWidth() {
            if( $(window).width() < 480 ) {
                gutterSize = 10;
            } else if( $(window).width() < 768 ) {
                gutterSize = 10;
            } else if( $(window).width() < 980 ) {
                gutterSize = 20;
            } else {
                gutterSize = 20;
            }
        }


        // Portfolio settings
        var $container          = $('.project-feed');
        var $filter             = $('.project-feed-filter');

        $(window).smartresize(function(){
            getWindowWidth();
            $container.isotope({
						filter              : '*',
						resizable           : true,
						// set columnWidth to a percentage of container width
						masonry: {
						gutterWidth     : gutterSize
               }
            });
        });

        $container.imagesLoaded( function(){
            $(window).smartresize();
        });

        // Filter items when filter link is clicked
        $filter.find('a').click(function() {
            var selector = $(this).attr('data-filter');
            $filter.find('a').removeClass('current');
            $(this).addClass('current');
            $container.isotope({ 
                filter             : selector,
                animationOptions   : {
                animationDuration  : 750,
                easing             : 'linear',
                queue              : false,
                }
            });
            return false;
        });
       
	})();


	/* ----------------------------------------------------------- */
	/*  7. Magnific Popup
	/* ----------------------------------------------------------- */
	$('.popup-link').magnificPopup({
		type:'image',
		// Delay in milliseconds before popup is removed
		removalDelay: 300,

		// Class that is added to popup wrapper and background
		// make it unique to apply your CSS animations just to this exact popup
		mainClass: 'mfp-fade'
	});


	/* ----------------------------------------------------------- */
	/*  Misc
	/* ----------------------------------------------------------- */
	$(".list-elements .item:nth-child(5n)").addClass("fifth");

	$(".video-holder").fitVids();

	
});



/* ----------------------------------------------------------- */
/*  6. Carousel
/* ----------------------------------------------------------- */
jQuery(window).load(function() {

	/* Project Carousel */
	var projectsCarousel = jQuery("#projects-scroller");
	projectsCarousel.carouFredSel({
		responsive : true,
		width: '100%',
		items : {
			width : 240,
			height: 'variable',
			visible : {
				min : 1,
				max : 5
			},
			minimum: 1
		},
		scroll: {
			items: 1,
			fx: "scroll",
			easing: "swing",
			duration: 500,
			queue: true
		},
		auto: false,
		next: "#next2",
		prev: "#prev2",
		swipe:{
			onTouch: false
		}
	});

	/* Clients Carousel */
	var clientsCarousel = $("#clients");
	clientsCarousel.carouFredSel({
		responsive : true,
		width: '100%',
		items : {
			width : 200,
			height: 'variable',
			visible : {
				min : 1,
				max : 5
			},
			minimum: 1
		},
		scroll: {
			items: 1,
			fx: "scroll",
			easing: "swing",
			duration: 500,
			queue: true
		},
		auto: false,
		next: "#next1",
		prev: "#prev1",
		swipe:{
			onTouch: false
		}
	});
});