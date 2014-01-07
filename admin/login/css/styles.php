<?php
//Function parses header styles

global $NHP_Options;




//Hx styling
for ($i = 1; $i <= 6; $i++) {
    ?>
h<?php echo $i; ?> {
<?php
    $font = parse_typo($data['h' . $i . '_typo'], $data['h' . $i . '_color']);
    ?>
<?php if($font['size'] != '.'){ ?>
    font-size:<?php echo $font['size']; ?>!important;
<?php } ?>
<?php if($font['family'] != '.'){ ?>
    font-family:<?php echo $font['family']; ?>!important;
<?php } ?>
<?php if($font['style'] != '.'){ ?>
    font-style:<?php echo $font['style']; ?>!important;
<?php } ?>
<?php if($font['weight'] != '.'){ ?>
    font-weight:<?php echo $font['weight']; ?>!important;
<?php } ?>
<?php if($font['color']){ ?>
    color: <?php echo $font['color']; ?>!important;
<?php } ?>
}

<?php }

if (($NHP_Options->get("main_site_color")!='57bae8') && ($NHP_Options->get("main_site_color")!='')){ ?>

.backtotop {
    background: url(../assets/img/top2.png) 0 0 no-repeat;
}
.backtotop:hover {
    background: url("../assets/img/top_hov2.png") 0 0 no-repeat;
}

/*Main color*/

#top-social span.icon, .tweet-list .tweet .icon, .tile-category-list .odd, .recent-tabs-widget .tabs .active a {

    background-color: <?php $NHP_Options->show("main_site_color");  ?>  !important;

}

.scroll-box::-webkit-scrollbar-thumb, .recent-tabs-widget .tabs dd.active a, .widget_price_filter .ui-slider .ui-slider-range,
.info-item.dark, .tiled-menu.drop li ul li, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-state-hover, .ui-widget-content .ui-state-hover
{
    background-color: <?php $NHP_Options->show("main_site_color");  ?> !important;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-accordion-header.ui-state-default, .ui-accordion-header.ui-state-hover, .ui-tabs-nav > .ui-state-default a,
.ui-tabs-nav > .ui-state-hover a, .ui-tabs-nav > .ui-state-focus a, .ui-dialog-titlebar, .ui-slider .ui-slider-range, .ui-progressbar .ui-progressbar-value, .ui-autocomplete .ui-state-hover,
.ui-datepicker .ui-datepicker-header, .ui-datepicker-calendar .ui-state-hover, .ui-datepicker-calendar .ui-state-active
{
    background-color: <?php $NHP_Options->show("main_site_color");  ?> !important;
}
.btn-primary, a.button.alt, button.button.alt, input.button.alt,#respond input#submit.alt, #content input.button.alt, .page-nav a, .navigation a, .page-numb a, .page-numb span,
.post-nav a, #map, a.button, button.button, input.button, #respond input#submit, #content input.button, #wp-submit {

    background-color: <?php $NHP_Options->show("main_site_color");  ?> !important;
}


.wpb_accordion .ui-accordion .ui-accordion-header {
border-left: 6px solid <?php $NHP_Options->show("main_site_color") ?> !important;
}
div.product .woocommerce_tabs ul.tabs li.active, #content div.product .woocommerce_tabs ul.tabs li.active, .tabs dd.active, .tabs li.active {
   border-color:<?php $NHP_Options->show("main_site_color") ?> !important;
}

.widget h3, .page-template-page-contacts-php h3 {
color:<?php $NHP_Options->show("main_site_color") ?>;
}

<?php }?>



<?php if (($NHP_Options->get("secondary_site_color")!='50a9d2') && ($NHP_Options->get("secondary_site_color")!='')){ ?>

/*Secondary color*/

.tile-category-list .even, .page-nav a:hover, .navigation a:hover, .page-numb a:hover,
.post-nav a:hover,  a.button:hover, button.button:hover, input.button:hover, #respond input#submit:hover, #content input.button:hover, #wp-submit:hover,
.btn-primary:hover, a.button.alt:hover, button.button.alt:hover, input.button.alt:hover,
#respond input#submit.alt:hover, #content input.button.alt:hover, .recent-tabs-widget .tabs a{
background: <?php $NHP_Options->show("secondary_site_color") ?> !important;
}

<?php }?>


<?php
if($data['body_font_color'] != '.'){
    echo "body, article{";
    echo "color:".$data['body_font_color'].";";
    echo "}";
}
if($data['body_font_size'] != '.'){
   echo "body, #content p, #content, #content div{";
   echo "font-size:".$data['body_font_size']."px;";
   echo "}";
    }

?>


a {
    color:<?php echo $data['main_link_color'] ?>;
}

a:hover {
    color:<?php echo $data['main_link_color_hover'] ?>;
}

