<?php

namespace App\Http\Controllers\Api\V1\Logist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Logist\LogistRequest;
use App\Services\Logist\LogistService;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class LogistController extends Controller
{
    public function __construct(
        private LogistService $service
    )
    {
        
    }



    

    public function index(LogistRequest $request)
    {
        $data = $request->validated();

        $returned = $this->service->handle($data);               

        return response()->json([
            'data' => $returned,
            'success' => 1,
            'count' => $returned->count()
        ]);
    }
}
