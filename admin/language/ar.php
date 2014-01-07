<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: ar.php,v 1.22 2011/12/30 23:03:24 joku Exp $
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
 * Translated by: Dr. Wael (drwael@drwael.homeip.net)
 */

// The DNS Extensions array
$extensions = array(
"travel" => "Travel",
"asia" => "Asia-Pacific",
"jobs" => "Employment",
"mobi" => "Mobiles",
"cat" => "Catalan",
"tel" => "Contacts",

"ac" => "جزيرة أسينشين",
"ad" => "أندورا",
"ae" => "الإمارات العربية المتحدة",
"aero" => "طيراني",
"af" => "أفغانستان",
"ag" => "أنتيغوا وبربودا",
"ai" => "أنجويلا",
"al" => "ألبانيا",
"am" => "أرمينيا",
"an" => "جزر الأنتيل الهولندية",
"ao" => "أنجولا",
"aq" => "منطقة القطب الجنوبى",
"ar" => "الأرجنتين",
"arpa" => "Arpa",
"as" => "ساموا أمريكية",
"at" => "النمسا",
"au" => "أستراليا",
"aw" => "أروبا",
"ax" => "أولند",
"az" => "أزربيجان",
"ba" => "البوسنة و الهرسك",
"bb" => "بربادوس",
"bd" => "بنجلادش",
"be" => "بلجيكا",
"bf" => "بوركينا فاسو",
"bg" => "بلغاريا",
"bh" => "البحرين",
"bi" => "بوروندى",
"biz" => "عمل",
"bj" => "بنين",
"bl" => "سان_بارتليمي",
"bm" => "برمودا",
"bn" => "بروناى",
"bo" => "بوليفيا",
"br" => "البرازيل",
"bs" => "الباهاماس",
"bt" => "بوتان",
"bv" => "جزيرة بوفيه",
"bw" => "بتسوانا",
"by" => "بيلاروسيا",
"bz" => "بليز",
"ca" => "كندا",
"cc" => "جزر جوز الهند",
"cd" => "الكنغو",
"cf" => "جمهورية وسط افريقيا",
"cg" => "الكنغو",
"ch" => "سويسرا",
"ci" => "ساحل العاج",
"ck" => "جزر كوك",
"cl" => "شيلى",
"cm" => "الكاميرون",
"cn" => "الصين",
"co" => "كولمبيا",
"com" => "تجارى",
"coop" => "Coop",
"cr" => "كوستا ريكا",
"cs" => "صربيا و منتنجرو",
"cu" => "كوبا",
"cv" => "الرأس الأخضر",
"cx" => "جزيرة عيد الميلاد",
"cy" => "قبرص",
"cz" => "التشيك",
"de" => "ألمانيا",
"dj" => "جيبوتى",
"dk" => "الدانمارك",
"dm" => "دومينيكا",
"do" => "الجمهورية الدومينيكية",
"dz" => "الجزائر",
"ec" => "الإكوادور",
"edu" => "تعليمي",
"ee" => "أستونيا",
"eg" => "مصر",
"eh" => "الصحراء الغربية",
"er" => "إريتريا",
"es" => "أسبانيا",
"et" => "إثيوبيا",
"eu" => "الإتحاد الأوروبى",
"fi" => "فنلندا",
"fj" => "فيجى",
"fk" => "جزر فوكلاند",
"fm" => "مايكرونيزيا",
"fo" => "جزر فارو",
"fr" => "فرنسا",
"ga" => "الجابون",
"gb" => "المملكة المتحدة",
"gd" => "جرينادا",
"ge" => "جورجيا",
"gf" => "جوايانا الفرنسية",
"gg" => "جيرنزي",
"gh" => "غانا",
"gi" => "جبل طارق",
"gl" => "جرينلاند",
"gm" => "جامبيا",
"gn" => "غينيا",
"gov" => "حكومة الولايات المتحدة",
"gp" => "جوادلوب",
"gq" => "غينيا الاستوائية",
"gr" => "اليونان",
"gs" => "جورجيا الجنوبية وجزر ساندويتش الجنوبية",
"gt" => "جواتيمالا",
"gu" => "غوام",
"gw" => "غينيا-بيساو",
"gy" => "جوايانا",
"hk" => "هونج كونج",
"hm" => "Heard and Mc Donald Islands",
"hn" => "هندوراس",
"hr" => "كرواتيا",
"ht" => "هاييتى",
"hu" => "المجر",
"id" => "إندونيسيا",
"ie" => "أيرلندا",
"il" => "إسرائيل",
"im" => "Isle of Man",
"in" => "الهند",
"info" => "معلومات",
"int" => "منظمات دولية",
"io" => "إقليم المحيط الهندي البريطانى",
"iq" => "العراق",
"ir" => "إيران",
"is" => "آيسلاندة",
"it" => "إيطاليا",
"je" => "جيرسى",
"jm" => "جامايكا",
"jo" => "الأردن",
"jp" => "اليابان",
"ke" => "كينيا",
"kg" => "قيرغستان",
"kh" => "كمبودية",
"ki" => "كيريباتى",
"km" => "جزر القمر",
"kn" => "Saint Kitts and Nevis",
"kp" => "كوريا الشمالية",
"kr" => "كوريا",
"kw" => "الكويت",
"ky" => "جزر التمساح الأميركى",
"kz" => "كازاخستلن",
"la" => "لاوس",
"lb" => "لبنان",
"lc" => "سانت لوسيا",
"li" => "ليشتنشتاين",
"lk" => "سريلانكا",
"lr" => "ليبيريا",
"ls" => "ليسوتو",
"lt" => "لتوانيا",
"lu" => "لكسمبرج",
"lv" => "لاتفيا",
"ly" => "ليبيا",
"ma" => "المغرب",
"mc" => "موناكو",
"md" => "Moldova",
"me" => "الجبل الأسود",
"mf" => "سان مارتن الفرنسية",
"mg" => "مدغشقر",
"mh" => "جزر مارشال",
"mil" => "الجيش الأمريكى",
"mk" => "مقدونيا",
"ml" => "مالى",
"mm" => "ميانمار",
"mn" => "منغوليا",
"mo" => "مكاو",
"mp" => "جزر شمال ماريانا",
"mq" => "Martinique",
"mr" => "موريتانيا",
"ms" => "Montserrat",
"mt" => "مالطا",
"museum" => "متحف",
"mu" => "موريشيوس",
"mv" => "المالديف",
"mw" => "ملاوى",
"mx" => "المكسيك",
"my" => "ماليزيا",
"mz" => "موزمبيق",
"na" => "ناميبيا",
"name" => "شخصى",
"nc" => "New Caledonia",
"ne" => "النيجر",
"net" => "شبكة",
"nf" => "Norfolk Island",
"ng" => "نيجيريا",
"ni" => "نيكاراجوا",
"nl" => "هولندا",
"no" => "النرويج",
"np" => "نيبال",
"nr" => "ناورو",
"nu" => "Niue",
"numeric" => "رقمى",
"nz" => "نيوزيلاند",
"om" => "عمان",
"org" => "مؤسسة",
"pa" => "بنما",
"pe" => "بيرو",
"pf" => "French Polynesia",
"pg" => "Papua New Guinea",
"ph" => "الفلبين",
"pk" => "باكستان",
"pl" => "بولندا",
"pm" => "St. Pierre and Miquelon",
"pn" => "Pitcairn",
"pr" => "بورتوريكو",
"pro" => "محترف",
"ps" => "فلسطين",
"pt" => "البرتغال",
"pw" => "Palau",
"py" => "الباراجواى",
"qa" => "قطر",
"re" => "إجتماعى",
"ro" => "رومانيا",
"rs" => "صربيا",
"ru" => "روسيا",
"rw" => "رواندا",
"sa" => "المملكة العربية السعودية",
"sb" => "جزر سليمان",
"sc" => "سيشيل",
"sd" => "السودان",
"se" => "السويد",
"sg" => "سنغافورة",
"sh" => "سانت هيلينا",
"si" => "سلوفينيا",
"sj" => "Svalbard and Jan Mayen Islands",
"sk" => "سلوفاكيا",
"sl" => "سيراليون",
"sm" => "سان مارينو",
"sn" => "السنغال",
"so" => "الصومال",
"sr" => "سورينام",
"st" => "سان تومى وبرينسيبى",
"su" => "الإتحاد السوفيتى",
"sv" => "السلفادور",
"sy" => "سوريا",
"sz" => "سوازيلند",
"tc" => "Turks and Caicos Islands",
"td" => "تشاد",
"tf" => "الأقاليم الجنوبية الفرنسية",
"tg" => "توجو",
"th" => "تايلاند",
"tj" => "طاجكستان",
"tk" => "Tokelau",
"tl" => "تيمور الشرقية",
"tm" => "تركمانستان",
"tn" => "تونس",
"to" => "Tonga",
"tp" => "تيمور الشرقية",
"tr" => "تركيا",
"tt" => "ترينداد وتوباغو",
"tv" => "توفالو",
"tw" => "تايوان",
"tz" => "تنزانيا",
"ua" => "أوكرانيا",
"ug" => "أوغندا",
"uk" => "المملكة المتحدة",
"um" => "US Minor Outlying Islands",
"unknown" => "غير معروف",
"us" => "الولايات المتحدة الأمريكية",
"uy" => "الأورجواى",
"uz" => "أوزباكستان",
"va" => "الفاتيكان",
"vc" => "St. Vincent and the Grenadines",
"ve" => "فنزويلا",
"vg" => "(جزر فرجينيا (المملكة المتحدة",
"vi" => "(جزر فرجينيا (الولايات المتحدة",
"vn" => "فيتنام",
"vu" => "Vanuatu",
"wf" => "Wallis and Futuna Islands",
"ws" => "ساموا",
"ye" => "اليمن",
"yt" => "Mayotte",
"yu" => "صربيا و منتنجرو",
"za" => "جنوب أفريقيا",
"zm" => "زامبيا",
"zr" => "زائير",
"zw" => "زمبابوى",
);

