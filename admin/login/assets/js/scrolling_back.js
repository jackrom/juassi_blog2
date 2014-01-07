jQuery(document).ready(function(){

jQuery( ".scroll-box" ).each(function() {

    scrollWrapper = jQuery(this);
    scrollContent = jQuery(this).find('.grid');

    if( !Modernizr.touch ){

        scrollWrapper.mousewheel(function(event, delta, deltaX, deltaY) {

            var currentScroll = parseInt( jQuery(this).scrollLeft());
            jQuery(this).scrollLeft( currentScroll + (-deltaY*100) );
            var finalRight = ((scrollContent.width() -   jQuery(this).scrollLeft()) == scrollWrapper.width());

            var finalLeft =  (jQuery(this).scrollLeft() == 0);
            if( finalRight && (deltaY < 0) ) {
                var windowScroll = jQuery(window).scrollTop();
                windowScroll +=50;
                jQuery(window).scrollTop(windowScroll);
            } else if(finalLeft && (deltaY > 0) ){
                var windowScroll = jQuery(window).scrollTop();
                windowScroll -=50;
                jQuery(window).scrollTop(windowScroll);
            }
            scrollWrapper.getNiceScroll().resize();
        });
    } else {
        jQuery(this).addClass("no-animation");
    }

    var slide_colour = jQuery("scroll-box").data("color");

    try{
        scrollWrapper.niceScroll({
            cursorcolor: slide_colour,
            cursorwidth:"16px",
            cursorborder:"none",
            cursorborderradius:"0px",
            cursoropacitymin:"1",
            background:"#f0f3f4",
            railpadding:{top:"20px"}
        }).rail.css({'height':'15px'});
    } catch(e){
        console.log("Seems scrolling works wrong.");
    }


    var countElements = jQuery(this).find(".grid .gr-box").size();
    jQuery(scrollContent).width(countElements*728);

    var scrollbox = jQuery(this);
    var indent = ( jQuery(window).width() - jQuery(".fifteen.columns>.wrap").width() ) / 2;

    setBoxedSlider();

    var animateTime = 1,
        offsetStep = 5;

    //event handling for buttons "left", "right"
    jQuery('.bttL')
        .mousedown(function() {
            scrollContent.data('loop', true).loopingAnimation(jQuery(this), jQuery(this).is('.bttR') );
        })
        .bind("mouseup mouseout", function(){
            //scrollContent.data('loop', false).stop();
        });

    jQuery.fn.loopingAnimation = function(el, dir){
        if(this.data('loop')){
            var sign = (dir) ? '-=' : '+=';
            this.animate({ marginLeft: sign + offsetStep + 'px' }, animateTime, function(){ jQuery(this).loopingAnimation(el,dir) });
        }
        return false;
    };
});

});

jQuery(window).resize(function(){
    setBoxedSlider();
    setBoxedSlider();
});

function setBoxedSlider(){

    scrollbox = jQuery(".scroll-box");

    if(scrollbox.data("boxed") == "3"){
        var marginLeft = jQuery('.fifteen.columns').width();
        marginLeft = (jQuery(window).width() - marginLeft)/2

        scrollbox.width(jQuery(window).width() );

        if(marginLeft > 0)
            scrollbox.closest(".wrap").css("margin-left",(-marginLeft)+"px");
        scrollbox.closest(".wrap").width(jQuery(window).width());
    }
    else if(scrollbox.data("boxed") == "1"){
        scrollbox.closest(".wrap").css("width","100%");
        scrollbox.css("width","100%");
    }
    else if(scrollbox.data("boxed") == "2") {

        scrollbox.closest(".wrap").css("width","100%");
        scrollbox.css("width","100%");
        var indent = jQuery(window).width() - jQuery(".fifteen").width();

        scrollbox.width(jQuery(".fifteen").width() + indent/2 + 9);
    }
    scrollbox.getNiceScroll().resize();
}


