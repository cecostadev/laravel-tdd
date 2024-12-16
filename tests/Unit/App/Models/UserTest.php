<?php

namespace Tests\Unit\App\Models;

use App\Models\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserTest extends TestCase
{
    protected function model(): Model
    {
        return new User();
    }

    public function test_traits()
    {
        $traits = array_keys(class_uses($this->model()));

        $expectedTraits = [
            HasFactory::class,
            Notifiable::class
        ];

        $this->assertEquals($expectedTraits, $traits);
    }
}
