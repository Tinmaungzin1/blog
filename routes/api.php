<?php

use App\Http\Controllers\CategoryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::apiResource('/categories', CategoryApiController::class);

Route::post('/login', function()
{
    $email = request()->email;
    $password = request()->password;

    if(!$email or !$password)
    return response(['msg' => 'email or password required'], 400);

    $user = User::where("email", $email)->first();
    if($user) {
        if(password_verify($password, $user->password)) {
            return $user->createToken('api')->plainTextToken;
        }
    }
    return response(['msg' => 'invalid email or password'], 403);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
