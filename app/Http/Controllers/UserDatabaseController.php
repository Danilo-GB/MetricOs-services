<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserDatabaseController extends Controller
{


    public function makeQuery(Request $request)
    {
        return env('DB_USER_CONNECTION') === "mongodb" ? $this->getMongoDB($request) : $this->getMySQL($request);
    }
    private function getMongoDB($query)
    {
        $queryResponse = DB::connection('userdatabase')->table($query->qFrom)->select($query->qSelect)->orderBy($query->qOrderBy, $query->qOrderByType)->get();
        return response()->json($queryResponse);
    }
    private function getMySQL($query)
    {
        $queryResponse = DB::connection('userdatabase')->select($query->dataQuery);
        return response()->json($queryResponse);
    }

    public function getCurrentDb()
    {
        $DBinfo = [
            'DB_Name' => env('DB_USER_DATABASE'),
            'DB_Driver' => env('DB_USER_CONNECTION'),
        ];
        return response()->json($DBinfo);
    }

    public function switchDatabase(Request $request)
    {
        $data = [
            'DB_USER_CONNECTION' => $request->dbType,
            'DB_USER_HOST' => $request->dbHost,
            'DB_USER_PORT' => $request->dbPort,
            'DB_USER_DATABASE' => $request->dbName,
            'DB_USER_USERNAME' => $request->dbUsername,
            'DB_USER_PASSWORD' => $request->dbPassword
        ];
        $this->update_env($data);
    }

    public function addDatabase(Request $request)
    {
        $data = [
            'type' => $request->dbType,
            'host' => $request->dbHost,
            'port' => $request->dbPort,
            'database' => $request->dbName,
            'username' => $request->dbUsername,
            'password' => $request->dbPassword
        ];

        $DBregister = json_decode(Storage::get('databaseRegister.json'), true);
        array_push($DBregister["databases"], $data);
        Storage::put('databaseRegister.json', json_encode($DBregister));
    }
    public function deleteDatabase(Request $request)
    {
        $DBregister = json_decode(Storage::get('databaseRegister.json'), true);
        array_splice($DBregister["databases"], $request->dbId, 1);
        Storage::put('databaseRegister.json', json_encode($DBregister));
    }


    public function readDatabases()
    {
        $DBregister = json_decode(Storage::get('databaseRegister.json'), true);
        return $DBregister["databases"];
    }

    private function update_env($data = []): void
    {

        $path = base_path('.env');

        if (file_exists($path)) {
            foreach ($data as $key => $value) {
                file_put_contents($path, str_replace(
                    $key . '=' . env($key),
                    $key . '=' . $value,
                    file_get_contents($path)
                ));
            }
        }
    }
}
