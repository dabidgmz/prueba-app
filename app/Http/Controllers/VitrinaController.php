<?php

namespace App\Http\Controllers;
use App\Models\Vitrina;
use Illuminate\Http\Request;

class VitrinaController extends Controller
{
    public function index(){
        $vitrina = Vitrina::all();
        return response()->json(['vitrinas'=>$vitrina],200);
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'string|max:100',
            'descripcion' => 'string|max:255',
            'empresa_id' => 'exists:empresas,id',
        ]);

        $vitrina = Vitrina::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'empresa_id' => $request->empresa_id,
        ]);

        return response()->json(['msg' => 'Vitrina creada con éxito', 'vitrina' => $vitrina], 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'string|max:100',
            'descripcion' => 'string|max:255',
            'empresa_id' => 'exists:empresas,id',
        ]);

        $vitrina = Vitrina::find($id);

        if (!$vitrina) {
            return response()->json(['msg' => 'Vitrina no encontrada'], 404);
        }

        $vitrina->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'empresa_id' => $request->empresa_id,
        ]);

        return response()->json(['msg' => 'Vitrina actualizada con éxito', 'vitrina' => $vitrina], 200);
    }
}
