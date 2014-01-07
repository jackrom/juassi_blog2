bplist00—_WebMainResource’	
_WebResourceMIMEType_WebResourceTextEncodingName_WebResourceFrameName^WebResourceURL_WebResourceData_application/x-javascriptUUTF-8P_ihttp://theme.crumina.net/onetouch/wp-content/themes/theme_v_1.tmp/inc/custom_style/assets/custom_style.jsO!«<html><head></head><body><pre style="word-wrap: break-word; white-space: pre-wrap;">jQuery(document).ready(function($){

    var imagesForPreload = new Array(customStyleImgUrl + 'title-icon2.png');
    $(".pattern-select:eq(0) .pattern-example.pic img").each(function(){
        imagesForPreload.push( $(this).attr("src") );
    });

    preload( imagesForPreload );

    if( jQuery(window).width() &gt; 1200 ){
        jQuery("#custom-style").show();
    }
    else {
        jQuery("#appear_icon").hide();
    }
    /*Setting clorpicker*/
    colorpicker = $.farbtastic("#custom-style-colorpicker");
    $("#custom-style-colorpicker").append("&lt;a class='close'&gt;X&lt;/a&gt;");

	jQuery("#tempate-switcher").show();
	
    $("#custom-style-wrapper").on({
        mouseenter:function(){
            $(this).stop();
            $(this).animate({left:0},'fast');
        },
        mouseleave:function(){
            $(this).stop();
            $(this).animate({left:"-290px"},'fast');
            $("#custom-style-colorpicker").hide();
            $(".pattern-select").hide();
            $(".pattern-example.image img").attr("src", customStyleImgUrl + 'title-icon.png');
        }
    });

    $(".template-option").each(function(){
        if( $(this).attr('href') == location.href ){
            $(this).find('img').attr("src", customStyleImgUrl + 'checkbox_1.png' )
        }
    });

    $("#custom-style-colorpicker a.close").on("click",function(){
        $("#custom-style-colorpicker").hide();
    });

    $(".pattern-example.image, span.bg-title").on({
        mouseenter : function(){


            var current_pattterns = $(this).closest("li").find(".pattern-select");
            current_pattterns.show();
            $(".pattern-select").not(current_pattterns).hide();

            $(".pattern-example.image img").attr("src", customStyleImgUrl + 'title-icon.png');
            $(this).closest("li").find('.pattern-example.image img').attr("src", customStyleImgUrl + 'title-icon2.png');

            $("span.bg-title").css("color","#ffffff");
            $(this).closest("li").find("span.bg-title").css("color","#c6edff");
        }
    });

    $(".pattern-select").on({
        mouseleave:function(){
            $(this).hide();
            $(".pattern-example.image img").attr("src",customStyleImgUrl + 'title-icon.png');
        }
    });

    /*Background image switching*/
    $(".pattern-example.pic").on("click", function(){
        $(this).closest(".pattern-select").find(".pattern-example.pic").removeClass("current");
        $(this).addClass("current");
        var selector = $(this).closest("li").data("selector");
        var pic = $(this).find("img").attr("src");
        $(selector).css("background-image", "url(" + pic.split("thumb/").join("") + ")").css("background-repeat","repeat");

    });


    $(".boxed-switcher").on("click",function(){
        var img_url = $(".wrapper-switch").data("checkbox");
        $(".boxed-switcher").find("img").attr("src", img_url + 'checkbox_2.png');
        $(this).find("img").attr("src", img_url + 'checkbox_1.png');
    });

    $("a.menu-option").on("click",function(){
        $("a.menu-option").find('img').attr("src", customStyleImgUrl + 'checkbox_2.png');
        $(this).find('img').attr("src", customStyleImgUrl + 'checkbox_1.png');
        var size = $(this).data("size");
        if( size == 'dropdown'){
            $(".tiled-menu").addClass("drop");
        } else {
            $(".tiled-menu").removeClass("drop");
        }
    });

    //Initializng color of controls
    //according to blocks color

    $(".pattern-example.color").on("click", function(){
        $("#custom-style-colorpicker").show();
        $this = $(this);
        var selector = $this.closest("li").data("selector");
        colorpicker.linkTo(function(){
            $(selector).css("background-color",colorpicker.color);
        });
        try{
            colorpicker.setColor( rgb2hex( $(selector).css("background-color") ) );
        } catch (e){
            console.log($(selector).css("background-color"));
        }

        $(".pattern-example.color").removeClass("active");
        $(this).addClass("active");
        $(selector).css("background-image","none");
    });

    $(".boxed-switcher").on("click",function(){
        $(".boxed-switcher").removeClass("active");
        $(this).addClass("active");
        var boxed = $(this).data("wrap");
        if( boxed== 'wrap-1'){
            $("#body-wrapper").css({margin:"0 auto",maxWidth:"1200px"});
            $("body").css("padding-top","0px");
        }
        else if(boxed == 'wrap-2'){
            $("#body-wrapper").css({margin:"0px auto 45px auto",maxWidth:"1240px",
                padding: "10px 20px",
                webkitBoxShadow:"0px 0px 6px 0px rgba(0, 0, 0, 0.2)",
                boxShadow:"0px 0px 6px 0px rgba(0, 0, 0, 0.2)"
            });
            $("body").css("padding-top","20px");
        }
        else{
            $("#body-wrapper").css({margin:"0",maxWidth:"none",
                padding: "0 0 45px 0",
                webkitBoxShadow:"none",
                boxShadow:"none"
            });
            $("body").css("padding-top","0px").css("background","none");
        }
    });

    content_width = parseInt($(".scroll-box").closest(".fifteen").width())+ 20;


    $(".slider-switcher").on("click",function(){
        $(".slider-switcher").removeClass("current");
        $(this).addClass("current");
        var boxed = $(this).data("size");
        var content_width = 1180;
        var indent = ( jQuery(window).width() - content_width )/2;
        console.log( indent );
        if( boxed == 'full') {
            $(".scroll-box")
                .css( "width", ($(window).width() - 2) + "px" )
                .css("margin-left", "-"+indent+"px") ;
        } else if(boxed == 'boxed') {
            $(".scroll-box")
                .css( "width",parseInt(content_width - 2) + "px" )
                .css("margin-left", 0);
        }   else if(boxed == 'right') {
            $(".scroll-box")
                .css("width", parseInt( content_width + indent - 2 ) + "px")
                .css("margin-left", 0);
        }

        $(".scroll-box").getNiceScroll().resize();
        $(".scroll-box").scrollTop($(".scroll-box").scrollTop() + 100);
        $(".scroll-box").scrollTop($(".scroll-box").scrollTop() - 100);

    });
});

