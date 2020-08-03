<?php

namespace App\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->withoutExceptionHandling();
        $this->get(route('task_statuses.create'))->assertSuccessful();
    }

    public function testIndex()
    {
        $this->get(route('task_statuses.index'))->assertSuccessful();
    }

    public function testEdit()
    {
        $this->get(route('task_statuses.edit', ['task_status' => 1]))->assertSuccessful();
    }

    public function testStore()
    {
        $params = ['name' => 'in development'];
        $this->post(route('task_statuses.store'), $params)->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas('task_statuses', ['name' => 'in development']);
    }

    public function testUpdate()
    {
        $params = ['name' => 'completed'];
        $this->put(route('task_statuses.update', ['task_status' => 1]), $params)
             ->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas('task_statuses', ['name' => 'completed']);
    }

    public function testDestroy()
    {
        $this->delete(route('task_statuses.destroy', ['task_status' => 1]))
             ->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseMissing('task_statuses', ['id' => 1]);
    }
}
