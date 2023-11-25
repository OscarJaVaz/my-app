<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index (Request $request)
    {
        $data =[];

        Log::channel('custom')->info("Hello word on custom log file");
        Log::channel('custom')->error("Hello word on custom log error");

        return view ('dasboard',$data);
    }
}
