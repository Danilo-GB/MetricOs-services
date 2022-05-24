<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatisticsController extends Controller
{
    public function addStDashboard(Request $request)
    {
        $dashboardData = [
            'id' => $request->id,
            'name' => $request->name,
            'brief' => $request->brief,
        ];

        $DashboardStRegister = json_decode(Storage::get('statisticsRegister.json'), true);
        array_push($DashboardStRegister["data"], $dashboardData);
        Storage::put('statisticsRegister.json', json_encode($DashboardStRegister));
        Storage::put('statistics/dashboard-' . $request->id . '.json', '{"data":[]}');
        $this->addBaseComponent($request->id);
    }
    public function readStDashboard()
    {
        $DashboardRegister = json_decode(Storage::get('statisticsRegister.json'), true);
        return $DashboardRegister["data"];
    }
    private function addBaseComponent($parentId)
    {
        $componentData = [
            "i" => 0,
            "parentId" => $parentId,
            "dataQuery" => "Select * FROM productos",
            "type" => "text",
            "title" => "Base Component",
            "dataId" => "precio",
            "x" => 0,
            "y" => 0,
            "w" => 12,
            "h" => 4
        ];

        $ComponentRegister = json_decode(Storage::get('statistics/dashboard-' . $parentId . '.json'), true);
        array_push($ComponentRegister["data"], $componentData);
        Storage::put('statistics/dashboard-' . $parentId . '.json', json_encode($ComponentRegister));
    }
}
