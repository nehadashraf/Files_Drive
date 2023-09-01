<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Drive;
use Illuminate\Http\Request;

class DriveController extends Controller
{

    public function index()
    {
        $drive = Drive::all();
        $message = [
            'data' => $drive,
            'message' => 'get all Data',
            'status' => 200
        ];
        return response($message, 200);
    }
    public function store(Request $request)
    {
        $size = 3 * 1024;
        $request->validate([
            'title' => "required|min:3|max:20|string",
            'description' => "required|min:10|max:50|string",
            'inputFile' => "required|file|max:$size|mimes:png,jpg,pdf,jif,txt"
        ]);

        $driveData = $request->file("inputFile");
        if ($request->hasFile('inputFile')) {
            $driveName = time() . $driveData->getClientOriginalName();
            $location = public_path("./drives/");
            $driveData->move($location, $driveName);
        }
        $drive = Drive::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $driveName,

        ]);
        $drive->save();
        $message = [
            'data' => $drive,
            'Message' => 'Creating Done',
            'status' => 201
        ];
        return response($message, 200);
    }
    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $size = 3 * 1024;
        $request->validate([
            'title' => "required|min:3|max:20|string",
            'description' => "required|min:10|max:50|string",
            'inputFile' => "file|max:$size|mimes:png,jpg,pdf,jif,txt"
        ]);
        $drive = Drive::find($id);
        $drive->title = $request->title;
        $drive->description = $request->description;
        //file code
        $driveData = $request->file("inputFile");
        if ($driveData != null) {
            $driveName1 = time() . $driveData->getClientOriginalName();
            $location = public_path("./drives/");
            $driveData->move($location, $driveName1);

            $oldFile = $drive->file;
            $filePathName = public_path() . "/drives/" . $oldFile;
            unlink($filePathName);
        } else {
            $driveName = $drive->file;
        }

        $drive->file = $driveName;
        $drive->save();
        $message = [
            'data' => $drive,
            'message' => 'updated Data',
            'status' => 201
        ];
        return response($message, 200);
    }
    public function destroy($id)
    {
        $drive = Drive::find($id);
        //delete file from public folder
        $oldFile = $drive->file;
        $filePathName = public_path() . "/drives/" . $oldFile;
        unlink($filePathName);
        $drive->delete();
        $message = [
            'data' => $drive,
            'message' => 'deleted Data',
            'status' => 201
        ];
        return response($message, 200);
    }
}
