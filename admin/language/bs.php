<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: bs.php,v 1.20 2011/12/30 23:03:24 joku Exp $
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

// The DNS Extensions array
$extensions = array(
"travel" => "Travel",
"asia" => "Asia-Pacific",
"jobs" => "Employment",
"mobi" => "Mobiles",
"cat" => "Catalan",
"tel" => "Contacts",

"ac" => "Ascension Island",
"ad" => "Andora",
"ae" => "Ujedinjeni Arapski Emirati",
"aero" => "Aero",
"af" => "Afganistan",
"ag" => "Antigua i Barbuda",
"ai" => "Anguila",
"al" => "Albanija",
"am" => "Armenija",
"an" => "Netherlands Antilles",
"ao" => "Angola",
"aq" => "Antarktika",
"ar" => "Argentina",
"arpa" => "Arpa",
"as" => "Americka Samoa",
"at" => "Austrija",
"au" => "Australija",
"aw" => "Aruba",
"ax" => "Ålandska ostrva",
"az" => "Azerbaidžan",
"ba" => "Bosnia i Herzegovina",
"bb" => "Barbados",
"bd" => "Bangladeš",
"be" => "Belgija",
"bf" => "Burkina Faso",
"bg" => "Bugarska",
"bh" => "Bahrain",
"bi" => "Burundi",
"biz" => "Biznis",
"bj" => "Benin",
"bl" => "Sveti Bartolomej",
"bm" => "Bermuda",
"bn" => "Brunei",
"bo" => "Bolivija",
"br" => "Brazil",
"bs" => "Bahame",
"bt" => "Butan",
"bv" => "Bouvet ostrva",
"bw" => "Botsvana",
"by" => "Bijelorusija",
"bz" => "Belize",
"ca" => "Kanada",
"cc" => "Kokos ostrva",
"cd" => "Kongo",
"cf" => "Centralno Africka republika",
"cg" => "Kongo",
"ch" => "Švicerska",
"ci" => "Ivory Coast",
"ck" => "Cook Islands",
"cl" => "Cile",
"cm" => "Kamerun",
"cn" => "Kina",
"co" => "Kolumbija",
"com" => "Komercijalna",
"coop" => "Coop",
"cr" => "Kosta Rika",
"cs" => "Serbija i Crna Gora",
"cu" => "Kuba",
"cv" => "Cape Verde",
"cx" => "Christmas Island",
"cy" => "Kipar",
"cz" => "Ceška Republika",
"de" => "Njemacka",
"dj" => "Džiboti",
"dk" => "Danska",
"dm" => "Dominika",
"do" => "Dominikanska Republika",
"dz" => "Algerija",
"ec" => "Ekvador",
"edu" => "Edukaciona",
"ee" => "Estonija",
"eg" => "Egipt",
"eh" => "Western Sahara",
"er" => "Eritrea",
"es" => "Španija",
"et" => "Etiopia",
"eu" => "Evropska unija",
"fi" => "Finska",
"fj" => "Fidži",
"fk" => "Falkland Islands",
"fm" => "Micronesia",
"fo" => "Faroe Islands",
"fr" => "Francuska",
"ga" => "Gabon",
"gb" => "Ujedinjeno Kraljevstvo",
"gd" => "Grenada",
"ge" => "Georgia",
"gf" => "French Guiana",
"gg" => "Guernsey",
"gh" => "Ghana",
"gi" => "Gibraltar",
"gl" => "Grenland",
"gm" => "Gambia",
"gn" => "Guinea",
"gov" => "US Government",
"gp" => "Guadeloupe",
"gq" => "Equatorial Guinea",
"gr" => "Grcka",
"gs" => "South Georgia and the South Sandwich Islands",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guinea-Bisau",
"gy" => "Guiana",
"hk" => "Hong Kong",
"hm" => "Heard i Mc Donald Islands",
"hn" => "Honduras",
"hr" => "Hrvatska",
"ht" => "Haiti",
"hu" => "Hungary",
"id" => "Indonezija",
"ie" => "Ireland",
"il" => "Izrael",
"im" => "Isle of Man",
"in" => "Indija",
"info" => "Informaciona",
"int" => "Internacionalna organizacija",
"io" => "UK Indian Ocean Territory",
"iq" => "Irak",
"ir" => "Iran",
"is" => "Island",
"it" => "Italija",
"je" => "Jersey",
"jm" => "Jamaika",
"jo" => "Jordan",
"jp" => "Japan",
"ke" => "Kenija",
"kg" => "Kirgizstan",
"kh" => "CKambodža",
"ki" => "Kiribati",
"km" => "Comoros",
"kn" => "Saint Kitts and Nevis",
"kp" => "Sjeverna Korea",
"kr" => "Korea",
"kw" => "Kuvait",
"ky" => "Cayman Islands",
"kz" => "Kazakhstan",
"la" => "Laos",
"lb" => "Libanon",
"lc" => "Saint Lucia",
"li" => "Liehtenštajn",
"lk" => "Šri Lanka",
"lr" => "Liberia",
"ls" => "Lesotho",
"lt" => "Litvanija",
"lu" => "Luksemburg",
"lv" => "Latvija",
"ly" => "Libija",
"ma" => "Moroko",
"mc" => "Monaco",
"md" => "Moldova",
"me" => "Montenegro",
"mf" => "Saint Martin",
"mg" => "Madagaskar",
"mh" => "Marshall Islands",
"mil" => "US armija",
"mk" => "Makedonija",
"ml" => "Mali",
"mm" => "Myanmar",
"mn" => "Mongolija",
"mo" => "Macau",
"mp" => "Northern Mariana Islands",
"mq" => "Martinique",
"mr" => "Mauritania",
"ms" => "Montserrat",
"mt" => "Malta",
"museum" => "Muzeum",
"mu" => "Mauritius",
"mv" => "Maldives",
"mw" => "Malawi",
"mx" => "Mexico",
"my" => "Malaysia",
"mz" => "Mozambique",
"na" => "Namibia",
"name" => "Personalna",
"nc" => "New Caledonia",
"ne" => "Niger",
"net" => "Networks",
"nf" => "Norfolk Island",
"ng" => "Nigeria",
"ni" => "Nicaragua",
"nl" => "Netherlands",
"no" => "Norway",
"np" => "Nepal",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Brojčano",
"nz" => "Novi Zealand",
"om" => "Oman",
"org" => "Organizacije",
"pa" => "Panama",
"pe" => "Peru",
"pf" => "French Polynesia",
"pg" => "Papua New Guinea",
"ph" => "Filipine",
"pk" => "Pakistan",
"pl" => "Poljska",
"pm" => "St. Pierre and Miquelon",
"pn" => "Pitcairn",
"pr" => "Puerto Rico",
"pro" => "Profesionalna",
"ps" => "Palestina",
"pt" => "Portugal",
"pw" => "Palau",
"py" => "Paragvaj",
"qa" => "Katar",
"re" => "Reunion",
"ro" => "Rumunija",
"rs" => "Srbija",
"ru" => "Rusija",
"rw" => "Rwanda",
"sa" => "Saudijska Arabija",
"sb" => "Solomon Islands",
"sc" => "Seychelles",
"sd" => "Sudan",
"se" => "Sweden",
"sg" => "Singapore",
"sh" => "St. Helena",
"si" => "Slovenija",
"sj" => "Svalbard and Jan Mayen Islands",
"sk" => "Slovacka",
"sl" => "Sierra Leone",
"sm" => "San Marino",
"sn" => "Senegal",
"so" => "Somalia",
"sr" => "Suriname",
"st" => "Sao Tome and Principe",
"su" => "Soviet Union",
"sv" => "El Salvador",
"sy" => "Sirija",
"sz" => "Švicerska",
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
"tp" => "East Timor",
"tr" => "Turska",
"tt" => "Trinidad and Tobago",
"tv" => "Tuvalu",
"tw" => "Taiwan",
"tz" => "Tanzania",
"ua" => "Ukraine",
"ug" => "Uganda",
"uk" => "United Kingdom",
"um" => "US Minor Outlying Islands",
"unknown" => "Nepoznato",
"us" => "Sjedinjene države",
"uy" => "Uruguaj",
"uz" => "Uzbekistan",
"va" => "Vatican State",
"vc" => "St. Vincent and the Grenadines",
"ve" => "Venezuela",
"vg" => "Virgin Islands (UK)",
"vi" => "Virgin Islands (US)",
"vn" => "Vietnam",
"vu" => "Vanuatu",
"wf" => "Wallis and Futuna Islands",
"ws" => "Samoa",
"ye" => "Yemen",
"yt" => "Mayotte",
"yu" => "Srbija i Crna Gora",
"za" => "South Africa",
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
"global_bbclone_copyright" => "The BBClone team - Licenzirano pod",
"global_last_reset" => "Zadnje resetovanje statistike",
"global_yes" => "da",
"global_no" => "ne",

// The error messages
"error_cannot_see_config" =>
"Vama nije dozvoljeno vidjeti statistike.",

// Miscellaneous translations
"misc_other" => "Ostali",
"misc_unknown" => "Nepoznato",
"misc_second_unit" => "s",
"misc_ignored" => "Ignorisano",

// The Navigation Bar
"navbar_main_site" => "Glavna stranica",
"navbar_configuration" => "Konfiguracija",
"navbar_global_stats" => "Globalne statistike",
"navbar_detailed_stats" => "Detaljna statistika",
"navbar_time_stats" => "Vremeska statistika",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Vrijeme",
"dstat_visits" => "Posjete",
"dstat_extension" => "Ekstenzija",
"dstat_dns" => "Hostname",
"dstat_from" => "Od",
"dstat_os" => "OS",
"dstat_browser" => "Browser",
"dstat_visible_rows" => "Vidljivi pristupi",
"dstat_green_rows" => "zeleni redovi",
"dstat_blue_rows" => "plavi redovi",
"dstat_red_rows" => "crveni redovi",
"dstat_search" => "Pretraga",
"dstat_last_page" => "Predhodna stranica",
"dstat_last_visit" => "zadnja posjeta",
"dstat_robots" => "Roboti",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "Bez podataka",
"dstat_prx" => "Proxy Server",
"dstat_ip" => "IP adresa",
"dstat_user_agent" => "Korisnicki agent",
"dstat_nr" => "Br",
"dstat_pages" => "Stranica",
"dstat_visit_length" => "Duzina posjete",
"dstat_reloads" => "Osvježavanja",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Pristupi",
"gstat_total_visits" => "Ukupno posjeta",
"gstat_total_unique" => "Ukupno jedinstvenih",
"gstat_operating_systems" => "Prvih %d operativnih sistema",
"gstat_browsers" => "Prvih %d browsera",
"gstat_extensions" => "Prvih %d ekstenzija",
"gstat_robots" => "Prvih %d robota",
"gstat_pages" => "Prvih %d posjecenih stranica",
"gstat_origins" => "Prvih %d Origins",
"gstat_hosts" => "Prvih %d hostova",
"gstat_keys" => "Prvih %d Keywords",
"gstat_total" => "Ukupno",
"gstat_not_specified" => "Nije dato",

// Time stats words
"tstat_su" => "Nedj",
"tstat_mo" => "Pon",
"tstat_tu" => "Uto",
"tstat_we" => "Sri",
"tstat_th" => "Cet",
"tstat_fr" => "Pet",
"tstat_sa" => "Sub",

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

"tstat_last_day" => "Jučer",
"tstat_last_week" => "Prošle sedmice",
"tstat_last_month" => "Prošlog mjeseca",
"tstat_last_year" => "Prošle godine",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "Ime varijable",
"config_variable_value" => "Vrijednost varijable",
"config_explanations" => "Objašnjenje",

"config_BBC_MAINSITE" =>
"Ako je ova variabla uključena, bit ce generisan link do određene lokacije. 
Defaultna variabla je podešena za folder iznad foldera BBClone skripte. U slučaju da se 
vaš sajt nalazi na drugom serveru, onda morate napisati dodatne izmjene.<br />
Primjeri:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"BBClone je defaultno podešen da prikazuje Konfiguraciju. U slučaju da to ne želite
onda jednostavno upotrebom ove varijable iskljucite tu opciju.<br />
Primjeri:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Naslov vaše stranice za statistike.<br />
Bit će prikazano ispod navigacije svake BBClone stranice<br />
Sljedeći macrosi su validni:<br />
<ul>
<li>%SERVER: ime servera,</li>
<li>%DATE: trenutno vrijeme.</li>
</ul>
HTML Tagovi su dozvoljeni.<br />
Primjeri:<br />
\$BBC_TITLEBAR = &quot;Statistike za %SERVER generisane %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;Moja statistika %DATE je izgledala ovako:&quot;;
<br />",

"config_BBC_LANGUAGE" =>
"BBCloneov defaultni jezik, u slučaju da nije podešen od strane browsera.
Lista jezika:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, ua, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"Ova variabla definiše dužinu jedinstvene posjete. Svaki hit istog posjetioca
u odredenom vremenskom periodu će biti tretiran kao jedinstvena posjeta. Defaultna vrijednost je de facto
web standard odnosno 30 minuta što odgovara 1800 sekundi,  ali u zavisnosti od vaših potreba variabla 
je promjenjiva.<br />
Primjeri:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Odredivanje broja različitih browsera, operativnih sistema itd. koji će biti prikazani u listi? 
Defaultna vrijednost je 100. Preporučuje se postaviti manje od 500 prikaza jer prevelik broj otežava
učitavanje stranice.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"Variabla \$BBC_DETAILED_STAT_FIELDS podešava boju celija u Detaljnoj statistici.
 Moguće ćelije su:
<ul>
<li>id&nbsp;=&gt;&nbsp;x-ni posjetioc od početka brojanja</li>
<li>time&nbsp;=&gt;&nbsp;Vrijeme kada je posjetitelj registrovan</li>
<li>visits&nbsp;=&gt;&nbsp;Broj osvježenja</li>
<li>dns&nbsp;=&gt;&nbsp;Hostname posjetioca</li>
<li>ip&nbsp;=&gt;&nbsp;IP adresa</li>
<li>os&nbsp;=&gt;&nbsp;Operativni sustav ili sistem posjetioca</li>
<li>browser&nbsp;=&gt;&nbsp;Software koji je bio iskoristen za pristup stranici (Browser)</li>
<li>ext&nbsp;=&gt;&nbsp;Država ili oznaka posjetica</li>
<li>referer&nbsp;=&gt;&nbsp;Link, kojim je posjetioc putovao</li>
<li>page&nbsp;=&gt;&nbsp;Posljednja posjećena stranica</li>
<li>search&nbsp;=&gt;&nbsp;Ključne riječi koje je koristio posjetioc</li>
</ul><br />
Primjeri:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"Ako se serversko i vaše vrijeme nepodudara, podesite ga putem ove variable 
upisivanjem razlike vremena u minutama. Negativni broj vraća vrijeme
unazad dok pozitivni pomjera unaprijed.<br />
Primjeri:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Opcija podešaje dali da se IP adresa razlaže u hostname ili ne.<br />
Primjeri:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"Standardno ponašanje BBClonea je, prikazivanje hitsova u vremenskoj statistici jer to 
pokazuje stvarnu opterećenost servera. Ali ako ćete radije koristiti jedinstvene posjete 
kao osnovicu vremenske statistike možete koristiti ovu varijablu.<br />
Primjeri:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Ova opcija se može koristiti da bi se određene IP adrese isključile
iz odbrojavanja statistike. Ako želite koristiti više
različitih IP adresa onda ih morate razdvajati zarezom.<br />
Primjeri:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"Ako želite da se određeni Referreri ne prikazuju u statistici, jednostavno ih 
upišite u variablu i odvajajte ih sa zarezom..<br />
Primjeri:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Koristite ovu opciju ako želite brojati robote u vašoj statistici.
Standardno je da se botovi ignoriraju u listi Hostova, ali da se
ubrojavaju u ostalim statistikama. Ako želite da se robori uopće ne 
prikazuju onda morate variablu postaviti na &quot;2&quot;, tako će
se brojati samo posjete osoba a ne robota.<br />
Primjeri:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"Je opcija koja služi za definisanje načina na koji BBClone razlikuje posjetioce. 
Standardno je razlikovanje samo po IP adresi, što prikazuje najčešće realnu posjećenost.<br />
Primjeri:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Svaki put kada resetujete vašu statistiku možete koristiti ovu opciju koja automatski briše
statistiku nakon prve posjete nekog posjetioca. Nemojte zaboraviti isključiti
ovu opciju nakon sto se statistika resetuje.<br />
Primjeri:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Host i Referrer statistika može prouzrokovati veliku količinu podataka koji
najčešće potiču od jedinstvenih posjetioca. Aktiviranjem ove opcije se brišu 
takvi zapisi i veličina access.php datoteke se znatno smanjuje.<br />
Primjeri:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
