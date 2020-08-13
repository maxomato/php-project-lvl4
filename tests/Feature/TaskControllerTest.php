<?php

namespace App\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get(route('tasks.create'))->assertSuccessful();
    }

    public function testIndex()
    {
        $this->get(route('tasks.index'))->assertSuccessful();
    }

    public function testEdit()
    {
        $this->get(route('tasks.edit', ['task' => 1]))->assertSuccessful();
    }

    public function testView()
    {
        $this->get(route('tasks.show', ['task' => 1]))->assertSuccessful();
    }

    public function testStore()
    {
        $params = [
            'name' => 'small task',
            'description' => 'small task description',
            'status_id' => 1,
            'assigned_to_id' => ''
        ];
        $this->post(route('tasks.store'), $params)->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'name' => 'small task',
            'description' => 'small task description',
            'status_id' => 1,
            'assigned_to_id' => null
        ]);
    }

    public function testUpdate()
    {
        $params = [
            'name' => 'small task',
            'description' => 'new description',
            'status_id' => 1,
            'assigned_to_id' => ''
        ];
        $this->put(route('tasks.update', ['task' => 1]), $params)
             ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'name' => 'small task',
            'description' => 'new description',
            'status_id' => 1,
            'assigned_to_id' => null
        ]);
    }

    public function testSwitchAssignee()
    {
        $params = [
            'name' => 'small task',
            'description' => 'new description',
            'status_id' => 1,
            'assigned_to_id' => 1
        ];
        $this->put(route('tasks.update', ['task' => 1]), $params)
             ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'name' => 'small task',
            'description' => 'new description',
            'status_id' => 1,
            'assigned_to_id' => 1
        ]);
    }

    public function testDestroy()
    {
        $this->delete(route('tasks.destroy', ['task' => 1]))
             ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', ['id' => 1]);
    }
}
