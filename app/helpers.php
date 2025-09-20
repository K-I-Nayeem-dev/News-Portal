<?php


use Carbon\Carbon;
use Illuminate\Support\Str;


function formatBanglaDate($date)
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
        'December'
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
        'ডিসেম্বর'
    ];

    $carbonDate = Carbon::parse($date)->setTimezone('Asia/Dhaka');
    $formatted = $carbonDate->format('d F Y');

    return str_replace($en, $bn, $formatted);
}

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
        'December'
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
        'ডিসেম্বর'
    ];

    $carbonDate = Carbon::parse($date)->setTimezone('Asia/Dhaka');

    $hour = (int)$carbonDate->format('H');
    $minute = (int)$carbonDate->format('i');

    if ($hour >= 5 && $hour < 12) {
        $timeOfDay = 'সকাল';
    } elseif ($hour == 12) {
        $timeOfDay = 'দুপুর';
    } elseif ($hour > 12 && $hour < 16) {
        $timeOfDay = 'বিকাল';
    } elseif ($hour >= 16 && $hour < 19) {
        $timeOfDay = 'সন্ধ্যা';
    } else {
        $timeOfDay = 'রাত';
    }

    $hour12 = $carbonDate->format('g');
    $minuteStr = str_pad($minute, 2, '0', STR_PAD_LEFT);

    $formatted = $carbonDate->format('d F Y') . ", {$hour12}:{$minuteStr} {$timeOfDay}";

    return str_replace($en, $bn, $formatted);
}

function generateSlugs($item)
{
    if (!$item) {
        return ['categorySlug' => null, 'subcategorySlug' => null];
    }

    $categorySlug = isset($item->newsCategory->category_en)
        ? Str::slug($item->newsCategory->category_en)
        : null;

    $subcategorySlug = (isset($item->newsSubcategory) && $item->newsSubcategory)
        ? Str::slug($item->newsSubcategory->sub_cate_en)
        : null;

    return [
        'categorySlug' => $categorySlug,
        'subcategorySlug' => $subcategorySlug,
    ];
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
