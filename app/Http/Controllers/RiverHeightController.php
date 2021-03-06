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
use App\Models\River;
use App\Models\Notif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OneSignal;

class RiverHeightController extends Controller
{

    public function report(RiverHeightRequest $request)
    {
        $request->validated();

        $lastStatus = RiverHeight::query()->where('river_id', $request->river_id)->OrderBy('created_at', 'desc')->first();

        $report = new RiverHeight();
        $report->river_id = $request->river_id;
        $report->height = $request->height;
        $report->status = $request->status;

        $save = $report->save();

        if ($save) {
            if (($lastStatus->status != 'Aman' && $request->status == 'Aman') || ($request->status != 'Aman')) {
                $riverName = River::query()->where('id', $request->river_id)->first();

                $message = 'Ketinggian ' . $riverName->name . ' saat ini ' . $request->height . 'cm masuk dalam kategori "' . $request->status . '" !';

                if ($request->status != 'Aman')
                    $message = 'HATI - HATI , Ketinggian ' . $riverName->name . ' saat ini ' . $request->height . 'cm masuk dalam kategori "' . $request->status . '" !';

                OneSignal::sendNotificationToAll(
                    $message,
                    $url = null,
                    $data = null,
                    $buttons = null,
                    $schedule = null
                );

                $user = User::query()->get();
                foreach ($user as $users) {
                    Notif::create([
                        'user_id' => $users->id,
                        'river_id' => $request->river_id,
                        'message' => $message,
                        'status' => $request->status
                    ]);
                }
            }
            return response()->json(["isError" => false, "message" => "Sukses Lapor"], 200);
        } else {
            return response()->json(["isError" => true, "message" => "Gagal Lapor"], 400);
        }
    }

    public function getRiverHeight($id)
    {
        $report = RiverHeight::query()->where('river_id', $id)->with('river')->OrderBy('created_at', 'desc')->first();

        return $report;
    }

    public function getListRiver()
    {
        $river = River::query()->get();

        return $river;
    }

    public function getListNotif()
    {
        $notif = Notif::query()->where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();

        return $notif;
    }
}