jQuery(window).load(function(){

    var defaults = {
        slider:{
            row:{
                maxWidth: $(".scroll-box").closest(".row").css("max-width"),
                width: $(".scroll-box").closest(".row").css("width"),
                padding: $(".scroll-box").closest(".row").css("padding")
            },
            fifteen:{
                maxWidth: $(".scroll-box").closest(".fifteen").css("max-width"),
                padding: $(".scroll-box").closest(".fifteen").css("padding")
            },
            scrollBox:{
                maxWidth:$(".scroll-box").css("max-width"),
                padding: $(".scroll-box").css("padding"),
                width: $(".scroll-box").css("width")
            }
        },
        bodyWrapper:{
            margin:jQuery("#body-wrapper").css("margin"),
            maxWidth:jQuery("#body-wrapper").css("max-width")
        },
        body:jQuery("body").css("background"),
        footer:jQuery("#darkf").css("background"),
        body_wrapper:jQuery("#body-wrapper").css("background")
    };

    jQuery('#load_defaults_settings').on("click",function(){
        jQuery("body").css("background",defaults['body']);
        jQuery("#darkf").css("background",defaults['footer']);
        jQuery("#body-wrapper").css("background",defaults['body_wrapper']);

        jQuery("#body-wrapper").css("margin",defaults['bodyWrapper']['margin']);
        jQuery("#body-wrapper").css("max-width",defaults['bodyWrapper']['maxWidth']);
        jQuery(".slider-switcher:eq(0)").click();
        jQuery(".boxed-switcher:eq(0)").click();
        jQuery(".menu-option:eq(0)").click();

        return false;
    });
});

/*RGB to HEX */
var hexDigits = new Array
    ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");


function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}

function preload(arrayOfImages) {
    $(arrayOfImages).each(function(){
        $('&lt;img/&gt;')[0].src = this;
        // Alternatively you could use:
        // (new Image()).src = this;
    });
}</pre></body></html>    ( > \ s Ç î Ø µ ∂"                           "Ì