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
use App\Models\Report_River;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OneSignal;

class ReportRiverController extends Controller
{

    public function report($id, Request $request)
    {
        $save = Report_River::where('id', $id)->update([
            'status' => $request->status,
            'photo' => $request->photo,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        if ($save) {
            return response()->json(["isError" => false, "message" => "Sukses Lapor"], 200);
        } else {
            return response()->json(["isError" => true, "message" => "Gagal Lapor"], 400);
        }
    }

    public function getMyTask()
    {
        $now = date('Y-m-d');
        $report = Report_River::query()->with('river')->get();

        return $report;
    }
}
