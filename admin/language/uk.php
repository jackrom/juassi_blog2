<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: uk.php,v 1.55 2011/12/30 23:03:24 joku Exp $
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
 * Translated by: Taras Pavliv taras@pavliv.com
 * Updated by: Lёppa lacontacts@ukrpost.net, http://www.leppsville.co.nr
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
"ad" => "Андора",
"ae" => "ОАЕ",
"aero" => "Aero",
"af" => "Афганістан",
"ag" => "Антигуа і Барбуда",
"ai" => "Антикіла",
"al" => "Албанія",
"am" => "Вірменія",
"an" => "Ндіерланди",
"ao" => "Ангола",
"aq" => "Антарктида",
"ar" => "Аргентина",
"arpa" => "Помилки",
"as" => "Американські Самоа",
"at" => "Австрія",
"au" => "Австралія",
"aw" => "Аруба",
"ax" => "Аландські острови",
"az" => "Азербайджан",
"ba" => "Боснія і Герцеговина",
"bb" => "Барбадос",
"bd" => "Бангладеш",
"be" => "Бельгія",
"bf" => "Буркіна Фасо",
"bg" => "Болгарія",
"bh" => "Бахрейн",
"bi" => "Бурунді",
"biz" => "Комерційні організації",
"bj" => "Бенін",
"bl" => "Сен-Бартельмі",
"bm" => "Бермуди",
"bn" => "Бруней",
"bo" => "Болівія",
"br" => "Бразилія",
"bs" => "Багамскі Острови",
"bt" => "Бутан",
"bv" => "Bouvet Island",
"bw" => "Ботсвана",
"by" => "Біларусь",
"bz" => "Беліз",
"ca" => "Канада",
"cc" => "Кокосові Острови",
"cd" => "Конго",
"cf" => "ЦАР",
"cg" => "Конго",
"ch" => "Швейцарія",
"ci" => "Ivory Coast",
"ck" => "Острови Кука",
"cl" => "Чилі",
"cm" => "Камерун",
"cn" => "Китай",
"co" => "Колумбія",
"com" => "Комерційні",
"coop" => "Coop",
"cr" => "Коста Ріка",
"cs" => "Serbia and Montenegro",
"cu" => "Куба",
"cv" => "Капе Верде",
"cx" => "Різдвяні Острови",
"cy" => "Кіпр",
"cz" => "Чеська республіка",
"de" => "Німеччина",
"dj" => "Джибуті",
"dk" => "Данія",
"dm" => "Домініка",
"do" => "Домініканська Республіка",
"dz" => "Алжир",
"ec" => "Еквадор",
"edu" => "Освітні",
"ee" => "Естонія",
"eg" => "Єгипет",
"eh" => "Western Sahara",
"er" => "Еритрея",
"es" => "Іспанія",
"et" => "Ефиіпія",
"eu" => "Європейський союз",
"fi" => "Фінляндія",
"fj" => "Фіджі",
"fk" => "Фолклендські Острови",
"fm" => "Мікронезія",
"fo" => "Острови Фарое",
"fr" => "Франція",
"ga" => "Габон",
"gb" => "Об'єднане Королівство",
"gd" => "Гренада",
"ge" => "Грузія",
"gf" => "Французька Гвіана",
"gg" => "Гуернесі",
"gh" => "Гана",
"gi" => "Гібралтар",
"gl" => "Гренландія",
"gm" => "Гамбія",
"gn" => "Гвінея",
"gov" => "Урядові",
"gp" => "Гваделупа",
"gq" => "Екваторіальна Гвінея",
"gr" => "Греція",
"gs" => "South Georgia and the South Sandwich Islands",
"gt" => "Гватемала",
"gu" => "Гуам",
"gw" => "Гвінея-Бісау",
"gy" => "Гайана",
"hk" => "Гонконг",
"hm" => "Heard and Mc Donald Islands",
"hn" => "Гондурас",
"hr" => "Хорватія",
"ht" => "Гаїті",
"hu" => "Угорщина",
"id" => "Індонезія",
"ie" => "Ирландія",
"il" => "Ізраїль",
"im" => "Isle of Man",
"in" => "Індія",
"info" => "Інформаційні",
"int" => "Міжнародна",
"io" => "Британська територія Індії",
"iq" => "Ірак",
"ir" => "Іран",
"is" => "Ісландія",
"it" => "Італія",
"je" => "Джерсі",
"jm" => "Ямайка",
"jo" => "Йорданія",
"jp" => "Японія",
"ke" => "Кенія",
"kg" => "Киргизстан",
"kh" => "Камбоджа",
"ki" => "Кирибаті",
"km" => "Коморскі Острови",
"kn" => "Saint Kitts and Nevis",
"kp" => "North Korea",
"kr" => "Корея",
"kw" => "Кувейт",
"ky" => "Кайманові Острови",
"kz" => "Казахстан",
"la" => "Лаос",
"lb" => "Ліван",
"lc" => "Свята Лючія",
"li" => "Ліхтенштейн",
"lk" => "Шрі Ланка",
"lr" => "Либерія",
"ls" => "Лесото",
"lt" => "Литва",
"lu" => "Люксембург",
"lv" => "Латвія",
"ly" => "Лівія",
"ma" => "Мароко",
"mc" => "Монако",
"md" => "Молдова",
"me" => "Чорногорія",
"mf" => "Saint Martin",
"mg" => "Мадагаскар",
"mh" => "Маршаллові Острови",
"mil" => "США військові",
"mk" => "Македонія",
"ml" => "Малі",
"mm" => "Миянмар",
"mn" => "Монголія",
"mo" => "Макау",
"mp" => "Північні острови Маріана",
"mq" => "Мартіника",
"mr" => "Мавританія",
"ms" => "Монтсерат",
"mt" => "Мальта",
"mu" => "Маврикій",
"museum" => "Museum",
"mv" => "Мальдиви",
"mw" => "Малаві",
"mx" => "Мексика",
"my" => "Малайзія",
"mz" => "Мозамбік",
"na" => "Намібія",
"name" => "Personal",
"nc" => "Нова Каледонія",
"ne" => "Нігер",
"net" => "Networks",
"nf" => "Норфолкові Острови",
"ng" => "Нігерія",
"ni" => "Нікарагуа",
"nl" => "Нідерланди",
"no" => "Норвегія",
"np" => "Непал",
"nr" => "Науру",
"nu" => "Niue",
"numeric" => "Числовий IP",
"nz" => "Новая Зеландія",
"om" => "Оман",
"org" => "Некомерційні організації",
"pa" => "Панама",
"pe" => "Перу",
"pf" => "Французька Полінезія",
"pg" => "Папуа Нова Гвінея",
"ph" => "Філіппіни",
"pk" => "Пакистан",
"pl" => "Польща",
"pm" => "St. Pierre and Miquelon",
"pn" => "Піктаірн",
"pr" => "Пуерто Ріко",
"pro" => "Professional",
"ps" => "Palestina",
"pt" => "Португалія",
"pw" => "Палау",
"py" => "Парагвай",
"qa" => "Катар",
"re" => "Reunion",
"ro" => "Румунія",
"rs" => "Сербія",
"ru" => "Росія",
"rw" => "Руанда",
"sa" => "Саудівска Аравія",
"sb" => "Соломонові Острови",
"sc" => "Сейшельскі Острови",
"sd" => "Судан",
"se" => "Швеція",
"sg" => "Сингапур",
"sh" => "St. Helena",
"si" => "Словенія",
"sj" => "Svalbard and Jan Mayen Islands",
"sk" => "Словакія",
"sl" => "Сьера Леоне",
"sm" => "Сан Маріно",
"sn" => "Сенегал",
"so" => "Сомалі",
"sr" => "Сурінам",
"st" => "Сан Томе і Принципе",
"su" => "СРСР",
"sv" => "Сальвадор",
"sy" => "Сирія",
"sz" => "Свазіленд",
"tc" => "Turks and Caicos Islands",
"td" => "Чад",
"tf" => "French Southern Territories",
"tg" => "Того",
"th" => "Тайланд",
"tj" => "Таджикістан",
"tk" => "Токелау",
"tl" => "Східний Тимор",
"tm" => "Туркменістан",
"tn" => "Туніс",
"to" => "Тонга",
"tp" => "Східний Тимор",
"tr" => "Туреччина",
"tt" => "Тринідад и Тобаго",
"tv" => "Тувалу",
"tw" => "Тайвань",
"tz" => "Танзанія",
"ua" => "Україна",
"ug" => "Уганда",
"uk" => "Англія",
"um" => "US Minor Outlying Islands",
"unknown" => "Невідома",
"us" => "США",
"uy" => "Уругвай",
"uz" => "Узбекістан",
"va" => "Ватикан",
"vc" => "St. Vincent and the Grenadines",
"ve" => "Венесуела",
"vg" => "Вірджінські Острови",
"vi" => "Віргінські Острови",
"vn" => "В'єтнам",
"vu" => "Вануату",
"wf" => "Wallis and Futuna Islands",
"ws" => "Самоа",
"ye" => "Йемен",
"yt" => "Mayotte",
"yu" => "Serbia and Montenegro",
"za" => "ПАР",
"zm" => "Замбія",
"zr" => "Заїр",
"zw" => "Зімбабве",
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
"global_bbclone_copyright" => "Команда BBClone - Ліцензія ",
"global_last_reset" => "Останній скид статистики",
"global_yes" => "Так",
"global_no" => "Ні",

