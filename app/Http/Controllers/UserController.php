<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repository\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $users = collect($this->repository->findAll());

        return UserResource::collection($users);
    }
}
