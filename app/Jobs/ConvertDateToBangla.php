<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use DateTime;
use DateTimeZone;

class ConvertDateToBangla implements ShouldQueue
{
    use Queueable;

    protected $datetime;
    protected $timezone;

    public $result;

    public function __construct($datetime, $timezone = 'Asia/Dhaka')
    {
        $this->datetime = $datetime;
        $this->timezone = $timezone;
        $this->result = null;
    }

    public function handle()
    {
        $days = [
            'Sunday' => 'রবিবার', 'Monday' => 'সোমবার', 'Tuesday' => 'মঙ্গলবার',
            'Wednesday' => 'বুধবার', 'Thursday' => 'বৃহস্পতিবার',
            'Friday' => 'শুক্রবার', 'Saturday' => 'শনিবার'
        ];

        $months = [
            'January' => 'জানুয়ারি', 'February' => 'ফেব্রুয়ারি', 'March' => 'মার্চ',
            'April' => 'এপ্রিল', 'May' => 'মে', 'June' => 'জুন',
            'July' => 'জুলাই', 'August' => 'আগস্ট', 'September' => 'সেপ্টেম্বর',
            'October' => 'অক্টোবর', 'November' => 'নভেম্বর', 'December' => 'ডিসেম্বর'
        ];

        $bnDigits = ['0'=>'০','1'=>'১','2'=>'২','3'=>'৩','4'=>'৪','5'=>'৫','6'=>'৬','7'=>'৭','8'=>'৮','9'=>'৯'];

        $date = new DateTime($this->datetime, new DateTimeZone('UTC'));
        $date->setTimezone(new DateTimeZone($this->timezone));

        $day = $days[$date->format('l')];
        $dayNum = strtr($date->format('d'), $bnDigits);
        $month = $months[$date->format('F')];
        $year = strtr($date->format('Y'), $bnDigits);
        $time = strtr($date->format('h:i A'), $bnDigits);
        $time = str_replace(['AM', 'PM'], ['এএম', 'পিএম'], $time);

        $this->result = "$day, $dayNum $month $year, $time";

    }
}