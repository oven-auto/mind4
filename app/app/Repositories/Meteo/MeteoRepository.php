<?php

namespace App\Repositories\Meteo;

use App\DTO\MeteoRequestDTO;
use App\Models\MeteoRequest;
use App\Services\Meteo\MeteoAPI;
use Illuminate\Support\Facades\DB;

Class MeteoRepository
{
    public function __construct(
        private MeteoAPI $service
    )
    {
        
    }



    public function store(MeteoRequestDTO $dto)
    {
        $res = DB::transaction(function() use($dto){
            $meteoRequest = MeteoRequest::create($dto->toArray());

            $res = $this->service->get($dto);

            $meteoRequest->response()->create($res);

            return $res;
        });
        
        return $res;
    }
}