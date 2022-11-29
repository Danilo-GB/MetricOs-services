<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponentController extends Controller
{

    public function saveComponent(Request $request)
    {
        $componentData = [
            'i' => intval($request->i),
            'parentId' => $request->parentId,
            'component' => 'chart',
            'dataQuery' => $request->dataQuery,
            'qSelect' => $request->qSelect,
            'qFrom' => $request->qFrom,
            'qOrderBy' =>  $request->qOrderBy,
            'qOrderByType' =>  $request->qOrderByType,
            "type" => $request->type,
            "zoom" => $request->zoom,
            "title" => $request->title,
            "xaxis" => $request->xaxis,
            "yaxis" => $request->yaxis,
            'x' => intval($request->x),
            'y' => intval($request->y),
            'w' => intval($request->w),
            'h' => intval($request->h),

        ];

        $ComponentRegister = json_decode(Storage::get('dashboards/dashboard-' . $request->parentId . '.json'), true);
        array_push($ComponentRegister["data"], $componentData);
        Storage::put('dashboards/dashboard-' . $request->parentId . '.json', json_encode($ComponentRegister));
    }
    public function readComponents(Request $request)
    {
        $ComponentRegister = json_decode(Storage::get('dashboards/dashboard-' . $request->dashboardId . '.json'), true);
        return $ComponentRegister["data"];
    }
    public function readComponent(Request $request)
    {
        $ComponentRegister = json_decode(Storage::get('dashboards/dashboard-' . $request->dashboardId . '.json'), true);
        $Component = $this->findObjectById($ComponentRegister["data"], $request->componentId);
        return $Component;
    }

    public function moveComponents(Request $request)
    {
        $ComponentRegister = json_decode(Storage::get('dashboards/dashboard-' . $request->parentId . '.json'), true);
        $ComponentRegister["data"][$request->i]["x"] = intval($request->newX);
        $ComponentRegister["data"][$request->i]["y"] = intval($request->newY);
        Storage::put('dashboards/dashboard-' . $request->parentId . '.json', json_encode($ComponentRegister));
    }
    public function resizeComponents(Request $request)
    {
        $ComponentRegister = json_decode(Storage::get('dashboards/dashboard-' . $request->parentId . '.json'), true);
        $ComponentRegister["data"][$request->i]["h"] = intval($request->newH);
        $ComponentRegister["data"][$request->i]["w"] = intval($request->newW);
        Storage::put('dashboards/dashboard-' . $request->parentId . '.json', json_encode($ComponentRegister));
    }
    private function findObjectById($array, $id)
    {

        foreach ($array as $element) {
            if ($element["id"] == $id) {
                return $element;
            }
        }
        return 'Not found';
    }
}
