<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Users\User;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('show'))
        {
            $users = User::query()->orderBy('id','desc')->get();
            return response()->json(['users' => $users]);
        }
        else {
            return response()->json(['message' => 'Authorization failed']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    protected function validationRulesLogin(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
    public function login(ServerRequestInterface $request)
    {
        $input = $request->getParsedBody();
        $validate = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required'
            ]);
        if($validate->fails())
        {
            return response()->json(['error' => $validate->errors()], 422);
        }

        $requester = $request->withParsedBody([
            'grant_type' => 'password',
            'client_id' => env('Client_ID'),
            'client_secret' => env('Client_Secret'),
            'username' => $input['email'],
            'password' => $input['password'],
            'scope' => '',
        ]);

        return app()->make(\Laravel\Passport\Http\Controllers\AccessTokenController::class)->issueToken($requester);
    }

    /**
     * validate register
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    protected function validationRulesRegister(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
    public function register(Request $request)
    {
        $input = $request->all();

        $this->validate($request, $this->validationRulesRegister());

        $user = $this->userRepository->create([
           'name' => $input['name'],
           'email' => $input['email'],
           'password' => Hash::make($input['password'])
        ]);

        return response()->json(['user' => $user]);

    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        if(Gate::allows('show'))
        {
           $user =  $this->userRepository->show($id);

            return response()->json(['user' => $user]);

        }
        else{
            return response()->json(['message' => 'Authorization failed.'], 405);

        }
    }

    /**
     * Update the specified resource in storage.
     */

    protected function validationRulesUpdate(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
        ];
    }
    public function update(Request $request, $id)
    {
        $targetUser = User::query()->where('id', $id)->first();

        if (Gate::allows('update', [$targetUser])) {
            $input = $request->all();
            $user = $this->userRepository->update($id, $input);

            return response()->json(['user' => $user]);
        } else {
            return response()->json(['message' => 'Authorization failed.'], 405);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $targetUser = User::query()->where('id', $id)->first();

        if (Gate::allows('delete', [$targetUser])) {

            $this->userRepository->delete($id);
            return response()->json(['message' => 'Ok']);
        } else {
            return response()->json(['message' => 'Authorization failed.'], 405);
        }
    }
}
