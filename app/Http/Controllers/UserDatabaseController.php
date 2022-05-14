<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserDatabaseController extends Controller{

    
    public function makeQuery(Request $request){

        $data = (isset($request->data)) ? $request->data : "*";
        $where = (isset($request->where)) ? $request->where : "true";
        $orderBy = (isset($request->orderBy)) ? $request->orderBy : "true";
        $orderType = (isset($request->orderType)) ? $request->orderType : "ASC";
        $groupBy = (isset($request->groupBy)) ? $request->groupBy : "";
        $limit = (isset($request->limit)) ? ' limit '.$request->limit : '';
        
        $queryResponse = DB::connection('userdatabase')
            ->select(
                'select '.$data
                .' from '.$request->table
                .' where '.$where
                .' order by '.$orderBy
                .' '.$orderType
                .$limit
            );
        return response()->json($queryResponse);
    }

    public function switchDatabase(Request $request){
        $data = [
            'DB_USER_HOST' => $request->dbHost,
            'DB_USER_PORT'=> $request->dbPort,
            'DB_USER_DATABASE'=> $request->dbName,
            'DB_USER_USERNAME'=> $request->dbUsername,
            'DB_USER_PASSWORD'=> $request->dbPassword
          ];
          $this->update_env($data);
        
    }

    public function addDatabase(Request $request){
        $contents = Storage::put('asd.txt','writeeen');
        return "hihi";
    }

    private function update_env( $data = [] ) : void
    {  

        $path = base_path('.env');

        if (file_exists($path)) {
            foreach ($data as $key => $value) {
                file_put_contents($path, str_replace(
                    $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
                ));
            }
        }

    }
}