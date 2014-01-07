<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: fi.php,v 1.58 2011/12/30 23:03:24 joku Exp $
 *  
 * Copyright (C) 2001-2012, the BBClone Team (see doc/authors.txt for details)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * See doc/copying.txt for details
 *
 * Translated by: Ville Pohjanheimo (vpohjanheimo on hotmail)
 */

// The DNS Extensions array
$extensions = array(
"travel" => "Travel",
"asia" => "Asia-Pacific",
"jobs" => "Employment",
"mobi" => "Mobiles",
"cat" => "Catalan",
"tel" => "Contacts",

"ac" => "Ascension Saaret",
"ad" => "Andorra",
"ae" => "Yhdistyneet Arabi Emiraatit",
"aero" => "Aero",
"af" => "Afghanistani",
"ag" => "Antigua and Barbuda",
"ai" => "Anguilla",
"al" => "Albania",
"am" => "Armenia",
"an" => "Alankomaiden Antilles",
"ao" => "Angola",
"aq" => "Etel&auml;manner",
"ar" => "Argentiina",
"arpa" => "Arpanet",
"as" => "Amerikan Samoa",
"at" => "It&auml;valta",
"au" => "Australia",
"aw" => "Aruba",
"ax" => "Ahvenanmaan maakunta",
"az" => "Azerbaijan",
"ba" => "Bosnia Herzegowina",
"bb" => "Barbados",
"bd" => "Bangladesh",
"be" => "Belgia",
"bf" => "Burkina Faso",
"bg" => "Bulgaria",
"bh" => "Bahrain",
"bi" => "Burundi",
"biz" => "Business",
"bj" => "Benin",
"bl" => "Saint-Barthélemy",
"bm" => "Bermuda",
"bn" => "Brunei",
"bo" => "Bolivia",
"br" => "Brasilia",
"bs" => "Bahamas",
"bt" => "Bhutan",
"bv" => "Bouvet saari",
"bw" => "Botswana",
"by" => "Belarus",
"bz" => "Belize",
"ca" => "Kanada",
"cc" => "Cocos Saaret",
"cd" => "Kongo",
"cf" => "Keskiafrikan tasavalta",
"cg" => "Kongo",
"ch" => "Sweitsi",
"ci" => "Norsunluurannikko",
"ck" => "Cook Saaret",
"cl" => "Chile",
"cm" => "Kameron",
"cn" => "Kiina",
"co" => "Kolumbia",
"com" => "Kaupallinen",
"coop" => "Coop",
"cr" => "Costa Rica",
"cs" => "Serbia and Montenegro",
"cu" => "Kuuba",
"cv" => "Cape Verde",
"cx" => "Joulusaaret",
"cy" => "Kypros",
"cz" => "Tsekki",
"de" => "Saksa",
"dj" => "Djibouti",
"dk" => "Tanska",
"dm" => "Dominica",
"do" => "Dominikaaninen Tasavalta",
"dz" => "Algeria",
"ec" => "Ecuadori",
"edu" => "Oppilaitos",
"ee" => "Eesti",
"eg" => "Egypti",
"eh" => "Western Sahara",
"er" => "Eritrea",
"es" => "Espanja",
"et" => "Etiopia",
"eu" => "European Union",
"fi" => "Suomi",
"fj" => "Fiji",
"fk" => "Falklandit",
"fm" => "Micronesia",
"fo" => "F&auml;rsaaret",
"fr" => "Ranska",
"ga" => "Gabon",
"gb" => "Yhdistyneet kuningaskunnat",
"gd" => "Grenada",
"ge" => "Georgia",
"gf" => "Ranskan Guiana",
"gg" => "Guernsey",
"gh" => "Ghana",
"gi" => "Gibraltari",
"gl" => "Gr&ouml;nlanti",
"gm" => "Gambia",
"gn" => "Guinea",
"gov" => "Hallitus",
"gp" => "Guadeloupe",
"gq" => "P&auml;iv&auml;ntasaajan Guinea",
"gr" => "Kreikka",
"gs" => "Etel&auml;-Georgia ja Etel&auml;-Sandwichin saaret",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guinea-Bissau",
"gy" => "Guyana",
"hk" => "Hong Kong",
"hm" => "Heardin and Mc Donaldin Saaret",
"hn" => "Honduras",
"hr" => "Kroatia",
"ht" => "Haiti",
"hu" => "Unkari",
"id" => "Indonesia",
"ie" => "Irlanti",
"il" => "Israel",
"im" => "Man-saari",
"in" => "Intia",
"info" => "Information",
"int" => "Kansainv&auml;linen",
"io" => "Britannian Intian valtameren territoriot",
"iq" => "Iraq",
"ir" => "Iran",
"is" => "Islanti",
"it" => "Italia",
"je" => "Jersey",
"jm" => "Jamaika",
"jo" => "Jordania",
"jp" => "Japani",
"ke" => "Kenia",
"kg" => "Kyrgyzstan",
"kh" => "Kamputsea",
"ki" => "Kiribati",
"km" => "Comoros",
"kn" => "Saint Kitts ja Nevis",
"kp" => "North Korea",
"kr" => "Korea",
"kw" => "Kuwait",
"ky" => "Cayman Saaret",
"kz" => "Kazakhstan",
"la" => "Laos",
"lb" => "Libanon",
"lc" => "Saint Lucia",
"li" => "Liechtenstein",
"lk" => "Sri Lanka",
"lr" => "Liberia",
"ls" => "Lesotho",
"lt" => "Liettua",
"lu" => "Luxemburg",
"lv" => "Latvia",
"ly" => "Libya",
"ma" => "Marokko",
"mc" => "Monako",
"md" => "Moldova",
"me" => "Montenegro",
"mf" => "Saint-Martin",
"mg" => "Madagascar",
"mh" => "Marshall Saaret",
"mil" => "USAn armeija",
"mk" => "Makedonia",
"ml" => "Mali",
"mm" => "Myanmar",
"mn" => "Mongolia",
"mo" => "Macau",
"mp" => "Pohjoiset Marianan saaret",
"mq" => "Martinique",
"mr" => "Mauritania",
"ms" => "Montserrat",
"mt" => "Malta",
"mu" => "Mauritius",
"museum" => "Museum",
"mv" => "Maldiivit",
"mw" => "Malawi",
"mx" => "Meksiko",
"my" => "Malesia",
"mz" => "Mozambique",
"na" => "Namibia",
"name" => "Personal",
"nc" => "Uusi Caledonia",
"ne" => "Niger",
"net" => "Verkko",
"nf" => "Norfolk Saaret",
"ng" => "Nigeria",
"ni" => "Nicaragua",
"nl" => "Alankomaat",
"no" => "Norja",
"np" => "Nepali",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Numeerinen",
"nz" => "Uusi Seelanti",
"om" => "Oman",
"org" => "Organisaatio",
"pa" => "Panama",
"pe" => "Peru",
"pf" => "Ranskan Polynesia",
"pg" => "Papua New Guinea",
"ph" => "Philippiinit",
"pk" => "Pakistan",
"pl" => "Puola",
"pm" => "St. Pierre ja Miquelon",
"pn" => "Pitcairn",
"pr" => "Puerto Rico",
"pro" => "Professional",
"ps" => "Palestina",
"pt" => "Portugali",
"pw" => "Palau",
"py" => "Paraguay",
"qa" => "Qatar",
"re" => "Reunion",
"ro" => "Romania",
"rs" => "Serbia",
"ru" => "Ven&auml;j&auml;",
"rw" => "Ruanda",
"sa" => "Saudi Arabia",
"sb" => "Solomon Islands",
"sc" => "Seychellit",
"sd" => "Sudan",
"se" => "Ruotsi",
"sg" => "Singapori",
"sh" => "St. Helena",
"si" => "Slovenia",
"sj" => "Svalbard ja Jan Mayen Islands",
"sk" => "Slovakia",
"sl" => "Sierra Leone",
"sm" => "San Marino",
"sn" => "Senegal",
"so" => "Somalia",
"sr" => "Suriname",
"st" => "Sao Tome ja Principe",
"su" => "Neuvostoliitto",
"sv" => "El Salvador",
"sy" => "Syyria",
"sz" => "Swazimaa",
"tc" => "Turks and Caicos Saaret",
"td" => "Chad",
"tf" => "Ranskan etel&auml;iset territoriot",
"tg" => "Togo",
"th" => "Thaimaa",
"tj" => "Tajikistan",
"tk" => "Tokelau",
"tl" => "It&auml;-Timor",
"tm" => "Turkmenistan",
"tn" => "Tunisia",
"to" => "Tonga",
"tp" => "It&auml;-Timor",
"tr" => "Turkki",
"tt" => "Trinidad ja Tobago",
"tv" => "Tuvalu",
"tw" => "Taiwan",
"tz" => "Tanzania",
"ua" => "Ukraina",
"ug" => "Uganda",
"uk" => "Iso-Britannia",
"um" => "Yhdysvaltojen Minor Outlying Islands",
"unknown" => "Tuntematon",
"us" => "Yhdysvallat",
"uy" => "Uruguay",
"uz" => "Uzbekistan",
"va" => "Vatikaani",
"vc" => "St. Vincent ja Grenadiinit",
"ve" => "Venezuela",
"vg" => "Neitsyt Saaret (UK)",
"vi" => "Neitsyt Saaret (US)",
"vn" => "Vietnam",
"vu" => "Vanuatu",
"wf" => "Wallis ja Futuna Islands",
"ws" => "Samoa",
"ye" => "Jemen",
"yt" => "Mayotte",
"yu" => "Serbia and Montenegro",
"za" => "Etel&auml;-Afrikka",
"zm" => "Zambia",
"zr" => "Zaire",
"zw" => "Zimbabwe",
);

