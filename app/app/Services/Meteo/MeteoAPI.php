<?php

namespace App\Services\Meteo;

use App\DTO\MeteoRequestDTO;
use Exception;
use Illuminate\Support\Facades\Http;

Class MeteoAPI
{
    private const TOKEN = '59c486a11c124d329f692232252304';
    private const URL = 'api.weatherapi.com/v1';

    public function get(MeteoRequestDTO $dto)
    {
        $res = Http::get(
            self::URL.'/current.json',
            [
                'q' => $dto->coordinates,
                'key' => self::TOKEN,
                'dt' => $dto->date_at
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