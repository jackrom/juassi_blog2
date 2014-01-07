<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: da.php,v 1.66 2011/12/30 23:03:24 joku Exp $
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
 * originally translated by: Jonathan Fromer, jf(at)sof.dk
 * updated by: Nanna Ellegaard, Paul Bischoff
 */

// The DNS Extensions array
$extensions = array(
"travel" => "Travel",
"asia" => "Asia-Pacific",
"jobs" => "Employment",
"mobi" => "Mobiles",
"cat" => "Catalan",
"tel" => "Contacts",

"ac" => "Ascens i&oacute;n",
"ad" => "Andorra",
"ae" => "Forenede Arabiske Emirater",
"aero" => "Aero",
"af" => "Afghanistan",
"ag" => "Antigua og Barbuda",
"ai" => "Anguilla",
"al" => "Albanien",
"am" => "Armenien",
"an" => "Nederlandske Antiller",
"ao" => "Angola",
"aq" => "Antarktis",
"ar" => "Argentina",
"arpa" => "Arpanet",
"as" => "Amerikansk Samoa",
"at" => "&Oslash;strig",
"au" => "Australien",
"aw" => "Aruba",
"ax" => "Åland",
"az" => "Aserbajdsjan",
"ba" => "Bosnien &amp; Hercegovina",
"bb" => "Barbados",
"bd" => "Bangladesh",
"be" => "Belgien",
"bf" => "Burkina",
"bg" => "Bulgarien",
"bh" => "Bahrain",
"bi" => "Burundi",
"biz" => "Business",
"bj" => "Benin",
"bl" => "Saint Barthelemy",
"bm" => "Bermuda",
"bn" => "Brunei",
"bo" => "Bolivia",
"br" => "Brasilien",
"bs" => "Bahamas",
"bt" => "Bhutan",
"bv" => "Bouvet&oslash;ya",
"bw" => "Botswana",
"by" => "Hviderusland",
"bz" => "Belize",
"ca" => "Canada",
"cc" => "Cocos &Oslash;erne",
"cd" => "Demokratiske Republik Congo",
"cf" => "Centralafrikanske Republik",
"cg" => "Congo",
"ch" => "Schweiz",
"ci" => "Elfenbenskysten",
"ck" => "Cook &Oslash;erne",
"cl" => "Chile",
"cm" => "Cameroun",
"cn" => "Kina",
"co" => "Colombia",
"com" => "Kommerciel",
"coop" => "Coop",
"cr" => "Costa Rica",
"cs" => "Serbien &amp; Montenegro",
"cu" => "Cuba",
"cv" => "Kap Verde",
"cx" => "Jule&oslash;en",
"cy" => "Cypern",
"cz" => "Tjekkiet",
"de" => "Tyskland",
"dj" => "Djibouti",
"dk" => "Danmark",
"dm" => "Dominica",
"do" => "Dominikanske Republik",
"dz" => "Algeriet",
"ec" => "Ecuador",
"edu" => "Uddannelsesinstitution",
"ee" => "Estland",
"eg" => "Egypten",
"eh" => "Vest Sahara",
"er" => "Eritrea",
"es" => "Spanien",
"et" => "Etiopien",
"eu" => "Europ&aelig;iske Union",
"fi" => "Finland",
"fj" => "Fiji",
"fk" => "Falklands&oslash;erne",
"fm" => "Mikronesien",
"fo" => "F&aelig;r&oslash;erne",
"fr" => "Frankrig",
"ga" => "Gabon",
"gb" => "Storbritannien",
"gd" => "Grenada",
"ge" => "Georgien",
"gf" => "Fransk Guyana",
"gg" => "Guernsey",
"gh" => "Ghana",
"gi" => "Gibraltar",
"gl" => "Gr&oslash;nland",
"gm" => "Gambia",
"gn" => "Guinea",
"gov" => "De Forenede Staters regering",
"gp" => "Guadeloupe",
"gq" => "&Aelig;kvatorial Guinea",
"gr" => "Gr&aelig;kenland",
"gs" => "South Georgia &amp; South Sandwich &Oslash;erne",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guinea-Bissau",
"gy" => "Guyana",
"hk" => "Hong Kong",
"hm" => "Heard &amp; Mc Donald &Oslash;erne",
"hn" => "Honduras",
"hr" => "Kroatien",
"ht" => "Haiti",
"hu" => "Ungarn",
"id" => "Indonesien",
"ie" => "Irland",
"il" => "Israel",
"im" => "Isle of Man",
"in" => "Indien",
"info" => "Information",
"int" => "Internationale organisationer",
"io" => "Britisk Territorium i det Indiske Ocean",
"iq" => "Irak",
"ir" => "Iran",
"is" => "Island",
"it" => "Italien",
"je" => "Jersey",
"jm" => "Jamaica",
"jo" => "Jordan",
"jp" => "Japan",
"ke" => "Kenya",
"kg" => "Kirgisistan",
"kh" => "Cambodia",
"ki" => "Kiribati",
"km" => "Comorerne",
"kn" => "Saint Christopher &amp; Nevis",
"kp" => "Nord Korea",
"kr" => "Korea",
"kw" => "Kuwait",
"ky" => "Cayman &Oslash;erne",
"kz" => "Kazakhstan",
"la" => "Laos",
"lb" => "Libanon",
"lc" => "Saint Lucia",
"li" => "Liechtenstein",
"lk" => "Sri Lanka",
"lr" => "Liberia",
"ls" => "Lesotho",
"lt" => "Litauen",
"lu" => "Luxembourg",
"lv" => "Letland",
"ly" => "Libyen",
"ma" => "Marokko",
"mc" => "Monaco",
"md" => "Moldova",
"me" => "Montenegro",
"mf" => "Saint Martin",
"mg" => "Madagaskar",
"mh" => "Marshall&oslash;erne",
"mil" => "De Forenede Staters milit&aelig;r",
"mk" => "Makedonien",
"ml" => "Mali",
"mm" => "Myanmar",
"mn" => "Mongoliet",
"mo" => "Macau",
"mp" => "Nordmarianerne",
"mq" => "Martinique",
"mr" => "Mauretanien",
"ms" => "Montserrat",
"mt" => "Malta",
"mu" => "Mauritius",
"museum" => "Museum",
"mv" => "Maldiverne",
"mw" => "Malawi",
"mx" => "Mexico",
"my" => "Malaysia",
"mz" => "Mo&ccedil;ambique",
"na" => "Namibia",
"name" => "Personlig",
"nc" => "Ny Caledonien",
"ne" => "Niger",
"net" => "Netv&aelig;rk",
"nf" => "Norfolk &Oslash;en",
"ng" => "Nigeria",
"ni" => "Nicaragua",
"nl" => "Holland",
"no" => "Norge",
"np" => "Nepal",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Numerisk",
"nz" => "New Zealand",
"om" => "Oman",
"org" => "Organisationer",
"pa" => "Panama",
"pe" => "Peru",
"pf" => "Fransk Polynesien",
"pg" => "Papua Ny Guinea",
"ph" => "Filippinerne",
"pk" => "Pakistan",
"pl" => "Polen",
"pm" => "Saint Pierre et Miquelon",
"pn" => "Pitcairn",
"pr" => "Puerto Rico",
"pro" => "Professionel",
"ps" => "Palestina",
"pt" => "Portugal",
"pw" => "Palau",
"py" => "Paraguay",
"qa" => "Qatar",
"re" => "R&eacute;union",
"ro" => "Rum&aelig;nien",
"rs" => "Serbien",
"ru" => "Rusland",
"rw" => "Rwanda",
"sa" => "Saudi Arabien",
"sb" => "Salomon &Oslash;erne",
"sc" => "Seychellerne",
"sd" => "Sudan",
"se" => "Sverige",
"sg" => "Singapore",
"sh" => "Saint Helena",
"si" => "Slovenien",
"sj" => "Svalbard og Jan Mayen",
"sk" => "Slovakiet",
"sl" => "Sierra Leone",
"sm" => "San Marino",
"sn" => "Senegal",
"so" => "Somalia",
"sr" => "Surinam",
"st" => "S&atilde;o Tom&eacute; &amp; Pr&iacute;ncipe",
"su" => "Sovjetunionen",
"sv" => "El Salvador",
"sy" => "Syrien",
"sz" => "Swaziland",
"tc" => "Turks og Caicos &Oslash;er",
"td" => "Tchad",
"tf" => "Franske Territorier i Sydhavet og Antarktis",
"tg" => "Togo",
"th" => "Thailand",
"tj" => "Tadsjikistan",
"tk" => "Tokelau",
"tl" => "&Oslash;ttimor",
"tm" => "Turkmenistan",
"tn" => "Tunesien",
"to" => "Tonga",
"tp" => "&Oslash;ttimor",
"tr" => "Tyrkiet",
"tt" => "Trinidad og Tobago",
"tv" => "Tuvalu",
"tw" => "Taiwan",
"tz" => "Tanzania",
"ua" => "Ukraine",
"ug" => "Uganda",
"uk" => "Storbritannien",
"um" => "US mindre &oslash;er i Oceanien og Vestindien",
"unknown" => "Ukendt",
"us" => "De Forenede Stater",
"uy" => "Uruguay",
"uz" => "Usbekistan",
"va" => "Vatikanstaten",
"vc" => "Saint Vincent og Grenadinerne",
"ve" => "Venezuela",
"vg" => "Britiske Jomfru&oslash;er",
"vi" => "Amerikanske Jomfru&oslash;er",
"vn" => "Vietnam",
"vu" => "Vanuatu",
"wf" => "Wallis og Futuna",
"ws" => "Samoa",
"ye" => "Yemen",
"yt" => "Mayotte",
"yu" => "Serbien og Montenegro",
"za" => "Sydafrika",
"zm" => "Zambia",
"zr" => "Zaire",
"zw" => "Zimbabwe",
);

