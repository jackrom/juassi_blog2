<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: nb.php,v 1.44 2011/12/30 23:03:24 joku Exp $
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
 * translated by: Hans Fredrik Nordhaug, hans(at)nordhaug.priv.no
 * updated 28.02.2005 for BBClone 0.4.6e and latest 05.03.2007 for BBClone 0.4.9a
 */

// The DNS Extensions array
$extensions = array(
"travel" => "Travel",
"asia" => "Asia-Pacific",
"jobs" => "Employment",
"mobi" => "Mobiles",
"cat" => "Catalan",
"tel" => "Contacts",

"ac" => "Ascenci&oacute;n",
"ad" => "Andorra",
"ae" => "De forente arabiske emirater",
"aero" => "Aero",
"af" => "Afghanistan",
"ag" => "Antigua og Barbuda",
"ai" => "Anguilla",
"al" => "Albanien",
"am" => "Armenia",
"an" => "De nederlandske Antillene",
"ao" => "Angola",
"aq" => "Antarktis",
"ar" => "Argentina",
"arpa" => "Feil",
"as" => "Amerikansk Samoa",
"at" => "&Oslash;sterrike",
"au" => "Australia",
"aw" => "Aruba",
"ax" => "&Aring;land",
"az" => "Aserbajdsjan",
"ba" => "Bosnia-Hercegovina",
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
"br" => "Brasil",
"bs" => "Bahamas",
"bt" => "Bhutan",
"bv" => "Bouvet&oslash;ya",
"bw" => "Botswana",
"by" => "Hviterussland",
"bz" => "Belize",
"ca" => "Canada",
"cc" => "Kokos&oslash;yene",
"cd" => "Kongo",
"cf" => "Den sentralafrikanske republikken",
"cg" => "Kongo",
"ch" => "Sveits",
"ci" => "Elfenbenskysten",
"ck" => "Cook&oslash;yene",
"cl" => "Chile",
"cm" => "Kamerun",
"cn" => "Kina",
"co" => "Colombia",
"com" => "Kommersiell",
"coop" => "Coop",
"cr" => "Costa Rica",
"cs" => "Serbia og Montenegro",
"cu" => "Cuba",
"cv" => "Kap Verde",
"cx" => "Christmas&oslash;ya",
"cy" => "Kypros",
"cz" => "Tsjekkia",
"de" => "Tyskland",
"dj" => "Djibouti",
"dk" => "Danmark",
"dm" => "Dominica",
"do" => "Dominikanske republik",
"dz" => "Algerie",
"ec" => "Ecuador",
"edu" => "Utdannelse",
"ee" => "Estland",
"eg" => "Egypt",
"eh" => "Vest-Sahara",
"er" => "Eritrea",
"es" => "Spania",
"et" => "Etiopia",
"eu" => "Den europeiske union",
"fi" => "Finland",
"fj" => "Fiji",
"fk" => "Falklands&oslash;yene",
"fm" => "Mikronesia",
"fo" => "F&aelig;r&oslash;yene",
"fr" => "Frankrike",
"ga" => "Gabon",
"gb" => "Storbritannia",
"gd" => "Grenada",
"ge" => "Georgia",
"gf" => "Fransk Guyana",
"gg" => "Guernsey",
"gh" => "Ghana",
"gi" => "Gibraltar",
"gl" => "Gr&oslash;nnland",
"gm" => "Gambia",
"gn" => "Guinea",
"gov" => "De forente staters regjering",
"gp" => "Guadeloupe",
"gq" => "Ekvatorial-Guinea",
"gr" => "Hellea",
"gs" => "S&oslash;r-Georgia og de s&oslash;rlige Sandwich&oslash;yene",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guinea-Bissau",
"gy" => "Guyana",
"hk" => "Hongkong",
"hm" => "Heard- og McDonald&oslash;yene",
"hn" => "Honduras",
"hr" => "Kroatia",
"ht" => "Haiti",
"hu" => "Ungarn",
"id" => "Indonesia",
"ie" => "Irland",
"il" => "Israel",
"im" => "Isle of Man",
"in" => "India",
"info" => "Informasjon",
"int" => "Internasjonale organisajoner",
"io" => "Det britiske området i Indiahavet",
"iq" => "Irak",
"ir" => "Iran",
"is" => "Island",
"it" => "Italia",
"je" => "Jersey",
"jm" => "Jamaica",
"jo" => "Jordan",
"jp" => "Japan",
"ke" => "Kenya",
"kg" => "Kirgisistan",
"kh" => "Kambodsja",
"ki" => "Kiribati",
"km" => "Komorene",
"kn" => "Saint Christopher og Nevis",
"kp" => "Nord-Korea",
"kr" => "Korea",
"kw" => "Kuwait",
"ky" => "Cayman&oslash;yene",
"kz" => "Kasakhstan",
"la" => "Laos",
"lb" => "Libanon",
"lc" => "Saint Lucia",
"li" => "Liechtenstein",
"lk" => "Sri Lanka",
"lr" => "Liberia",
"ls" => "Lesotho",
"lt" => "Litauen",
"lu" => "Luxemburg",
"lv" => "Letland",
"ly" => "Libya",
"ma" => "Marokko",
"mc" => "Monaco",
"md" => "Moldova",
"me" => "Montenegro",
"mf" => "Saint-Martin",
"mg" => "Madagaskar",
"mh" => "Marshall&oslash;yene",
"mil" => "De forente staters milit&aelig;re",
"mk" => "Makedonia",
"ml" => "Mali",
"mm" => "Myanmar",
"mn" => "Mongolia",
"mo" => "Macau",
"mp" => "Nord-Marianene",
"mq" => "Martinique",
"mr" => "Mauritania",
"ms" => "Montserrat",
"mt" => "Malta",
"mu" => "Mauritius",
"museum" => "Museum",
"mv" => "Maldivene",
"mw" => "Malawi",
"mx" => "Mexico",
"my" => "Malaysia",
"mz" => "Mo&ccedil;ambique",
"na" => "Namibia",
"name" => "Personlig",
"nc" => "Ny-Caledonien",
"ne" => "Niger",
"net" => "Nettverk",
"nf" => "Norfolk &oslash;en",
"ng" => "Nigeria",
"ni" => "Nicaragua",
"nl" => "Nederland",
"no" => "Norge",
"np" => "Nepal",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "numerisk",
"nz" => "New Zealand",
"om" => "Oman",
"org" => "Organisasjoner",
"pa" => "Panama",
"pe" => "Peru",
"pf" => "Fransk Polynesia",
"pg" => "Papua Ny-Guinea",
"ph" => "Filippinene",
"pk" => "Pakistan",
"pl" => "Polen",
"pm" => "Saint Pierre og Miquelon",
"pn" => "Pitcairn",
"pr" => "Puerto Rico",
"pro" => "Profesjonell",
"ps" => "Palestina",
"pt" => "Portugal",
"pw" => "Palau",
"py" => "Paraguay",
"qa" => "Qatar",
"re" => "R&eacute;union",
"ro" => "Romania",
"rs" => "Serbia",
"ru" => "Russland",
"rw" => "Rwanda",
"sa" => "Saudi-Arabia",
"sb" => "Salomon&oslash;yene",
"sc" => "Seychellene",
"sd" => "Sudan",
"se" => "Sverige",
"sg" => "Singapore",
"sh" => "Saint Helena",
"si" => "Slovenia",
"sj" => "Svalbard og Jan Mayen",
"sk" => "Slovakia",
"sl" => "Sierra Leone",
"sm" => "San Marino",
"sn" => "Senegal",
"so" => "Somalia",
"sr" => "Surinam",
"st" => "Sao Tom&eacute; og Pr&iacute;ncipe",
"su" => "Sovjetunionen",
"sv" => "El Salvador",
"sy" => "Syria",
"sz" => "Swaziland",
"tc" => "Turks- og Caicos&oslash;yene",
"td" => "Tchad",
"tf" => "Franske s&oslash;rlige territorier",
"tg" => "Togo",
"th" => "Thailand",
"tj" => "Tadsjikistan",
"tk" => "Tokelau",
"tl" => "&Oslash;ttimor",
"tm" => "Turkmenistan",
"tn" => "Tunisia",
"to" => "Tonga",
"tp" => "&Oslash;ttimor",
"tr" => "Tyrkia",
"tt" => "Trinidad og Tobago",
"tv" => "Tuvalu",
"tw" => "Taiwan",
"tz" => "Tanzania",
"ua" => "Ukraina",
"ug" => "Uganda",
"uk" => "Storbritannia",
"um" => "US mindre &oslash;yer i Oceania og Vestindia",
"unknown" => "Ukjent",
"us" => "De forente stater",
"uy" => "Uruguay",
"uz" => "Usbekistan",
"va" => "Vatikanstaten",
"vc" => "Saint Vincent og Grenadinerne",
"ve" => "Venezuela",
"vg" => "Jomfru&oslash;yene (Storbritannia)",
"vi" => "Jomfru&oslash;yene (USA)",
"vn" => "Vietnam",
"vu" => "Vanuatu",
"wf" => "Wallis- og Futuna&oslash;yene",
"ws" => "Samoa",
"ye" => "Yemen",
"yt" => "Mayotte",
"yu" => "Serbia og Montenegro",
"za" => "S&oslash;rafrika",
"zm" => "Zambia",
"zr" => "Zaire",
"zw" => "Zimbabwe",
);

