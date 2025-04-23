<?php

namespace App\Http\Controllers\Api\V1\Meteo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meteo\MeteoRequest;
use App\Repositories\Meteo\MeteoRepository;
use App\Services\Meteo\MeteoAPI;

class MeteoController extends Controller
{
    public function __construct(
        private MeteoRepository $repo,
        private MeteoAPI $service,
    )
    {
        
    }

    

    public function index(MeteoRequest $request)
    {
        $data = $this->service->get();
        
        return response()->json([
            'data' => $data,
            'success' => 1
        ]);
    }
}