// The error messages
"error_cannot_see_config" =>
"Перегляд налаштувань BBClone недоступний.",

// Miscellaneous translations
"misc_other" => "Інший",
"misc_unknown" => "Невідомий",
"misc_second_unit" => "сек.",
"misc_ignored" => "Проігноровано",

// The Navigation Bar
"navbar_main_site" => "Головний сайт",
"navbar_configuration" => "Конфігурація",
"navbar_global_stats" => "Загальна статистика",
"navbar_detailed_stats" => "Детальна статистика",
"navbar_time_stats" => "Статистика за часом",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Час",
"dstat_visits" => "К-сть",
"dstat_extension" => "Зона",
"dstat_dns" => "Адреса відвідувача",
"dstat_from" => "За посиланням",
"dstat_os" => "ОС",
"dstat_browser" => "Браузер",
"dstat_visible_rows" => "Останніх відвідувань",
"dstat_green_rows" => "зелені рядки",
"dstat_blue_rows" => "сині рядки",
"dstat_red_rows" => "червоні рядки",
"dstat_search" => "Пошук",
"dstat_last_page" => "Остання сторінка",
"dstat_last_visit" => "останнє відвідування",
"dstat_robots" => "роботи",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "Дані недоступні",
"dstat_prx" => "Проксі-сервер",
"dstat_ip" => "IP адреса",
"dstat_user_agent" => "User Agent",
"dstat_nr" => "№",
"dstat_pages" => "Сторінок",
"dstat_visit_length" => "Час відвідування",
"dstat_reloads" => "Перезавантажень сторінки",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Відвідувачі",
"gstat_total_visits" => "Всього відвідувачів",
"gstat_total_unique" => "Всього унікальних",
"gstat_operating_systems" => "Рейтинг %d ОС",
"gstat_browsers" => "Рейтинг %d браузерів",
"gstat_extensions" => "Рейтинг %d доменів першого рівня",
"gstat_robots" => "Рейтинг %d роботів",
"gstat_pages" => "Рейтинг %d відвіданих сторінок",
"gstat_origins" => "Рейтинг %d джерел",
"gstat_hosts" => "Рейтинг %d хостів",
"gstat_keys" => "Рейтинг %d ключових слів",
"gstat_total" => "Всього",
"gstat_not_specified" => "Не визначено",

