<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadRequest;
use App\Models\Read;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reads = Read::with('vehicle')->get()->all();

        if (sizeof($reads) === 0) {
            return response()->json([
                'message' => 'No Reads found',
            ], 200);
        }

        return response()->json($reads, 200);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ReadRequest $request)
    {
        $read = Read::create($request->all());

        return response()->json($read, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $read = Read::with('vehicle')->where('id', '=' ,$id)->first();

        if (!$read) {
            return response()->json([
                'message' => 'Read not found',
            ], 200);
        }

        return response()->json($read, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ReadRequest $request,  $id)
    {
        $read = Read::find($id);

        if (!$read) {
            return response()->json([
                'message' => 'Read not found',
            ], 200);
        }

        $read->update($request->all());

        return response()->json($read, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $read = Read::find($id);

        if (!$read) {
            return response()->json([
                'message' => 'Read not found',
            ], 200);
        }

        $read->delete();

        return response()->json([], 204);
    }
}
