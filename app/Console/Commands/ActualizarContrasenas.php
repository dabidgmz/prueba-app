<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;

class ActualizarContrasenas extends Command
{
    protected $signature = 'contrasenas:actualizar';

    protected $description = 'Actualizar contraseñas existentes';

    public function handle()
    {
        $usuarios = Usuario::all();

        foreach ($usuarios as $usuario) {
            $usuario->update(['contrasena' => bcrypt($usuario->contrasena)]);
        }

        $this->info('Contraseñas actualizadas con éxito.');
    }
}
