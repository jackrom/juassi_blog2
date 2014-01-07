<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: cs.php,v 1.64 2011/12/30 23:03:24 joku Exp $
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

"ac" => "Ascension",
"ad" => "Andorra",
"ae" => "Spojené arabské emiráty",
"aero" => "Aero",
"af" => "Afghanistán",
"ag" => "Antigua a Barbuda",
"ai" => "Anguilla",
"al" => "Albánie",
"am" => "Arménie",
"an" => "Nizozemské Antily",
"ao" => "Angola",
"aq" => "Antarktida",
"ar" => "Argentina",
"arpa" => "Arpa",
"as" => "Americká Samoa",
"at" => "Rakousko",
"au" => "Austrálie",
"aw" => "Aruba",
"ax" => "Ålandy",
"az" => "Azerbajdžán",
"ba" => "Bosna a Hercegovina",
"bb" => "Barbados",
"bd" => "Bangladéš",
"be" => "Belgie",
"bf" => "Burkina Faso",
"bg" => "Bulharsko",
"bh" => "Bahrajn",
"bi" => "Burundi",
"biz" => "Business",
"bj" => "Benin",
"bl" => "Saint-Barthélemy",
"bm" => "Bermudy",
"bn" => "Brunej",
"bo" => "Bolívie",
"br" => "Brazílie",
"bs" => "Bahamy",
"bt" => "Bhútán",
"bv" => "Bouvet",
"bw" => "Botswana",
"by" => "Bělorusko",
"bz" => "Belize",
"ca" => "Kanada",
"cc" => "Kokosové ostrovy",
"cd" => "Kongo, Demokratická republika",
"cf" => "Středoafrická republika",
"cg" => "Kongo",
"ch" => "Švýcarsko",
"ci" => "Pobřeží slonoviny",
"ck" => "Cookovy ostrovy",
"cl" => "Chile",
"cm" => "Kamerun",
"cn" => "Čína",
"co" => "Kolumbie",
"com" => "Komerční servery",
"coop" => "Coop",
"cr" => "Kostarika",
"cs" => "Serbia and Montenegro",
"cu" => "Kuba",
"cv" => "Kapverdy",
"cx" => "Vánoční ostrov",
"cy" => "Kypr",
"cz" => "Česká republika",
"de" => "Německo",
"dj" => "Džibuti",
"dk" => "Dánsko",
"dm" => "Dominika",
"do" => "Dominikánská republika",
"dz" => "Alžírsko",
"ec" => "Ekvádor",
"edu" => "Školství",
"ee" => "Estonsko",
"eg" => "Egypt",
"eh" => "Západní Sahara",
"er" => "Eritrea",
"es" => "Španělsko",
"et" => "Etiopie",
"eu" => "Evropská unie",
"fi" => "Finsko",
"fj" => "Fidži",
"fk" => "Falklandy",
"fm" => "Mikronésie",
"fo" => "Faerské ostrovy",
"fr" => "Francie",
"ga" => "Gabun",
"gb" => "Velká Británie",
"gd" => "Grenada",
"ge" => "Georgie",
"gf" => "Francouzská Guyana",
"gg" => "Guernsey",
"gh" => "Ghana",
"gi" => "Gibraltar",
"gl" => "Grónsko",
"gm" => "Gambie",
"gn" => "Guinea",
"gov" => "Vládní servery USA",
"gp" => "Guadeloupe",
"gq" => "Rovníková Guinea",
"gr" => "Řecko",
"gs" => "Jižní Georgie a Jižní Sandwichovy ostrovy",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guinea-Bissau",
"gy" => "Guyana",
"hk" => "Hongkong",
"hm" => "Ostrovy Heard a McDonald",
"hn" => "Honduras",
"hr" => "Chorvatsko",
"ht" => "Haiti",
"hu" => "Maďarsko",
"id" => "Indonézie",
"ie" => "Irsko",
"il" => "Izrael",
"im" => "Ostrov Man",
"in" => "Indie",
"info" => "Informační",
"int" => "Mezinárodní organizace",
"io" => "Britské indickooceánské teritorium",
"iq" => "Irák",
"ir" => "Irán",
"is" => "Island",
"it" => "Itálie",
"je" => "Jersey",
"jm" => "Jamajka",
"jo" => "Jordánsko",
"jp" => "Japonsko",
"ke" => "Keňa",
"kg" => "Kyrgyzsko",
"kh" => "Kambodža",
"ki" => "Kiribati",
"km" => "Komory",
"kn" => "Svatý Kitts a Nevis",
"kp" => "Severní Korea",
"kr" => "Korea",
"kw" => "Kuvajt",
"ky" => "Kajmanské ostrovy",
"kz" => "Kazachstán",
"la" => "Laos",
"lb" => "Libanon",
"lc" => "Svatá Lucie",
"li" => "Lichtenštejnsko",
"lk" => "Srí Lanka",
"lr" => "Libérie",
"ls" => "Lesotho",
"lt" => "Lotyšsko",
"lu" => "Lucembursko",
"lv" => "Litva",
"ly" => "Libye",
"ma" => "Maroko",
"mc" => "Monako",
"md" => "Moldávie",
"me" => "Černá Hora",
"mf" => "Saint-Martin",
"mg" => "Madagaskar",
"mh" => "Marshallovy ostrovy",
"mil" => "Vojenské servery USA",
"mk" => "Makedonie",
"ml" => "Mali",
"mm" => "Barma (Myanmar)",
"mn" => "Mongolsko",
"mo" => "Macao",
"mp" => "Severní Mariany",
"mq" => "Martinik",
"mr" => "Mauretánie",
"ms" => "Montserrat",
"mt" => "Malta",
"mu" => "Mauritius",
"museum" => "Muzea",
"mv" => "Maledivy",
"mw" => "Malawi",
"mx" => "Mexiko",
"my" => "Malajsie",
"mz" => "Mozambik",
"na" => "Namibie",
"name" => "Personal",
"nc" => "Nová Kaledonie",
"ne" => "Niger",
"net" => "Síťová infrastruktura",
"nf" => "Norfolk",
"ng" => "Nigérie",
"ni" => "Nikaragua",
"nl" => "Holandsko",
"no" => "Norsko",
"np" => "Nepál",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Číselná",
"nz" => "Nový Zéland",
"om" => "Omán",
"org" => "Nevládní organizace",
"pa" => "Panama",
"pe" => "Peru",
"pf" => "Francouzská Polynésie",
"pg" => "Papua - Nová Guinea",
"ph" => "Filipíny",
"pk" => "Pákistán",
"pl" => "Polsko",
"pm" => "Svatý Pierre a Miquelon",
"pn" => "Pitcairn",
"pr" => "Portoriko",
"pro" => "Professional",
"ps" => "Palestina",
"pt" => "Portugalsko",
"pw" => "Palau",
"py" => "Paraguay",
"qa" => "Katar",
"re" => "Réunion",
"ro" => "Rumunsko",
"rs" => "Srbsko",
"ru" => "Rusko",
"rw" => "Rwanda",
"sa" => "Saudská Arábie",
"sb" => "Šalamounovy ostrovy",
"sc" => "Seychely",
"sd" => "Súdán",
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
"st" => "Svatý Tomáš a Princův ostrov",
"su" => "Sovětský svaz",
"sv" => "Salvador",
"sy" => "Sýrie",
"sz" => "Svazijsko",
"tc" => "Ostrovy Turks a Caicos",
"td" => "Čad",
"tf" => "Francouzská jižní teritoria",
"tg" => "Togo",
"th" => "Thajsko",
"tj" => "Tádžikistán",
"tk" => "Tokelau",
"tl" => "Východní Timor",
"tm" => "Turkmenistán",
"tn" => "Tunisko",
"to" => "Tonga",
"tp" => "Východní Timor",
"tr" => "Turecko",
"tt" => "Trinidad a Tobago",
"tv" => "Tuvalu",
"tw" => "Tchajwan",
"tz" => "Tanzánie",
"ua" => "Ukrajina",
"ug" => "Uganda",
"uk" => "Spojené království",
"um" => "Malé odlehlé ostrovy patřící USA",
"unknown" => "Neznámý",
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
"yu" => "Serbia and Montenegro",
"za" => "Jižní Afrika",
"zm" => "Zambie",
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
"global_bbclone_copyright" => "BBClone tým - Šířeno pod licencí",
"global_last_reset" => "Statistiky naposledy vynulovány",
"global_yes" => "ano",
"global_no" => "ne",