// Time stats words
"tstat_su" => "Нд",
"tstat_mo" => "Пн",
"tstat_tu" => "Вт",
"tstat_we" => "Ср",
"tstat_th" => "Чт",
"tstat_fr" => "Пт",
"tstat_sa" => "Сб",

"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "Січ",
"tstat_feb" => "Лют",
"tstat_mar" => "Бер",
"tstat_apr" => "Кві",
"tstat_may" => "Тра",
"tstat_jun" => "Чер",
"tstat_jul" => "Лип",
"tstat_aug" => "Сер",
"tstat_sep" => "Вер",
"tstat_oct" => "Жов",
"tstat_nov" => "Лис",
"tstat_dec" => "Гру",

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

"tstat_last_day" => "Сьогодні",
"tstat_last_week" => "На цьому тижні",
"tstat_last_month" => "В цьому місяці",
"tstat_last_year" => "В цьому році (помісячно)",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "Ім'я змінної",
"config_variable_value" => "Значення змінної",
"config_explanations" => "Поясненння",

"config_BBC_MAINSITE" =>
"Якщо ця змінна встановлена, то буде створене посилання на вказане місце. Значення
за замовчуванням вказує на батьківську директорію. У тому випадку, якщо Ваш сайт
розміщено в іншому місці, Ви, скоріш за все, захочете замінити значення змінної на
таке, що задовольняє Ваші потреби.<br />
Приклади:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"За замовчуванням BBClone дозволяє перегляд параметрів сбору та перегляду статистики.
У тому випадку, якщо така поведінка Вас не влаштовує, Ви можете заборонити перегляд
параметрів, деактивувавши цю опцію.<br />
Приклади:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Заголовок, котрий буде відображатись в навігаційній полосі всіх сторінок BBClone.<br />
Прийняті такі макроси:<br />
<ul>
<li>%SERVER:&nbsp; ім'я сервера,</li>
<li>%DATE: поточна дата.</li>
</ul>
Теги HTML також доступні.<br />
Приклади:<br />
\$BBC_TITLEBAR = &quot;Statistics for %SERVER generated the %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;My stats from %DATE look like this:&quot;;
<br />",

