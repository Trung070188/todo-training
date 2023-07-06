<?php

use App\Lim\LimClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/auth/lim/redirect', function (Request $request) {
    $request->session()->put('state', $state = \Illuminate\Support\Str::random(40));
    return LimClient::redirectLogin($state);
});

Route::get('/api/callback', function (Request $request) {
    $state = $request->session()->pull('state');
    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
    );

    $token = LimClient::requestTokenWithAuthCode($request->code);


    return view('lim.callback', ['token' => $token]);
});
