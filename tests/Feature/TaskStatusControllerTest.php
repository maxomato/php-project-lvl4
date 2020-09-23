<?php

namespace App\Tests\Feature;

use App\Tests\TestCase;
use App\TaskStatus;
use App\User;

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
        $user = factory(User::class)->create();
        $this->be($user);

        $factoryData = factory(TaskStatus::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $taskStatus = factory(TaskStatus::class)->create();
        $factoryData = factory(TaskStatus::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->put(route('task_statuses.update', $taskStatus), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $taskStatus = factory(TaskStatus::class)->create();
        $response = $this->delete(route('task_statuses.destroy', $taskStatus));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
    }
}
