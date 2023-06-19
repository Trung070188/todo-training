<?php
namespace App\Repositories\Users;


use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }

}
