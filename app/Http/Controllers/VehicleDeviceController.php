<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Notification;
use App\Notifications\StatusReceived;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewMovement;

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

    public function getState(Request $request){
        $vehicle = $request->user();
        return response()->json([
            'system' => $vehicle->system,
            'buzzer' => $vehicle->buzzer,
            'cut_off_power' =>  $vehicle->cut_off_power,
        ]);
    }


    public function action(Request $request){
        $validated = $request->validate([
            'id' => ['sometimes'],
            'action' => ['required'],
            'added_at' => ['required','date'],
            'args' => ['sometimes','array']
        ]);
        $vehicle = $request->user();
        $vehicle->last_connected = now();
        $vehicle->save();
        if($validated['action'] == 'motion'){
            unset($validated['id']);
            $status = new \App\Models\Status($validated);
            $status->received_ok = true;
            $status->vehicle()->associate($vehicle);
            $status->save();
            Notification::send($vehicle->users, new StatusReceived($status));
            foreach ($vehicle->users as $u) {
                Mail::to($u)->send(new NewMovement($status));
            }
            return response('OK');
        }
        $status = $vehicle->statuses()->where('id',$validated['id'])->firstOrFail();
        switch ($validated['action']) {
            case 'OK':
                $status->received_ok = true;
                $status->save();
                switch($status->action){
                    case 'system_activate':
                        $vehicle->system = true;
                        $vehicle->save();
                        break;
                    case 'system_deactivate':
                        $vehicle->system = false;
                        $vehicle->save();
                        break;
                    case 'buzzer_activate':
                        $vehicle->buzzer = true;
                        $vehicle->save();
                        break;
                    case 'buzzer_deactivate':
                        $vehicle->buzzer = false;
                        $vehicle->save();
                        break;
                    case 'power_cut_off_activate':
                        $vehicle->cut_off_power = true;
                        $vehicle->save();
                        break;
                    case 'power_cut_off_deactivate':
                        $vehicle->cut_off_power = false;
                        $vehicle->save();
                        break;
                    default:
                        break;
                }
                break;
            case 'photo':
                $photo = new \App\Models\Photo;
                $photo->added_at = \Carbon\Carbon::parse($validated['added_at']);
                $path = $vehicle->id.'_'.$photo->added_at->format('YmdHis').'.jpg';
                $contents = base64_decode($validated['args']['body']);
                Storage::put($path,$contents);
                $photo->path = $path;
                $photo->vehicle()->associate($vehicle);
                $photo->save();
                $status->statusable()->associate($photo);
                $status->received_response = true;
                $status->save();
                Notification::send($vehicle->users, new StatusReceived($status));
                break;

            case 'location':
                $location = new \App\Models\Location([
                    'latitude' => $validated['args']['lat'],
                    'longitude' => $validated['args']['long'],
                    'added_at' => $validated['added_at'],
                ]);
                $location->vehicle()->associate($vehicle);
                $location->save();
                $status->statusable()->associate($location);
                $status->received_response = true;
                $status->save();
                Notification::send($vehicle->users, new StatusReceived($status));
                break;
            default:
                break;
        }

        return response('OK');


    }
}