// The main Translation array
$translation = array(
// Specific charset
"global_charset" => "utf-8",

// Global translation
"global_titlebar"=> "Statistics for %SERVER generated on %DATE",
"global_bbclone_copyright" => "The BBClone team - Licensed under the",
"global_last_reset" => "Statistik siden den",
"global_yes" => "Ja",
"global_no" => "Nej",

// The error messages
"error_cannot_see_config" =>
"Du har ikke tilladelse til at se BBClone konfigurationen p&aring; denne server.",

// Date format (used with date() )
"global_time_format" => "M jS, H:i:s",
"global_day_format" => "l F jS, Y",
"global_hours_format" => "l F jS, G:00",
"global_month_format" => "F Y",

// Miscellaneous translations
"misc_other" => "Andre",
"misc_unknown" => "Ukendt",
"misc_second_unit" => "sek.",
"misc_ignored" => "Udeladt",

// The Navigation Bar
"navbar_main_site" => "Hovedside",
"navbar_configuration" => "Konfiguration",
"navbar_global_stats" => "Generel Statistik",
"navbar_detailed_stats" => "Detaljeret Statistik",
"navbar_time_stats" => "Grafisk historik",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Tidspunkt",
"dstat_visits" => "Antal bes&oslash;g",
"dstat_extension" => "Topdom&aelig;ne",
"dstat_dns" => "V&aelig;rtsnavn",
"dstat_from" => "Kommer fra",
"dstat_os" => "OS",
"dstat_browser" => "Browser",
"dstat_visible_rows" => "Synlige bes&oslash;g",
"dstat_green_rows" => "gr&oslash;nne r&aelig;kker",
"dstat_blue_rows" => "bl&aring; r&aelig;kker",
"dstat_red_rows" => "r&oslash;de r&aelig;kker",
"dstat_search" => "S&oslash;g",
"dstat_last_page" => "Sidste side",
"dstat_last_visit" => "senest bes&oslash;gt",
"dstat_robots" => "robotter",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "Ingen tilg&aelig;ngelige data",
"dstat_prx" => "Proxy server",
"dstat_ip" => "IP-adresse",
"dstat_user_agent" => "User agent",
"dstat_nr" => "Nr.",
"dstat_pages" => "Sider",
"dstat_visit_length" => "Tid pr. side",
"dstat_reloads" => "Sideopdateringer",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Samlet oversigt over bes&oslash;gende",
"gstat_total_visits" => "Samlede hits",
"gstat_total_unique" => "Samlede unikke hits",
"gstat_operating_systems" => "Top %d operativsystemer",
"gstat_browsers" => "Top %d browsere",
"gstat_extensions" => "%d f&oslash;rste topdom&aelig;ner",
"gstat_robots" => "Top %d robotter",
"gstat_pages" => "%d f&oslash;rste sider",
"gstat_origins" => "%d f&oslash;rste oprindelser",
"gstat_hosts" => "Top %d internetudbydere",
"gstat_keys" => "Top %d s&oslash;geord",
"gstat_total" => "I alt",
"gstat_not_specified" => "Ikke specificeret",

// Time stats words
"tstat_su" => "S&oslash;n",
"tstat_mo" => "Man",
"tstat_tu" => "Tir",
"tstat_we" => "Ons",
"tstat_th" => "Tor",
"tstat_fr" => "Fri",
"tstat_sa" => "L&oslash;r",

"tstat_jan" => "Jan","tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_feb" => "Feb",
"tstat_mar" => "Mar",
"tstat_apr" => "Apr",
"tstat_may" => "Maj",
"tstat_jun" => "Jun",
"tstat_jul" => "Jul",
"tstat_aug" => "Aug",
"tstat_sep" => "Sep",
"tstat_oct" => "Okt",
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

"tstat_last_day" => "Forl&oslash;bne d&oslash;gn",
"tstat_last_week" => "Forl&oslash;bne uge",
"tstat_last_month" => "Sidste m&aring;ned",
"tstat_last_year" => "Sidste &aring;r",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "Variabelnavn",
"config_variable_value" => "Variabelv&aelig;rdi pt.",
"config_explanations" => "Forklaring",

"config_BBC_MAINSITE" =>
"Hvis denne variabel er sat, vil et link til den angivne placering blive genereret.
Standardv&aelig;rdien vil pege mod rodbiblioteket. I tilf&aelig;lde af at websitet
er placeret et andet sted, kan du angive en specifik sti eller url.<br />
Eksempler:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot; => (Standard)<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"BBClone viser konfigurationsindstillingerne som standard. Hvis det ikke &oslash;nskeses
kan du forhindre adgang ved at deaktivere denne mulighed.<br />
Eksempler:<br />
\$BBC_SHOW_CONFIG = 1; => Vis show_config.php (standard)<br />
\$BBC_SHOW_CONFIG = &quot;&quot;; => Vis ikke show_config.php",

"config_BBC_TITLEBAR" =>
"Titlen p&aring; alle BBClone siderne.<br />
Flg. makroer kan bruges:<br />
<ul>
<li>%SERVER: servernavn,</li>
<li>%DATE: nuv&aelig;rende dato.</li>
</ul>
HTML-tags m&aring; ogs&aring; bruges.<br />
Eksempler:<br />
\$BBC_TITLEBAR = &quot;Statistik for %SERVER genereret den %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;Min Statistik fra den %DATE er:&quot;;<br />",

"config_BBC_LANGUAGE" =>
"BBClones standardsprog, hvis ikke det er blevet specificeret af browseren.
F&oslash;lgende sprog underst&oslash;ttes:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, ua, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"Denne variabel definerer l&aelig;ngden af et unikt bes&oslash;g i sekunder. Hvert hit fra
den samme bes&oslash;gende inden for denne tidsperiode vil blive talt som eet bes&oslash;g, s&aring;
l&aelig;nge de to efterf&oslash;lgende hits ikke overskrider den angivne tidsperiode.
Webstandarden er 30 minutter (1800 sekunder), men denne tidsperiode kan &aelig;ndres efter
behov.<br />
Eksempler:<br />
\$BBC_MAXTIME = 0;  => Alle hits behandles som unikke<br />
\$BBC_MAXTIME = 1800;  => Alle hits af den samme bes&oslash;gende inden for 30 min. behandles som unikke",

"config_BBC_MAXVISIBLE" =>
"Hvor mange poster skal vises i den detaljerede statistik ad gangen? Standard er 100.
Det anbefales ikke at s&aelig;tte v&aelig;rdien h&oslash;jere for at undg&aring; tunge sider.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"Variablen \$BBC_DETAILED_STAT_FIELDS bestemmer hvilke s&oslash;jler der skal vises i
den detaljerede statistik. Mulighederne er:
<ul>
<li>id&nbsp;=&gt;&nbsp;Bes&oslash;gende nr. x siden begyndelsen</li>
<li>time&nbsp;=&gt;&nbsp;Tiden hvor hittet blev registreret</li>
<li>visits&nbsp;=&gt;&nbsp;Antal unikke bes&oslash;g</li>
<li>dns&nbsp;=&gt;&nbsp;Den bes&oslash;gendes internetudbyder</li>
<li>ip&nbsp;=&gt;&nbsp;Den bes&oslash;gendes IP-adresse</li>
<li>os&nbsp;=&gt;&nbsp;Operativsystemet (hvis tilg&aelig;ngeligt og/eller hvis det ikke er en robot)</li>
<li>browser&nbsp;=&gt;&nbsp;Software der er blevet brugt. (browsertype.)
</li>
<li>ext&nbsp;=&gt;&nbsp;Det land den bes&oslash;gende kommer fra eller den extension, han/hun har</li>
<li>referer&nbsp;=&gt;&nbsp;Det link, den bes&oslash;gende kommer fra (hvis tilg&aelig;ngeligt)
</li>
<li>page&nbsp;=&gt;&nbsp;Sidst bes&oslash;gte side</li>
<li>search&nbsp;=&gt;&nbsp;De s&oslash;geord, den bes&oslash;gende brugte (hvis tilg&aelig;ngeligt)</li>
</ul>
Den r&aelig;kkef&oslash;lge, s&oslash;jlerne angives i, vil blive brugt i visningen af statistikken.br />
Eksempler:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"Hvis serverens tidszone ikke passer med din egen lokale tid, kan du her tilpasse
tiden i minutter ved at bruge denne variabel. Negative v&aelig;rdier s&aelig;tter tiden tilbage,
positiver s&aelig;tter den frem.<br />
Eksempler:<br />
\$BBC_TIME_OFFSET = 300; => S&aelig;t tiden 5 timer frem. (5 x 60 min)<br />
\$BBC_TIME_OFFSET = -300; => S&aelig;t tiden 5 timer tilbage. (5 x 60 min)<br />
\$BBC_TIME_OFFSET = 0; => Ingen tidsforskel.",

"config_BBC_NO_DNS" =>
"Denne variabel bestemmer om IP-adresser skal omdannes til navnet p&aring; internet-
udbyderen. Navnet p&aring; udbyderen vil give mere information omkring den bes&oslash;gende,
men samtidig m&aring;ske sl&oslash;ve websiden, hvis de DNS-servere, der benyttes til opslag er langsomme,
begr&aelig;nsede i deres kapacitet er p&aring; andre m&aring;der up&aring;lidelige. Du kan sl&aring; denne mulighed
til eller fra.<br />
Eksempler:<br />
\$BBC_NO_DNS = 1; => IP-adresser vises som internetudbyder (standard)<br />
\$BBC_NO_DNS = &quot;&quot;; => Sl&aring; funktionen fra.",

"config_BBC_NO_HITS" =>
"BBClone viser som standard alle hits i tidsstatistikken (historikken), fordi
det giver et realistisk indtryk af servertrafikken. Men du kan ogs&aring; v&aelig;lge kun at
f&aring; vist unikke bes&oslash;g ved at &aelig;ndre denne variabel.<br />
Examples:<br />
\$BBC_NO_HITS = 1; => Vis alle hits i historik (standard)<br />
\$BBC_NO_HITS = &quot;&quot;; => Vis unikke bes&oslash;g i historik.",

"config_BBC_IGNORE_IP" =>
"Med denne mulighed kan du ekskludere bestemte IP-adresser eller hele r&aelig;kker
af adresser fra at blive talt med i statistikken. Hvis der angives flere adresser,
bruges komma som separator.<br />
Eksempler:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"Hvis du vil forhindre bestemte referrers fra dine bes&oslash;ende i at blive
oplistet i statistikken, kan du specificere et eller flere ord i
variablen nedenfor. Komma bruges som separator.<br />
Eksempler:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;; => (Standard)",

"config_BBC_IGNORE_BOTS" =>
"Du kan bestemme hvordan webrobotter skal behandles i statistikken. Standard
er at ignorere dem i udbyderstatistikken, men at lade dem optr&aelig;de i resten.
Hvis du ikke vil t&aelig;lle robotter overhovedet, kan du s&aelig;tte variablen til 2.
S&aring; vil kun menneskelige bes&oslash;gende tages i betragtning.<br />
Examples:<br />
\$BBC_IGNORE_BOTS = 2; => Ignor&eacute;r robotter helt.<br />
\$BBC_IGNORE_BOTS = 1; => Oplist ikke robotter under hosts.<br />
\$BBC_IGNORE_BOTS = &quot;&quot;; => Robotter regnes som alm. bes&oslash;gende.",

"config_BBC_IGNORE_AGENT" =>
"Denne indstilling definerer hvordan BBClone adskliller de bes&oslash;gende fra
hinanden. Standard er udelukkende at bruge IP-adressen, hvilket i de fleste tilf&aelig;lde
give helt realistiske tal. Hvis dine bes&oslash;gende er skjult bag proxy servere, kan deaktivering
af denne variabel give de mest realistiske tal, idet en ny bes&oslash;gende vil blive
bestemt jvf. &aelig;ndringer i systemoplysninger, etc.<br />
Eksempler:<br />
\$BBC_IGNORE_AGENT = 1; => Ignor&eacute;r en bes&oslash;gendes forskellige browsere<br />
\$BBC_IGNORE_AGENT = &quot;&quot;; => Hver &aelig;ndring i en bes&oslash;gendes browser skal opfattes som et seperat bes&oslash;g. (Standard)",

"config_BBC_KILL_STATS" =>
"N&aring;r du &oslash;nsker at nulstille statistikken kan du aktivere denne variabel, hvorved alt
nulstilles ved n&aelig;ste bes&oslash;g. Husk dog at s&aelig;tte variablen tilbage bagefter, da man ellers vil
opleve us&aelig;dvanlig lav traffik! ;)<br />
Eksempler:<br />
\$BBC_KILL_STATS = 1; => Slet alle data<br />
\$BBC_KILL_STATS = &quot;&quot;; => Behold alle indsamlede data. (Standard)",

"config_BBC_PURGE_SINGLE" =>
"Udbyder og referrer-statistik kan generere store m&aelig;ngder data, som oftest
skyldes engangs-bes&oslash;gende. Med denne variabel kan du t&oslash;mme disse poster
og g&oslash;re access.php betydeligt lettere uden at p&aring;virke den faktiske udbyder-
og referrer-statistik. Antallet af hits vil dermed blive lagt til
&quot;not_specified&quot;-posterne for at opretholde den overordnede score.<br />
Eksempler:<br />
\$BBC_PURGE_SINGLE = 1; => T&oslash;m udbydere and referrer poster.<br />
\$BBC_PURGE_SINGLE = &quot;&quot;; => behold alle poster (standard)"

);
?>
