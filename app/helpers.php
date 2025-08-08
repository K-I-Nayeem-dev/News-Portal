<?php


use Carbon\Carbon;

function formatBanglaDateTime($date)
{
    if (empty($date)) {
        return '';
    }

    $en = [
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
        'am',
        'pm',
    ];

    $bn = [
        '০',
        '১',
        '২',
        '৩',
        '৪',
        '৫',
        '৬',
        '৭',
        '৮',
        '৯',
        'জানুয়ারি',
        'ফেব্রুয়ারি',
        'মার্চ',
        'এপ্রিল',
        'মে',
        'জুন',
        'জুলাই',
        'আগস্ট',
        'সেপ্টেম্বর',
        'অক্টোবর',
        'নভেম্বর',
        'ডিসেম্বর',
        '',
        '', // remove am/pm replacement here since we're using words below
    ];

    $carbonDate = Carbon::parse($date)->setTimezone('Asia/Dhaka');

    $hasTime = $carbonDate->format('H:i:s') !== '00:00:00';

    if (!$hasTime) {
        $format = 'd F Y';
        $formatted = $carbonDate->format($format);
    } else {
        $hour = (int)$carbonDate->format('H');
        $minute = (int)$carbonDate->format('i');
        $timeOfDay = '';

        if ($hour >= 5 && $hour < 12) {
            $timeOfDay = 'সকাল';    // Morning
        } elseif ($hour == 12) {
            $timeOfDay = 'দুপুর';   // Noon
        } elseif ($hour > 12 && $hour < 16) {
            $timeOfDay = 'বিকাল';   // Afternoon
        } elseif ($hour >= 16 && $hour < 19) {
            $timeOfDay = 'সন্ধ্যা';  // Evening
        } else {
            $timeOfDay = 'রাত';     // Night
        }

        // Format hour in 12-hour format without am/pm
        $hour12 = $carbonDate->format('g'); // 1 to 12
        $minuteStr = str_pad($minute, 2, '0', STR_PAD_LEFT);

        $format = 'd F Y';

        $formatted = $carbonDate->format($format) . ", {$hour12}:{$minuteStr} {$timeOfDay}";
    }

    // Replace English numbers and month names with Bangla
    return str_replace($en, $bn, $formatted);
}
