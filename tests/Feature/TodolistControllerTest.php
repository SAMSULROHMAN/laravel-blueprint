<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            'user' => 'Samsul',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'Samsul'
                ],
                [
                    'id' => '2',
                    'todo' => 'Rohman'
                ]
            ]
        ])->get('todolist')
            ->assertSeeText("1")
            ->assertSeeText("Samsul")
            ->assertSeeText("2")
            ->assertSeeText("Rohman");
    }

    public function testAddTodolistFailed()
    {
        $this->withSession([
            'user' => 'Samsul'
        ])->post('/todolist', [])
            ->assertSeeText('Todo wajib diisi');
    }

    public function testAddTodolistSuccess()
    {
        $this->withSession([
            'user' => 'Samsul'
        ])->post('/todolist', [
            'todo' => 'Samsul'
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            'user' => 'Samsul',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'Samsul'
                ],
                [
                    'id' => '2',
                    'todo' => 'Rohman'
                ]
            ]
        ])->post('/todolist/1/delete')->assertRedirect('/todolist');
    }
}
