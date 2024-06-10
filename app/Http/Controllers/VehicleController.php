<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\User;
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
                'message' => 'Nenhum veículo encontrado',
            ], 200);
        }

        return response()->json($vehicles, 200);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {
        $user = User::find($request->user_id);
        $vehicle = Vehicle::create($request->except('user_id'));

        $user->vehicles()->attach($vehicle->id);

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
                'message' => 'Veículo não encontrado',
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
                'message' => 'Veículo não encontrado',
            ], 200);
        }

        $oldUser = $vehicle->user->id;
        $oldUser->vehicles()->detach($vehicle->id);

        $newUser = User::find($request->user_id);
        $vehicle->update($request->except('user_id'));

        $newUser->vehicles()->attach($vehicle->id);

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
                'message' => 'Veículo não encontrado',
            ], 200);
        }

        $user = $vehicle->user->id;
        $user->vehicles()->detach($vehicle->id);

        $vehicle->delete();

        return response()->json([], 204);
    }
}