// The error messages
"error_cannot_see_config" =>
"Nemáte oprávnění k prohlížení konfiguračního souboru BBClone.",

// Miscellaneous translations
"misc_other" => "Jiný",
"misc_unknown" => "Neznámý",
"misc_second_unit" => "s",
"misc_ignored" => "Ignorovaný",

// The Navigation Bar
"navbar_main_site" => "Hlavní stránka",
"navbar_configuration" => "Konfigurace",
"navbar_global_stats" => "Souhrnná statistika",
"navbar_detailed_stats" => "Podrobná statistika",
"navbar_time_stats" => "Historie",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Čas",
"dstat_visits" => "Shlédnuto",
"dstat_extension" => "Doména",
"dstat_dns" => "Jméno počítače",
"dstat_from" => "Odkud",
"dstat_os" => "OS",
"dstat_browser" => "Prohlížeč",
"dstat_visible_rows" => "Zobrazených záznamů",
"dstat_green_rows" => "zelený řádek",
"dstat_blue_rows" => "modrý řádek",
"dstat_red_rows" => "červený řádek",
"dstat_search" => "Hledáno",
"dstat_last_page" => "poslední strana",
"dstat_last_visit" => "poslední návštěva",
"dstat_robots" => "roboti",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "Informace nejsou k dispozici",
"dstat_prx" => "Proxy server",
"dstat_ip" => "IP Adresa",
"dstat_user_agent" => "Prohlížeč",
"dstat_nr" => "č.",
"dstat_pages" => "Stránky",
"dstat_visit_length" => "Délka návštěvy",
"dstat_reloads" => "Obnovení",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Přístupy",
"gstat_total_visits" => "Celkem shlédnuto",
"gstat_total_unique" => "Celkem unikátních hostů",
"gstat_operating_systems" => "Top %d operačních systémů",
"gstat_browsers" => "Top %d prohlížečů",
"gstat_extensions" => "Top %d domén",
"gstat_robots" => "Top %d robotů",
"gstat_pages" => "Top %d navštívených stránek",
"gstat_origins" => "Top %d zdrojů",
"gstat_hosts" => "Top %d návštěv",
"gstat_keys" => "Top %d hledaných slov",
"gstat_total" => "Celkem",
"gstat_not_specified" => "Neurčeno",