"config_BBC_LANGUAGE" =>
"Мова BBClone's за замовчуванням, у тому випадку, якщо вона не була вказана браузером.
Підтримуються наступні мови:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, uk, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"Ця змінна визначає тривалість унікального відвідування у секундах. Кожний хіт
від того ж самого відвідувача напротязі цього періоду буде розглядатися як одне
відвідування то тих пір, поки пауза між двома послідовними хітами не перевищить
вказаний час. За замовчуванням встановлено стандарт de facto для web, що
становить 30 хвилин (1800 секунд), але, в залежності від Ваших потреб, Ви можете
забажати встановити інше значення.<br />
Приклади:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Кількість записів, яку Ви бажаєте бачити у детальній статистиці. За замовчуванням
- 100. Не рекоммендується встановлюватии це значення більшим за 500, щоб уникнути
надмірного навантаження.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"Змінна \$BBC_DETAILED_STAT_FIELDS визначає, які стовпчики мають бути відображені у
детальній статистиці. Можливі наступні колонки:
<ul>
<li>id&nbsp;=&gt;&nbsp;Відвідувач № X з моменту початку ведення статистики</li>
<li>time&nbsp;=&gt;&nbsp;Час реєстраії останнього хіта</li>
<li>visits&nbsp;=&gt;&nbsp;Хіти унікального відвідувача</li>
<li>dns&nbsp;=&gt;&nbsp;Хост відвідувача</li>
<li>ip&nbsp;=&gt;&nbsp;IP адреса відвідувача</li>
<li>os&nbsp;=&gt;&nbsp;Операційна система (якщо доступно та/або робот)</li>
<li>browser&nbsp;=&gt;&nbsp;Програмне забезпеченя, що використовується для встановлення зв'язку</li>
<li>ext&nbsp;=&gt;&nbsp;Країна відвідувача або кореневе доменне ім'я</li>
<li>referer&nbsp;=&gt;&nbsp;Посилання, з якого прийшов користувач (якщо доступно)</li>
<li>page&nbsp;=&gt;&nbsp;Остання відвідана сторінка</li>
<li>search&nbsp;=&gt;&nbsp;Пошуковий запит, що використовував користувач (якщо доступно)</li>
</ul>
Стовпчики будуть відображатися у тому порядку, в якому Ви вкажете їх назви.<br />
Приклади:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"У тому випадку, якщо час серверу не співпадає з Вашим локальним часом, Ви можете погодити
час за допомогою цієї опції. Від'ємні значення переведуть час назад, додатні - вперед.
Різниця часу встановлюється у хвилинах.<br />
Приклади:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Ця опція визначає, потрібно чи ні перетворювати IP адреси у хости (resolving). Хоча хости і дають більше
інформації про відвідувачів, перетворення може значно сповільнити Ваш сайт у випадку, якщо
DNS сервер, що використовується, надто повільний, обмежений у можливостях або не є надійним
за іншими підставами. Встановлення значення цієї змінної може вирішити проблему.<br />
Приклади:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"За замовчуванням BBClone показує хіти у статистиці за часом, оскільки це дає корисне враження
про фактичне завантаження сервера. Однак, якщо Ви віддаєте перевагу підрахункам за унікальними
відвідувачами, Ви можете змінити спосіб підрахунку, встановивши цю змінну.<br />
Приклади:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Ця опція може бути використана для виключення окремих IP адрес або їх діапазонів з підрахунків.
Якщо Ви хочете додати декілька виразів, то викоритсовуйте кому для їх розділення.<br />
Приклади:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"У тому випадку, якщо Ви не хочете щоб окремі сторінки, з яких прийшли Ваші користувачі (referrers), відображалися
у ретингу або детальній статистиці, Ви можете вказати одне або декілька ключових слів, за якими будуть
блокуватися сторінки, що посилаються. Якщо Ви хочете вказати декілька ключових слів - розділяйте їх
комою.<br />
Приклади:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Ви можете використовувати цю опцію, щоб визначити обробку роботів. За замовчуванням роботи ігноруються
у рейтингу хостів але враховуються у всій іншій статистиці. Якщо Ви не хочете бачити роботів зовсім, ви можете
встановити в цю опцію &quot;2&quot;, тоді враховуватись будуть тільки відвідування людей.<br />
Приклади:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"Ця опція встановлює, як BBClone відрізняє одного відвідувача від іншого. За замовчуванням використовується
тільки IP адреса, що забезпечує реалістичну картину у більшості випадків. Проте, якщо Ваші відвідувачі
часто заховані за проксі-серверами, деактивація цієї опції забезпечить кращу картину, так як кожна
зміна user agent буде вважатися появою нового відвідувача.<br />
Приклади:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Щоразу, як Ви забажаєте скинути усі статистичні дані, Ви можете активувати цю опцію і, під час наступного
відвідування, вона буде очищена. Не забудьте деактивувати її після цього, інакше Ви відчуєте незвично низький
трафік ;).<br />
Приклади:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Статистика хостів та сторінок, що посилаються, може генерувати велику кількість даних, причиною яких,
зачасту, є відвідувачі, що відвідали сайт один раз (one time visitors). Активуючи цю опцію Ви можете
очистити ці записи і значно скоротити розмір access.php без впливу на поточну статистику за хостами та
сторінками, що посилаються. Кількість хітів буде додаватися до запису &quot;not_specified&quot; для
збереження цілістності загальних підрахунків.
Приклади:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
