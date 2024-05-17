<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManufacturerRequest;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $manufacturers = Manufacturer::get()->all();

        if (sizeof($manufacturers) === 0) {
            return response()->json([
                'message' => 'No Manufacturers found',
            ], 200);
        }

        return response()->json($manufacturers, 200);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ManufacturerRequest $request)
    {
        $manufacturer = Manufacturer::create($request->all());

        return response()->json($manufacturer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json([
                'message' => 'Manufacturer not found',
            ], 200);
        }

        return response()->json($manufacturer, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ManufacturerRequest $request,  $id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json([
                'message' => 'Manufacturer not found',
            ], 200);
        }

        $manufacturer->update($request->all());

        return response()->json($manufacturer, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json([
                'message' => 'Manufacturer not found',
            ], 200);
        }

        $manufacturer->delete();

        return response()->json([], 204);
    }
}
