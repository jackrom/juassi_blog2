<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: ja.php,v 1.60 2011/12/30 23:03:24 joku Exp $
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
 * Modified by mugen 2004.11.12 (mugen@guitar.jp)
 */

// The DNS Extensions array
$extensions = array(
"travel" => "Travel",
"asia" => "Asia-Pacific",
"jobs" => "Employment",
"mobi" => "Mobiles",
"cat" => "Catalan",
"tel" => "Contacts",
"museum" => "博物館",
"aero" => "Aviation",
"coop" => "Cooperative",
"pro" => "Professionals",

"ac" => "アセンション島",
"ad" => "アンドラ",
"ae" => "アラブ首長国連邦",
"af" => "アフガニスタン",
"ag" => "アンティグア・バーブーダ",
"ai" => "アンギラ",
"al" => "アルバニア",
"am" => "アルメニア",
"an" => "オランダ領アンティール",
"ao" => "アンゴラ",
"aq" => "南極大陸",
"ar" => "アルゼンチン",
"arpa" => "米国防総省高等研究計画局",
"as" => "アメリカ領サモア",
"at" => "オーストリア",
"au" => "オーストラリア",
"aw" => "アルバ",
"ax" => "オーランド諸島",
"az" => "アゼルバイジャン",
"ba" => "ボスニア・ヘルツェゴビナ",
"bb" => "バルバドス",
"bd" => "バングラディシュ",
"be" => "ベルギー",
"bf" => "ブルキナファソ",
"bg" => "ブルガリア",
"bh" => "バーレーン",
"bi" => "ブルンジ",
"biz" => "ビジネス",
"bj" => "ベナン",
"bl" => "サン・バルテルミー島",
"bm" => "バミューダ諸島",
"bn" => "ブルネイ王国",
"bo" => "ボリビア",
"br" => "ブラジル",
"bs" => "バハマ",
"bt" => "ブータン",
"bv" => "ブーヴェ島",
"bw" => "ボツワナ",
"by" => "ベラルーシ",
"bz" => "ベリーズ",
"ca" => "カナダ",
"cc" => "ココス（キーリング）諸島",
"cd" => "ザイール共和国",
"cf" => "中央アフリカ共和国",
"cg" => "コンゴ",
"ch" => "スイス",
"ci" => "コートジボアール",
"ck" => "クック諸島",
"cl" => "チリ",
"cm" => "カメルーン",
"cn" => "中国",
"co" => "コロンビア",
"com" => "企業",
"cr" => "コスタリカ",
"cs" => "セルビア・モンテネグロ",
"cu" => "キューバ",
"cv" => "カーボベルデ",
"cx" => "クリスマス島",
"cy" => "キプロス",
"cz" => "チェコ",
"de" => "ドイツ",
"dj" => "ジブチ共和国",
"dk" => "デンマーク",
"dm" => "ドミニカ",
"do" => "ドミニカ共和国",
"dz" => "アルジェリア",
"ec" => "エクアドル",
"edu" => "教育機関",
"ee" => "エストニア",
"eg" => "エジプト",
"eh" => "西サハラ",
"er" => "エリトリア",
"es" => "スペイン",
"et" => "エチオピア",
"eu" => "欧州連合",
"fi" => "フィンランド",
"fj" => "フィジー",
"fk" => "フォークランド諸島",
"fm" => "ミクロネシア連邦",
"fo" => "フェロー諸島",
"fr" => "フランス",
"ga" => "ガボン",
"gb" => "イギリス",
"gd" => "グレナダ",
"ge" => "グルジア",
"gf" => "フランス領ガイアナ",
"gg" => "ガーンジー島",
"gh" => "ガーナ",
"gi" => "ジブラルタル",
"gl" => "グリーンランド",
"gm" => "ガンビア",
"gn" => "ギニア",
"gov" => "米国政府",
"gp" => "グアドループ島",
"gq" => "赤道ギニア",
"gr" => "ギリシャ",
"gs" => "南ジョージア・南サンドイッチ諸島",
"gt" => "グアテマラ共和国",
"gu" => "グアム島",
"gw" => "ギニアビサウ",
"gy" => "ガイアナ",
"hk" => "香港",
"hm" => "ハード・マクドナルド諸島",
"hn" => "ホンジュラス",
"hr" => "クロアチア",
"ht" => "ハイチ",
"hu" => "ハンガリー",
"id" => "インドネシア",
"ie" => "アイルランド",
"il" => "イスラエル",
"im" => "マン島",
"in" => "インド",
"info" => "インフォメーション",
"int" => "国際機関",
"io" => "イギリス領インド洋地域",
"iq" => "イラク",
"ir" => "イラン",
"is" => "アイスランド",
"it" => "イタリア",
"je" => "ジャージー島",
"jm" => "ジャマイカ",
"jo" => "ヨルダン",
"jp" => "日本",
"ke" => "ケニア",
"kg" => "キルギスタン",
"kh" => "カンボジア",
"ki" => "キリバツ",
"km" => "コモロ",
"kn" => "アンギラ",
"kp" => "北朝鮮",
"kr" => "韓国",
"kw" => "クウェート",
"ky" => "ケイマン諸島",
"kz" => "カザフスタン",
"la" => "ラオス",
"lb" => "レバノン",
"lc" => "セントルシア",
"li" => "リヒテンシュタイン公国",
"lk" => "スリランカ",
"lr" => "リベリア",
"ls" => "レソト",
"lt" => "リトアニア",
"lu" => "ルクセンブルク",
"lv" => "ラトビア",
"ly" => "リビア",
"ma" => "モロッコ",
"mc" => "モナコ",
"md" => "モルドバ",
"me" => "モンテネグロ",
"mf" => "サン・マルタン島",
"mg" => "マダガスカル",
"mh" => "マーシャル諸島",
"mil" => "米軍",
"mk" => "マケドニア",
"ml" => "マリ",
"mm" => "ミャンマー",
"mn" => "モンゴル",
"mo" => "マカオ",
"mp" => "北マリアナ諸島",
"mq" => "マルチニーク島",
"mr" => "モーリタニア",
"ms" => "モンセラット",
"mt" => "マルタ",
"mu" => "モーリシャス",
"mv" => "モルディヴ",
"mw" => "マラウイ",
"mx" => "メキシコ",
"my" => "マレーシア",
"mz" => "モザンビーク",
"na" => "ナミビア",
"name" => "個人",
"nc" => "ニューカレドニア",
"ne" => "ニジェール",
"net" => "ネットワーク",
"nf" => "ノーフォーク島",
"ng" => "ナイジェリア",
"ni" => "ニカラグア",
"nl" => "オランダ",
"no" => "ノルウェー",
"np" => "ネパール",
"nr" => "ナウル",
"nu" => "ニウエ",
"numeric" => "数値のみ",
"nz" => "ニュージーランド",
"om" => "オマーン",
"org" => "非営利団体",
"pa" => "パナマ",
"pe" => "ペルー",
"pf" => "フランス領ポリネシア",
"pg" => "パプアニューギニア",
"ph" => "フィリピン",
"pk" => "パキスタン",
"pl" => "ポーランド",
"pm" => "サンピエール島・ミクロン島",
"pn" => "ピットケルン島",
"pr" => "プエルトリコ",
"ps" => "パレスチナ王国",
"pt" => "ポルトガル",
"pw" => "パラオ",
"py" => "パラグアイ",
"qa" => "カタール",
"re" => "レユニオン",
"ro" => "ルーマニア",
"rs" => "セルビア",
"ru" => "ロシア",
"rw" => "ルワンダ",
"sa" => "サウジアラビア",
"sb" => "ソロモン諸島",
"sc" => "セイシェル",
"sd" => "スーダン",
"se" => "スウェーデン",
"sg" => "シンガポール",
"sh" => "セントヘレナ島",
"si" => "スロベニア",
"sj" => "スヴァルバルド・ヤンマイェン諸島",
"sk" => "スロバキア",
"sl" => "シエラレオネ",
"sm" => "サンマリノ",
"sn" => "セネガル",
"so" => "ソマリア",
"sr" => "スリナム",
"st" => "サントメ・プリンシペ",
"su" => "ソビエト連邦",
"sv" => "エルサルバドル",
"sy" => "シリア",
"sz" => "スワジランド",
"tc" => "タークス諸島・カイコス諸島",
"td" => "チャド",
"tf" => "フランス領南方諸島",
"tg" => "トーゴ",
"th" => "タイ",
"tj" => "タジキスタン",
"tk" => "トケラウ諸島",
"tl" => "東ティモール",
"tm" => "トルクメニスタン",
"tn" => "チュニジア",
"to" => "トンガ",
"tp" => "東ティモール",
"tr" => "トルコ",
"tt" => "トリニダード・トバゴ",
"tv" => "ツバル",
"tw" => "台湾",
"tz" => "タンザニア",
"ua" => "ウクライナ",
"ug" => "ウガンダ",
"uk" => "イギリス",
"um" => "アメリカ辺境諸島",
"unknown" => "未知",
"us" => "アメリカ合衆国",
"uy" => "ウルグアイ",
"uz" => "ウズベキスタン",
"va" => "バチカン市国",
"vc" => "セントビンセントおよびグレナディーン諸島",
"ve" => "ベネズエラ",
"vg" => "イギリス領バージン諸島",
"vi" => "アメリカ領バージン諸島",
"vn" => "ベトナム",
"vu" => "バヌアツ",
"wf" => "ワリスおよびフツナ諸島",
"ws" => "サモア",
"ye" => "イエメン",
"yt" => "マヨテ島",
"yu" => "ユーゴスラビア",
"za" => "南アフリカ",
"zm" => "ザンビア",
"zr" => "ザイール",
"zw" => "ジンバブエ",
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
"global_bbclone_copyright" => "The BBClone team - Licensed under the",
"global_last_reset" => "Statistics last reset on",
"global_yes" => "yes",
"global_no" => "no",

// The error messages
"error_cannot_see_config" =>
"あなたはこのサーバーの BBClone を見ることを許可されていません",

// Miscellaneous translations
"misc_other" => "その他",
"misc_unknown" => "不明",
"misc_second_unit" => "秒",
"misc_ignored" => "無視",

// The Navigation Bar
"navbar_main_site" => "主サイト",
"navbar_configuration" => "設定",
"navbar_global_stats" => "グローバル統計",
"navbar_detailed_stats" => "詳細統計",
"navbar_time_stats" => "時間別統計",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "時間",
"dstat_visits" => "訪問",
"dstat_extension" => "分類",
"dstat_dns" => "ホスト名",
"dstat_from" => "どこから来たか",
"dstat_os" => "ＯＳ",
"dstat_browser" => "ブラウザ",
"dstat_visible_rows" => "アクセス数",
"dstat_green_rows" => "緑",
"dstat_blue_rows" => "青",
"dstat_red_rows" => "赤",
"dstat_search" => "検索",
"dstat_last_page" => "最終ページ",
"dstat_last_visit" => "最終訪問",
"dstat_robots" => "検索ロボット",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "データなし",
"dstat_prx" => "プロキシ",
"dstat_ip" => "IPアドレス",
"dstat_user_agent" => "ユーザーエージェント",
"dstat_nr" => "番号",
"dstat_pages" => "頁",
"dstat_visit_length" => "滯在時間",
"dstat_reloads" => "リロード",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words

"gstat_accesses" => "アクセス",
"gstat_total_visits" => "合計",
"gstat_total_unique" => "固有合計",
"gstat_operating_systems" => "OS別上位 %d",
"gstat_browsers" => " ブラウザ別上位 %d",
"gstat_extensions" => "国コード別上位 %d",
"gstat_robots" => "検索ロボット別上位 %d",
"gstat_pages" => "訪問済ページ上位 %d",
"gstat_origins" => "リファラ上位 %d",
"gstat_hosts" => "ホスト上位 %d",
"gstat_keys" => "キーワード上位 %d",
"gstat_total" => "合計",
"gstat_not_specified" => "不明",

// Time stats words
"tstat_su" => "日",
"tstat_mo" => "月",
"tstat_tu" => "火",
"tstat_we" => "水",
"tstat_th" => "木",
"tstat_fr" => "金",
"tstat_sa" => "土",

"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "1月",
"tstat_feb" => "2月",
"tstat_mar" => "3月",
"tstat_apr" => "4月",
"tstat_may" => "5月",
"tstat_jun" => "6月",
"tstat_jul" => "7月",
"tstat_aug" => "8月",
"tstat_sep" => "9月",
"tstat_oct" => "10月",
"tstat_nov" => "11月",
"tstat_dec" => "12月",

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

"tstat_last_day" => "一日",
"tstat_last_week" => "一週間",
"tstat_last_month" => "一月間",
"tstat_last_year" => "一年間",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",
// Configuration page words and sentences

"config_variable_name" => "変数名",
"config_variable_value" => "変数の値",
"config_explanations" => "説明",

"config_BBC_MAINSITE" =>
"この変数がセットされた場合、指定の位置へリンクが生成されます。デフォルトは親ディレクトリです。あなたの主サイトが他の場所に位置する場合、それに合わせて値を変更してください<br />例:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"統計の設定を表示することがBBCloneのデフォルトです。表示させたくない場合は空白にしてください<br />
例:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"すべての BBClone ページのナビゲーションバーに表示されているタイトル<br />
次のマクロが使えます:<br />
<ul>
<li>%SERVER: サーバー名</li>
<li>%DATE: 日付</li>
</ul>
HTMLタグも使えます<br />
例:<br />
\$BBC_TITLEBAR = &quot;Statistics for %SERVER generated the %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;My stats from %DATE look like this:&quot;;
<br />",

"config_BBC_LANGUAGE" =>
"BBCloneのデフォルト言語指定です。ブラウザによって明示的に指定が無い場合、次の言語をサポートします:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, fi, fr, hu, id, it, ja, ko, lt, mk, nb, nl, pl, pt, pt-br, ro, ru,
sk, sl, sv, th, tr, ua, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"この変数は、同一アクセスと見なす長さを秒で定義します。2回のアクセスの間隔が指定された限界を超えない限り、この時間内での同一アクセスは1つのアクセスと見なされます。デフォルトは30分(1800秒)です。異なる値を割り当てることも出来ます<br />
例:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"詳細な統計で表示するエントリー数。デフォルトは100です。
500(役立たない)を越えた設定はしないで下さい。",

"config_BBC_DETAILED_STAT_FIELDS" =>
"変数 \$BBC_DETAILED_STAT_FIELDS は詳細統計に表示するためのカラムを決定します。
利用可能なカラム名:
<ul>
<li>id&nbsp;=&gt;&nbsp;カウント開始から何番目の訪問者か</li>
<li>time&nbsp;=&gt;&nbsp;最終訪問時間</li>
<li>visits&nbsp;=&gt;&nbsp;同一訪問者のアクセス数</li>
<li>dns&nbsp;=&gt;&nbsp;訪問者のホスト名</li>
<li>ip&nbsp;=&gt;&nbsp;訪問者のIPアドレス</li>
<li>os&nbsp;=&gt;&nbsp;OS種別(可能ならば検索ロボットなども)</li>
<li>browser&nbsp;=&gt;&nbsp;接続に利用されたソフトウェア</li>
<li>ext&nbsp;=&gt;&nbsp;訪問者の国別コード</li>
<li>referer&nbsp;=&gt;&nbsp;訪問者はどこから来たか (可能ならば)</li>
<li>page&nbsp;=&gt;&nbsp;最終訪問ページ</li>
<li>search&nbsp;=&gt;&nbsp;訪問者の使ったクエリ(可能ならば)</li>
</ul>
カラムをアレンジした命令は表示のためにも使用されます。<br />
例:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;
<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"サーバーの時計があなたの地域のタイムゾーンと一致しない場合、このスイッチの使用により数単位で時間を調節することができます。マイナスの値は時間を戻し、プラスは進めます。<br />
Examples:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"IPアドレスをホスト名に変換するかどうかのオプション。使用しているDNSサーバーが遅い、負荷制限をしている、又は信頼性の低い場合、名前の解決はあなたの利用しているサーバーにに負担をかけるかもしれません。この変数のセットはその問題を解決するためのものです。<br />
例:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"実際のサーバー運用にとって有益であると思われるため、BBCloneのデフォルトは時間別統計の中でヒット数を示すようになっています。しかし、あなたの時間統計用にユニークな訪問を使用する方が良ければ、この変数のセットにより数える方法を変更することができます。<br />
例:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"このオプションは特別のIPアドレスあるいはアドレスの範囲を統計から除外するために使用することができます。セパレーターとしてコンマを使用出来ます。<br />
例:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"あなたの統計に特定のサイトから来たアクセス（リファラ）を除外することができます。複数のキーワードを使用する場合は、セパレーターとしてコンマを使用してください。<br />
例:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"検索ロボットをどう処理するかのオプション。デフォルトは、「トップのホスト順位中では無視し、その他の統計の中では残す」です。どんな検索ロボットも見たくなければ、&quot;2&quot;です。人の訪問だけが、カウントされるでしょう。<br />
例:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"このオプションは、BBCloneがどうやって1人のビジターを区別するかの定義をします。デフォルトはIPアドレスのみ(それはほとんどの場合現実的)を使用することです。しかしながら、あなたのビジターがProxyサーバーを使ったりしている場合、このオプションをオフにすることによってより現実的な統計を提供することができます。<br />
例:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"統計をリセットしたい場合は、このスイッチをオンにし、次のアクセスによってそれらを削除することができます。元に戻す事を忘れると、恐らく異常に低いトラフィックを経験するでしょう;)
<br />
例:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"ホストとリファラの統計は1回のビジターの訪問によって大量のデータを生成します。このスイッチをオンにすることによって、これらのエントリーを除去し、あなたの実際のホストおよびリファラのランキングに影響せずに、access.phpのサイズを小さくすることができます。このヒット量は&quot;not_specified&quot;（総合評点を完全にしておくエントリー）に加えられるでしょう。<br />
例:<br />
\$BBC_PURGE_SINGLE = 1;<br />
\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
