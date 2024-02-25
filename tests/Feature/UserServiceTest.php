<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public UserService $userService;
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete('delete from users');
        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);
        $this->assertTrue($this->userService->login('rohmansamsul91@gmail.com', 'rahasia'));
    }

    public function testLoginNotFound()
    {
        $this->assertFalse($this->userService->login('Samsul', 'Samsul'));
    }

    public function testLoginWrongPass()
    {
        $this->assertFalse($this->userService->login('Samsul', 'Salah Luer '));
    }
}
