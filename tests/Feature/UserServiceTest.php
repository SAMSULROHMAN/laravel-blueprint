<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public UserService $userService;
    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        $this->assertTrue($this->userService->login('Samsul', 'Rohman'));
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
