<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('manufacturer')->get()->all();

        if (sizeof($vehicles) === 0) {
            return response()->json([
                'message' => 'No vehicles found',
            ], 200);
        }

        return response()->json($vehicles, 200);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->all());

        return response()->json($vehicle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vehicle = Vehicle::with('manufacturer', 'reads')->where('id', '=' ,$id)->first();

        if (!$vehicle) {
            return response()->json([
                'message' => 'Vehicle not found',
            ], 200);
        }

        return response()->json($vehicle, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request,  $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'message' => 'Vehicle not found',
            ], 200);
        }

        $vehicle->update($request->all());

        return response()->json($vehicle, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json([
                'message' => 'Vehicle not found',
            ], 200);
        }

        $vehicle->delete();

        return response()->json([], 204);
    }
}
