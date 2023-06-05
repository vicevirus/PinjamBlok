<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:sanctum')->post('/auth', function (Request $request) {
  
        return response()->json(['message' => 'success'], 200);
    
})->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);






Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
    }

    $user = $request->user();

    // Revoke existing API tokens
    $user->tokens()->where('name', 'API Token')->delete();

    // Create a new token
    $token = $user->createToken('API Token');
    $token->accessToken->expires_at = Carbon::now()->addHour();
    $token->accessToken->save();

    return response()->json(['token' => $token->plainTextToken]);
});