<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: ro.php,v 1.62 2011/12/30 23:03:24 joku Exp $
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
 * Translated by: ciprian manea ciprian.manea@welho.com
 */

// The DNS Extensions array
$extensions = array(
"travel" => "Travel",
"asia" => "Asia-Pacific",
"jobs" => "Employment",
"mobi" => "Mobiles",
"cat" => "Catalan",
"tel" => "Contacts",

"ac" => "Insula Inaltarii",
"ad" => "Andorra",
"ae" => "Emiratele Arabe Unite",
"aero" => "Aero",
"af" => "Afganistan",
"ag" => "Antigua si Barbuda",
"ai" => "Angola",
"al" => "Albania",
"am" => "Armenia",
"an" => "Antilele Olandeze",
"ao" => "Angola",
"aq" => "Antarctica",
"ar" => "Argentina",
"arpa" => "Greseli",
"as" => "Samoa Americana",
"at" => "Austria",
"au" => "Australia",
"aw" => "Aruba",
"ax" => "Insulele Åland",
"az" => "Azerbaijan",
"ba" => "Bosnia si Hertegovina",
"bb" => "Barbados",
"bd" => "Banglades",
"be" => "Belgia",
"bf" => "Burkina Faso",
"bg" => "Bulgaria",
"bh" => "Bahrain",
"bi" => "Burundi",
"biz" => "Business",
"bj" => "Benin",
"bl" => "Saint Barthélemy",
"bm" => "Bermude",
"bn" => "Brunei",
"bo" => "Bolivia",
"br" => "Brazilia",
"bs" => "Bahamas",
"bt" => "Bhutan",
"bv" => "Bouvet Island",
"bw" => "Botswana",
"by" => "Belarus",
"bz" => "Belize",
"ca" => "Canada",
"cc" => "Insulele Cocos",
"cd" => "Congo",
"cf" => "Republica Central-Africana",
"cg" => "Congo",
"ch" => "Elvetia",
"ci" => "Coasta de Fildes",
"ck" => "Insulele Cook",
"cl" => "Chile",
"cm" => "Camerun",
"cn" => "China",
"co" => "Columbia",
"com" => "Commercial",
"coop" => "Coop",
"cr" => "Costa Rica",
"cs" => "Serbia and Montenegro",
"cu" => "Cuba",
"cv" => "Insula Capul Verde",
"cx" => "Insula Craciunului",
"cy" => "Cipru",
"cz" => "Cehia",
"de" => "Germania",
"dj" => "Djibouti",
"dk" => "Danemarca",
"dm" => "Dominica",
"do" => "Republica Dominicana",
"dz" => "Algeria",
"ec" => "Ecuador",
"edu" => "Educational",
"ee" => "Estonia",
"eg" => "Egipt",
"eh" => "Western Sahara",
"er" => "Eritrea",
"es" => "Spania",
"et" => "Etiopia",
"eu" => "European Union",
"fi" => "Finlanda",
"fj" => "Fiji",
"fk" => "Insulele Falkland",
"fm" => "Micronezia",
"fo" => "Insulele Faroe",
"fr" => "Franta",
"ga" => "Gabon",
"gb" => "Marea Britanie",
"gd" => "Grenada",
"ge" => "Georgia",
"gf" => "Guiana Franceza",
"gg" => "Guernsey",
"gh" => "Ghana",
"gi" => "Gibraltar",
"gl" => "Groenlanda",
"gm" => "Gambia",
"gn" => "Guineea",
"gov" => "Guvernamental",
"gp" => "Guadeloupe",
"gq" => "Guineea Ecuatoriala",
"gr" => "Grecia",
"gs" => "Georgia de Sud si Insulele Sandwich de Sud",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guineea-Bissau",
"gy" => "Guyana",
"hk" => "Hong Kong",
"hm" => "Insulele Heard si Mc Donald",
"hn" => "Honduras",
"hr" => "Croatia",
"ht" => "Haiti",
"hu" => "Ungaria",
"id" => "Indonezia",
"ie" => "Irlanda",
"il" => "Israel",
"im" => "Insula Man",
"in" => "India",
"info" => "Information",
"int" => "Organizatii Internationale",
"io" => "Teritoriile Engleze din Oceanul Indian",
"iq" => "Irak",
"ir" => "Iran",
"is" => "Islanda",
"it" => "Italia",
"je" => "Jersey",
"jm" => "Jamaica",
"jo" => "Iordania",
"jp" => "Japonia",
"ke" => "Kenya",
"kg" => "Kyrgyzstan",
"kh" => "Cambodgia",
"ki" => "Kiribati",
"km" => "Comoros",
"kn" => "Sf. Kitts si Nevis",
"kp" => "North Korea",
"kr" => "Corea",
"kw" => "Kuwait",
"ky" => "Insulele Cayman",
"kz" => "Kazakhstan",
"la" => "Laos",
"lb" => "Liban",
"lc" => "Sfanta Lucia",
"li" => "Liechtenstein",
"lk" => "Sri Lanka",
"lr" => "Liberia",
"ls" => "Lesoto",
"lt" => "Lituania",
"lu" => "Luxemburg",
"lv" => "Letonia",
"ly" => "Libia",
"ma" => "Maroc",
"mc" => "Monaco",
"md" => "Moldova",
"me" => "Montenegro",
"mf" => "Saint Martin",
"mg" => "Madagascar",
"mh" => "Insulele Marshall",
"mil" => "US Militar",
"mk" => "Macedonia",
"ml" => "Mali",
"mm" => "Myanmar",
"mn" => "Mongolia",
"mo" => "Macao",
"mp" => "Insulele Mariane de Nord",
"mq" => "Martinica",
"mr" => "Mauritania",
"ms" => "Montserrat",
"mt" => "Malta",
"mu" => "Mauritius",
"museum" => "Museum",
"mv" => "Maldive",
"mw" => "Malawi",
"mx" => "Mexic",
"my" => "Malaezia",
"mz" => "Mozambic",
"na" => "Namibia",
"name" => "Personal",
"nc" => "Noua Caledonie",
"ne" => "Niger",
"net" => "Retele",
"nf" => "Insulele Norfolk",
"ng" => "Nigeria",
"ni" => "Nicaragua",
"nl" => "Olanda",
"no" => "Norvegia",
"np" => "Nepal",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Numeric",
"nz" => "Noua Zeelanda",
"om" => "Oman",
"org" => "Organizatii",
"pa" => "Panama",
"pe" => "Peru",
"pf" => "Polinezia Franceza",
"pg" => "Papua Noua Guinee",
"ph" => "Filipine",
"pk" => "Pakistan",
"pl" => "Polonia",
"pm" => "Sf. Pierre si Miquelon",
"pn" => "Pitcairn",
"pr" => "Porto Rico",
"pro" => "Professional",
"ps" => "Palestina",
"pt" => "Portugalia",
"pw" => "Palau",
"py" => "Paraguay",
"qa" => "Qatar",
"re" => "Reunion",
"ro" => "Romania",
"rs" => "Serbia",
"ru" => "Federatia Rusa",
"rw" => "Rwanda",
"sa" => "Arabia Saudita",
"sb" => "Insulele Solomon",
"sc" => "Seychelles",
"sd" => "Sudan",
"se" => "Suedia",
"sg" => "Singapore",
"sh" => "Sfanta Elena",
"si" => "Slovenia",
"sj" => "Svalbard si Insulele Jan Mayen",
"sk" => "Slovacia",
"sl" => "Sierra Leone",
"sm" => "San Marino",
"sn" => "Senegal",
"so" => "Somalia",
"sr" => "Surinam",
"st" => "Sao Tome si Principe",
"su" => "Uniunea Sovietica",
"sv" => "Salvador",
"sy" => "Siria",
"sz" => "Swaziland",
"tc" => "Insulele Turks si Caicos",
"td" => "Ciad",
"tf" => "Teritoriile Franceze de Sud",
"tg" => "Togo",
"th" => "Tailanda",
"tj" => "Tadjikistan",
"tk" => "Tokelau",
"tl" => "Timorul de Est",
"tm" => "Turkmenistan",
"tn" => "Tunisia",
"to" => "Tonga",
"tp" => "Timorul de Est",
"tr" => "Turcia",
"tt" => "Trinidad Tobago",
"tv" => "Tuvalu",
"tw" => "Taiwan",
"tz" => "Tanzania",
"ua" => "Ucraina",
"ug" => "Uganda",
"uk" => "Marea Britanie",
"um" => "Insulele Minor Outlying (US)",
"unknown" => "Necunoscut",
"us" => "Statele Unite",
"uy" => "Uruguay",
"uz" => "Uzbekistan",
"va" => "Vatican",
"vc" => "Sf. Vincent si Grenadine",
"ve" => "Venezuela",
"vg" => "Insulele Virgine (UK)",
"vi" => "Insulele Virgine (US)",
"vn" => "Vietnam",
"vu" => "Vanuatu",
"wf" => "Insulele Wallis si Futuna",
"ws" => "Samoa",
"ye" => "Yemen",
"yt" => "Mayotte",
"yu" => "Serbia and Montenegro",
"za" => "Africa de Sud",
"zm" => "Zambia",
"zr" => "Zair",
"zw" => "Zimbabwe",
);

