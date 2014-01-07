<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: lt.php,v 1.64 2011/12/30 23:03:24 joku Exp $
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
 * Translated by: Vilius Simonaitis <maumas98@yahoo.com>
 * Corrected by: Viačeslav Giedroit <slv@baltas.net>
 */

// The DNS Extensions array
$extensions = array(
"travel" => "Travel",
"asia" => "Asia-Pacific",
"jobs" => "Employment",
"mobi" => "Mobiles",
"cat" => "Catalan",
"tel" => "Contacts",

"ac" => "Prisikėlimo Sala",
"ad" => "Andora",
"ae" => "Jungtiniai arabų emiratai",
"aero" => "Aero",
"af" => "Afghanistanas",
"ag" => "Antigva ir Barbuda",
"ai" => "Angila",
"al" => "Albanija",
"am" => "Armenija",
"an" => "Skandinavų Antilai",
"ao" => "Angola",
"aq" => "Antarktika",
"ar" => "Argentina",
"arpa" => "Klaidos",
"as" => "Amerikos Samoa",
"at" => "Austrija",
"au" => "Australija",
"aw" => "Aruba",
"ax" => "Alandai",
"az" => "Azerbaidžianas",
"ba" => "Bosnija and Hercogovina",
"bb" => "Barbadosas",
"bd" => "Bangladešas",
"be" => "Belgija",
"bf" => "Burkina Faso",
"bg" => "Bulgarija",
"bh" => "Bachrainas",
"bi" => "Burundi",
"biz" => "Verslas",
"bj" => "Beninas",
"bl" => "Šv. Bartolomėjaus sala",
"bm" => "Bermudai",
"bn" => "Brunėjus",
"bo" => "Bolivija",
"br" => "Brazilija",
"bs" => "Bahamai",
"bt" => "Bhutanas",
"bv" => "Bouvet Island",
"bw" => "Botsvana",
"by" => "Belarus",
"bz" => "Belizė",
"ca" => "Kanada",
"cc" => "Kokoso Salos",
"cd" => "Kongas",
"cf" => "Centrinės Afrikos Respublika",
"cg" => "Kongas",
"ch" => "Šveicarija",
"ci" => "Ivory Coast",
"ck" => "Gegutės Salos",
"cl" => "Čilė",
"cm" => "Kamerūnas",
"cn" => "Kinija",
"co" => "Kolombija",
"com" => ".com",
"coop" => "Coop",
"cr" => "Kosta Rika",
"cs" => "Serbia and Montenegro",
"cu" => "Kuba",
"cv" => "Cape Verde",
"cx" => "Kalėdų Salos",
"cy" => "Kipras",
"cz" => "Čekijos respublika",
"de" => "Vokietija",
"dj" => "Djibouti",
"dk" => "Danija",
"dm" => "Dominika",
"do" => "Dominikos Respublika",
"dz" => "Algerija",
"ec" => "Ekvadoras",
"edu" => ".edu",
"ee" => "Estija",
"eg" => "Egiptas",
"eh" => "Western Sahara",
"er" => "Eritrea",
"es" => "Ispanija",
"et" => "Etiopija",
"eu" => "European Union",
"fi" => "Suomija",
"fj" => "Fidži",
"fk" => "Folklando Salos",
"fm" => "Mikronezija",
"fo" => "Faraonų Salos",
"fr" => "Prancūzija",
"ga" => "Gabonas",
"gb" => "Jungtinės Karalystės",
"gd" => "Grenada",
"ge" => "Georgija",
"gf" => "Prancūzų Gujana",
"gg" => "Guernsey",
"gh" => "Gana",
"gi" => "Gibraltaras",
"gl" => "Greenland'as",
"gm" => "Gambija",
"gn" => "Gvinėja",
"gov" => "Vyriausybė (.gov)",
"gp" => "Gvadelupė",
"gq" => "Ekvatorinė Gvinėja",
"gr" => "Graikija",
"gs" => "Pietų Georgija ir Pietų Buterbrodo Salos",
"gt" => "Gvatemala",
"gu" => "Guama",
"gw" => "Gvinėja-Bissau",
"gy" => "Gujana",
"hk" => "Hong-Kongas",
"hm" => "Heard ir Mc Donald Salos",
"hn" => "Honduras",
"hr" => "Kroatija",
"ht" => "Haitis",
"hu" => "Vangrija",
"id" => "Indonezija",
"ie" => "Airija",
"il" => "Izraelis",
"im" => "Vyro sala",
"in" => "Indija",
"info" => "Informacinės Tarnybos",
"int" => "Tarptautinės Organizacijos",
"io" => "Britų Indijos Vandenyno teritorijos",
"iq" => "Irakas",
"ir" => "Iranas",
"is" => "Islandija",
"it" => "Italija",
"je" => "Džersis",
"jm" => "Jamaika",
"jo" => "Jordanija",
"jp" => "Japonija",
"ke" => "Kenia",
"kg" => "Kirgistanas",
"kh" => "Cambodža",
"ki" => "Kiribati",
"km" => "Komorosas",
"kn" => "Saint Kitts and Nevis",
"kp" => "North Korea",
"kr" => "Korėja",
"kw" => "Kuveitas",
"ky" => "Caimanų Salos",
"kz" => "Kazakstanas",
"la" => "Laosas",
"lb" => "Lebanonas",
"lc" => "Šventoji Liucija",
"li" => "Liechtenšteinas",
"lk" => "Šri Lanka",
"lr" => "Liberija",
"ls" => "Lesotas",
"lt" => "Lietuva",
"lu" => "Liuksemburgas",
"lv" => "Latvija",
"ly" => "Libija",
"ma" => "Marokas",
"mc" => "Monakas",
"md" => "Moldova",
"me" => "Juodkalnija",
"mf" => "San Martenas",
"mg" => "Madagaskaras",
"mh" => "Maršalo Salos",
"mil" => "Jungtinių Tautų karinė tarnyba",
"mk" => "Makedonija",
"ml" => "Mali",
"mm" => "Myanmar",
"mn" => "Mongolija",
"mo" => "Makau",
"mp" => "Šiaurinės Marijanos Salos",
"mq" => "Martinika",
"mr" => "Mauritanija",
"ms" => "Montserrat",
"mt" => "Malta",
"mu" => "Mauricijus",
"museum" => "Museum",
"mv" => "Maldivai",
"mw" => "Malawi",
"mx" => "Meksika",
"my" => "Malaizija",
"mz" => "Mozambikas",
"na" => "Namibija",
"name" => "Personal",
"nc" => "Naujoji Caledonija",
"ne" => "Nigeris",
"net" => ".net",
"nf" => "Norfolk'o Sala",
"ng" => "Nigerija",
"ni" => "Nikaragva",
"nl" => "Netherlands",
"no" => "Norvegija",
"np" => "Nepalas",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Skaitinis",
"nz" => "Naujoji Zelandija",
"om" => "Omanas",
"org" => ".org",
"pa" => "Panama",
"pe" => "Peru",
"pf" => "Prancūzų Polinezija",
"pg" => "Papua Naujoji Gvinėja",
"ph" => "Filipinai",
"pk" => "Pakistanas",
"pl" => "Lenkija",
"pm" => "Šv. Pierre ir Miquelon",
"pn" => "Pitcairn",
"pr" => "Puerto Rikas",
"pro" => "Professional",
"ps" => "Palestina",
"pt" => "Portugalija",
"pw" => "Palau",
"py" => "Paragvajus",
"qa" => "Qatar",
"re" => "Reunion",
"ro" => "Rumunija",
"rs" => "Serbija",
"ru" => "Rusijos federacija",
"rw" => "Rovanda",
"sa" => "Saudo Arabija",
"sb" => "Saliamono Salos",
"sc" => "Seišeliai",
"sd" => "Sudanas",
"se" => "Švedija",
"sg" => "Singapūras",
"sh" => "Šv. Helena",
"si" => "Slovėnija",
"sj" => "Svalbard and Jan Mayen Islands",
"sk" => "Slovakija",
"sl" => "Siera Leonas",
"sm" => "San Marinas",
"sn" => "Senegalas",
"so" => "Somalia",
"sr" => "Surinamas",
"st" => "Sao Tome and Principe",
"su" => "Savietų Sąjunga",
"sv" => "El Salvadoras",
"sy" => "Sirija",
"sz" => "Swaziland'as",
"tc" => "Turks and Caicos Islands",
"td" => "Čiadas",
"tf" => "Prancūzų Pietų teritorijos",
"tg" => "Togo",
"th" => "Tailandas",
"tj" => "Taikistanas",
"tk" => "Tokelau",
"tl" => "Rytų Timūras",
"tm" => "Turkmenistanas",
"tn" => "Tunisija",
"to" => "Tongas",
"tp" => "Rytų Timūras",
"tr" => "Turkija",
"tt" => "Trinidadas ir Tobagas",
"tv" => "Tuvalu",
"tw" => "Taivan",
"tz" => "Tanzanija",
"ua" => "Ukraina",
"ug" => "Uganda",
"uk" => "Jungtinės Karalystės",
"um" => "US Minor Outlying Islands",
"unknown" => "Nežinoma",
"us" => "JAV",
"uy" => "Urugvajus",
"uz" => "Uzbekistanas",
"va" => "Vatikanas",
"vc" => "Šv. Vincent ir Grenadines",
"ve" => "Venesuela",
"vg" => "Virginijos Salos (UK)",
"vi" => "Virginijos Salos (US)",
"vn" => "Vietnamas",
"vu" => "Vanuatu",
"wf" => "Uolio irFutunos salos",
"ws" => "Samoa",
"ye" => "Jemenas",
"yt" => "Majotas",
"yu" => "Serbia and Montenegro",
"za" => "Pietų Afrika",
"zm" => "Zambija",
"zr" => "Zairas",
"zw" => "Zimbabvė",
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
"global_bbclone_copyright" => "BBClone komanda - Licenzijuota pagal",
"global_last_reset" => "Statistics last reset on",
"global_yes" => "taip",
"global_no" => "ne",

// The error messages
"error_cannot_see_config" =>
"Jums nėra leista matyti BBClone konfigūracijos šiame serveryje.",

// Miscellaneoux translations
"misc_other" => "Kita",
"misc_unknown" => "Nežinoma",
"misc_second_unit" => "s",
"misc_ignored" => "Ignored",

// The Navigation Bar
"navbar_main_site" => "Titulinis",
"navbar_configuration" => "Konfigūracija",
"navbar_global_stats" => "Globali Statistika",
"navbar_detailed_stats" => "Detali Statistika",
"navbar_time_stats" => "Laikmatis",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Laikas",
"dstat_visits" => "Apsilankymai",
"dstat_extension" => "Išplėtimas",
"dstat_dns" => "Hostname'as",
"dstat_from" => "Iš kur",
"dstat_os" => "OS",
"dstat_browser" => "Naršyklė",
"dstat_visible_rows" => "Matoma užklausų",
"dstat_green_rows" => "žalios eilutės",
"dstat_blue_rows" => "mėlynos eilutės",
"dstat_red_rows" => "raudonos eilutės",
"dstat_search" => "Search",
"dstat_last_page" => "Last Page",
"dstat_last_visit" => "paskutinis apsilankymas",
"dstat_robots" => "paieškos sistemos",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "Nėra duomenų",
"dstat_prx" => "Proxy Serveris",
"dstat_ip" => "IP Addresas",
"dstat_user_agent" => "User Agent",
"dstat_nr" => "Nr",
"dstat_pages" => "Puslapiai",
"dstat_visit_length" => "Apsilankymo trukmė",
"dstat_reloads" => "Perkrovimai",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Užklausos",
"gstat_total_visits" => "Viso apsilankymų",
"gstat_total_unique" => "Viso unikalių",
"gstat_operating_systems" => "Operacinės sistemos",
"gstat_browsers" => "Naršyklės",
"gstat_extensions" => "%d pirmų plėtinių",
"gstat_robots" => "Paieškos sistemos",
"gstat_pages" => "%d pirmų puslapių",
"gstat_origins" => "%d pirmų nuorodų",
"gstat_hosts" => "%d pirmų Hostų",
"gstat_keys" => "%d pirmų raktažodžių",
"gstat_total" => "Viso",
"gstat_not_specified" => "Nenurodyta",

// Time stats words
"tstat_su" => "Sek",
"tstat_mo" => "Pir",
"tstat_tu" => "Ant",
"tstat_we" => "Tre",
"tstat_th" => "Ket",
"tstat_fr" => "Pen",
"tstat_sa" => "Šeš",

"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "Sau",
"tstat_feb" => "Vas",
"tstat_mar" => "Kov",
"tstat_apr" => "Bal",
"tstat_may" => "Geg",
"tstat_jun" => "Bir",
"tstat_jul" => "Lie",
"tstat_aug" => "Rugp",
"tstat_sep" => "Rugs",
"tstat_oct" => "Spa",
"tstat_nov" => "Lap",
"tstat_dec" => "Gruo",

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

"tstat_last_day" => "Pastarają dieną",
"tstat_last_week" => "Pastarają savaitę",
"tstat_last_month" => "Pastarajį menėsį",
"tstat_last_year" => "Pastaraisiais metais",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "Kintamojo vardas",
"config_variable_value" => "Kintamojo reikšmė",
"config_explanations" => "Paaiškinimas",

"config_BBC_MAINSITE" =>
"Šis kintamasis nusako nuorodą į svetainę. Pagal nutylėjimą, svetainės
adresu laikoma aukštesnė direktorija. Jei Jūsų svetainė yra kur nors kitur,
galite pritakyti šią nuorodą savo reikmėms.<br />
Pavyzdžiai:<br />
\$BBC_MAINSITE = &quot;http://www.svetaine.lt/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"BBClone statistikos' nustatymų peržiūra. Šiuo kintamuoju galite
uždrausti jų peržiūrą.<br />
Pavyzdžiai:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Tekstas, atsirandantis antraštėje, visuose BBClone puslapiuose.<br />
Galima naudoti tokius kintamuosius:<br />
<ul>
<li>%SERVER: serverio adresas,</li>
<li>%DATE: dabartinė data.</li>
</ul>
Taip pat galima naudoti ir HTML.<br />
Pavyzdžiai:<br />
\$BBC_TITLEBAR = &quot;%SERVER statistika sugeneruota %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;Mano statistika %DATE buvo tokia:&quot;;
<br />",

"config_BBC_LANGUAGE" =>
"BBClone kalba pagal nutylėjimą, nustatoma tam atvejui, jei naršylė nepateikė pagedautinos kalbos.
Galima naudoti šias kalbas:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, zh-cn ir zh-tw</p>",

"config_BBC_MAXTIME" =>
"Šis kintamasis nusako unikalaus apsilankymo tarpsnį sekundėmis. Kiekvienas
to paties lankytojo paspaudimas per šį periodą bus laikomas kaip vienas apsilankymas,
kadangi du gretimi paspaudimai neviršyja šio laiko limito. Pagal nutylėjimą
yra laikomas defacto web standartas - 30 minučių (1800 sekundžių), nors, esant porekiui,
galite priskirti savo pageidaujamą reikšmę.<br />
Pavyzdžiai:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Kiek įrašų norite matyti Detaliame apsilankymų sąraše? Pagal nutylėjimą,
šio kintamojo reikšmė yra 100. Yra rekomenduotina nenaudoti daugiau nei
500 įrašų. Didesnis įrašų kiekis gali sukelti našumo problemų.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"Kintamasis \$BBC_DETAILED_STAT_FIELDS nusako stulpelius detaliame apsilankymų sąraše.
Galimi šie stulpeliai:
<ul>
<li>id&nbsp;=&gt;&nbsp;n-tasis lankytojas nuo statistikos vedimo pradšios</li>
<li>time&nbsp;=&gt;&nbsp;Paskutinio paspaudimo laikas</li>
<li>visits&nbsp;=&gt;&nbsp;Unikalaus lankytojo paspaudimai</li>
<li>dns&nbsp;=&gt;&nbsp;Lankytojo hostname'as</li>
<li>ip&nbsp;=&gt;&nbsp;Lankytojo IP adresas</li>
<li>os&nbsp;=&gt;&nbsp;Operacinė sistema (arba, jei įmanoma nustatyti, paieškos robotas)</li>
<li>browser&nbsp;=&gt;&nbsp;Naršyklė</li>
<li>ext&nbsp;=&gt;&nbsp;Lankytojo šalis arba plėtinys</li>
<li>referer&nbsp;=&gt;&nbsp;Nuoroda, iš kurios lankytojas atėjo į Jūsų svetainę (jei įmanoma nustatyti)
</li>
<li>page&nbsp;=&gt;&nbsp;The last visited page</li>
<li>search&nbsp;=&gt;&nbsp;The search query a visitor used (if available)</li>
</ul>
Stulpeliai bus išdėstyti tokia tvarka, kokia Jūs nurodysit.<br />
Pavyzdžiai:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"Tam atvejui, jei Jūsų virtualaus serverio laikas nesutampa su Jūsų laiko juosta,
šiuo kintamuoju galite sureguliuoti laiką. Neigiama reikšmė nustatys laiką atgal.<br />
Pavyzdys:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Ši opcija nusako ar IP adresą reikia bandyti konvertuoti į hostname'ą.
Nors hostname'ai pasako daug daugiau apie lankytoją, jų nustatymas gali
smarkiai sulėtinti svetainės darbą, ypač jei Jūsų serverio ryšys su
DNS serveriu yra lėtas ar nepatikimas. Šios opcijos išjungimas gali išspręsti
susidariusias našumo problemas.<br />
Pavyzdžiai:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_STRING" => "Pagal nutylėjimą, BBClone išveda komentarus, nusakančius
statistikos veikimo būseną, į svetainės HTML kodą. Šis išvedimas gali neigiamai paveikti
kai kuriuos forumus ar turinio valdymo sistemas. Jei jums išvedamas tuščias puslapis
ar susiduriate su &quot;headers already sent by&quot; pranešimais, galite atjungti
šiuos komentarus.<br />
Pavyzdžiai:<br />
\$BBC_NO_STRING = 1;<br />
\$BBC_NO_STRING = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"Pagal nutylėjimą BBClone laikmatyje rodo lankytojų paspaudimus, kadangi tai
gerai atspindi tikrąjį svetainės apkrovimą. Jei Jūs, dėl tam tikrų priežasčių
pageidaujate matyti unikalius apsilankymus, pakeiskite šio kintamojo reikšmę.<br />
Pavyzdžiai:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Šia opcija galite nustatyti neregistruotinus lankytojų IP adresus.
Norėdami naudoti kelias išraiškas, skirtuku naudokite kablelį.<br />
Pavyzdžiai:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"Tuo atveju, jei norite ignoruoti tam tikras nuorodas, vedančias į Jūsų svetainę,
galite įvesti vieną ar daugiau raktažodžių, blokuosiančių šias nuorodas.
Norėdami naudoti kelias išraiškas, skirtuku naudokite kablelį.<br />
Pavyzdžiai:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Čia galite nurodyti elgseną su paieškos robotais. Pagal nurylėjimą jie yra
ignoruojami lankomiausiuose host'uose, bet registruojami kiruose rodikliuose.
Jei apskritai nenorite matyti paieškos robotų, galite nustatyti šį kintamąjį
į &quot;2&quot;. Tokiu atveju bus registruojami tik tikrieji lankytojai.<br />
Pavyzdžiai:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"Ši opcija nusako kaip BBClone skiria vienus lankytojus nuo kitų. Paga nutylėjimą
yra naudojamas ti IP adresas, kuris dažniausiai duoda tikriausius lankomumo duomenis.
Tačiau jei lankytojus dažnai dengia proxy serveriai, šios opcijos deaktyvavimas
gali duoti tikresnius duomenis, kadangi lankytojai bus atpažystami pagal naršyklės
parašą (user-agent).<br />
Pavyzdžiai:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Jei norite išvalyti visą svetainės statistiką, aktyvuokite šią parinktį.
Sekantis apsilankymas išvalys visus duomenis. Nepamirškite vėliau deaktyvuoti
šią parinktį. Priešingu atveju galite būti nustebintas itin silpnu svetainės
lankomumu ;).<br />
Pavyzdžiai:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Hostų ir Refererių statistika gali genruoti didelius duomenų kiekius, sukuriamus
vienkartinių lankytojų. Šios opcijos įjungimas gali ryškiai sumažinti duomenų
apimtis bei access.php failą neprarandant visų matomų hostų ir refererių sąrašo.
Paspaudimų kiekis bus pridėtas prie &quot;Nenurodyta&quot; žymės ir neįtakos
bendro paspaudimų skatliuko.<br />
Pavyzdžiai:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
