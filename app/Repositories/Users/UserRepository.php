<?php
namespace App\Repositories\Users;


use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
       return User::create($data);
    }
    public function update($id, array $data): User
    {
        $user = User::find($id);
        $user->fill($data);
        $user->save();
        return $user;

    }
    public function delete($id): User
    {
        $user = User::find($id);
        return $user->delete();

    }

}
