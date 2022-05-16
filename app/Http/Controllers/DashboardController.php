<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function saveDashboard(Request $request)
    {
        $dashboardData = [
            'id' => $request->id,
            'name' => $request->name,
            'brief' => $request->brief,
            'time' => $request->time
        ];

        $DashboardRegister = json_decode(Storage::get('dashboardRegister.json'), true);
        array_push($DashboardRegister["data"], $dashboardData);
        Storage::put('dashboardRegister.json', json_encode($DashboardRegister));
    }
}
