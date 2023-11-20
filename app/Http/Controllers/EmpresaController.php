<?php

namespace App\Http\Controllers;

use App\Models\Empresa; 
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'string|max:100',
            ]);

            $empresa = Empresa::create([ 
                'nombre' => $request->nombre,
            ]);

            return response()->json([
                'msg' => 'empresa creada con éxito',
                'empresa' => $empresa->toArray(), 
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nombre' => 'string|max:100',
            ]);
            $empresa = Empresa::find($id);
            if (!$empresa) {
                return response()->json(['msg' => 'Empresa no encontrada'], 404);
            }
            $empresa->nombre = $request->nombre;
            $empresa->save();
            return response()->json([
                'msg' => 'Empresa actualizada con éxito',
                'empresa' => $empresa->toArray(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