// Time stats words
"tstat_su" => "Ne",
"tstat_mo" => "Po",
"tstat_tu" => "Út",
"tstat_we" => "St",
"tstat_th" => "Čt",
"tstat_fr" => "Pá",
"tstat_sa" => "So",
"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "Led",
"tstat_feb" => "Úno",
"tstat_mar" => "Bře",
"tstat_apr" => "Dub",
"tstat_may" => "Kvě",
"tstat_jun" => "Čer",
"tstat_jul" => "Čec",
"tstat_aug" => "Srp",
"tstat_sep" => "Zář",
"tstat_oct" => "Říj",
"tstat_nov" => "Lis",
"tstat_dec" => "Pro",
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

"tstat_last_day" => "Poslední den",
"tstat_last_week" => "Poslední týden",
"tstat_last_month" => "Poslední měsíc",
"tstat_last_year" => "Poslední rok",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "Název proměnné",
"config_variable_value" => "Hodnota proměnné",
"config_explanations" => "Vysvětlivky",

"config_BBC_MAINSITE" =>
"Jestliže byla nastavena tato proměnná, bude vytvořen odkaz na Vámi zvolené umístění.
Přednastavená hodnota odkazuje na nadřazený adresář. V případě, že je Vaše
hlavní stránka umístěna na jiném místě, budete si chtít pravděpodobně tuto
hodnotu změnit.<br />
Příklady:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"BBClone má přednastaveno zobrazení &quot;Konfigurace&quot; nahoře v hlavní nabídce.
V případě, že si nepřejete konfiguraci zobrazovat, nechte tuto hodnotu prázdnou.
<br />
Přiklady:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Titulek stránek se statistikou. <br />
Tento titulek bude zobrazen v navigačním panelu na všech BBClone stránkách.<br />
K dispozici jsou následující hodnoty:<br />
<ul>
<li>%SERVER: jméno serveru,</li>
<li>%DATE: aktuální datum.</li>
</ul>
HTML tagy jsou povoleny.<br />
Příklady:<br />
\$BBC_TITLEBAR = &quot;Statistiky pro %SERVER vytvořeny %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;Moje statistiky od %DATE vypadají takto:&quot;;<br />",

