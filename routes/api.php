<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\VitrinaController;

/*
?rutas de usuario
*/
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::get('/verificar/{token}', [UsuarioController::class, 'verificarToken'])->name('verificar.token');
/*
?rutas de empresa
*/
Route::post('/empresas', [EmpresaController::class, 'store']); 
Route::get('/empresas', [EmpresaController::class, 'index']); 
Route::put('/empresas/{id}', [EmpresaController::class, 'update']); 
/*
?rutas de vitrina
*/
Route::get('/vitrinas', [VitrinaController::class, 'index']); 
Route::get('/vitrinas/{id}', [VitrinaController::class, 'show']);
Route::post('/vitrinas', [VitrinaController::class, 'store']);
Route::put('/vitrinas/{id}', [VitrinaController::class, 'update']); 