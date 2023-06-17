<?php

namespace App\Repositories\Users;

interface UserRepositoryInterface
{
    public function show($id): User;
    public function create(array $data): User;

    public function update($id, array $data): User;
    public function delete($id): User;

}