// The main Translation array
$translation = array(
// Specific charset
"global_charset" => "utf-8",

// Global translation
"global_titlebar"=> "Statistics for %SERVER generated on %DATE",
"global_bbclone_copyright" => "Echipa BBClone - licenta",
"global_last_reset" => "Statistics last reset on",
"global_yes" => "da",
"global_no" => "nu",

// The error messages
"error_cannot_see_config" =>
"Nu ai dreptul sa vezi configuratia BBClone a acestui server.",

// Date format (used with date())
"global_time_format" => "M jS, H:i:s",
"global_day_format" => "l F jS, Y",
"global_hours_format" => "l F jS, G:00",
"global_month_format" => "F Y",

"seconds" => "Secundă",

// Miscellaneous translations
"misc_other" => "Alt",
"misc_unknown" => "Necunoscut",
"misc_second_unit" => "s",
"misc_ignored" => "Ignored",

// The Navigation Bar
"navbar_main_site" => "Situl Principal",
"navbar_configuration" => "Configurare",
"navbar_global_stats" => "Statistici Generale",
"navbar_detailed_stats" => "Statistici Detaliate",
"navbar_time_stats" => "Statistici in Timp",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Timp",
"dstat_visits" => "Vizite",
"dstat_extension" => "Extensie",
"dstat_dns" => "Hostname",
"dstat_from" => "De la",
"dstat_os" => "OS",
"dstat_browser" => "Browser",
"dstat_visible_rows" => "Accesari vizibile",
"dstat_green_rows" => "randuri verzi",
"dstat_blue_rows" => "randuri albastre",
"dstat_red_rows" => "randuri rosii",
"dstat_search" => "Search",
"dstat_last_page" => "Ultima Pagina",
"dstat_last_visit" => "ultima vizita",
"dstat_robots" => "roboti",
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
"gstat_accesses" => "Accese",
"gstat_total_visits" => "Total vizite",
"gstat_total_unique" => "Total unici",
"gstat_operating_systems" => "Sisteme de operare",
"gstat_browsers" => "Browsere",
"gstat_extensions" => "Primele %d extensii",
"gstat_robots" => "Roboti",
"gstat_pages" => "Primele %d pagini",
"gstat_origins" => "Primele %d origini",
"gstat_hosts" => "Top %d Hosts",
"gstat_keys" => "Top %d Keywords",
"gstat_total" => "Total",
"gstat_not_specified" => "Nespecificat",

// Time stats words
"tstat_su" => "Du",
"tstat_mo" => "Lu",
"tstat_tu" => "Ma",
"tstat_we" => "Mi",
"tstat_th" => "Jo",
"tstat_fr" => "Vi",
"tstat_sa" => "Sa",

"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "Ian",
"tstat_feb" => "Feb",
"tstat_mar" => "Mar",
"tstat_apr" => "Apr",
"tstat_may" => "Mai",
"tstat_jun" => "Iun",
"tstat_jul" => "Iul",
"tstat_aug" => "Aug",
"tstat_sep" => "Sep",
"tstat_oct" => "Oct",
"tstat_nov" => "Nov",
"tstat_dec" => "Dec",

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

"tstat_last_day" => "Ultima zi",
"tstat_last_week" => "Ultima saptamana",
"tstat_last_month" => "Ultima luna",
"tstat_last_year" => "Ultimul an",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "Nume variabila",
"config_variable_value" => "Valoare variabila",
"config_explanations" => "Explicatii",

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
"Titlul care apare in toate paginile contorului.<br />
Cuvintele cheie sunt:<br />
<ul>
<li>%SERVER: numele server-ului,</li>
<li>%DATE: data curenta.</li>
</ul>
Codul HTML este de asemenea permis.<br />
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
