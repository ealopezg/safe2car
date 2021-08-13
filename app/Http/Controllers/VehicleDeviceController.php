<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleDeviceController extends Controller
{
    public function alive(Request $request){
        $validated = $request->validate([
            'system' => ['required','boolean'],
            'buzzer' => ['required','boolean'],
            'cut_off_power' => ['required','boolean'],
        ]);
        $vehicle = $request->user();
        $vehicle->system = $validated['system'];
        $vehicle->buzzer = $validated['buzzer'];
        $vehicle->cut_off_power = $validated['cut_off_power'];
        $vehicle->last_connected = now();
        $vehicle->save();
        return response('OK');
    }

    public function ok(Request $request){
        $validated = $request->validate([
            'id' => ['required'],
            'action' => ['required'],
            'added_at' => ['required','date']
        ]);
        $vehicle = $request->user();
        $status = $vehicle->statuses()->where('id',$validated['id'])->firstOrFail();
        $status->received_ok = true;
        $status->save();
        return response('OK');
    }

    public function res(Request $request){
        $validated = $request->validate([
            'id' => ['required'],
            'action' => ['required'],
            'added_at' => ['required','date'],
            'args' => ['required','array']
        ]);
    }
}
