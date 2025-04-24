<?php

namespace App\Http\Controllers\Api\V1\Meteo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meteo\MeteoRequest;
use App\Repositories\Meteo\MeteoRepository;

class MeteoController extends Controller
{
    public function __construct(
        private MeteoRepository $repo,
    )
    {
        
    }

    

    public function index(MeteoRequest $request)
    {
        $res = $this->repo->store($request->getDTO());
        
        return response()->json([
            'data' => $res,
            'success' => 1
        ]);
    }
}
