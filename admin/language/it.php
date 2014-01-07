<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: it.php,v 1.70 2011/12/30 23:03:24 joku Exp $
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
 * Translated by: Andreas Liebschner, fizban(at)slack-tux.org, Daniele.Raffo(at)inria.fr
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
"ae" => "Emirati Arabi Uniti",
"aero" => "Aero",
"af" => "Afghanistan",
"ag" => "Antigua e Barbuda",
"ai" => "Anguilla",
"al" => "Albania",
"am" => "Armenia",
"an" => "Antille Olandesi",
"ao" => "Angola",
"aq" => "Antartide",
"ar" => "Argentina",
"arpa" => "Errori",
"as" => "Samoa Americana",
"at" => "Austria",
"au" => "Australia",
"aw" => "Aruba",
"ax" => "Isole Åland",
"az" => "Azerbaigian",
"ba" => "Bosnia Erzegovina",
"bb" => "Barbados",
"bd" => "Bangladesh",
"be" => "Belgio",
"bf" => "Burkina Faso",
"bg" => "Bulgaria",
"bh" => "Bahrein",
"bi" => "Burundi",
"biz" => "Affari",
"bj" => "Benin",
"bl" => "Saint-Barthélemy (Antille francesi)",
"bm" => "Bermuda",
"bn" => "Brunei",
"bo" => "Bolivia",
"br" => "Brasile",
"bs" => "Bahamas",
"bt" => "Butan",
"bv" => "Isola Bouvet",
"bw" => "Botswana",
"by" => "Bielorussia",
"bz" => "Belize",
"ca" => "Canada",
"cc" => "Isole Coco",
"cd" => "Congo",
"cf" => "Repubblica Centrafricana",
"cg" => "Congo",
"ch" => "Svizzera",
"ci" => "Costa d'Avorio",
"ck" => "Isole Cook",
"cl" => "Cile",
"cm" => "Camerun",
"cn" => "Cina",
"co" => "Colombia",
"com" => "Commerciale",
"coop" => "Coop",
"cr" => "Costa Rica",
"cs" => "Serbia and Montenegro",
"cu" => "Cuba",
"cv" => "Capo Verde",
"cx" => "Isola di Natale",
"cy" => "Cipro",
"cz" => "Repubblica Ceca",
"de" => "Germania",
"dj" => "Gibuti",
"dk" => "Danimarca",
"dm" => "Dominica",
"do" => "Repubblica Dominicana",
"dz" => "Algeria",
"ec" => "Ecuador",
"edu" => "Istituzioni educative",
"ee" => "Estonia",
"eg" => "Egitto",
"eh" => "Western Sahara",
"er" => "Eritrea",
"es" => "Spagna",
"et" => "Etiopia",
"eu" => "European Union",
"fi" => "Finlandia",
"fj" => "Figi",
"fk" => "Isole Falkland",
"fm" => "Micronesia",
"fo" => "Isole Faroe",
"fr" => "Francia",
"ga" => "Gabon",
"gb" => "Gran Bretagna",
"gd" => "Grenada",
"ge" => "Georgia",
"gf" => "Guyana Francese",
"gg" => "Guernsey",
"gh" => "Ghana",
"gi" => "Gibilterra",
"gl" => "Groenlandia",
"gm" => "Gambia",
"gn" => "Guinea",
"gov" => "Governo",
"gp" => "Guadalupa",
"gq" => "Guinea Equatoriale",
"gr" => "Grecia",
"gs" => "Isole Sandwich Meridionali e Georgia Meridionale",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guinea Bissau",
"gy" => "Guyana",
"hk" => "Hong Kong",
"hm" => "Isole Heard e Mc Donald",
"hn" => "Honduras",
"hr" => "Croazia",
"ht" => "Haiti",
"hu" => "Ungheria",
"id" => "Indonesia",
"ie" => "Irlanda",
"il" => "Israele",
"im" => "Isola di Man",
"in" => "India",
"info" => "Informativo",
"int" => "Organizzazioni internazionali",
"io" => "Territori Britannici nell'Oceano Indiano",
"iq" => "Iraq",
"ir" => "Iran",
"is" => "Islanda",
"it" => "Italia",
"je" => "Jersey",
"jm" => "Giamaica",
"jo" => "Giordania",
"jp" => "Giappone",
"ke" => "Kenia",
"kg" => "Kirghistan",
"kh" => "Cambogia",
"ki" => "Kiribati",
"km" => "Comore",
"kn" => "Saint Kitts e Nevis",
"kp" => "North Korea",
"kr" => "Corea",
"kw" => "Kuwait",
"ky" => "Isole Cayman",
"kz" => "Kazakistan",
"la" => "Laos",
"lb" => "Libano",
"lc" => "Santa Lucia",
"li" => "Liechtenstein",
"lk" => "Sri Lanka",
"lr" => "Liberia",
"ls" => "Lesotho",
"lt" => "Lituania",
"lu" => "Lussemburgo",
"lv" => "Lettonia",
"ly" => "Libia",
"ma" => "Marocco",
"mc" => "Monaco",
"md" => "Moldavia",
"me" => "Montenegro",
"mf" => "Saint-Martin",
"mg" => "Madagascar",
"mh" => "Isole Marshall",
"mil" => "Esercito USA",
"mk" => "Macedonia",
"ml" => "Mali",
"mm" => "Myanmar",
"mn" => "Mongolia",
"mo" => "Macao",
"mp" => "Isole Marianne Settentrionali",
"mq" => "Martinica",
"mr" => "Mauritania",
"ms" => "Montserrat",
"mt" => "Malta",
"mu" => "Mauritius",
"museum" => "Museum",
"mv" => "Maldive",
"mw" => "Malawi",
"mx" => "Messico",
"my" => "Malesia",
"mz" => "Mozambico",
"na" => "Namibia",
"name" => "Personal",
"nc" => "Nuova Caledonia",
"ne" => "Nigeria",
"net" => "Reti",
"nf" => "Isole Norfolk",
"ng" => "Nigeria",
"ni" => "Nicaragua",
"nl" => "Olanda",
"no" => "Norvegia",
"np" => "Nepal",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Numerico",
"nz" => "Nuova Zelanda",
"om" => "Oman",
"org" => "Organizzazioni",
"pa" => "Panama",
"pe" => "Per&ugrave;",
"pf" => "Polinesia Francese",
"pg" => "Papua Nuova Guinea",
"ph" => "Filippine",
"pk" => "Pakistan",
"pl" => "Polonia",
"pm" => "St. Pierre e Miquelon",
"pn" => "Pitcairn",
"pr" => "Porto Rico",
"pro" => "Professional",
"ps" => "Palestina",
"pt" => "Portogallo",
"pw" => "Palau",
"py" => "Paraguay",
"qa" => "Qatar",
"re" => "Reunion",
"ro" => "Romania",
"rs" => "Serbia",
"ru" => "Russia",
"rw" => "Ruanda",
"sa" => "Arabia Saudita",
"sb" => "Isole Salomone",
"sc" => "Seychelles",
"sd" => "Sudan",
"se" => "Svezia",
"sg" => "Singapore",
"sh" => "Sant'Elena",
"si" => "Slovenia",
"sj" => "Isole Svalbard e Jan Mayen",
"sk" => "Slovacchia",
"sl" => "Sierra Leone",
"sm" => "San Marino",
"sn" => "Senegal",
"so" => "Somalia",
"sr" => "Suriname",
"st" => "Sao Tom&eacute; e Principe",
"su" => "Unione Sovietica",
"sv" => "El Salvador",
"sy" => "Siria",
"sz" => "Swaziland",
"tc" => "Isole Turks e Caicos",
"td" => "Ciad",
"tf" => "Territori Francesi del Sud-Est",
"tg" => "Togo",
"th" => "Thailandia",
"tj" => "Tagikistan",
"tk" => "Tokelau",
"tl" => "Timor Est",
"tm" => "Turkmenistan",
"tn" => "Tunisia",
"to" => "Tonga",
"tp" => "Timor Est",
"tr" => "Turchia",
"tt" => "Trinidad e Tobago",
"tv" => "Tuvalu",
"tw" => "Taiwan",
"tz" => "Tanzania",
"ua" => "Ucraina",
"ug" => "Uganda",
"uk" => "Regno Unito",
"um" => "Isole Minori degli Stati Uniti",
"unknown" => "Sconosciuto",
"us" => "Stati Uniti",
"uy" => "Uruguay",
"uz" => "Uzbekistan",
"va" => "Citt&agrave; del Vaticano",
"vc" => "St. Vincent e Grenadines",
"ve" => "Venezuela",
"vg" => "Isole Vergini Britanniche",
"vi" => "Isole Vergini Americane",
"vn" => "Vietnam",
"vu" => "Vanuatu",
"wf" => "Isole Wallis e Futuna",
"ws" => "Samoa",
"ye" => "Yemen",
"yt" => "Mayotte",
"yu" => "Serbia and Montenegro",
"za" => "Sud Africa",
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
"global_bbclone_copyright" => "Il team di BBClone - Distribuito sotto licenza ",
"global_last_reset" => "Le statistiche vengono analizzate dal",
"global_yes" => "si",
"global_no" => "no",

