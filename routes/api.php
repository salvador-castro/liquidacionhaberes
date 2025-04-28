<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Acá podés registrar las rutas para tu API.
| Normalmente están protegidas por el middleware "api".
|
*/

Route::middleware('api')->get('/ping', function () {
    return response()->json(['message' => 'pong']);
});
