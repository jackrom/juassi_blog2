jQuery(document).ready(function () {

    jQuery(".scroll-box").each(function () {

        var scrollWrapper = jQuery(this);
        var scrollContent = jQuery(this).find('.grid');
        var slide_color = jQuery(".scroll-box").data("color");
        var countElements = jQuery(this).find(".grid .gr-box").size();

        jQuery(scrollContent).width(countElements * 728);

        var scrollbox = jQuery(this);
        var indent = (jQuery(window).width() - jQuery(".fifteen.columns>.wrap").width() ) / 2;


        setBoxedSlider();

        if (jQuery(this).is("#no-scrolling-sider")) {
            try {
                scrollWrapper.niceScroll({
                    cursorcolor:slide_color,
                    cursorwidth:"16px",
                    cursorborder:"none",
                    cursorborderradius:"0px",
                    cursoropacitymin:"1",
                    background:"#f0f3f4",
                    enablemousewheel:false,
                    railpadding:{top:"20px"}
                }).rail.css({'height':'15px'});
            } catch (e) {
                console.log("Seems scrolling works wrong.");
            }

        } else {
            try {
                scrollWrapper.niceScroll({
                    cursorcolor:slide_color,
                    cursorwidth:"16px",
                    cursorborder:"none",
                    cursorborderradius:"0px",
                    cursoropacitymin:"1",
                    background:"#f0f3f4",
                    railpadding:{top:"20px"}
                }).rail.css({'height':'15px'});
            } catch (e) {
                console.log("Seems scrolling works wrong.");
            }
        }
    });

});

jQuery(window).resize(function () {
    setBoxedSlider();
    setBoxedSlider();
});

function setBoxedSlider() {

    scrollbox = jQuery(".scroll-box");

    if (scrollbox.data("boxed") == "3") {
        var marginLeft = jQuery('.fifteen.columns').width();
        marginLeft = (jQuery(window).width() - marginLeft) / 2

        scrollbox.width(jQuery(window).width());

        if (marginLeft > 0)
            scrollbox.closest(".wrap").css("margin-left", (-marginLeft) + "px");
        scrollbox.closest(".wrap").width(jQuery(window).width());
    }
    else if (scrollbox.data("boxed") == "1") {
        scrollbox.closest(".wrap").css("width", "100%");
        scrollbox.css("width", "100%");
    }
    else if (scrollbox.data("boxed") == "2") {

        scrollbox.closest(".wrap").css("width", "100%");
        scrollbox.css("width", "100%");
        var indent = jQuery(window).width() - jQuery(".fifteen").width();

        scrollbox.width(jQuery(".fifteen").width() + indent / 2 + 9);
    }
    scrollbox.getNiceScroll().resize();
}