// The error messages
"error_cannot_see_config" =>
"Non sei autorizzato a vedere la configurazione di BBClone su questo server.",

// Date format (used with date())
"global_time_format" => "M jS, H:i:s",
"global_day_format" => "l F jS, Y",
"global_hours_format" => "l F jS, G:00",
"global_month_format" => "F Y",

// Miscellaneoux translations
"misc_other" => "Altro",
"misc_unknown" => "Sconosciuto",
"misc_second_unit" => "s",
"misc_ignored" => "Ignorato",

// The Navigation Bar
"navbar_main_site" => "Sito principale",
"navbar_configuration" => "Configurazione",
"navbar_global_stats" => "Statistiche globali",
"navbar_detailed_stats" => "Statistiche dettagliate",
"navbar_time_stats" => "Statistiche temporali",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Data e ora",
"dstat_visits" => "Visite",
"dstat_extension" => "Estensione",
"dstat_dns" => "Nome host",
"dstat_from" => "Da",
"dstat_os" => "Sistema operativo",
"dstat_browser" => "Browser",
"dstat_visible_rows" => "Accessi visibili",
"dstat_green_rows" => "righe verdi",
"dstat_blue_rows" => "righe blu",
"dstat_red_rows" => "righe rosse",
"dstat_search" => "Ricerca",
"dstat_last_page" => "Ultima pagina",
"dstat_last_visit" => "ultima visita",
"dstat_robots" => "robot",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "Nessun dato disponibile",
"dstat_prx" => "Proxy server",
"dstat_ip" => "Indirizzo IP",
"dstat_user_agent" => "User agent",
"dstat_nr" => "N",
"dstat_pages" => "Pagine",
"dstat_visit_length" => "Lunghezza visita",
"dstat_reloads" => "Reload",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Accessi",
"gstat_total_visits" => "Visite totali",
"gstat_total_unique" => "Totali unici",
"gstat_operating_systems" => "%d primi sistemi operativi",
"gstat_browsers" => "%d primi browser",
"gstat_extensions" => "%d prime estensioni",
"gstat_robots" => "%d primi robot",
"gstat_pages" => "%d prime pagine",
"gstat_origins" => "%d primi referenti",
"gstat_hosts" => "%d primi host",
"gstat_keys" => "%d prime ricerche",
"gstat_total" => "Totale",
"gstat_not_specified" => "Non specificato",

