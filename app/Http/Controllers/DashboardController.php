<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function addDashboard(Request $request)
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
        Storage::put('dashboards/dashboard-' . $request->id . '.json', '{"data":[]}');
        $this->addBaseComponent($request->id);
    }
    public function readDashboard()
    {
        $DashboardRegister = json_decode(Storage::get('dashboardRegister.json'), true);
        return $DashboardRegister["data"];
    }
    private function addBaseComponent($parentId)
    {
        $componentData = [
            "i" => 0,
            "parentId" => $parentId,
            "component" => "text",
            "dataQuery" => "Select * FROM productos ORDER BY id",
            "type" => "line",
            "zoom" => "false",
            "title" => "Base Component",
            "xaxis" => "nombre",
            "yaxis" => "precio",
            "x" => 0,
            "y" => 0,
            "w" => 12,
            "h" => 4
        ];

        $ComponentRegister = json_decode(Storage::get('dashboards/dashboard-' . $parentId . '.json'), true);
        array_push($ComponentRegister["data"], $componentData);
        Storage::put('dashboards/dashboard-' . $parentId . '.json', json_encode($ComponentRegister));
    }
}
