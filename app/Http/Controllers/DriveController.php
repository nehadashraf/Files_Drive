<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DriveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function allDrives()
    {
        $drives = Drive::all();
        return view('drives.allDrives')->with("drives", $drives);
    }
    public function index()
    {
        $userId = Auth()->user()->id;
        $drives = Drive::where("user_id", '=', $userId)->get();
        return view("drives.index")->with('drives', $drives);
    }
    public function publicFiles()
    {
        $drives = DB::table('publicfileswithuserdata')->get();
        return view("drives.public")->with('drives', $drives);
    }
    public function changeStatus($id)
    {
        $drive = Drive::find($id);
        if ($drive->status == 'private') {
            $drive->status = 'public';
            $drive->save();
            return redirect()->route("drive.index")->with("done", "Make File public");
        } else {
            $drive->status = 'private';
            $drive->save();
            return redirect()->route("drive.index")->with("done", "Make File Private");
        }
    }

    public function create()
    {
        return view("drives.create");
    }

    public function store(Request $request)
    {
        $size = 3 * 1024;
        $request->validate([
            'title' => "required|min:3|max:20|string",
            'description' => "required|min:10|max:50|string",
            'inputFile' => "required|file|max:$size|mimes:png,jpg,pdf,jif,txt"
        ]);
        $drive = new Drive();
        $drive->title = $request->title;
        $drive->description = $request->description;
        //file code
        $driveData = $request->file("inputFile");
        $driveName = time() . $driveData->getClientOriginalName();

        $location = public_path("./drives/");

        $driveData->move($location, $driveName);

        $drive->file = $driveName;
        $userId = Auth()->user()->id;
        $drive->user_id = $userId;

        $drive->save();
        return redirect()->back()->with("done", "uploading file done");
    }

    public function show($id)
    {
        $drive = Drive::find($id);
        return view('drives.show')->with('drive', $drive);
    }
    public function showPublic($id)
    {
        $drives = DB::table('publicfileswithuserdata')->where('driveId', $id)->first();
        return view('drives.showPublic')->with('drive', $drives);
    }

    public function edit($id)
    {
        $drive = Drive::find($id);
        return view('drives.edit')->with('drive', $drive);
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
            $driveName = time() . $driveData->getClientOriginalName();
            $location = public_path("./drives/");
            $driveData->move($location, $driveName);

            $oldFile = $drive->file;
            $filePathName = public_path() . "/drives/" . $oldFile;
            unlink($filePathName);
        } else {
            $driveName = $drive->file;
        }
        $drive->file = $driveName;
        $drive->save();

        return redirect()->route('drive.index')->with("done", "File Updated");
    }

    public function destroy($id)
    {
        $drive = Drive::find($id);
        //delete file from public folder
        $oldFile = $drive->file;
        $filePathName = public_path() . "/drives/" . $oldFile;
        unlink($filePathName);
        $drive->delete();
        return redirect()->route('drive.index')->with("done", "File Deleted");
    }
    public function download($id)
    {
        $drive = Drive::find($id);
        $driveName = $drive->file;
        $filePathName = public_path() . "/drives/" . $driveName;
        return response()->download($filePathName);
    }
}
