<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('Login');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            'user' => 'Samsul'
        ])->get('/login')->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            'user' => 'Samsul',
            'password' => 'Rohman'
        ])->assertRedirect('/')->assertSessionHas('user', 'Samsul');
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            'user' => 'Samsul'
        ])->post('/login', [
            'user' => 'Samsul',
            'password' => 'Rohman'
        ])->assertRedirect('/');
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])->assertSeeText('Username atau Password wajib diisi');
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => 'Salah',
            'password' => 'Salah'
        ])->assertSeeText('User atau Password Salah');
    }

    public function testLogout()
    {
        $this->withSession([
            'user' => 'Samsul'
        ])->post('/logout')->assertRedirect('/')->assertSessionMissing('user');
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')->assertRedirect('/');
    }
}
