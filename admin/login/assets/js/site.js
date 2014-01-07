
jQuery('#show-social').click(function() {
    var soc_icons = jQuery('#top-social .soc-icons');
    var visible = ( soc_icons.width() != 0 );

    if(visible){
        jQuery(this).find('span.txt').html(jQuery(this).data("expand"));
        soc_icons.animate({width:0},'slow');
    } else {
        jQuery(this).find('span.txt').html(jQuery(this).data("close"));
        soc_icons.animate({width:"100%"},'slow');
    }
    return false;
});

/*---------------------------------
 MENU Dropdowns
 -----------------------------------*/

jQuery('.tiled-menu li').hover(function(){
        jQuery(this).find('ul:first').show();
        jQuery(this).addClass('hover');

        var soc_icons_open = jQuery('#top-social');
        if (soc_icons_open.hasClass("opened-social-icons")){

        } else {
            jQuery('#show-social').find('span.txt').html(jQuery(this).data("expand"));
            jQuery('.soc-icons').animate({width:0},'fast');
        }




    },
    function(){
        jQuery(this).find('ul').hide();
        jQuery(this).removeClass('hover');
    });


//ipad and iphone fix
// using jQuery 1.7.x (on method instead bind)
if ( (navigator.userAgent.match(/iPhone/i))
    || (navigator.userAgent.match(/iPod/i) )
    || (navigator.userAgent.match(/iPad/i)))
{

    jQuery("li.dropdown").on('touchstart', function(){
        jQuery("li.dropdown").removeClass('hover').find('ul').stop(true, true).slideUp('200');
        jQuery(this).find('ul:first').stop(true, true).slideDown('150');
        jQuery(this).addClass('hover');
    });
}

//Higlighting first Tab of portfolio
jQuery(document).ready(function(){
    jQuery("#portfolio-page dl.tabs dd:eq(0)>a").click();
});


/*---------------------------------
 MENU Dropdowns
 -----------------------------------*/


jQuery(function () {


    jQuery("<select  />").appendTo("nav");


    jQuery("<option />", {
        "selected":"selected",
        "value":"",
        "text":"Go to page:"
    }).appendTo("nav select");


    jQuery("nav .link-text").each(function () {
        var el = jQuery(this);
        var link_text = el.text();
        if (jQuery(this).parent().parent().parent().parent().prop("tagName") == 'LI')
            link_text = ' - ' + link_text;
        jQuery("<option />", {
            "value":el.parent().attr("href"),
            "text":link_text
        }).appendTo("nav select");
    });

    jQuery("nav select").change(function () {
        window.location = jQuery(this).find("option:selected").val();
    });

});

/*---------------------------------
 Scroll To Top
 -----------------------------------*/

jQuery(".backtotop").addClass("hidden");
jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() === 0) {
        jQuery(".backtotop").addClass("hidden")
    } else {
        jQuery(".backtotop").removeClass("hidden")
    }
});

jQuery('#linkTop').click(function () {
    jQuery('body,html').animate({
        scrollTop:0
    }, 1200);
    return false;
});

// By Chris Coyier & tweaked by Mathias Bynens

jQuery(function() {

    // Find all YouTube videos
    var $allVideos = jQuery(".full-width iframe[src^='http://player.vimeo.com'], .full-width iframe[src^='http://www.youtube.com']"),

    // The element that is fluid width
        $fluidEl = jQuery("body");

    // Figure out and save aspect ratio for each video
    $allVideos.each(function() {

        jQuery(this)
            .data('aspectRatio', this.height / this.width)

            // and remove the hard coded width/height
            .removeAttr('height')
            .removeAttr('width');

    });

    // When the window is resized
    // (You'll probably want to debounce this)
    jQuery(window).resize(function() {

        var newWidth = $fluidEl.width();

        // Resize all videos according to their own aspect ratio
        $allVideos.each(function() {

            var $el = jQuery(this);
            $el
                .width(newWidth)
                .height(newWidth * $el.data('aspectRatio'));

        });

        // Kick off one resize to fix all videos on page load
    }).resize();

});


jQuery(document).ready(function(){
    jQuery("a.zoom").colorbox({rel:'group1', maxHeight:'85%', maxWidth:'90%'});
});
