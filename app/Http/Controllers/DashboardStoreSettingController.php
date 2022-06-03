<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardStoreSettingController extends Controller
{
    public function index()
    {
        return view('pages.dashboard-store-setting');
    }
}
