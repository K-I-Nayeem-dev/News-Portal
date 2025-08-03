<?php

use Carbon\Carbon;

function formatBanglaDate($date)
{
    $en = [
        '0','1','2','3','4','5','6','7','8','9',
        'January','February','March','April','May','June',
        'July','August','September','October','November','December'
    ];

    $bn = [
        '০','১','২','৩','৪','৫','৬','৭','৮','৯',
        'জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন',
        'জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর'
    ];

    $formatted = Carbon::parse($date)->format('d F Y');
    return str_replace($en, $bn, $formatted);
}