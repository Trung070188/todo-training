<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

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
            'email' => 'required|email',
            'password' => 'required'
            ]);
        if($validate->fails())
        {
            return response()->json(['error' => $validate->errors()], 422);
        }

        $response = Http::asForm()->post('http://127.0.0.1:8000/oauth/token', [
            'grant_type' => 'password',
            'client_id' => '996c365b-ee34-4810-855e-0f3ed4999732',
            'client_secret' => 'QuAoePzvHy59GeQcUWwfVRQJvVctM6lMjQ9TpmCV',
            'username' => $input['email'],
            'password' => $input['password'],
            'scope' => '',
        ]);

        return response()->json($response->json());
    }

    /**
     * Display the specified resource.
     */
    public function show()
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
