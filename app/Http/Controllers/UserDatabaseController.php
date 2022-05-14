<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserDatabaseController extends Controller{

    
    public function makeQuery(Request $request){
        $data = (isset($request->data)) ? $request->data : "*";
        $where = (isset($request->where)) ? $request->where : "true";
        $datos = DB::connection('userdatabase')
            ->select(
                'select '.$data.' from '.$request->table.' where '.$where
            );
        return response()->json($datos);
    }

}