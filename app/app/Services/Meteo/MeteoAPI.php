<?php

namespace App\Services\Meteo;

use Exception;
use Illuminate\Support\Facades\Http;

Class MeteoAPI
{
    private $token = '59c486a11c124d329f692232252304';
    private const URL = 'api.weatherapi.com/v1';

    public function get()
    {
        $res = Http::get(
            self::URL.'/current.json',
            [
                'q' => '48.8567, 2.3508',
                'key' => '59c486a11c124d329f692232252304',
                'dt' => '2025-04-30'
            ]
        );

        if(!$res->ok())
            throw new Exception('ERROR');

        $data = $res->json();

        return [
            'city' => $data['location']['name'],
            'temp' => $data['current']['temp_c'],
        ];        
    }
}