"config_BBC_LANGUAGE" =>
"Přednastavený jazyk pro BBClone. Bere se v potaz pokud není nastaven pomocí prohlížeče.
Podporovány jsou následující jazyky:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, ua, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"Tato proměnná stanovuje délku unikátní návětěvy v sekundách. Každý přístup od stejného
návštěvníka v tomto intervalu bude počítán jako jedna návštěva. Přednastavená hodnota
je de facto webový standard, a to 30 minut (1800 sekund), ale záleží pouze na Vás, jakou
hodnotu si nastavíte.<br />
Příklady:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Kolik chcete mít záznamů v podrobné statistice? Přednastaveno je 100 záznamů.
Doporučuje se nenastavovat hodnotu větší než 500 v důsledku zamezení dlouhého
načítání.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"Proměnná \$BBC_DETAILED_STAT_FIELDS určuje sloupce, které mají být zobrazeny
v podrobné statistice. Možnosti jsou:
<ul>
<li>id&nbsp;=&gt;&nbsp;X-tý návštěvník od doby vynulování statistiky</li>
<li>time&nbsp;=&gt;&nbsp;Čas, kdy byl zaznamenán poslední klik</li>
<li>visits&nbsp;=&gt;&nbsp;Počet zobrazení unikátního návštěvníka</li>
<li>dns&nbsp;=&gt;&nbsp;Hostitelské jméno návštěvníka</li>
<li>ip&nbsp;=&gt;&nbsp;IP adresa návštěvníka</li>
<li>os&nbsp;=&gt;&nbsp;Operační systém návštěvníka (jestliže je k dispozici a není robot)</li>
<li>browser&nbsp;=&gt;&nbsp;Prohlížeč návštěvníka</li>
<li>ext&nbsp;=&gt;&nbsp;Země návštěvníka</li>
<li>referer&nbsp;=&gt;&nbsp;Stránka, ze které návštěvník přišel (jestliže je k dispozici)</li>
<li>page&nbsp;=&gt;&nbsp;Poslední prohlížená stránka</li>
<li>search&nbsp;=&gt;&nbsp;Jaká slova hledal návštěvník ve vyhledávači (jestliže je k dispozici)</li>
</ul>
Sloupce s požadovanými informacemi budou zobrazeny v pořadí, v jakém jste je zadali.<br />
Příklady:<br />

\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"V případě, že čas serveru nesouhlasí s Vaším časovým pásmem, můžete čas změnit.
Záporné hodnoty nastaví čas zpět, kladné jej posunou dopředu.<br />
Příklady:<br />

\$BBC_TIME_OFFSET = 300; (čas +300 minut)<br />
\$BBC_TIME_OFFSET = -300; (čas -300 minut)<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Toto nastavnení definuje, zda IP adresy mají být překládány na hostitelské jméno.
Hostitelské jméno Vám řekne mnohem více o návštěvníkovi, jejich zjištování však
může značně zpomalit Vaši stránku. To je způsobeno tím, že použité DNS servery
jsou pomalé, mají omezenou kapacitu nebo jsou nevěrohodné. Změnou této hodnoty
můžete problém vyřešit.<br />
Příklady:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"BBClone je přednastaveno aby ukazovalo celková zobrazení (reloady/hity) v historii,
protože dává užitečné informace o zátěži serveru. Jestliže si ale přejete
používat unikatní zobrazení v historii, můžete změnit způsob počítání
nastavením této proměnné.<br />
Příklady:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Tato možnost může být použita pro vyloučení konkrétních IP adres, případně i
jejich rozsahů od započítávání. V případě, že chcete přidat více adres,
použijte čárku jako oddělovač.<br />
Příklady:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"V případě, že nechcete mít ve statistikách některé odkazy na stránky, ze
kterých návštěvnící přistupují, můžete specifikovat jedno nebo více slov, které
jsou obsaženy v jejich odkazu. Tím zabráníte jejich zobrazení. Chcete-li
přidat více slov, použijte čárku jako oddělovač.<br />
Příklady:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Toto nastavení slouží ke změně započítávání robotů. Přednastaveno je ignorovat
roboty v souhrných statistikách a ponechat je v ostatních. Pokud si přejete
nezobrazovat roboty ve všech statistikách, nastavte hodnotu na &quot;2&quot;, pak budou
započítávány pouze přístupy jednotlivých návštěvníků.<br />
Příklady:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"V tomto nastavení definujete, jak BBClone rozpozná jednoho uživatele od druhého.
Defaultně se používá jen IP adresa, která poskytuje reálné čísla ve většině
případů. Jestliže jsou ale Vaši návštěvníci často skryti za proxy serverem,
může vypnutím této možnoti dosáhnout reálnějších čísel. O tom, že se
jedná o nového navštěvníka se rozhodne podle změny hodnoty hlavičky user agent.<br />
Příklady:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Kdykoliv si přejete vymazat Vaše statistiky, můžete aktivovat tuto přoměnou
a příští návštěvou je vymazat. Nezapomeňte ji zase poté deaktivovat, jinak
pravděpodobně pocítíte neobvykle nízkou návštěvnost ;)<br />
Příklady:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Statistiky hostu a odkazujících stránek mohou vytvářet velké objemy dat, většinou
však tvořené jednorázovými návštěvníky. Zapnutím této volby můžete odstranit
záznamy a znatelně zmenšit access.php bez ovlivnění zěbříčku přístupů a
odkazujících stránek. Množství zobrazení bude přidáno do &quot;nespecifikovaných&quot;
záznamů, aby byly zachováno celkové skóre.<br />
Příklady:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
