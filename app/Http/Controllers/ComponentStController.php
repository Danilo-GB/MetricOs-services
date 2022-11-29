<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponentStController extends Controller
{

    public function saveStComponent(Request $request)
    {
        $componentData = [
            'i' => intval($request->i),
            'parentId' => $request->parentId,
            'dataQuery' => $request->dataQuery,
            'qSelect' => $request->qSelect,
            'qFrom' => $request->qFrom,
            'qOrderBy' =>  $request->qOrderBy,
            'qOrderByType' =>  $request->qOrderByType,
            "type" => $request->type,
            "title" => $request->title,
            "prefix" => $request->prefix,
            "sufix" => $request->sufix,
            "dataId" => $request->dataId,
            'x' => intval($request->x),
            'y' => intval($request->y),
            'w' => intval($request->w),
            'h' => intval($request->h),

        ];

        $ComponentRegister = json_decode(Storage::get('statistics/dashboard-' . $request->parentId . '.json'), true);
        array_push($ComponentRegister["data"], $componentData);
        Storage::put('statistics/dashboard-' . $request->parentId . '.json', json_encode($ComponentRegister));
    }
    public function readStComponents(Request $request)
    {
        $ComponentRegister = json_decode(Storage::get('statistics/dashboard-' . $request->dashboardId . '.json'), true);
        return $ComponentRegister["data"];
    }


    public function moveStComponents(Request $request)
    {
        $ComponentRegister = json_decode(Storage::get('statistics/dashboard-' . $request->parentId . '.json'), true);
        $ComponentRegister["data"][$request->i]["x"] = intval($request->newX);
        $ComponentRegister["data"][$request->i]["y"] = intval($request->newY);
        Storage::put('statistics/dashboard-' . $request->parentId . '.json', json_encode($ComponentRegister));
    }
    public function resizeStComponents(Request $request)
    {
        $ComponentRegister = json_decode(Storage::get('statistics/dashboard-' . $request->parentId . '.json'), true);
        $ComponentRegister["data"][$request->i]["h"] = intval($request->newH);
        $ComponentRegister["data"][$request->i]["w"] = intval($request->newW);
        Storage::put('statistics/dashboard-' . $request->parentId . '.json', json_encode($ComponentRegister));
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
