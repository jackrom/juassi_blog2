<?php
/* This file is part of BBClone (A PHP based Web Counter on Steroids)
 * 
 * CVS FILE $Id: nl.php,v 1.64 2011/12/30 23:03:24 joku Exp $
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
 */

// Dutch language

// The DNS Extensions array
$extensions = array(
	"numeric" => "Numeriek",
	"unknown" => "Onbekend",
	"museum" => "Museum",
	"travel" => "Reizen",
	
	"aero" => "Luchtvaart",
	"arpa" => "Old style Arpanet",
	"asia" => "Azi&euml;en de Stille Oceaan",
	"coop" => "Co&ouml;peratief",
	"info" => "Informatie",
	"jobs" => "Jobs",
	"mobi" => "Mobielen",
	"name" => "Individu",
	
	"biz" => "Bedrijven",
	"cat" => "Catalan",
	"com" => "Commercieel",
	"edu" => "US educatieve instellingen",
	"gov" => "US overheid",
	"int" => "Internationaal",
	"mil" => "US militair",
	"net" => "Netwerken",
	"org" => "Organisaties",
	"pro" => "Professionals",
	"tel" => "Contacten",
	
	"ac" => "Ascension Island",
	"ad" => "Andorra",
	"ae" => "Verenigde Arabische Emiraten",
	"af" => "Afghanistan",
	"ag" => "Antigua en Barbuda",
	"ai" => "Anguilla",
	"al" => "Albania",
	"am" => "Armenia",
	"an" => "Nederlandse Antillen",
	"ao" => "Angola",
	"aq" => "Antarctica",
	"ar" => "Argentina",
	"as" => "American Samoa",
	"at" => "Oostenrijk",
	"au" => "Australia",
	"aw" => "Aruba",
	"ax" => "&Aring;land Islands",
	"az" => "Azerbaijan",
	"ba" => "Bosnia and Herzegovina",
	"bb" => "Barbados",
	"bd" => "Bangladesh",
	"be" => "Belgium",
	"bf" => "Burkina Faso",
	"bg" => "Bulgaria",
	"bh" => "Bahrain",
	"bi" => "Burundi",
	"bj" => "Benin",
	"bl" => "Saint Barthelemy",
	"bm" => "Bermuda",
	"bn" => "Brunei",
	"bo" => "Bolivia",
	"br" => "Brazil",
	"bs" => "Bahamas",
	"bt" => "Bhutan",
	"bv" => "Bouvet Island",
	"bw" => "Botswana",
	"by" => "Belarus",
	"bz" => "Belize",
	"ca" => "Canada",
	"cc" => "Cocos (Keeling) Islands",
	"cd" => "Democratic Republic of the Congo",
	"cf" => "Central African Republic",
	"cg" => "Congo",
	"ch" => "Zwitserland",
	"ci" => "Ivory Coast (Cote d'Ivoire)",
	"ck" => "Cook Islands",
	"cl" => "Chile",
	"cm" => "Cameroon",
	"cn" => "China",
	"co" => "Colombia",
	"cr" => "Costa Rica",
	"cs" => "Serbia and Montenegro",
	"cu" => "Cuba",
	"cv" => "Cape Verde",
	"cx" => "Christmas Island",
	"cy" => "Cyprus",
	"cz" => "Czech Republic",
	"de" => "Duitsland",
	"dj" => "Djibouti",
	"dk" => "Denmark",
	"dm" => "Dominica",
	"do" => "Dominican Republic",
	"dz" => "Algeria",
	"ec" => "Ecuador",
	"ee" => "Estonia",
	"eg" => "Egypt",
	"eh" => "Western Sahara",
	"er" => "Eritrea",
	"es" => "Spain",
	"et" => "Ethiopia",
	"eu" => "European Union",
	"fi" => "Finland",
	"fj" => "Fiji",
	"fk" => "Falkland Islands (Malvinas)",
	"fm" => "Micronesia",
	"fo" => "Faroe Islands",
	"fr" => "France",
	"ga" => "Gabon",
	"gb" => "United Kingdom",
	"gd" => "Grenada",
	"ge" => "Georgia",
	"gf" => "French Guiana",
	"gg" => "Guernsey",
	"gh" => "Ghana",
	"gi" => "Gibraltar",
	"gl" => "Greenland",
	"gm" => "Gambia",
	"gn" => "Guinea",
	"gp" => "Guadeloupe",
	"gq" => "Equatorial Guinea",
	"gr" => "Greece",
	"gs" => "South Georgia and the South Sandwich Islands",
	"gt" => "Guatemala",
	"gu" => "Guam",
	"gw" => "Guinea-Bissau",
	"gy" => "Guyana",
	"hk" => "Hong Kong",
	"hm" => "Heard Island and McDonald Islands",
	"hn" => "Honduras",
	"hr" => "Croatia",
	"ht" => "Haiti",
	"hu" => "Hungary",
	"id" => "Indonesia",
	"ie" => "Ireland",
	"il" => "Israel",
	"im" => "Isle of Man",
	"in" => "India",
	"io" => "British Indian Ocean Territory",
	"iq" => "Iraq",
	"ir" => "Iran",
	"is" => "Iceland",
	"it" => "Italy",
	"je" => "Jersey",
	"jm" => "Jamaica",
	"jo" => "Jordan",
	"jp" => "Japan",
	"ke" => "Kenya",
	"kg" => "Kyrgyzstan",
	"kh" => "Cambodia",
	"ki" => "Kiribati",
	"km" => "Comoros",
	"kn" => "Saint Kitts and Nevis",
	"kp" => "North Korea",
	"kr" => "Korea",
	"kw" => "Kuwait",
	"ky" => "Cayman Islands",
	"kz" => "Kazakhstan",
	"la" => "Laos",
	"lb" => "Lebanon",
	"lc" => "Saint Lucia",
	"li" => "Liechtenstein",
	"lk" => "Sri Lanka",
	"lr" => "Liberia",
	"ls" => "Lesotho",
	"lt" => "Lithuania",
	"lu" => "Luxembourg",
	"lv" => "Latvia",
	"ly" => "Libya",
	"ma" => "Morocco",
	"mc" => "Monaco",
	"md" => "Moldova",
	"me" => "Montenegro",
	"mf" => "Frans Sint-Maarten",
	"mg" => "Madagascar",
	"mh" => "Marshall Islands",
	"mk" => "Macedonia",
	"ml" => "Mali",
	"mm" => "Myanmar",
	"mn" => "Mongolia",
	"mo" => "Macau",
	"mp" => "Northern Mariana Islands",
	"mq" => "Martinique",
	"mr" => "Mauritania",
	"ms" => "Montserrat",
	"mt" => "Malta",
	"mu" => "Mauritius",
	"mv" => "Maldives",
	"mw" => "Malawi",
	"mx" => "Mexico",
	"my" => "Malaysia",
	"mz" => "Mozambique",
	"na" => "Namibia",
	"nc" => "New Caledonia",
	"ne" => "Niger",
	"nf" => "Norfolk Island",
	"ng" => "Nigeria",
	"ni" => "Nicaragua",
	"nl" => "Nederland",
	"no" => "Norway",
	"np" => "Nepal",
	"nr" => "Nauru",
	"nu" => "Niue",
	"nz" => "New Zealand",
	"om" => "Oman",
	"pa" => "Panama",
	"pe" => "Peru",
	"pf" => "French Polynesia",
	"pg" => "Papua New Guinea",
	"ph" => "Philippines",
	"pk" => "Pakistan",
	"pl" => "Poland",
	"pm" => "Saint Pierre and Miquelon",
	"pn" => "Pitcairn",
	"pr" => "Puerto Rico",
	"ps" => "Palestine",
	"pt" => "Portugal",
	"pw" => "Palau",
	"py" => "Paraguay",
	"qa" => "Qatar",
	"re" => "Reunion",
	"ro" => "Romania",
	"rs" => "Serbia",
	"ru" => "Russia",
	"rw" => "Rwanda",
	"sa" => "Saudi Arabia",
	"sb" => "Solomon Islands",
	"sc" => "Seychelles",
	"sd" => "Sudan",
	"se" => "Sweden",
	"sg" => "Singapore",
	"sh" => "Saint Helena",
	"si" => "Slovenia",
	"sj" => "Svalbard and Jan Mayen Islands",
	"sk" => "Slovakia",
	"sl" => "Sierra Leone",
	"sm" => "San Marino",
	"sn" => "Senegal",
	"so" => "Somalia",
	"sr" => "Suriname",
	"st" => "Sao Tome and Principe",
	"su" => "Soviet Union",
	"sv" => "El Salvador",
	"sy" => "Syria",
	"sz" => "Swaziland",
	"tc" => "Turks and Caicos Islands",
	"td" => "Chad",
	"tf" => "French Southern Territories",
	"tg" => "Togo",
	"th" => "Thailand",
	"tj" => "Tajikistan",
	"tk" => "Tokelau",
	"tl" => "East Timor",
	"tm" => "Turkmenistan",
	"tn" => "Tunisia",
	"to" => "Tonga",
	"tp" => "Portuguese Timor",
	"tr" => "Turkey",
	"tt" => "Trinidad and Tobago",
	"tv" => "Tuvalu",
	"tw" => "Taiwan",
	"tz" => "Tanzania",
	"ua" => "Ukraine",
	"ug" => "Uganda",
	"uk" => "United Kingdom",
	"um" => "US Minor Outlying Islands",
	"us" => "United States",
	"uy" => "Uruguay",
	"uz" => "Uzbekistan",
	"va" => "Holy See (Vatican City State)",
	"vc" => "Saint Vincent and the Grenadines",
	"ve" => "Venezuela",
	"vg" => "Virgin Islands (British)",
	"vi" => "Virgin Islands (US)",
	"vn" => "Vietnam",
	"vu" => "Vanuatu",
	"wf" => "Wallis and Futuna Islands",
	"ws" => "Samoa",
	"ye" => "Yemen",
	"yt" => "Mayotte",
	"yu" => "Serbia and Montenegro",
	"za" => "South Africa",
	"zm" => "Zambia",
	"zr" => "Zaire",
	"zw" => "Zimbabwe"
);

