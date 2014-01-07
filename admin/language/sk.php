<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: sk.php,v 1.31 2011/12/30 23:03:24 joku Exp $
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
 * Translated by: Zdeno Sekerak <trsek@hotmail.com>
 */

// The DNS Extensions array
$extensions = array(
"travel" => "Travel",
"asia" => "Asia-Pacific",
"jobs" => "Employment",
"mobi" => "Mobiles",
"cat" => "Catalan",
"tel" => "Contacts",

"ac" => "Ascension",
"ad" => "Andorra",
"ae" => "Spojené arabské emiráty",
"aero" => "Aero",
"af" => "Afghanistán",
"ag" => "Antigua a Barbuda",
"ai" => "Anguilla",
"al" => "Albánsko",
"am" => "Arménia",
"an" => "Holandské Antily",
"ao" => "Angola",
"aq" => "Antarktída",
"ar" => "Argentína",
"arpa" => "Sieťova infraštruktúra",
"as" => "Americká Samoa",
"at" => "Rakúsko",
"au" => "Austrália",
"aw" => "Aruba",
"ax" => "Ålandy",
"az" => "Azerbajdžán",
"ba" => "Bosna a Hercegovina",
"bb" => "Barbados",
"bd" => "Bangladéš",
"be" => "Belgicko",
"bf" => "Burkina Faso",
"bg" => "Bulharsko",
"bh" => "Bahrajn",
"bi" => "Burundi",
"biz" => "Biznis servery",
"bj" => "Benin",
"bl" => "Saint-Barthélemy",
"bm" => "Bermudy",
"bn" => "Brunej",
"bo" => "Bolívia",
"br" => "Brazília",
"bs" => "Bahamy",
"bt" => "Bhután",
"bv" => "Bouvet",
"bw" => "Botswana",
"by" => "Bielorusko",
"bz" => "Belizia",
"ca" => "Kanada",
"cc" => "Kokosové ostrovy",
"cd" => "Kongo, Demokratická republika",
"cf" => "Stredoafrická republika",
"cg" => "Kongo",
"ch" => "Švajčiarsko",
"ci" => "Pobrežie slonoviny",
"ck" => "Cookové ostrovy",
"cl" => "Chile",
"cm" => "Kamerun",
"cn" => "Čína",
"co" => "Kolumbia",
"com" => "Komerčné servery",
"coop" => "Coop",
"cr" => "Kostarika",
"cs" => "Serbia and Montenegro",
"cu" => "Kuba",
"cv" => "Kapverdy",
"cx" => "Veľkonočný ostrov",
"cy" => "Cyprus",
"cz" => "Česká republika",
"de" => "Nemecko",
"dj" => "Džibuti",
"dk" => "Dánsko",
"dm" => "Dominika",
"do" => "Dominikánska republika",
"dz" => "Alžírsko",
"ec" => "Ekvádor",
"edu" => "Školstvo",
"ee" => "Estónsko",
"eg" => "Egypt",
"eh" => "Western Sahara",
"er" => "Eritrea",
"es" => "Španielsko",
"et" => "Etiópia",
"eu" => "European Union",
"fi" => "Fínsko",
"fj" => "Fidži",
"fk" => "Falklandy",
"fm" => "Mikronézia",
"fo" => "Faerské ostrovy",
"fr" => "Francúzsko",
"ga" => "Gabun",
"gb" => "Veľká Británia",
"gd" => "Grenada",
"ge" => "Georgie",
"gf" => "Francúzska Guyana",
"gg" => "Guernsey",
"gh" => "Ghana",
"gi" => "Gibraltar",
"gl" => "Grónsko",
"gm" => "Gambie",
"gn" => "Guinea",
"gov" => "Vládne servery USA",
"gp" => "Guadeloupe",
"gq" => "Rovníková Guinea",
"gr" => "Grécko",
"gs" => "Juzná Georgie a Južné Sandwichové ostrovy",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guinea-Bissau",
"gy" => "Guyana",
"hk" => "Hongkong",
"hm" => "Ostrovy Heard a McDonald",
"hn" => "Honduras",
"hr" => "Chorvátsko",
"ht" => "Haiti",
"hu" => "Maďarsko",
"id" => "Indonézia",
"ie" => "Irsko",
"il" => "Izrael",
"im" => "Isle of Man",
"in" => "India",
"info" => "Informačné servery",
"int" => "Medzinárodné organizácie",
"io" => "Britské indickooceánské teritórium",
"iq" => "Irak",
"ir" => "Irán",
"is" => "Island",
"it" => "Taliansko",
"je" => "Jersey",
"jm" => "Jamajka",
"jo" => "Jordánsko",
"jp" => "Japonsko",
"ke" => "Keňa",
"kg" => "Kyrgizsko",
"kh" => "Kambodža",
"ki" => "Kiribati",
"km" => "Komory",
"kn" => "Svatý Kitts a Nevis",
"kp" => "North Korea",
"kr" => "Kórea",
"kw" => "Kuvajt",
"ky" => "Kajmanské ostrovy",
"kz" => "Kazachstan",
"la" => "Laos",
"lb" => "Libanon",
"lc" => "Svatá Lucia",
"li" => "Lichtejštansko",
"lk" => "Srí Lanka",
"lr" => "Libéria",
"ls" => "Lesotho",
"lt" => "Lotyšsko",
"lu" => "Luxembursko",
"lv" => "Litva",
"ly" => "Líbya",
"ma" => "Maroko",
"mc" => "Monako",
"md" => "Moldavsko",
"me" => "Čierna Hora",
"mf" => "Saint Martin",
"mg" => "Madagaskar",
"mh" => "Maršálove ostrovy",
"mil" => "Vojenské servery USA",
"mk" => "Macedónsko",
"ml" => "Mali",
"mm" => "Barma (Myanmar)",
"mn" => "Mongolsko",
"mo" => "Macao",
"mp" => "Severná Mariana",
"mq" => "Martinik",
"mr" => "Mauretánia",
"ms" => "Montserrat",
"mt" => "Malta",
"mu" => "Maurítius",
"museum" => "Museum",
"mv" => "Maledivy",
"mw" => "Malawi",
"mx" => "Mexiko",
"my" => "Malajzia",
"mz" => "Mozambik",
"na" => "Namíbia",
"name" => "Osobné servery",
"nc" => "Nová Kaledonia",
"ne" => "Niger",
"net" => "Sieťová infraštruktúra",
"nf" => "Norfolk",
"ng" => "Nigéria",
"ni" => "Nikaragua",
"nl" => "Holandsko",
"no" => "Nórsko",
"np" => "Nepál",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Číselná",
"nz" => "Nový Zéland",
"om" => "Omán",
"org" => "Nevládne organizácie",
"pa" => "Panama",
"pe" => "Peru",
"pf" => "Francúzska Polynézia",
"pg" => "Papua - Nová Guinea",
"ph" => "Filipíny",
"pk" => "Pakistán",
"pl" => "Poľsko",
"pm" => "Svatý Pierre a Miquelon",
"pn" => "Pitcairn",
"pr" => "Portoriko",
"pro" => "Professional",
"ps" => "Palestína",
"pt" => "Portugalsko",
"pw" => "Palau",
"py" => "Paraguay",
"qa" => "Katar",
"re" => "Réunion",
"ro" => "Rumunsko",
"rs" => "Srbsko",
"ru" => "Rusko",
"rw" => "Rwanda",
"sa" => "Saudská Arábia",
"sb" => "Šalamúnové ostrovy",
"sc" => "Seychely",
"sd" => "Sudán",
"se" => "Švédsko",
"sg" => "Singapur",
"sh" => "Svatá Helena",
"si" => "Slovinsko",
"sj" => "Ostrovy Svalbard a Jan Mayen",
"sk" => "Slovensko",
"sl" => "Sierra Leone",
"sm" => "San Marino",
"sn" => "Senegal",
"so" => "Somálsko",
"sr" => "Surinam",
"st" => "Svatý Tomáš a Princov ostrov",
"su" => "Sovietsky zvaz",
"sv" => "Salvador",
"sy" => "Sýria",
"sz" => "Svazijsko",
"tc" => "Ostrovy Turks a Caicos",
"td" => "Čad",
"tf" => "Francúzske južné teritória",
"tg" => "Togo",
"th" => "Thajsko",
"tj" => "Tádžikistán",
"tk" => "Tokelau",
"tl" => "Timor Leste",
"tm" => "Turkmenistán",
"tn" => "Tunisko",
"to" => "Tonga",
"tp" => "Východný Timor",
"tr" => "Turecko",
"tt" => "Trinidad a Tobago",
"tv" => "Tuvalu",
"tw" => "Tchajwan",
"tz" => "Tanzánia",
"ua" => "Ukrajina",
"ug" => "Uganda",
"uk" => "Veĺká Británia",
"um" => "Malé vzdialené ostrovy patriace USA",
"unknown" => "Neznámy",
"us" => "USA",
"uy" => "Uruguay",
"uz" => "Uzbekistán",
"va" => "Vatikán",
"vc" => "Svatý Vincenc a Grenadiny",
"ve" => "Venezuela",
"vg" => "Britské Panenské ostrovy",
"vi" => "Americké Panenské ostrovy",
"vn" => "Vietnam",
"vu" => "Vanuatu",
"wf" => "Ostrovy Wallis a Futuna",
"ws" => "Samoa",
"ye" => "Jemen",
"yt" => "Mayotte",
"yu" => "Srbsko a Čierna hora",
"za" => "Južná Afrika",
"zm" => "Zambia",
"zr" => "Zair",
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
"global_bbclone_copyright" => "BBClone tím - Šírené pod licenciou",
"global_last_reset" => "Štatistika začala od",
"global_yes" => "ano",
"global_no" => "nie",

// The error messages
"error_cannot_see_config" =>
"Nemáte oprávnenie k prehliadaniu konfiguračného súboru BBClone.",

// Miscellaneous translations
"misc_other" => "Iný",
"misc_unknown" => "Neznámy",
"misc_second_unit" => "s",
"misc_ignored" => "Ignored",

// The Navigation Bar
"navbar_main_site" => "Hlavná strana",
"navbar_configuration" => "Konfigurácia",
"navbar_global_stats" => "Súhrná štatistika",
"navbar_detailed_stats" => "Podrobná štatistika",
"navbar_time_stats" => "Časová štatistika",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Čas",
"dstat_visits" => "Navštívené",
"dstat_extension" => "Doména",
"dstat_dns" => "Meno stroja",
"dstat_from" => "Odkiaľ",
"dstat_os" => "OS",
"dstat_browser" => "Prehliadač",
"dstat_visible_rows" => "Zobrazených prístupov",
"dstat_green_rows" => "zelený riadok",
"dstat_blue_rows" => "modrý riadok",
"dstat_red_rows" => "červený riadok",
"dstat_search" => "Search",
"dstat_last_page" => "Last Page",
"dstat_last_visit" => "posledná návšteva",
"dstat_robots" => "roboti",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "Dáta nedostupné",
"dstat_prx" => "Proxy Server",
"dstat_ip" => "IP Addresa",
"dstat_user_agent" => "Užívatelský agent",
"dstat_nr" => "Nr",
"dstat_pages" => "Strana",
"dstat_visit_length" => "Dĺžka prehliadania",
"dstat_reloads" => "Znova načítané",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Prístupy",
"gstat_total_visits" => "Celkom navštívené",
"gstat_total_unique" => "Celkom jedinečné adresy",
"gstat_operating_systems" => "Top %d operačných systémov",
"gstat_browsers" => "Top %d prehliadačov",
"gstat_extensions" => "Top %d domén",
"gstat_robots" => "Top %d robotov",
"gstat_pages" => "Top %d navštívených stránok",
"gstat_origins" => "Top %d zdrojov",
"gstat_hosts" => "Top %d Hosts",
"gstat_keys" => "Top %d Slov",
"gstat_total" => "Celkom",
"gstat_not_specified" => "Neurčené",

// Time stats words
"tstat_su" => "Ne",
"tstat_mo" => "Po",
"tstat_tu" => "Ut",
"tstat_we" => "St",
"tstat_th" => "Št",
"tstat_fr" => "Pi",
"tstat_sa" => "So",

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
"tstat_may" => "Máj",
"tstat_jun" => "Jún",
"tstat_jul" => "Júl",
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

"tstat_last_day" => "Posledný deň",
"tstat_last_week" => "Posledný týždeň",
"tstat_last_month" => "Posledný mesiac",
"tstat_last_year" => "Posledný rok",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences

"config_variable_name" => "Názov premennej",
"config_variable_value" => "Hodnota promennej",
"config_explanations" => "Vysvetlivky",

"config_BBC_MAINSITE" =>
"Ak nastavíte túto hodnotu bude generovaná štatistika práve pre túto linku.
Defaultne je hodnota správne nastavená na predchádzajúci (parent) adresár.
V prípade že vaša stránka je umiestnená inde, budete musieť prispôsobiť
túto hodnotu na správnu.<br />
Príklad:<br />
\$BBC_MAINSITE = &quot;http://www.mojserver.sk/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"BBClone defaultne zobrazí nastavenia štatistiky. V prípade že nechcete
všetkým ukazovat ako je nastavený BBClone možete zakázať prístup k
zobrazeniu nastavení.<br />
Príklad:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Tento titulok bude zobrazený v navigačnom panely na všetkých stránkach
BBClone.<br />
K dispozíci sú tieto premenné:<br />
<ul>
<li>%SERVER: meno serveru,</li>
<li>%DATE: aktuálny dátum.</li>
</ul>
HTML tagy sú povolené.<br />
Príklad:<br />
\$BBC_TITLEBAR = &quot;Štatistika pre %SERVER generovaná dňa %DATE&quot;;<br
/>
\$BBC_TITLEBAR = &quot;Moja štatistika zo dňa %DATE vypadá takto:&quot;;<br
/>",

"config_BBC_LANGUAGE" =>
"BBClone defaultná jazyková lokalizácia, v prípade že nieje špecifikovaná v
prehliadači.
Podporované sú nasledovné jazykové verzie:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, it, ja, ko, lt, mk, nb, nl, pl,
pt-br, ro, ru,
sk, sl, sv, th, tr, ua, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"Táto hodnota definuje dĺžku jedinečnej návštevy v sekundách. Každý ďalší
klik od
toho istého návštevníka vrámci tejto dĺžky bude povazovaný za jednu
návštevu.
Default je 30 minút (1800 sekúnd) čož je de facto web štandard, ale v
závislosti
na vašich potrebách môžete túto hodnotu upraviť.<br />
Príklad:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Koľko návštev chcete zobrazovať v detailnom výpise? Default hodnota je 100.
Je doporučené nemeniť túto hodnotu na viac ako 500, pretože načítanie bude
trvat
veľmi dlho",

"config_BBC_DETAILED_STAT_FIELDS" =>
"Hodnota \$BBC_DETAILED_STAT_FIELDS určuje aké stĺpce sa zobrazia v
detailnom
štatistickom výpise. Dostupné sú tieto stĺpce:
<ul>
<li>id&nbsp;=&gt;&nbsp;Poradie návštevníka od začiatku počítania</li>
<li>time&nbsp;=&gt;&nbsp;Čas kedy bola registrovaná posledná návšteva</li>
<li>visits&nbsp;=&gt;&nbsp;Počet jedinečných návštev</li>
<li>dns&nbsp;=&gt;&nbsp;Provider návštevníka</li>
<li>ip&nbsp;=&gt;&nbsp;IP adresa návštevníka</li>
<li>os&nbsp;=&gt;&nbsp;Typ operačného systému (ak je dostupný a nie je to
robot)</li>
<li>browser&nbsp;=&gt;&nbsp;Typ prehliadača použitého na pripojenie</li>
<li>ext&nbsp;=&gt;&nbsp;Krajina odkiaľ je návštevník</li>
<li>referer&nbsp;=&gt;&nbsp;Linka z ktorej prišiel návštevník (ak je
dostupná)</li>
<li>page&nbsp;=&gt;&nbsp;The last visited page</li>
<li>search&nbsp;=&gt;&nbsp;The search query a visitor used (if available)</li>
</ul>
Tieto premenné budú prehľadne uložené v stĺpcoch.<br />
Príklad:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os,
browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"V prípade že server nemá správne definovaný čas, môžete ho prispôsobiť.
Urobíte to tak že pripočítate alebo odpočítate od tohoto času minúty.
Záporná hodnota posunie čas do záporu, kladná hodnota napred.<br />
Príklad:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Toto nastavenie určuje či sa má IP adresa prevádzať na host adresu alebo
nie.
Pokiaľ host poskytuje o sebe veľa informácií, výsledkom môže byť pád vašej
stránky.
Ak je váš DNS server pomalý alebo má limitovanú kapacitu zapnite túto voľbu
a vyriešite problém.<br />
Príklad:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"BBClone defaultne zobrazuje všetky návštevy v časovej osi, pretože to
robí dobrý dojem pri zobrazení. Ak však preferujete zobrazenie len
jednoznačných
návštev zmeňte túto hodnotu na 1.<br />
Príklad:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Tuto je možno definovat rozsah IP adries ktoré sú vyradené z počítania.
V prípade že chcete definovať viac adries oddeľte ich čiarkou.<br />
Príklad:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"V prípade že chcete niektorých návštevníkov nezahrňovať do detailného
výpisu,
môžete špecifikovať kľúčové slová ktoré ich charakterizujú.
Ak budete definovať viac oddeľte ich čiarkou.<br />
Príklad:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Tuto môžete definovať počítanie návštev pre robotov ktorý skenujú
stránky.<br />
Príklad:<br />
\$BBC_IGNORE_BOTS = 2; - robotov zahrnúť do všetkých štatistík<br />
\$BBC_IGNORE_BOTS = 1; - robotov zahrnúť len do štatistík robotov<br />
\$BBC_IGNORE_BOTS = &quot;&quot;; - počítať iba ľudí",

"config_BBC_IGNORE_AGENT" =>
"Táto voľba vraví ako počítať návštevníkov. Defaultne je použité počítanie
IP adries,
ktoré je dobré pre mnoho prípadov. Často sú však užívatelia skrytí za proxy
serverom. Deaktiváciou tejto voľby dosiahnete viacej návštev, pretože sa
budú počítať nový návštevníci ktorý majú síce rovnaké IP ale rozdielne
nastavené
hodiny.<br />
Príklad:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Týmto môžete zrušiť doteršiu štatistiku. Ak nastavíte na 1 a spustíte,
štatistika sa zmaže. Nezabudnite potom deaktivovat lebo sa budete diviť akú
máte slabú návštevnosť. ;).<br />
Príklad:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Návštevníci a roboti môžu generovat veľké množstvo dát, v prípade veľkého
počtu návštevníkov v ten istý čas. Zapnutím tejto voľby zmenšíte veľkosť
súborov a access.php z týchto dát vyberie len podstatné. Množstvo prístupov
a rebríčky hodnotení sa uložia ale stratíte detailnú štatistiku.<br />
Príklad:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
