<?php

namespace App\Http\Requests;

use App\Repositories\Users\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $permission = [
          'create' => Gate::allows('create', User::class),
          'update' => Gate::allows('update', User::class)
        ];
        return $permission['create'] && $permission['update'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ];
    }
    public function createUser()
    {
        $input = $this->validated();
        return [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ];
    }
}
