<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: pt.php,v 1.22 2011/12/30 23:03:24 joku Exp $
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

"ac" => "Ilha Ascen&ccedil;&atilde;o",
"ad" => "Andorra",
"ae" => "Emiratos &Aacute;rabes Unidos",
"aero" => "Aero",
"af" => "Afeganist&atilde;o",
"ag" => "Ant&iacute;gua e Barbuda",
"ai" => "Anguilla",
"al" => "Alb&acirc;nia",
"am" => "Arm&eacute;nia",
"an" => "Antilhas Holandesas",
"ao" => "Angola",
"aq" => "Ant&aacute;rctida",
"ar" => "Argentina",
"arpa" => "ARPA",
"as" => "Samoa Americana",
"at" => "&Aacute;ustria",
"au" => "Austr&aacute;lia",
"aw" => "Aruba",
"ax" => "Åland",
"az" => "Azerbaij&atilde;o",
"ba" => "B&oacute;snia e Herzegovina",
"bb" => "Barbados",
"bd" => "Bangladesh",
"be" => "B&eacute;lgica",
"bf" => "Burkina Faso",
"bg" => "Bulg&aacute;ria",
"bh" => "Bahrain",
"bi" => "Burundi",
"biz" => "Neg&oacute;cios",
"bj" => "Benin",
"bl" => "São Bartolomeu (Antilhas francesas)",
"bm" => "Bermudas",
"bn" => "Brunei",
"bo" => "Bol&iacute;via",
"br" => "Brasil",
"bs" => "Bahamas",
"bt" => "But&atilde;o",
"bv" => "Ilha Bouvet",
"bw" => "Botsuana",
"by" => "Bielor&uacute;ssia",
"bz" => "Belize",
"ca" => "Canad&aacute;",
"cc" => "Ilhas Cocos",
"cd" => "Congo",
"cf" => "Rep&uacute;blica da &Aacute;frica Central",
"cg" => "Congo",
"ch" => "Su&iacute;ca",
"ci" => "Costa do Marfim",
"ck" => "Ilhas Cook",
"cl" => "Chile",
"cm" => "Camar&otilde;es",
"cn" => "China",
"co" => "Col&ocirc;mbia",
"com" => "Comercial",
"coop" => "Coop",
"cr" => "Costa Rica",
"cs" => "S&eacute;rvia e Montenegro",
"cu" => "Cuba",
"cv" => "Cabo Verde",
"cx" => "Ilhas Natal",
"cy" => "Chipre",
"cz" => "Rep&uacute;blica Checa",
"de" => "Alemanha",
"dj" => "Djibuti",
"dk" => "Dinamarca",
"dm" => "Dominica",
"do" => "Rep&uacute;blica Dominicana",
"dz" => "Arg&eacute;lia",
"ec" => "Equador",
"edu" => "Educacional",
"ee" => "Est&oacute;nia",
"eg" => "Egipto",
"eh" => "Sahara Ocidental",
"er" => "Eritreia",
"es" => "Espanha",
"et" => "Eti&oacute;pia",
"eu" => "Uni&atilde;o Europeia",
"fi" => "Finl&acirc;ndia",
"fj" => "Fiji",
"fk" => "Ilhas Falkland",
"fm" => "Micron&eacute;sia",
"fo" => "Ilhas Faroe",
"fr" => "Fran&ccedil;a",
"ga" => "Gab&atilde;o",
"gb" => "Gr&atilde;-Bretanha",
"gd" => "Granada",
"ge" => "Georgia",
"gf" => "Guiana Francesa",
"gg" => "Guernsey",
"gh" => "Gana",
"gi" => "Gibraltar",
"gl" => "Gronel&acirc;ndia",
"gm" => "G&acirc;mbia",
"gn" => "Guin&eacute;",
"gov" => "Governo",
"gp" => "Guadalupe",
"gq" => "Guin&eacute; Equatorial",
"gr" => "Gr&eacute;cia",
"gs" => "Ilhas Sul Georgia e Ilhas Sul Sandwich",
"gt" => "Guatemala",
"gu" => "Guam",
"gw" => "Guin&eacute;-Bissau",
"gy" => "Guiana",
"hk" => "Hong Kong",
"hm" => "Ilhas Heard e Mc Donald",
"hn" => "Honduras",
"hr" => "Cro&aacute;cia",
"ht" => "Haiti",
"hu" => "Hungria",
"id" => "Indon&eacute;sia",
"ie" => "Irlanda",
"il" => "Israel",
"im" => "Ilha de Man",
"in" => "&Iacute;ndia",
"info" => "Informa&ccedil;&atilde;o",
"int" => "Organiza&ccedil;&otilde;es Internacionais",
"io" => "Territ&oacute;rio Brit&acirc;nico no Oceano &Iacute;ndico",
"iq" => "Iraque",
"ir" => "Ir&atilde;o",
"is" => "Isl&acirc;ndia",
"it" => "It&aacute;lia",
"je" => "Jersey",
"jm" => "Jamaica",
"jo" => "Jord&acirc;nia",
"jp" => "Jap&atilde;o",
"ke" => "Qu&eacute;nia",
"kg" => "Quirguiquist&atilde;o",
"kh" => "Cambodja",
"ki" => "Kiribati",
"km" => "Comoros",
"kn" => "Saint Kitts e Nevis",
"kp" => "Coreia do Norte",
"kr" => "Coreia do Sul",
"kw" => "Kuwait",
"ky" => "Ilhas Caimam",
"kz" => "Casaquist&atilde;o",
"la" => "Laos",
"lb" => "L&iacute;bano",
"lc" => "Santa L&uacute;cia",
"li" => "Liechtenstein",
"lk" => "Sri Lanka",
"lr" => "Lib&eacute;ria",
"ls" => "Lesoto",
"lt" => "Litu&acirc;nia",
"lu" => "Luxemburgo",
"lv" => "Let&oacute;nia",
"ly" => "L&iacute;bia",
"ma" => "Marrocos",
"mc" => "M&oacute;naco",
"md" => "Mold&aacute;via",
"me" => "Montenegro",
"mf" => "Saint-Martin",
"mg" => "Madag&aacute;scar",
"mh" => "Ilhas Marshall",
"mil" => "Militar dos EUA",
"mk" => "Maced&oacute;nia",
"ml" => "Mali",
"mm" => "Myanmar",
"mn" => "Mong&oacute;lia",
"mo" => "Macau",
"mp" => "Ilhas Mariana do Norte",
"mq" => "Martinica",
"mr" => "Mauritania",
"ms" => "Montserrat",
"mt" => "Malta",
"mu" => "Mauritania",
"museum" => "Museus",
"mv" => "Maldivas",
"mw" => "Malau&iacute;",
"mx" => "M&eacute;xico",
"my" => "Mal&aacute;sia",
"mz" => "Mo&ccedil;ambique",
"na" => "Nam&iacute;bia",
"name" => "Pessoal",
"nc" => "Nova Caled&oacute;nia",
"ne" => "N&iacute;ger",
"net" => "Redes",
"nf" => "Ilha Norfolk",
"ng" => "Nig&eacute;ria",
"ni" => "Nicar&aacute;gua",
"nl" => "Holanda",
"no" => "Noruega",
"np" => "Nepal",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Num&eacute;rico",
"nz" => "Nova Zel&acirc;ndia",
"om" => "Om&atilde;",
"org" => "Organiza&ccedil;&otilde;es",
"pa" => "Panam&aacute;",
"pe" => "Per&uacute;",
"pf" => "Polin&eacute;sia Francesa",
"pg" => "Papua Nova Guin&eacute;",
"ph" => "Filipinas",
"pk" => "Paquist&atilde;o",
"pl" => "Pol&oacute;nia",
"pm" => "St. Pierre e Miquelon",
"pn" => "Pitcairn",
"pr" => "Porto Rico",
"pro" => "Profissional",
"ps" => "Palestina",
"pt" => "Portugal",
"pw" => "Palau",
"py" => "Paraguai",
"qa" => "Qatar",
"re" => "Reuni&atilde;o",
"ro" => "Rom&eacute;nia",
"rs" => "Sérvia",
"ru" => "R&uacute;ssia",
"rw" => "Ruanda",
"sa" => "Ar&aacute;bia Saudita",
"sb" => "Ilhas Salom&atilde;o",
"sc" => "Seycheles",
"sd" => "Sud&atilde;o",
"se" => "Su&eacute;cia",
"sg" => "Singapura",
"sh" => "St. Helena",
"si" => "Eslov&ecirc;nia",
"sj" => "Ilhas Svalbard e Jan Mayen",
"sk" => "Eslov&aacute;quia",
"sl" => "Serra Leoa",
"sm" => "San Marino",
"sn" => "Senegal",
"so" => "Som&aacute;lia",
"sr" => "Suriname",
"st" => "S&atilde;o Tom&eacute; e Pr&iacute;ncipe",
"su" => "Uni&atilde;o Sovi&eacute;tica",
"sv" => "El Salvador",
"sy" => "S&iacute;ria",
"sz" => "Suazilandia",
"tc" => "Ilhas Turks e Caicos",
"td" => "Chade",
"tf" => "Territ&oacute;rio do Sul da Fran&ccedil;a",
"tg" => "Togo",
"th" => "Tail&acirc;ndia",
"tj" => "Tajiquist&atilde;o",
"tk" => "Tokelau",
"tl" => "Timor Leste",
"tm" => "Turcomenist&atilde;o",
"tn" => "Tun&iacute;sia",
"to" => "Tonga",
"tp" => "Timor Leste",
"tr" => "Turquia",
"tt" => "Trinidad e Tobago",
"tv" => "Tuvalu",
"tw" => "Taiwan",
"tz" => "Tanz&acirc;nia",
"ua" => "Ucr&acirc;nia",
"ug" => "Uganda",
"uk" => "Reino Unido",
"um" => "Ilhas menores dos EUA",
"unknown" => "Desconhecido",
"us" => "Estados Unidos",
"uy" => "Uruguai",
"uz" => "Uzbequist&atilde;o",
"va" => "Estado do Vaticano",
"vc" => "St. Vincent e Grenadines",
"ve" => "Venezuela",
"vg" => "Ilhas Virgens (UK)",
"vi" => "Ilhas Virgens (EUA)",
"vn" => "Vietname",
"vu" => "Vanuatu",
"wf" => "Ilhas Wallis e Futuna",
"ws" => "Samoa",
"ye" => "I&eacute;mene",
"yt" => "Mayotte",
"yu" => "S&eacute;rvia e Montenegro",
"za" => "&Aacute;frica do Sul",
"zm" => "Z&acirc;mbia",
"zr" => "Zaire",
"zw" => "Zimb&aacute;bue",
);

