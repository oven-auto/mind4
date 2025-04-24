<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeteoRequest extends Model
{
    protected $guarded = [];



    public function response()
    {
        return $this->hasOne(\App\Models\MeteoResponse::class, 'meteo_request_id', 'id')->withDefault();
    }
}