body {
<?php
//Links styling
    if ($data['body_bg_color'] != '')
        echo "\tbackground-color:" . $data['body_bg_color']."!important;\n";
    if ($data['body_bg_image'] != '')
        echo "\tbackground-image:url(".$data['body_bg_image'].")!important;\n";
    if ($data['body_custom_repeat'] != '')
        echo "\tbackground-repeat:".$data['body_custom_repeat']."!important;\n";
    if ($data['body_bg_fixed'])
        echo "\tbackground-attachment:fixed!important;\n"; ?>
}
#body-wrapper{
    <?php
if( $data['site_boxed'] ) {
    echo "\tmargin:15px auto 45px auto;\n";
    echo "\tmax-width:1240px;\n";
    echo "\tpadding: 10px 20px;\n";
    echo "\t-webkit-box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.2);
box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.2);\n";

    if ($data['body_wrapper_bg_color'] != '')
        echo "\tbackground-color:" . $data['body_wrapper_bg_color']."!important;\n";
    if ($data['body_wrapper_bg_image'] != '')
        echo "\tbackground-image:url(".$data['body_wrapper_bg_image'].")!important;\n";
    if ($data['body_wrapper_custom_repeat'] != '')
        echo "\tbackground-repeat:".$data['body_wrapper_custom_repeat']."!important;\n";
}
?>
}

#darkf {
<?php
//Links styling
if ($data['footer_bg_color'] != '')
    echo "\tbackground-color:" . $data['footer_bg_color']."!important;\n";
if ($data['footer_font_color'] != '')
    echo "\tcolor:" . $data['footer_font_color']."!important;\n";
if ($data['footer_bg_image'] != '')
    echo "\tbackground-image:url(".$data['footer_bg_image'].")!important;\n";
if ($data['footer_custom_repeat'] != '')
    echo "\tbackground-repeat:".$data['footer_custom_repeat']."!important;\n";

?>
}

.scroll-box .item.even .description, .no-scroll .item.even .description, .item.even .description{<?php

if ($data['even_slider_elements_bgcolor'] != '')
    echo "\tbackground-color: " . $data['even_slider_elements_bgcolor'] . ";\n";
    $data['even_slider_elements_bgopacity'] = 87;
    echo "\tbackground-color:" .  hex_and_opacity_to_rgba($data['even_slider_elements_bgcolor'],$data['even_slider_elements_bgopacity']).";\n";
if ($data['even_slider_elements_textcolor'] != '')
    echo "\tcolor:" . $data['even_slider_elements_textcolor'].";\n";
?>
}

.scroll-box .item.even .description time, .no-scroll .item.even .description time, .item.even time{ <?php
if ($data['even_slider_elements_datecolor'] != '')
    echo "\tcolor:" . $data['even_slider_elements_datecolor'].";\n";
?>
}

.scroll-box .item.odd .description, .no-scroll .item.odd .description, .item .description{<?php

if ($data['odd_slider_elements_bgcolor'] != '')

    echo "\tbackground-color: " . $data['odd_slider_elements_bgcolor'] . ";\n";

    $data['odd_slider_elements_bgopacity'] = 87;
    echo "\tbackground-color:" . hex_and_opacity_to_rgba($data['odd_slider_elements_bgcolor'],$data['odd_slider_elements_bgopacity']).";\n";
if ($data['odd_slider_elements_textcolor'] != '')
    echo "\tcolor:" . $data['odd_slider_elements_textcolor'].";\n";
?>
}

.scroll-box .item.odd .description time, .no-scroll .item.odd .description time, .item .description time{ <?php
if ($data['odd_slider_elements_datecolor'] != '')
    echo "\tcolor:" . $data['odd_slider_elements_datecolor'].";\n";
?>
}

<?php
//Custom css
    echo str_replace("&gt;", ">", $data['custom_css']);
?>

<?php
    $blocks = (array)json_decode(str_replace( "+", "\"", $data["block_manager"]));
    foreach($blocks as $block){
        $block = (array)$block;
        echo "#".$block['id']."{\n";
        echo "\tbackground-color:".$block['color'].";\n";
        echo "\tbackground-image:url(".str_replace('">',"",str_replace('<img src="',"",$block['bgimage'])).");\n";
        echo "}\n";
    }
?>
<?php

if ($NHP_Options->get("main_menu_position")=='right'){
    echo'#topmenu .tiled-menu{float:right}';
}


//Function for color and opacity transform
function hex_and_opacity_to_rgba($hex, $opacity = '100') {
    if( !is_numeric($opacity) )
        $opacity = 100;

    $rgb = hex2RGB( $hex );
    return 'rgba('.$rgb['red'].','.$rgb['green'].','.$rgb['blue'].','.($opacity/100).')';
}

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}


?>



