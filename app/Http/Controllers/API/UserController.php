<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $input = $request->all();
        $token = '';
        $validate = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
            ]);
        if($validate->fails())
        {
            return response()->json(['error' => $validate->errors()], 422);
        }

        if (Auth::attempt($input)) {
            $user = Auth::user();
            $token = $user->createToken('MyToken')->accessToken;
      }

        return response()->json(['token' => $token]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = Auth::guard('api')->user();
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
