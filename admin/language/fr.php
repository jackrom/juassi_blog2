<?php
/* This file is part of BBClone (A PHP based Web Counter on Steroids)
 *
 * CVS FILE $Id: fr.php,v 1.76 2011/12/30 23:03:24 joku Exp $
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

// French language

// The DNS Extensios array
$extensions = array(
"numeric" => "Num&eacute;rique",
"unknown" => "Inconnu",
"museum" => "Mus&eacute;e",
"travel" => "Voyage",
"aero" => "A&Eacute;ro",	
"arpa" => "Arpa",
"asia" => "Asie-Pacifique",
"coop" => "Coop&eacute;rative",
"info" => "Information",
"jobs" => "Emploi",
"mobi" => "Mobiles",
"name" => "Personnel",
"biz" => "Entreprise",
"cat" => "Catalan",
"com" => "Commercial",
"edu" => "&Eacute;ducation",
"gov" => "Gouvernement",
"int" => "Organisations Internationales",
"mil" => "Arm&eacute;e Am&eacute;ricaine",
"net" => "R&eacute;seaux",
"org" => "Non commercial",
"pro" => "Professionnel",
"tel" => "Contacts",
"xxx" => "pornographique",

"ac" => "&Icirc;le de l'Ascension",
"ad" => "Andorre",
"ae" => "&Eacute;mirats Arabes Unis",
"af" => "Afganistan",
"ag" => "Antigua-et-Barbuda",
"ai" => "Anguilla",
"al" => "Albanie",
"am" => "Arm&eacute;nie",
"an" => "Antilles N&eacute;erlandaises",
"ao" => "Angola",
"aq" => "Antarctique",
"ar" => "Argentine",
"as" => "Samoa Am&eacute;ricaines",
"at" => "Autriche",
"au" => "Australie",
"aw" => "Aruba",
"ax" => "&Icirc;les &Aring;land",
"az" => "Azerba&iuml;djan",
"ba" => "Bosnie-Herz&eacute;govine",
"bb" => "La Barbade",
"bd" => "Bangladesh",
"be" => "Belgique",
"bf" => "Burkina Faso",
"bg" => "Bulgarie",
"bh" => "&Icirc;le de Bahre&iuml;n",
"bi" => "Burundi",
"bj" => "Benin",
"bl" => "Saint-Barthélemy",
"bm" => "Bermudes",
"bn" => "Brunei Darussalam",
"bo" => "Bolivie",
"br" => "Br&eacute;sil",
"bs" => "Bahamas",
"bt" => "Bhoutan",
"bv" => "&Icirc;les Bouvet",
"bw" => "Botswana",
"by" => "Bi&eacute;lorussie",
"bz" => "Belize",
"ca" => "Canada",
"cc" => "&Icirc;les Cocos",
"cd" => "Rep. Dem. du Congo",
"cf" => "Rep. Centrafricaine",
"cg" => "Congo",
"ch" => "Suisse",
"ci" => "C&ocirc;te d'Ivoire",
"ck" => "&Icirc;les Cook",
"cl" => "Chili",
"cm" => "Cameroun",
"cn" => "Chine",
"co" => "Colombie",
"cr" => "Costa Rica",
"cs" => "Serbie et Mont&eacute;n&eacute;gro",
"cu" => "Cuba",
"cv" => "Cap Vert",
"cx" => "&Icirc;les Christmas",
"cy" => "Chypre",
"cz" => "Rep. Tch&egrave;que",
"de" => "Allemagne",
"dj" => "Rep. de Djibouti",
"dk" => "Danemark",
"dm" => "La Dominique",
"do" => "Rep. Dominicaine",
"dz" => "Alg&eacute;rie",
"ec" => "&Eacute;quateur",
"ee" => "Estonie",
"eg" => "&Eacute;gypte",
"eh" => "Sahara occidental",
"er" => "&Eacute;rythr&eacute;e",
"es" => "Espagne",
"et" => "&Eacute;thiopie",
"eu" => "Union Europ&eacute;enne",
"fi" => "Finlande",
"fj" => "Fidji",
"fk" => "&Icirc;les Malouines (Falkland)",
"fm" => "Micron&eacute;sie",
"fo" => "&Icirc;les F&eacute;ro&eacute;",
"fr" => "France",
"ga" => "Gabon",
"gb" => "Grande Bretagne",
"gd" => "Grenade",
"ge" => "G&eacute;orgie",
"gf" => "Guyane Fran&ccedil;aise",
"gg" => "Guernesey",
"gh" => "Ghana",
"gi" => "Gibraltar",
"gl" => "Gro&euml;nland",
"gm" => "Gambie",
"gn" => "Guin&eacute;e",
"gp" => "Guadeloupe",
"gq" => "Guin&eacute;e &Eacute;quatoriale",
"gr" => "Gr&egrave;ce",
"gs" => "G&eacute;orgie du Sud",
"gt" => "Guat&eacute;mala",
"gu" => "&Icirc;le de Guam",
"gw" => "Guin&eacute;-Bissau",
"gy" => "Guyane",
"hk" => "Hong Kong",
"hm" => "&Icirc;les Heard et Mc Donald",
"hn" => "Honduras",
"hr" => "Croatie",
"ht" => "Ha&iuml;ti",
"hu" => "Hongrie",
"id" => "Indon&eacute;sie",
"ie" => "Irlande",
"il" => "Isra&euml;l",
"im" => "&Icirc;le de Man",
"in" => "Inde",
"io" => "Ter. Brit. de l'Oc&eacute;an Indien",
"iq" => "Iraq",
"ir" => "Iran",
"is" => "Islande",
"it" => "Italie",
"je" => "Jersey",
"jm" => "Jama&iuml;que",
"jo" => "Jordanie",
"jp" => "Japon",
"ke" => "Kenya",
"kg" => "Kirghizistan",
"kh" => "Cambodge",
"ki" => "Kiribati",
"km" => "Comores",
"kn" => "Saint Kitts et Nevis",
"kp" => "Cor&eacute;e du Nord",
"kr" => "Cor&eacute;e",
"kw" => "Kowe&iuml;t",
"ky" => "&Icirc;les Ca&iuml;mans",
"kz" => "Kazakhstan",
"la" => "Laos",
"lb" => "Liban",
"lc" => "Sainte Lucie",
"li" => "Liechtenstein",
"lk" => "Sri Lanka",
"lr" => "Lib&eacute;ria",
"ls" => "Lesotho",
"lt" => "Lituanie",
"lu" => "Luxembourg",
"lv" => "Lettonie",
"ly" => "Libye",
"ma" => "Maroc",
"mc" => "Monaco",
"md" => "Moldavie",
"me" => "Montenegro",
"mf" => "Saint-Martin",
"mg" => "Madagascar",
"mh" => "&Icirc;les Marshall",
"mk" => "Mac&eacute;doine",
"ml" => "Mali",
"mm" => "Myanmar (Birmanie)",
"mn" => "Mongolie",
"mo" => "Macao",
"mp" => "&Icirc;les Mariannes du Nord",
"mq" => "Martinique",
"mr" => "Mauritanie",
"ms" => "Montserrat",
"mt" => "&Icirc;le de Malte",
"mu" => "&Icirc;les Maurice",
"mv" => "&Icirc;les Maldives",
"mw" => "Malawi",
"mx" => "Mexique",
"my" => "Malaisie",
"mz" => "Mozambique",
"na" => "Namibie",
"nc" => "Nouvelle Cal&eacute;donie",
"ne" => "Niger",
"nf" => "&Icirc;les Norfolk",
"ng" => "Nig&eacute;ria",
"ni" => "Nicaragua",
"nl" => "Pays Bas",
"no" => "Norv&egrave;ge",
"np" => "N&eacute;pal",
"nr" => "Nauru",
"nu" => "Niue",
"nz" => "Nouvelle-Z&eacute;lande",
"om" => "Oman",
"pa" => "Panama",
"pe" => "P&eacute;rou",
"pf" => "Polyn&eacute;sie Fran&ccedil;aise",
"pg" => "Papouasie Nouvelle Guin&eacute;e",
"ph" => "Philippines",
"pk" => "Pakistan",
"pl" => "Pologne",
"pm" => "Saint-Pierre-et-Miquelon",
"pn" => "Pitcairn",
"pr" => "Porto Rico",
"ps" => "Palestine",
"pt" => "Portugal",
"pw" => "Palau",
"py" => "Paraguay",
"qa" => "Qatar",
"re" => "&Icirc;les de la R&eacute;union",
"ro" => "Roumanie",
"rs" => "Serbie",
"ru" => "Russie",
"rw" => "Rwanda",
"sa" => "Arabie Saoudite",
"sb" => "&Icirc;les Salomon",
"sc" => "Les Seychelles",
"sd" => "Soudan",
"se" => "Su&egrave;de",
"sg" => "Singapour",
"sh" => "Saint H&eacute;l&egrave;ne",
"si" => "Slov&eacute;nie",
"sj" => "&Icirc;les Svalbard et Jan Mayen",
"sk" => "Slovaquie",
"sl" => "Sierra Leone",
"sm" => "Saint-Marin",
"sn" => "S&eacute;n&eacute;gal",
"so" => "Somalie",
"sr" => "Suriname",
"st" => "S&atilde;o Tom&eacute; et Pr&iacute;ncipe",
"su" => "ex U.R.S.S",
"sv" => "Salvador",
"sy" => "Syrie",
"sz" => "Swaziland",
"tc" => "&Icirc;les Turques et Ca&iuml;ques",
"td" => "Tchad",
"tf" => "Ter. Fran&ccedil;ais du Sud",
"tg" => "Togo",
"th" => "Tha&iuml;lande",
"tj" => "Tadjikistan",
"tk" => "Tokelau",
"tl" => "Timor Oriental",
"tm" => "Turkm&eacute;nistan",
"tn" => "Tunisie",
"to" => "Tonga",
"tp" => "Timor Oriental",
"tr" => "Turquie",
"tt" => "Trinidad et Tobago",
"tv" => "&Icirc;les Tuvalu",
"tw" => "Ta&iuml;wan",
"tz" => "Tanzanie",
"ua" => "Ukraine",
"ug" => "Ouganda",
"uk" => "Royaume Uni",
"um" => "&Icirc;les Am&eacute;ricaines Mineures",
"us" => "&Eacute;tats Unis",
"uy" => "Uruguay",
"uz" => "Ouzb&eacute;kistan",
"va" => "Vatican",
"vc" => "Saint-Vincent-et-les Grenadines",
"ve" => "V&eacute;n&eacute;zu&eacute;la",
"vg" => "&Icirc;les Vierges Britaniques",
"vi" => "&Icirc;les Vierges Am&eacute;ricaines",
"vn" => "Vi&ecirc;t Nam",
"vu" => "Vanuatu",
"wf" => "&Icirc;les Wallis-et-Futuna",
"ws" => "Samoa",
"ye" => "Y&eacute;men",
"yt" => "Mayotte",
"yu" => "Yougoslavie",
"za" => "Afrique du Sud",
"zm" => "Zambie",
"zr" => "ex Za&iuml;re",
"zw" => "Zimbabwe",
);

// The nain Translation array
$translation = array(

// Specific charset
"global_charset" => "utf-8",

// Date format (used with date() )
"global_time_format" => "j M, H:i:s",
"global_day_format" => "l j F Y",
"global_hours_format" => "l j F, G:00",
"global_month_format" => "F Y",

// Global translation
"global_titlebar" => "Statistiques sur %SERVER le %DATE",
"global_bbclone_copyright" => "L'&Eacute;quipe BBClone - Licence ",
"global_last_reset" => "Statistiques r&eacute;initialis&eacute;es le",
"global_yes" => "oui",
"global_no" => "non",

// The error messages
"error_cannot_see_config" =>
"Vous n'avez pas l'autorisation de visualiser la configuration de BBClone sur ce serveur",
"error_cannot_see_development" =>
"Vous n'avez pas l'autorisation de visualiser les r&eacute;gressions de BBClone sur ce serveur.",

// Miscellaneous translations
"misc_other" => "Autre",
"misc_unknown" => "Inconnu",
"misc_second_unit" => "s",
"misc_ignored" => "Ignor&eacute;",

// The Navigation Bar
"navbar_main_site" => "Site principal",
"navbar_configuration" => "Configuration",
"navbar_global_stats" => "Statistiques Globales",
"navbar_detailed_stats" => "Statistiques D&eacute;taill&eacute;es",
"navbar_time_stats" => "Statistiques Temporelles",
"navbar_language" => "Langue",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "Id",
"dstat_time" => "Date",
"dstat_visits" => "Visites",
"dstat_extension" => "Extension",
"dstat_dns" => "Nom de domaine",
"dstat_from" => "&Agrave; partir de",
"dstat_os" => "SE",
"dstat_browser" => "Navigateur",
"dstat_visible_rows" => "Acc&egrave;s visibles",
"dstat_green_rows" => "lignes vertes",
"dstat_blue_rows" => "lignes bleues",
"dstat_red_rows" => "lignes rouges",
"dstat_orange_rows" => "lignes oranges",
"dstat_search" => "Recherche",
"dstat_last_page" => "derni&egrave;re page",
"dstat_last_visit" => "derni&egrave;re visite",
"dstat_robots" => "Robots",
"dstat_my_visit" => "Visites depuis votre IP",
"dstat_no_data" => "Pas de donn&eacute;es disponible",
"dstat_prx" => "Proxy",
"dstat_ip" => "Adresse&nbsp;IP",
"dstat_user_agent" => "Identit&eacute; du navigateur",
"dstat_nr" => "Non",
"dstat_pages" => "Titre de la page",
"dstat_visit_length" => "Dur&eacute;e",
"dstat_reloads" => "Page&nbsp;recharg&eacute;e",
"dstat_whois_information" => "Informations sur cette adresse IP",

// Global stats words
"gstat_accesses" => "Acc&egrave;s",
"gstat_total_visits" => "Total des pages visit&eacute;es",
"gstat_total_unique" => "Nombre de visiteurs",
"gstat_operating_systems" =>"Les %d premiers Syst&egrave;mes",
"gstat_browsers" => "Les %d premiers Navigateurs",
"gstat_extensions" => "Les %d premi&egrave;res Extensions",
"gstat_robots" => "Les %d premiers Robots",
"gstat_pages" => "Les %d premi&egrave;res Pages",
"gstat_origins" => "Les %d premi&egrave;res Provenances",
"gstat_hosts" => "Les %d premiers Domaines",
"gstat_keys" => "Les %d premiers Mots-cl&eacute;s",
"gstat_total" => "Total",
"gstat_not_specified" => "Non specifi&eacute;",

// Time stats words
"tstat_su" => "Dim",
"tstat_mo" => "Lun",
"tstat_tu" => "Mar",
"tstat_we" => "Mer",
"tstat_th" => "Jeu",
"tstat_fr" => "Ven",
"tstat_sa" => "Sam",

"tstat_full_su" => "Dimanche",
"tstat_full_mo" => "Lundi",
"tstat_full_tu" => "Mardi",
"tstat_full_we" => "Mercredi",
"tstat_full_th" => "Jeudi",
"tstat_full_fr" => "Vendredi",
"tstat_full_sa" => "Samedi",

"tstat_jan" => "Jan",
"tstat_feb" => "F&eacute;v",
"tstat_mar" => "Mar",
"tstat_apr" => "Avr",
"tstat_may" => "Mai",
"tstat_jun" => "Jui",
"tstat_jul" => "Jui",
"tstat_aug" => "Aou",
"tstat_sep" => "Sep",
"tstat_oct" => "Oct",
"tstat_nov" => "Nov",
"tstat_dec" => "D&eacute;c",

"tstat_full_jan" => "Janvier",
"tstat_full_feb" => "F&eacute;vrier",
"tstat_full_mar" => "Mars",
"tstat_full_apr" => "Avril",
"tstat_full_may" => "Mai",
"tstat_full_jun" => "Juin",
"tstat_full_jul" => "Juillet",
"tstat_full_aug" => "Ao&ucirc;t",
"tstat_full_sep" => "Septembre",
"tstat_full_oct" => "Octobre",
"tstat_full_nov" => "Novembre",
"tstat_full_dec" => "D&eacute;cembre",

"tstat_last_day" => "La derni&egrave;re journ&eacute;e",
"tstat_last_week" => "La derni&egrave;re semaine",
"tstat_last_month" => "Le dernier mois",
"tstat_last_year" => "La derni&egrave;re ann&eacute;e",
"tstat_average" => "Moyenne",

// Loadtime notice
"generated" => "page g&eacute;n&eacute;r&eacute;e en ",
"seconds" => " secondes",

// Configuration page words and sentences
"config_variable_name" => "Nom de la variable",
"config_variable_value" => "Valeur de la variable",
"config_explanations" => "Explications",

"config_BBC_MAINSITE" =>
"Si cette variable a &eacute;t&eacute; renseign&eacute;e, un lien sera
cr&eacute;&eacute; vers l'adresse sp&eacute;cifi&eacute;e. Par d&eacute;faut,
le lien pointe vers le r&eacute;pertoire parent. Dans le cas o&ugrave;
votre site est situ&eacute; &agrave; une autre adresse, vous aurez
surement envie d'adapter cette valeur &agrave; vos besoins.<br />
Exemples:<br />
\$BBC_MAINSITE = &quot;http://www.mon-serveur.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"Par d&eacute;faut, BBClone donne l'acc&egrave;s &agrave; ses valeurs de
configuration. Si vous ne souhaitez pas proposer cette option,
d&eacute;sactivez-l&agrave; pour en interdire l'acc&egrave;s.<br />
Exemples:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Le nom de vos pages de statistiques.<br />
Le titre qui appara&icirc;t sous la barre de navigation de chaque pages BBClone.<br />
Les macros reconnues sont:<br />
<ul>
<li>%SERVER: le nom du site,</li>
<li>%DATE: la date courante.</li>
</ul>
Les balises HTML sont autoris&eacute;s.<br />
Exemples:<br />
\$BBC_TITLEBAR = &quot;Statistiques de %SERVER g&eacute;n&eacute;r&eacute;es le %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;Voici mes statistiques au %DATE:&quot;;
<br />",

"config_BBC_LANGUAGE" =>
"La langue par d&eacute;faut de BBClone, au cas o&ugrave; elle n'a pas
&eacute;t&eacute; sp&eacute;cifi&eacute;e par le navigateur. Voici les langues
support&eacute;es:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, zh-cn et zh-tw</p>",

"config_BBC_MAXTIME" =>
"Cette variable d&eacute;finit la dur&eacute;e d'une visite unique (session) en
secondes.
Chaque requ&ecirc;te provenant du m&ecirc;me visiteur, pendant cette dur&eacute;e,
sera consid&eacute;r&eacute;e comme une seule visite, aussi longtemps que deux
requ&ecirc;tes successives ne d&eacute;passeront pas cette dur&eacute;e.
La valeur par d&eacute;faut est celle utilis&eacute;e en standard sur les serveurs,
soit 30 minutes (1800 secondes), mais vous pouvez attribuer une valeur
diff&eacute;rente selon vos besoins.<br />
Exemples:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Combien d'entr&eacute;es doivent &ecirc;tre r&eacute;pertori&eacute;es dans
les statistiques d&eacute;taill&eacute;es?<br />
Par d&eacute;faut, les 100 premi&egrave;res seront visibles. Il est conseill&eacute;
de ne pas d&eacute;passer 500 pour ne pas surcharger les pages.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"La variable \$BBC_DETAILED_STAT_FIELDS d&eacute;termine les colonnes &agrave; afficher
dans les statistiques d&eacute;taill&eacute;es. Voici les colonnes disponibles:
<ul>
<li>id&nbsp;=&gt;&nbsp;Le Ni&egrave;me visiteur depuis le d&eacute;but des statistiques</li>
<li>time&nbsp;=&gt;&nbsp;La date de la derni&egrave;re requ&ecirc;te</li>
<li>visits&nbsp;=&gt;&nbsp;Les requ&ecirc;tes par visiteur</li>
<li>dns&nbsp;=&gt;&nbsp;Le domaine du visiteur</li>
<li>ip&nbsp;=&gt;&nbsp;L'adresse IP du visiteur</li>
<li>os&nbsp;=&gt;&nbsp;Le syst&egrave;me d'exploitation (si disponible et/ou pas un robot)</li>
<li>browser&nbsp;=&gt;&nbsp;Le programme utilis&eacute; pour se connecter</li>
<li>ext&nbsp;=&gt;&nbsp;Le pays ou l'extention du visiteur</li>
<li>referer&nbsp;=&gt;&nbsp;D'o&ugrave; vient le visiteur (le r&eacute;f&eacute;rent)</li>
<li>page =&gt; La derni&egrave;re page visit&eacute;e</li>
<li>search =&gt; Les mots-cl&eacute;s de recherche utilis&eacute;s par le visiteur (si disponible)</li>
</ul>
L'odre des colonnes affich&eacute;es sera le m&ecirc;me que celui que vous aurez choisi.<br />
Exemples:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;, referer;<br />",

"config_BBC_TIME_OFFSET" =>
"Au cas o&ugrave; l'heure ne correspondrait pas &agrave; votre fuseau horaire,
vous pouvez l'ajuster en utilisant cette variable. Une valeur n&eacute;gative
reculera l'heure, une positive l'avancera.<br />
Exemples:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Cette option d&eacute;finit si le nom de domaine doit &ecirc;tre d&eacute;duit
de l'adresse IP ou non. M&ecirc;me si les noms de domaines sont plus parlant sur
l'origine des visiteurs, leur d&eacute;duction peut consid&eacute;rablement
ralentir votre site si les serveurs DNS utilis&eacute;s sont lents, de capacit&eacute;s
r&eacute;duites ou simplement peu fiables. Activer cette option peut &eacute;viter
des soucis de lenteur.<br />
Exemples:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"BBClone est configur&eacute; par d&eacute;faut pour montrer, dans les
statistiques temporelles, le nombre de pages consult&eacute;es, ce qui
donne une r&eacute;elle image de la charge du serveur. Maintenant, si vous
pr&eacute;f&eacute;rez afficher le nombre de visiteurs dans vos statistiques
temporelles, vous n'avez qu'&agrave; activer cette option.<br />
Exemples:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Cette option permet d'exclure du comptage certaines adresses IP ou des groupes
d'adresses. Pour ajouter plusieurs valeurs, utilisez une virgule comme
s&eacute;parateur.<br />
Exemples:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"Dans le cas o&ugrave; vous ne voudriez pas voir appara&icirc;tre les
r&eacute;f&eacute;rents dans les listes ou dans les stastistiques
d&eacute;taill&eacute;es, vous pouvez indiquer un ou plusieurs mots cl&eacute;s
pour bloquer ces r&eacute;f&eacute;rents. Si vous utilisez plusieurs mots,
merci d'utiliser une virgule comme s&eacute;parateur.<br />
Exemples:<br />
\$BBC_IGNORE_REFER = &quot;robot-spam.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Vous pouvez utiliser cette option pour d&eacute;terminer la m&eacute;thode
d'analyse du passage des robots. Par d&eacute;fault, les noms de domaines des
robots sont exclut de vos listes de statistiques globales. Si vous ne voulez
pas voir appara&icirc;tre les traces de leurs passages, et ainsi ne tenir compte
que des visites humaines, passez cette option &agrave; &quot;2&quot;.<br />
Exemples:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"Cette option d&eacute;finit comment BBClone distingue un visiteur d'un autre.
Par d&eacute;faut il utilise seulement l'adresse IP, ce qui fourni des
profils r&eacute;alistes dans la majorit&eacute; des cas. Maintenant, si vos
visiteurs sont souvent cach&eacute;s derri&egrave;re des serveurs proxy, la
d&eacute;sactivation de cette option peut fournir des profils plus r&eacute;alistes,
puisqu'un nouveau visiteur sera pris en compte &agrave; chaque changement de
navigateur.<br />
Exemples:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"D&egrave;s que vous voulez r&eacute;initialiser vos statistiques, activez cette
commande : les statistiques accumul&eacute;es seront effac&eacute;es par la
visite suivante. N'oubliez pas de d&eacute;sactiver la commande juste
apr&egrave;s, sinon vous risquez de constater un passage &eacute;trangement
faible sur votre site ;).<br />
Exemples:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Les statistiques des noms de domaines et des r&eacute;f&eacute;rents
peuvent g&eacute;n&eacute;rer une &eacute;norme quantit&eacute; de
donn&eacute;es, malgr&eacute; tout uniquement &agrave; cause de visites
uniques. En utilisant cette commande, vous pouvez purger ces entr&eacute;es
et ainsi diminuer de fa&ccedil;on consid&eacute;rable la taille du fichier
access.php, sans pour autant affecter le v&eacute;ritable classement des
noms de domaines et des r&eacute;f&eacute;rents. Le nombre des requ&ecirc;tes
correspondantes sera ajout&eacute; aux entr&eacute;es &quot;Non specifi&eacute;&quot;
pour conserver les r&eacute;sultats intacts.<br />
Exemples:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"
);
?>
