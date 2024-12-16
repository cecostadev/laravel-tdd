<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui você pode registrar rotas da API para sua aplicação. Essas rotas
| são carregadas pelo RouteServiceProvider com o middleware 'api'.
|
*/

Route::get('/users', [ UserController::class, 'index' ]);