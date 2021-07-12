<?php

namespace App\Http\Controllers;

use App\Http\Requests\RiverHeightRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\RiverHeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiverHeightController extends Controller
{
 
    public function report(RiverHeightRequest $request)
    {
        $request->validated();
 
        $report = new RiverHeight();
        $report->river_id = $request->river_id;
        $report->height = $request->height;
        $report->status = $request->status;

        $save = $report->save();

        if($save){
            return response()->json(["isError" => false,"message" => "Sukses Lapor"] ,200);
        } else {
            return response()->json(["isError" => true,"message" => "Gagal Lapor"] ,400);
        }
    }

    public function getRiverHeight($id)
    {
        $report = RiverHeight::query()->where('river_id',$id)->OrderBy('created_at','desc')->first();

        return $report;
    }
}