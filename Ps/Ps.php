<?php
const DEFAULT_SITE_LANG = "ckb";
const SITE_LANGS = [
    "ckb" => [
	"dir" => "rtl",
	"align" => "right",
	"cc" => "ckb",
	"lit" => "کوردیی سۆرانی",
    ],
    "fa" => [
	"dir" => "rtl",
	"align" => "right",
	"cc" => "fa",
	"lit" => "فارسی",
    ],
    /* "ku" => [
       "dir" => "ltr",
       "align" => "left",
       "cc" => "ku",
       "lit" => "Kurdî",
     * ],
     * "en" => [
       "dir" => "ltr",
       "align" => "left",
       "cc" => "en",
       "lit" => "English",
     * ], */
];
function SP ($key)
{
    global $site_lang, $Ps;
    return @$Ps[$key][$site_lang];
}
function P ($key)
{
    echo SP($key);
}
$Ps = [
    "title" => [
	"ckb" => "ئاڵەکۆک",
	"fa" => "ئاڵەکۆک",
	"ku" => "Allekok",
	"en" => "Allekok",
    ],
    "desc" => [
	"ckb" => "شێعری شاعیرانی کورد",
	"fa" => "اشعار شاعران کرد",
	"ku" => "",
	"en" => "Kurdish poems",
    ],
    "keys" => [
	"ckb" => "ئاڵەکۆک,شێعر,شاعیر,بەیت,چیرۆک,هەڵبەست,شیعر,کورد,کوردستان,ئەدەب",
	"fa" => "ئاڵەکۆک,شعر,شاعر,ادبیات,کرد,کردستان",
	"ku" => "",
	"en" => "",
    ],
    "bottom" => [
	"ckb" => "چوونە خوارەوە",
	"fa" => "رفتن به انتهای صفحه",
	"ku" => "",
	"en" => "Go to bottom",
    ],
    "search for" => [
	"ckb" => "گەڕان بۆ ...",
	"fa" => "جست‌وجو ...",
	"ku" => "",
	"en" => "Search for ...",
    ],
    "top" => [
	"ckb" => "چوونە سەرەوە",
	"fa" => "رفتن به ابتدای صفحه",
	"ku" => "",
	"en" => "Go to top",
    ],
    "dead poets" => [
	"ckb" => "شاعیرانی کۆچ‌کردوو",
	"fa" => "شاعران فوت‌شده",
	"ku" => "",
	"en" => "",
    ],
    "new poets" => [
	"ckb" => "شاعیرانی نوێ",
	"fa" => "شاعران هم‌عصر",
	"ku" => "",
	"en" => "New poets",
    ],
    "beyt" => [
	"ckb" => "بەیتی کوردی",
	"fa" => "بیت کردی",
	"ku" => "",
	"en" => "Kurdish Beyt",
    ],
    "new poets desc" => [
	"ckb" => "مەبەست لە شاعیرانی نوێ، ئەو شاعیرانەن کە لە ژیان‌دا ماون. تکایە ئەگەر دەتوانن کتێبەکانیان لە کتێبفرۆشیەکان بکڕن.",
	"fa" => "این شاعران هم‌اکنون در قید حیات هستند. لطفا در صورت امکان کتاب‌هایشان را از کتابفروشی‌ها تهیه کنید.",
	"ku" => "",
	"en" => "",
    ],
    "donate" => [
	"ckb" => "یارمەتیی ماڵی",
	"fa" => "کمک مالی",
	"ku" => "",
	"en" => "Donate",
    ],
    "about allekok" => [
	"ckb" => "سەبارەت بە ئاڵەکۆک",
	"fa" => "درباره ئاڵەکۆک",
	"ku" => "",
	"en" => "About Allekok",
    ],
    "allekok?" => [
	"ckb" => "ئاڵەکۆک؟",
	"fa" => "ئاڵەکۆک؟",
	"ku" => "Allekok?",
	"en" => "Allekok?",
    ],
    "allekok news" => [
	"ckb" => "تازەکانی ئاڵەکۆک",
	"fa" => "تازه‌های ئاڵەکۆک",
	"ku" => "",
	"en" => "New poems",
    ],
    "news" => [
	"ckb" => "تازەکان",
	"fa" => "تازه‌ها",
	"ku" => "",
	"en" => "News",
    ],
    "allekok pitew" => [
	"ckb" => "پتەوکردنی ئاڵەکۆک",
	"fa" => "تنومند‌کردن ئاڵەکۆک",
	"ku" => "",
	"en" => "Make Allekok better",
    ],
    "pitew" => [
	"ckb" => "پتەوکردن",
	"fa" => "تنومندکردن",
	"ku" => "",
	"en" => "Betterization",
    ],
    "thanks.." => [
	"ckb" => "سپاس و پێزانین",
	"fa" => "سپاس",
	"ku" => "",
	"en" => "Thanks",
    ],
    "thanks" => [
	"ckb" => "سپاس",
	"fa" => "سپاس",
	"ku" => "",
	"en" => "Thanks",
    ],
    "desktop" => [
	"ckb" => "دابەزاندنی بەرنامەی ئاڵەکۆک",
	"fa" => "دریافت برنامه ئاڵەکۆک",
	"ku" => "",
	"en" => "Download Allekok application",
    ],
    "code" => [
	"ckb" => "کۆد",
	"fa" => "توسعه‌دهندگان",
	"ku" => "",
	"en" => "Developers",
    ],
    "customize" => [
	"ckb" => "گۆڕانکاری",
	"fa" => "ویرایش ظاهری",
	"ku" => "",
	"en" => "Customize",
    ],
    "language" => [
	"ckb" => "زمان",
	"fa" => "زبان",
	"ku" => "",
	"en" => "Language",
    ],
    "" => [
	"ckb" => "",
	"fa" => "",
	"ku" => "",
	"en" => "",
    ],
];
?>
