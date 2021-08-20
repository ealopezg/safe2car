<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use App\Events\StatusSended;
use Illuminate\Support\Facades\Redis;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Vehicle/Index', [
            'vehicles' => $request->user()->vehicles->map(function ($vehicle){
                return [
                    'id' => $vehicle->id,
                    'license_plate' => $vehicle->license_plate,
                    'vin' => $vehicle->vin,
                    'make' => $vehicle->make,
                    'model' => $vehicle->model,
                    'year' => $vehicle->year,
                    'color' => $vehicle->color,
                    'owner' => $vehicle->pivot->owner,
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => ['required','max:8'],
            'vin' => ['required','max:8'],
            'make' => ['required','max:255'],
            'model' => ['required','max:255'],
            'year' => ['required','max:4'],
            'color' => ['required','max:255'],
        ]);
        $validated['vin'] = strtoupper($validated['vin']);
        $validated['license_plate'] = strtoupper($validated['license_plate']);

        $request->user()->vehicles()->create($validated,['owner' => true]);
        return Redirect::route('vehicle.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $vehicle = $request->user()->vehicles()->where('vehicle_id',$id)->firstOrFail();
        return Inertia::render('Vehicle/Show', [
            'vehicle' => [
                'id' => $vehicle->id,
                'license_plate' => $vehicle->license_plate,
                'vin' => $vehicle->vin,
                'make' => $vehicle->make,
                'model' => $vehicle->model,
                'year' => $vehicle->year,
                'color' => $vehicle->color,
                'owner' => $vehicle->pivot->owner,
                'photos' => $vehicle->photos()->latest()->get()->map(function ($photo) use ($vehicle){
                    return [
                        'id' => $photo->id,
                        'url' =>  route('vehicle.downloadPhoto', ['id' => $vehicle->id,'photo_id' => $photo->id]),
                        'added_at' => $photo->added_at,
                    ];
                }),
                'locations' => $vehicle->locations()->latest()->get()->map(function ($location){
                    return [
                        'id' => $location->id,
                        'lat' => $location->latitude,
                        'lng' => $location->longitude,
                        'added_at' => $location->added_at
                    ];
                }),
                'statuses' => $vehicle->statuses()->latest()->get()->map(function ($status) use ($vehicle){
                    $statusable = [];
                    if($status->statusable){
                        if($status->statusable_type == "App\Models\Location"){
                            $statusable = [
                                'lat' => $status->statusable->latitude,
                                'lng' => $status->statusable->longitude
                            ];
                        }
                        else if($status->statusable_type == "App\Models\Photo"){
                            $statusable = [
                                'id' => $status->statusable->id,
                                'url' =>  route('vehicle.downloadPhoto', ['id' => $vehicle->id,'photo_id' => $status->statusable->id]),
                                'added_at' => $status->statusable->added_at,
                            ];
                        }
                    }

                    return [
                        'id' => $status->id,
                        'action' => $status->action,
                        'comment' => $status->comment,
                        'added_at' => $status->added_at,
                        'args' => $status->args,
                        'received_ok' => $status->received_ok,
                        'received_response' => $status->received_response,
                        'statusable' => $statusable
                    ];
                }),
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'action';
    }


    public function action($id,Request $request){
        $vehicle = $request->user()->vehicles()->where('vehicle_id',$id)->firstOrFail();

        $validated = $request->validate([
            'action' => ['required']
        ]);
        if($validated['action'] == 'call'){
            $validated['args'] = array('phone' => $request->user()->phone);
        }
        $validated['added_at'] = now();
        $status = new \App\Models\Status($validated);
        $status->vehicle()->associate($vehicle);
        $status->save();
        event(new \App\Events\StatusSended($status));
        return $status;
    }

    public function generateApiToken($id,Request $request){
        $vehicle = $request->user()->vehicles()->where('vehicle_id',$id)->firstOrFail();
        $token = $vehicle->createToken('device')->plainTextToken;
        return $token;
    }

    public function downloadPhoto($id,$photo_id,Request $request){
        $vehicle = $request->user()->vehicles()->where('vehicle_id',$id)->firstOrFail();
        $photo = $vehicle->photos()->where('id',$photo_id)->firstOrFail();
        return Storage::download($photo->path);
    }

    public function state($id,Request $request){
        $vehicle = $request->user()->vehicles()->where('vehicle_id',$id)->firstOrFail();
        return [
            'system' => $vehicle->system,
            'buzzer' => $vehicle->buzzer,
            'cut_off_power' => $vehicle->cut_off_power,
        ];
    }
}
