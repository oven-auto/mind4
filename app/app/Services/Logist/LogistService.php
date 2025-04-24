<?php

namespace App\Services\Logist;

use Carbon\Carbon;
use Illuminate\Support\Arr;

Class LogistService
{
    private const MWF = ['Monday', 'Wednesday', 'Friday'];
    private const TTS = ['Tuesday', 'Thursday', 'Saturday'];
    private const HOLIDAYS = ['01.01', '08.03’, ‘09.05'];
    
    private const DAY_TRANSLATE = [
        'Monday' => 'Понедельник',
        'Tuesday' => 'Вторник', 
        'Wednesday' => 'Среда', 
        'Thursday' => 'Четверг', 
        'Friday' => 'Пятница', 
        'Saturday' => 'Суббота', 
    ];

    private const MONTH_TRANSLATE = [
        '01' => 'Январь',
        '02' => 'Февраль', 
        '03' => 'Март', 
        '04' => 'Апрель', 
        '05' => 'Май', 
        '06' => 'Июнь', 
        '07' => 'Июль',
        '08' => 'Август',
        '09' => 'Сентябрь',
        '10' => 'Октябрь',
        '11' => 'Ноябрь',
        '12' => 'Декабрь',
    ];



    public function handle(array $arr)
    {
        $currentDate = Carbon::createFromFormat('d.m.Y H:i', join(' ', Arr::except($arr, ['city'])));

        $city = $arr['city'];
    
        $returned = match($city){
            '1' => $this->scenario($currentDate, self::MWF, '16:00'),
            '2' => $this->scenario($currentDate, self::MWF, '16:00'),
            '3' => $this->scenario($currentDate, self::TTS, '22:00'),
            default => collect()
        };

        return $returned->map(function($item){
            return [
                'date' => $item->format('d.m.Y'),
                'day' => self::DAY_TRANSLATE[$item->format('l')],
                'title' => self::MONTH_TRANSLATE[$item->format('m')],
            ];
        });
    }



    public function scenario(Carbon $date, $daysName, $time)
    {
        $returned = collect();
        $newDate = $date;
        $newDate->addDay(1);

        $currentTime = Carbon::createFromTime($date->hour, $date->minute);
        $timeRequire = Carbon::createFromFormat('H:i', $time);
        $resDate = $currentTime->greaterThan($timeRequire);

        if($resDate && in_array($newDate->format('l'), $daysName))
            $newDate->addDay(1);

        while(count($returned) < 21)
        {
            if(in_array($newDate->format('d.m'), self::HOLIDAYS))
            {
                $newDate->addDay(1);
                continue;
            }

            $dayName = $newDate->format('l');

            if(in_array($dayName, $daysName))
                $returned->push(clone $newDate);

            $newDate->addDay(1);
        }
        
        return $returned;
    }
}