<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function provinces()
    {
        return Province::where('id', 35)->get();
    }

    public function regencies($provinces_id)
    {
        return Regency::where('province_id', $provinces_id)->get();
    }
    public function districts($regency_id)
    {
        return District::where('regency_id', $regency_id)->get();
    }
    public function villages($villages_id)
    {
        return Village::where('district_id', $villages_id)->get();
    }
}