// The main Translation array
$translation = array(

// Specific charset
"global_charset" => "utf-8",

// Date format (used with date())
"global_time_format" => "j. M, H:i:s",
"global_day_format" => "l j. F Y",
"global_hours_format" => "l j. F Y G:00",
"global_month_format" => "F Y",

// Global translation
"global_titlebar"=> "%DATE ولدت في %SERVER إحصاءات",
"global_bbclone_copyright" => "BBClone مرخص تحت شروط - فريق ال",
"global_last_reset" => "أخر مرة تم تصفير الإحصاءات",
"global_yes" => "نعم",
"global_no" => "لا",

// The error messages
"error_cannot_see_config" =>
".غير مسموح لك بمشاهدة الإعدادات على هذا الخادم",

// Miscellaneous translations
"misc_other" => "أخر",
"misc_unknown" => "غير معروف",
"misc_second_unit" => "ثانية",
"misc_ignored" => "تم تجاهله",

// The Navigation Bar
"navbar_main_site" => "الصفحة الرئيسية",
"navbar_configuration" => "الإعدادات",
"navbar_global_stats" => "ملخص الإحصاءات",
"navbar_detailed_stats" => "تفاصيل الإحصاءات",
"navbar_time_stats" => "الإحصاءات بالوقت",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "الهوية",
"dstat_time" => "الوقت",
"dstat_visits" => "الصفحات",
"dstat_extension" => "الدولة",
"dstat_dns" => "إسم المضيف",
"dstat_from" => "من",
"dstat_os" => "نظام التشغيل",
"dstat_browser" => "المتصفح",
"dstat_visible_rows" => "العدد المرئى",
"dstat_green_rows" => "الصفوف الخضراء",
"dstat_blue_rows" => "الصفوف الزرقاء",
"dstat_red_rows" => "الصفوف الحمراء",
"dstat_search" => "إبحث",
"dstat_last_page" => "أخر صفحة",
"dstat_last_visit" => "أخر زيارة",
"dstat_robots" => "روبوت",
"dstat_my_visit" => "من الزيارات الملكية الفكرية الخاصة بك",
"dstat_no_data" => "البيانات غير متوفرة",
"dstat_prx" => "خادم البروكسى",
"dstat_ip" => "IP عنوان ال",
"dstat_user_agent" => "عميل المستخدم",
"dstat_nr" => "العدد",
"dstat_pages" => "الصفحات",
"dstat_visit_length" => "مدة الزيارة",
"dstat_reloads" => "الإعادة",
"dstat_whois_information" => "بحث عن معلومات حول هذا العنوان الملكية الفكرية",

// Global stats words
"gstat_accesses" => "الصفحات التى تم تحميلها",
"gstat_total_visits" => "إجمالى الزيارات",
"gstat_total_unique" => "الإجمالى المتميز",
"gstat_operating_systems" => "نظم التشغيل ال %d الأوائل",
"gstat_browsers" => "المتصفحات ال %d الأوائل ",
"gstat_extensions" => "الدول ال %d الأوائل",
"gstat_robots" => "الروبوتات ال %d الأوائل",
"gstat_pages" => "الصفحات ال %d الأوائل",
"gstat_origins" => "الأصول ال %d الأوائل",
"gstat_hosts" => "المضيفون ال %d الأوائل",
"gstat_keys" => "الكلمات ال %d الأوائل",
"gstat_total" => "الإجمالى",
"gstat_not_specified" => "غير محدد",

// Time stats words
"tstat_su" => "الأحد",
"tstat_mo" => "الإثنين",
"tstat_tu" => "الثلاثاء",
"tstat_we" => "الأربعاء",
"tstat_th" => "الخميس",
"tstat_fr" => "الجمعة",
"tstat_sa" => "السبت",

"tstat_full_su" => "الأحد",
"tstat_full_mo" => "الاثنين",
"tstat_full_tu" => "الثلاثاء",
"tstat_full_we" => "الاربعاء",
"tstat_full_th" => "الخميس",
"tstat_full_fr" => "الجمعة",
"tstat_full_sa" => "السبت",

"tstat_jan" => "يناير",
"tstat_feb" => "فبراير",
"tstat_mar" => "مارس",
"tstat_apr" => "أبريل",
"tstat_may" => "مايو",
"tstat_jun" => "يونيو",
"tstat_jul" => "يوليو",
"tstat_aug" => "أغسطس",
"tstat_sep" => "سبتمبر",
"tstat_oct" => "أكتوبر",
"tstat_nov" => "نوفمبر",
"tstat_dec" => "ديسمبر",

"tstat_full_jan" => "يناير",
"tstat_full_feb" => "فبراير",
"tstat_full_mar" => "مارس",
"tstat_full_apr" => "أبريل",
"tstat_full_may" => "مايو",
"tstat_full_jun" => "يونيو",
"tstat_full_jul" => "يوليو",
"tstat_full_aug" => "أغسطس",
"tstat_full_sep" => "سبتمبر",
"tstat_full_oct" => "أكتوبر",
"tstat_full_nov" => "نوفمبر",
"tstat_full_dec" => "ديسمبر",

"tstat_last_day" => "اليوم الأخير",
"tstat_last_week" => "الأسبوع الأخير",
"tstat_last_month" => "الشهر الأخير",
"tstat_last_year" => "العام الأخير",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "ولدت في الصفحة",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "إسم المتغير",
"config_variable_value" => "قيمة المتغير",
"config_explanations" => "الشرح",

"config_BBC_MAINSITE" =>
"إذا تم ضبط هذا المتغير, سيتم إنشاء وصلة للموقع المحدد. القيمة الأصلية تشير إلى المجلد الأساسى.
فى حالة إذا كان موقعك فى مكان مختلف, فغالبا ستريد ضبط هذا المتغير ليلائم إحتياجاتك<br />
:الأمثلة<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
" هو إظهار الإعدادات, فى حالة عدم رغبتك فى ذلك BBClone الإعداد الأصلى ل<br />
يمكنك أن تمنع الوصول إليها عبر عدم تفعيل هذا الخيار<br />
:الأمثلة<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"عنوان صفحات الإحصاءات, سيتم إظهاره فى جميع صفحات الموقع.<br />
:يمكنه التعرف على الماكرو الأتية BBClone<br />
<ul>
<li>%SERVER: إسم الخادم,</li>
<li>%DATE: الوقت الحالى.</li>
</ul>
HTML Tags مسموح باستخدام.<br />
:الأمثلة<br />
\$BBC_TITLEBAR = &quot;Statistics for %SERVER generated the %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;My stats from %DATE look like this:&quot;;
<br />",

"config_BBC_LANGUAGE" =>
":ذلك إذا لم يتعرف المتصفح عليها, اللغات المدعومة هى كالأتى BBClone اللغة الأصلية ل
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, ua, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"هذا المتغير يحدد طول الزيارة بالثانية
إذا دخل الزائر فى خلال هذه الفترة, فإنها تحسب مرة واحدة
الرقم الأصلى هو 30 دقيقة (1800 ثانية), لكن طبقا لاحتياجاتك يمكنك تغيير القيمة.<br />
:الأمثلة<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
",100 كم قيمة تريد رؤيتها فى تفاصيل الإحصاءات؟ القيمة الأصلية<br />
.لا ينصح بإدخال قيمة أكثر من 500 لتجنب البطئ",

"config_BBC_DETAILED_STAT_FIELDS" =>
":هذا المتغير يحدد الأعمدة التى يمكن رؤيتها فى الإحصاءات التفصيلية, الأعمدة الممكنة هى
<ul>
<li>الهوية&nbsp;=&gt;&nbsp;رقم الزائر منذ بدأت العد</li>
<li>الوقت&nbsp;=&gt;&nbsp;هو وقت أخر مرة دخل فيها الزائر الصفحة</li>
<li>الزيارات&nbsp;=&gt;&nbsp;عدد الزيارات لزائر واحد بعينه</li>
<li>dns&nbsp;=&gt;&nbsp;إسم مضيف الزائر</li>
<li>ip&nbsp;=&gt;&nbsp;رقم الإنترنت بروتوكول للزائر</li>
<li>نظام التشغيل&nbsp;=&gt;&nbsp;نظام التشغيل إذا كان متوفرا و\أو ليس روبوت</li>
<li>المتصفح&nbsp;=&gt;&nbsp;البرنامج المستخدم لإجراء الإتصال
</li>
<li>الدولة&nbsp;=&gt;&nbsp;دولة الزائر أو إمتداده</li>
<li>من&nbsp;=&gt;&nbsp;الوصلة التى أتى منها الزائر إذا كان قد أتى من وصلة
</li>
<li>الصفحة&nbsp;=&gt;&nbsp;أخر صفحة تم زيارتها</li>
<li>البحث&nbsp;=&gt;&nbsp;تبين كيفية بحث الزائر عن الموقع إذا توفرت</li>
</ul>
.ستشاهد الموقع بنفس الترتيب الذى رتبته<br />
:الأمثلة<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"فى حالة إذا لم يطابق توقيت الخادم توقيتك المحلى, يمكنك ضبط الوقت بالدقائق باستخدام<br /> هذا الأمر, القيمة السالبة ترجع الوقت, و الموجبة تقدمه<br />
:الأمثلة<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"هذا الخيار يحدد إذا ما كانت الإنترنت بروتوكول ستتحول إلى أسماء مضيفى الزائرين أم لا, فى حين أن هذه الأسماء تعطيك معلومات أكثر عن الزائر, إلا أنها قد تجعل موقعك بطىء, إذا كان إسمك المضيف بطىء أو غير معتمد عليه, فمن الأفضل أن تفكر فى هذا الخيار<br />
:الأمثلة<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"الإعداد الأصلى للبرنامج هو إظهار إجمالى الزيارات فى إحصاءات الوقت, إذا أحببت أن تظهر الزيارات المتميزة كأساس للعد, يمكنك تعديل ذلك عبر هذا المتغير<br />
:الأمثلة<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"هذا الخيار يجعلك تتجاهل الإنترنت بروتوكول الذى تريد تجاهله من العد, إذا أردت تجاهل أكثر من رقم يمكنك إستخدام (فصلة) كما هو مبين<br />
:الأمثلة<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"فى حالة إذا أردت تجاهل بعض المصادر التى يأتى منها الزوار إلى موقعك من إحصاءاتك, يمكنك إختيار بعض الكلمات لمنعهم من الظهور فى الإحصاءات التفصيلية, إستخدم (فصلة) بين الكلمات<br />
:الأمثلة<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"يمكنك هنا تحديد معاملة الروبوتات, الإعداد الأصلى هو تجاهلهم من ترتيب الأوائل و لكن تركهم يظهرون فى باقى الإحصاءات, إا أردت عدم مشاهدة أى روبوت يمكنك وضع الرقم 2 عندها لن ترى إلا زيارات البشر<br />
:الأمثلة<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"يحدد هذا الخيار طريقة معرفة البرنامج بالزائرين, الإعداد الأصلى هو معرفتهم عن طريق عنوان الإنترنت بروتوكول, و هو إعداد واقعى فى أغلب الأحيان, لكن إذا كان عادة زائريك مختفين وراء خادم بروكسى, فيمكنك عدم تفعيل هذا الخيار, و عندها ستكون الإحصاءات أكثر واقعية<br />
.لأن الزائر سيتم التعامل معه منذ وقت أن تغير عميله<br />
:الأمثلة<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"فى أى وقت تريد تصفير الإحصاءات يمكنك تفعيل هذا الخيار, عندها سيتم محو الإحصاءات مع الزيارة التالية, لا تنسى أن تعيده إلى ما كان عليه مرة أخرى, و إلا فلن ترى أى زائر فى موقعك<br />
:الأمثلة<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
",المضيفون و الأوصول قد يولدون الكثير من البيانات حتى إذا كانت من زائر واحد<br />
access.phpبتفعيلك لهذا الخيار تستطيع محوهم و بذلك تصغير حجم<br />
و ذلك لن يؤثر على ما تراه من تصنيفهم, عدد الزيارات سيضاف<br />
للمحافظة على النتيجة النهائية &quot;not_specified&quot; إلى البيانات تحت اسم<br />
:الأمثلة<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