// The main Translation array
$translation = array(
// Specific charset
"global_charset" => "utf-8",

// Date format (used with date())
"global_time_format" => "M jS, H:i:s",
"global_day_format" => "l F jS, Y",
"global_hours_format" => "l F jS, G:00",
"global_month_format" => "F Y",

// Global translation
"global_titlebar"=> "Statistics for %SERVER generated on %DATE",
"global_bbclone_copyright" => "BBClone-laget - lisensiert under ",
"global_last_reset" => "Statistikk sist nullstilt p&aring;",
"global_yes" => "ja",
"global_no" => "nei",

// The error messages
"error_cannot_see_config" =>
"Du har ikke tillatelse til &aring; se BBClone konfigurasjonen p&aring; denne tjeneren.",
"error_cannot_see_development" =>
"Du har ikke tillatelse til &aring; se BBClone utviklingsverkt&oslash;y p&aring; denne tjeneren.",

// Miscellaneoux translations
"misc_other" => "Andre",
"misc_unknown" => "Ukjent",
"misc_second_unit" => "s",
"misc_ignored" => "Ignorert",

// The Navigation Bar
"navbar_main_site" => "Hovedside",
"navbar_configuration" => "Konfigurasjon",
"navbar_global_stats" => "Generell statistikk",
"navbar_detailed_stats" => "Detaljert statistikk",
"navbar_time_stats" => "Historikk",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Tidspunkt",
"dstat_visits" => "Bes&oslash;k",
"dstat_extension" => "Toppdomene",
"dstat_dns" => "Vertsnavn",
"dstat_from" => "Fra",
"dstat_os" => "OS",
"dstat_browser" => "Nettleser",
"dstat_visible_rows" => "Synlige bes&oslash;k",
"dstat_green_rows" => "gr&oslash;nne rekker",
"dstat_blue_rows" => "bl&aring; rekker",
"dstat_red_rows" => "r&oslash;de rekker",
"dstat_orange_rows" => "oransje rekker",
"dstat_search" => "Søk",
"dstat_last_page" => "Siste side",
"dstat_last_visit" => "seneste bes&oslash;k",
"dstat_robots" => "roboter",
"dstat_my_visit" => "Bes&oslash;k fra din IP",
"dstat_no_data" => "Ingen data tiljgjengelig",
"dstat_prx" => "Proxytjener",
"dstat_ip" => "IP-adresser",
"dstat_user_agent" => "Brukeragent",
"dstat_nr" => "Nr",
"dstat_pages" => "Sider",
"dstat_visit_length" => "Bes&oslash;klengde",
"dstat_reloads" => "Oppdateringer",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Bes&oslash;kende",
"gstat_total_visits" => "Samlede treff",
"gstat_total_unique" => "Samlede unike treff",
"gstat_operating_systems" => "Topp %d operativsystem",
"gstat_browsers" => "Topp %d nettlesere",
"gstat_extensions" => "Topp %d toppdomener",
"gstat_robots" => "Topp %d roboter",
"gstat_pages" => "Topp %d bes&oslash;kte sider",
"gstat_origins" => "Topp %d opprinnelser",
"gstat_hosts" => "Topp %d tjenere",
"gstat_keys" => "Topp %d n&oslash;kkelord",
"gstat_total" => "I alt",
"gstat_not_specified" => "Ikke spesifisert",

// Time stats words
"tstat_su" => "S&oslash;n",
"tstat_mo" => "Man",
"tstat_tu" => "Tir",
"tstat_we" => "Ons",
"tstat_th" => "Tor",
"tstat_fr" => "Fri",
"tstat_sa" => "L&oslash;r",

"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "Jan",
"tstat_feb" => "Feb",
"tstat_mar" => "Mar",
"tstat_apr" => "Apr",
"tstat_may" => "Mai",
"tstat_jun" => "Jun",
"tstat_jul" => "Jul",
"tstat_aug" => "Aug",
"tstat_sep" => "Sep",
"tstat_oct" => "Okt",
"tstat_nov" => "Nov",
"tstat_dec" => "Des",

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

"tstat_last_day" => "Siste d&oslash;gn",
"tstat_last_week" => "Siste uke",
"tstat_last_month" => "Siste m&aring;ned",
"tstat_last_year" => "Siste &aring;r",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "Variabelnavn",
"config_variable_value" => "Variabelverdi",
"config_explanations" => "Forklaring",

"config_BBC_MAINSITE" =>
"Hvis denne variablen er satt, vil en lenke til den oppgitte siden bli generert.
Standardverdien er foreldrekategorien. Hvis din hovedside er plassert et annet sted,
s&aring; vil du sannsynligvis justere verdien.<br />
Eksempler:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"BBClone tillater visning av innstillinger som standard. I tilfellet dette ikke er
&oslash;nsket, kan du hindre visning ved &aring; sl&aring; av denne opsjonen.<br />
Eksempler:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Tittelen p&aring; alle BBClone sidene.<br />
F&oslash;lgende makroer kan brukes:<br />
<ul>
<li>%SERVER: servernavn,</li>
<li>%DATE: n&aring;v&aelig;rende dato.</li>
</ul>
HTML-tagger kan ogs&aring; brukes.<br />
Eksempler:<br />
\$BBC_TITLEBAR = &quot;Statistics for %SERVER generated the %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;My Statistics from %DATE look like this:&quot;;<br />",

"config_BBC_LANGUAGE" =>
"Standard spr&aring;k i BBclone, hvis det ikke har blitt spesifisert av nettleseren.
F&oslash;lgende spr&aring;k er st&oslash;ttet:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, it, ja, ko, lt, mk, nb, nl, pl, pt-br, ro,
ru, sk, sl, sv, th, tr, zh-cn og zh-tw</p>",

"config_BBC_MAXTIME" =>
"Denne variabelen definerer varigheten for et unikt bes&oslash;k i sekunder.
Hvert treff fra den samme bes&oslash;kende vil bli betraktet som et
bes&oslash;k s&aring; lenge perioden mellom to p&aring;f&oslash;lgende treff
ikke overg&aring;r denne grensen. Standardverdien er de facto nettstandard
p&aring; 30 minutter (1800 sekunder), men avhengig av dine behov kan du endre
verdien.<br />
Eksempler:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Hvor mange oppf&oslash;ringer du vil ha listet i den detaljerte statistikken.
Standardverdien er 100. Det er ikke anbefalt &aring; sette verdien
h&oslash;yere enn 500 for &aring; unng&aring; for tung last p&aring;
netttjeneren.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"Variablen \$BBC_DETAILED_STAT_FIELDS bestemmer hvilke kolonner som skal
vises i den detaljerte statistikken. Mulige kolonner er:

<ul>
<li>id&nbsp;=&gt;&nbsp;Den x-te bes&oslash;kende siden du startet &aring; telle</li>
<li>time&nbsp;=&gt;&nbsp;Tidspunktet det siste treffet ble registrert</li>
<li>visits&nbsp;=&gt;&nbsp;Treff for en unik bes&oslash;kende</li>
<li>dns&nbsp;=&gt;&nbsp;Tjernernavn for bes&oslash;kende</li>
<li>ip&nbsp;=&gt;&nbsp;IP-adresse for den bes&oslash;kende</li>
<li>os&nbsp;=&gt;&nbsp;Operativsystemet (hvis tilgjengelig og/eller ikke en robot)</li>
<li>browser&nbsp;=&gt;&nbsp;Programvaren brukt for &aring; opprette forbindelsen, vanligvis en nettleser</li>
<li>ext&nbsp;=&gt;&nbsp;Land (eller extension) for den bes&oslash;kende</li>
<li>referer&nbsp;=&gt;&nbsp;Lenken til der den bes&oslash;kende kom fra (hvis tilgjengelig)</li>
<li>page&nbsp;=&gt;&nbsp;The last visited page</li>
<li>search&nbsp;=&gt;&nbsp;The search query a visitor used (if available)</li>
</ul>
Rekkef&oslash;lgen du oppgir kolonnene i, vil bli brukt ved visning.<br />
Eksempler:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"I tilfellet tjeneren ikke har samme tidssone som deg, kan du tilpasse tiden i
minutter ved hjelp av denne opsjonen. Negative verdier vil stille tiden tilbake,
positive vil stille den frem.<br />
Eksempler:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Denne opsjonen bestemmer om tjenernavnet for IP-adresser skal finnes eller ei.
Tjenernavn forteller mye mer om den bes&oslash;kende, men leting etter
tjenernavn kan senke hastigheten p&aring; nettstedet ditt hvis DNS-tjenerne som
blir brukt er trege.  Ved &aring; sl&aring; p&aring; denne variabelen kan
eventuelle hastighetsproblemer bli l&oslash;st.<br />
Eksempler:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"BBClone sin standard er &aring; vise treff i tidsstatistikken fordi det gir en
ganske god formening om den faktiske lasten p&aring; tjeneren. Hvis du heller
fortrekker &aring; bruke unike treff som basis for din tidsstatistikken, kan du
sl&aring; p&aring; denne opsjonen.<br />
Eksempler:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Denne opsjonen kan brukes til &aring; ekskludere enkelte IP-adresser eller
adresseomr&aring;der fra &aring; bli telt. Du kan legge til flere uttrykk ved
&aring; bruke komma som skilletegn.<br />
Eksempler:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"Hvis du ikke vil at enkelte referrers fra dine bes&oslash;kende skal listes i
rankingen eller den detaljerte statistikken, kan du oppgi en eller flere
n&oslash;kkelord brukt for &aring; blokkere referrers som inneholder
n&oslash;kkelordene. Bruk komma mellom n&oslash;kkelordene.<br />
Eksempler:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Du kan bruke denne opsjonen til &aring; bestemme behandling av roboter.
Standardvalg er &aring; eksludere tjenernavn fra roboter i din
tjener-ranking, men &aring; ta det med i alle andre statistikker. (Dette er opsjon
&quot;1&quot;.) Hvis du ikke vil se noen roboter i det hele tatt, sett opsjonen til
&quot;2&quot;, da vil kun menneskelige bes&oslash;k bli telt.<br />
Eksempler:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"Denne opsjonen bestemmer hvordan BBClone skiller en bes&oslash;kende fra en
annen. Standard er &aring; bruke IP-adressen som gir realistiske tall i de
fleste tilfeller. Hvis dine bes&oslash;kende often er gjemt bak proxytjenere,
kan du oppn&aring; mer realistiske tall ved &aring; sl&aring; av denne
opsjonen, siden da vil en ny bes&oslash;kende bli anta hver gang user agent har
blitt skiftet.<br />
Eksempler:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Sl&aring; p&aring; denne opsjonen for &aring; nullstille dine statistikker.
Ikke glem &aring; sl&aring; den av igjen etterp&aring; hvis ikke vil du
sannsynligvis oppleve uvanlig liten trafikk ;).<br />
Eksempler:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Tjener og referrer statistikk kan generere store mengder data - vanligvis
for&aring;rsaket av engangsbes&oslash;kende. Ved &aring; sl&aring; p&aring;
denne opsjonen kan du slette disse oppf&oslash;ringene og vesentlig redusere
st&oslash;rrelsen p&aring; access.php (som inneholder all statistikken for
nettsidene dine) uten &aring; p&aring;virke den faktisk synlig tjener og
referrer rankingen. Antall treff vil bli lagt til
&quot;not_specified&quot;-oppf&oslash;ringene for &aring; bevare det totale
antall treff intakt.<br />
Eksempler:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
