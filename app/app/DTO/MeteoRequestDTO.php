<?php

namespace App\DTO;

Class MeteoRequestDTO
{
    public $coordinates;
    public $date_at;

    public function __construct(array $data)
    {
        $this->coordinates = $data['coordinates'];
        $this->date_at = $data['date'];
    }



    public function toArray()
    {
        return [
            'coordinates' => $this->coordinates,
            'date_at' => $this->date_at,
        ];
    }
}