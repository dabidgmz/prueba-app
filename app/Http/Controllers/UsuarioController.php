<?php

namespace App\Http\Controllers;


use App\Models\Usuario;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerificacionCorreo;

class UsuarioController extends Controller
{

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:100',
                'apellido' => 'required|string|max:100',
                'email' => 'required|string|email|max:30|unique:usuarios',
                'matricula' => 'required|string|max:10',
                'departamento' => 'required|string|max:100',
                'celular' => 'required|string|max:10',
                'estado' => 'required|boolean',
                'contrasena' => 'required|string|max:20',
            ]);

            $token = Str::random(5);

            $usuario = Usuario::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'matricula' => $request->matricula,
                'departamento' => $request->departamento,
                'celular' => $request->celular,
                'estado' => $request->estado,
                'token' => $token,
                'contrasena' => bcrypt($request->contrasena),
            ]);

            $this->enviarCorreoVerificacion($usuario);
            return response()->json([
                'message' => 'Usuario creado con éxito. Se ha enviado un correo electrónico para la verificación.',
                'usuario' => $usuario->toArray(),
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|string|email|max:30|unique:usuarios,email,' . $usuario->id,
            'matricula' => 'required|string|max:10',
            'departamento' => 'required|string|max:100',
            'celular' => 'required|string|max:10',
            'estado' => 'required|boolean',
            'contrasena' => 'sometimes|string|max:20'
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'matricula' => $request->matricula,
            'departamento' => $request->departamento,
            'celular' => $request->celular,
            'estado' => $request->estado,
            'contrasena' => $request->contrasena ? bcrypt($request->contrasena) : $usuario->contrasena,
        ]);

        return response()->json(['message' => 'Usuario actualizado con éxito.'], 200);
    }

    private function enviarCorreoVerificacion($usuario)
    {
        $token = $usuario->token;

        try {
            if (View::exists('emails.verificacion')) {
                Mail::to($usuario->email)->send(new VerificacionCorreo($token));
                return response()->json(['message' => 'Correo de verificación enviado con éxito.'], 200);
            } else {
                return response()->json(['error' => 'La vista de correo de verificación no existe.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al enviar el correo de verificación.'], 500);
        }
    }
    


    public function verificarToken($token)
{
    $usuario = Usuario::where('token', $token)->first();

    if ($usuario) {
        $usuario->update(['estado' => true]);

        return view('verificacion_exitosa');
    } else {
        return view('verificacion_fallida');
    }
}
}
