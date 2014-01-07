<?php
/* This file is part of BBClone (The PHP web counter on steroids)
 *
 * CVS File $Id: el.php,v 1.46 2011/12/30 23:03:24 joku Exp $
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
"ad" => "Ανδόρα",
"ae" => "Ηνωμένα Αραβικά Εμιράτα",
"aero" => "Aero",
"af" => "Αφγανιστάν",
"ag" => "Antigua and Barbuda",
"ai" => "Anguilla",
"al" => "Αλβανία",
"am" => "Αρμενία",
"an" => "Netherlands Antilles",
"ao" => "Αγκόλα",
"aq" => "Ανταρκτική",
"ar" => "Αργεντινή",
"arpa" => "Arpa",
"as" => "American Samoa",
"at" => "Αυστρία",
"au" => "Αυστραλία",
"aw" => "Aruba",
"ax" => "Ώλαντ",
"az" => "Αζερμπαϊτζάν",
"ba" => "Βοσνία και Ερζεγοβίνη",
"bb" => "Μπαρμπάντος",
"bd" => "Μπαγκλαντές",
"be" => "Βέλγιο",
"bf" => "Μπουρκίνα Φάσο",
"bg" => "Βουλγαρία",
"bh" => "Bahrain",
"bi" => "Burundi",
"biz" => "Επαγγελματικό",
"bj" => "Benin",
"bl" => "Άγιος Βαρθολομαίος",
"bm" => "Βερμούδες",
"bn" => "Brunei",
"bo" => "Βολιβία",
"br" => "Βραζιλία",
"bs" => "Μπαχάμες",
"bt" => "Μπουτάν",
"bv" => "Bouvet Island",
"bw" => "Μποτσουάνα",
"by" => "Belarus",
"bz" => "Belize",
"ca" => "Καναδάς",
"cc" => "Νησιά Coco",
"cd" => "Κόνγκο",
"cf" => "Central African Republic",
"cg" => "Κονγκό",
"ch" => "Ελβετία",
"ci" => "Ivory Coast",
"ck" => "Νησιά Cook",
"cl" => "Χιλή",
"cm" => "Καμερούν",
"cn" => "Κίνα",
"co" => "Κολομβία",
"com" => "Εμπορική",
"coop" => "Coop",
"cr" => "Κόστα Ρίκα",
"cs" => "Σερβία και Μοντενέγκρο",
"cu" => "Κούβα",
"cv" => "Cape Verde",
"cx" => "Christmas Island",
"cy" => "Κύπρος",
"cz" => "Τσεχία",
"de" => "Γερμανία",
"dj" => "Djibouti",
"dk" => "Δανία",
"dm" => "Δομινίκα",
"do" => "Δομινικανή Δημοκρατία",
"dz" => "Αλγερία",
"ec" => "Εκουαδόρ",
"edu" => "Εκπαιδευτική",
"ee" => "Εσθονία",
"eg" => "Αίγυπτος",
"eh" => "Δυτική Σαχάρα",
"er" => "Eritrea",
"es" => "Ισπανία",
"et" => "Αιθιοπία",
"eu" => "Ευρωπαϊκή Ένωση",
"fi" => "Φιλανδία",
"fj" => "Φίτζι",
"fk" => "Νησιά Falkland",
"fm" => "Micronesia",
"fo" => "Νησιά Faroe",
"fr" => "Γαλλία",
"ga" => "Γκαμπόν",
"gb" => "Ηνωμένο Βασίλειο",
"gd" => "Γρενάδα",
"ge" => "Γεωργία",
"gf" => "Γαλλική Γουινέα",
"gg" => "Guernsey",
"gh" => "Γκάνα",
"gi" => "Γιβραλτάρ",
"gl" => "Greenland",
"gm" => "Γκάμπια",
"gn" => "Γουινέα",
"gov" => "Κυβέρνηση ΗΠΑ",
"gp" => "Γουαδελούπη",
"gq" => "Equatorial Guinea",
"gr" => "Ελλάδα",
"gs" => "Νότια Γεωργία και Νότια Νησιά Sandwich",
"gt" => "Γουατεμάλα",
"gu" => "Guam",
"gw" => "Guinea-Bissau",
"gy" => "Guyana",
"hk" => "Χονγκ Κονγκ",
"hm" => "Heard and Mc Donald Islands",
"hn" => "Ονδούρες",
"hr" => "Κροατία",
"ht" => "Αϊτή",
"hu" => "Ουγγαρία",
"id" => "Ινδονησία",
"ie" => "Ιρλανδία",
"il" => "Ισραήλ",
"im" => "Isle of Man",
"in" => "Ινδία",
"info" => "Πληροφοριακή",
"int" => "Διεθνείς Οργανισμοί",
"io" => "Αγγλική περιφέρεια Ινδικού Ωκεανού",
"iq" => "Ιράκ",
"ir" => "Ιράν",
"is" => "Ισλανδία",
"it" => "Ιταλία",
"je" => "Jersey",
"jm" => "Τζαμάικα",
"jo" => "Ιορδανία",
"jp" => "Ιαπωνία",
"ke" => "Κένυα",
"kg" => "Κυργκιστάν",
"kh" => "Καμπόντια",
"ki" => "Κιριμπάτι",
"km" => "Comoros",
"kn" => "Saint Kitts and Nevis",
"kp" => "Βόρεια Κορέα",
"kr" => "Κορέα",
"kw" => "Κουβέιτ",
"ky" => "Νησιά Cayman",
"kz" => "Καζακστάν",
"la" => "Λάος",
"lb" => "Λίβανος",
"lc" => "Αγία Λουκία",
"li" => "Λιχνενστάιν",
"lk" => "Σρι Λάνκα",
"lr" => "Λιμπερία",
"ls" => "Lesotho",
"lt" => "Λιθουανία",
"lu" => "Λουξεμβούργο",
"lv" => "Λετονία",
"ly" => "Λιβύη",
"ma" => "Μαρόκο",
"mc" => "Μονακό",
"md" => "Μολδαβία",
"me" => "Μαυροβούνιο",
"mf" => "Άγιος Μαρτίνος Γαλλίας",
"mg" => "Μαδαγασκάρη",
"mh" => "Νησιά Marshall",
"mil" => "Στρατός ΗΠΑ",
"mk" => "Μακεδονία (Π.Γ.Δ.Μ.)",
"ml" => "Μάλι",
"mm" => "Myanmar",
"mn" => "Μονγκολία",
"mo" => "Macau",
"mp" => "Northern Mariana Islands",
"mq" => "Martinique",
"mr" => "Mauritania",
"ms" => "Montserrat",
"mt" => "Μάλτα",
"mu" => "Μαυρίκιος",
"museum" => "Μουσείο",
"mv" => "Maldives",
"mw" => "Malawi",
"mx" => "Μεξικό",
"my" => "Μαλαισία",
"mz" => "Mozambique",
"na" => "Ναμίμπια",
"name" => "Προσωπιπκό",
"nc" => "Νέα Καληδονία",
"ne" => "Νίγηρας",
"net" => "Δίκτυα",
"nf" => "Νησί Norfolk",
"ng" => "Νιγηρία",
"ni" => "Νικαράγουα",
"nl" => "Ολλανδία",
"no" => "Νορβηγία",
"np" => "Νεπάλ",
"nr" => "Nauru",
"nu" => "Niue",
"numeric" => "Αριθμός",
"nz" => "Νέα Ζηλανδία",
"om" => "Oman",
"org" => "Οργανισμοί",
"pa" => "Παναμάς",
"pe" => "Περού",
"pf" => "Γαλλική Πολυνησία",
"pg" => "Παπούα Νέα Γουινέα",
"ph" => "Φιλλιπίνες",
"pk" => "Πακιστάν",
"pl" => "Πολωνία",
"pm" => "St. Pierre and Miquelon",
"pn" => "Pitcairn",
"pr" => "Πουέρτο Ρίκο",
"pro" => "Επαγγελματικό",
"ps" => "Παλαιστινιακή",
"pt" => "Πορτογαλία",
"pw" => "Palau",
"py" => "Παραγουάη",
"qa" => "Κατάρ",
"re" => "Reunion",
"ro" => "Ρουμανία",
"rs" => "Σερβία",
"ru" => "Ρωσία",
"rw" => "Rwanda",
"sa" => "Σαουδική Αραβία",
"sb" => "Solomon Islands",
"sc" => "Σεϋχέλλες",
"sd" => "Σουδάν",
"se" => "Σουηδία",
"sg" => "Σιγκαπούρη",
"sh" => "St. Helena",
"si" => "Σλοβενία",
"sj" => "Svalbard and Jan Mayen Islands",
"sk" => "Σλοβακία",
"sl" => "Σιέρα Λεόνε",
"sm" => "Σαν Μαρίνο",
"sn" => "Σενεγάλη",
"so" => "Σομαλία",
"sr" => "Σουρινάμ",
"st" => "Sao Tome and Principe",
"su" => "Σοβιετική Ένωση",
"sv" => "Ελ Σαλβαδόρ",
"sy" => "Συρία",
"sz" => "Swaziland",
"tc" => "Turks and Caicos Islands",
"td" => "Chad",
"tf" => "Νότια Γαλλική Περιφέρια",
"tg" => "Togo",
"th" => "Ταϊλάνδη",
"tj" => "Τατζικιστάν",
"tk" => "Tokelau",
"tl" => "Ανατολικό Τιμόρ",
"tm" => "Τουρκμενιστάν",
"tn" => "Τυνησία",
"to" => "Τόνγκα",
"tp" => "Ανατολικό Τιμόρ",
"tr" => "Τουρκία",
"tt" => "Τρινιδάδ και Τομπάγκο",
"tv" => "Tuvalu",
"tw" => "Ταϊβάν",
"tz" => "Τανζανία",
"ua" => "Ουκρανία",
"ug" => "Ουγκάντα",
"uk" => "Μεγάλη Βρετανία",
"um" => "US Minor Outlying Islands",
"unknown" => "’γνωστη",
"us" => "Η.Π.Α.",
"uy" => "Ουρουγουάη",
"uz" => "Ουζμπεκιστάν",
"va" => "Πολιτεία Βατικανού",
"vc" => "St. Vincent and the Grenadines",
"ve" => "Βενεζουέλα",
"vg" => "Παρθένοι Νήσοι (UK)",
"vi" => " Παρθένοι Νήσοι (US)",
"vn" => "Βιετνάμ",
"vu" => "Vanuatu",
"wf" => "Wallis and Futuna Islands",
"ws" => "Σαμόα",
"ye" => "Υεμένη",
"yt" => "Mayotte",
"yu" => "Σερβία και Μοντενέγρο",
"za" => "Νότια Αφρική",
"zm" => "Ζάμπια",
"zr" => "Ζαΐρ",
"zw" => "Ζιμπάμπουε",
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
"global_bbclone_copyright" => "Η ομάδα του BBClone - Υπό την άδεια του",
"global_last_reset" => "Τα στατιστικά μηδενίστηκαν τελευταία φορά την",
"global_yes" => "ναί",
"global_no" => "όχι",

// The error messages
"error_cannot_see_config" =>
"Δεν επιτρέπετε να δείτε τις ρυθμίσεις του BBClone σε αυτόν το εξυπηρετητή.",

// Miscellaneous translations
"misc_other" => "’λλο",
"misc_unknown" => "’γνωστο",
"misc_second_unit" => "s",
"misc_ignored" => "Αγνοήθηκε",

// The Navigation Bar
"navbar_main_site" => "Κεντρική σελίδα",
"navbar_configuration" => "Ρυθμίσεις",
"navbar_global_stats" => "Συνολικά στατιστικά",
"navbar_detailed_stats" => "Λεπτομερή στατιστικά",
"navbar_time_stats" => "Χρονικά Στατιστικά",
"navbar_language" => "Language",
"navbar_go" => "Go",

// Detailed stats words
"dstat_id" => "ID",
"dstat_time" => "Χρόνος",
"dstat_visits" => "Επισκέψεις",
"dstat_extension" => "Επέκταση",
"dstat_dns" => "Όνομα Εξυπηρετητή",
"dstat_from" => "Από",
"dstat_os" => "Λειτουργικό Σύστημα",
"dstat_browser" => "Πρόγραμμα Πλοήγησης",
"dstat_visible_rows" => "Επισκέψεις που εμφανίζονται",
"dstat_green_rows" => "Πράσινες γραμμές",
"dstat_blue_rows" => "Μπλε γραμμές",
"dstat_red_rows" => "Κόκκινες γραμμές",
"dstat_search" => "Αναζήτηση",
"dstat_last_page" => "Τελευταία Σελίδα",
"dstat_last_visit" => "Τελευταία Επίσκεψη",
"dstat_robots" => "Ρομπότ",
"dstat_my_visit" => "Visits from your IP",
"dstat_no_data" => "Δεν υπάρχουν δεδομένα",
"dstat_prx" => "Εξυπηρετητής Proxy",
"dstat_ip" => "IP Διεύθυνση",
"dstat_user_agent" => "User Agent",
"dstat_nr" => "Nr",
"dstat_pages" => "Σελίδες",
"dstat_visit_length" => "Διάρκεια Επίσκεψης",
"dstat_reloads" => "Ανανεώσεις",
"dstat_whois_information" => "Look up information on this IP Adress",

// Global stats words
"gstat_accesses" => "Επισκέψεις",
"gstat_total_visits" => "Συνολικές Επισκέψεις",
"gstat_total_unique" => "Συνολικές Μοναδικές",
"gstat_operating_systems" => "Πρώτα %d Λειτουργικά Συστήματα",
"gstat_browsers" => "Πρώτα %d Προγράμματα Πλοήγησης",
"gstat_extensions" => "Πρώτες %d Επεκτάσεις",
"gstat_robots" => "Πρώτα %d Ρομπότ",
"gstat_pages" => "Πρώτες %d Σελίδες",
"gstat_origins" => "Πρώτες %d Προελεύσεις",
"gstat_hosts" => "Πρώτοι %d Εξυπηρετητές",
"gstat_keys" => "Πρώτες %d Λέξεις Κλειδιά",
"gstat_total" => "Συνολικά",
"gstat_not_specified" => "Δεν διευκρινίζεται",

// Time stats words
"tstat_su" => "Κυρ",
"tstat_mo" => "Δευ",
"tstat_tu" => "Τρι",
"tstat_we" => "Τετ",
"tstat_th" => "Πεμ",
"tstat_fr" => "Παρ",
"tstat_sa" => "Σαβ",

"tstat_full_su" => "Sunday",
"tstat_full_mo" => "Monday",
"tstat_full_tu" => "Tuesday",
"tstat_full_we" => "Wednesday",
"tstat_full_th" => "Thursday",
"tstat_full_fr" => "Friday",
"tstat_full_sa" => "Saturday",

"tstat_jan" => "Ιαν",
"tstat_feb" => "Φεβ",
"tstat_mar" => "Μαρ",
"tstat_apr" => "Απρ",
"tstat_may" => "Μαι",
"tstat_jun" => "Ιουν",
"tstat_jul" => "Ιουλ",
"tstat_aug" => "Αυγ",
"tstat_sep" => "Σεπ",
"tstat_oct" => "Οκτ",
"tstat_nov" => "Νοε",
"tstat_dec" => "Δεκ",

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

"tstat_last_day" => "Τελευταία μέρα",
"tstat_last_week" => "Τελευταία εβδομάδα",
"tstat_last_month" => "Τελευταίος μήνας",
"tstat_last_year" => "Τελευταίος χρόνος",
"tstat_average" => "Average",

// Loadtime notice
"generated" => "page generated in ",
"seconds" => " seconds",

// Configuration page words and sentences
"config_variable_name" => "Όνομα Μεταβλητής",
"config_variable_value" => "Αξία Μεταβλητής",
"config_explanations" => "Επεξήγηση",

"config_BBC_MAINSITE" =>
"Αν αυτή η μεταβλητή έχει τεθεί, μία διασύνδεση στη συγκεκριμένη τοποθεσία θα παραχθεί. Η εξορισμού αξία 'δείχνει' στο γονικό (parent) κατάλογο. Στην περίπτωση που η κεντρική τοποθεσία βρίσκεται αλλού, πρέπει πιθανότατα να ρυθμίστε την αξία της ώστε να ταιριάζει στις ανάγκες σας.<br />
Παραδείγματα:<br />
\$BBC_MAINSITE = &quot;http://www.myserver.com/&quot;<br />
\$BBC_MAINSITE = &quot;..&quot;<br />
\$BBC_MAINSITE = &quot;&quot;;",

"config_BBC_SHOW_CONFIG" =>
"Το BBClone, από εξορισμού, εμφανίζει τις ρυθμίσεις των στατιστικών. Αν δεν επιθυμείτε αυτήν τη συμπεριφορά μπορείτε να αρνηθείτε την πρόσβαση απενεργοποιώντας την επιλογή.<br />
Παραδείγματα:<br />
\$BBC_SHOW_CONFIG = 1;<br />
\$BBC_SHOW_CONFIG = &quot;&quot;;",

"config_BBC_TITLEBAR" =>
"Ο τίτλος των αρχικών σας σελίδων.<br />
Θα φαίνεται στη μπάρα πλοήγησης όλων των σελίδων του BBClopne<br />
Οι παρακάτω μακροεντολές αναγνωρίζονται:<br />
<ul>
<li>%SERVER: όνομα server,</li>
<li>%DATE: τρέχουσα ημερομηνία.</li>
</ul>
Τα HTML Tags επιτρέπονται.<br />
Παραδείγματα:<br />
\$BBC_TITLEBAR = &quot;Στατιστικά για το %SERVER στις %DATE&quot;;<br />
\$BBC_TITLEBAR = &quot;Τα στατιστικά μου για την %DATE είναι κάπως έτσι:&quot;;<br />",

"config_BBC_LANGUAGE" =>
"Η εξορισμού γλώσσα του BBClone, σε περίπτωση που δεν ρυθμίζεται από το πρόγραμμα πλοήγησης. Οι παρακάτω γλώσσες υποστηρίζονται:
<p>ar, bg, bs, ca, cs, da, de, el, en, es, el, fi, fr, hu, it, ja, ko, lt, mk, nb, nl, pl, pt-br, ro, ru, sk, sl, sv, th, tr, ua, zh-cn and zh-tw</p>",

"config_BBC_MAXTIME" =>
"Αυτή η μεταβλητή προσδιορίζει τη διάρκεια μιας μοναδικής επίσκεψης σε δευτερόλεπτα. Κάθε επίσκεψη από τον ίδιο επισκέπτη μέσα σε αυτήν την περίοδο θα θεωρείται μία επίσκεψη, όσο δύο συνεχόμενες επισκέψεις δεν θα ξεπερνούν το καθορισμένο όριο. Η εξορισμού αξία είναι η καθιερωμένη, με βάση τα διαδικτυακά πρότυπα, αξία των 30 λεπτών (1800 δευτερόλεπτα), αλλά εξαρτάται από τις ανάγκες σας μπορείτε να βάλετε διαφορετική αξία.<br />
Παραδείγματα:<br />
\$BBC_MAXTIME = 0;<br />
\$BBC_MAXTIME = 1800;",

"config_BBC_MAXVISIBLE" =>
"Πόσες καταχωρήσεις θέλετε να βρίσκονται στα λεπτομερή στατιστικά; Η εξορισμού αξία είναι 100. Προτείνεται να μην το θέσετε σε περισσότερο από 500 για να αποφύγετε το πολύ βαρύ φόρτωμα.",

"config_BBC_DETAILED_STAT_FIELDS" =>
"Η μεταβλητή \$BBC_DETAILED_STAT_FIELDS καθορίζει της στήλες που θα φαίνονται στα λεπτομερή στατιστικά. Πιθανές στήλες είναι:
<ul>
<li>id&nbsp;=&gt;&nbsp;Ο x-ος επισκέπτης από την ώρα που ξεκινήσατε να μετράτε</li>
<li>time&nbsp;=&gt;&nbsp;Ο χρόνος κατά τον οποίο καταγράφηκε η τελευταία επίσκεψη</li>
<li>visits&nbsp;=&gt;&nbsp;Τα χτυπήματα ενός μοναδικού επισκέπτη</li>
<li>dns&nbsp;=&gt;&nbsp;Η διεύθυνση εξυπηρετητή του επισκέπτη</li>
<li>ip&nbsp;=&gt;&nbsp;Η IP διεύθυνση του επισκέπτη</li>
<li>os&nbsp;=&gt;&nbsp;Το λειτουργικό σύστημα (αν είναι διαθέσιμο και όχι ρομπότ)</li>
<li>browser&nbsp;=&gt;&nbsp;Το λογισμικό που χρησιμοποιήθηκε για τη σύνδεση</li>
<li>ext&nbsp;=&gt;&nbsp;Η χώρα ή η επέκταση του επισκέπτη</li>
<li>referer&nbsp;=&gt;&nbsp;Η σελίδα προελεύσεως (εάν αυτή υφίσταται)</li>
<li>page&nbsp;=&gt;&nbsp;Η τελευταία σελίδα επίσκεψης</li>
<li>search&nbsp;=&gt;&nbsp;Οι λέξεις κλειδιά με της οποίες ο επισκέπτης εντόπισε την τοποθεσία μέσω από μηχανή αναζήτησης (εάν αυτό υφίσταται)</li>
</ul>
Ο ίδιος τρόπος που έχετε καθορίσει της στήλες θα χρησιμοποιηθεί και για την προβολή.<br />
Παραδείγματα:<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;id, time, visits, ip, ext, os, browser&quot;;<br />
\$BBC_DETAILED_STAT_FIELDS = &quot;date, ext, browser, os, ip&quot;;<br />",

"config_BBC_TIME_OFFSET" =>
"Στην περίπτωση που η ώρα του εξυπηρετητή δεν ταιριάζει με την τοπική ώρα, μπορείτε να ρυθμίσετε το χρόνο σε λεπτά χρησιμοποιώντας αυτόν το διακόπτη. Αρνητικές αξίες θα γυρίσουν πίσω το χρόνο, θετικές θα τον πάνε μπροστά.<br />
Παραδείγματα:<br />
\$BBC_TIME_OFFSET = 300;<br />
\$BBC_TIME_OFFSET = -300;<br />
\$BBC_TIME_OFFSET = 0;",

"config_BBC_NO_DNS" =>
"Αυτή η επιλογή καθορίζει, αν οι διευθύνσεις IP θα ανάγονται σε ονόματα εξυπηρετητών ή όχι. Ενώ τα ονόματα εξυπηρετητών λένε περισσότερα για τον επισκέπτη, η αναγωγή τους μπορεί να καθυστερήσει σημαντικά την τοποθεσία, αν οι εξυπηρετητές DNS που χρησιμοποιήθηκαν είναι αργοί, περιορισμένης χωρητικότητας ή γενικότερα αναξιόπιστοι. Η ρύθμιση αυτής της μεταβλητής μπορεί να λύσει το πρόβλημα.<br />
Παραδείγματα:<br />
\$BBC_NO_DNS = 1;<br />
\$BBC_NO_DNS = &quot;&quot;;",

"config_BBC_NO_HITS" =>
"Η εξορισμού συμπεριφορά του BBClone είναι να δείχνει τις προσβάσεις στα χρονικά στατιστικά, γιατί δίνει μια χρήσιμη εντύπωση για το φόρτο εργασίας του εξυπηρετητή. Αν, παρ' όλα αυτά προτιμάτε να χρησιμοποιείτε μοναδικές επισκέψεις σαν βάση για τα χρονικά στατιστικά, μπορείτε να αλλάξετε τον τρόπο μέτρησης θέτοντας αυτήν τη μεταβλητή.<br />
Παραδείγματα:<br />
\$BBC_NO_HITS = 1;<br />
\$BBC_NO_HITS = &quot;&quot;;",

"config_BBC_IGNORE_IP" =>
"Αυτή η επιλογή μπορεί να χρησιμοποιηθεί για τον αποκλεισμό συγκεκριμένων διευθύνσεων IP ή εύρος αυτών από την καταμέτρηση. Στην περίπτωση που προσθέσετε πάνω από μία, χωρίστε τες με κόμμα. <br />
Παραδείγματα:<br />
\$BBC_IGNORE_IP = &quot;127., 192.168.&quot;;<br />
\$BBC_IGNORE_IP = &quot;&quot;;",

"config_BBC_IGNORE_REFER" =>
"Σε περίπτωση που δεν θέλετε να έχετε συγκεκριμένες 'προηγούμενα σελίδες' από τους επισκέπτες σας να φαίνονται στα λεπτομερή στατιστικά, μπορείτε να διευκρινίσετε μία ή περισσότερες λέξεις-κλειδιά που χρησιμοποιούνται για να μπλοκαριστεί ή αντίστοιχη 'προηγούμενη σελίδα΄. Αν χρησιμοποιήσετε παραπάνω από μία λέξεις-κλειδιά, χωρίστε τις με κόμμα.<br />
Παραδείγματα:<br />
\$BBC_IGNORE_REFER = &quot;spambot.org, .escort.&quot;;<br />
\$BBC_IGNORE_REFER = &quot;&quot;;",

"config_BBC_IGNORE_BOTS" =>
"Μπορείτε να χρησιμοποιήσετε αυτή την επιλογή για να προσδιορίσετε την μεταχείριση που θα έχουν τα Ρομπότς. Η εξορισμού συμπεριφορά είναι να αγνοούνται στην λίστα με τα πιο συχνά ονόματα εξυπηρετητών, αλλά να παραμένουν στα στατιστικά.. Εάν δεν επιθυμείτε να βλέπετε τα Ρομποτς γενικά, μπορείτε να θέσετε αυτή την επιλογή σε &quot;2&quot;, τότε μόνο επισκέψεις από ανθρώπους θα λαμβάνονται υπόψιν. <br />
Παραδείγματα:<br />
\$BBC_IGNORE_BOTS = 2;<br />
\$BBC_IGNORE_BOTS = 1;<br />
\$BBC_IGNORE_BOTS = &quot;&quot;;",

"config_BBC_IGNORE_AGENT" =>
"Αυτή η επιλογή καθορίζει πως το BBClone ξεχωρίζει τον ένα επισκέπτη από τον άλλο. Η εξορισμού συμπεριφορά είναι η χρησιμοποίηση μόνο της διεύθυνσης IP, που προβάλλει ρεαλιστικά νούμερα στις περισσότερες περιπτώσεις. Αν παρ' όλα αυτά, οι επισκέπτες είναι συχνά κρυμμένοι πίσω από εξυπηρετητές proxy, η απενεργοποίηση αυτής της επιλογής θα προβάλλει πιο ρεαλιστικά νούμερα, εφόσον ένας νέος επισκέπτης θα θεωρείται κάθε φορά που αλλάζει το πρόγραμμα πλοήγησης.<br />
Παραδείγματα:<br />
\$BBC_IGNORE_AGENT = 1;<br />
\$BBC_IGNORE_AGENT = &quot;&quot;;",

"config_BBC_KILL_STATS" =>
"Όποτε θέλετε να επανεκκινήσετε τα στατιστικά, μπορείτε να ενεργοποιήσετε αυτό το διακόπτη και θα διαγραφούν με την επόμενη επίσκεψη. Μην ξεχάσετε να τον απενεργοποιήσετε μετά, αλλιώς θα παρατηρήσετε ασυνήθιστα χαμηλή κίνηση στην τοποθεσία ;).<br />
Παραδείγματα:<br />
\$BBC_KILL_STATS = 1;<br />
\$BBC_KILL_STATS = &quot;&quot;;",

"config_BBC_PURGE_SINGLE" =>
"Οι εξυπηρετητές και τα στατιστικά τοποθεσιών προελεύσεως μπορούνε να δημιουργήσουν τεράστιες ποσότητες πληροφοριών, παρά το γεγονός ότι μπορούν να προέρχονται από έναν και μοναδικό επισκέπτη. Εάν ενεργοποιήσετε αυτό τον διακόπτη, μπορείτε να εκκαθαρίσετε αυτές τις εγγραφές, έτσι ώστε να μειωθεί σημαντικά το μέγεθος του αρχείου access.php, χωρίς να επηρεαστούνε οι πραγματικές οπτικές βαθμολογίες των εξυπηρετητών και τοποθεσιών προελεύσεως.. Η ποσότητα των προσβάσεων θα προσθέτεται στις &quot;not_specified&quot; εγγραφές για να παραμείνει η ολική βαθμολογία ανέπαφη.<br />
Παραδείγματα:<br />
\$BBC_PURGE_SINGLE = 1;<br />

\$BBC_PURGE_SINGLE = &quot;&quot;;"

);
?>