// The main Translation array
$translation = array(

// Specific charset
"global_charset" => "utf-8",

// Date format (used with date())
"global_time_format" => "j M, H:i:s",
"global_day_format" => "l j F Y",
"global_hours_format" => "l j F Y G:00",
"global_month_format" => "F Y",

// Global translation
"global_titlebar"=> "Statistieken voor %SERVER gegenereerd op %DATE",
"global_bbclone_copyright" => "Het BBClone Team - licentie onder de",
"global_last_reset" => "Statistics last reset on",
"global_yes" => "Ja",
"global_no" => "Nee",

// The error messages
"error_cannot_see_config" =>
"You are not allowed to see the BBClone configuration on this server.",

// Miscellaneous translations
"misc_other" => "Anders",
"misc_unknown" => "Onbekend",
"misc_second_unit" => "sec",
"misc_ignored" => "Genegeerd",

// The Navigation Bar
"navbar_main_site" => "Hoofdpagina",
"navbar_configuration" => "Instellingen",
"navbar_global_stats" => "Algemene Statistieken",
"navbar_detailed_stats" => "Gedetailleerde Statistieken",
"navbar_time_stats" => "Tijdstatistieken",
"navbar_language" => "Taal",
"navbar_go" => "Go",

// Detailed Stats words
"dstat_id" => "ID",
"dstat_time" => "Tijdstip",
"dstat_visits" => "Bezoeken",
"dstat_extension" => "Land",
"dstat_dns" => "Hostname",
"dstat_from" => "Herkomst",
"dstat_os" => "Besturingssysteem",
"dstat_browser" => "Browser",
"dstat_visible_rows" => "Zichtbare bezoekers",
"dstat_search" => "Zoekwoord(en)",
"dstat_last_page" => "Laatste pagina",
"dstat_last_visit" => "Laatste bezoek",
"dstat_robots" => "Robots",
"dstat_my_visit" => "Bezoek via eigen IP",
"dstat_no_data" => "Geen gegevens beschikbaar",
"dstat_prx" => "Proxy Server",
"dstat_ip" => "IP adres",
"dstat_user_agent" => "User Agent",
"dstat_nr" => "Nr",
"dstat_pages" => "Pagina's",
"dstat_visit_length" => "Duur bezoek",
"dstat_reloads" => "Aantal keer herladen",
"dstat_whois_information" => "Look up information on this IP address",

// Global Stats words
"gstat_accesses" => "Bezoekers",
"gstat_total_visits" => "Totaal aantal bezoekers",
"gstat_total_unique" => "Totaal aantal unieke bezoekers",
"gstat_operating_systems" => "Top %d Besturingssystemen",
"gstat_browsers" => "Top %d Browsers",
"gstat_extensions" => "Top %d Landen",
"gstat_robots" => "Top %d Robots",
"gstat_pages" => "Top %d Bezochte pagina's",
"gstat_origins" => "Top %d Herkomst",
"gstat_hosts" => "Top %d Hostnamen",
"gstat_keys" => "Top %d Zoekwoorden",
"gstat_total" => "Totaal",
"gstat_not_specified" => "Niet gespecificeerd",

// Time Stats words
"tstat_su" => "zo",
"tstat_mo" => "ma",
"tstat_tu" => "di",
"tstat_we" => "wo",
"tstat_th" => "do",
"tstat_fr" => "vr",
"tstat_sa" => "za",

"tstat_full_su" => "zondag",
"tstat_full_mo" => "maandag",
"tstat_full_tu" => "dinsdag",
"tstat_full_we" => "woensdag",
"tstat_full_th" => "donderdag",
"tstat_full_fr" => "vrijdag",
"tstat_full_sa" => "zaterdag",

"tstat_jan" => "Jan",
"tstat_feb" => "Feb",
"tstat_mar" => "Mrt",
"tstat_apr" => "Apr",
"tstat_may" => "Mei",
"tstat_jun" => "Jun",
"tstat_jul" => "Jul",
"tstat_aug" => "Aug",
"tstat_sep" => "Sep",
"tstat_oct" => "Okt",
"tstat_nov" => "Nov",
"tstat_dec" => "Dec",

"tstat_full_jan" => "Januari",
"tstat_full_feb" => "Februari",
"tstat_full_mar" => "Maart",
"tstat_full_apr" => "April",
"tstat_full_may" => "Mei",
"tstat_full_jun" => "Juni",
"tstat_full_jul" => "Juli",
"tstat_full_aug" => "Augustus",
"tstat_full_sep" => "September",
"tstat_full_oct" => "Oktober",
"tstat_full_nov" => "November",
"tstat_full_dec" => "December",

"tstat_last_day" => "Afgelopen 24 uur",
"tstat_last_week" => "Afgelopen week",
"tstat_last_month" => "Afgelopen maand",
"tstat_last_year" => "Afgelopen jaar",
"tstat_average" => "Gemiddeld",

// Loadtime notice
"generated" => "pagina gegenereerd in ",
"seconds" => " seconden",

// Configuration page words and sentences
"config_variable_name" => "Variable's name",
"config_variable_value" => "Variable's value",
"config_explanations" => "Explanation",

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
"The title of your stats pages.<br />
It will be displayed in the navigation bar of all BBClone pages<br />
The following macros are recognised:<br />
<ul>
<li>%SERVER: server name,</li>
<li>%DATE: current date.</li>
</ul>
HTML Tags are allowed.<br />
Examples:<br />
\$BBC_TITLEBAR = &quot;Statistics for %SERVER generated the %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;My stats from %DATE look like this:&quot;;<br />",

"config_BBC_LANGUAGE" =>
"BBClone's default language, in case it hasn't been specified by the browser.
The following languages are supported:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, ua, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"This variable defines the length of an unique visit in seconds. Each hit from
the same visitor within this period will be considered as one visit, as long as
two successive hits don't exceed the specified limit. Default is 30 minutes (1800 seconds)
but depending on your needs you may wish to assign a different value.<br />
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
<li>os&nbsp;=&gt;&nbsp;The operating system (if available and/or no robot)</li>
<li>browser&nbsp;=&gt;&nbsp;The software used for establishing the connection</li>
<li>ext&nbsp;=&gt;&nbsp;Visitor's country or extension</li>
<li>referer&nbsp;=&gt;&nbsp;The link from which a visitor came (if available)</li>
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
\$BBC_PURGE_SINGLE = &quot;&quot;;",
);
?>
