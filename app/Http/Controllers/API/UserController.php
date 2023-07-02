<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Users\User;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Psr\Http\Message\ServerRequestInterface;


/**
 * @group User
 *
 * APIs for managing Users
 *
 * @header Content-Type application/json
 * @authenticated
 */
class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index(Request $request)
    {
        try
        {
            $this->authorize('view', User::class);
            $query = $request->query();
            $users = $this->userRepository->getByQuery($query);
             return UserResource::collection($users);

        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed']);

        }

    }


    protected function validationRulesLogin(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }


    /**
     * Login
     *
     * This endpoint is used to login a user to the system.
     *
     * @bodyParam email string required Example: admin@gmail.com
     * @bodyParam password string required Example: 123456
     *
     * @response scenario="Successful Login" {
     * "message": "User Login Successfully",
     * "access_token": "8|MgowQLkdpShwrb8AI9j1YAGmwnDjAOeE17XrP5nb",
     * "token_type": "Bearer"
     * }
     *
     * @response 401 scenario="Failed Login"{
     * "message": "Invalid login credentials"
     *
     * }
     *
     */
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

    /**
     * Create users
     *
     * Kết quả trả về file json user
     *
     * @bodyParam name string required Example: Trung
     * @bodyParam email string required Example: admin@gmail.com
     * @bodyParam password string required
     *
     *@response 201 {
     * "data": {
     *   "id": 1,
     *   "name": "Trung",
     *   "email": "admin@gmail.com",
     * }
     *}
     */

    public function store(UserRequest $request)
    {
        try {
            $this->authorize('create', User::class);
            $dataUser = $request->createUser();
            $user = $this->userRepository->create($dataUser);
            return new UserResource($user);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.'], 405);

        }

    }


    /**
     * Đăng ký users
     *
     * Kết quả trả về file json user
     *
     * @bodyParam name string required Example: Trung
     * @bodyParam email string required Example: admin@gmail.com
     * @bodyParam password string required
     *
     *@response 201 {
     * "data": {
     *   "id": 1,
     *   "name": "Trung",
     *   "email": "admin@gmail.com",
     * }
     *}
     */

    public function register(Request $request)
    {
        try {
            $dataUser = $request->all();
            $this->validate($request, $this->validationRulesRegister());
            $user = $this->userRepository->create($dataUser);
            return new UserResource($user);

        }
        catch (ValidationException $validationException)
        {
            return response()->json(['message' => $validationException->getMessage()],422);
        }
    }

    /**
     * Show 1 user
     *
     * Kết quả trả về file json user
     *
     * @queryParam id int required Example: 1
     *
     *@response 201 {
     * "data": {
     *   "id": 1,
     *   "name": "Trung",
     *   "email": "admin@gmail.com",
     * }
     *}
     */
    public function show($id)
    {
        try {
            $this->authorize('show', User::class);

            $user =  $this->userRepository->show($id);

            return new UserResource($user);


        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.'], 405);
        }

    }

    /**
     * Update the specified resource in storage.
     */

    protected function validationRulesUpdate(): array
    {
        return [
            'email' => 'email',
        ];
    }

    /**
     * update user
     *
     * Kết quả trả về file json user
     *
     * @bodyParam email Example: admin1@gmail.com
     * @queryParam id required Example :1
     *
     *@response 201 {
     * "data": {
     *   "id": 1,
     *   "name": "Trung",
     *   "email": "admin1@gmail.com",
     * }
     *}
     */
    public function update(Request $request, $id)
    {
        try {

            $this->authorize('update', User::class);
            $input = $request->all();

            $user = $this->userRepository->update($id, $input);

            return new UserResource($user);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.']);

        }
    }

    /**
     * Delete user
     * Trả về message
     * @queryParam id int Example :1
     * @response 200 {"message : OK"}
     */
    public function destroy($id)
    {
        try {
            $this->authorize('delete', User::class);
            $this->userRepository->delete($id);
            return response()->json(['message' => 'Ok']);
        }
        catch (\Exception $e)
        {
            return response()->json(['message' => 'Authorization failed.'], 405);

        }

    }
}