// The main Translation array
$translation = array(
// Specific charset
"global_charset" => "utf-8",

// Global translation
"global_titlebar"=> "Statistics for %SERVER generated on %DATE",
"global_bbclone_copyright" => "A equipa BBClone - Distribu&iacute;do sob a Licen&ccedil;a",
"global_last_reset" => "As estat&iacute;sticas foram reiniciadas em",
"global_yes" => "Sim",
"global_no" => "N&atilde;o",

// The error messages
"error_cannot_see_config" =>
"N&atilde;o &eacute; permitido ver a configura&ccedil;&atilde;o do BBClone neste servidor.",

// Date format (used with date())
"global_time_format" => "M jS, H:i:s",
"global_day_format" => "l F jS, Y",
"global_hours_format" => "l F jS, G:00",
"global_month_format" => "F Y",

// Miscellaneous translations
"misc_other" => "Outro",
"misc_unknown" => "Desconhecido",
"misc_second_unit" => "seg.",
"misc_ignored" => "Ignorado",

// The Navigation Bar
"navbar_main_site" => "S&iacute;tio Principal",
"navbar_configuration" => "Configura&ccedil;&atilde;o",
"navbar_global_stats" => "Estat&iacute;sticas Globais",
"navbar_detailed_stats" => "Estat&iacute;sticas Detalhadas",
"navbar_time_stats" => "Estat&iacute;sticas Cronol&oacute;gicas",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Data/Hora",
"dstat_visits" => "Visitas",
"dstat_extension" => "Extens&atilde;o",
"dstat_dns" => "Servi&ccedil;os de Acesso",
"dstat_from" => "Proveni&ecirc;ncia",
"dstat_os" => "Sistema Operativo",
"dstat_browser" => "Navegador",
"dstat_visible_rows" => "Acessos Vis&iacute;veis",
"dstat_green_rows" => "Linhas Verdes",
"dstat_blue_rows" => "Linhas Azuis",
"dstat_red_rows" => "Linhas Vermelhas",
"dstat_search" => "Busca",
"dstat_last_page" => "&Uacute;ltima P&aacute;gina",
"dstat_last_visit" => "&Uacute;ltima Visita",
"dstat_robots" => "Rob&ocirc;s",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "Sem dados dispon&iacute;veis",
"dstat_prx" => "Servidor de Proximidade",
"dstat_ip" => "Endere&ccedil;o IP",
"dstat_user_agent" => "Pormenores do Navegador Utilizado",
"dstat_nr" => "N&ordm;",
"dstat_pages" => "P&aacute;ginas",
"dstat_visit_length" => "Dura&ccedil;&atilde;o da Visita",
"dstat_reloads" => "Recargas",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words

"gstat_accesses" => "Acessos",
"gstat_total_visits" => "Total Visitas",
"gstat_total_unique" => "Total &Uacute;nicas",
"gstat_operating_systems" => "Sistemas Operativos: %d Mais",
"gstat_browsers" => "Navegadores: %d Mais",
"gstat_extensions" => "Extens&otilde;es: %d Mais",
"gstat_robots" => "Rob&ocirc;s: %d Mais",
"gstat_pages" => "P&aacute;ginas Visitadas: %d Mais",
"gstat_origins" => "Origens: %d Mais",
"gstat_hosts" => "Servi&ccedil;os de Acesso: %d Mais",
"gstat_keys" => "Palavras-chave: %d Mais",
"gstat_total" => "Total",
"gstat_not_specified" => "N&atilde;o especificado",

// Time stats words
"tstat_su" => "Dom",
"tstat_mo" => "Seg",
"tstat_tu" => "Ter",
"tstat_we" => "Qua",
"tstat_th" => "Qui",
"tstat_fr" => "Sex",
"tstat_sa" => "S&aacute;b",

"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "Jan",
"tstat_feb" => "Fev",
"tstat_mar" => "Mar",
"tstat_apr" => "Abr",
"tstat_may" => "Mai",
"tstat_jun" => "Jun",
"tstat_jul" => "Jul",
"tstat_aug" => "Ago",
"tstat_sep" => "Set",
"tstat_oct" => "Out",
"tstat_nov" => "Nov",
"tstat_dec" => "Dez",

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

"tstat_last_day" => "&Uacute;ltimo Dia",
"tstat_last_week" => "&Uacute;ltima Semana",
"tstat_last_month" => "&Uacute;ltimo M&ecirc;s",
"tstat_last_year" => "&Uacute;ltimo Ano",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences

"config_variable_name" => "Nome da Vari&aacute;vel",
"config_variable_value" => "Valor da Vari&aacute;vel",
"config_explanations" => "Explica&ccedil;&otilde;es",

"config_BBC_MAINSITE" =>
"Se esta vari&aacute;vel foi atribu&iacute;da, uma liga&ccedil;&atilde;o ao s&iacute;tio especificado ser&aacute; gerada. Por defeito, o valor aponta para o direct&oacute;rio principal. No caso de o seu s&iacute;tio estar alojado noutro local, ter&aacute; que ajustar o valor em conformidade.<br />
Exemplos:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"Por defeito o BBClone mostra o acesso &agrave;s prefer&ecirc;ncias das estat&iacute;sticas. No caso de desejar negar o acesso &agrave;s prefer&ecirc;ncias, desactive esta op&ccedil;&atilde;o.<br />
Exemplos:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"O t&iacute;tulo aparecendo dentro da barra de t&iacute;tulo presente em todas p&aacute;ginas do BBClone.<br />
Vari&aacute;veis reconhec&iacute;veis s&atilde;o:<br />
<ul>
<li>%SERVER: Nome do Servidor,</li>
<li>%DATE: A Data corrente.</li>
</ul>
Etiquetas HTML s&atilde;o tamb&eacute;m permitidas.<br />
Exemplos:<br />
\$BBC_TITLEBAR = &quot;Estat&iacute;sticas de %SERVER, geradas em %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;As minhas estat&iacute;sticas de %DATE s&atilde;o estas:&quot;;
<br />",

"config_BBC_LANGUAGE" =>
"O idioma a utilizar por defeito pelo BBClone, isto no caso de n&atilde;o ter sido especificado pelo browser.
Os seguintes idiomas est&atilde;o dispon&iacute;veis:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, it, ja, lt, mk, nb, nl, pl, pt-br, ro, ru, sk, sl, sv, tr, zh-cn e zh-tw</p>",

"config_BBC_MAXTIME" =>
"Esta vari&aacute;vel define a dura&ccedil;&atilde;o em segundos, de uma visita &uacute;nica. Cada solicita&ccedil;&atilde;o (hit) do visitante num deteminado per&iacute;odo de tempo ser&aacute; considerada como uma visita &uacute;nica, desde que duas solicita&ccedil;&otilde;es (hits) sucessivas n&atilde;o excedam o limite de tempo especificado. O valor por defeito &eacute; de 30 minutos (1800 segundos) que &eacute; o standard na internet, mas dependendo das suas necessidades, poder&aacute; atribuir um valor diferente.<br />
Exemplos:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Quantas entradas quer ver listadas nas estat&iacute;sticas detalhadas? Por defeito o valor &eacute; 100. &Eacute; recomend&aacute;vel um valor n&atilde;o superior a 500 por forma a evitar tempos de carregamento muito grandes.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"A vari&aacute;vel \$BBC_DETAILED_STAT_FIELDS determina quais as colunas a serem mostradas nas estat&iacute;sticas detalhadas. Valores poss&iacute;veis s&atilde;o:
<ul>
<li>id&nbsp;=&gt;&nbsp;O n&uacute;mero de ordem do visitante</li>
<li>time&nbsp;=&gt;&nbsp;A Data/Hora em que a &uacute;ltima solicita&ccedil;&atilde;o (hit) foi registada</li>
<li>visits&nbsp;=&gt;&nbsp;As solicita&ccedil;&otilde;es (hits) de um &uacute;nico visitante</li>
<li>dns&nbsp;=&gt;&nbsp;O nome do servi&ccedil;o de acesso do visitante</li>
<li>ip&nbsp;=&gt;&nbsp;O endere&ccedil;o IP do visitante</li>
<li>os&nbsp;=&gt;&nbsp;O Sistema Operativo (se dispon&iacute;vel e/ou sem rob&ocirc;)</li>
<li>browser&nbsp;=&gt;&nbsp;O navegador utilizado para estabelecer a liga&ccedil;&atilde;o
</li>
<li>ext&nbsp;=&gt;&nbsp;O Pa&iacute;s ou extens&atilde;o do visitante</li>
<li>referer&nbsp;=&gt;&nbsp;A proveni&ecirc;ncia do visitante (se dispon&iacute;vel)</li>
<li>page&nbsp;=&gt;&nbsp;A &uacute;ltima p&aacute;gina visitada</li>
<li>search&nbsp;=&gt;&nbsp;A Palavra-chave utilizada pelo visitante (se dispon&iacute;vel)</li>
</ul>
A ordem com que ordenar as colunas ser&aacute; usada na visualiza&ccedil;&atilde;o das mesmas.<br />
Exemplos:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"No caso de a hora do servidor n&atilde;o ser igual &agrave; sua hora, poder&aacute; ajust&aacute;-la com esta op&ccedil;&atilde;o (em minutos). Valores negativos atrasar&atilde;o e os positivos adiantar&atilde;o a hora.<br />
Exemplos:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Esta op&ccedil;&atilde;o define se os endere&ccedil;os de IP (num&eacute;ricos) devem ser ou n&atilde;o traduzidos pelos nomes dos servi&ccedil;os de acesso. Muito embora os nomes dos servi&ccedil;os de acesso digam bastante sobre o visitante, a sua obten&ccedil;&atilde;o pode diminuir consideravelmente a velocidade do seu s&iacute;tio, no caso dos servidores de DNS serem lentos, limitados na sua capacidade ou irregulares no seu servi&ccedil;o. Ajustando esta vari&aacute;vel poder&aacute; solucionar o problema.<br />
Exemplos:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"Por defeito o BBClone mostra as solicita&ccedil;&otilde;es (hits) nas estat&iacute;sticas cronol&oacute;gicas, porque assim se obtem uma muito &uacute;til ideia da utiliza&ccedil;&atilde;o do servidor. No entanto, se preferir ter as visitas &uacute;nicas como base para as suas estat&iacute;sticas cronol&oacute;gicas, poder&aacute; mudar o tipo de contagem atrav&eacute;s desta vari&aacute;vel.<br />
Exemplos:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Esta op&ccedil;&atilde;o pode ser usada para excluir da contagem um endere&ccedil;o de IP em particular ou grupos de endere&ccedil;os de IP. No caso de pretender adicionar diversas express&otilde;es, use uma v&iacute;rgula como separador.<br />
Exemplos:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"No caso de n&atilde;o querer considerar uma proveni&ecirc;ncia (referer) em particular, pode especificar uma ou mais palavras-chave por forma a bloquear a sua contagem. Se usar mais do uma palavra-chave, use v&iacute;rgulas como separador.<br />
Exemplos:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Use esta op&ccedil;&atilde;o para definir a forma como s&atilde;o tratados os dados referntes aos rob&ocirc;s. Por defeito, eles s&atilde;o ignorados nos servi&ccedil;os de acesso, mas s&atilde;o considerados nas restantes estat&iacute;sticas. Se de todo, n&atilde;o quiser ver dados referentes aos rob&ocirc;s, atribua a esta op&ccedil;&atilde;o o valor &quot;2&quot;, e apenas as visitas humanas ser&atilde;o tidas em conta.<br />
Exemplos:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"Esta op&ccedil;&atilde;o define a forma como o BBClone diferencia um visitante de outro. Por defeito, usa apenas o endere&ccedil;o de IP que, fornece dados realistas na maior parte dos casos. Por&eacute;m, se os seus visitantes usarem servidores de proximidade, a desactiva&ccedil;&atilde;o desta op&ccedil;&atilde;o fornecer&aacute; dados mais fidedignos, j&aacute; que ser&aacute; assumido um novo visitante quando se der uma mudan&ccedil;a nos pormenores do navegador utilizado.<br />
Exemplos:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Sempre que deseje reinicializar as suas estat&iacute;sticas, poder&aacute; activar esta op&ccedil;&atilde;o e na pr&oacute;xima visita elas ser&atilde;o apagadas. N&atilde;o se esque&ccedil;a por&eacute;m de desactivar esta op&ccedil;&atilde;o a seguir, caso contr&aacute;rio experimentar&aacute; um anormal baixo tr&acirc;fego ;).<br />
Exemplos:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Os servi&ccedil;os de acesso (host) e as proveni&ecirc;ncias (referer) podem gerar um enorme volume de dados, embora causados por visitantes &uacute;nicos. Se activar esta op&ccedil;&atilde;o poder&aacute; filtrar essas entradas e diminuir consideravelmente o ficheiro access.php no seu tamanho, sem afectar a tabela de servi&ccedil;os de acesso e proveni&ecirc;ncias. As solicita&ccedil;&otilde;es (hits) ser&atilde;o adicionadas &agrave;s entradas &quot;not_specified&quot; por forma a manter intacto o valor total.<br />
Exemplos:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
