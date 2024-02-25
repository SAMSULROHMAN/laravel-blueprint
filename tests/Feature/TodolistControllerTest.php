<?php

namespace Tests\Feature;

use Database\Seeders\TodoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete('delete from todos');
    }
    public function testTodolist()
    {
        $this->seed(TodoSeeder::class);
        $this->withSession([
            'user' => 'Samsul'
        ])->get('todolist')
            ->assertSeeText("1")
            ->assertSeeText("Makan")
            ->assertSeeText("2")
            ->assertSeeText("Minum");
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
