<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPasswordRequest;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\ReportRequest;
use App\Models\Notif;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
use App\Models\Report;
use App\Models\Report_Solving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OneSignal;

class ReportZoneController extends Controller
{

    public function report(ReportRequest $request)
    {
        $request->validated();

        $report = new Report();
        $report->title = $request->title;
        $report->user_id = Auth::user()->id;
        $report->category = $request->category;
        $report->latitude = $request->latitude;
        $report->longitude = $request->longitude;
        $report->address = $request->address;
        $report->description = $request->description;
        $report->image = $request->image;
        $report->solved = false;

        $save = $report->save();

        if ($save) {
            $user = User::where('type', 'admin')->first();
            $userId = [strval($user->player)];

            OneSignal::sendNotificationToUser(
                "Laporan Baru",
                $userId,
                $url = null,
                $data = ["id" => $report->id],
                $buttons = null,
                $schedule = null
            );

            Notif::create([
                'user_id' => $user->id,
                'report_id' => $report->id,
                'message' => "Laporan Baru",
                'status' => "Baru"
            ]);

            return response()->json(["isError" => false, "message" => "Sukses " . $user->id], 200);
        } else {
            return response()->json(["isError" => true, "message" => "Gagal"], 400);
        }
    }

    public function assignReport($id, Request $request)
    {
        $save = Report::where('id', $id)->update([
            'assigned_id' => $request->assigned_id,
        ]);

        if ($save) {

            $player = User::query()->where('id', $request->assigned_id)->first();

            $userId = [strval($player->player)];

            OneSignal::sendNotificationToUser(
                "Tugas Baru",
                $userId,
                $url = null,
                $data = ["id" => $id],
                $buttons = null,
                $schedule = null
            );

            Notif::create([
                'user_id' => $request->assigned_id,
                'report_id' => $id,
                'message' => "Tugas Baru",
                'status' => "Baru"
            ]);

            return response()->json(["isError" => false, "message" => "Sukses"], 200);
        } else {
            return response()->json(["isError" => true, "message" => "Gagal"], 400);
        }
    }

    public function getTeknisi()
    {
        $teknisi = User::where('type', 'teknisi')->get();

        return response()->json($teknisi);
    }

    public function getMyReport(Request $request)
    {
        $report = Report::query()->where('user_id', Auth::user()->id)->get();

        return $report;
    }

    public function getAllReport(Request $request)
    {
        $report = Report::query()->with('solving')->with('user')->get();

        return $report;
    }

    public function getReportById($id)
    {
        $report = Report::query()->where('id', $id)->with('solving')->with('user')->get();

        return $report;
    }

    public function getUnassignedReport()
    {
        $report = Report::query()->with('solving')->whereNull('assigned_id')->get();

        return $report;
    }

    public function solvedTask($id, Request $request)
    {
        $save = Report::where('id', $id)->update([
            'solved' => true,
        ]);

        $solving = Report_Solving::create([
            'reports_id' => $id,
            'photo' => $request->photo,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        if ($save && $solving) {
            return response()->json(["isError" => false, "message" => "Sukses"], 200);
        } else {
            return response()->json(["isError" => true, "message" => "Gagal"], 400);
        }
    }

    public function getMyTask()
    {
        $report = Report::query()->with('solving')->with('user')->where('assigned_id', Auth::user()->id)->get();

        return $report;
    }
}
