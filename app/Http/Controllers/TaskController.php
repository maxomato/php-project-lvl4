<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use App\Label;
use App\TaskLabel;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate();

        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('task.create', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        $data = $request->validated();

        $task = new Task();
        $task->fill($data);
        $task->createdBy()->associate(auth()->user());
        $task->save();

        if (array_key_exists('labels', $data)) {
            foreach ($data['labels'] as $labelId) {
                $label = Label::find($labelId);

                $taskLabel = new TaskLabel();
                $taskLabel->label()->associate($label);
                $taskLabel->task()->associate($task);
                $taskLabel->save();
            }
        }

        return redirect()->route('tasks.index')
                         ->with('message', 'flash.task.store.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('task.view', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('task.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTask $request, Task $task)
    {
        $data = $request->validated();

        $task->fill($data);
        $task->save();

        if (array_key_exists('labels', $data)) {
            $task->taskLabels()->delete();

            foreach ($data['labels'] as $labelId) {
                $label = Label::find($labelId);

                $taskLabel = new TaskLabel();
                $taskLabel->label()->associate($label);
                $taskLabel->task()->associate($task);
                $taskLabel->save();
            }
        }

        return redirect()->route('tasks.index')
                         ->with('message', 'flash.task.update.success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if (auth()->user()->id !== $task->createdBy->id) {
            abort(403);
        }

        $task->delete();
        return redirect()->route('tasks.index')
                         ->with('message', 'flash.task.remove.success');
    }
}
