<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponentController extends Controller
{

    public function saveComponent(Request $request)
    {
        $componentData = [
            'id' => $request->id,
            'parentId' => $request->parentId,
            'component' => $request->component,
            'dataQuery' => $request->dataQuery
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
