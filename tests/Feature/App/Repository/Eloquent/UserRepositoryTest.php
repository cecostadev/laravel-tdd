<?php

namespace Tests\Feature\App\Repository\Eloquent;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\QueryException;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repository\Contracts\UserRepositoryInterface;

class UserRepositoryTest extends TestCase
{   

    protected $repository;

    protected function setUp():void
    {
        $this->repository = new UserRepository(new User());

        parent::setUp();
    }

    public function test_implements_interface():void
    {
        $this->assertInstanceOf(
            UserRepositoryInterface::class,
            $this->repository
        );
    }

    public function test_find_all_empty(): void
    {
        $response = $this->repository->findAll();

        $this->assertIsArray($response);
        $this->assertCount(0, $response);
    }

    public function test_find_all():void
    {   
        User::factory()->count(10)->create();

        $response = $this->repository->findAll();

        $this->assertCount(10, $response);
    }

    public function test_create_success():void
    {   
        $data = [
            'name' => 'Carlos Eduardo',
            'email' =>"carlos.costa@softdesign.com.br",
            'password' => bcrypt("123456"),
        ];

        $response = $this->repository->create($data);

        $this->assertNotNull($response);
        $this->assertIsObject($response);
        $this->assertDatabaseHas(
            'users',
            [
                'email' => 'carlos.costa@softdesign.com.br'
            ]
        );
    }

    public function test_create_exception():void
    {
        $data = [
            'name' => 'Carlos Eduardo',
            'email' =>"carlos.costa@softdesign.com.br",
        ];

        $this->expectException(QueryException::class);

        $this->repository->create($data);
    }

    public function test_update():void
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Carlos aaa'
        ];

        $response = $this->repository->update($user->email, $data);

        $this->assertNotNull($response);
        $this->assertIsObject($response);
        $this->assertDatabaseHas('users',[
            'name' => 'Carlos aaa'
        ]);

    }
}
