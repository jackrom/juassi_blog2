/**
 * Created with JetBrains PhpStorm.
 * User: Office
 * Date: 11.12.12
 * Time: 10:39
 * To change this template use File | Settings | File Templates.
 */

jQuery(document).ready(setVisibleScrollBoxWidth);
jQuery(window).load(setPortfolioBlocksWidth);

jQuery("#portfolio-page dl.tabs dd>a").on("click",function(){
    setTimeout(setPortfolioBlocksWidth, 100);
});

function setPortfolioBlocksWidth(){
    setVisibleScrollBoxWidth();
    setVisibleWrapWidth();
}

function setVisibleScrollBoxWidth() {
    var scrollbox = jQuery(".scroll-box");
    var boxed = jQuery("#portfolio-page").data("boxed");
    var countElements = jQuery(".scroll-box .grid .gr-box:visible").size();
    jQuery(".scroll-box .grid").width(countElements * 728);
    var indent = ( jQuery(window).width() - jQuery(".tabs-content > li > .wrap").width() ) / 2;
    scrollbox.width(jQuery(".fifteen.columns>.wrap").width() + indent);
}

//Sets width of wrap around visible scroll
function setVisibleWrapWidth(){
    var scrollbox = jQuery(".scroll-box");
    var boxed = jQuery("#portfolio-page").data("boxed");

    if( boxed == 'full-width') {
        scrollbox.closest(".wrap").width( jQuery(window).width() );
        scrollbox.width( jQuery(window).width() );
    } else if(  boxed == 'left-boxed' ){
        jQuery("ul.tabs-content .wrap").each(function(){
            if ( jQuery(this).is(":visible") ){
                var containerWidth = jQuery(this).width();
                var windowWidth = jQuery(window).width();
                var indent = windowWidth - containerWidth;
                jQuery(this).width(containerWidth + indent/2 - 10);
                jQuery(this).find(".scroll-box").width(containerWidth + indent/2 - 10 );
            }
        });
    } else if( boxed == 'boxed' ){
        scrollbox.closest(".wrap").addClass('row');
        scrollbox.css("width", "100%");
    }
}

