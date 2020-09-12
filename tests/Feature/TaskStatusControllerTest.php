<?php

namespace App\Tests\Feature;

use App\Tests\TestCase;
use App\TaskStatus;

class TaskStatusControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        factory(TaskStatus::class, 2)->create();
    }


    public function testCreate()
    {
        $this->get(route('task_statuses.create'))->assertOk();
    }

    public function testIndex()
    {
        $this->get(route('task_statuses.index'))->assertOk();
    }

    public function testEdit()
    {
        $taskStatus = factory(TaskStatus::class)->create();
        $this->get(route('task_statuses.edit', $taskStatus))->assertOk();
    }

    public function testStore()
    {
        $factoryData = factory(TaskStatus::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $this->post(route('task_statuses.store'), $data)->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdate()
    {
        $taskStatus = factory(TaskStatus::class)->create();
        $factoryData = factory(TaskStatus::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $this->put(route('task_statuses.update', $taskStatus), $data)
             ->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $taskStatus = factory(TaskStatus::class)->create();
        $this->delete(route('task_statuses.destroy', $taskStatus))
             ->assertRedirect();

        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
    }
}
