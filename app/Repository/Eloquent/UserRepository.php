<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function findAll():array
    {
        return $this->model->get()->toArray();
    }

    public function create(array $data):object
    {
        return $this->model->create($data);
    }

    public function update(string $mail, $data):object
    {
        $user = $this->model->where('email', $mail)->first();
        $user->update($data);
        $user->refresh();

        return $user;
    }


}