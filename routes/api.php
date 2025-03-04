<?php

use App\Http\Controllers\ArticlesController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Route::get('/setup', function () {
    $credentials = [
        'email' => 'test2@example@mail.com',
        'password' => 'password'
    ];

    if(!Auth::attempt($credentials)) {
        $user = new User();

        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);

        $user->save();

        if(Auth::attempt($credentials)) {

            $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('update-token', ['create', 'update']);
            $basicToken = $user->createToken('basic-token', ['none']);

            return [
                'admin' => $adminToken->plainTextToken,
                'update' => $updateToken->plainTextToken,
                'basic' => $basicToken->plainTextToken,
            ];

        }

    }

});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/articles', [ArticlesController::class, 'index']);
    Route::get('/articles/withoutCache', [ArticlesController::class, 'allWithoutCache']);
    Route::post('/articles', [ArticlesController::class, 'store']);
    Route::get('/articles/{id}', [ArticlesController::class, 'show']);

});