// Time stats words
"tstat_su" => "Dom",
"tstat_mo" => "Lun",
"tstat_tu" => "Mar",
"tstat_we" => "Mer",
"tstat_th" => "Gio",
"tstat_fr" => "Ven",
"tstat_sa" => "Sab",

"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "Gen",
"tstat_feb" => "Feb",
"tstat_mar" => "Mar",
"tstat_apr" => "Apr",
"tstat_may" => "Mag",
"tstat_jun" => "Giu",
"tstat_jul" => "Lug",
"tstat_aug" => "Ago",
"tstat_sep" => "Set",
"tstat_oct" => "Ott",
"tstat_nov" => "Nov",
"tstat_dec" => "Dic",

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

"tstat_last_day" => "Ultimo giorno",
"tstat_last_week" => "Ultima settimana",
"tstat_last_month" => "Ultimo mese",
"tstat_last_year" => "Ultimo anno",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences

"config_variable_name" => "Nome della variabile",
"config_variable_value" => "Valore della variabile",
"config_explanations" => "Spiegazioni",

"config_BBC_MAINSITE" =>
"Se questa variabile &egrave; impostata, verr&agrave; generato un link alla locazione specificata.
Il valore di default punta verso la directory genitore; nel caso il tuo sito principale si trovi da
un'altra parte, imposta questa variabile come necessario.<br />
Esempi:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"Di default, la configurazione di BBClone &egrave; visibile. Per nasconderla, disattiva questa opzione.<br />
Esempi:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Il titolo che appare nella barra del titolo di tutte le pagine di BBClone.<br />
Le macro disponibili sono:<br />
<ul>
<li>%SERVER : il nome del server,
<li>%DATE : la data corrente.
</ul>
Sono consentite le tag HTML.<br />
Esempi:<br />
\$BBC_TITLEBAR = &quot;Statistics for %SERVER generated the %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;Statistiche del server %SERVER generate in data %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;Ecco qua i miei risultati del %DATE:&quot;;
<br />",

"config_BBC_LANGUAGE" =>
"La lingua di default di BBClone, nel caso non sia stata specificata dal browser.
Sono disponibili le lingue seguenti:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, cn-cn e zh-tw</p>",