// The main Translation array
$translation = array(
// Specific charset
"global_charset" => "utf-8",

// Date format (used with date() )
"global_time_format" => "M jS, H:i:s",
"global_day_format" => "l F jS, Y",
"global_hours_format" => "l F jS, G:00",
"global_month_format" => "F Y",

// Global translation
"global_titlebar"=> "Statistics for %SERVER generated on %DATE",
"global_bbclone_copyright" => "BBclone tiimi - Lisenssi on",
"global_last_reset" => "Statistics last reset on",
"global_yes" => "kyll&auml;",
"global_no" => "ei",

// The error messages
"error_cannot_see_config" =>
"Sinulle ei ole annettu oikeuksia tarkastella BBClonen asetuksia t&auml;ll&auml; palvelimella.",

// Miscellaneous translations
"misc_other" => "Muu",
"misc_unknown" => "Tuntematon",
"misc_second_unit" => "s",
"misc_ignored" => "Ignored",

// The Navigation Bar
"navbar_main_site" => "Seurattu sivusto",
"navbar_configuration" => "Asetukset",
"navbar_global_stats" => "Kokonaistilastot",
"navbar_detailed_stats" => "K&auml;yntikertakoht. tilastot",
"navbar_time_stats" => "Aikatilastot",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "Nro",
"dstat_time" => "Aika",
"dstat_visits" => "Lkm",
"dstat_extension" => "P&auml;&auml;te",
"dstat_dns" => "Osoite",
"dstat_from" => "L&auml;hdesivu",
"dstat_os" => "K&auml;ytt&ouml;j&auml;rjestelm&auml;",
"dstat_browser" => "Selain",
"dstat_visible_rows" => "Listassa vierailuja",
"dstat_green_rows" => "vihre&auml; rivi",
"dstat_blue_rows" => "sininen rivi",
"dstat_red_rows" => "punainen rivi",
"dstat_search" => "Search",
"dstat_last_page" => "Last Page",
"dstat_last_visit" => "viimeinen vierailu",
"dstat_robots" => "robotteja",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "No data available",
"dstat_prx" => "Proxy Server",
"dstat_ip" => "IP Address",
"dstat_user_agent" => "User Agent",
"dstat_nr" => "Nr",
"dstat_pages" => "Pages",
"dstat_visit_length" => "Visit Length",
"dstat_reloads" => "Reloads",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Vierailuja",
"gstat_total_visits" => "Yhteens&auml;",
"gstat_total_unique" => "Eri osoitteista",
"gstat_operating_systems" => "Top %d k&auml;ytt&ouml;j&auml;rjestelm&auml;&auml;",
"gstat_browsers" => "Top %d selainta",
"gstat_extensions" => "Top %d p&auml;&auml;tett&auml;",
"gstat_robots" => "Top %d robottia",
"gstat_pages" => "Top %d sivua",
"gstat_origins" => "Top %d viittaavaa sivua",
"gstat_hosts" => "Top %d Hosts",
"gstat_keys" => "Top %d Keywords",
"gstat_total" => "Yhteens&auml;",
"gstat_not_specified" => "Ei m&auml;&auml;ritelty",

// Time stats words
"tstat_su" => "Su",
"tstat_mo" => "Ma",
"tstat_tu" => "Ti",
"tstat_we" => "Ke",
"tstat_th" => "To",
"tstat_fr" => "Pe",
"tstat_sa" => "La",

"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "Tam",
"tstat_feb" => "Hel",
"tstat_mar" => "Maa",
"tstat_apr" => "Huh",
"tstat_may" => "Tou",
"tstat_jun" => "Kes",
"tstat_jul" => "Hei",
"tstat_aug" => "Elo",
"tstat_sep" => "Syy",
"tstat_oct" => "Lok",
"tstat_nov" => "Mar",
"tstat_dec" => "Jou",

"tstat_full_jan" => "January",
"tstat_full_feb" => "February",
"tstat_full_mar" => "March",
"tstat_full_apr" => "April",
"tstat_full_may" => "May",
"tstat_full_jun" => "June",
"tstat_full_jul" => "July",
"tstat_full_aug" => "August",
"tstat_full_sep" => "September",
"tstat_full_oct" => "October",
"tstat_full_nov" => "November",
"tstat_full_dec" => "December",

"tstat_last_day" => "Viimeisen vuorokauden aikana",
"tstat_last_week" => "Viimeisen viikon aikana",
"tstat_last_month" => "Viimeisen kuukauden aikana",
"tstat_last_year" => "Viimeisen vuoden aikana",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "Muuttuja",
"config_variable_value" => "Muuttujan arvo",
"config_explanations" => "Kuvaus",

"config_BBC_MAINSITE" =>
"If this variable has been set, a link to the specified location will be
generated. The default value is pointing to the parent directory. In case your
main site is located elsewhere, you probably want to adjust the value to suit
your needs.<br />
Examples:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"BBClone defaults to revealing the stats' settings. In case this behavior isn't
desired you can deny access to it by deactivating the option.<br />
Examples:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Kaikilla BBClonen luomilla sivuilla n&auml;kyv&auml; otsikko.<br />
Seuraavia muuttujia voi k&auml;ytt&auml;&auml;:<br />
<ul>
<li>%SERVER: palvelimen nimi,</li>
<li>%DATE: p&auml;iv&auml;m&auml;&auml;r&auml;.</li>
</ul>
HTML-koodi on my&ouml;s ok.<br />
Examples:<br />
\$BBC_TITLEBAR = &quot;Statistics for %SERVER generated the %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;My stats from %DATE look like this:&quot;;
<br />",

"config_BBC_LANGUAGE" =>
"BBClone's default language, in case it hasn't been specified by the browser.
The following languages are supported:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, ua, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"This variable defines the length of an unique visit in seconds. Each hit from
the same visitor within this period will be considered as one visit, as long as
two successive hits don't exceed the specified limit. Default is the de facto
web standard of 30 minutes (1800 seconds), but depending on your needs you may
wish to assign a different value.<br />
Examples:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"How many entries you want to have listed in the detailed stats? The default
value is 100. It's recommended not to set it higher than 500 to avoid too heavy
load.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"The variable \$BBC_DETAILED_STAT_FIELDS determines the columns to be displayed
in the detailed statistics. Possible columns are:
<ul>
<li>id&nbsp;=&gt;&nbsp;The x-th visitor since you've started counting</li>
<li>time&nbsp;=&gt;&nbsp;The time at which the last hit was registerred</li>
<li>visits&nbsp;=&gt;&nbsp;The hits of one unique visitor</li>
<li>dns&nbsp;=&gt;&nbsp;Visitor's hostname</li>
<li>ip&nbsp;=&gt;&nbsp;Visitor's IP address</li>
<li>os&nbsp;=&gt;&nbsp;the operating system (if available and/or no robot)</li>
<li>browser&nbsp;=&gt;&nbsp;The software used for establishing the connection
</li>
<li>ext&nbsp;=&gt;&nbsp;Visitor's country or extension</li>
<li>referer&nbsp;=&gt;&nbsp;The link from which a visitor came (if available)
</li>
<li>page&nbsp;=&gt;&nbsp;The last visited page</li>
<li>search&nbsp;=&gt;&nbsp;The search query a visitor used (if available)</li>
</ul>
The same order you've arranged the columns will be used for display.<br />
Examples:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"In case the server time doesn't match your local timezone, you can adjust the
time in minutes by using this switch. Negative values will set back the time,
positive ones will set it forth.<br />
Examples:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"This options defines, whether IP addresses should be resolved to hostnames or
not. While hostnames tell a lot more about the visitor, resolving them may
considerably slow down your site, if the DNS servers used are slow, limited in
their capacity or otherwise unreliable. Setting this variable may solve the
problem.<br />
Examples:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"BBClone's default is to show hits in the time stats, because it gives a quite
useful Impression from the actual server load. If, however, you prefer to use
unique visits as base for your time stats, you can change the way of counting
by setting this variable.<br />
Examples:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"This option can be used to exclude particular IP addresses or address ranges
from counting. In case you want to add several expressions use a comma as
separator.<br />
Examples:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"In case you don't want to have particular referrers from your visitors listed
in your ranking or detailed stats, you can specify one or more keywords used
for blocking if a referrer matches up against them. If you use more keywords,
please use a comma as separator.<br />
Examples:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"You can use this option to determine the treatment of robots. The default is
to ignore them in the top hosts ranking but leave them in the remaining
stats. If you don't want to see any robots at all you can set this option to
&quot;2&quot;, then only human visits will be taken into account.<br />
Examples:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"This option defines how BBClone tells one visitor from another. Default is to
use the IP address only, which provides realistic figures in most cases. If,
however, your visitors often are hidden behind proxy servers, deactivation of
this option could provide more realistic figures, since a new visitor will be
assumed by the time the user agent has changed.<br />
Examples:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Whenever you wish to reset your stats you can activate this switch and have
them deleted by the next visit. Don't forget to deactivate it afterwards, else
you'll probably experience unusually low traffic ;).<br />
Examples:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Host and referrer stats can generate a huge amount of data, however mostly
caused by one time visitors. By enabling this switch you can purge these
entries and considerably shrink access.php in its size without affecting your
actual visible host and referrer ranking. The amount of hits will be added to
the &quot;not_specified&quot; entries to keep the overall score intact.<br />
Examples:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
