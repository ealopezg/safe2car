<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

use App\Events\StatusSended;
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
                'photos' => $vehicle->photos->map(function ($photo){
                    return [
                        'id' => $photo->id,
                        'data' => $photo->data,
                        'added_at' => $photo->added_at,
                    ];
                }),
                'locations' => $vehicle->locations->map(function ($location){
                    return [
                        'id' => $location->id,
                        'lat' => $location->latitude,
                        'lng' => $location->longitude,
                        'added_at' => $location->added_at
                    ];
                }),
                'statuses' => $vehicle->statuses->map(function ($status){
                    return [
                        'id' => $status->id,
                        'action' => $status->action,
                        'comment' => $status->comment,
                        'added_at' => $status->added_at
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
}