"config_BBC_MAXTIME" =>
"Questa variabile definisce la lunghezza di una unica visita, in secondi.
Tutti gli hit provenienti da uno stesso visitatore entro questo periodo sono considerati come
una unica visita, finch&egrave; due hit successivi non superano questo limite. Il valore di default
&egrave; 30 minuti (1800 secondi), che &egrave; lo standard Web de facto; tuttavia, se lo desideri,
puoi impostare un valore diverso.<br />
Esempi:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Quante entrate vuoi vedere nelle statistiche dettagliate? Il valore di default &egrave; 100.
Non impostare a un valore maggiore di 500 per evitare sovraccarichi.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"La variabile \$BBC_DETAILED_STAT_FIELDS determina quali colonne saranno mostrate nelle statistiche
dettagliate. Le colonne disponibili sono:
<ul>
<li>id&nbsp;=&gt;&nbsp;Visitatore numero x dall'inizio del conteggio</li>
<li>time&nbsp;=&gt;&nbsp;Tempo di registrazione dell'ultimo hit</li>
<li>visits&nbsp;=&gt;&nbsp;Gli hit di un unico visitatore</li>
<li>dns&nbsp;=&gt;&nbsp;Nome host del visitatore</li>
<li>ip&nbsp;=&gt;&nbsp;Indirizzo IP del visitatore</li>
<li>os&nbsp;=&gt;&nbsp;Sistema operativo (se disponibile e/o non &egrave; un robot)</li>
<li>browser&nbsp;=&gt;&nbsp;Il software usato per la connessione</li>
<li>ext&nbsp;=&gt;&nbsp;Nazione o estensione del visitatore</li>
<li>referer&nbsp;=&gt;&nbsp;The link from which a visitor came (if available)</li>
<li>page&nbsp;=&gt;&nbsp;The last visited page</li>
<li>search&nbsp;=&gt;&nbsp;The search query a visitor used (if available)</li>
</ul>
Le colonne saranno mostrate nello stesso ordine in cui sono state specificate.<br />
Esempi:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"Nel caso che il tempo del server non corrisponda al tuo fuso orario locale, puoi correggere
la differenza impostando questa variabile (in minuti). Valori negativi riportano indietro
l'orario, valori positivi lo avanzano.<br />
Esempi:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Questa opzione stabilisce se gli indirizzi IP debbano essere o no tradotti in nomi host.
I nomi host sono molto pi&ugrave; significativi degli indirizzi IP; tuttavia la traduzione potrebbe
rallentare parecchio il tuo sito, se i server DNS utilizzati sono lenti, limitati o inaffidabili.
Se hai questo problema, imposta questa opzione.<br />
Esempi:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"Di default vengono mostrati gli hit nelle statistiche temporali, perch&eacute; ci&ograve; rappresenta meglio il
carico attuale del server. Se invece desideri che le statistiche temporali siano basate sulle visite uniche, puoi
cambiare il sistema di conteggio impostando questa variabile.<br />
Esempi:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Puoi impostare questa opzione per escludere un determinato indirizzo IP (o una determinata gamma di indirizzi IP)
dal conteggio. Le espressioni, se pi&ugrave; d'una, devono essere separate da una virgola.<br />
Esempi:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"Se vuoi escludere determinati referenti dai visitatori elencati nella lista di primi referenti o
nelle statistiche dettagliate, imposta qui le parole chiave, separate da una virgola.
I referenti che contengono una di queste parole chiave verranno bloccati.<br />
Esempi:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Questa opzione determina come vengono considerati i robot. Di default essi vengono inclusi in tutte le statistiche, eccetto la lista di primi host. Se vuoi ignorare completamente i robot imposta questa opzione a &quot;2&quot;, in questo caso verranno conteggiati solo i visitatori umani.<br />
Esempi:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"Questa opzione definisce il modo in cui BBClone distingue i visitatori. Di default
viene utilizzato solo l'indirizzo IP, il che di solito &egrave; sufficiente.
Tuttavia, se spesso i tuoi visitatori sono nascosti dietro dei server proxy, disattiva questa
opzione per ottenere un quadro pi&ugrave; realistico della situazione; cos&igrave;, infatti, un nuovo visitatore verr&agrave;
individuato da un cambiamento dell'user agent.<br />
Esempi:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Per azzerare le statistiche, imposta questa variabile (le statistiche saranno cancellate
alla visita immediatamente successiva). Non dimenticare di disattivarla subito dopo, o noterai
uno strano crollo del numero di visitatori!<br />
Esempi:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Le statistiche di host e referenti possono generare una enorme mole di dati, spesso relativi a dei visitatori che
hanno visitato il tuo sito una volta sola. Puoi impostare questa opzione per spurgare le statistiche da tali entrate.
Ci&ograve; ridurr&agrave; la dimensione del file access.php senza modificare la lista attuale di primi host e referenti;
gli hit andranno ad aggiungersi ai &quot;Non specificato&quot; per lasciare intatto il punteggio globale.<br />
Examples:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
