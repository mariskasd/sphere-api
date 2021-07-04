<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportZoneController extends Controller
{
 
    public function report(ReportRequest $request)
    {
        $request->validated();
 
        $report = new Report;
        $report->title = $request->title;
        $report->user_id = Auth::user()->id;
        $report->category = $request->category;
        $report->latitude = $request->latitude;
        $report->longitude = $request->longitude;
        $report->address = $request->address;
        $report->description = $request->description;
        $report->image = $request->image;

        // if ($request->image != null) {
        //     $path = Storage::disk('public')->put('images_' . Auth::user()->id, $request->file('image'));
        //     if (!$path) {
        //         return response('', 422);
        //     }
        //     $report->image = $path;
        // }else{
        //     return response()->json(["message" => "Gagal Upload Image"], 400);
        // }

        $save = $report->save();

        if($save){
            return response()->json(["message" => "Sukses Lapor"] ,200);
        } else {
            return response()->json(["message" => "Gagal Lapor"] ,400);
        }
    }

    public function getMyReport(Request $request)
    {
        $report = Report::query()->where('user_id',Auth::user()->id)->get();

        // $host = request()->getSchemeAndHttpHost();

        // foreach ($report as $reports){
        //     $reports->image = $host.'/storage' . '/' . $reports->image;
        // }

        return $report;
    }
}