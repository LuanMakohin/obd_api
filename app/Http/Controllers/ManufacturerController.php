<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManufacturerRequest;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    /**
     * Exibe uma lista dos recursos.
     */
    public function index()
    {
        $manufacturers = Manufacturer::get()->all();

        if (sizeof($manufacturers) === 0) {
            return response()->json([
                'message' => 'Nenhum fabricante encontrado',
            ], 200);
        }

        return response()->json($manufacturers, 200);

    }


    /**
     * Armazena um novo recurso criado.
     */
    public function store(ManufacturerRequest $request)
    {
        $manufacturer = Manufacturer::create($request->all());

        return response()->json($manufacturer, 201);
    }

    /**
     * Exibe o recurso especificado.
     */
    public function show($id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json([
                'message' => 'Fabricante não encontrado',
            ], 200);
        }

        return response()->json($manufacturer, 200);
    }


    /**
     * Atualiza o recurso especificado.
     */
    public function update(ManufacturerRequest $request,  $id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json([
                'message' => 'Fabricante não encontrado',
            ], 200);
        }

        $manufacturer->update($request->all());

        return response()->json($manufacturer, 200);
    }

    /**
     * Remove o recurso especificado do armazenamento.
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json([
                'message' => 'Fabricante não encontrado',
            ], 200);
        }

        $manufacturer->delete();

        return response()->json([], 204);
    }
}
