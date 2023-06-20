<?php
namespace App\Repositories\Users;


use App\Repositories\BaseRepository;
use phpseclib3\Crypt\Hash;

class UserRepository extends BaseRepository
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }


}
