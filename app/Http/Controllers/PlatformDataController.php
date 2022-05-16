<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class PlatformDataController extends Controller
{

    public function configureApp(Request $request)
    {
        if (!$request->hasFile('image')) {
            return "no file";
        }
        // Define a name for the file with the correct extension
        $fileExt = $request->image->extension();
        $path = $request->file('image')->storeAs(
            'avatars',
            'bussinesImg.' . $fileExt,
        );

        Storage::put('bussinesProps.json', json_encode($request->bussinesName));

        return $path;
    }
}
