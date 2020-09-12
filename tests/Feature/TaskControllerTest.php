<?php

namespace App\Tests\Feature;

use App\Tests\TestCase;
use App\Task;
use App\Label;
use App\User;
use App\TaskStatus;

class TaskControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        factory(Task::class, 2)->create();
    }

    public function testCreate()
    {
        $this->get(route('tasks.create'))->assertOk();
    }

    public function testIndex()
    {
        $this->get(route('tasks.index'))->assertOk();
    }

    public function testEdit()
    {
        $task = factory(Task::class)->create();
        $this->get(route('tasks.edit', [$task]))->assertOk();
    }

    public function testView()
    {
        $task = factory(Task::class)->create();
        $this->get(route('tasks.show', [$task]))->assertOk();
    }

    public function testStore()
    {
        $labels = factory(Label::class, 2)->create();
        $labelData = $labels->map(function (Label $label) {
            return $label->id;
        })->all();

        $task = factory(Task::class)->make();
        $taskData = \Arr::only($task->toArray(), ['name', 'description', 'status_id']);
        $response = $this->post(route('tasks.store'), array_merge($taskData, ['labels' => $labelData]));
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $taskData);

        $savedTask = Task::orderBy('id', 'desc')->first();
        foreach ($labels as $label) {
            $this->assertDatabaseHas('task_labels', [
                'label_id' => $label->id,
                'task_id' => $savedTask->id
            ]);
        }
    }

    public function testUpdate()
    {
        $task = factory(Task::class)->create();
        $factoryData = factory(Task::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name', 'description', 'status_id']);
        $response = $this->patch(route('tasks.update', $task), $data);
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testSwitchAssignee()
    {
        $task = factory(Task::class)->create();
        $user = factory(User::class)->create();
        $data = ['assigned_to_id' => $user->id];
        $this->put(route('tasks.update', $task), $data)
             ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDestroy()
    {
        $task = factory(Task::class)->create();
        $task->createdBy()->associate(auth()->user());
        $task->save();
        $response = $this->delete(route('tasks.destroy', $task));
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function testFilter()
    {
        $task = factory(Task::class)->create();
        $assignedUser = factory(User::class)->create();
        $creator = auth()->user();
        $task->createdBy()->associate($creator);
        $task->assignedTo()->associate($assignedUser);
        $task->save();
        $taskStatus = factory(TaskStatus::class)->create();
        $params = [
            'filter' => [
                'status_id' => $taskStatus->id,
                'created_by_id' => $creator->id,
                'assigned_to_id' => $assignedUser->id
            ]
        ];
        $this->get(route('tasks.index', $params))
             ->assertSuccessful(route('tasks.index'))
             ->assertDontSee($task->name);
    }
}
