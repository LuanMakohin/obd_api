<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadRequest;
use App\Models\Read;

class ReadController extends Controller
{
    /**
     * Exibe uma lista dos recursos.
     */
    public function index()
    {
        $reads = Read::with('vehicle')->get()->all();

        if (sizeof($reads) === 0) {
            return response()->json([
                'message' => 'Nenhuma leitura encontrada',
            ], 200);
        }

        return response()->json($reads, 200);

    }


    /**
     * Armazena um novo recurso criado.
     */
    public function store(ReadRequest $request)
    {
        $read = Read::create($request->all());

        return response()->json($read, 201);
    }

    /**
     * Exibe o recurso especificado.
     */
    public function show($id)
    {
        $read = Read::with('vehicle')->where('id', '=' ,$id)->first();

        if (!$read) {
            return response()->json([
                'message' => 'Leitura não encontrada',
            ], 200);
        }

        return response()->json($read, 200);
    }


    /**
     * Atualiza o recurso especificado no armazenamento.
     */
    public function update(ReadRequest $request,  $id)
    {
        $read = Read::find($id);

        if (!$read) {
            return response()->json([
                'message' => 'Leitura não encontrada',
            ], 200);
        }

        $read->update($request->all());

        return response()->json($read, 200);
    }

    /**
     * Remove o recurso especificado do armazenamento.
     */
    public function destroy($id)
    {
        $read = Read::find($id);

        if (!$read) {
            return response()->json([
                'message' => 'Leitura não encontrada',
            ], 200);
        }

        $read->delete();

        return response()->json([], 204);
    }
}
